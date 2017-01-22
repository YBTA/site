@extends('layout')

@section('content')
  <div class="row">
    <div class="col-md-6">
      <ul class="list-group">
        @foreach($houses as $house)
          <li class="list-group-item">{{ $house->address }}</li>
        @endforeach
      </ul>
      <hr>
      <h3>Sell a new House</h3>
      <form method="POST" action="/houses">
        <div class="form-group">
          <input type="text" name="address" class="form-control" />
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Sell House</button>
        </div>
      </form>
    </div>
  </div>
@endsection
