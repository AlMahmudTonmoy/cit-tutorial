<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    protected $fillable = ['product_name', 'category_id', 'product_price','product_quantity', 'alert_quantity', 'product_photo'];
    function relationtocategorytable(){
      return $this->hasOne('App\Category', 'id', 'category_id');
    }
    function relationtoproductgallerytable(){
      return $this->hasMany('App\Product_gallery', 'product_id', 'id' );
    }
}
