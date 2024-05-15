<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!auth()->id()){ // If not auth, redirect to login
            return redirect()->route('session.login');
        }elseif (!auth()->user()->level!="admin") { // If not admin, redirect to home
            return redirect()->route('dashboard');
        }

        return view('pages.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate data
        $pField = $request->validate([
            'title' => ['required','max:50'],
            'place' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'required',
            'location' => 'required',
            'video' => 'required',
        ]);

        // Stores data
        Pages::create($pField);

        // Returns to index
        return redirect()->route('posts.index')->with('success','Data successfully stored');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pages $pages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        // Find row id
        $page = Pages::findOrFail($id);
        
        // Redirect to edit form with the collected data
        return view('pages.edit', ['page' => $page]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pages $pages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pages $pages)
    {
        //
    }
}
