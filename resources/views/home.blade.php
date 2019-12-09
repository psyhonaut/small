@extends('layouts.app')

@section('content')
  <div class="container text-center">

      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      <h2 class="my-5">Просмотр всех тикетов</h2>

      <div id="todos-example"></div>

      <form>
        <div class="form-row text-right">
          <div class="form-group col-md-10">
            <div class="form-check">
              <input class="form-check-input" type="checkbox" id="gridCheck">
              <label class="form-check-label" for="gridCheck">
                Показать закрытые тикеты
              </label>
            </div>
          </div>
          <div class="form-group col-md-2">
            <select class="form-control" id="FormControlSelect">
              <option>Все отделы</option>

              @foreach ($departmentsCol as $key => $value)
                <option>{{ $value->name }}</option>
              @endforeach

            </select>
          </div>
        </div>
      </form>

      @component('components.ticketsList', compact('ticketsCol'))@endcomponent

      @if ($ticketsCol->total() > $ticketsCol->count())
        <nav aria-label="Page navigation example">
          <ul class="pagination">
            {{ $ticketsCol->links() }}
          </ul>
        </nav>
      @endif

  </div>
@endsection
