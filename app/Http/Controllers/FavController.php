<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class FavController extends Controller
{
    public function favVehicle(Vehicle $vehicle)
    {

        $fav = session()->get('fav', []);

        // Add to Favourite
        $fav[] = $vehicle->toArray();
        session()->put('fav', $fav);
        return redirect()->back()->with('favSuccess', 'Added to favourite');

    }

    // Add All favourite items in cart
    public function addAlltoCart()
    {
        $fav = session()->get('fav', []);
        $cart = session()->get('cart', []);

        foreach ($fav as $favourite) {
            $cart[] = $favourite;
        }

        session()->put('cart', $cart);
        // session()->forget('fav');

        return redirect()->back()->with('allItemsAdded', 'All Items Added in the cart');
    }

    // Delete all items from favourite
    public function favDeleteAll()
    {
        session()->forget('fav');
        return redirect()->back();
    }



    // Delete items from favourite
    public function deleteFromFav($id)
    {
        $fav = session()->get('fav', []);

        // Find the index of vehicle to remove
        $index = collect($fav)->search(function ($item) use ($id) {
            return $item['id'] == $id;
        });

        if ($index !== false) {
            unset($fav[$index]);
            session()->put('fav', $fav);

            return redirect()->back()->with('delFav', 'Vehicle removed!');
        }
    }
}