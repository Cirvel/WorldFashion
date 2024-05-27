<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/* Dashboard */
Route::get('/', function () {
    $username = auth()->id() ? auth()->user()->name : "Anonymous";
    
    return view('dashboard', ['username' => $username]);
})->name('dashboard.main');
Route::get('former_event', function () {
    $username = auth()->id() ? auth()->user()->name : "Anonymous";

    return view('Former_Event', ['username' => $username]);
})->name('dashboard.former');
Route::get('admin', function () {
    return app(AuthController::class)->isAdmin() ?? view('crud');
})->name('dashboard.admin');

/* Transaction */
Route::get('payment', [TransactionController::class, 'index'])->name('payment');
Route::get('booking', [TransactionController::class, 'create'])->name('booking');
Route::get('rebooking/{id}', [TransactionController::class, 'edit'])->name('rebooking');
Route::get('confirm/{id}', [TransactionController::class, 'confirm'])->name('confirm');

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
Route::get('transactions.ticket', [TransactionController::class, 'ticket'])->name('transactions.ticket');

/* Session */
Route::get('/login',    [AuthController::class, 'index'])->name('session.login'); // main page
Route::get('/signin',    [AuthController::class, 'index_2'])->name('session.register'); // main page
Route::get('/logout',   [AuthController::class, 'logout'])->name('session.logout'); // logout
Route::post('/login',    [AuthController::class, 'auth'])->name('session.auth'); // auth
Route::post('/register',    [AuthController::class, 'register'])->name('session.create'); // auth