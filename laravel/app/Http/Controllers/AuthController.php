<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function isLoggedIn()
    /* Check if user is logged in or back to the login */
    {
        if(!auth()->id()){
            return redirect()->route('dashboard.main');
        }
    }
    
    public function isAdmin()
    /* Check if user is an admin or back to the dashboard, also doubles as isLoggedIn */
    {
        return $this->isLoggedIn();
        
        if(!auth()->user()->level=="admin"){
            return redirect()->route('dashboard.main');
        }
    }

    /**
     * Login page.
     */
    public function index()
    {
        if(auth()->id()){ // If already auth, redirect to dashboard
            return redirect()->route('dashboard');
        }

        return view('session.login');
    }

    /**
     * Register page.
     */
    public function index_2()
    {
        if(auth()->id()){ // If already auth, redirect to dashboard
            return redirect()->route('dashboard');
        }

        return view('session.register');
    }

    /**
     * Create new account
     */
    public function create(Request $request) { // Dep: Illuminate\Http\Request
        // Check if field met criteria
        $incomingFields = $request->validate([
            'name'  => ['required','min:5','max:35'],
            'password'  => ['required','min:8','max:200'],
            'email'     => ['required','email'],
        ]);
        // Encrypts password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Create user row
        $newUser = User::create($incomingFields); // Dep: App\Models\User
        // Automatically authenticate newly registered accoutn
        auth()->login($newUser);

        // Redirect user to Home
        return redirect('/')->with('success','Account successfuly registered.');
    }
    
    /**
     * Destroy user session
     */
    public function logout() {
        // Logout user same way as session_destroy()
        auth()->logout();
        // Redirect user to home page
        return redirect()->route('session.login');
    }

    /**
     * Authenticate user
     */
    public function auth(Request $request) {
        // Requires all field to be filled
        $validateField = $request->validate([
            "name"  => "required",
            "password"  => "required",
        ]);

        // Check for account with same username and password together
        if (auth()->attempt(['name' => $validateField['name'], 'password' => $validateField['password'] ])) {
            $request->session()->regenerate();
            return redirect("/")->with("success","Account successfully logged in.");
        }
        
        return redirect()->route('session.login')->with("error","Invalid username or password.");
    }

    /**
     * Create a new user on the database
     */
    public function register(Request $request) { // Dep: Illuminate\Http\Request
        // Check if field met criteria
        $incomingFields = $request->validate([
            'user'  => ['required','min:5','max:35'],
            'password'  => ['required','min:8','max:200'],
            'email'     => ['required','email'],
        ]);
        // Encrypts password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Create user row
        $newUser = User::create($incomingFields); // Dep: App\Models\User
        // Automatically authenticate newly registered accoutn
        $this->logout();
        auth()->login($newUser);

        // Redirect user to Home
        return redirect('/login')->with('success','Account successfuly registered.');
    }
}
