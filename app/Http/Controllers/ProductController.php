<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        Stripe\Stripe::setApiKey($request->user()->secret_key);
        return response()->json(Stripe\Product::all());
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
        \Stripe\Stripe::setApiKey($request->user()->secret_key);
        $product = \Stripe\Product::create(array(
          "name" => $request->name,
          "type" => $request->type,
          "description" => $request->description,
          "attributes" => $request->attributes
        ));
        return response()->json($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$id)
    {
        //
        Stripe\Stripe::setApiKey($request->user()->secret_key);
        $product = \Stripe\Product::retrieve($id);
        return response()->json($product);
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
        \Stripe\Stripe::setApiKey($request->user()->secret_key);
        $product = \Stripe\Product::retrieve($id);

          $product->name = $request->name;
          $product->type = $request->type;
          $product->description = $request->description;
          $product->attributes = $request->attributes;
          $product->save();
        return response()->json($product);

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
        \Stripe\Stripe::setApiKey($request->user()->secret_key);
        $product = \Stripe\Product::retrieve($id);
        return response()->json([
          'success' => $product->delete()
        ]);
    }
}
