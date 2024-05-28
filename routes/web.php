<?php

use App\Http\Controllers\AuthController;
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

/* Transaction */
// Route::get('payment', [TransactionController::class, 'index'])->name('payment');
// Route::get('booking', [TransactionController::class, 'create'])->name('booking');
// Route::get('rebooking/{id}', [TransactionController::class, 'edit'])->name('rebooking');
Route::get('redeem/i{id}u{user}t{ticket}c{code}a{amount}', [TransactionController::class, 'redeem'])->name('redeem');

/* CRUD */
Route::resource('users',    UserController::class);
Route::get('users.search', [UserController::class, 'search'])->name('users.search');
// Route::resource('events',    EventController::class);
// Route::get('events.search', [EventController::class, 'search'])->name('events.search');
Route::resource('tickets',    TicketController::class);
Route::get('tickets.search', [TicketController::class, 'search'])->name('tickets.search');
// Route::resource('orders',    OrderController::class);
Route::resource('transactions',    TransactionController::class);
Route::get('transactions.search', [TransactionController::class, 'search'])->name('transactions.search');

/* Transactions other */
Route::get('transactions.ticket', [TransactionController::class, 'ticket'])->name('transactions.ticket');
Route::get('transactions.qr', [TransactionController::class, 'qr_ajax'])->name('transactions.qr');
Route::get('transactions.get', [TransactionController::class, 'get'])->name('transactions.get');
Route::get('confirm/{id}', [TransactionController::class, 'confirm'])->name('transactions.confirm');

/* Session */
Route::get('/login',    [AuthController::class, 'index'])->name('session.login'); // main page
Route::get('/signin',    [AuthController::class, 'index_2'])->name('session.register'); // main page
Route::get('/logout',   [AuthController::class, 'logout'])->name('session.logout'); // logout
Route::post('/login',    [AuthController::class, 'auth'])->name('session.auth'); // auth
Route::post('/register',    [AuthController::class, 'register'])->name('session.create'); // auth