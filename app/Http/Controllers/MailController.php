<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Transaction;
use App\Mail\SendLinkMail;

class MailController extends Controller
{
    /**
     * Send mail
     */
    public function mail(String $id) {
        $transaction = Transaction::findOrFail($id);
        $email = $transaction->email;
        $name = $transaction->name;
        $link = route('transactions.checkout',[
            'order_id' => $transaction->order_id,
            'snap_token' => $transaction->snap_token,
        ]);

        Mail::to($email, $name)->send(new SendLinkMail($link,$transaction));

        return true;
    }
    /**
     * Send mail
     */
    public function mailer(String $id) {
        $transaction = Transaction::findOrFail($id);
        $email = $transaction->email;
        $name = $transaction->name;
        $link = route('transactions.checkout',[
            'order_id' => $transaction->order_id,
            'snap_token' => $transaction->snap_token,
        ]);

        Mail::to($email, $name)->send(new SendLinkMail($link,$transaction));

        return view('layouts.alert');
    }
    /**
     * View mail, dev only
     */
    public function view(String $id) {
        $transaction = Transaction::findOrFail($id);
        $email = $transaction->email;
        $name = $transaction->name;
        $link = route('transactions.checkout',[
            'order_id' => $transaction->order_id,
            'snap_token' => $transaction->snap_token,
        ]);

        // Mail::to($email, $name)->send(new SendLinkMail($link,$transaction));

        return view('mail.index',[
            'link' => $link,
            'transaction' => $transaction
        ]);
    }
}
