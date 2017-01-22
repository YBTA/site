@extends('layouts.app')

@section('content')
<div class="container">
  <div id="map" style="min-height:400px;"></div>
  <div class="row">
    <div class="col-md-6  col-md-offset-3">
      <h3>Search Results for {{ $result['search']->location }} - {{ count($result['houses']) }} Found <span class="pull-right list-toggle">List +</span></h3>

    </div>
  </div>
  <div class="row">
    <div class="col-sm-3 white-bg">
      <form method="POST" action="/find/filter">
        {{ csrf_field() }}
        <label for="search">Where?</label>
        <input type="text" name="search" value="{{ $result['search']->location }}">
        <label for="radius">How far?</label>
        <select class="form-control" name="radius" style="width:100%;">
          <option value="0">Here Only</option>
          <option value="5">< 5 Miles</option>
          <option value="10" selected=selected>< 10 Miles</option>
          <option value="15">< 15 Miles</option>
          <option value="20">< 20 Miles</option>
          <option value="30">< 30 Miles</option>
        </select>
        <label for="bedrooms">Bedrooms</label>
        <input type="number" name="bedrooms" value="{{ isset($result['search']->bedrooms) ? $result['search']->bedrooms : '' }}">
        <label for="bathrooms">Bathrooms</label>
        <input type="number" name="bathrooms" value="{{ isset($result['search']->bathrooms) ? $result['search']->bathrooms : '' }}">
        <input type="submit" name="searchButton" class="btn btn-primary" value="Refine Search">
      </form>
    </div>
    <div class="col-sm-9 house-list" style="display:none;">
      <ul class="list-group">
        @foreach($result['houses'] as $house)
          <li class="list-group-item"><a href="/houses/{{ $house->id }}/view">{{ $house->address_first_line }}, {{ $house->address_town }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
</div>
@endsection

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBz1MoZ77R4-GwouiOexahjYtjPHaHus2I&callback=initMap" async defer></script>
  <script>
    @if(isset($result['location']))
    function initMap(){
      var myLatLng = {lat: {{ $result['location'][0] }}, lng: {{ $result['location'][1] }}};
      var map = new google.maps.Map(document.getElementById('map'),{
          zoom:10,
          center: myLatLng,
          scrollwheel: false,
          styles: [ { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#fcae4c" } ] }, { "featureType": "road", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "road", "elementType": "labels.text", "stylers": [ { "visibility": "on" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#46bcec" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#192f4e" } ] } ],
        });
      addMarkers(map);
    }

    function addMarkers(map){
      var markers = [];
      @foreach($result['houses'] as $house)
        markers.push([  '{{ $house->address_first_line }}<br />{{ $house->address_locality }}<br />{{ $house->address_town }}<br />{{ $house->postcode }}', { lat: {{ $house->lat }}, lng: {{ $house->lng }}  }, {{ $house->id }}, '{{ $house->house_image['dimensions']['square100']['filedir'] }}'  ]);
      @endforeach
      for(i = 0; i < markers.length; i++){
        addMarker(map, markers[i][1], markers[i][0], markers[i][2], markers[i][3]);
      }
    }

    function addMarker(map, latLng, address, id, image){
      var infoWindow = new google.maps.InfoWindow({
        content: '<img src="/'+image+'" />'+address + '<br /><a href="/houses/'+id+'/view">More Info</a>'
      });
      var marker = new google.maps.Marker({
        position: latLng,
        title: address,
        icon: '/images/marker.png'
      });
      marker.addListener('click', function(){
        infoWindow.open(map, marker);
      });
      marker.setMap(map);
    }
    @endif;

    $('.list-toggle').click(function(){
      $('.house-list').toggle();
    })

  </script>
@endsection
