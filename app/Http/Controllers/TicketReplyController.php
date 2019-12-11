<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\TicketReply;
use App\Http\Requests\TicketReplyCreateRequest;
use App\Ticket;

class TicketReplyController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketReplyCreateRequest $request)
    {
      $data = $request->input();
      $item = (new TicketReply())->create($data);

      $ticketObj = Ticket::find($item->ticket_id);

      if($ticketObj)
      {
        $ticketObj->last_active = $item->created_at;
        $ticketObj->save();
      }

      if($item)
      {
        return redirect()->route('ticket.show', [$item->ticket_id])->with(['success' => 'Успешно сохранено']);
      } else {
        return back()->withErrors(['msg' => 'Ошибка сохранения']);
      }
    }
}
