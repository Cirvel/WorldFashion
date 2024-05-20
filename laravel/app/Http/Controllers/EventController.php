<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $events = Event::all();

        return view('events.index', ['events' => $events]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            'title' => ['required','min:4','max:20'],
            'description' => ['required','min:4','max:100'],
            'location' => ['required'],
            'level',
        ]);
        
        $pField['name'] = strip_tags($pField['name']);
        $pField['password'] = bcrypt($pField['password']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['level'] = $request->get('level');
        
        // Stores data
        Event::create($pField);

        // Returns to index
        return redirect()->route('users.index')->with('success','Data successfully stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        //
    }

    /**
     * Search for event
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if($request->ajax())
        {   
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = User::where($request->filter,'like','%'.$request->search.'%')->orderBy($request->filter,$request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data)>0){
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4ch;">#</th>
                            <th scope="col" style="width: 20ch;">Title</th>
                            <th scope="col">Place</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="width: 12ch;">End Date</th>
                            <th scope="col" style="width: 12ch;">Start Date</th>
                            <th scope="col">Location</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($data as $event){
                    $output .=
                    '<tr>
                        <td scope="row">'. $user->user_id .'</td>
                        <td>'. $user->name .'</td>
                        <td>'. $user->password .'</td>
                        <td>'. $user->email .'</td>
                        <td>';
                        if ($user->level == "admin") { // If user is an admin
                            $output .= '<i class="fas fa-star fa-sm fa-fw"></i> Admin';
                        } else { // if user is not an admin
                            $output .= '<i class="fas fa-user fa-sm fa-fw"></i> User';
                        }
                    $output .=
                    '</td>
                        <td>';
                            if (!auth()->id() == $user->user_id){ // If the row is the user, remove option
                                $output .=
                                '
                                <form onsubmit="return confirm('."'Are you sure you want to delete this data?'".')" action="'.route('users.destroy', ['user' => $user]).'" method="POST">
                                <a href="'.route('users.edit', ['user' => $user]) .'" class="text-decoration-none">
                                <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                </a>
                                <input type="hidden" name="_token" value="'. $token .'"/>
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                </form>
                                ';
                            } else { // Instead give them the option to log out
                                $output .=
                                '
                                <a href="/logout">
                                <button class="btn btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> <span class="d-none d-md-inline">Log out</span> </button>
                                </a>
                                ';
                            }
                    $output .=
                        '</td>
                    </tr>'
                    ; 
                }
                $output .= '
                    </tbody>
                </table>
                ';
            } else {
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 10ch;">#</th>
                            <th scope="col" style="width: 25ch">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>    
                ';
            }

            return $output;
        }
    }
}
