<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Models\User;
use App\Models\Product;

class Category extends Model
{
    use HasFactory,Sortable;
    protected $guard='categories';

    protected $fillable=[
        'user_id',
        'category_name',
        'description'
    ];

    public $sortable = ['id', 'user_id','category_name', 'description','created_at'];
    

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'category_id');
    }

}
