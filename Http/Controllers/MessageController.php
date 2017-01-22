<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;
use App\House;
use App\User;
use DB;
use App\Http\Requests;

class MessageController extends Controller
{
    public function createMessage(Request $request)
    {
      $message = new Message;
      $message->body = $request->body;
      $message->subject = $request->subject;
      $message->sender_id = $request->user()->id;
      $message->recipient_id = $request->recipient_id;
      //$message->house_id = $request->house_id;
      $message->save();
      return back();
    }

    public function show(Request $request)
    {
        $messages = DB::table('messages')->join('users', 'users.id', '=', 'messages.sender_id')->select('*')->where('recipient_id', $request->user()->id)->get();
        //dd($messages);
        return view('messages/show', compact('messages'));
    }
}
