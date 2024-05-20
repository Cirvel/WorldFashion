<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $username = auth()->id() ? auth()->user()->name : "Anonymous";

    return view('dashboard', ['username' => $username]);
})->name('dashboard.main');
Route::get('admin', function () {
    return view('crud');
})->name('dashboard.admin');

/* CRUD */
Route::resource('users',    UserController::class);
Route::get('users.search', [UserController::class, 'search'])->name('users.search');
Route::resource('events',    EventController::class);
Route::get('events.search', [EventController::class, 'search'])->name('events.search');
Route::resource('transactions',    TransactionController::class);
Route::get('transactions.search', [TransactionController::class, 'search'])->name('transactions.search');

/* Ticket */
Route::get('ticket', QRCodeController::class)->name('ticket');

/* Session */
Route::get('/login',    [AuthController::class, 'index'])->name('session.login'); // main page
Route::get('/register',    [AuthController::class, 'index_2'])->name('session.register'); // main page
Route::get('/logout',   [AuthController::class, 'logout'])->name('session.logout'); // logout
Route::post('/login',    [AuthController::class, 'auth'])->name('session.auth'); // auth
Route::post('/register',    [AuthController::class, 'create'])->name('session.create'); // auth