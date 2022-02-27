<?php

// namespace App\Models;
namespace App;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Out;

class Product extends Model
{
    // use HasFactory;

    protected $fillable = ['id', 'product_name','stock','order'];

    public function order()
    {
        return $this->hasMany(Order::class);
    }
    public function out()
    {
        return $this->hasMany(Out::class);
    }

}
