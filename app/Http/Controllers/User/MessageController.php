<?php

namespace App\Http\Controllers\User;

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
            'email' => 'The e-mail must be valid',
            'body' => 'your question should be longer than 15 characters',
        ]);

        $data = $request->all();
       
        $message = new Message();

        $message = Message::create($data);

        $message->save();

        $id = $data['apartment_id'];

        return redirect()->route('users.apartments.show', $id);
    }
}
