@extends('layouts.app')

@section('content')
  <div class="container text-center">

      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

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

      <h2 class="my-5">Просмотр всех тикетов</h2>

      <form action="http://localhost:8888/small/public/">
        <div class="form-row align-items-center py-3 flex-row-reverse">
          <div class="col-auto">
            <button type="submit" class="btn btn-dark">Показать</button>
          </div>
          <div class="col-auto">
            <select class="custom-select my-1 mr-sm-2" name="department" id="department">
              <option value="">Все отделы</option>
              <option value="1" {{ request()->department == 1 ? 'selected' : null }}>IT отдел</option>
              <option value="2" {{ request()->department == 2 ? 'selected' : null }}>Отдел продаж</option>
              <option value="3" {{ request()->department == 3 ? 'selected' : null }}>Финансовый отдел</option>
            </select>
          </div>
          <div class="col-auto">
            <div class="custom-control custom-checkbox my-1 mr-sm-2">
              <input class="form-check-input" type="checkbox" name="active" id="active" {{ request()->active == 'on' ? 'checked' : null }}>
              <label class="form-check-label" for="active">Показать закрытые тикеты</label>
            </div>
          </div>
        </div>
      </form>

      @component('components.ticketsList', compact('ticketsCol'))@endcomponent

      @if ($ticketsCol->total() > $ticketsCol->count())
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            {{ $ticketsCol->appends(['department' => request()->department, 'active' => request()->active])->render() }}
          </ul>
        </nav>
      @endif

  </div>
@endsection
