<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\User;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Cart;
use App\Models\ProductImage;
class Product extends Model
{
    use HasFactory,Sortable;
    protected $guard='products';


    protected $fillable=[
        'category_id',
        'user_id',
        'product_name',
        'product_quantity',
        'product_price',
        'product_description',
        'product_image'
       
    ];

    public $sortable = ['id','category_id' ,'user_id','product_name', 'product_quantity','product_price','product_description','created_at'];
    

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }


    public function getCategories()
    {
        
        return $this->belongsTo(Category::class,'category_id');
    }

 

    public function orders()
    {
        return $this->belongsTo(Order::class,'product_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class,'product_id');
    }

    // public function cart()
    // {
    //     return $this->belongsTo(Cart::class,'product_id');
    // }


    public function product_images()
    {
        return $this->hasMany(ProductImage::class,'product_id');
    }
}
