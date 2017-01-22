@extends('layouts.app')

@section('content')
  <form method="POST" action="/houses/valuation">
    {{ csrf_field() }}
<div class="container sell-house">
  <!--<div class="row">
    <div class="col-md-6  col-md-offset-3">
      <ul class="list-group">
        @foreach($houses as $house)
          <li class="list-group-item"><a href="/houses/{{ $house->id }}/edit">{{ $house->address_first_line }}</a></li>
        @endforeach
      </ul>
      <hr>

    </div>
  </div>-->
  <div class="row">
    <div class="col-md-12">
      <h2>Sell your house - Valuation request</h2>
    </div>
  </div>
  <div class="row">
    <div class="col-md-5">
        <input type="hidden" name="lat" value="">
        <input type="hidden" name="lng" value="">
              <div class="form-group"><label for="">Postcode</label>
                <input type="text" class="form-control" name="postcode" value="{{ old('postcode') }}" />
              </div>
              <div class="form-group"><label for="">House No.</label>
                <input type="text" class="form-control" name="address_house_number" value="" />
              </div>
              <div class="form-group"><label for="">Street Name</label>
                <input type="text" class="form-control" name="address_first_line" value="" />
              </div>
              <div class="form-group"><label for="">Address Line 2</label>
                <input type="text" class="form-control" name="address_second_line" value="" />
              </div>
              <div class="form-group"><label for="">Address Line 3</label>
                <input type="text" class="form-control" name="address_third_line" value="" />
              </div>
              <div class="form-group"><label for="">Town/City</label>
                <input type="text" class="form-control" name="address_town" value="" />
              </div>
              <div class="form-group"><label for="">County</label>
                <input type="text" class="form-control" name="address_county" value="" />
              </div>
    </div>
    <div class="col-md-2">
      <div class="">
        <a class="btn pull-right" id="find-address" style="font-size:1.3em"><span class="b">address</span><span class="y">search</span></a>
      </div>
    </div>
    <div class="col-md-5">
      <!--<div class="form-group"><label for="">Picture</label>
        <input type="file" name="house_image" class="form-control" />
      </div>
      <div class="form-group"><label for="">Asking Price</label>
        <input type="number" name="asking_price" class="form-control money-input" min="1" step="any" value=""/>
      </div>-->
      <div class="form-group"><label for="">Type of Property</label>
        <select class="form-control" name="property_type">
          <option value="house">House</option>
          <option value="flat">Flat/Apartment</option>
        </select>
      </div>
      <div class="form-group"><label for="">No. of Bedrooms</label>
        <input type="number" class="form-control" name="bedrooms" value="">
      </div>
      <div class="form-group"><label for="">No. of Bathrooms</label>
        <input type="number" class="form-control" name="bathrooms" value="">
      </div>
      <div class="form-group"><label for="">Reason for move</label>
        <input type="text" class="form-control" name="reason_for_move" value="">
      </div>
      <div class="form-group"><label for="">Additional Info</label>
        <textarea class="form-control" name="additional_info">
        </textarea>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
    @if (count($errors))
      <ul>
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    @endif
    </div>
    <div class="col-md-6">
      <div class="form-group">
        <button type="submit" class="btn btn-primary pull-right"><span class="y">get</span><span class="b">valuation</span></button>
      </div>
    </div>
  </div>
</div>
</form>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Pick address</h4>
      </div>
      <div class="modal-body">
        <select name="address" id="addresses">

        </select>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="set-address" data-dismiss="modal"><span class="y">use</span><span class="b">address</span></button>
      </div>
    </div>

  </div>
</div>
@endsection
