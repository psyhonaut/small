<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App;

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

      /**
       * Вывод запросов в зависимости от роли пользователя.
       */
      if (Auth::user()->isModerator()) {
        $ticketsCol = App\Ticket::orderBy('created_at', 'desc')->paginate(10);
      } else {
        $userID = Auth::id();
        $ticketsCol = App\Ticket::all()->where('user_id', $userID)->orderBy('created_at', 'desc')->paginate(10);
      }
        return view('index', [
          'ticketsCol' => $ticketsCol
        ]);
    }
}
