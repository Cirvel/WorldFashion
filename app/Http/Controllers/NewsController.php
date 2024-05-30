<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = News::all();

        return app(AuthController::class)->isAdmin() ??
            view('news.index', ['news' => $news]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return app(AuthController::class)->isAdmin() ??
            view('news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pField = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
            'image' => ['required'], // image file
        ]);

        if ($request->hasFile('image')) { /* Upload image to data */
            $img_file = $request->file('image');
            // $ext = $request->file('image')->getClientOriginalExtension();
            $img_extension = $img_file->getClientOriginalExtension();
            $img_name = Str::random(16) . '.' . $img_extension;
            $img_file->move('img/news/', $img_name);
            $pField['image'] = $img_name;
        }

        News::create($pField);

        return redirect()->route('news.index')->with(['success' => 'Data successfully stored']);
    }

    /**
     * Display the specified resource.
     */
    public function show(String $id)
    {
        $news = News::findOrFail($id);

        return view('news.show', ['news' => $news]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(String $id)
    {
        $news = News::findOrFail($id);

        return app(AuthController::class)->isAdmin() ??
            view('news.edit', ['news' => $news]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, String $id)
    {
        $pField = $request->validate([
            'title' => ['required'],
            'description' => ['required'],
        ]);


        if ($request->hasFile('image')) { /* Upload image to data */
            $img_file = $request->file('image');
            // $ext = $request->file('image')->getClientOriginalExtension();
            $img_extension = $img_file->getClientOriginalExtension();
            $img_name = Str::random(16) . '.' . $img_extension;
            $img_file->move('img/news/', $img_name);
            $pField['image'] = $img_name;

            News::findOrFail($id)->update([
                'title' => $pField['title'],
                'description' => $pField['description'],
                'image' => $pField['image'],
            ]);
        } else { /* If admin doesn't input an image, this function will be ignored */
            News::findOrFail($id)->update([
                'title' => $pField['title'],
                'description' => $pField['description'],
            ]);
        }

        return redirect()->route('news.index')->with(['success' => 'Data successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(String $id)
    {
        News::destroy($id);

        return redirect()->back()->with(['success' => 'Data successfully destroyed']);
    }

    /**
     * Search for ticket
     */
    public function search(Request $request)
    {
        // Only activates if it was from an ajax call
        if ($request->ajax()) {
            // Select data by ('_column','_criteria','_input') and order them by ('_column','_sort | DESC | ASC')
            $data = News::where($request->filter, 'like', '%' . $request->search . '%')->orderBy($request->filter, $request->sort)->get();
            $token = $request->session()->token(); // Get token from request

            // Ready output variable for 
            $output = '';
            if (count($data) > 0) {
                /* Header */
                $output = '
                <table class="table table-striped" id="search_list">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 4ch;">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col" style="width: 20ch;">Image</th>
                            <th scope="col" style="width: 15ch;">Action</th>
                        </tr>
                    </thead>
                    <tbody>';
                        foreach ($data as $news)
                        {
                            $output .= '
                            <tr>
                                <td scope="row">'. $news->id .'</td>
                                <td>'. $news->title .'</td>
                                <td>'. $news->description .'</td>
                                <td>
                                    <img src="/img/news/'. $news->image .'" alt="'. $news->image .'" class="img-thumbnail">
                                </td>
                                <td>
                                    <form onsubmit="return confirm(`Are you sure you want to delete this data?`)"
                                        action="'. route('news.destroy', ['news' => $news]) .'" method="POST">
                                        <a href="'. route('news.edit', ['news' => $news]) .'"
                                            class="text-decoration-none">
                                            <button type="button" class="btn btn-warning mb-1"><i
                                                    class="fas fa-edit"></i></button>
                                        </a>
                                        <input type="hidden" name="_token" value="'. $token .'">
                                        <input type="hidden" name="_method" value="delete">
                                        <button class="btn btn-danger mb-1"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>';
                        }
                    $output .=
                    '</tbody>
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
