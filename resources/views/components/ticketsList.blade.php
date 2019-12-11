@foreach ($ticketsCol as $ticketObj)

  @php
  $userObj = App\User::find($ticketObj->user_id);
  $departmentObj = App\Department::find($ticketObj->department_id);
  @endphp

    <div class="card w-100 shadow-sm mb-5 text-left {{ ( $ticketObj->active ? 'open' : 'close') }}" style="font-size: inherit;
font-weight: inherit; float:none;">
      <div class="card-header d-flex align-items-end justify-content-between py-3">
        <div class="h5 m-0">
          {{ $userObj->name }}
        </div>
        <div class="h6 m-0">
          {{ $departmentObj->name }} / {{ date('Y-m-d H:i', strtotime($ticketObj->created_at)) }}
        </div>
      </div>
      <div class="card-body">
        <h5 class="card-title mt-4">{{ $ticketObj->title }}</h5>
        <p class="card-text">{{ $ticketObj->description }}</p>

        @php
        $replyLastObj = App\Ticket::find($ticketObj->id)->replyLast->first();
        @endphp

        @if (!empty($replyLastObj->user_id))

          @php
          $userReplyObj = App\User::find($replyLastObj->user_id);
          @endphp

          <div class="card bg-light mb-4 mt-5">
            <div class="card-header d-flex justify-content-between">
              <div class="h6 m-0">
                {{ $userReplyObj->name }}
              </div>
              {{ date('Y-m-d H:i', strtotime($replyLastObj->created_at)) }}
            </div>
            <div class="card-body">
              <p class="card-text">{{ $replyLastObj->description }}</p>
            </div>
          </div>

        @else

          Ответов нет

        @endif

      </div>
      <div class="card-footer text-right">

        <a href="{{ route('ticket.show', $ticketObj->id) }}" class="btn btn-light" role="button" aria-disabled="false">Просмотр тикета</a>

        @if ($ticketObj->active)
          @if (Auth::user()->isModerator())
            <a href="{{ route('close', $ticketObj->id) }}" class="btn btn-primary ml-3" role="button" aria-disabled="false">Закрыть тикет</a>
          @endif
        @else
          <button type="button" class="btn btn-secondary ml-3">Тикет закрыт</button>
        @endif

      </div>
    </div>
@endforeach
