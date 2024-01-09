<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart()
    {
        $cart = session()->get('cart', []);
        $cartItem = Vehicle::whereIn('id', array_column($cart, 'id'))->get();

        return view('Cart.cart', compact('cartItem'));
    }
    public function addToCart(Vehicle $vehicle)
    {
        $cart = session()->get('cart', []);

        // Add the vehicle to the cart
        $cart[] = $vehicle->toArray();
        session()->put('cart', $cart);
        return redirect()->back()->with('cartSuccess', 'Vehicle Added to cart');
    }

    public function ProceedToCheckout(Vehicle $vehicle)
    {
        $vehicle = Vehicle::findOrFail($vehicle->id);
        // Calculate total price
        $itemTotal = $vehicle->price;
        $driver_fees = $vehicle->drivers_fee;
        $totalPayment = $itemTotal + $driver_fees;
        return view('ProceedToCheckout.proceedtocheckout', compact('vehicle', 'itemTotal', 'driver_fees', 'totalPayment'));
    }

    // Delete Vehicle from cart
    public function deleteFromCart($id)
    {
        $cart = session()->get('cart', []);

        // Find the index of vehicle to remove
        $index = collect($cart)->search(function ($item) use ($id) {
            return $item['id'] == $id;
        });

        if ($index !== false) {
            unset($cart[$index]);
            session()->put('cart', $cart);

            return redirect()->back()->with('delCart', 'Vehicle removed!');
        }
    }

    // Delete all vehicles from cart
    public function deleteAllItems()
    {
        session()->forget('cart');
        return redirect()->back();
    }

}