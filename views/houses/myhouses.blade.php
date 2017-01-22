@extends('layouts.app')

@section('content')

<div class="container my-houses">
  <div class="row">
    <div class="col-md-12">
      <h2>My Houses</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-8  col-md-offset-2">
      @if(isset($houses))
      <table>
        <tr>
          <th>Date Listed</th>
          <th>Property</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
        @foreach($houses as $house)
          <tr><td>{{ $house->created_at }}</td><td><a href="/houses/{{ $house->id }}/edit">{{$house->address_first_line}}<br />{{$house->postcode}}<br />{{$house->address_town}}</a></td><td><i class="fa fa-house listed"></i><span>Listed</span></td><td><a href="/houses/{{ $house->id }}/edit">Edit</a></td></tr>
        @endforeach
      </table>
      @else
        <p>You currently have no homes for sale</p>
      @endif
      <a href="/houses" class="btn"><span class="y">get</span><span class="b">valuation</span></a>
    </div>
  </div>
@endsection
