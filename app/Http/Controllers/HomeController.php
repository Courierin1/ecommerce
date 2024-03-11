<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Category,SiteSetting,Order,UserDetail,Coupon,User};
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Session;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('status',1)->get();
        return view('site.home',[
            'categories'=>$categories->toArray()
        ]);
    }
    public function profile()
    {
        $orders=Order::where('user_id',Auth()->user()->id)->orderBy('id','DESC')->paginate(10);
        $users=User::where('consultant_id',Auth()->user()->id)->get('id')->toArray();
        $aorders=Order::whereIn('user_id',$users)->orderBy('id','DESC')->paginate(10);
        return view('site.my-profile',compact('orders','aorders'));
    }

    public function personal(Request $request){

        try{

            $validator = Validator::make($request->all(), [
                "first_name"=> 'required',
                "last_name"=> 'required',
                "ssn" =>  ['required','regex:/^(?!(000|666|9))\d{3}-(?!00)\d{2}-(?!0000)\d{4}$/'],
                'image' => 'bail|sometimes|image|mimes:jpg,png,jpeg',
            ]);

                if ($validator->fails()) {
                     Session::flash('error', $validator->messages()->first());
                     return redirect()->back()->withInput();
                }

            $user=UserDetail::where('user_id',Auth()->user()->id)->first();
            $user->first_name=$request->first_name;
            $user->last_name=$request->last_name;
            $user->ssn=$request->ssn;
            $user->update();
            $usr=User::findOrFail(Auth()->user()->id);
            $image = null;
            if($request->has('image')){
                $file = $request->image;
                $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
                $file->storeAs("public/user/$user->unique_id/",$image_name);
                $image = URL::to(Storage::url("public/user/$user->unique_id/".$image_name));
            }
            $usr->image=$image;
            $usr->update();

            return back()->with('success','Personal Information Updated Successfully!');
        }
        catch(Exception $e){
            return back()->with('error','Something went wrong!');
        }

    }

    public function address(Request $request){
    try{
        if(!$request->has('bill') && !$request->has('ship')){
            return back()->with('error','Please Select Either You Have To Update Billing Or Shipping Address!');
        }
        else{

            $validator = Validator::make($request->all(), [
                "street_1"=> 'required',
                "street_2"=> 'required',
                "postal_code" => 'required',
                "city" => 'required',
                "state" => 'required',
                "country" => 'required',
            ]);

                if ($validator->fails()) {
                     Session::flash('error', $validator->messages()->first());
                     return redirect()->back()->withInput();
                }

            if($request->has('bill')){
                $user=UserDetail::where('user_id',Auth()->user()->id)->first();
                $user->bill_street_1=$request->street_1;
                $user->bill_street_2=$request->street_2;
                $user->bill_postal_code=$request->postal_code;
                $user->bill_city=$request->city;
                $user->bill_state=$request->state;
                $user->bill_country=$request->country;

            }

            if($request->has('ship')){
                $user=UserDetail::where('user_id',Auth()->user()->id)->first();
                $user->ship_street_1=$request->street_1;
                $user->ship_street_2=$request->street_2;
                $user->ship_postal_code=$request->postal_code;
                $user->ship_city=$request->city;
                $user->ship_state=$request->state;
                $user->ship_country=$request->country;


            }

            $user->update();
            return back()->with('success','Address Updated Successfully!');
        }

    }
    catch(Exception $e){
        return back()->with('error','Something went wrong!');
    }
    }

        public function orderSuccess($id){
            try{
                $order=Order::with('orderProducts')->whereOrderId($id)->first();

                return view('site.order-success',compact('order'));

            }
            catch(Exception $e){
                return back()->with('error','Order Not Found!');

            }


        }

        public function orderDetails($id){
            try{
                $order=Order::with('orderProducts')->whereOrderId($id)->first();

                return view('site.order-details',compact('order'));



            }
            catch(Exception $e){
                return back()->with('error','Order Details Not Found!');
            }



        }

        public function applyCoupon(Request $request){
            try{
                $coupon=Coupon::whereCode($request->code)->first();
                if($coupon){
                if($coupon->expiry_date<=date('Y-m-d')){
                    return $data=["status"=>2,"message"=>"Coupon has expired!"];
                }
                else if($coupon->status!=1){
                    return $data=["status"=>2,"message"=>"Coupon is no more available!"];
                }
                else if(\Cart::session(Auth()->user()->id)->getTotal()< \Cart::session(Auth()->user()->id)->getTotal()*($coupon->discount/100)){
                    return $data=["status"=>2,"message"=>"Cannot Apply Coupon. Because The Discount Amount Cannot Be More Than Order Amount!"];
                }
                else{
                Session::put('coupon',$coupon);
                $site=SiteSetting::find(1);
                $view=view('site.ajax-checkout',compact('site'))->render();
                return $data=["status"=>1,"message"=>"Success!","view"=>$view];
                }
            }
            else{
                return $data=["status"=>2,"message"=>"No Coupon Found!"];
            }

            }
            catch(\Exception $e){

                return $data=["status"=>0,"message"=>"Something went wrong!"];
            }

        }

        public function removeCoupon(){
        try{
            if(Session::has('coupon')){
                Session::forget('coupon');
                $site=SiteSetting::find(1);
                $view=view('site.ajax-checkout',compact('site'))->render();
                return $data=["status"=>1,"message"=>"Success!","view"=>$view];

            }
            else{
                return $data=["status"=>2,"message"=>"No Coupon Found. Please Reload The Page!"];
            }


        }
        catch(\Exception $e){

            return $data=["status"=>0,"message"=>"Something went wrong!"];
        }
        }
        public function member_dashboard(){
            return view('member.dashboard');
        }
        public function payment_setting(){
            return view('member.payment');
        }
        public function past_transactions(){

                $data = Order::join('order_products' , 'order_products.order_id' , '=' , 'orders.order_id');
                if(Auth::user()->role==2){
                 $data =$data->join('products' , 'products.sku' , '=' , 'order_products.sku');
                }
                $data =$data->where('orders.user_id' , Auth::id())
                ->get();

            return view('member.past_transaction' , compact('data'));
        }
        public function DeleteTransaction($id){

            Order::where('order_id' , $id)->delete();
            return redirect()->back()->with('success' , 'Transaction Deleted Successfully');
        }
        public function member_information(){
            $user = Auth::user();

            return view('member.account_information' , compact('user'));
        }
        public function payment_details(){
            return view('member.payment_details');
        }
        public function edit_payments(){
            return view('member.edit_payments');
        }
        public function edit_accounts(){
            $user = Auth::user();

            return view('member.edit_accounts' , compact('user'));
        }
        public function store_account(Request $request){
            $input = $request->all();
            User::where('id' , Auth::id())->update([
                'name'=>$request->name,
                'user_name'=>$request->user_name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'zip'=>$request->zip,
                'city'=>$request->city,
                'state'=>$request->state,
                'country'=>$request->country,

            ]);
            return redirect('/user/account-information');
        }
        public function edit_password(){
            return view('member.edit_password');
        }
        public function changePasswordStore(Request $request){
            User::where('id' , Auth::id())->update([
                'password' => Hash::make($request['pass']),
            ]);
            return view('member.edit_password');
        }
}
