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

        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        \Stripe\Stripe::setApiKey(auth()->user()->secret_key);
        $balance = \Stripe\Balance::retrieve();

        $with = [
          'balance' => $balance->available[0]['amount']/100
        ];
        return view('home')->with($with);
    }

    public function sendPay(Request $request, $name){
      $user = \App\User::where('name',$name)->first();
      $with = [
        'user' => $user
      ];
      return view('send')->with($with);
    }

    public function sendPayment(Request $request,$id){
      $user = \App\User::findOrFail($id);
      try {

        \Stripe\Stripe::setApiKey($user->secret_key);
        // Use Stripe's library to make requests...
        $token = \Stripe\Token::create(array(
          "card" => array(
            "number" => $request->pay['details']['cardNumber'],
            "exp_month" => $request->pay['details']['expiryMonth'],
            "exp_year" => $request->pay['details']['expiryYear'],
            "cvc" => $request->pay['details']['cardSecurityCode']
          )
        ));
        $charge = \Stripe\Charge::create(array(
          "amount" => $request->amount,
          "currency" => "usd",
          "source" => $token,
        ));

        return response()->json([
          'success' => true
        ]);
      } catch(\Stripe\Error\Card $e) {
        // Since it's a decline, \Stripe\Error\Card will be caught
        return response()->json($e->getJsonBody());
      } catch (\Stripe\Error\RateLimit $e) {
        // Too many requests made to the API too quickly
        return response()->json($e->getJsonBody());
      } catch (\Stripe\Error\InvalidRequest $e) {
        // Invalid parameters were supplied to Stripe's API
        return response()->json($e->getJsonBody());
      } catch (\Stripe\Error\Authentication $e) {
        // Authentication with Stripe's API failed
        // (maybe you changed API keys recently)
        return response()->json($e->getJsonBody());
      } catch (\Stripe\Error\ApiConnection $e) {
        // Network communication with Stripe failed
        return response()->json($e->getJsonBody());
      } catch (\Stripe\Error\Base $e) {
        // Display a very generic error to the user, and maybe send
        // yourself an email
        return response()->json($e->getJsonBody());
      } catch (Exception $e) {
        // Something else happened, completely unrelated to Stripe
        return response()->json($e->getJsonBody());
      }
    }
}
