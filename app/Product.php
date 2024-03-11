<?php

namespace App;
use BinaryCats\Sku\HasSku;
use Illuminate\Database\Eloquent\Model;
use Storage;
use URL;

class Product extends Model
{
    use HasSku;
    protected $primaryKey = "product_id";
    protected $fillable = [
        'name', 
        "short_description", 
        "long_description", 
        "slug", 
        "sku", 
        "regular_price", 
        "sale_price", 
        // "discount", 
        "in_stock", 
        "status",
        'type',
        "image", 
        "gallery_images"
    ];

    public function categories()
    {
        return $this->belongsToMany('App\Category', 'category_link_products','product_id','category_id')->withTimestamps(); // specifying the pivot table name because it is non-conventional
    }


    public static function createProduct($name,$images,$short,$long=null,$slug,$stock,$reg_price,$sale_price,$category){
        $product_image="";
        $path = 'public/products/';
        $gallery_images = [];
        
           
                array_push($gallery_images, self::storeImages($images, $path));
          
        
        $product = new Product([
            "name" => $name,
            "short_description" => $short,
            "long_description" => $long ?? null,
            "slug" => $slug,
            "in_stock" => $stock,
            // "sku" => $request['product_sku'],
            "regular_price" => $reg_price,
            "sale_price" => $sale_price,
            "status" => 1,
            'image' =>  ($product_image) ? $product_image : "",
            'gallery_images' => json_encode($gallery_images, true),
        ]);
        $product->save();
            // link category
            $category = Category::find($category);
            $product->categories()->attach($category);
           

            return $product;
     
        
    }

    protected static function storeImages($data, $path) 
    {
        
        $type = pathinfo($data, PATHINFO_EXTENSION);
        $data = file_get_contents($data);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $base64 = str_replace('data:image/png;base64,', '', $base64);
        $base64 = str_replace(' ', '+', $base64);
       
        $data = base64_decode($base64);
        $image_name =  uniqid() . '.png';
        Storage::disk('product')->put($image_name, $data);
        // $data->storeAs($path,$image_name);
        // $success = file_put_contents($file, $data);
        
        // $file = $success;
        // dd($file);
        // $orignalName = preg_replace('/[^A-Za-z0-9\-]/', '', $file->getClientOriginalName());
        // $extension = $file->getClientOriginalExtension();
        // $image_name = pathinfo($orignalName,PATHINFO_FILENAME).'.'.$extension;
        // $file->storeAs($path,$image_name);
        return URL::to(Storage::url($path.$image_name));
    }

    }


