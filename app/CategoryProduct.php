<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_products';

    protected $fillable = [
        'category_id','product_id'
    ];

    public function categories(){
        return $this->belongsTo('App\Category','category_id');
    }
    public function products(){
        return $this->belongsTo('App\Product','product_id');
    }
}
