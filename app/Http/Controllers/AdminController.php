<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Storage;
use App\{Category, EmailNotification, Notification,Collection,Product,User,Order,SiteSetting,Coupon};
use App\Http\Requests\SiteSettingRequest;
use App\Imports\BulkImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\Traits\{NotificationTrait};
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    use NotificationTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


  public function profile()
  {
      $user = User::find(auth()->id());

      return view('admin.profile', compact('user'));
  }

  public function updateProfile(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'user_name' => 'required',
          'email' => 'required',
          'password'   => 'sometimes|same:confirm-password',
      ]);

      if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
      }

      try {
            // DB::beginTransaction();

            $user = User::findOrFail(auth()->id());

            $input = $request->only(['name', 'user_name', 'email', 'phone', 'address']);
            if($request->has('password') && $request->get('password') != null) {
                $input['password'] = Hash::make($request->get('password'));
            }

            $user->update($input);

            // DB::commit();
            return redirect()->back()->withSuccess('Profile Updated Successfully');
      }
      catch(\Exception $e) {
        //   DB::rollback();
          return redirect()->back()->withError('Something went wrong');
      }
  }


    public function notification_list()
    {
        $notifications = Notification::where('user_id', auth()->id())
        ->where('seen',0)
        ->orderBy('created_at', 'DESC')
        ->take(50)
        ->get();

        return view('admin.notification', compact('notifications'));
    }

    public function notification_destroy($id)
    {
      try {
            $notification = Notification::find($id);

            $notification->delete();

            return response()->json(['code' => '200', 'message'=> 'Success']);
        }
        catch (\Exception $e){
            return response()->json(['code' => '500','message'=> 'Something went wrong!']);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.dashboard');
    }
    public function category()
    {
        $category = Category::orderBy('created_at', 'DESC')->with('parent_category')->get()->toArray();
        // $rootCategory = Category::where('status',1)->whereNull('parent_id')->with(['subcategories'=>function($query){
        //     return $query->where('category_id','!=','parent_id');
        // }])->get()->toArray();
        $rootCategory = Category::where('status', 1)->whereNull('parent_id')->with('subcategories')->get()->toArray();
        foreach ($rootCategory as $key => $value) {
            if (count($value['subcategories'])) {
                unset($rootCategory[$key]['subcategories']);
                // unset($rootCategory[$key]);
            }
        }
        return view('admin.category', ['category' => $category, 'rootCategory' => $rootCategory]);
        // echo "<pre>";
        // print_r(['category' => $category, 'rootCategory' => $rootCategory]);
    }
    public function categoryAdd()
    {
        // https://laracasts.com/discuss/channels/eloquent/eloquent-category-and-other
        $rootCategory = Category::where('status', 1)->whereNull('parent_id')->get()->toArray();
        return view('admin.category-add', ['category' => $rootCategory]);
    }

    public function categoryStore(Request $request)
    {

        $validation = Validator::make($request->all(), [
            "category_name" => 'required',
            "category_slug" => 'required',
            "category_image" => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        } else {
            // print_r($request->all());
            $category_image = "";
            if(request()->file('category_image')){
                $file = request()->file('category_image');
                $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
                $file->storeAs("public/categories/",$image_name);
                $category_image = URL::to(Storage::url('public/categories/'.$image_name));
            }
            $category = new Category([
                'name' => $request['category_name'],
                'description' => $request['category_desc'],
                'slug' => $request['category_slug'],
                'image' => ($category_image) ? $category_image : "",
                'status' => 1,
            ]);
            if ($category->save()) {
                return back()->with('success', 'Save Successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }
    }
    public function categoryEditView($id)
    {
        $category = Category::findOrFail($id);
        // echo "<pre>";
        // print_r($category->toArray());
        return view('admin.category-edit', ['category' => $category->toArray()]);
    }
    public function categoryEdit(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "category_name" => 'required',
            "category_slug" => 'required',
            "category_image" => 'image|mimes:jpeg,png,jpg|max:10240',
            // "category_slug" => 'required',
        ]);
        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        } else {
            $categoryToUpdate = [];
            if ($request->has('parent_category')) {
                $categoryToUpdate['parent_id'] = ($request['parent_category']) ? $request['parent_category'] : null;
            }
            if ($request->has('category_slug')) {
                $categoryToUpdate['slug'] = $request['category_slug'];
            }
            if ($request->has('category_name')) {
                $categoryToUpdate['name'] = $request['category_name'];
            }
            if ($request->has('category_desc')) {
                $categoryToUpdate['description'] = $request['category_desc'];
            }
            if (request()->file('category_image')) {
                $file = request()->file('category_image');
                $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
                $file->storeAs("public/categories/",$image_name);
                $category_image = URL::to(Storage::url('public/categories/'.$image_name));
                $categoryToUpdate['image'] = $category_image;
            }
            if(!$request->has('old_category_image')){
                $categoryToUpdate['image'] = null;
            }
            if ($request->has('status')) {
                $categoryToUpdate['status'] = 1;
            } else {
                $categoryToUpdate['status'] = 0;
            }
            $rowCount = Category::find($id)->update($categoryToUpdate);
            if ($rowCount) {
                return back()->with('success', 'Update Successfully');
            }
            // print_r($categoryToUpdate);
        }
    }
    public function categoryRemove($id)
    {
        $rowParent = Category::where('category_id', $id)->whereNull('parent_id')->firstOrFail();
        if (!$rowParent) {
            $rowChild = Category::where('category_id', $id)->first();
            $rowChild->delete();
            return back()->with('success', 'Record delete Successfully');
            // return back()->with('error', 'Cant remove this record! first edit the parent to null');
        } else {
            $rowParent->delete();
            return back()->with('success', 'Record delete Successfully');
        }
    }

    public function collection()
    {
        $collection  = Collection::orderBy('created_at', 'desc')->get()->toArray();
        // echo "<pre>";
        // print_r($collection);
        return view('admin.collection',['collection' => $collection]);
    }

    public function collectionAdd()
    {
        return view('admin.collection-add');
    }

    public function collectionStore(Request $request)
    {
        $validation = Validator::make($request->all(), [
            "name" => 'required',
            "slug" => 'required',
            "regular_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
            "sale_price" => 'regex:/^\d+(\.\d{1,2})?$/',
            "image" => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        } else {

            $image = "";
            if(request()->file('image')){
                $file = request()->file('image');
                $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
                $file->storeAs("public/collection/",$image_name);
                $image = URL::to(Storage::url('public/collection/'.$image_name));
            }
            $collection = new Collection([
                'name' => $request['name'],
                'regular_price' => $request['regular_price'],
                'sale_price' => $request['sale_price'],
                'description' => $request['desc'],
                'slug' => $request['slug'],
                'image' => ($image) ? $image : "",
                'status' => 1,
            ]);
            if ($collection->save()) {
                return back()->with('success', 'Save Successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }
    }

    public function collectionEditView($id)
    {
        $collection = Collection::findOrFail($id);
        // echo "<pre>";
        // print_r($collection->toArray());
        return view('admin.collection-edit',['collection' => $collection->toArray()]);
    }

    public function collectionEdit(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
            "name" => 'required',
            "slug" => 'required',
            "regular_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
            "sale_price" => 'regex:/^\d+(\.\d{1,2})?$/',
            "image" => 'image|mimes:jpeg,png,jpg|max:10240',
            // "slug" => 'required',
        ]);
        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        } else {
            $collectionToUpdate = [];
            if ($request->has('name')) {
                $collectionToUpdate['name'] = $request['name'];
            }
            if ($request->has('slug')) {
                $collectionToUpdate['slug'] = $request['slug'];
            }
            if ($request->has('desc')) {
                $collectionToUpdate['description'] = $request['desc'];
            }
            if ($request->has('regular_price')) {
                $collectionToUpdate['regular_price'] = $request['regular_price'];
            }
            if ($request->has('sale_price')) {
                $collectionToUpdate['sale_price'] = $request['sale_price'];
            }
            if ($request->has('image')) {
                $file = request()->file('image');
                $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
                $extension = $file->getClientOriginalExtension();
                $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
                $file->storeAs("public/kits/",$image_name);
                $image = URL::to(Storage::url('public/kits/'.$image_name));
                $collectionToUpdate['image'] = $image;
            }
            if(!$request->has('old_image')){
                $collectionToUpdate['image'] = null;
            }
            if ($request->has('status')) {
                $collectionToUpdate['status'] = 1;
            } else {
                $collectionToUpdate['status'] = 0;
            }
            $rowCount = Collection::find($id)->update($collectionToUpdate);
            if ($rowCount) {
                return back()->with('success', 'Update Successfully');
            }

        }
        // print_r($request->all());
    }

    public function collectionRemove($id)
    {
        $rowCount = Collection::where('collection_id', $id)->firstOrFail();
        if ($rowCount) {
            $rowCount->delete();
            return back()->with('success', 'Record delete Successfully');
        } else {
            return back()->with('error', 'Cant remove this record! first edit the parent to null');
        }
    }

    public function product()
    {
        $product = Product::orderBy('created_at', 'DESC')
            ->with('categories.parent_category')

            ->get()->toArray();
        // echo "<pre>";
        // print_r($product);
        return view('admin.product', ["product" => $product]);
    }
    public function productAdd()
    {
        // $products = Product::Join('category_link_products', function($query) {
        //     $query->on('category_link_products.product_id', '=', 'products.product_id')
        //     ->where('category_link_products.category_id', 4);
        // })
        // ->groupBy('products.product_id')
        // ->select('products.*')
        // ->update([
        //     'products.regular_price' => 9.99,
        //     'products.sale_price' => 9.99,
        // ]);

        // dd($products);

        $rootCategory = Category::where(['status'=> 1, 'parent_id' =>null])->get()->toArray();

        return view('admin.product-add', ['category' => $rootCategory,]);
    }
    protected function storeImages($data, $path)
    {
        $file = $data;
        $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
        $extension = $file->getClientOriginalExtension();
        $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
        $file->storeAs($path,$image_name);
        return URL::to(Storage::url($path.$image_name));
    }
    public function productStore(Request $request)
    {
        // $path = 'public/products/';
        // if(request()->hasfile('gallery_images')){
        //     $files = request()->file('gallery_images');
        //     if(count($files)){
        //         foreach($files as $key => $value) {
        //             $gallery_images = null;

        //             $file = $value;


        //             $product_name = explode('.',$file->getClientOriginalName())[0];
        //             $product_slug = Str::slug($product_name);

        //             $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
        //             $extension = $file->getClientOriginalExtension();
        //             $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
        //             $file->storeAs($path,$image_name);

        //             $product = Product::create([
        //                 "name" => $product_name,
        //                 "short_description" => "<p><br></p>",
        //                 "long_description" => "<p><br></p>",
        //                 "slug" => $product_slug,
        //                 "in_stock" =>6,
        //                 // "sku" => $request['product_sku'],
        //                 "regular_price" => 3.33,
        //                 "sale_price" => 3.33,
        //                 "status" => 1,
        //                 'image' =>  "",
        //                 'gallery_images' => json_encode([URL::to(Storage::url($path.$image_name))], true),
        //             ]);
        //             $category = Category::find(4);
        //             $product->categories()->attach($category);

        //             // dd($product);
        //         }
        //     }
        // }
        // dd('done');


        $validation = Validator::make($request->all(), [
            // "product_type" => 'required',
            "product_name" => 'required',
            "product_slug" => 'required',
            "product_sku" => 'sometimes',
            "regular_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
            "sale_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
            "in_stock" => 'required',
            "product_category" => 'required',
            "product_image" => 'image|mimes:jpeg,png,jpg|max:10240',
            "gallery_images.*" => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validation->fails()) {
            return back()->with('errors', $validation->errors());
        } else {
            $product_image = "";
            $path = 'public/products/';
            $gallery_images = [];
            if(request()->file('product_image')){
                $product_image = self::storeImages(request()->file('product_image'), $path);
            }
            if(request()->hasfile('gallery_images')){
                $files = request()->file('gallery_images');
                if(count($files)){
                    foreach($files as $key => $value) {
                        array_push($gallery_images, self::storeImages($value, $path));
                    }
                }
                else{
                    array_push($gallery_images, self::storeImages($files, $path));
                }
            }
            $product = new Product([
                "name" => $request['product_name'],
                "short_description" => $request['short_description'],
                "long_description" => $request['long_description'],
                "slug" => $request['product_slug'],
                "in_stock" => $request['in_stock'],
                // "sku" => $request['product_sku'],
                "regular_price" => $request['regular_price'],
                "sale_price" => $request['sale_price'],
                "status" => 1,
                'image' =>  ($product_image) ? $product_image : "",
                'gallery_images' => json_encode($gallery_images, true),
            ]);
            if ($product->save()) {
                // link category
                $category = Category::find($request['product_category']);
                $product->categories()->attach($category);


                return back()->with('success', 'Save Successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }
    }
    public function productShow($id)
    {
        $product = Product::where("product_id", $id)
            ->with('categories.parent_category')
            ->first()->toArray();
        $rootCategory = Category::where(['status'=> 1, 'parent_id' =>null])->with('subcategories')->get()->toArray();
        // echo "<pre>";
        // print_r($product);
        // print_r($rootCollection);
        return view('admin.product-edit', [
            'product' => $product,
            'category' => $rootCategory,
        ]);
    }
    public function productRemove($id)
    {
        $rowCount = Product::where('product_id', $id)->delete();
        if ($rowCount) {
            return back()->with('success', 'Record delete Successfully');
        } else {
            // print_r($rowCount);
            return back()->with('error', 'Cant remove this record!');
        }
    }
    public function productEdit(Request $request, $id)
    {
        $validation = Validator::make($request->all(), [
             // "product_type" => 'required',
             "product_name" => 'required',
             "product_slug" => 'required',
            //  "product_sku" => 'required',
             "regular_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
             "sale_price" => 'required|regex:/^\d+(\.\d{1,2})?$/',
             "in_stock" => 'required',
             "product_category" => 'required',
             "product_image" => 'image|mimes:jpeg,png,jpg|max:10240',
             "gallery_images.*" => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);
        if ($validation->fails()) {
            // print_r($validation->errors());
            return back()->with('errors', $validation->errors());
        } else {

            $product = Product::findOrFail($id);

            $product->name = $request['product_name'];
            $product->short_description = ($request['short_description']) ? $request['short_description'] : "";
            $product->long_description = ($request['long_description']) ? $request['long_description'] : "";
            $product->slug = $request['product_slug'];
            $product->in_stock = $request['in_stock'];
            // $product->sku = $request['product_sku'];
            $product->regular_price = $request['regular_price'];
            $product->sale_price = $request['sale_price'];
            $product_image = "";
            $path = 'public/products/';
            $gallery_images = [];
            if(request()->file('product_image')){
                $product_image = self::storeImages(request()->file('product_image'), $path);
            }
            if(request()->hasfile('gallery_images')){
                $files = request()->file('gallery_images');
                if(isset($request['old_gallery_images'])){
                    foreach ($request['old_gallery_images'] as $key => $value){
                        array_push($gallery_images, $value);
                    }
                }
                if(count($files)){
                    foreach($files as $key => $value) {
                        array_push($gallery_images, self::storeImages($value, $path));
                    }
                }
                else{
                    array_push($gallery_images, self::storeImages($files, $path));
                }
            }
            if($request['product_image']){
                $product->image = $product_image;
            }
            if($request['gallery_images']){

                $product->gallery_images = json_encode($gallery_images, true);
            }
            // if ($request->has('product_image')) {
            //     $file = request()->file('product_image');
            //     $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
            //     $extension = $file->getClientOriginalExtension();
            //     $image_name = uniqid(pathinfo($orignalName,PATHINFO_FILENAME).'_').'.'.$extension;
            //     $file->storeAs("public/products/",$image_name);
            //     $image = URL::to(Storage::url('public/products/'.$image_name));
            //     $product->image = $image;
            // }
            if ($request->has('status')) {
                $product->status = 1;
            } else {
                $product->status = 0;
            }
            // echo "<pre>";
            // print_r($product);
            if ($product->save()) {
                // update link category
                $category = Category::find($request['product_category']);
                $product->categories()->sync($category);


                return back()->with('success', 'Record Update Successfully');
            } else {
                return back()->with('error', 'Something went wrong');
            }
        }
    }


    public function orders()
    {
        $orders=Order::orderBy('id','DESC')->get();
        return view('admin.orders',compact('orders'));
    }

    public function customer()
    {
        $users = User::where('role', 2)->with('consultant')->get()->toArray();
        // echo "<pre>";
        // print_r($users);
        return view('admin.customer',['users' => $users]);
    }

    public function customerConfirmed($id)
    {
        $user = User::find($id);
        $user->status = $user->status ? 0 : 1;

        if($user->save()){
            return back()->with('success', 'Record Update Successfully');
        }
    }

    public function siteSettings(){
        $setting=SiteSetting::find(1);
        return view('admin.settings', compact('setting'));
    }

    public function updateSiteSettings(SiteSettingRequest $request){
       try{
        $setting=SiteSetting::find(1);
        $setting->overall_comission=$request->comission;
        $setting->paypal_mode=$request->mode;
        $setting->paypal_sandbox_api_secret=$request->secret;
        $setting->paypal_sandbox_api_username=$request->username;
        $setting->paypal_sandbox_api_password=$request->password;
        $setting->paypal_currency=$request->curr;
        $setting->shipping=$request->shipping;

        $setting->update();
        return back()->with('success','Site Settings Updated Successfully!');
       }
       catch(Exception $e){
        return back()->with('error','Something went wrong!');
       }

    }

    public function emailNotification(){
        $email_notifications=EmailNotification::all();

        return view('admin.email_notification', compact('email_notifications'));
    }

    public function emailNotificationUpdate(Request $request){

        $validator = Validator::make($request->all(), [
            'email' => "required",
            'email.*' => "required",
        ]);
        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors());
        }
       try{
            EmailNotification::query()->delete();
            foreach($request->get('email') as $key => $email) {
                EmailNotification::create([
                    'email' => $email,
                ]);
            }
            return back()->with('success','Notification email Updated Successfully!');
       }
       catch(Exception $e){
        return back()->with('error','Something went wrong!');
       }

    }

    public function orderDetails($id){
        try{
            $order=Order::with('orderProducts')->whereOrderId($id)->first();

            return view('site.order-details',compact('order'));
            // ahsan


        }
        catch(Exception $e){
            return back()->with('error','Order Details Not Found!');
        }



    }

    public function orderDispatch(Request $request){
        try{
            $order=Order::whereOrderId($request->id)->first();
            $order->status=$request->order_status;
            $order->update();

            return $data=['status'=>1,'message'=>'success'];




        }
        catch(\Exception $e){
            return $data=['status'=>0,'message'=>'Something went wrong!'];
        }
    }



    public function couponIndex(){
        $coupons=Coupon::all();
        return view('admin.coupons',compact('coupons'));
    }

    public function couponCreate(){
        return view('admin.coupon-add');
    }

    public function couponStore(Request $request){
        try{
            $validation = Validator::make($request->all(), [
                // "product_type" => 'required',
                "code" => 'required|unique:coupons',
                "discount" => 'required',
                "expiry_date" => 'required|after:today',
           ]);
           if ($validation->fails()) {
               // print_r($validation->errors());
               return back()->with('errors', $validation->errors());
           }

                $coupon=new Coupon;
                $coupon->code=$request->code;
                $coupon->discount=$request->discount;
                $coupon->expiry_date=$request->expiry_date;
                $coupon->status=$request->status ?? 0;
                $coupon->save();

                return back()->with('success','Coupon Created Successfully!');

        }
        catch(\Exception $e){
            return back()->with('error','Something went wrong!');
        }
    }
    public function couponEdit($id){
        $coupon=Coupon::findOrFail($id);
        return view('admin.coupon-edit',compact('coupon'));
    }

    public function couponUpdate(Request $request,$id){
        try{

            $validation = Validator::make($request->all(), [
                // "product_type" => 'required',
                "code" => "required|unique:coupons,code,$id,id",
                "discount" => 'required',
                "expiry_date" => 'required|after:today',
           ]);
           if ($validation->fails()) {
               // print_r($validation->errors());
               return back()->with('errors', $validation->errors());
           }

                $coupon=Coupon::findOrFail($id);
                $coupon->code=$request->code;
                $coupon->discount=$request->discount;
                $coupon->expiry_date=$request->expiry_date;
                $coupon->status=$request->status ?? 0;
                $coupon->update();
                return back()->with('success', 'Coupon Updated Successfully!');
        }
        catch(\Exception $e){

            return back()->with('error','Something went wrong!');
        }
    }

    public function importCsv(Request $request){
        try{
        $validation = Validator::make($request->all(), [

            "csv" => 'required',
       ]);
       if ($validation->fails()) {
           // print_r($validation->errors());
           return back()->with('errors', $validation->errors());
       }
        config(['excel.import.startRow' => 1]);
        Excel::import(new BulkImport,$request->csv);
        return back()->with('success', 'Excel successfully imported');

    }
    catch(\Exception $e)
    {dd($e);
        return back()->with('errors', $e->getMessage());
    }

    }


    public function import(Request $request){

        return view('admin.import');

    }


}
