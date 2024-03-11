<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $primaryKey = "category_id";

    protected $fillable = ['parent_id','name', "description", "slug", "image", "status"];

    public function products()
    {
        return $this->belongsToMany('App\Product', 'category_link_products','category_id','product_id')->withTimestamps(); // specifying the pivot table name because it is non-conventional
    }

    public function subcategories()
    {
        return $this->hasMany('App\Category', 'parent_id'); // specifying the foreign key because it is non-conventional
    }

    public function parent_category()
    {
        return $this->belongsTo('App\Category', 'parent_id'); // specifying the foreign key because it is non-conventional
    }
}
