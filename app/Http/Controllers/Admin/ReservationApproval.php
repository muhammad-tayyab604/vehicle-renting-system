<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Notifications\ReservationApprovalNotification;


class ReservationApproval extends Controller
{
    public function reservationDetails(Booking $booking)
    {
        // Load the associated vehicle information
        $booking->load('vehicle');
        return view('AdminPanel.ReservationApproval', compact('booking'));
    }

    public function acceptReservation($id)
    {
        $booking = Booking::findOrFail($id);

        // update the status to 'accept'
        $booking->reservation_status = 'Accepted';
        $booking->save();

        // Notify the user that their reservation was accepted
        $booking->user->notify(new ReservationApprovalNotification($booking));

        // Redirect back with message
        return redirect()->back()->with('success', 'Reservation accepted Successfully');
    }

    public function rejectReservation($id)
    {
        $booking = Booking::findOrFail($id);

        // update the status to 'Rejected'
        $booking->reservation_status = 'Rejected';
        $booking->save();

        // Notify the user that their reservation was rejected
        $booking->user->notify(new ReservationApprovalNotification($booking));

        return redirect()->back()->with('success', 'Reservation rejected Successfully');
    }

    public function destroyReservation($id)
    {
        try {
            $vehicle = Booking::findOrFail($id);
            $vehicle->delete();
            return redirect()->route('admin.booking.list');
        } catch (\Throwable $e) {
            return redirect()->back()->with('error', 'An error occurred while deleting the vehicle.');
        }
    }

    // Cash Payment Approval
    public function approveCashPayment($id)
    {
        $booking = Booking::findOrFail($id);
        // update the payment_status to 'Paid'
        $booking->payment_status = 'Paid';
        $booking->save();
        return redirect()->back()->with('success', 'Payment Approved Successfully');
    }
}