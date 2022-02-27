<!-- 在庫一覧画面のView -->

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
<div class="table-responsive" >
    <p>在庫一覧表</p>
    <table class="table-hover">
        <thead>
            <tr>
                <th style="width:20%">型番</th>
                <th style="width:20%">品目</th>
                <th style="width:20%">在庫数</th>
                <th style="width:20%">発注ライン</th>
                <th style="width:20%">アラート</th>
            </tr>
        </thead>
        <tbody id="tbl">
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->product_name }}</td>
                <td>{{ $product->stock }}</td>
                <td>{{ $product->order }}</td>
                <!-- <アラートボタン表示> -->
                <td class="alert"> @if( $product->stock < $product->order )
                <a href="{{ route('order', $product->id) }}">{{$product->id}}</a>
                {{csrf_field()}}
                <!-- <input type="hidden" name="id" value="{{ $product->id }}" />
                <input type="hidden" name="product_name" value="{{ $product->product_name }}" /> -->
                <!-- <input type="submit"> -->
                @endif</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="button">
        <a href="{{ route('create') }}">登録</a>
        <a href="{{ route('store') }}">持ち出し</a>
    </div>
</div>
@endsection


