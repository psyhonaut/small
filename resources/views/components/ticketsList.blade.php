@foreach ($ticketsCol as $value)

  @php
  $userObj = App\User::find($value->user_id);
  $departmentObj = App\Department::find($value->department_id);
  @endphp

    <div class="card w-100 shadow-sm mb-5 text-left" data-department="{{ $departmentObj->id }}">
      <div class="card-header d-flex align-items-end justify-content-between py-3">
        <div class="h4 m-0">
          {{ $userObj->name }}
        </div>
        <div class="h6 m-0">
          {{ $departmentObj->name }} / {{ substr($value->created_at, 0, -3) }}
        </div>
      </div>
      <div class="card-body">
        <h3 class="card-title">{{ $value->title }}</h3>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>

          @php
          $replyCol = App\Ticket::find($value->id)->reply;
          $replyLastObj = $replyCol->sortByDesc('created_at')->first();
          $userReplyObj = App\User::find($replyLastObj->user_id);
          @endphp

          <div class="card bg-light mb-4 mt-5">
            <div class="card-header d-flex justify-content-between">
              <div class="h5 m-0">
                {{ $userReplyObj->name }}
              </div>
                {{ substr($replyLastObj->created_at, 0, -3) }}
              </div>
            <div class="card-body">
              <p class="card-text">{{ $replyLastObj->description }}</p>
            </div>
          </div>

      </div>
      <div class="card-footer text-right">

        @if ($value->active)
          <a href="#" class="btn btn-primary" role="button" aria-disabled="true">Закрыть тикет</a>
        @else
          <button type="button" class="btn btn-secondary">Тикет закрыт</button>
        @endif

      </div>
    </div>
@endforeach
