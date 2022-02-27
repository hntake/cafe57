<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    const UPDATED_AT = null; // updated_atを無効化
    protected $fillable = [
        'user_id', 'title', 'message',
    ];

    public function user()
    {
        return $this->belongsTo('App\User'); // usersテーブルと紐づけ
    }
}


