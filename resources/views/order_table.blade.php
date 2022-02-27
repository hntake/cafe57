@extends('layouts.app')
<link rel="stylesheet" href="{{ asset('css/products.css') }}"> <!-- products.cssと連携 -->

@section('script')

@endsection

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

<!--注文表一覧画面-->
<div class="table-responsive">
    <p>注文一覧表</p>
    <!--  //formからmailにそして、shipに名前変更// -->
    <form action="{{ route('ship') }}" method="GET">
        <table class="table-hover">
            <thead>
                <tr>
                    <th>型番</th>
                    <th>品目</th>
                    <th>数量</th>
                    <th>従業員名</th>
                    <th>注文済</th>


                </tr>
            </thead>
            <tbody id="tbl">
                @foreach ($orders as $order)
                <tr>

                    <td style="width:20% ">{{ $order->product_id }}</td>
                    <td style="width:20%">{{ $order->product_name }}</td>
                    <td style="width:20%">{{ $order->new_order }}</td>
                    <td style="width:20%">{{ $order->staff }}</td>
                    <td>
                        <div class="radio" style="width: 20%">

                            <p ><input type="radio" name="order[{{ $order->product_id }}][status]" value="1" class="radio-buttom-1" required>送信済み</p>
                            <p ><input type="radio" name="order[{{ $order->product_id }}][status]" value="2" class="radio-buttom-1" required>保留</p>
                            <input type="hidden" name="order[{{ $order->product_id }}][product_id]" value="{{ $order->product_id }}">
                        </div>
                    </td>

                    </td>
                </tr>
                @endforeach
                <!-- //formからmailにそしてshipに名前変更// -->
                <div class="button">
                <input type="submit" href="{{ route('ship') }}" value="注文番号確認" >
                </div>
            </tbody>
            @yield('script')
        </table>
    </form>

</div>
@endsection
