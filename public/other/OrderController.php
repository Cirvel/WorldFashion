<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

/**
 * In summary: TransactionController.php for ordinary users
 */

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::all();

        return app(AuthController::class)->isLoggedIn() ??
        view('booking', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return app(AuthController::class)->isLoggedIn() ??
        view('booking');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* User paying method */

        $pField = $request->validate([
            'ticket_id' => ['required'],
            'user_id' => ['required'],
            'name' => ['required', 'max:35'],
            'email' => ['required', 'email'],
            'no_telp' => ['required', 'min:13', 'max:13'],
            'amount' => ['required', 'integer'],
            'total' => ['integer'],
        ]);

        $pField['name'] = strip_tags($pField['name']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['no_telp'] = strip_tags($pField['no_telp']);
        $pField['code'] = Str::random(13);

        Transaction::create($pField);

        return redirect()->route('payment')->with(['success' => 'Transaction successfully stored']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        /**
         * Display transaction details to user
         */
        $transaction = Transaction::findOrFail($id);

        /* If basic user is trying to look up another's payment detail, bring them back to dashboard */
        if (auth()->user()->level != "admin" ?? $transaction->user_id != auth()->id()) {
            return redirect()->route('dashboard.main')->withError('Unable to access ticket details of others');
        }

        $qrcode = app(EventController::class)->generateQr('https://t.ly/cL9S4');
        // $qrcode = $this->generateQr($detail->confirmation_code);

        return view('transactions.show', [
            'transaction' => $transaction,
            'qr_code' => $qrcode,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $transaction = Transaction::findOrFail($id);
        $tickets = Ticket::all();

        /* If basic user is trying to look up another's payment detail, bring them back to dashboard */
        if (auth()->user()->level != "admin" ?? $transaction->user_id != auth()->id()) {
            return redirect()->route('dashboard.main')->withError('Unable to access ticket details of others');
        }

        $id = auth()->id();

        return app(AuthController::class)->isLoggedIn() ??
            view('rebooking', [
                'tickets' => $tickets,
                'transaction' => $transaction
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        /* User paying method */

        $pField = $request->validate([
            'name' => ['required', 'max:35'],
            'email' => ['required', 'email'],
            'no_telp' => ['required', 'max:13'],
            'amount' => ['required', 'integer'],
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

        return redirect()->route('payment')->with(['success' => 'Transaction successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Transaction::destroy($id);
        
        return redirect()->route('payment')->with(['success' => 'Transaction successfully destroyed']);
    }
}
