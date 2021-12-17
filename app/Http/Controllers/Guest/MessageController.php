<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Apartment;

class MessageController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'name' => 'required|string|min:4|max:50',
            'email' => 'required|email',
            'body' => 'required|min:15|max:255',
        ],
        [
            'name.min' => 'Your name should be long at least 4 characters',
            'name.max' => 'Your name can\'t be longer than 50 characters',
            'email.email' => 'The e-mail must be valid',
            'body.min' => 'your message should be longer than 15 characters',
            'body.max' => 'Your message should\'t be longer than 50 characters',
        ]);

        $data = $request->all();
       
        $message = new Message();

        $message = Message::create($data);

        $message->save();

        $id = $data['apartment_id'];

        $thankMessage = 'Thank you for sending the message, the owner will reply as soon as possible.';

        return redirect()->route('guest.apartment', $id)->with("thankMessage", $thankMessage);
    }
}
