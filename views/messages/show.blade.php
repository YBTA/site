@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6  col-md-offset-3">
      <h3>Messages</h3>
        @foreach($messages as $message)
        <div class="panel panel-default">
            <div class="panel-heading">{{ $message->subject }}</div>

            <div class="panel-body">
              {{ $message->body }}
            </div>
            <div class="panel-footer">From - {{ $message->name }} <a href="/messages/{{ $message->id }}/reply" class="pull-right">Reply</a></div>
          </div>
        @endforeach
    </div>
  </div>
</div>
@endsection
