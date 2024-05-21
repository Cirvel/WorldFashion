<?php

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Artisan::command('prepare_users_data', function () {
    /*
    Prepares user data
    Referenced from dokument
    */

    // Prepare admin account
    $incomingFields['name'] = strip_tags("adMinX");
    $incomingFields['password'] = bcrypt("Never4get");
    $incomingFields['email'] = strip_tags("admin@gmail.com");
    $incomingFields['level'] = strip_tags("admin");
    User::create($incomingFields);
    
    // Prepare user account
    $incomingFields['name'] = strip_tags("4Clients");
    $incomingFields['password'] = bcrypt("Never4get2");
    $incomingFields['email'] = strip_tags("user@gmail.com");
    $incomingFields['level'] = strip_tags("user");
    User::create($incomingFields);

    $this->comment("prepare_users_data Success");
})->purpose('Display an inspiring quote');
