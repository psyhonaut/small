@extends('layouts.app')

@section('content')
  <div class="container text-center">

    @include('components.alert')

    <h2 class="my-5">Просмотр всех тикетов</h2>

    <form action="{{ route('home') }}">
      <div class="form-row align-items-center py-3 flex-row-reverse">
        <div class="col-auto">
          <button type="submit" class="btn btn-dark">Показать</button>
        </div>
        <div class="col-auto">

          <select class="custom-select my-1 mr-sm-2" name="department" id="department">
            <option value="">Все отделы</option>

            @foreach ($departmentsCol as $department)
              <option value="{{ $department->id }}" {{ request()->department == $department->id ? 'selected' : null }}>{{ $department->name }}</option>
            @endforeach

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
