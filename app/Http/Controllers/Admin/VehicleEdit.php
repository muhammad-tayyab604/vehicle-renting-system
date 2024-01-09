<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Storage;


class VehicleEdit extends Controller
{
    public function vehicleEditShow()
    {
        $vehicles = Vehicle::orderBy('created_at', 'desc')->paginate(5);
        $noVehicleMessage = $vehicles->isEmpty() ? '|Please Upload Vehicle(s) to Access their Information|' : null;
        return view('AdminPanel.vehicledit', compact('vehicles', 'noVehicleMessage'));
    }
    // Delete Vehicle
    public function DestroyVehicle($id)
    {
        try {
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->delete();
            return redirect()->back()->with('success', 'Vehicle Deleted successfully!');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the vehicle.');
        }

    }

    // Vehicle Update Form
    public function getVehicleUpdate($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $categories = Category::all();
        return view('AdminPanel.updateVehicle', compact('vehicle', 'categories'));
    }

    // Get specific Vehicle Info
    public function updateVehicle(Request $request, Vehicle $vehicle, $id)
    {
        $validator = Validator::make($request->all(), [
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'vehicle_category_id' => ['required'],
            'photo' => [
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                Rule::dimensions()->ratio(1280 / 720),
            ],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('Failed', 'Vehicle information is not updated, Please Retry with correct information');
        }

        $vehicle = Vehicle::findOrFail($id); // passing vehicle ID in the route
        // $fileName = time() . $request->file('photo')->getClientOriginalName();
        // $path = $request->file('photo')->storeAs('images', $fileName, 'public');

        $requestData = [
            'make' => $request->make,
            'model' => $request->model,
            'price' => $request->price,
            'vehicle_category_id' => $request->vehicle_category_id,
            'color' => $request->color,

        ];
        // Check if a new photo is provided
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $fileName = time() . $request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');

            // Update the vehicle's photo path only if a new photo is uploaded
            $vehicle->update(['photo' => '/storage/' . $path]);
        }

        if ($requestData['vehicle_category_id'] === 'bicycle' || $requestData['vehicle_category_id'] === 'Bicycle') {
            $requestData['drivers_fee'] = 0;
        }

        $vehicle->update($requestData);
        return redirect()->back()->with('success', 'Vehicle information updated successfully!');
    }

}
