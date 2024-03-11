<?php

namespace App\Http\Controllers;

use Dotenv\Regex\Success;
 use Illuminate\Http\Request;
use Srmklive\PayPal\Services\ExpressCheckout;
use Illuminate\Support\Facades\Validator;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;
use App\{SiteSetting,Order,OrderProduct,EmailNotification,Product,UserDetail,User};
use Session;
use Illuminate\Support\Facades\DB;
use Stripe\Exception\CardException;
use Stripe\StripeClient;
use App\Traits\{NotificationTrait};
 use Stripe;
class PaymentController extends Controller
{
    use NotificationTrait;
    public $provider;
    private $stripe;

    public function __construct()
    {

        $key=SiteSetting::findOrFail(1);
        $config=[
            'mode'    => $key->paypal_mode, // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
            'sandbox' => [
                'username'    => $key->paypal_sandbox_api_username,
                'password'    => $key->paypal_sandbox_api_password,
                'secret'      => $key->paypal_sandbox_api_secret,
                'certificate' => env('PAYPAL_SANDBOX_API_CERTIFICATE', ''),
                'app_id'      => 'APP-80W284485P519543T', // Used for testing Adaptive Payments API in sandbox mode
            ],
            'live' => [
                'username'    => env('PAYPAL_LIVE_API_USERNAME', ''),
                'password'    => env('PAYPAL_LIVE_API_PASSWORD', ''),
                'secret'      => env('PAYPAL_LIVE_API_SECRET', ''),
                'certificate' => env('PAYPAL_LIVE_API_CERTIFICATE', ''),
                'app_id'      => '', // Used for Adaptive Payments API
            ],

            'payment_action' => 'Sale', // Can only be 'Sale', 'Authorization' or 'Order'
            'currency'       => $key->paypal_currency,
            'notify_url'     => '', // Change this accordingly for your application.
            'locale'         => '', // force gateway language  i.e. it_IT, es_ES, en_US ... (for express checkout only)
            'validate_ssl'   => true, // Validate SSL when creating api client.
            'billing_type' => 'MerchantInitiatedBilling',
        ];
        $this->provider = new ExpressCheckout;

        $this->provider->setApiCredentials($config);
       // $this->provider->getAccessToken();
       ini_set('max_execution_time', 300); //3 minutes
    //    dd(config('stripe.api_keys.secret_key'));
       $this->stripe = new StripeClient(config('stripe.api_keys.secret_key'));

    }


    public function stripePost($data, $amount)
    {
        // dd($data);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $charge = Stripe\Charge::create([
                "amount" => $amount * 100,
                "currency" => "USD",
                "source" => $data['token_id'],
                "description" => "This payment is for testing purposes",
            ]);

            // Check the status of the charge
            if ($charge->status === 'succeeded') {
                // Payment was successful
                $response = [
                    'success' => true,
                    'message' => 'Payment Successful!',
                    'response' => $data,
                    'charg_id'=>$charge->id

                ];
            } else {
                // Payment failed
                $response = [
                    'success' => false,
                    'message' => 'Payment Failed. Please try again.',
                ];
            }
        } catch (Stripe\Exception\CardException $e) {
            // Handle specific card errors
            $response = [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        } catch (Exception $e) {
            // Handle other exceptions
            $response = [
                'success' => false,
                'message' => 'An error occurred while processing your payment.',
            ];
        }


        return $response;
    }

    private function createToken($cardData)
    {
        $token = null;
        try {
            $token = $this->stripe->tokens->create([
                'card' => [
                    'number' => $cardData['cardNumber'],
                    'exp_month' => $cardData['month'],
                    'exp_year' => $cardData['year'],
                    'cvc' => $cardData['cvv']
                ]
            ]);
        } catch (CardException $e) {
            $token['error'] = $e->getError()->message;
        } catch (Exception $e) {
            $token['error'] = $e->getMessage();
        }
        return $token;
    }
    public function payment(Request $request)
    {
        // $token = $this->createToken($request);
         DB::beginTransaction();
        try{

            $validator = Validator::make($request->all(), [
                "bill_street_1" => 'required',
                "bill_street_2" => 'required',
                "bill_postal_code"  => 'required',
                "bill_city"  => 'required',
                "bill_state"  => 'required',
                "bill_country"  => 'required',
                "cphone"  => 'required',
            ],
            [
                'bill_street_1.required' => 'Address field is required.',
                'bill_street_2.required' => 'Appartment field is required.',
                'bill_postal_code.required' => 'Zip Code field is required.',
                'bill_city.required' => 'City field is required.',
                'bill_state.required' => 'State field is required.',
                'bill_country.required' => 'Country field is required.',
                'cphone.required' => 'Telephone field is required.',
            ]
        );
            if ($validator->fails()) {
                return back()->with('errors', $validator->errors());
           }
           $items = \Cart::session('sessioncart')->getContent();
           foreach($items as $row){
           $product=Product::whereProductId($row->id)->first();
            $qty=$product->in_stock;
            $product->in_stock-=$row->quantity;
            if($product->in_stock<0){
                return back()->with('error', $product->name." has only $qty quantity available!");
            }

        }

        $site=SiteSetting::find(1);
           if($request->has('update')){
            $user=UserDetail::where('user_id',Auth()->user()->id)->first();
            $user->bill_street_1=$request->bill_street_1;
            $user->bill_street_2=$request->bill_street_2;
            $user->bill_postal_code=$request->bill_postal_code;
            $user->bill_city=$request->bill_city;
            $user->bill_state=$request->bill_state;
            $user->bill_country=$request-> bill_country;
            $user->cphone=$request->cphone;
            if($request->has('fax')){
                $user->fax=$request->fax;
            }

            $user->update();

           }

           $order=new Order;
           $order->order_id=strtotime(date('Y-m-d H:i:s'));
           $order->user_id=Auth()->user()->id;
           $order->ship_street_1=Auth()->user()->detail['ship_street_1'] ?? $request->bill_street_1;
           $order->ship_street_2=Auth()->user()->detail['ship_street_2'] ?? $request->bill_street_2;
           $order->ship_postal_code=Auth()->user()->detail['ship_postal_code'] ?? $request->bill_postal_code;
           $order->ship_city=Auth()->user()->detail['ship_city'] ?? $request->bill_city;
           $order->ship_state=Auth()->user()->detail['ship_state'] ?? $request->bill_state;
           $order->ship_county=Auth()->user()->detail['ship_county'] ?? '';
           $order->ship_country=Auth()->user()->detail['ship_country'] ?? $request->bill_country;
           $order->bill_street_1=$request->bill_street_1;
           $order->bill_street_2=$request->bill_street_2;
           $order->bill_postal_code=$request->bill_postal_code;
           $order->bill_city=$request->bill_city;
           $order->bill_state=$request->bill_state;
           $order->bill_county=Auth()->user()->detail['bill_county'] ?? '';
           $order->bill_country=$request->bill_country;
           $order->grand_total=\Cart::session('sessioncart')->getTotal();
           $order->status=0;
           $order->shipping=$site->shipping > 0 ? $site->shipping : 0 ;
           if($request->has('note')){
            $order->note=$request->note;
        }
        if(Session::has('coupon')){
            $order->coupon_id=Session::get('coupon')['id'];
        }
           $order->save();
           $data=[];
           $data['items']=[];
           $items = \Cart::session('sessioncart')->getContent();
            foreach($items as $row){
            $order_product=new OrderProduct;
            $order_product->order_id=$order->order_id;
            $order_product->name=$row->name;
            $order_product->price=$row->price;
            $order_product->product_id=$row->id;
            $order_product->sku=$row->associatedModel->sku;
            $order_product->qty=$row->quantity;
            $order_product->save();

            array_push($data['items'],[
                'name' => $row->name,
                'price' => $row->price,
                'desc'  => strip_tags($row->associatedModel->short_description) ?? '',
                'qty' => $row->quantity,
            ]);



        }
        $cartConditions = \Cart::session('sessioncart')->getConditions();
        foreach($cartConditions as $condition)
        {
            $val=substr($condition->getValue(),1,strlen($condition->getValue()));
            array_push($data['items'],[
                'name' => $condition->getName(),
                'price' => (float) $val,
                'desc'  => 'condition shipping price',
                'qty' => 1,
            ]);

        }

        if(Session::has('coupon')){
            $total=\Cart::session('sessioncart')->getTotal();
            $dicount=Session::get('coupon')['discount']/100;
            $cpn=$total*$dicount;
            $grand=floatval($total-$cpn);
            $code=Session::get('coupon')['code'];
            array_push($data['items'],[
                'name' => "Coupon having code $code",
                'price' => floatval("-".number_format($cpn,2)),
                'desc'  => 'coupon discount',
                'qty' => 1,
            ]);


        }



            $data['invoice_id'] = $order->order_id;
            $data['invoice_description'] = "Order #{$order->order_id} Invoice";
            $data['return_url'] = route('payment.success',$order->order_id);
            $data['cancel_url'] = route('payment.cancel',$order->order_id);
            if(isset($grand)){
                $data['total']= $grand;
            }
            else{
            $data['total'] = \Cart::session('sessioncart')->getTotal();
            }

             $data['token_id'] = $request->stripeToken ?? '';
            // $response = $this->provider->setExpressCheckout($data);
            $response = $this->stripePost($data , $data['total']);

            $response = json_encode($response);
            $user = Auth()->user()->role;
            if($user == 0){
            }
            // dd($user);
            $response=json_decode($response);
            //dd($order->order_id);

              if($response->success == true){
              $order= Order::where('id',$order->id)->update(['charge_id'=>$response->charg_id]);
              //dd( $order);
            DB::commit();
            $response = [
                'success' => true,
                'message' => 'Payment Successful!',
                'response' => $response->response->return_url

            ];
            return $response;
            }else{
            DB::rollback();
            return back()->with('error','Something went wrong!');
            }


        }
        catch(Exception $e){
            DB::rollback();
            return back()->with('error','Something went wrong!');

        }



    }



    public function buyCollection(Request $request){
        DB::beginTransaction();
        try{

    if(isset(Auth()->user()->consultant)){
            if(!$request->has('ship')){
            $validator = Validator::make($request->all(), [
                "first_name"=> 'required',
                "last_name"=> 'required',
                "date_of_birth" => 'required',
                "social_security_number" => ['required','regex:/^(?!(000|666|9))\d{3}-(?!00)\d{2}-(?!0000)\d{4}$/'],
                "preferred_language" => 'required',
                "bill_street_1" => 'required',
                "bill_street_2" => 'required',
                "bill_postal_code"  => 'required',
                "bill_city"  => 'required',
                "bill_state"  => 'required',
                "bill_county"  => 'required',
                "bill_country"  => 'required',
                "ship_street_1" => 'required',
                "ship_street_2" => 'required',
                "ship_postal_code" => 'required',
                "ship_city" => 'required',
                "ship_state" => 'required',
                "ship_county" => 'required',
                "ship_country" => 'required',
                "hphone"  => 'required',
                "wphone" => 'sometimes',
                "cphone"  => 'required',
                "pm"  => 'required',
                "bank"  => 'required',
                "routing"  => ['required','regex:/^(\d{9})$/'],
                "acc_no"  => ['required','regex:/^[0-9]{6,17}$/'],
                "acc_type"  => 'required',
                "terms" => 'required',
            ]);

            }
            else{
            $validator = Validator::make($request->all(), [
                "first_name"=> 'required',
                "last_name"=> 'required',
                "date_of_birth" => 'required',
                "social_security_number" => ['required','regex:/^(?!(000|666|9))\d{3}-(?!00)\d{2}-(?!0000)\d{4}$/'],
                "preferred_language" => 'required',
                "bill_street_1" => 'required',
                "bill_street_2" => 'required',
                "bill_postal_code"  => 'required',
                "bill_city"  => 'required',
                "bill_state"  => 'required',
                "bill_county"  => 'required',
                "bill_country"  => 'required',
                "hphone"  => 'required',
                "wphone" => 'sometimes',
                "cphone"  => 'required',
                "pm"  => 'required',
                "bank"  => 'required',
                "routing"  => ['required','regex:/^(\d{9})$/'],
                "acc_no"  => ['required','regex:/^[0-9]{6,17}$/'],
                "acc_type"  => 'required',
                "terms" => 'required',
            ]);

         }
            if ($validator->fails()) {
                 Session::flash('error', $validator->messages()->first());
                 return redirect()->back()->withInput();
            }

            $user=UserDetail::whereUserId(Auth()->user()->id)->first();
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->dob=$request->date_of_birth;
            $user->ssn=$request->social_security_number;
            $user->language=$request->preferred_language;
            $user->bill_street_1=$request->bill_street_1;
            $user->bill_street_2=$request->bill_street_2;
            $user->bill_postal_code=$request->bill_postal_code;
            $user->bill_city=$request->bill_city;
            $user->bill_state=$request->bill_state;
            $user->bill_county=$request->bill_county;
            $user->bill_country=$request-> bill_country;

            if($request->has('ship')){


                $user->ship_street_1=$request->bill_street_1;
                $user->ship_street_2=$request->bill_street_2;
                $user->ship_postal_code=$request->bill_postal_code;
                $user->ship_city=$request->bill_city;
                $user->ship_state=$request->bill_state;
                $user->ship_county=$request->bill_county;
                $user->ship_country=$request-> bill_country;


            }
            else{

                $user->ship_street_1=$request->ship_street_1;
                $user->ship_street_2=$request->ship_street_2;
                $user->ship_postal_code=$request->ship_postal_code;
                $user->ship_city=$request->ship_city;
                $user->ship_state=$request->ship_state;
                $user->ship_county=$request->ship_county;
                $user->ship_country=$request-> ship_country;

            }

            $user->hphone=$request->hphone;
            $user->cphone=$request->cphone;
            $user->wphone=$request->wphone ?? null;
            $user->fax=$request->fax ?? null;
            $user->payment_method=$request->pm;
            $user->bank=$request->bank;
            $user->routing=$request->routing;
            $user->acc_no=$request->acc_no;
            $user->acc_type=$request->acc_type;

            $user->terms=$request->terms;
            $user->update();
           $site=SiteSetting::find(1);
           $order=new Order;
           $order->order_id=strtotime(date("Y-m-d H:i:s"));
           $order->user_id=Auth()->user()->id;
           $order->bill_street_1=$request->bill_street_1;
           $order->bill_street_2=$request->bill_street_2;
           $order->bill_postal_code=$request->bill_postal_code;
           $order->bill_city=$request->bill_city;
           $order->bill_state=$request->bill_state;
           $order->bill_county=$request->bill_county;
           $order->bill_country=$request->bill_country;

           if($request->has('ship')){


               $order->ship_street_1=$request->bill_street_1;
               $order->ship_street_2=$request->bill_street_2;
               $order->ship_postal_code=$request->bill_postal_code;
               $order->ship_city=$request->bill_city;
               $order->ship_state=$request->bill_state;
               $order->ship_county=$request->bill_county;
               $order->ship_country=$request->bill_country;


           }
           else{

               $order->ship_street_1=$request->ship_street_1;
               $order->ship_street_2=$request->ship_street_2;
               $order->ship_postal_code=$request->ship_postal_code;
               $order->ship_city=$request->ship_city;
               $order->ship_state=$request->ship_state;
               $order->ship_county=$request->ship_county;
               $order->ship_country=$request->ship_country;

           }

            $order->grand_total=Session::get('kit')['sale_price'];
            $order->payment_status=1;
            $order->status=0;
            $order->is_kit=1;
            $order->shipping=$site->shipping > 0 ? $site->shipping : 0 ;
            $order->admin_profit=Session::get('kit')['sale_price']-Session::get('kit')['sale_price']*(Auth()->user()->consultant->detail['commission']/100);
            $order->sponsor_comission=Session::get('kit')['sale_price']*(Auth()->user()->consultant->detail['commission']/100);
            $order->save();

            $order_product=new OrderProduct;
            $order_product->order_id=$order->order_id;
            $order_product->name=Session::get('kit')['name'];
            $order_product->price=Session::get('kit')['sale_price'];
            $order_product->product_id=Session::get('kit')['collection_id'];
            $order_product->sku=Session::get('kit')['slug'];
            $order_product->save();


           $data=[];
           $data['items']=[
            [
                'name' => Session::get('kit')['name'],
                'price' => Session::get('kit')['sale_price'],
                'desc'  => strip_tags(Session::get('kit')['description']),
                'qty' => 1,
            ]

           ];
            $data['invoice_id'] = $order->order_id;
            $data['invoice_description'] = "Order #{$order->order_id} Invoice";
            $data['return_url'] = route('payment.success.kit',$order->order_id);
            $data['cancel_url'] = route('payment.cancel',$order->order_id);
            $data['total'] = Session::get('kit')['sale_price'];
           $data['token_id'] = $request->stripeToken;





$response = $this->stripePost($data , $data['total']);
               if($response['success'] == true){
                $order= Order::where('id',$order->id)->update(['charge_id'=>$response['charg_id']]);
            DB::commit();
            // $response = [
            //     'success' => true,
            //     'message' => 'Payment Successful!',
            //     'response' => $response['response']['return_url']

            // ];
            // dd($response);
            return redirect($response['response']['return_url']);
            }else{
            DB::rollback();
            return back()->with('error','Something went wrong!');
            }
            // $response = $this->provider->setExpressCheckout($data);
        //    DB::commit();
            // return redirect($response['paypal_link']);
           // return back()->with('success','Order Created Successfully!');
        }
        else{
            return back()->with('error','Please Select Sponsor First!');
        }
        }
        catch(Exception $e){
            DB::rollback();
            return back()->with('error','Something went wrong!');
        }



    }


    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function cancel($id)
    {
        // $order=Order::whereOrderId($id)->first();
        // $order->payment_status=2;
        // $order->update();
        return back()->with('error','Payment Failed! Please try again!');
    }

    public function successKit(Request $request,$id)
    {
        // $response = $this->provider->getExpressCheckoutDetails($request->token);

        // if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {

            Session::forget('kit');
            $usr=User::findOrFail(Auth()->user()->id);
            $usr->is_consultant=1;
            $usr->update();
            $order=Order::where('order_id',$id)->first();
            $order->payment_status=1;
            $order->update();
            $order=Order::with('orderProducts')->whereOrderId($id)->first();
            Mail::to(Auth()->user()->email)->send(new OrderMail($order));
            return redirect()->route('order.success',$id);


        // }

        // return back()->with('error','Something went wrong!');
    }

    public function check_mail() {

        // $admin = User::where('unique_id', '513252')->first();

        // dd($admin);

        $order=Order::with('orderProducts')->where('id',10)->first();
        // Mail::to(Auth()->user()->email)->send(new OrderMail($order));

        $customer = User::find(Auth()->id());
        //notify admin
        // $request_detail = [
        //     'greeting' => 'Hi '.$customer->user_name . ',',
        //     'from_email' => env("MAIL_FROM_ADDRESS", "info@christian.com"),
        //     'from_name' => env("MAIL_FROM_ADDRESS", "info@christian.com"),
        //     'reply_to' => '',
        //     'subject' => 'New Appointment',
        //     'message' => "New appointment arrived. Please, check your portal.",
        // ];
        // dd($customer, $order);
        $customer->notify(new \App\Notifications\OrderNotification1($order));

        $email_notifications = EmailNotification::all();
        foreach ($email_notifications as $email_notification) {
            $email_notification->notify(new \App\Notifications\OrderNotification1($order));
        }
        dd($email_notifications, $customer, $order );
    }

    /**
     * Responds with a welcome message with instructions
     *
     * @return \Illuminate\Http\Response
     */
    public function success(Request $request,$id)
    {
        // $response = $this->provider->getExpressCheckoutDetails($request->token);

        // if (in_array(strtoupper($response['ACK']), ['SUCCESS', 'SUCCESSWITHWARNING'])) {
            Session::forget('coupon');
            $items = \Cart::session('sessioncart')->getContent();
             foreach($items as $row){
            $product=Product::whereProductId($row->id)->first();
            $product->in_stock-=$row->quantity;
            $product->update();
        }

            \Cart::session('sessioncart')->clear();
            $order=Order::where('order_id',$id)->first();
            $order->payment_status=1;
            $order->update();
            \Cart::session('sessioncart')->clear();
            $order=Order::with('orderProducts')->whereOrderId($id)->first();
            // Mail::to(Auth()->user()->email)->send(new OrderMail($order));

            $customer = User::find(Auth()->id());

            // $customer->notify(new \App\Notifications\OrderNotification1($order));

            // $email_notifications = EmailNotification::all();
            // foreach ($email_notifications as $email_notification) {
                // $email_notification->notify(new \App\Notifications\OrderNotification1($order));
            // }

            // send notification
            $admin = User::where('unique_id', '513252')->first();
            $msg = 'New order placed. Order #'.$order->order_id;
            $this->notify_user($admin->id, $msg);
            User::where('id' , Auth()->user()->id)->update(['role' => 2]);

            return redirect()->route('order.success',$id);


        // }

        // return back()->with('error','Something went wrong!');
    }
}



