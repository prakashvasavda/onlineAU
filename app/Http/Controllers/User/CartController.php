<?php

namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Packages;


class CartController extends Controller{
    
    public function index(){

    }

    public function create(){
        //
    }

    public function store(Request $request){
        $package = Packages::where('name', $request->package_name)->first();
        $cart = session()->get('cart', []);

        if(isset($cart[$package->id])) {
            return response()->json(['status' => 404,'cart_total' => count(session()->get('cart')), 'message' => 'item alreay in cart' ], 200);
        } else {
            $cart[$package->id] = [
                "item_name"         => $package->name,
                "amount"            => $package->price,
                "end_date"          => $package->package_duration,
            ];
        }
        session()->put('cart', $cart);
        return response()->json(['status' => 200, 'cart_total' => count(session()->get('cart')), 'cart' => session()->get('cart')], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
