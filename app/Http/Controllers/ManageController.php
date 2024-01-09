<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\CouponNotification;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class ManageController extends Controller
{

    public function manageMyAccount()
    {
        $user = auth()->user();
        $bookings = Booking::orderBy('created_at', 'desc')->take(2)->get();
        $bookingCount = Booking::where('user_id', $user->id)->count();
        $bookingCancelled = Booking::where('user_id', $user->id)->where('reservation_status', 'Cancelled')->count();
        return view('manageAccount.manageMyAccount', compact('bookings', 'bookingCount', 'bookingCancelled'));
    }
    public function myReservations()
    {
        $user = auth()->user();
        $bookings = $user->bookings()->paginate(2);
        return view('manageAccount.myReservations', compact('bookings'));
    }
    public function myCancellations()
    {
        $user = auth()->user();
        $cancellaionBookings = $user->bookings;
        return view('manageAccount.myCancellations', compact('cancellaionBookings'));
    }
    public function cancelReservation($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->reservation_status = 'Cancelled';
        $booking->save();
        return redirect()->back();
    }
    public function myFavourite()
    {
        $fav = session()->get('fav', []);
        $favItem = Vehicle::whereIn('id', array_column($fav, 'id'))->get();
        return view('manageAccount.myFavourite', compact('favItem'));
    }
    public function myProfile()
    {
        return view('manageAccount.myProfile');
    }
    public function myNotifications()
    {
        $user = Auth::user();
        $notifications = $user->notifications;
        // Mark notifications as read
        $user->unreadNotifications->markAsRead();
        return view('manageAccount.myNotifications', compact('notifications'));
    }

    // Dismiss notification
    public function dismissNotification($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);
        $notification->delete();
        return redirect()->back();
    }

    // Discount Offers Page
    public function discountOffers()
    {
        $notifications = CouponNotification::paginate(1);
        return view('manageAccount.Discount_Offers', compact('notifications'));
    }

}