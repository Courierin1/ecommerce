<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLinkProduct extends Model
{
    protected $table = "category_link_products";
    protected $primaryKey = "id";

    protected $fillable = [
        'product_id', 'category_id',
    ];
}
