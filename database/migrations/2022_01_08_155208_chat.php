<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Chat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chats', function (Blueprint $table) {
            $table->increments('id'); // 主キー
            $table->integer('user_id'); // usersテーブルのid
            $table->string('title'); // 件名
            $table->string('message'); // チャットの内容
            $table->timestamps(); // 登録・更新日時
            $table->dropColumn('updated_at'); // 更新日時を無効化
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chats');
    }
}
