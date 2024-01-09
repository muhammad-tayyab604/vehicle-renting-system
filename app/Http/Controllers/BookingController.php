<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    // Proceed to Checout
    public function BookingForm(Vehicle $vehicle)
    {
        $vehicle = Vehicle::findOrFail($vehicle->id);
        // Calculate total price
        $itemTotal = $vehicle->price;
        $driver_fees = $vehicle->drivers_fee;
        $totalPayment = $itemTotal + $driver_fees;
        return view('BookingForm.VehicleBookingForm', compact('vehicle', 'itemTotal', 'driver_fees', 'totalPayment'));
    }

    // Submit booking Form
    public function submitBookingForm(Request $request, Vehicle $vehicle)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'age' => 'required|string',
            'email' => 'required|email',
            'number' => 'required|string',
            'address' => 'required|string',
            'pickup_date' => 'required|date',
            'drop_date' => 'required|date',
            'message' => 'nullable',
            'payment_method' => 'required',
        ]);

        if ((int) $request->input('age') < 18) {
            return redirect()->back()->with('failed', 'Error! Please make sure you are putting the right information');
        }

        if ($validator->fails()) {
            return redirect()->back()->with('failed', 'Error! Please make sure you are putting right information');
        }

        // Extract pickup and drop dates from the request
        $pickupDate = $request->input('pickup_date');
        $dropDate = $request->input('drop_date');

        // Check for overlapping bookings
        $overlap = Booking::where('vehicle_id', $vehicle->id)
            ->where(function ($query) use ($pickupDate, $dropDate) {
                $query->whereBetween('pickup_date', [$pickupDate, $dropDate])
                    ->orWhereBetween('drop_date', [$pickupDate, $dropDate])
                    ->orWhere(function ($query) use ($pickupDate, $dropDate) {
                        $query->where('pickup_date', '<=', $pickupDate)
                            ->where('drop_date', '>=', $dropDate);
                    });
            })
            ->exists();

        // If there is an overlap, return an error message
        if ($overlap) {
            return redirect()->back()->with('failedBookingDate', 'Vehicle is not available, Please select another date or Vehicle.');
        } else {
            $orderNumber = Str::random(14);
            $booking = [
                'name' => $request->name,
                'age' => $request->age,
                'email' => $request->email,
                'number' => $request->number,
                'address' => $request->address,
                'pickup_date' => $request->pickup_date,
                'drop_date' => $request->drop_date,
                'payment_method' => $request->payment_method,
                'message' => $request->message,
                'order_number' => $orderNumber,
                'vehicle_id' => $vehicle->id,
                'user_id' => auth()->id(),
            ];




            $booking = Booking::create($booking);
            return redirect()->route('myReservations')->with('success', 'Booking Submitted Successfully');



        }
    }
}
