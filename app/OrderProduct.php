<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    public function product()
    {
        return $this->belongsTo('App\Product', 'product_id','product_id'); // specifying the foreign key because it is non-conventional
    }

    public function kit()
    {
        return $this->belongsTo('App\Collection', 'product_id','collection_id'); // specifying the foreign key because it is non-conventional
    }
}
