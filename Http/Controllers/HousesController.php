<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\User;
use App\Http\Requests;
use Imageupload;

class HousesController extends Controller
{
    public function showAll(Request $request)
    {
        $houses = House::where('user_id', $request->user()->id)->get();
        return view('houses/myhouses', compact('houses'));
    }

    public function showValuation(Request $request)
    {
      $houses = House::where('user_id', $request->user()->id)->get();
      return view('houses/show', compact('houses'));
    }

    public function show(House $house)
    {
      return view('houses/edit', compact('house'));
    }

    public function showPublic(House $house)
    {
      $house = House::with('user')->where('id',$house->id)->first();
      //dd($house);
      return view('houses/public', compact('house'));
    }

    public function createHouse(Request $request){
      $this->validate($request, [
        'number' => 'required',
        'postcode' => ['required','min:5']
      ]);
      $pc = str_replace(' ', '',$request->postcode);
      //$pcDetails = file_get_contents('http://api.postcodes.io/postcodes/'.urlencode($request->postcode) );
      $address = $this->getAddress($pc,$request->number);
      print_r($address);
      //dd($address);
      if(isset($address->Message) && $address->Message == 'Not Found')
       $address = $this->getAddress($pc);

      if(count($address->Addresses) > 1)
        return view('houses.edit', compact('address', 'pc'));

      $house = new House();
      $house->number = $request->number;
      $house->postcode = $request->postcode;
      $house->address = isset($request->address) ? $request->address : $address->Addresses[0];
      $addressArray = explode(',', $house->address);
      $house->address_first_line = $addressArray[0];
      $house->address_second_line = $addressArray[1];
      $house->address_third_line = $addressArray[2];
      $house->address_forth_line = $addressArray[3];
      $house->address_locality = $addressArray[4];
      $house->address_town = $addressArray[5];
      $house->address_county = $addressArray[6];
      $house->lat = isset($request->lat) ? $request->lat : $address->Latitude;
      $house->lng = isset($request->lng) ? $request->lng : $address->Longitude;
      $house->user_id = $request->user()->id;
      $house->save();
      return redirect('/houses');
    }

    public function createValuation(Request $request){
      $this->validate($request, [
        'postcode' => ['required','min:5']
      ]);
      $pc = str_replace(' ', '',$request->postcode);
      //$pcDetails = file_get_contents('http://api.postcodes.io/postcodes/'.urlencode($request->postcode) );

      $house = new House();
      $house->number = $request->address_house_number;
      $house->postcode = $request->postcode;

      $house->bathrooms = $request->bathrooms;
      $house->bedrooms = $request->bedrooms;
      $house->address_first_line = $request->address_first_line;
      $house->address_second_line = $request->address_second_line;
      $house->address_third_line = $request->address_third_line;
      //$house->address_forth_line = $request->address_forth_line;
      //$house->address_locality = $request->address_locality;
      $house->address_town = $request->address_town;
      $house->address_county = $request->address_county;
      $house->bathrooms = $request->bathrooms;
      $house->bedrooms = $request->bedrooms;
      //$house->reception_rooms = $request->reception_rooms;
      $house->property_type = $request->property_type;
      $house->reason_for_move = $request->reason_for_move;
      $house->additional_info = $request->additional_info;
      //$house->asking_price = $request->asking_price;

      $house->lat = $request->lat;
      $house->lng = $request->lng;
      $house->user_id = $request->user()->id;
      $house->save();
      return redirect('/houses/'.$house->id.'/edit');
    }

    public function editHouse(Request $request) {
      $house = House::find($request->house_id);
      $house->bathrooms = $request->bathrooms;
      $house->bedrooms = $request->bedrooms;
      $house->reception_rooms = $request->reception_rooms;
      $house->address_first_line = $request->address_first_line;
      $house->address_second_line = $request->address_second_line;
      $house->address_third_line = $request->address_third_line;
      $house->address_forth_line = $request->address_forth_line;
      $house->address_locality = $request->address_locality;
      $house->address_town = $request->address_town;
      $house->address_county = $request->address_county;
      $house->bathrooms = $request->bathrooms;
      $house->bedrooms = $request->bedrooms;
      $house->reception_rooms = $request->reception_rooms;
      $house->property_type = $request->property_type;
      $house->reason_for_move = $request->reason_for_move;
      $house->additional_info = $request->additional_info;
      $house->asking_price = $request->asking_price;
      if($request->hasFile('house_image')){
        $img = Imageupload::upload($request->file('house_image'));
        $house->house_image = $img;
      }
      $house->save();
      return redirect('/houses/'.$request->house_id.'/edit');
    }

    // Get address from getaddress.io api
    public function getAddress($postcode, $number = null)
    {
      $urlend = !empty($postcode) ? $postcode.'/'.$number : $postcode;
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, 'https://api.getAddress.io/v2/uk/'.$urlend );
      curl_setopt($ch, CURLOPT_USERPWD, 'api-key:bPmHugF8JUqPrKfY0NVYWg6288');
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $add = curl_exec($ch);
      curl_close($ch);
      return json_decode( $add );
    }

    public function ajaxGetAddresses(){
      $postcode = $_GET['postcode'];
      $address = $this->getAddress($postcode);
      $address = json_encode($address);
      die($address);
    }

}
