@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="row">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb bg-light">
        <li class="breadcrumb-item"><a href="{{ url('/') }}">Главная</a></li>
        <li class="breadcrumb-item active" aria-current="page">просмотр тикета</li>
      </ol>
    </nav>
  </div>
  </div>

  <div class="container mb-5">
    <h3 class="text-center my-5">Просмотр тикета</h3>

    @if ($errors->any())
      <div class="alert alert-danger" role="alert">
        {{ $errors->first() }}
      </div>
    @endif    

    @if (session('success'))
      <div class="alert alert-success" role="alert">
        {{ session()->get('success') }}
      </div>
    @endif

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

      </div>
    </div>

    <h3 class="text-center my-5">Диалог:</h3>

    @foreach ($ticketReplyCol as $ticketReplyObj)

      @php
      $userReplyObj = App\User::find($ticketReplyObj->user_id);
      $replyFloat = ( $userReplyObj->role == 10 ? 'float-left' : 'float-right' );
      @endphp

      <div class="d-block card mb-4 mt-5 col-md-9 px-0 {{ $replyFloat }}">
        <div class="card-header d-flex justify-content-between">
          <div class="h5 m-0">
            {{ $userReplyObj->name }}
          </div>
          {{ date('Y-m-d H:i', strtotime($ticketReplyObj->created_at)) }}
        </div>
        <div class="card-body">
          <p class="card-text">{{ $ticketReplyObj->description }}</p>
        </div>
      </div>

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
