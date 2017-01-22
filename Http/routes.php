<?php

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::resource('bookings', 'BookingController');

    Route::get('/', function () {return view('welcome');});

    Route::get('/find', function(){ return view('find'); });

    Route::post('/find', 'SearchController@mainSearch');

    Route::post('/find/filter', 'SearchController@filterSearch');

    Route::get('/home', 'HomeController@index');

    Route::get('/my-houses', 'HousesController@showAll')->middleware('auth');

    Route::get('/houses', 'HousesController@showValuation')->middleware('auth');

    Route::get('/houses/{house}/edit', 'HousesController@show')->middleware('auth');

    Route::get('/houses/{house}/view', 'HousesController@showPublic');

    Route::post('/houses/create', 'HousesController@createHouse')->middleware('auth');

    Route::post('/houses/valuation', 'HousesController@createValuation')->middleware('auth');

    Route::get('/houses/ajax/address', 'HousesController@ajaxGetAddresses')->middleware('auth');

    Route::post('/messages/create', 'MessageController@createMessage')->middleware('auth');

    Route::get('/messages', 'MessageController@show')->middleware('auth');

    Route::post('/houses/{house}/update', 'HousesController@editHouse')->middleware('auth');

    Route::get('/bookings', function () {
    	$data = [
    		'page_title' => 'Home',
    	];
        return view('bookings/index', $data);
    });

    Route::resource('bookings', 'BookingController');

    Route::get('/api', function () {
    	$bookings = DB::table('bookings')->select('id', 'name', 'title', 'start_time as start', 'end_time as end')->get();
    	foreach($bookings as $event)
    	{
    		$event->title = $event->title . ' - ' .$event->name;
    		$event->url = url('bookings/' . $event->id);
    	}
    	return $bookings;
    });
});
