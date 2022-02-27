@extends('layouts.app')

@section('content')

<!-- 送信メールフォームパネル… -->
<div class="panel-body">
    <!-- バリデーションエラーの表示 -->
    @include('common.errors')

<form action="{{ url('send') }}" method='POST'>
    @csrf
    <div class="form-group">
    <label for="product-name" class="col-sm-3 control-label">注文メール送信フォーム</label>

    <div class="col-sm-6">
        <p>送信先</p>
        <input type="text" name="company_name" value="{{ old('company_name') }}" class="form-control">
        @if ($errors->has('company_name'))
        <p class="bg-danger">{{ $errors->first('company_name') }}</p>
        @endif
    </div>
        <div>
            発注依頼<br>
            平素は大変お世話になっております。<br>
            下記の商品を注文します。ご手配のほど、宜しくお願い致します。
        </div>
    <div>
        <p>希望納期</p>
        <input type="text" name="due_date" value="{{ old('due_date') }}" class="form-control">
        @if ($errors->has('due_date'))
        <p class="bg-danger">{{ $errors->first('due_date') }}</p>
        @endif
    </div>
        <p>納品先</p>
        <input type="text" name="ship_to" value="{{ old('ship_to') }}" class="form-control">
        @if ($errors->has('ship_to'))
        <p class="bg-danger">{{ $errors->first('ship_to') }}</p>
        @endif
    <div>
        <p>担当名</p>
        <input type="text" name="attend" value="{{ old('attend') }}" class="form-control">
        @if ($errors->has('attend'))
        <p class="bg-danger">{{ $errors->first('attend') }}</p>
        @endif
    </div>

    <div class="form-group">
            @foreach ($orders as $order)

            <form action="mail" id="product_id" method="POST">
                {{ csrf_field()}}
                <div class="col-sm-6">
                    <label>型番</label>
                    {{ $order->product_id  }}
                    <input type="hidden" name="product_id" value="{{ $order->oruduct_id }}" />
                </div>
                <div class="col-sm-6">
                    <label>品目</label>
                    {{ $order->product_name  }}
                    <input type="hidden" name="product_name" value="{{ $order->oruduct_name }}" />
                </div>
                <div class="col-sm-6">
                    <label>数量</label>
                    {{ $order->new_order }}
                    <input type="hidden" name="new_order" value="{{ $order->new_order }}" />
                </div>


                @endforeach


        <p><input type="submit" value="送信" class="btn"></p>

    </div>
</form>


@if (Session::has('succsss'))
<div>
    <p class="bg-warning text-center">{{ Session::get('success')}}</p>
</div>
@endif
