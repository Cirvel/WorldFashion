<?php

use App\Models\Ticket;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('dummy_data', function () {
    /*
    Prepares user data
    Referenced from dokument
    */

    // Prepare admin account
    $userAdmin['name'] = strip_tags("adMinX");
    $userAdmin['password'] = bcrypt("Never4get");
    $userAdmin['email'] = strip_tags("admin@gmail.com");
    $userAdmin['no_telp'] = "1080-2307-821";
    $userAdmin['level'] = strip_tags("admin");
    User::create($userAdmin);

    // Prepare user account
    $userBasic['name'] = strip_tags("4Clients");
    $userBasic['password'] = bcrypt("Never4get2");
    $userBasic['email'] = strip_tags("user@gmail.com");
    $userBasic['no_telp'] = "3010-7405-396";
    $userBasic['level'] = strip_tags("user");
    User::create($userBasic);

    // Prepare ticket
    $dataTicket['name'] = strip_tags("World Fashion"); // varchar
    $dataTicket['price'] = 100000; // integer
    $dataTicket['stock'] = 5; // integer
    Ticket::create($dataTicket);

    // Prepare transaction from user
    $dataTransaction['ticket_id'] = 1; // foreign key
    $dataTransaction['user_id'] = 2; // foreign key
    $dataTransaction['name'] = strip_tags("4Clients"); // varchar
    $dataTransaction['email'] = strip_tags("user@gmail.com"); // text
    $dataTransaction['no_telp'] = strip_tags("1914-1939-420"); // varchar
    $dataTransaction['confirmed'] = false; // varchar
    $dataTransaction['amount'] = 3; // integer
    $dataTransaction['total'] = 150000; // integer

    // Set your Merchant Server Key
    \Midtrans\Config::$serverKey = config('midtrans.serverKey');
    // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
    \Midtrans\Config::$isProduction = false;
    // Set sanitization on (default)
    \Midtrans\Config::$isSanitized = true;
    // Set 3DS transaction for credit card to true
    \Midtrans\Config::$is3ds = true;

    /* Midtrans method */
    $pQris = array(
        'transaction_details' => array(
            'order_id' => rand(),
            'gross_amount' => $dataTransaction['total'],
        ),
        'customer_details' => array(
            'first_name' => $dataTransaction['name'],
            'email' => $dataTransaction['email'],
        ),
    );
    $snapToken = \Midtrans\Snap::getSnapToken($pQris);
    $dataTransaction['snap_token'] = $snapToken; // integer
    Transaction::create($dataTransaction);

    $this->comment("dummy_data Success");
})->purpose('Automatically create dummy data');
