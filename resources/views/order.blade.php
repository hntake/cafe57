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
<!-- 注文申請用パネル… -->
<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

    <!-- 注文申請フォーム -->
    <form action="{{ url('insert') }}" method="POST" class="form-horizontal">
        {{ csrf_field() }}

        <!-- 備品データ名 -->
        <div class="form-group">
            @foreach ($products as $product)
            <label for="product-name" class="col-sm-3 control-label">注文申請</label>
            <form action="insert" id="new_order" method="POST">
                {{ csrf_field()}}
                <div class="col-sm-6">
                    <label>型番</label>
                    {{ $product->id  }}
                    <input type="hidden" name="product_id" value="{{ $product->id  }}" />
                </div>

                <div class="col-sm-6">
                    <label>品目</label>
                    {{ $product->product_name }}
                    <input type="hidden" name="product_name" value="{{ $product->product_name  }}" />
                </div>
                <div class="col-sm-6">
                    <label>数量</label>
                    {{$order_number}}
                    <input type="hidden" name="new_order" value="{{$order_number}}"/>
                </div>
                <div class="col-sm-6">
                    <label>従業員名</label>
                    <input type="text" name="staff" id="staff" class="form-control">
                </div>
                @endforeach
        </div>

        <!-- 注文登録ボタン -->
        <div class="button">
            <div class="col-sm-offset-3 col-sm-6">
                <button type="submit" class="btn btn-default">
                    <i class="fa fa-plus"></i> 申請する
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
