<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode as FacadesQrCode;

class TransactionController extends Controller
{
    public function price(int $ticket = 1)
    {
        /**
         * Denotes the price of the entire concert
         */
        return 100000;
    }
    public function generateStr(int $length = 16){
        /**
         * Generates a random line of string
         */
        $str = Str::random($length);
        return $str;
    }
    public function generateQr(String $link)
    {
        /* Returns given string into a Qr code */
        return FacadesQrCode::size(256)->generate($link);

        /*
        return FacadesQrCode::generate(
            $link,
        );
        */
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
        
        $id = auth()->id();
        $correct = DB::table('transactions')
        ->where('user_id', '=', $id)
        ->get();

        if (auth()->check() && $correct){
            return redirect()->route('qrcode')->with(['msg' => 'You already booked']);
        }
        
        return app(AuthController::class)->isLoggedIn() ??
        view('booking', [
            'price' => $price
        ]);
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
     * En Garde Steam
     * R94720
     */
    public function show(Transaction $transaction)
    {
        /**
         * If user has already booked a ticket, display the payment details instead
        */

        /* Check in transaction if one of the ticket buyer is the same user */
        $detail = DB::table('transactions')
        ->where('user_id', '=', auth()->id())
        ->get()->first();

        $qrcode = $this->generateQr('https://t.ly/cL9S4');
        // $qrcode = $this->generateQr($detail->confirmation_code);

        if($detail)
        { /* If already booked, display the payment instead */
            return view('payment', [
                'transaction' => $detail,
                'qr_code' => $qrcode,
            ]);;
        } else {
            return redirect()->route('dashboard.main')->with(['msg' => "You haven't booked yet"]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $price = $this->price();
        
        $transaction = DB::table('transactions')
        ->where('id', '=', $id)
        ->get()->first();
        
        return app(AuthController::class)->isLoggedIn() ??
        view('transactions.edit',[
            'price' => $price,
            'transaction' => $transaction
        ]);
    }
    public function rebooking()
    {
        $price = $this->price();
        
        $id = auth()->id();
        $transaction = DB::table('transactions')
        ->where('user_id', '=', $id)
        ->get()->first();
        
        return app(AuthController::class)->isLoggedIn() ??
        view('booking',[
            'price' => $price,
            'transaction' => $transaction
        ]);
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

    
    /**
     * Search for transaction
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if($request->ajax())
        {   
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = Transaction::where($request->filter,'like','%'.$request->search.'%')->orderBy($request->filter,$request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data)>0){
                /* Header */
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4ch;">#</th>
                            <th scope="col" style="width: 20ch;">User</th>
                            <th scope="col" style="width: 20ch;">Email</th>
                            <th scope="col">No Telp</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Total</th>
                            <th scope="col">Confirmed</th>
                            <th scope="col">Bought Date</th>
                            <th scope="col" style="width: 12ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($data as $transaction){
                    /* Data */
                    $output .=
                    '
                    <tr>
                        <td scope="row">'. $transaction->id .'</td>
                        <td>'. $transaction->name .'</td>
                        <td>'. $transaction->email .'</td>
                        <td>'. $transaction->no_telp .'</td>
                        <td>'. $transaction->amount .'</td>
                        <td>'. $transaction->total .'</td>
                        ';
                        if ($transaction->confirmed) {
                            $output .='
                        <td class="text-success">
                            <i class="fa-regular fa-circle-check" aria-hidden="true"></i>
                            <span class="d-none d-md-inline"> True</span>
                        </td>
                            ';
                        } else {
                            $output .='
                        <td class="text-danger">
                            <i class="fa-regular fa-circle-xmark" aria-hidden="true"></i><span class="d-none d-md-inline">
                                False</span>
                        </td>
                            ';
                        }
                        $output .='
                        
                        <td>'. $transaction->created_at .'</td>
                        <td>
                        <form onsubmit="return confirm("Are you sure you want to delete this data?")" action="'. route('transactions.destroy', ['transaction' => $transaction]) .'" method="POST">
                        <a href="'. route('transactions.edit', ['transaction' => $transaction]) .'" class="text-decoration-none">
                        <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                </a>
                                <input type="hidden" name="_token" value="'. $token .'"/>
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
}
