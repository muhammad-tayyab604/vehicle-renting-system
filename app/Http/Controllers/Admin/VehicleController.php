<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class VehicleController extends Controller
{

    // Show Vehicle
    public function vehicleFormShow()
    {
        $vehicles = Vehicle::all();
        $categories = Category::all();
        return view('AdminPanel.vehicleupload', compact('vehicles', 'categories'));
    }

    // Create Vehicle
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'price' => ['required', 'string', 'max:255'],
            'drivers_fee' => ['required', 'string', 'max:255'],
            'color' => ['required', 'string', 'max:255'],
            'vehicle_category_id' => ['required'],
            'photo' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg,gif',
                'max:2048',
                Rule::dimensions()->ratio(1280 / 720),
            ],
        ]);

        // dd($request->all());

        if ($validator->fails()) {
            return redirect()->back()->with('Failed', 'Vehicle is not added, Please Retry with correct information');
        }
        $fileName = time() . $request->file('photo')->getClientOriginalName();
        $path = $request->file('photo')->storeAs('images', $fileName, 'public');

        $requestData = [
            'make' => $request->make,
            'model' => $request->model,
            'price' => $request->price,
            'drivers_fee' => $request->drivers_fee,
            'vehicle_category_id' => $request->vehicle_category_id,
            'color' => $request->color,
            'photo' => '/storage/' . $path,
        ];

        if ($requestData['vehicle_category_id'] === 'bicycle' || $requestData['vehicle_category_id'] === 'Bicycle') {
            $requestData['drivers_fee'] = 0;
        }

        Vehicle::create($requestData);
        return redirect()->back()->with('success', 'Vehicle Added successfully!');
    }
}
