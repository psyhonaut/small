@foreach ($ticketsCol as $ticketObj)

  @php
  $userObj = App\User::find($ticketObj->user_id);
  $departmentObj = App\Department::find($ticketObj->department_id);
  @endphp

    <div class="card w-100 shadow-sm mb-5 text-left" data-department="{{ $departmentObj->id }}">
      <div class="card-header d-flex align-items-end justify-content-between py-3">
        <div class="h4 m-0">
          {{ $userObj->name }}
        </div>
        <div class="h6 m-0">
          {{ $departmentObj->name }} / {{ date('Y-m-d H:i', strtotime($ticketObj->created_at)) }}
        </div>
      </div>
      <div class="card-body">
        <h4 class="card-title mt-4">{{ $ticketObj->title }}</h4>
        <p class="card-text">{{ $ticketObj->description }}</p>

        @php
        $replyCol = App\Ticket::find($ticketObj->id)->reply;
        @endphp

        @if (!$replyCol->isEmpty())

          @php
          $replyLastObj = $replyCol->sortByDesc('created_at')->first();
          $userReplyObj = App\User::find($replyLastObj->user_id);
          @endphp

          <div class="card bg-light mb-4 mt-5">
            <div class="card-header d-flex justify-content-between">
              <div class="h5 m-0">
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

        <a href="{{ route('ticket.show', $ticketObj->id) }}" class="btn btn-info" role="button" aria-disabled="true">Просмотр тикета</a>

        @if ($ticketObj->active)
          @if (Auth::user()->isModerator())
            <a href="#" class="btn btn-primary ml-3" role="button" aria-disabled="true">Закрыть тикет</a>
          @endif
        @else
          <button type="button" class="btn btn-secondary ml-3">Тикет закрыт</button>
        @endif

      </div>
    </div>
@endforeach
