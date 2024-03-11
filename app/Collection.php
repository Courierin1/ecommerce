<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $primaryKey = "collection_id";

    protected $fillable = ['parent_id','name', "description", "slug", "image", "status", "regular_price", "sale_price"];
}
