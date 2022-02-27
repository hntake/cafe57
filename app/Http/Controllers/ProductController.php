<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // DB ファサードを use する
use Illuminate\Support\Facades\Auth; //ログインステイタスをもらうため


use App\Product;
use App\Order;
use App\Out;
use App\Ship;
use App\User;

use Psy\Command\WhereamiCommand;

class ProductController extends Controller
{
    /**
     * 在庫一覧表示
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $products = Product::orderBy('created_at', 'asc')->get();
        return view('products', [
            'products' => $products,
        ]);
    }
    /**
     * 注文申請への遷移と注文データの受け渡し
     *
     * @param Request $request
     * @return Response
     */
    //idを指定する
    public function order(Request $request, $product_id)
    {
        //注文数を計算
        $stock = Product::where('id', $product_id)
            ->value('stock');
        $order_line = Product::where('id', $product_id)
            ->value('order');
        $order_number = $order_line - $stock;



        $products = Product::where('id', $request->id)->get();
        //compact関数で複数の変数を渡す
        return view('order', compact('products', 'order_number'));
    }
    /**
     * 備品登録画面へ遷移
     *
     * @param Request $request
     * @return Response
     */
    public function create(Request $request)
    {

        return view('create');
    }
    /**
     * 持ち出し申請画面へ遷移
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

        return view('out');
    }
    /**
     * 備品登録
     *
     * @param Request $request
     * @return Response
     */
    public function update(Request $request)
    {

        $this->validate($request, [
            'product_name' => 'required|max:25|unique:products',
            'stock' => 'required|max:25',
            'order' => 'required|max:25',
        ]);

        $product = new Product;
        $product->id = 0;
        $product->product_name = $request->product_name;
        $product->stock = $request->stock;
        $product->order = $request->order;
        $product->save();

        return redirect('products');
    }
    /**
     * ordersテーブルへのデータ受け渡し、在庫数に反映
     *
     * @param Request $request
     * @return Response
     */
    public function insert(Request $request)
    {
        $this->validate($request, [
            'new_order' => 'required|max:25',
            'staff' => 'required|max:25',
        ]);

        //ordersテーブルへのデータ受け渡し
        $order = new Order;
        $order->product_id = $request->product_id;
        $order->product_name = $request->product_name;
        $order->new_order = $request->new_order;
        $order->staff = $request->staff;
        $order->save();
        /* dd($order); */

        // CSRFトークンを再生成して、二重送信対策
        $request->session()->regenerateToken(); // <- この一行を追加

        //在庫数に反映
        $data = Product::where('id', $request->product_id)
            ->value('stock');


        $renew = $data + $request->new_order;

        DB::table('products')
            ->where('id', $request->product_id)
            ->update([
                'stock' => $renew
            ]);

        $orders = Order::orderBy('created_at', 'asc')->get();
        return view('order_table', [
            'orders' => $orders,
        ]);
    }
    /**
     * 注文一覧表示
     *
     * @param Request $request
     * @return Response
     */
    public function order_table(Request $request)
    {
        $orders = Order::orderBy('created_at', 'asc')->get();
        return view('order_table', [
            'orders' => $orders,
        ]);
    }




    /**
     *
     *メール作成フォームに遷移

     * @param Request $request
     * @return Response
     * */
    public function form(Request $request)

    {
        return view('form');
    }
    /**
     *
     *送信済みを選んだものをshipsテーブルに入力し、注文表からは削除。注文番号確認画面へ遷移

     * @param Request $request
     * @return Response
     * */
    public function ship(Request $request)

    {
        //管理者だったら
        $user = Auth::user();
        if ($user->user_type === 2) {

            //value1or2をOrderテーブルに入力
            $list = $request->order;
            foreach ($list as $value) {

                DB::table('orders')
                    ->where('product_id', $value['product_id'])
                    ->update([
                        'status' => $value['status']
                    ]);
            }
            // shipsテーブルへ送る注文を指定
            $data = Order::where('status', '=', '1')
                ->first();

            //shipsテーブルへのデータ受け渡し
            $ship = new Ship;
            $ship->product_name = $data->product_name;
            $ship->new_order = $data->new_order;
            $ship->save();

            //status=1を削除する
            $data->delete();

            /* dd('test'); */
            return view('ship', [
                'ship' => $ship
            ]);
        } else {
            return redirect()->route('home_screen');
        }
    }

    //持ち出し申請→outテーブルへの登録
    public function subtract(Request $request)
    {
        //productsテーブルに型番があるか確認
       /*  error_log("subtrac:productid " . $request->product_id . ", now startd."); */
        $product_record = Product::where('id', '=', $request->product_id)->first();

        if ( $product_record ) {
            /* error_log("subtrac:productid " . $request->product_id . " was exist."); */
            $this->validate($request, [
                'product_id' => 'required|max:25',
                'out_amount' => 'required|max:25',
                'staff' => 'required|max:25',
            ]);
           /*  error_log("subtrac:validation is okay."); */

             $stock=Product::where('id', '=', $request->product_id)->value('stock');

             if($stock>$request->out_amount){

                 $out = new Out;
                 $out->product_id = $request->product_id;
                 $out->out_amount = $request->out_amount;
                 $out->staff = $request->staff;
                 $out->save();
                 /* error_log("subtrac:Out table was updated."); */

                 //在庫表への反映→在庫表へ遷移
                 $data = Product::where('id', $request->product_id)
                     ->value('stock');

                 $subtract = $data - $request->out_amount;

                 DB::table('products')
                     ->where('id', $request->product_id)
                     ->update([
                         'stock' => $subtract
                     ]);

                 /* error_log("subtrac:products table was updated."); */

             return redirect('products');
             }
             else {
                 return trans('validation.numeric');

        }
    }
        else {

            return trans('validation.accepted');
        }
    }
}
