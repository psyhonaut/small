@extends('layouts.app')

@section('content')

  <breadcrumb itemname="создание тикета"></breadcrumb>

  <div class="container">
    <h2 class="text-center my-5">Создание нового тикета</h2>
  </div>

  <form method="POST" action="{{ route('ticket.store') }}">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">
    <div class="container">

    @include('components.alert')

      <div class="row">
        <div class="card w-100 form-group">
          <div class="card-body p-5">

            <div class="w-100 d-flex justify-content-end">
              <div class="col-auto">
                <select
                name="department_id"
                id="department_id"
                class="custom-select my-1 mr-sm-2"
                required>
                <option value="">Выберите отдел</option>
                @foreach ($departmentsCol as $department)
                  <option value="{{ $department->id }}">{{ $department->name }}</option>
                @endforeach
              </select>
            </div>
          </div>

          <label class="h5 mt-5" for="title">Заголовок</label>
          <input
          name="title"
          id="title"
          type="text"
          class="form-control"
          minlength="5"
          required>

          <label class="h5 mt-5" for="description">Описание</label>
          <textarea
          name="description"
          id="description"
          type="text"
          class="form-control"
          rows="5"
          required>
        </textarea>

      </div>
      <div class="card-footer text-right border-top-0 bg-white px-5 mb-5">
        <button type="submit" class="btn btn-success">Отправить</button>
      </div>
    </div>
  </div>
</div>
</form>
@endsection
