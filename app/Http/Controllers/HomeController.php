<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\Department;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
      if (Auth::user()->isModerator())
      {
        $ticketsCol = Ticket::orderBy('created_at', 'desc')->paginate(10);
      } else {
        $userID = Auth::id();
        $ticketsCol = Ticket::where('user_id', $userID)->orderBy('created_at', 'desc')->paginate(10);
      }
      $departmentsCol = Department::all();
      return view('home', compact('ticketsCol', 'departmentsCol'));
    }
}
