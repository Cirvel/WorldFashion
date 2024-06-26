<?php

namespace App\Http\Controllers;

use App\Mail\SendLinkMail;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Midtrans\Config;
use Midtrans\Snap;

class TransactionController extends Controller
{
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
        $tickets = Ticket::all();

        return app(AuthController::class)->isLoggedIn() ??
            view('booking.booking', [
                'tickets' => $tickets
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        /* User paying method */
        if ($request->ajax()) {
            // Set your Merchant Server Key
            Config::$serverKey = config('midtrans.serverKey');
            Config::$clientKey = config('midtrans.clientKey');
            // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
            Config::$isProduction = false;
            // Set sanitization on (default)
            Config::$isSanitized = true;
            // Set 3DS transaction for credit card to true
            Config::$is3ds = true;

            /* Php saving */
            $pField = $request->validate([
                'ticket_id' => ['required'],
                'user_id' => ['required'],
                'name' => ['required', 'max:35'],
                'email' => ['required', 'email'],
                'no_telp' => ['required', 'min:13', 'max:13'],
                'amount' => ['required', 'integer'],
                'total' => ['integer'],
                // 'captcha' => ['required'],
            ]);

            $pField['order_id'] = rand();
            $pField['ticket_id'] = $request->get('ticket_id');
            $pField['name'] = strip_tags($pField['name']);
            $pField['email'] = strip_tags($pField['email']);
            $pField['no_telp'] = strip_tags($pField['no_telp']);
            $pField['snap_token'] = "abcd-efgh-ijkl-mnop-qrst-uvwx-yz";

            // /* Midtrans method */
            $params = array(
                'transaction_details' => array(
                    'order_id' => $pField['order_id'],
                    'gross_amount' => $pField['total'],
                ),
                'customer_details' => array(
                    'first_name' => $pField['name'],
                    'email' => $pField['email'],
                ),
            );
            $snapToken = Snap::getSnapToken($params); // Get token based on these data
            $pField['snap_token'] = $snapToken;


            Transaction::create($pField);

            return redirect()->route('dashboard.main')->with(['success' => 'Transaction successfully stored']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        /**
         * Display transaction details to user
         */
        $transaction = Transaction::findOrFail($id);

        // $response = (new MiscController)->getMidtrans($transaction->order_id);
        // dd($response);

        /* If basic user is trying to look up another's payment detail, bring them back to dashboard */
        if (auth()->user()->level != "admin" ?? $transaction->user_id != auth()->id()) {
            return redirect()->route('dashboard.main')->withError('Unable to access ticket details of others');
        }

        $link = route('transactions.checkout', [
            'order_id' => $transaction->order_id,
            'snap_token' => $transaction->snap_token,
        ]);

        $qrcode = app(MiscController::class)->generateQr($link);
        // $qrcode = $this->generateQr($detail->confirmation_code);

        return view('transactions.show', [
            'transaction' => $transaction,
            'qr_code' => $qrcode,
        ]);
    }

    /**
     * Return data through id from ajax request
     */
    public function get(Request $request)
    {
        if ($request->ajax()) // Check if the request was an ajax
        {
            $data = Transaction::findOrFail($request->id);

            /* Getting midtrans order data */
            $order = $data->order_id;
            $response = (new MiscController)->getMidtrans($order);

            return [
                $data, // return transactions row
                $data->fk_ticket_id, // return tickets foreign key row
                $response, // return midtrans order field
            ];
        }
    }

    /**
     * Append data on transaction history at dashboard
     */
    public function append(Request $request)
    {
        if ($request->ajax()) {
            $midtrans_serverkey = base64_encode(config('midtrans.serverKey'));

            $data = Transaction::all()->where('user_id', '=', $request->user_id)->sortByDesc('created_at');

            $output = '';
            if (count($data) > 0) {
                foreach ($data as $transaction) {
                    $order = $transaction->order_id;
                    /* Getting midtrans order data */
                    $response = (new MiscController)->getMidtrans($order);
                    $status = $response->status_code; // "transaction_status"

                    $output .= '
                    <div id="transaction-' . $transaction->id . '" class="transaction-card"
                    onclick="get(' . $transaction->id . ')" data-bs-toggle="modal"
                    data-bs-target="#historyDetail">
                        <div class="d-flex justify-content-between">
                            <span>ID: KDWF-' . $transaction->snap_token . '</span>';
                    if ($status == 200) {
                        $output .= '<span class="text-success">Success</span>';
                    } elseif ($status == 201 or $status == 404) {
                        $output .= '<span class="text-info">Pending</span>';
                    } elseif ($status == 407) {
                        $output .= '<span class="text-danger">Expired</span>';
                    } else {
                        $output .= '<span class="text-danger">Expired</span>';
                        // $output .= '<span class="text-secondary">Undefined ('. $status .')</span>';
                    }
                    $output .= '
                            </div>
                            <div class="mt-2">' . $transaction->created_at . '</div>
                            <div class="mt-2">' . $transaction->amount . 'x ' . $transaction->fk_ticket_id->name . ' Ticket</div>
                            <div class="mt-2">Rp. ' . number_format($transaction->total) . '</div>
                            </div>
                            ';
                }
            } else {
                $output = '
                <h5 class="text-center mt-5">No data available</h5>    
                ';
            }

            return $output;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $transaction = Transaction::findOrFail($id);
        $tickets = Ticket::all();

        /* If basic user is trying to look up another's payment detail, bring them back to dashboard */
        if (auth()->user()->level != "admin" ?? $transaction->user_id != auth()->id()) {
            return redirect()->route('dashboard.main')->withError('Unable to access ticket details of others');
        }

        $id = auth()->id();

        return app(AuthController::class)->isLoggedIn() ??
            view('transactions.edit', [
                'transaction' => $transaction,
                'tickets' => $tickets,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        /* User paying method */

        $pField = $request->validate([
            'ticket_id' => ['required'],
            'name' => ['required', 'max:35'],
            'email' => ['required', 'email'],
            'no_telp' => ['required', 'max:13'],
            'amount' => ['required', 'integer'],
            'total' => ['integer'],
        ]);

        $pField['ticket_id'] = $request->get('ticket_id');
        $pField['name'] = strip_tags($pField['name']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['no_telp'] = strip_tags($pField['no_telp']);

        Transaction::findOrFail($id)->update([
            'ticket_id' => $pField['ticket_id'],
            'name' => $pField['name'],
            'email' => $pField['email'],
            'no_telp' => $pField['no_telp'],
            'amount' => $pField['amount'],
            'total' => $pField['total'],
        ]);

        return redirect()->route('transactions.index')->with(['success' => 'Transaction successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     * En Garde Steam
     * R94720
     */
    public function destroy(String $id)
    {
        Transaction::destroy($id);

        return redirect()->back()->with('success', 'data successfully destroyed');
    }

    /**
     * Search for transaction
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = Transaction::where($request->filter, 'like', '%' . $request->search . '%')->orderBy($request->filter, $request->sort)->get();
            $token = $request->session()->token(); // Get token from request
            if ($request->filter == "ticket_id") { // Search ticket through the foreign key
                $data = Transaction::whereHas('fk_ticket_id', function ($p) use ($request) {
                    $p->where('name', 'like', '%' . $request->search . '%');
                })->get();
            }

            // Ready output variable for
            $output = '';
            if (count($data) > 0) {
                /* Header */
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4ch;">#</th>
                            <th scope="col" style="width: 20ch;">Ticket</th>
                            <th scope="col" style="width: 20ch;">User</th>
                            <th scope="col" style="width: 20ch;">Email</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Status</th>
                            <th scope="col">Bought Date</th>
                            <th scope="col" style="width: 18ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach ($data as $transaction) {
                    $order = $transaction->order_id;
                    /* Getting midtrans order data */
                    $response = (new MiscController)->getMidtrans($order);
                    $status = $response->status_code; // "transaction_status"

                    /* Data */
                    $output .=
                        '
                    <tr>
                        <td scope="row">' . $transaction->id . '</td>
                        <td>' . $transaction->fk_ticket_id->name . '</td>
                        <td>' . $transaction->name . '</td>
                        <td>' . $transaction->email . '</td>
                        <td>' . $transaction->no_telp . '</td>
                        <td>' . $transaction->amount . '</td>
                        <td>' . $transaction->total . '</td>
                        ';
                    if ($status == 200) {
                        $output .= '
                        <td class="text-success">
                            <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                            <span class="d-none d-md-inline"> Success</span>
                        </td>
                            ';
                    } elseif ($status == 201 or $status == 404) {
                        $output .= '
                        <td class="text-info">
                            <i class="fa-regular fa-circle-question" aria-hidden="true"></i><span class="d-none d-md-inline">
                                Pending</span>
                        </td>
                            ';
                    } else {
                        $output .= '
                        <td class="text-danger">
                            <i class="fa-regular fa-circle-xmark" aria-hidden="true"></i><span class="d-none d-md-inline">
                                Expired</span>
                        </td>
                            ';
                    }
                    $output .= '
                        <td>' . $transaction->created_at . '</td>
                        <td>
                            <form onsubmit="return confirm("Are you sure you want to delete this data?")" action="' . route('transactions.destroy', ['transaction' => $transaction]) . '" method="POST">
                                <a href="' . route('transactions.checkout', [
                                    'order_id' => $transaction->order_id,
                                    'snap_token' => $transaction->snap_token,
                                ]) . '" class="text-decoration-none">
                                    <button type="button" class="btn btn-info mb-1"><i class="fas fa-eye"></i></button>
                                </a>
                                <a href="' . route('transactions.edit', ['transaction' => $transaction]) . '" class="text-decoration-none">
                                    <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                </a>
                                <input type="hidden" name="_token" value="' . $token . '"/>
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    ';
                }
                $output .= '
                    </tbody>
                </table>
                ';
            } else {
                /* No search result */
                $output = '
                <h5 class="text-center mt-5">No data available</h5>    
                ';
            }

            return $output;
        }
    }

    /**
     * Display checkout page for a single transaction
     */
    public function checkout(String $order, String $snap)
    {
        if (auth()->check()) {
            $transaction = DB::table('transactions')->where('order_id', '=', $order)->where('snap_token', '=', $snap)->first();

            if (!$transaction) {
                return redirect()->route('dashboard.admin')->withErrors('Transaction not found');
            }

            $midtrans_serverkey = base64_encode(config('midtrans.serverKey'));

            $order = $transaction->order_id;
            /* Getting midtrans order data */
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . $midtrans_serverkey,
            ])->get('https://api.sandbox.midtrans.com/v2/' . $order . '/status');
            $response = json_decode($response->body());

            // DD
            // dd($response);

            return view('transactions.show', [
                'transaction' => $transaction,
                'response' => $response,
            ]);
        } else {
            return redirect()->route('session.login')->withErrors('Please log in');
        }
    }

    /**
     * When user entered a qr code it will automatically confirms the owned transactions
     */
    public function confirm(Request $request)
    {
        if ($request->ajax()) {
            // Automatically confirms upon triggering
            $transaction = Transaction::findOrFail($request->id);
            $transaction->update([
                'transaction_status' => 'success',
            ]);

            // Deduct stock based off the amount of tickets the transaction selected
            $ticket = Ticket::findOrFail($transaction->ticket_id);
            $ticket->update([
                'stock' => $ticket->stock - $transaction->amount,
            ]);

            // Send email to user
            $mail = (new MailController)->mail($request->id);

            if ($mail) {
                return $request->session()->token();
            } else {
                return "mail failed";
            }
            // return redirect()->route('transactions.index')->with(['success' => 'Transaction successfully confirmed']);
        }
    }
}
