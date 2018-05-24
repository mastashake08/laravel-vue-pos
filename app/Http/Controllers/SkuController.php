<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\SKU;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        \Stripe\Stripe::setApiKey($request->user->secret_key);
        return response()->json(\Stripe\SKU::all());
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
        \Stripe\Stripe::setApiKey($request->user->secret_key);
        switch ($request->type) {
          case 'finite':

          $sku = \Stripe\SKU::create(array(
            "product" => $request->product_id,
            "price" => $request->price * 100,
            "currency" => "usd",
            "inventory" => array(
              "type" => "finite",
              "quantity" => $request->quantity
            )
          ));
            break;

          default:

          $sku = \Stripe\SKU::create(array(
            "product" => $request->product_id,
            "price" => $request->price * 100,
            "currency" => "usd",
            "inventory" => array(
              "type" => "infinite",
            )
          ));
            break;
        }
        return response()->json($sku);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        //
        \Stripe\Stripe::setApiKey($request->user->secret_key);
        $sku = \Stripe\SKU::retrieve($id);
        return response()->json($sku);
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
        \Stripe\Stripe::setApiKey($request->user->secret_key);
        $sku = \SKU::retrive($id);
        switch ($sku->inventory['type']) {
          case 'finite':

            $sku->price = $request->price * 100;
            $sku->inventory = array(
              "type" => "finite",
              "quantity" => $request->quantity
            );
          ));
          $sku->save();
            break;

          default:

          $sku->price = $request->price * 100;
          $sku->save();
            break;
        }

        return response()->json($sku);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        //
        \Stripe\Stripe::setApiKey($request->user->secret_key);
        $sku = \SKU::retrive($id);
        return response()->json([
          'success' => $sku->delete()
        ]);

    }
}
