@extends('layouts.app')

@section('content')
<div class="container home">
  <div id="map" style="min-height:400px;"></div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form method="POST" action="/find" class="find-form" >
                      <div class="form-group">
                        {{ csrf_field() }}
                        <input type="text" name="search" class="form-control" style="width:70%;float:left;" placeholder="Enter Location, Postcode or Address" required />
                        <select class="form-control" name="radius" style="width:30%;float:left;">
                          <option value="0">Here Only</option>
                          <option value="5">< 5 Miles</option>
                          <option value="10" selected=selected>< 10 Miles</option>
                          <option value="15">< 15 Miles</option>
                          <option value="20">< 20 Miles</option>
                          <option value="30">< 30 Miles</option>
                        </select>
                        <button type="submit" class="btn btn-primary" style="margin-top:1em;"><span class="y">search</span><span class="b">for</span><span class="y">property</span></button>
                      </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBz1MoZ77R4-GwouiOexahjYtjPHaHus2I&callback=initMap" async defer></script>
  <script>
  function initMap(){
    $.get("http://ipinfo.io", function(response) {

    var latlng = response.loc.split(',');
    console.log(latlng);
    var myLatLng = {lat: parseInt(latlng[0]), lng: parseInt(latlng[1])};
    var map = new google.maps.Map(document.getElementById('map'),{
        zoom:10,
        center: myLatLng,
        scrollwheel: false,
        styles: [ { "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [ { "color": "#444444" } ] }, { "featureType": "landscape", "elementType": "all", "stylers": [ { "color": "#f2f2f2" } ] }, { "featureType": "poi", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "road", "elementType": "all", "stylers": [ { "saturation": -100 }, { "lightness": 45 } ] }, { "featureType": "road", "elementType": "geometry.fill", "stylers": [ { "visibility": "on" }, { "color": "#fcae4c" } ] }, { "featureType": "road", "elementType": "labels", "stylers": [ { "visibility": "on" } ] }, { "featureType": "road", "elementType": "labels.text", "stylers": [ { "visibility": "on" } ] }, { "featureType": "road.highway", "elementType": "all", "stylers": [ { "visibility": "simplified" } ] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [ { "visibility": "off" } ] }, { "featureType": "transit", "elementType": "all", "stylers": [ { "visibility": "off" } ] }, { "featureType": "water", "elementType": "all", "stylers": [ { "color": "#46bcec" }, { "visibility": "on" } ] }, { "featureType": "water", "elementType": "geometry.fill", "stylers": [ { "color": "#192f4e" } ] } ],
      });
      }, "jsonp");
    }
  </script>
@endsection
