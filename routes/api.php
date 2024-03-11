<?php

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use App\Category;
use App\Product;
use App\Collection;
use App\User;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/zip/{code}', function (Request $request, $code) {
    $client = new \GuzzleHttp\Client();
    $response = $client->request('GET', 'https://service.zipapi.us/zipcode/'.$code.'/?X-API-KEY=js-ccc99619063d31b457dc513b52018699');
    try{
        if($response->getStatusCode() == 200) {
            $resArr = json_decode($response->getBody(), true);
            echo json_encode(["success"=>$resArr['data']]);
        }
        else {
            echo json_encode(["error"=>['Something went wrong!']]);
        }
    }
    catch(\GuzzleHttp\Exception\RequestException $e){
        echo json_encode(["error"=>['Something went wrong!']]);
    }
    catch(Exception $e){
        echo json_encode(["error"=>['Something went wrong!']]);
    }
    return;
});

Route::get('/categories', function () {
    $category = Category::where("status", 1)->get();
    if($category){
        echo json_encode(["data" => $category->toArray()]);
    }
    else{
        echo json_encode(["data" => null]);
    }
    return;
});

Route::post('/products', function (Request $request, Product $products) {
    $products = $products->query();

    if ($request->has('category')) {
        $products->whereHas('categories', function ($query) use ($request) {
            $query->whereIn('categories.slug', $request['category']);
        });
    }
    // $products->whereHas('categories', function ($query) use ($request) {
    //     $query->whereIn('categories.slug', ['necklaces']);
    // });
    // if ($request->has('minimum_price') && $request->has('maximum_price')) {
    //     $products->whereBetween('sale_price', [$request['minimum_price'], $request['maximum_price']]);
    // }
    // if ($request->has('brand')) {
    //     $products->whereHas('brands', function ($query) use ($request) {
    //         $query->whereIn('brands.brand_id', $request['brand']);
    //     });
    // }
    $products = $products->with('categories')->where('status', '1')->orderBy('name', 'ASC')->latest()->take(10)->get();
    // echo "<pre>";
    echo json_encode($products);
});

Route::get('/productss', function (Request $request, Product $products) {
    $limit = 30;
    $user = $request->user;
    $is_auth = $request->auth;
    $products = $products->query();
    $category_slug = $request->category;
    if ($request->has('category')) {
        $products->whereHas('categories', function ($query) use ($request) {
            $query->whereIn('categories.slug', $request['category']);
        });
    }

    $products = $products->with('categories')->where('status', '1')->orderBy('name', 'ASC');

    $products = $products->paginate($limit);

    $view=view('site.shop-ajax',compact('products', 'category_slug','is_auth','user'))->render();

    return $view;
});
