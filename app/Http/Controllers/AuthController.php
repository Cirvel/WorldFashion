<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Closure;

class AuthController extends Controller
{
    public function isLoggedIn()
    /* Check if user is logged in or back to the login */
    {
        if(!auth()->check()){
            return redirect()->route('session.login')->withErrors('Please log in');
        }
    }
    
    public function isAdmin()
    /* Check if user is an admin or back to the dashboard, also doubles as isLoggedIn */
    {
        if(!auth()->check()){
            return redirect()->route('session.login');
        }elseif(auth()->user()->level!="admin"){
            return redirect()->route('dashboard.main');
        }
    }

    /**
     * Login page.
     */
    public function index()
    {
        if(auth()->check()){ // If already auth, redirect to dashboard
            return redirect()->route('dashboard.main');
        }

        return view('session.login');
    }

    /**
     * Register page.
     */
    public function index_2()
    {
        if(auth()->check()){ // If already auth, redirect to dashboard
            return redirect()->route('dashboard.main');
        }

        return view('session.register');
    }

    /**
     * Create new account
     */
    public function create(Request $request) { // Dep: Illuminate\Http\Request
        // Check if field met criteria
        $incomingFields = $request->validate([
            'name'  => ['required','min:1','max:15'],
            'password'  => ['required','min:1','max:8'],
            'email'     => ['required','email'],
        ]);
        // Encrypts password
        $incomingFields['password'] = bcrypt($incomingFields['password']);

        // Create user row
        $newUser = User::create($incomingFields); // Dep: App\Models\User
        // Automatically authenticate newly registered accoutn
        auth()->login($newUser);

        // Redirect user to Home
        return redirect('/')->with(['success' => 'Account successfuly registered.']);
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
            return redirect()->route('dashboard.main')->with("success","Account successfully logged in.");
        } else
        {
            return redirect()->route('session.login')->withErrors(['msg' => 'Incorrect username or password']);
        }
        
    }

    /**
     * Create a new user on the database
     */
    public function register(Request $request) { // Dep: Illuminate\Http\Request
        /* 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/'
        Atleast contain 3 of each type
        a-z
        A-Z
        0-9
        !, @, #, %
        */
        
        // Check if field met criteria
        $incomingFields = $request->validate([
            'name' => ['required','min:4','max:15'],
            'password' => [
                'required',
                'min:8',
                'max:20',
                'regex:/^.*(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[!@#$&%]).*$/',
                function (String $attr, mixed $value, Closure $fail) {
                    if (!preg_match('/[a-z]/',$value)) {
                        $fail("The {$attr} must contain atleast one lowercase letter");
                    }
                    if (!preg_match('/[A-Z]/',$value)) {
                        $fail("The {$attr} must contain atleast one uppercase letter");
                    }
                    if (!preg_match('/[0-9]/',$value)) {
                        $fail("The {$attr} must contain atleast one number");
                    }
                    if (!preg_match('/[!@#$&%]/',$value)) {
                        $fail("The {$attr} must contain atleast one: !, @, #, $, &, %");
                    }
                }
            ],
            'no_telp' => ['required','min:10','max:13'],
            'email' => ['required','email'],
        ]);

        // Strip tags for potential malware
        $incomingFields['name'] = strip_tags($incomingFields['name']);
        $incomingFields['password'] = bcrypt($incomingFields['password']);
        $incomingFields['email'] = strip_tags($incomingFields['email']);

        // Create user row
        $newUser = User::create($incomingFields); // Dep: App\Models\User
        // Automatically authenticate newly registered accoutn
        auth()->login($newUser);

        // Redirect user to Home
        return redirect()->route('dashboard.main')->with(['success' => 'Account successfuly registered.']);
    }
}
