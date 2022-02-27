<?php

//namespace App\Models;
namespace App;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Out extends Model
{
    /* use HasFactory; */

    protected $fillable = ['id','product_id','out_amount','staff'];
}
