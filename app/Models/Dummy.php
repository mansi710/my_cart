<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dummy extends Model
{
    use HasFactory;

    protected $guard='dummys';    
    protected $fillable = [
        'name',
        'email',
        'username',
        'phone',
        'dob',
    ];    
}
