<?php

namespace App\Http\Controllers;

use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();

        return app(AuthController::class)->isAdmin() ??
        view('tickets.index', ['tickets' => $tickets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return app(AuthController::class)->isAdmin() ??
        view('tickets.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pField = $request->validate([
            'name' => ['required','string', 'min:1', 'max:15'],
            'price' => ['required','integer'], // rupiah
            'stock' => ['required','integer'],
        ]);

        Ticket::create($pField);

        return redirect()->route('tickets.index')->with(['success' => 'Data successfully stored']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket)
    {
        //
    }
    
    /** 
     * Get ticket value
     */
    public function get(Request $request)
    {
        if ($request->ajax()) // Check if the request was an ajax
        {
            $data = Ticket::findOrFail($request->ticket);
            return $data;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $ticket = Ticket::findOrFail($id);

        return app(AuthController::class)->isAdmin() ??
        view('tickets.edit', ['ticket' => $ticket]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $pField = $request->validate([
            'name' => ['required','string', 'min:1', 'max:15'],
            'price' => ['required','integer'], // rupiah
            'stock' => ['required','integer'],
        ]);

        Ticket::findOrFail($id)->update([
            'name' => $pField['name'],
            'price' => $pField['price'],
            'stock' => $pField['stock'],
        ]);

        return redirect()->route('tickets.index')->with(['success' => 'Data successfully updated']);    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Ticket::destroy($id);

        return redirect()->back()->with(['success' => 'Data successfully destroyed']);
    }

    /**
     * Search for ticket
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if($request->ajax())
        {   
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = Ticket::where($request->filter,'like','%'.$request->search.'%')->orderBy($request->filter,$request->sort)->get();
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
                        <th scope="col">Title</th>
                        <th scope="col" style="width: 20ch;">Price</th>
                        <th scope="col" style="width: 20ch;">Stock</th>
                        <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($data as $ticket){
                    /* Data */
                    $output .=
                    '<tr>
                        <td scope="row">'. $ticket->id .'</td>
                        <td>'. $ticket->name .'</td>
                        <td>'. $ticket->price .'</td>
                        <td>'. $ticket->stock .'</td>
                        ';
                    $output .='
                        <td>
                        <form onsubmit="return confirm("Are you sure you want to delete this data?")" action="'. route('tickets.destroy', ['ticket' => $ticket]) .'" method="POST">
                            <a href="'. route('tickets.edit', ['ticket' => $ticket]) .'" class="text-decoration-none">
                                <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                            </a>
                            <input type="hidden" name="_token" value="' . $token . '"/>
                            <input type="hidden" name="_method" value="delete">
                            <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                        </form>
                        ';
                    $output .='
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
