<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Category;
use App\Models\User;
use App\Models\Vehicle;
use Spatie\Permission\Models\Role;


class IndexController extends Controller
{
    public function AdminIndex()
    {

        // Bookings with Pid status
        $bookings = Booking::where('payment_status', 'Paid')->paginate(5);
        // Bookings with Pid status Ends

        $vehicleCount = Vehicle::count();
        $categoryCount = Category::count();
        $bookingCount = Booking::count();
        // Get the admin role
        $adminRole = Role::where('name', 'admin')->first();

        // Get the count of users who do not have the admin role
        $userCount = User::whereDoesntHave('roles', function ($query) use ($adminRole) {
            $query->where('id', $adminRole->id);
        })->count();

        return view('AdminPanel.adminIndex', compact('vehicleCount', 'userCount', 'bookingCount', 'bookings', 'categoryCount'));
    }
}
