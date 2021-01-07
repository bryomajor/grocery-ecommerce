<?php

namespace App\Http\Controllers;
use App\Category;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function shop() {
        $categories = Category::orderBy('name', 'asc')->get();
        return view('pages.shop')->with(['categories' => $categories]);
    }

    public function cart() {
        $cartCollection = \Cart::getContent();
        return view('pages.cart')->with('cartCollection', $cartCollection);
    }

    public function add(Request $request) {
        \Cart::add(array(
            'id' => $request->id,
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'attributes' => [
                'flavor' => $request->flavor,
                'measurement' => $request->measurement,
                'image' => $request->img
            ]
        ));
        return redirect()->route('cart.index')->with('success', 'Item is added to cart!');
    }

    public function remove(Request $request) {
        \Cart::remove($request->id);
        return redirect()->route('cart.index')->with('success', 'Item is removed!');
    }

    public function update(Request $request) {
        \Cart::update($request->id,
            array(
                'quantity' => array(
                    'relative' => false,
                    'value' => $request->quantity
                )
            ));
            return redirect()->route('cart.index')->with('success', 'Cart is updated!');
    }

    public function clear() {
        \Cart::clear();
        return redirect('/')->with('success', 'Cart is cleared!');
    }


}
