@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/products.css') }}"> <!-- products.cssと連携 -->
@section('content')

<div class="side"> <!-- サイドバー -->
            <p><h1>cafe57</h1></p>
            <nav class="sidebar">
                <p><a href="{{ url('products') }}"><h3>在庫一覧画面</h3></a></p>
                <p><a href="{{ url('order_table') }}"><h3>注文表画面</h3></a></p>
                <!-- <p><a href="{{ url('') }}"><h3>シフト申請画面</h3></a></p>
                <p><a href="{{ url('') }}">・シフト管理画面</a></p>
                <p><a href="{{ url('') }}">・勤怠一覧画面</a></p> -->
                <p><a href="{{ route('home_screen') }}">ホーム画面に戻る</a></p>
            </nav>
            <div class="logout_buttom">
                <form action="{{ route('logout') }}" method="post">
                    @csrf <!-- CSRF保護 -->
                    <input type="submit" value="ログアウト"> <!-- ログアウトしてログイン画面に戻る -->
                </form>
            </div>
        </div>
<!-- 備品登録用パネル… -->
<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- 新備品フォーム -->
    <form action="{{ url('update') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- 備品データ名 -->
        <div class="form-group">
            <label for="product-name" class="col-sm-3 control-label">備品登録画面</label>


            <div class="col-sm-6">
              <label>品目</label>
                <input type="text" name="product_name" id="product_name" class="form-control">
            </div>
            <div class="col-sm-6">
              <label>登録数</label>
                <input type="text" name="stock" id="stock" class="form-control">
            </div>
            <div class="col-sm-6">
              <label>発注ライン</label>
                <input type="text" name="order" id="order" class="form-control">
            </div>
        </div>

        <!-- 備品登録ボタン -->
        <div class="form-group">
            <div class="button">
                <button type="submit">
                     登録する
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
