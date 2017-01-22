@extends('layouts.app')

@section('css')
	<link href="{{ url('_asset/css')}}/jquery.datetimepicker.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6  col-md-offset-3">
      @if (isset($house->house_image))
        <img src="/{{ $house->house_image['original_filedir']}}" />
      @endif
      <h3>{{ $house->address_first_line }}</h3>
      <ul class="list-group">
          <li class="list-group-item">{{ $house->address_locality }}</li>
          <li class="list-group-item">{{ $house->address_town }}</li>
          <li class="list-group-item">{{ $house->postcode }}</li>
          <li class="list-group-item">Bedrooms: {{ $house->bedrooms }}</li>
          <li class="list-group-item">Bathrooms: {{ $house->bathrooms }}</li>
      </ul>
      <hr>
      <div class="panel panel-default">
          <div class="panel-heading">Book a viewing</div>

          <div class="panel-body">
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
              <form action="{{ url('bookings') }}" method="POST">
          			{{ csrf_field() }}
                <input type="hidden" name="house_id" value="{{ $house->id }}" />

          			<div class="form-group @if($errors->has('time')) has-error @endif">
          				<label for="time">Time</label>
          				<div class="input-group">
          					<input type="text" class="form-control" name="time" placeholder="Select your time" value="{{ old('time') }}">
          					<span class="input-group-addon">
          						<span class="glyphicon glyphicon-calendar"></span>
                              </span>
          				</div>
          				@if ($errors->has('time'))
          					<p class="help-block"><span class="glyphicon glyphicon-exclamation-sign"></span>
          					{{ $errors->first('time') }}
          					</p>
          				@endif
          			</div>
          			<button type="submit" class="btn btn-primary">Submit</button>
          		</form>
            @if (count($errors))
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif
        @endif
          </div>
        </div>
      <hr>
      <div class="panel panel-default">
          <div class="panel-heading">Contact - {{$house->user->name}}</div>

          <div class="panel-body">
            @if (Auth::guest())
                <li><a href="{{ url('/login') }}">Login</a></li>
                <li><a href="{{ url('/register') }}">Register</a></li>
            @else
            <form method="POST" action="/messages/create">
              {{ csrf_field() }}
              <input type="hidden" name="recipient_id" value="{{ $house->user->id }}" />
              <div class="form-group">
                <input type="text" class="form-control" name="subject" placeholder="Subject..." />
              </div>
              <div class="form-group">
                <textarea name="body" class="form-control" placeholder="Message to seller..."></textarea>
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">Send Message</button>
              </div>
            </form>
            @if (count($errors))
              <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            @endif
        @endif
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{ url('_asset/js') }}/jquery.datetimepicker.full.min.js"></script>
<script type="text/javascript">
$(function () {
  $('input[name="time"]').datetimepicker();

	// $('input[name="time"]').daterangepicker({
	// 	"minDate": moment('<?php echo date('Y-m-d G')?>'),
	// 	"timePicker": true,
	// 	"timePicker24Hour": true,
	// 	"timePickerIncrement": 15,
	// 	"autoApply": true,
	// 	"locale": {
	// 		"format": "DD/MM/YYYY HH:mm:ss",
	// 		"separator": " - ",
	// 	}
	// });
});
</script>
@endsection
