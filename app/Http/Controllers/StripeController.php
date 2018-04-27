<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StripeController extends Controller
{
    //
    public function __construct(){

    }

    public function charge(Request $request){
      \Stripe\Stripe::setApiKey(auth()->user()->secret_key);
      try {
        // Use Stripe's library to make requests...
        $token = \Stripe\Token::create(array(
          "card" => array(
            "number" => $request->card['card_number'],
            "exp_month" => $request->card['expiry_month'],
            "exp_year" => $request->card['expiry_year'],
            "cvc" => $request->card['cvv']
          )
        ));
        \Stripe\Charge::create(array(
          "amount" => $request->amount * 100,
          "currency" => "usd",
          "source" => $token, // obtained with Stripe.js
          "description" => $request->description,
          "receipt_email" => $request->email
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
