@extends('layouts.app')

@section('content')

  <breadcrumb itemname="просмотр тикета"></breadcrumb>

  <div class="container mb-5">
    <h3 class="text-center my-5">Просмотр тикета</h3>

    @include('components.alert')

    @component('components.ticket', compact('userObj', 'departmentObj', 'ticketObj'))@endcomponent

    <h3 class="text-center my-5">Диалог:</h3>

    @foreach ($ticketReplyCol as $ticketReplyObj)

      @php
      $userReplyObj = App\User::find($ticketReplyObj->user_id);
      $replyFloat = ( $userReplyObj->role == 10 ? 'float-left' : 'float-right' );
      @endphp

      <ticket-reply
        username="{{ $userReplyObj->name }}"
        date="{{ $ticketReplyObj->created_at->format('Y-m-d H:i') }}"
        description="{{ $ticketReplyObj->description }}"
        class="d-block card mb-4 mt-5 col-md-9 px-0 {{ $replyFloat }}"
      ></ticket-reply>

    @endforeach

    @if ($ticketObj->active)
      <h3 class="d-inline-block w-100 text-center my-5">Отправить ответ</h3>
      <form method="POST" action="{{ route('ticketReply.store') }}">
        @csrf
        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
        <input type="hidden" id="ticket_id" name="ticket_id" value="{{ $ticketObj->id }}">
        <div class="container">

          <div class="row">
              <div class="card w-100 form-group">
                <div class="card-body px-5 pt-5">

                    <textarea placeholder="Введите сообщение"
                    name="description"
                    id="description"
                    type="text"
                    class="form-control"
                    rows="5"
                    required></textarea>

              </div>
              <div class="card-footer text-right border-top-0 bg-white px-5 mb-5">
                <button type="submit" class="btn btn-success">Отправить</button>
              </div>
            </div>
        </div>
      </div>
    </form>
    @endif

  </div>

@endsection
