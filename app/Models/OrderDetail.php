<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;
use App\Models\Order;

class OrderDetail extends Model
{

    use HasFactory;

    protected $guard='order_details';

    protected $fillable=[
        'user_id',
        
        'order_id',
        'product_id',
        'qty',
        'price'
      
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    
    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }    

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }

}
