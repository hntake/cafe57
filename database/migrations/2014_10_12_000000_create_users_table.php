<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // ID(user_id)
            $table->string('name'); // 名前
            $table->string('user_name'); // ユーザー名
            $table->string('email')->unique(); // メールアドレス
            $table->timestamp('email_verified_at')->nullable(); // 登録時にメールアドレスを確認
            $table->string('password'); // パスワード
            $table->integer('user_type')->nullable(); // 従業員or管理者
            $table->rememberToken(); // ログイン維持
            $table->timestamps(); // 登録・更新日時
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
