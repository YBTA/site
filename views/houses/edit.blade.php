@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6 col-md-offset-3">
      @if(isset($address))
      <h3>Please select the correct address</h3>
      <form method="POST" action="/houses/create">
        {{ csrf_field() }}
        <input type="hidden" name="postcode" value="{{ $pc }}" />
        <input type="hidden" name="lat" value="{{ $address->Latitude }}" />
        <input type="hidden" name="lng" value="{{ $address->Longitude }}" />
          <div class="form-group">
            <select name="address" class="form-control">
            @foreach($address->Addresses as $add)
              <option value="{{ $add }}">{{ $add }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">Sell this House</button>
        </div>
      </form>
      @else
      <form method="POST" action="/houses/{{ $house->id }}/update" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="house_id" value="{{ $house->id }}" />
      <h1>Edit - <input type="text" name="address_first_line" value="{{ $house->address_first_line }}" /></h1>
      <div class="form-group"><label for="">Address Line 2</label>
        <input type="text" class="form-control" name="address_second_line" value="{{ $house->address_second_line }}" />
      </div>
      <div class="form-group"><label for="">Address Line 3</label>
        <input type="text" class="form-control" name="address_third_line" value="{{ $house->address_third_line }}" />
      </div>
      <div class="form-group"><label for="">Town/City</label>
        <input type="text" class="form-control" name="address_town" value="{{ $house->address_town }}" />
      </div>
      <div class="form-group"><label for="">County</label>
        <input type="text" class="form-control" name="address_county" value="{{ $house->address_county }}" />
      </div>
      <div class="form-group"><label for="">Picture</label>
        <input type="file" name="house_image" class="form-control" />
        @if (isset($house->house_image))
          <img src="/{{ $house->house_image['original_filedir']}}" />
        @endif
      </div>
      <div class="form-group"><label for="">Asking Price</label>
        <input type="number" name="asking_price" class="form-control money-input" min="1" step="any" value="{{ $house->asking_price }}"/>
      </div>
      <div class="form-group"><label for="">Type of Property</label>
        <select class="form-control" name="property_type">
          <option>Pick Property Type...</option>
          @if ($house->property_type == 'house')
          <option value="house" selected="selected">House</option>
          @else
          <option value="house">House</option>
          @endif
          @if ($house->property_type == 'flat')
          <option value="flat" selected="selected">Flat/Apartment</option>
          @else
          <option value="flat">Flat/Apartment</option>
          @endif

        </select>
      </div>
      <div class="form-group"><label for="">Bedrooms</label>
        <input type="number" class="form-control" name="bedrooms" value="{{ $house->bedrooms }}" placeholder="Number of Bedrooms...">
      </div>
      <div class="form-group"><label for="">Bathrooms</label>
        <input type="number" class="form-control" name="bathrooms" value="{{ $house->bathrooms }}" placeholder="Number of Bathrooms...">
      </div>
      <div class="form-group"><label for="">Reason for move</label>
        <input type="text" class="form-control" name="reason_for_move" value="{{ $house->reason_for_move }}" placeholder="Your Reason for moving">
      </div>
      <div class="form-group"><label for="">Additional Info</label>
        <textarea class="form-control" name="additional_info">
          {{ $house->additional_info }}
        </textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn">Update House</button>
      </div>
      </form>
      @endif
    </div>
  </div>
</div>
@endsection
