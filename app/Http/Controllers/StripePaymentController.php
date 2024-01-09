<?php
namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Session;
use Stripe;
use Stripe\Coupon;
use Stripe\StripeClient;

class StripePaymentController extends Controller
{
    /**
     * success response method.
     *
     *
     */


    //  Success Page
    public function successPayment()
    {
        return view('PaymentGateway.paymentSuccess');
    }

    // Cancelled Page
    public function canceledPayment()
    {
        return view('PaymentGateway.paymentCancel');
    }
    public function proceedToPay(Booking $booking)
    {
        $booking = Booking::findOrFail($booking->id);
        return view('PaymentGateway.proceedToPayment', compact('booking'));
    }


    public function paymentWithDiscount(Request $request, Booking $booking)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        // Price session
        $price = \Stripe\Price::create([
            'unit_amount' => $request->vehicle_price * 100,
            'product' => config('stripe.product_name'),
            'currency' => 'pkr',
            'tax_behavior' => 'exclusive',
        ]);

        // Updating the payment Status
        $booking->payment_status = 'Paid';
        $booking->save();
        // Price session Ends
        try {
            if ($request->discount_code) {
                $session = \Stripe\Checkout\Session::create([
                    'line_items' => [
                        [
                            'price' => $price->id,
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                    'discounts' => [
                        [
                            'coupon' => $request->discount_code
                        ]
                    ],
                    'success_url' => route('successPayment'),
                    'cancel_url' => route('canceledPayment'),
                ]);
            } else {
                $session = \Stripe\Checkout\Session::create([
                    'line_items' => [
                        [
                            'price' => $price->id,
                            'quantity' => 1,
                        ],
                    ],
                    'mode' => 'payment',
                    'success_url' => route('successPayment'),
                    'cancel_url' => route('canceledPayment'),
                ]);
            }


            if ($session->url) {
                return redirect($session->url);
            } else {
                return redirect()->back()->with('Error', 'Please Contact with (bc200206394@vu.edu.pk)');
            }
        } catch (\Exception $ex) {
            return redirect()->back()->with('Error', $ex->getMessage());
        }
    }
}