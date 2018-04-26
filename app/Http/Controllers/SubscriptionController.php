<?php

namespace App\Http\Controllers;
use App\Mail\SubscriptionActivation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SubscriptionController extends Controller
{
  public function __construct(){
    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
  }
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
      //
      return \Stripe\Subscription::all();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
      //
      $token = \Stripe\Token::create(array(
        "card" => array(
          "number" => $request->pay['details']['cardNumber'],
          "exp_month" => $request->pay['details']['expiryMonth'],
          "exp_year" => $request->pay['details']['expiryYear'],
          "cvc" => $request->pay['details']['cardSecurityCode']
        )
      ));
      return \Stripe\Subscription::create(array(
        "customer" => $request->input('customer'),
        "items" => array(
          array(
            "plan" => $request->input('plan')

          )),
          "source" => $token
      ));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
      //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id)
  {
      //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
      //
  }

  public function sendActivationEmail(Request $request){
    Mail::to($request->input('customer.email'))->send(new SubscriptionActivation($request->customer,$request->plan));
  }

  public function showActivation(Request $request){
    $with = [
      'customer_id' => $request->customer_id,
      'plan_id' => $request->plan_id,
      'amount' => $request->amount
    ];
    return view('subscription-activate')->with($with);
  }
}
