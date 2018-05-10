<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Mail\FrontPageMessage;
class MessageController extends Controller
{
    //
    public function sendMessage(Request $request){
      Mail::to('inquiries@jyroneparker.com')->send(new FrontPageMessage($request->name,$request->email,$request->message));
      return back();
    }
}
