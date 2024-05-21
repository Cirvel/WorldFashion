<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users = User::all();

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            'name' => ['required','min:4','max:20'],
            'password' => ['required','min:4','max:100'],
            'email' => ['required','email'],
            'level',
        ]);
        
        $pField['name'] = strip_tags($pField['name']);
        $pField['password'] = bcrypt($pField['password']);
        $pField['email'] = strip_tags($pField['email']);
        $pField['level'] = $request->get('level');
        
        // Stores data
        User::create($pField);

        // Returns to index
        return redirect()->route('users.index')->with('success','Data successfully stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function decryptPassword(String $value){
        try {
            $decrypted = Crypt::decryptString($value);
            return $decrypted;
        } catch (DecryptException $e) {
            // ...
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Find row id
        $user = User::findOrFail($id);
        $decrypted = $this->decryptPassword($user->password) ?? "LOl";
        
        // If user is trying to edit itself, redirect them
        if (auth()->id() == $id) {
            return redirect()->route('users.index');
        }
        

        // Redirect to edit form with the collected data
        return view('users.edit', [
            'user' => $user,
            'password' => $decrypted,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate data before updating
        $pField = $request->validate([
            'name' => ['required','min:4','max:20'],
            'email' => ['required','email'],
            'level',
        ]);

        $request['name'] = strip_tags($pField['name']);
        $request['email'] = strip_tags($pField['email']);

        User::findOrFail($id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'level' => $request->get('level'),
        ]);
        
        // Returns user to index
        return redirect()->back()->with('success','Data successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Destroy data with the corresponding id
        User::destroy($id);

        // If user destroy an account with their id on it, log out
        if (auth()->hasUser() && auth()->id() == $id) {
            return redirect()->route('session.logout');
        };

        // Refresh page
        return redirect()->back()->with('success','Data successfully destroyed');
    }

    
    /**
     * Search for user
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
                            <th scope="col" style="width: 10ch;">#</th>
                            <th scope="col">Username</th>
                            <th scope="col">Password</th>
                            <th scope="col">Email</th>
                            <th scope="col">Level</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                ';
                foreach($data as $user){
                    $output .=
                    '<tr>
                        <td scope="row">'. $user->id .'</td>
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
                            if (!auth()->id() == $user->id){ // If the row is the user, remove option
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
