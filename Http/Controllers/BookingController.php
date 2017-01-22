<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Booking;
use DateTime;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$data = [
			'page_title' => 'bookings',
			'bookings'	 => booking::orderBy('start_time')->get(),
		];

		return view('bookings/list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

		$data = [
			'page_title' => 'Add new booking',
		];

		return view('bookings/create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate($request, [
			'time'	=> 'required'
		]);

		$time = explode(" - ", $request->input('time'));

		$booking 					= new booking;
		$booking->name			= $request->user()->name;
		$booking->title 			= 'Viewing for house';
		$booking->start_time 		= $this->change_date_format($time[0]);
		$booking->end_time 		= $this->change_date_format($time[1]);
    $booking->viewer_id = $request->user()->id;
    $booking->house_id = $request->input('house_id');
		$booking->save();

		$request->session()->flash('success', 'The booking was successfully saved!');
		return redirect('bookings/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$booking = booking::findOrFail($id);

		$first_date = new DateTime($booking->start_time);
		$second_date = new DateTime($booking->end_time);
		$difference = $first_date->diff($second_date);

        $data = [
			'page_title' 	=> $booking->title,
			'booking'			=> $booking,
			'duration'		=> $this->format_interval($difference)
		];

		return view('bookings/view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $booking = booking::findOrFail($id);
		$booking->start_time =  $this->change_date_format_fullcalendar($booking->start_time);
		$booking->end_time =  $this->change_date_format_fullcalendar($booking->end_time);

        $data = [
			'page_title' 	=> 'Edit '.$booking->title,
			'booking'			=> $booking,
		];

		return view('bookings/edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
			'time'	=> 'required|available|duration'
		]);

		$time = explode(" - ", $request->input('time'));

		$booking 					= booking::findOrFail($id);
		$booking->name			= $request->input('name');
		$booking->title 			= $request->input('title');
		$booking->start_time 		= $this->change_date_format($time[0]);
		$booking->end_time 		= $this->change_date_format($time[1]);
		$booking->save();

		return redirect('bookings');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $booking = booking::find($id);
		$booking->delete();

		return redirect('bookings');
    }

	public function change_date_format($date)
	{
		$time = DateTime::createFromFormat('d/m/Y H:i:s', $date);
		return $time->format('Y-m-d H:i:s');
	}

	public function change_date_format_fullcalendar($date)
	{
		$time = DateTime::createFromFormat('Y-m-d H:i:s', $date);
		return $time->format('d/m/Y H:i:s');
	}

	public function format_interval(\DateInterval $interval)
	{
		$result = "";
		if ($interval->y) { $result .= $interval->format("%y year(s) "); }
		if ($interval->m) { $result .= $interval->format("%m month(s) "); }
		if ($interval->d) { $result .= $interval->format("%d day(s) "); }
		if ($interval->h) { $result .= $interval->format("%h hour(s) "); }
		if ($interval->i) { $result .= $interval->format("%i minute(s) "); }
		if ($interval->s) { $result .= $interval->format("%s second(s) "); }

		return $result;
	}
}
