<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // DB ファサードを use する
use App\Order;

class TestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;      //追加
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;      //追加
    }

    /**
     * Build the message.
     *
     * @return $this
     * @param Request $request
     * @return Response
     */
    public function build(Request $request)
    {

        return $this->view('email')
        ->subject('注文書')
        ->with('data',$this->data);
    }
}
