<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function price()
    {
        return 50000; // Universal price
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::all();

        return app(AuthController::class)->isAdmin() ??
        view('transactions.index', ['transactions' => $transaction]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $price = $this->price();
        return app(AuthController::class)->isLoggedIn() ??
        view('booking', ['price' => $price]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* User paying method */

        $pField = $request->validate([
            'user_id' => ['required'],
            'name' => ['required','max:35'],
            'email' => ['required','email'],
            'no_telp' => ['required','min:13','max:13'],
            'amount' => ['required','integer'],
            'total' => ['integer'],
        ]);

        $pField['name'] = strip_tags($pField['name']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['no_telp'] = strip_tags($pField['no_telp']);

        Transaction::create($pField);

        return redirect()->route('dashboard.main')->with('success','ticket successfully purchased');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $transaction = Transaction::findOrFail($id);

        return app(AuthController::class)->isAdmin() ??
        view('transactions.index', ['transactions' => $transaction]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        /* User paying method */

        $pField = $request->validate([
            'name' => ['required','max:35'],
            'email' => ['required','email'],
            'no_telp' => ['required','max:13'],
            'amount' => ['required','integer'],
            'total' => ['integer'],
        ]);

        $pField['name'] = strip_tags($pField['name']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['no_telp'] = strip_tags($pField['no_telp']);

        Transaction::findOrFail($id)->update([
            'name' => $pField['name'],
            'email' => $pField['email'],
            'no_telp' => $pField['no_telp'],
            'amount' => $pField['amount'],
            'total' => $pField['total'],
        ]);

        return redirect()->route('dashboard.main')->with('success','ticket successfully purchased');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Transaction::destroy($id);

        return redirect()->back()->with('success','data successfully destroyed');
    }
}
