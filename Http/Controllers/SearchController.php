<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\House;
use App\Http\Requests;
use DB;

class SearchController extends Controller
{
    public function mainSearch(Request $request)
    {
      $search = new \stdClass();
      $search->location = $request->search;
      $json = json_decode( file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($request->search.', UK')) );
      //dd($json);

      // Currently getting first result, need to ask which if more than 1
      $lat = $json->results[0]->geometry->location->lat;
      $lng = $json->results[0]->geometry->location->lng;
      $location = array($lat, $lng);
      // Hardcoded for now
      $radius = $request->radius;

      $houses = House::select(
                DB::raw("*, ( 3959 * acos( cos( radians(?) ) *
                                cos( radians( lat ) )
                                * cos( radians( lng ) - radians(?)
                                ) + sin( radians(?) ) *
                                sin( radians( lat ) ) )
                              ) AS distance"))
                ->having("distance", "<", $radius)
                ->orderBy("distance")
                ->setBindings([$lat, $lng, $lat], 'select')
                ->get();
      $result = compact('search','houses','location');
      return view('search.list', compact('result'));
    }

    public function filterSearch(Request $request)
    {
      $search = new \stdClass();
      $search->location = $request->search;
      $search->bathrooms = $request->bathrooms;
      $search->bedrooms = $request->bedrooms;
      $json = json_decode( file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($search->location.', UK')) );
      //dd($json);

      // Currently getting first result, need to ask which if more than 1
      $lat = $json->results[0]->geometry->location->lat;
      $lng = $json->results[0]->geometry->location->lng;
      $location = array($lat, $lng);
      // Hardcoded for now
      $radius = $request->radius;

      $houses = House::meta()
        ->where("house__metas.key", "=", 'bathrooms')
                ->where("house__metas.value", "=", $request->bathrooms)
                ->where("house__metas.key", "=", 'bedrooms')
                ->where("house__metas.value", "=", $request->bedrooms)
                ->get();

      dd($houses);

      // $houses = House::select(
      //           DB::raw("*, ( 3959 * acos( cos( radians(?) ) *
      //                           cos( radians( lat ) )
      //                           * cos( radians( lng ) - radians(?)
      //                           ) + sin( radians(?) ) *
      //                           sin( radians( lat ) ) )
      //                         ) AS distance"))
      //           ->having("distance", "<", $radius)
      //           ->orderBy("distance")
      //           ->setBindings([$lat, $lng, $lat], 'select')
      //           ->get();
      $result = compact('search','houses','location');
      return view('search.list', compact('result'));
    }
}
