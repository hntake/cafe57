<?php

// namespace App\Models;
namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // use HasFactory;

    protected $fillable = ['id','product_id','product_name','new_order','staff','status'];
}
