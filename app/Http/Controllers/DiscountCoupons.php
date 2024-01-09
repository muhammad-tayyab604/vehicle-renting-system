<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\coupons\CreateRequest;
use App\Models\CouponNotification;
use App\Models\User;
use App\Notifications\NotifyUserAbtCoupons;
use Illuminate\Http\Request;
use Stripe\StripeClient;

class DiscountCoupons extends Controller
{
    public function discountForm()
    {
        return view('AdminPanel.Coupons.discountCoupons');
    }

    public function storeCoupons(CreateRequest $request)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        try {
            if ($request->fixed_amount) {
                $stripe->coupons->create([
                    'name' => $request->name,
                    'duration' => 'once',
                    //We can add for multiple durations like (repeating) and (forever) [If repeating we can add another parameter named('duration_in_month=>3 or whateever')]
                    'max_redemptions' => $request->redemptions,
                    'currency' => 'pkr',
                    'amount_off' => $request->fixed_amount * 100,
                ]);
            }
            if ($request->percentage_amount) {
                $stripe->coupons->create([
                    'name' => $request->name,
                    'duration' => 'once',
                    //We can add for multiple durations like (repeating) and (forever) [If repeating we can add another parameter named('duration_in_month=>3 or whateever')]
                    'max_redemptions' => $request->redemptions,
                    'currency' => 'pkr',
                    'percent_off' => $request->percentage_amount,
                ]);
            }
            return redirect()->back()->with('success', 'Cupone Code Created Successfully');


        } catch (\Exception $ex) {
            return redirect()->back()->with('failed', $ex->getMessage());
        }

    }

    public function retreieveCoupons()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $coupons = $stripe->coupons->all();
        $coupons = isset($coupons) ? $coupons['data'] : '';
        // dd($coupons);
        return view('AdminPanel.Coupons.indexCoupons', compact('coupons'));
    }
    public function deleteCoupons($couponId)
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));
        $stripe->coupons->delete($couponId);
        return redirect()->back()->with('couponDeleted', 'Coupon Deleted Successfully');
    }

    public function notifyUserAbtCoupons(Request $request, $couponId)
    {
        try {
            $request->validate([
                'coupon_code' => 'required|string',
                'coupon_name' => 'required|string',
                'max_redemptions' => 'required|string',
                'amount_off' => [
                    'nullable',
                    'regex:/^\d+(\.\d+)?$/',
                ],
                'percent_off' => [
                    'nullable',
                    'regex:/^\d+(\.\d+)?$/',
                ],
            ]);
            // Check if a notification with the same coupon code already exists
            $existingNotification = CouponNotification::where('coupon_code', $request->coupon_code)->first();

            if ($existingNotification) {
                // A notification with the same coupon code already exists, you can handle this case accordingly
                // For example, return an error message or redirect back with an error
                return redirect()->back()->with('error', 'A notification with the same coupon code already exists.');
            }
            // Create coupon notifications for users

            CouponNotification::create([
                'coupon_code' => $request->coupon_code,
                'coupon_name' => $request->coupon_name,
                'max_redemptions' => $request->max_redemptions,
                'amount_off' => $request->amount_off,
                'percent_off' => $request->percent_off,
            ]);

            return redirect()->back()->with('success', 'All users are notified about the coupon.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    // Withdraw coupon notification
    public function withdrawCouponNotification(Request $request, $couponId)
    {
        // Delete the corresponding record from the database
        $couponNotification = CouponNotification::where('coupon_code', $couponId)->first();

        if ($couponNotification) {
            $couponNotification->delete();
            return redirect()->back()->with('success', 'Notification Witdraw Successfully');
        } else {
            return redirect()->back()->with('error', 'Coupon Not Found in Notifications');
        }
    }


}