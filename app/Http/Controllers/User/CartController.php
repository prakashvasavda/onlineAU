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

    }

    public function store(Request $request){
        $package = Packages::where('name', $request->package_name)->first();
        $cart    = session()->get('cart', []);

        if(isset($cart[$package->id]) || empty($package)) {
            $response = [
                'status'        => 404,
                'cart'          => session()->get('cart'),
                'total_items'   => count(session()->get('cart')),
                'message'       => 'package already exists in the cart',
            ];

            return response()->json($response, 200);
        } else {
            $cart[$package->id] = [
                "id"                => $package->id,
                "item_name"         => $package->name,
                "duration"          => $package->duration,
                "price"             => $package->price,
            ];
        }
        session()->put('cart', $cart);
        
        $response = [
            'status'        => 200,
            'cart'          => session()->get('cart'),
            'total_items'   => count(session()->get('cart')),
            'message'       => 'item added in cart successfully',
        ];

        return response()->json($response, 200);
    }

    public function show(string $id){
        //
    }

    public function edit(string $id){
        //
    }

    public function update(Request $request, string $id){
        //
    }

    public function destroy(Request $request, string $id){
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }

            $response = [
                'status'        => 200,
                'cart'          => session()->get('cart'),
                'total_items'   => count(session()->get('cart')),
                'total_price'   => $this->get_total_price(),
                'id'            => $id,
                'message'       => 'item removed successfully form the cart',
            ];

           return response()->json($response, 200);
        }

        $response = [
            'status'        => 404,
            'cart'          => session()->get('cart'),
            'total_items'   => count(session()->get('cart')),
            'message'       => 'item not found from cart',
        ];

        return response()->json($response, 404);
    }

    public function get_total_price(){
        if(!Session::has('cart') || empty(Session::get('cart'))){
            return number_format((float) 0, 2, '.', '');
        }

        $temp = 0;
        foreach(Session::get('cart') as $key => $value){
            $total_price = $temp; 
            $total_price = $total_price + $value['price'];
            $temp        =  $total_price;
        }
        return isset($total_price) ? number_format((float)$total_price, 2, '.', '') : 0;
    }
}
