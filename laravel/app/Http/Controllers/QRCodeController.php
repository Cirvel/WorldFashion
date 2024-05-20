<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QRCodeController extends Controller
{
    public function __invoke(Request $request)
    {
        Mail::to('masagitu2212@gmail.com')->send(new SendLinkMail($request->input('link')));

        return back();
    }
}
