<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class ProductImage extends Model
{
    use HasFactory;
    protected $guard='product_images';


    protected $fillable=[
        'product_id',  
        'product_image'
       
    ];

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    } 
}
