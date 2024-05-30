<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MiscController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/* Dashboard */
Route::get('/', function () {
    $tickets = Ticket::all();
    $transactions = Transaction::all()->where('user_id','=',auth()->id());
    // $transactions = DB::table('transactions')->where('user_id','=',auth()->id())->get();
    
    if (app(AuthController::class)->isLoggedIn()){
        return app(AuthController::class)->isLoggedIn();
    }

    if(auth()->user()->level == "admin")
    { // If user is admin, redirect them to crud dashboard instead
        return redirect()->route('dashboard.admin')->withErrors('Only basic level user may access that page');
    }
    $username = auth()->user()->name;
    
    return view('dashboard', [
        'username' => $username,
        'transactions' => $transactions,
        'tickets' => $tickets,
    ]);
})->name('dashboard.main');
Route::get('former_event', function () {
    
    if (app(AuthController::class)->isLoggedIn()){
        return app(AuthController::class)->isLoggedIn();
    }
    
    if(auth()->user()->level == "admin")
    { // If user is admin, redirect them to crud dashboard instead
        return redirect()->route('dashboard.admin')->withErrors('Only basic level user may access that page');
    }
    $username = auth()->user()->name;

    return app(AuthController::class)->isLoggedIn() ?? view('Former_Event', ['username' => $username]);
})->name('dashboard.former');
Route::get('admin', function () {
    return app(AuthController::class)->isAdmin() ?? view('crud');
})->name('dashboard.admin');

// Route::get('payment', [TransactionController::class, 'index'])->name('payment');
// Route::get('booking', [TransactionController::class, 'create'])->name('booking');
// Route::get('rebooking/{id}', [TransactionController::class, 'edit'])->name('rebooking');

/* CRUD */
Route::resource('users',    UserController::class);
Route::get('users.search', [UserController::class, 'search'])->name('users.search');
// Route::resource('events',    EventController::class);
// Route::get('events.search', [EventController::class, 'search'])->name('events.search');
Route::resource('tickets',    TicketController::class);
Route::get('tickets.search', [TicketController::class, 'search'])->name('tickets.search');
Route::get('tickets.get', [TicketController::class, 'get'])->name('tickets.get');
// Route::resource('orders',    OrderController::class);

/* Transactions */
Route::resource('transactions',    TransactionController::class);
Route::get('transactions.search', [TransactionController::class, 'search'])->name('transactions.search');
Route::get('transactions.get', [TransactionController::class, 'get'])->name('transactions.get');
Route::get('transactions.append', [TransactionController::class, 'append'])->name('transactions.append');
Route::get('checkout/{id}', [TransactionController::class, 'checkout'])->name('transactions.checkout');
Route::get('confirm', [TransactionController::class, 'confirm'])->name('transactions.confirm');

/* Miscellaneous */
Route::get('qr', [MiscController::class, 'generateQr'])->name('qr');
Route::get('str', [MiscController::class, 'generateStr'])->name('qr_ajax');
Route::get('qr_ajax', [MiscController::class, 'qr_ajax'])->name('qr_ajax');
Route::get('recaptcha', [MiscController::class, 'regenerateCaptcha'])->name('recaptcha');
Route::get('nocaptcha', [MiscController::class, 'checkCaptcha'])->name('nocaptcha');

/* Session */
Route::get('/login',    [AuthController::class, 'index'])->name('session.login'); // main page
Route::get('/signin',    [AuthController::class, 'index_2'])->name('session.register'); // main page
Route::get('/logout',   [AuthController::class, 'logout'])->name('session.logout'); // logout
Route::post('/login',    [AuthController::class, 'auth'])->name('session.auth'); // auth
Route::post('/register',    [AuthController::class, 'register'])->name('session.create'); // auth