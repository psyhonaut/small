@foreach ($ticketsCol as $ticketObj)

  @php
  $userObj = App\User::find($ticketObj->user_id);
  $departmentObj = App\Department::find($ticketObj->department_id);
  @endphp

  @component('components.ticket', compact('userObj', 'departmentObj', 'ticketObj'))

    @php
    $replyLastObj = App\Ticket::find($ticketObj->id)->replyLast->first();
    @endphp

    @if (!empty($replyLastObj->user_id))

      @php
      $userReplyObj = App\User::find($replyLastObj->user_id);
      @endphp

      <ticket-reply
        username="{{ $userReplyObj->name }}"
        date="{{ $replyLastObj->created_at->format('Y-m-d H:i') }}"
        description="{{ $replyLastObj->description }}"
        class="card bg-light mb-4 mt-5"
      ></ticket-reply>

    @endif

    <div class="w-100 text-right">

      <a href="{{ route('ticket.show', $ticketObj->id) }}" class="btn btn-light" role="button" aria-disabled="false">Просмотр тикета</a>

      @if ($ticketObj->active)
        @if (Auth::user()->isModerator())
          <a href="{{ route('close', $ticketObj->id) }}" class="btn btn-primary ml-3" role="button" aria-disabled="false">Закрыть тикет</a>
        @endif
      @else
        <button type="button" class="btn btn-secondary ml-3">Тикет закрыт</button>
      @endif

    </div>
    
  @endcomponent

@endforeach
