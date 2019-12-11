<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\Department;
use Illuminate\Support\Facades\DB;
use App\Filter\TicketFilter;
use App\TicketReply;

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
    public function index(Request $request)
    {
      $query = DB::table('tickets');

      $ticketsCol = (new TicketFilter($query, $request))
                        ->apply()
                        ->orderBy('last_active', 'desc')
                        ->paginate(10);

      $departmentsCol = Department::all();

      return view('home', compact('ticketsCol', 'departmentsCol'));

    }

      public function close($id)
      {
          $ticketObj = Ticket::find($id);

          if($ticketObj)
          {
            $ticketObj->active = false;
            $ticketObj->save();
            return redirect()->back()->with(['success' => 'Тикет успешно закрыт']);
          }

          return redirect()->back()->withErrors(['msg' => 'Ошибка сохранения']);
      }
}
