@extends('layouts.app')


@section('script')
  <script>
  $(function(){
  $(".btn-dell").click(function(){
  if(confirm("本当に削除しますか？")){
  //そのままsubmit（削除）
  }else{
  //cancel
  return false;
  }
  });
  });
  </script>
@endsection

@section('content')



<!--注文表一覧画面-->
<div class="table-responsive">
    <p>注文一覧表</p>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>型番</th>
            <th>品目</th>
            <th>数量</th>
            <th>従業員名</th>
            <th>注文済</th>
            <th>削除</th>

        </tr>
        </thead>
        <tbody id="tbl">
        @foreach ($orders as $order)
            <tr>

                <td>{{ $order->product_id }}</td>
                <td>{{ $order->product_name }}</td>
                <td>{{ $order->new_order }}</td>
                <td>{{ $order->staff }}</td>
                <td><div>
                        <label for="checkbox">送信する</label>
                        <input type="checkbox" id="checkbox" name="check[]" value="0">
                    </div>
                </td>
                <!-- <td><form action="/delete/{{$order->id}}" method="POST">

                        <input type="submit" value="削除" class="btn btn-danger btn-sm btn-dell">
                    </form>


                </td> -->
            </tr>
        @endforeach
        </tbody>
        @yield('script')
    </table>
    <a href="{{ route('form') }}">注文メール作成</a>
</div>
@endsection

