@php
  $routeName = Route::currentRouteName();
@endphp

<div class="card w-100 shadow-sm mb-5 text-left {{ ( $ticketObj->active || $routeName == 'ticket.show' ? 'open' : 'close') }}" style="font-size: inherit; font-weight: inherit; float:none;">
  <div class="card-header d-flex align-items-end justify-content-between py-3">
    <div class="h4 m-0">
      {{ $userObj->name }}
    </div>
    <div class="h6 m-0">
      {{ $departmentObj->name }} / {{ $ticketObj->created_at->format('Y-m-d H:i') }}
    </div>
  </div>
  <div class="card-body">
    <h4 class="card-title mt-4">{{ $ticketObj->title }}</h4>
    <p class="card-text">{{ $ticketObj->description }}</p>
    {{ $slot }}
  </div>
</div>
