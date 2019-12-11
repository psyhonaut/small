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
