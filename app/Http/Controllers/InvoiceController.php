<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Invoice;
class InvoiceController extends Controller
{

  public function __construct(){

  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $invoices = Invoice::where('is_paid',true)->get();
        return response()->json([
          'invoices' => $invoices
        ]);
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
        $invoice = $request->user()->invoices()->create($request->all());
        $invoice->notify(new \App\Notifications\InvoiceCreated());
        return response()->json([
          'invoice' => $invoice
        ]);
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
        $invoice = Invoice::findOrFail($id);
        $invoice->fill($request->all())->save();
        return response()->json([
          'invoice' => $invoice
        ]);
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

        return response()->json([
          'success' => Invoice::findOrFail($id)->delete()
        ]);
    }

    function getPayInvoice($id){
      return view('invoice')->with([
        'invoice' => Invoice::findOrFail($id)
      ]);
    }

    function payInvoice(Request $request,$id){
      $invoice = Invoice::findOrFail($id);
      try {

        \Stripe\Stripe::setApiKey($invoice->user->secret_key);
        // Use Stripe's library to make requests...
        $token = \Stripe\Token::create(array(
          "card" => array(
            "number" => $request->details['cardNumber'],
            "exp_month" => $request->details['expiryMonth'],
            "exp_year" => $request->details['expiryYear'],
            "cvc" => $request->details['cardSecurityCode']
          )
        ));
        $charge = \Stripe\Charge::create(array(
          "amount" => $invoice->amount,
          "currency" => "usd",
          "source" => $token, // obtained with Stripe.js
          "description" => $invoice->description,
          "receipt_email" => $invoice->email
        ));
        $invoice->charge_id = $charge->id;
        $invoice->is_paid = true;
        $invoice->save();

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
          "description" => $request->note
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
