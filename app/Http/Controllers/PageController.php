<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Ticket;
use App\Models\Transaction;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function dashboard()
    {
        $tickets = Ticket::all();
        $transactions = Transaction::all()->where('user_id', '=', auth()->id());
        // $transactions = DB::table('transactions')->where('user_id','=',auth()->id())->get();

        // if (app(AuthController::class)->isLoggedIn()){
        //     return app(AuthController::class)->isLoggedIn();
        // }

        if (auth()->user()->level == "admin") { // If user is admin, redirect them to crud dashboard instead
            return redirect()->route('dashboard.admin')->withErrors('Only basic level user may access that page');
        }
        $username = auth()->user()->name;

        return view('dashboard', [
            'username' => $username,
            'transactions' => $transactions,
            'tickets' => $tickets,
        ]);
    }
    public function former_events()
    {
        if (auth()->user()->level == "admin") { // If user is admin, redirect them to crud dashboard instead
            return redirect()->route('dashboard.admin')->withErrors('Only basic level user may access that page');
        }
        $username = auth()->user()->name;

        // Search for news if user directs to website through a search bar
        $news = News::all()->sortByDesc('created_at');
        if (request()->has('search')) { //  if (/former_event?search=)
            // $news = DB::table('news')->where('title','like','%'.request()->get('search').'%')->orderBy('created_at','DESC')->get();
            $news = News::where('title', 'like', '%' . request()->get('search', '') . '%')->orderBy('created_at', 'DESC')->get();
        }

        return view('Former_Event', [
            'news' => $news,
            'username' => $username,
        ]);
    }
    public function admin()
    {
        return app(AuthController::class)->isAdmin() ?? view('admin');
    }
}
