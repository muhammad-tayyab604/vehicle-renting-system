<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Models\Category;

class SearchVehicleController extends Controller
{
    public function SearchVehicles(Request $request)
    {
        $categories = Category::all();
        $availableVehicles = Vehicle::all();
        $vehicleColor = Vehicle::distinct('color')->pluck('color');
        $vehicleModel = Vehicle::distinct('model')->pluck('model');
        $vehicledrivers_fee = Vehicle::distinct('drivers_fee')->pluck('drivers_fee');

        $query = $request->input('query');
        $category = $request->input('category');

        $vehicles = Vehicle::when($query, function ($query, $search) {
            return $query->where('make', 'like', '%' . $search . '%');
        })
            ->when($request->input('color'), function ($query, $color) {
                return $query->orWhere('color', 'like', '%' . $color . '%');
            })
            ->when($request->input('model'), function ($query, $model) {
                return $query->orWhere('model', 'like', '%' . $model . '%');
            })
            ->when($request->input('price_range'), function ($query, $priceRange) {
                [$minPrice, $maxPrice] = explode('-', $priceRange);
                return $query->whereBetween('price', [$minPrice, $maxPrice]);
            })
            ->when($request->input('drivers_fee_range'), function ($query, $feeRange) {
                [$minFee, $maxFee] = explode('-', $feeRange);
                return $query->whereBetween('drivers_fee', [$minFee, $maxFee]);
            })
            ->when($category, function ($query, $category) {
                return $query->where('vehicle_category_id', $category);
            })
            ->paginate(5);

        return view('searchVehicles.searchvehicles', compact('vehicles', 'availableVehicles', 'vehicleColor', 'vehicleModel', 'vehicledrivers_fee', 'categories'));
    }

}
