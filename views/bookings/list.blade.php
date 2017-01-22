@extends('layouts.app')

@section('content')

<div class="row">
	<div clss="col-lg-12">
		<ol class="breadcrumb">
			<li>You are here: <a href="{{ url('/') }}">Home</a></li>
			<li class="active"><a href="{{ url('/events') }}">Events</a></li>
		</ol>
	</div>
</div>

<div class="row">
	<div class="col-lg-12">
		@if($bookings->count() > 0)
		<table class="table table-striped">
			<thead>
				<tr>
					<th>#</th>
					<th>Event's Title</th>
					<th>Start</th>
					<th>End</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 1;?>
			@foreach($bookings as $booking)
				<tr>
					<th scope="row">{{ $i++ }}</th>
					<td><a href="{{ url('events/' . $booking->id) }}">{{ $booking->title }}</a></td>
					<td>{{ date("g:ia\, jS M Y", strtotime($booking->start_time)) }}</td>
					<td>{{date("g:ia\, jS M Y", strtotime($booking->end_time)) }}</td>
					<td>
						<a class="btn btn-primary btn-xs" href="{{ url('events/' . $booking->id . '/edit')}}">
							<span class="glyphicon glyphicon-edit"></span> Edit</a>
						<form action="{{ url('events/' . $booking->id) }}" style="display:inline" method="POST">
							<input type="hidden" name="_method" value="DELETE" />
							{{ csrf_field() }}
							<button class="btn btn-danger btn-xs" type="submit"><span class="glyphicon glyphicon-trash"></span> Delete</button>
						</form>

					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
		@else
			<h2>No event yet!</h2>
		@endif
	</div>
</div>
@endsection
