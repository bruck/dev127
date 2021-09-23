<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;



use App\Http\Resources\MessageResource as MessageResource;
use App\Models\Message as Message;
class MessageController extends Controller
{
  /**	
    public function getmessages()
    {
        $messages
	return Message::collection($messages);
    }
  **/


    public function getmessages() 
    {
        $messages = Message::all();
	return $meesages->toJson($messages);

    }	

    public function getmessage(id)
    {
        $message = Message::find(id);
	return $message->toJson($message);
    }

    public newmessage()
    {
	//verify that email and message exists
	//if it exists verify that it looks like an email address
	if (!$request->input('email')) {
	    return Response::json(array('success' => 'false' , 'error' => 'No email address provided') ,400);
	}
	else if (!$this->valid_email($request->input('email')) {
	    return Response::json(array('success' => 'false' , 'error' => 'Invalid email address') ,400);
	}
	if (!$request->input('message')) {
	    return Response::json(array('success' => 'false' , 'error' => 'Empty message') ,400);
	}

	$message = new Message;
        $message->email = $request->input('email'),
	$message->message =  $request->input('message'),
	$message->widget_id = $request->input('widget_id')
	$message->save();

	$new_id = $message->id;

	//if there's a new id, insert succeeded, return 201 - resource created, and the new id in the body
	//else return an error
	if ($new_id) {
		return Response::json(array('success' => 'true' , 'last_insert_id' => $message->id),201);
	}
	else {
            return Response::json(array('success' => 'false'),424);
	}
    }

    private valid_email($email) {
       //get a standard library and invoke it here
       return 1;
    }



}
