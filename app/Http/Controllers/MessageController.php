<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function sendMessage(Request $request){
      Mail::to('inquiries@jyroneparker.com')->send(new FrontPageMessage($request->name,$request->email,$request->message));
    }
}
