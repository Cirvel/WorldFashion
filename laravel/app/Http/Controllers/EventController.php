<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $events = Event::all();

        return app(AuthController::class)->isAdmin() ??
        view('events.index', ['events' => $events]);
        
        // return redirect()->route('session.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return app(AuthController::class)->isAdmin() ??
        view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            'title' => ['required', 'min:4', 'max:20'],
            'place' => ['required'],
            'description' => ['required', 'min:4', 'max:100'],
            'start_date' => ['date'],
            'end_date' => ['date'],
            'location' => ['required']
        ]);
        
        // Strip html to prevent malicious codes
        $pField['title'] = strip_tags($pField['title']);
        $pField['place'] = strip_tags($pField['place']);
        $pField['description'] = strip_tags($pField['description']);
        $pField['location'] = strip_tags($pField['location']);

        // Stores data
        Event::create($pField);

        // Returns to index
        return redirect()->route('events.index')->with('success', 'Data successfully stored');
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
    public function edit(String $id)
    {
        $event = Event::findOrFail($id);

        return app(AuthController::class)->isAdmin() ??
        view('events.edit', ['event' => $event]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        // Validate data
        $pField = $request->validate([
            'title' => ['required', 'min:4', 'max:50'],
            'place' => ['required'],
            'description' => ['required'],
            'start_date' => ['date'],
            'end_date' => ['date'],
            'location' => ['required']
        ]);
        
        // Strip html to prevent malicious codes
        $pField['title'] = strip_tags($pField['title']);
        $pField['place'] = strip_tags($pField['place']);
        $pField['description'] = strip_tags($pField['description']);
        $pField['location'] = strip_tags($pField['location']);

        Event::findOrFail($id)->update([
            'title' => $request->title,
            'place' => $request->place,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        Event::destroy($id);

        return redirect()->back()->with('success','data successfully destroyed');
    }

    /**
     * Search for event
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if ($request->ajax()) {
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = Event::where($request->filter, 'like', '%' . $request->search . '%')->orderBy($request->filter, $request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data) > 0) {
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
                foreach ($data as $event) {
                    $output .=
                        '
                    <tr>
                        <td scope="row">' . $event->event_id . '</td>
                        <td>' . $event->title . '</td>
                        <td>' . $event->place . '</td>
                        <td>' . $event->description . '</td>
                        <td>' . $event->start_date . '</td>
                        <td>' . $event->end_date . '</td>
                        <td>' . $event->location . '</td>
                        <td>
                            <form onsubmit="return confirm("Are you sure you want to delete this data?")" action="' . route('events.destroy', ['event' => $event]) . '" method="POST">
                                <a href="' . route('events.edit', ['event' => $event]) . '" class="text-decoration-none">
                                    <button type="button" class="btn btn-warning mb-1"><i class="fas fa-edit"></i></button>
                                </a>
                                <input type="hidden" name="_token" value="' . $token . '"/>
                                <input type="hidden" name="_method" value="delete">
                                <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    ';
                    $output .=
                        '</td>
                    </tr>';
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
                    </tbody>
                </table>    
                ';
            }

            return $output;
        }
    }
}
