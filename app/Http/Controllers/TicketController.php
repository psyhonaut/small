<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Ticket;
use App\TicketReply;
use App\User;
use App\Department;
use App\Http\Requests\TicketCreateRequest;

class TicketController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $departmentsCol = Department::all();
    return view('ticket.create', compact('departmentsCol'));
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(TicketCreateRequest $request)
  {
    $data = $request->input();
    $item = (new Ticket())->create($data);

    if($item)
    {
      return redirect()->route('ticket.show', [$item->id])->with(['success' => 'Успешно сохранено']);
    } else {
      return back()->withErrors(['msg' => 'Ошибка сохранения']);
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    $ticketObj = Ticket::find($id);
    $ticketReplyCol = Ticket::find($ticketObj->id)->replyAll;
    $userObj = User::find($ticketObj->user_id);
    $departmentObj = Department::find($ticketObj->department_id);
    return view('ticket.show', compact('ticketObj', 'ticketReplyCol', 'userObj', 'departmentObj'));
  }
}
