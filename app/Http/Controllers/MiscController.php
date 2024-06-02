<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MiscController extends Controller
{
    public function getMidtrans(String $id)
    { /* Get midtrans transaction data through order_id */
        $midtrans_serverkey = base64_encode(config('midtrans.serverKey'));

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic ' . $midtrans_serverkey,
        ])->get('https://api.sandbox.midtrans.com/v2/' . $id . '/status');

        $response = json_decode($response->body());

        return $response;
    }
    /**
     * Generates a random line of strings
     */
    public function generateStr(int $length = 16)
    {
        $str = Str::random($length);
        return $str;
    }

    /**
     * Generate a Qr code for a specified link
     */
    public function generateQr(String $link)
    {
        return QrCode::size(256)->generate($link);
    }

    /**
     *  Ajax version of a similar function for generateQr
     */
    public function qr_ajax(Request $request)
    {
        if ($request->ajax()) {
            /* Returns given string into a Qr code */
            return QrCode::size(256)->generate($request->link);
        }
    }

    /**
     * Regenerate Captcha if user struggles with the current one
     */
    public function regenerateCaptcha(Request $request)
    {
        if ($request->ajax())
        {
            return response()->json(['captcha' => captcha_img('math')]);
        }
    }

    /**
     * Through AJAX, check if captcha is correct before moving the user to the next popup
     */
    public function checkCaptcha(Request $request)
    {
        if ($request->ajax())
        {
            $res = $request->validate([
                'captcha' => ['required','captcha']
            ]);

            if ($res) {
                return true;
            } else {
                return false;
            }
        }
    }
}
