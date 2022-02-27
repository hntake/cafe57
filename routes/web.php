<!-- ルーティング -->
<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () { // Laravel簡易サーバーを開いた時に最初に表示される画面を表示
    return view('welcome');   // welcome.blade.phpを表示する。
});

//新規登録画面の表示
Route::get('/signup_form', 'UsersController@signup_form')->name('signup_form');
Route::post('/signup', 'UsersController@signup')->name('signup'); // 新規登録の処理

//ログイン画面へ遷移
Route::get('/login_form', 'UsersController@login_form')->name('login_form');
Route::post('/login', 'UsersController@login')->name('login'); // ログイン認証
Route::post('/logout', 'UsersController@logout')->name('logout'); // ログアウト

//ホーム画面へ遷移
Route::get('/home_screen', 'ChatController@home_screen')->name('home_screen');

//チャット登録
Route::post('/chat', 'ChatController@chat')->name('chat');
Route::get('/chat_delete/{id}', 'ChatController@chat_delete')->name('chat_delete'); //チャット削除

//以下をログインしないとアクセス出来ないようにする
Route::middleware('auth')->group(function () {

//在庫一覧画面の表示
Route::get('/products', 'ProductController@index')->name('products');
Route::post('/products_process', 'UsersController@home')->name('products_process'); // 在庫一覧画面の処理

//新規備品登録画面へ遷移
Route::get('/create', 'ProductController@create')->name('create');

//注文申請画面へ遷移
Route::get('cafe57/public/order/{id}', 'ProductController@order')->name('order');


//持ち出し申請submit
Route::post('/update', 'ProductController@update')->name('products');

//持ち出し申請画面へ遷移
Route::get('/store', 'ProductController@store')->name('store');

//備品登録submit
Route::post('/subtract', 'ProductController@subtract')->name('products');

//orderテーブルへのデータ受け渡し
Route::post('/insert', 'ProductController@insert')->name('order_table');

//注文表画面表示
Route::get('/order_table', 'ProductController@order_table')->name('order_table');

//Mailableを使った
Route::get('/form', 'MailController@form');
Route::post('/form', 'MailController@send');


//注文番号確認画面へ遷移
Route::get('/ship', 'ProductController@ship')->name('ship');
//注文メール送信画面へ遷移
Route::get('/form2', 'ProductController@form')->name('form');

});


