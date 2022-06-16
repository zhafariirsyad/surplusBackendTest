<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    protected $fillable = [
        'product_id','image_id'
    ];

    public function images(){
        return $this->belongsTo('App\Image','image_id');
    }
    public function products(){
        return $this->belongsTo('App\Product','product_id');
    }
}
