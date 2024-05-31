<?php

namespace App\Http\Controllers;

use App\Mail\SendLinkMail;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MailController extends Controller
{
    /**
     * Handle the incoming request.
     */
    // public function __invoke(Request $request)
    // {
    //     Mail::to('test@test.com')->send(new SendLinkMail($request->input('link')));

    //     return back();
    // }
    public function mail(Request $request)
    {
        // if ($request->ajax()) {
            // $transaction = Transaction::findOrFail($request->id);
            $transaction = Transaction::findOrFail($request->input('id'));
            $email = $transaction->email;
            $name = $transaction->name;
            $link = route('transactions.checkout', [
                'order_id' => $transaction->order_id,
                'snap_token' => $transaction->snap_token,
            ]);
            Mail::to($email, $name)->send(new SendLinkMail($link, $transaction));

            // return view('mail.index',[
            //     'link' => $link,
            //     'transaction' => $transaction,
            // ]);
            // return view('mail.index',[
            //     'link' => $link,
            //     'transaction' => $transaction,
            // ]);

            return redirect('/');
        // }
    }
}
