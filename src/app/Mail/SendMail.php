<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;      //追加

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)      //引数を追加
    {
        $this->data = $data;      //追加
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view($this->data['message'])
            ->from($this->data['from_mail'], $this->data['sender'])    //送信者のメアド、名前
            ->cc($this->data['cc'])
            ->subject($this->data['subject'])   //件名
            ->with('data', $this->data);    //MailService で獲得した data 格納
    }
}
