<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderDetail;

class Order extends Model
{
    use HasFactory,Sortable;

    protected $guard='orders';

    protected $fillable=[
        'user_id',
        'total'
    ];

    public $sortable = ['id', 'user_id','total','created_at'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function getProducts()
    {
        
        return $this->belongsTo(Product::class,'product_id');
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
