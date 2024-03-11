<?php

namespace App;
use App\Products;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct', 'order_id','order_id');
    }
    public function slug()
    {
        return $this->belongsTo('App\Products', 'sku','sku');
    }
    public function coupon()
    {
        return $this->belongsTo('App\Coupon');
    }



}
