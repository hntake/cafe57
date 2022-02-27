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


<div class="table-responsive">
    <p>注文番号確認</p>
    <table class="table table-hover">
        <thead>
            <tr>
                <th>注文番号</th>
                <th>品目</th>
                <th>注文数量</th>
                <th>注文日付</th>
            </tr>
        </thead>
        <tbody id="tbl">

            <tr>
                <td>{{ $ship->id }}</td>
                <td>{{ $ship->product_name }}</td>
                <td>{{ $ship->new_order }}</td>
                <td>{{ $ship->created_at}}</td>

                {{csrf_field()}}

            </tr>

        </tbody>
    </table>
    <div class="button">
        <a href="{{ route('form') }}">メール作成</a>
    </div>
</div>
@endsection
