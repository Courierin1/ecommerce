<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Product;
use App\Collection;
use App\User;
use Auth;
use Session;
use App\UserDetail;
use App\OrderProduct;
use App\Order;
use App\ContactUs;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ContactUsRequest;
use App\SiteSetting;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Mail;

class WebsiteController extends Controller
{
    public function index()
    {
        $categories = Category::where('status',1)->get();
        return view('site.home',[
            'categories'=>$categories->toArray()
        ]);
    }


    public function headerProductSearchAjax(Request $request) {
        try {
            $products = Product::where('products.status', 1)->orderBy('products.name', 'ASC');

        $view = '';
        if (isset($request->name) && strlen($request->get('name')) >= 3 ){
            $name = $request->get('name');
            $products = $products->where('products.name','LIKE', "%$name%");
        }

        $products = $products->select('products.*')->take(10)->get();

        $view = view('site.header_product_search_ajax', ['products' => $products])->render();

        return $data=["code"=>200,"message"=>"Success!",'view'=>$view];
        }
        catch (\Exception $e) {
            dd($e);
            return $data=["code"=>200,"message"=>"Something went wrong!"];
            return response()->json(['code' => 400, 'message' => 'something went wrong']);
        }
    }

    public function aboutUs()
    {
        $categories = Category::where('status',1)->get();
        return view('site.about-us',compact('categories'));
    }
    public function contactUs()
    {
        return view('site.contact-us');
    }
    public function angelNumbers()
    {
        return view('site.angel-numbers');
    }
    public function giving()
    {
        return view('site.giving');
    }
    public function kits()
    {
        // if(Auth::check()==false){
        //     return redirect('register-consultant');
        // }
        $kits = Collection::where('status',1)->get();
        if(Auth::check()){
        $detail=UserDetail::whereUserId(Auth()->user()->id)->first();
        }

        return view('site.kits', [
            'kits' => $kits->toArray(),
           'detail' => $detail ?? null
        ]);
        // return view('site.kits');
    }
    public function shop()
    {
        $categories = Category::where('status',1)->paginate(6);
        return view('site.shop',[
            'categories'=>$categories
        ]);

    }
    public function shopTwo()
    {
        $categories = Category::where('status',1)->paginate(6);
        return view('site.shop-two',[
            'categories'=>$categories
        ]);
    }
    public function party()
    {

        $kits = Collection::where('status',1)->get();
        if(Auth::check()){
        $detail=UserDetail::whereUserId(Auth()->user()->id)->first();
        }

        return view('site.party', [
            'kits' => $kits->toArray(),
           'detail' => $detail ?? null
        ]);
    }
    public function productDetails($slug)
    {
        $product=Product::whereSlug($slug)->first();

        return view('site.product-detail',compact('product'));
    }



    public function mission()
    {
        $categories = Category::where('status',1)->get();
        return view('site.mission',compact('categories'));
    }
    public function pricing()
    {   $kits = Collection::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        return view('site.pricing',compact('categories','kits'));
    }
    public function checkout()
    {
        // if(\Cart::session(Auth()->user()->id)->isEmpty()){
        //     return back()->with('error','Can not checkout, please fill in your cart');
        // }
        if(!Auth::user()){
            return redirect()->route('signup_options')->with('error','Can not checkout, Please login to Continue');

        }
        if(\Cart::session('sessioncart')->isEmpty()){
            return back()->with('error','Can not checkout, please fill in your cart');
        }

        $site=SiteSetting::find(1);
        if($site->shipping>0){
            $condition = new \Darryldecode\Cart\CartCondition(array(
                'name' => 'Shipping Charges',
                'type' => 'shipping',
                'target' => 'total', // this condition will be applied to cart's total when getTotal() is called.
                'value' => '+'.$site->shipping,
                'order' => 1 // the order of calculation of cart base conditions. The bigger the later to be applied.
            ));
            \Cart::session('sessioncart')->condition($condition);

        }
        return view('site.checkout',compact('site'));
    }
    public function cart()
    {

        return view('site.cart');
    }

    public function addConsultant(Request $request){
        try{
            $user=User::findOrFail(Auth()->user()->id);
            $user->consultant_id=$request->id;
            $user->update();
            $consultant=$user->consultant['name'];
            $image=$user->consultant['image'] ?? "images/shellie-logo.jpg";
            return $data=["status"=>1,"message"=>"success","consultant"=>$consultant,"image"=>$image];
        }
        catch(Exception $e){
            return $data=[
                "status"=>0,
                "message"=>$e->getMessage(),
            ];
        }

    }

    public function sessionKit(Request $request){
        try{
            $kit=Collection::findOrFail($request->kit);
            Session::put('kit',$kit);
            return $data=["status"=>1,"price"=>$kit->sale_price,"name"=>$kit->name,"image"=>$kit->image ?? 'images/shellie-logo.jpg',"message"=>"success"];
        }
        catch(Exception $e){
            return $data=[
                "status"=>0,
                "message"=>$e->getMessage(),
            ];
        }
    }

    public function buyCollection(Request $request){
        try{

    if(isset(Auth()->user()->consultant)){
            if(!$request->has('ship')){
            $validator = Validator::make($request->all(), [
                "first_name"=> 'required',
                "last_name"=> 'required',
                "date_of_birth" => 'required',
                "social_security_number" => 'required',
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
                "fax"  => 'required',
                "pm"  => 'required',
                "bank"  => 'required',
                "routing"  => 'required',
                "acc_no"  => 'required',
                "acc_type"  => 'required',
                "terms" => 'required',
            ]);

        }
        else{
            $validator = Validator::make($request->all(), [
                "first_name"=> 'required',
                "last_name"=> 'required',
                "date_of_birth" => 'required',
                "social_security_number" => 'required',
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
                "fax"  => 'required',
                "pm"  => 'required',
                "bank"  => 'required',
                "routing"  => 'required',
                "acc_no"  => 'required',
                "acc_type"  => 'required',
                "terms" => 'required',
            ]);

        }
            if ($validator->fails()) {
                 Session::flash('error', $validator->messages()->first());
                 return redirect()->back()->withInput();
            }
            $usr=User::findOrFail(Auth()->user()->id);
            $usr->is_consultant=1;
            $usr->update();
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
            $order->status=1;
            $order->is_kit=1;
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

            Session::forget('kit');
            $orders=Order::with('orderProducts')->whereOrderId($order->order_id)->first();
            Mail::to(Auth()->user()->email)->send(new OrderMail($orders));

            return back()->with('success','Order Created Successfully!');
        }
        else{
            return back()->with('error','Please Select Sponsor First!');
        }
        }
        catch(Exception $e){
            return back()->with('error','Something went wrong!');
        }



    }

    public function addToCart(Request $request){
        try{

            $Product = Product::whereProductId($request->id)->first();
            if($Product->in_stock<=0){
                return $data=['status'=>2,'message'=>'We Dont Have That Much Quantity In Stock!'];
            }
            if($request->has('qty') && $Product->in_stock-$request->qty<=0){
                return $data=['status'=>2,'message'=>'We Dont Have That Much Quantity In Stock!'];
            }

            // \Cart::session(Auth()->user()->id)->add(array(
            //     'id' => $Product->product_id,
            //     'name' => $Product->name,
            //     'price' => $Product->sale_price,
            //     'quantity' => $request->qty ?? 1,
            //     'attributes' => array(),
            //     'associatedModel' => $Product
            // ));
            \Cart::session('sessioncart')->add(array(
                'id' => $Product->product_id,
                'name' => $Product->name,
                'price' => $Product->sale_price,
                'quantity' => $request->qty ?? 1,
                'attributes' => array(),
                'associatedModel' => $Product
            ));

        if($request->has('qty')){
            $view=view('site.ajax-side-cart')->render();
            return $data=['status'=>3,'message'=>'Success!','view'=>$view];
        }
        // $quantity=\Cart::session(Auth()->user()->id)->getTotalQuantity();
        $quantity=\Cart::session('sessioncart')->getTotalQuantity();
        return $data=['status'=>1,'message'=>'Success!','quantity'=>$quantity];

        }
        catch(Exception $e){
            return $data=['status'=>0,'message'=>'Something went wrong!'];
        }


    }

    public function clearCart(){
    try{
        $items=\Cart::session('sessioncart')->getContent();
        // foreach($items as $row){
        //     $product=Product::whereProductId($row->id)->first();
        //     $product->in_stock+=$row->quantity;
        //     $product->update();
        // }

        // \Cart::session(Auth()->user()->id)->clear();
        \Cart::session('sessioncart')->clear();
        $view = view('site.ajax-cart')->render();
        return $data=['status'=>1,'message'=>'Success!','view'=>$view];
    }
    catch(Exception $e){
        return $data=['status'=>0,'message'=>'Something went wrong!'];
    }
    }

    public function minusQuantity(Request $request){
        try{

            // \Cart::session(Auth()->user()->id)->update($request->id, array(
        //     'quantity' => -1,
        //   ));

        \Cart::session('sessioncart')->update($request->id, array(
            'quantity' => -1,
          ));

          //   $product=Product::whereProductId($request->id)->first();
        //   $product->in_stock+=1;
        //   $product->update();
          $view = view('site.ajax-cart')->render();
          return $data=['status'=>1,'message'=>'Success!','view'=>$view];
        }
        catch(Exception $e){
            return $data=['status'=>0,'message'=>'Something went wrong!'];
        }
    }

    public function plusQuantity(Request $request){
        try{

        // \Cart::session(Auth()->user()->id)->update($request->id, array(
        //     'quantity' => 1,
        //   ));

        \Cart::session('sessioncart')->update($request->id, array(
            'quantity' => 1,
          ));
          $Product = Product::whereProductId($request->id)->first();
          if($Product->in_stock<=0){
            return $data=['status'=>2,'message'=>'We Dont Have That Much Quantity In Stock!'];
            }
        //   $product=Product::whereProductId($request->id)->first();
        //   $product->in_stock-=1;
        //   $product->update();
          $view = view('site.ajax-cart')->render();
          return $data=['status'=>1,'message'=>'Success!','view'=>$view];
        }
        catch(Exception $e){
            return $data=['status'=>0,'message'=>'Something went wrong!'];
        }
    }

    public function removeProduct(Request $request){
        try{
            // $item=\Cart::session(Auth()->user()->id)->get($request->id);
            $item=\Cart::session('sessioncart')->get($request->id);
            // $product=Product::whereProductId($request->id)->first();
            // $product->in_stock+=$item->quantity;
            // $product->update();

            // \Cart::session(Auth()->user()->id)->remove($request->id);

            \Cart::session('sessioncart')->remove($request->id);
            $view = view('site.ajax-cart')->render();
            return $data=['status'=>1,'message'=>'Success!','view'=>$view];

        }
        catch(Exception $e){
            return $data=['status'=>0,'message'=>'Something went wrong!'];
        }

    }

    public function submitContactUs(ContactUsRequest $request){
    try{





            $contact=new ContactUs;
            $contact->name=$request->name;
            $contact->email=$request->email;
            $contact->subject=$request->subject;
            $contact->message=$request->message;
            $contact->save();


            return back()->with('success','Contacted Successfully!');

    }
    catch(Exception $e){
        return back()->with('error','Something went wrong!');

    }



    }

    public function pricingList()
    {
        return view('site.pricing2');
    }
    public function consultantRegister()
    {

        return view('auth.consultant-register');
    }
    public function signupopt(){
        return view('site.SignupOptions');
    }
    public function privacy_policy(){
        return view('site.privacy');
    }
    public function compansation(){
        return view('site.compensation');
    }


}
