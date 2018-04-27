<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        \Stripe\Stripe::setApiKey(auth()->user()->secret_key);
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $balance = \Stripe\Balance::retrieve();

        $with = [
          'balance' => $balance->available[0]['amount']/100
        ];
        return view('home')->with($with);
    }
}
