<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
  protected $table = 'bookings'; // you may change this to your name table
  public $timestamps = false;
  protected $primaryKey = 'id';

  public function index()
{
  return view('event/list', ['events' => Event::orderBy('start_time')->get()]);
}

public function create()
{
  return view('event/create');
}

public function store(Request $request)
{
  $time = explode(" - ", $request->input('time'));

 $event = new Event;
 $event->name = $request->input('name');
 $event->title = $request->input('title');
 $event->start_time = $time[0];
 $event->end_time = $time[1];
 $event->save();

 $request->session()->flash('success', 'The event was successfully saved!');
 return redirect('events/create');
}

public function show($id)
{
 return view('event/view', ['event' => Event::findOrFail($id)]);
}

public function edit($id)
{
 return view('event/edit', ['event' => Event::findOrFail($id)]);
}

public function update(Request $request, $id)
{
 $time = explode(" - ", $request->input('time'));

 $event = Event::findOrFail($id);
 $event->name = $request->input('name');
 $event->title = $request->input('title');
 $event->start_time = $time[0];
 $event->end_time = $time[1];
 $event->save();

 return redirect('events');
}

public function destroy($id)
{
 $event = Event::find($id);
 $event->delete();

 return redirect('events');
}
}
