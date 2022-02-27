<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//追加
use Illuminate\Support\Facades\Validator;
use App\Mail\TestMail;      //Mailableクラス
use Illuminate\Support\Facades\Mail;


class MailController extends Controller
{
    public function form(Request $request)

    {

    return view('form', [

    ]);
}
    public function send(Request $request)
    {
        $rules = [
            'company_name' => 'required|',
            'order_id' => 'required|',
            'due_date' => 'required|date',
            'ship_to' => 'required|',
            'attend' => 'required|',
        ];




        $validator = Validator::make($request->all(), $rules);

        if($validator->fails()) {
            return redirect('/form')
            ->withErrors($validator)
            ->withInput();
        }

        $data = $validator->validate();

        Mail::to('hntake@me.com')->send(new TestMail($data));

        session()->flash('success', '送信しました！');
        return back();
    }
}
