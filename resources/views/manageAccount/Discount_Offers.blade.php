@extends('layouts.app')
@section('content')
    <section class="dashboard" id="dashboard">
        <div class="dashboardMain">
            @include('components.dashLayout')
            <div class="dashboardRight">
                <h1 class="dashboardHeading">My Discount Offers</h1>
                <div class="importantNote border border-black p-4 w-[60vw] pt-2 mb-4 bg-[var()]">
                    <p class="title ">Important Note:</p>
                    <p class="ml-8 font-bold text-md">

                        Unlock Exclusive Savings: Experience the thrill of savings like never before! Simply enter your
                        unique discount code into the 'Proceed to Pay' field during checkout, and watch as your total
                        purchase amount magically transforms to reflect your well-deserved discount. It's your gateway to
                        affordability and a delightful shopping experience. Don't miss out on this fantastic opportunity to
                        enjoy great deals!</p>
                </div>
                <div class="dashboardMainContainer">
                    @if ($notifications->isEmpty())
                        <div class="flex justify-center mt-5 text-gray-500 text-3xl">
                            <p>Your Discount Offers Will Show Here</p>
                        </div>
                    @endif
                    <div class="bg-[#eeeeee] mt-2 p-1">
                        @foreach ($notifications as $notification)
                            <p>
                                🎉 <strong>Exclusive Discount Alert</strong> 🎉 <br>

                                Dear <strong>{{ Auth()->user()->name }}</strong>, <br>

                                We're thrilled to offer you an exclusive discount! To take advantage of this limited-time
                                offer, follow these simple steps: <br>



                                1. Click on the "Rent Now" button to start your booking process. <br>

                                2. Fill in your booking details as prompted on the booking page.<br>

                                3. On the booking form, choose your preferred online payment method.<br>

                                4. In the "Promo Code" or "Discount Code" field, enter the following code:<br>

                                <strong class="text-xl">Discount Code: {{ $notification->coupon_code }}</strong><br>

                                5. Complete your payment, and watch the savings roll in!<br>

                                🌟 Discount Name: {{ $notification->coupon_name }}<br>
                                💰 Discount Amount:
                                {{ $notification->amount_off == null ? $notification->percent_off . '%' : 'PKR. ' . $notification->amount_off / 100 }}
                                Off<br>
                                🔓 Maximum Redemptions: {{ $notification->max_redemptions }}<br>

                                Hurry, this offer is available for a limited time and is subject to [Maximum Redemptions]
                                , that means this discount is only for first <strong
                                    class="text-xl">{{ $notification->max_redemptions }} customers</strong>
                                so hurry up!. <strong>NOTE: This discount is applicable on all the vehicels,
                                    ENJOY!</strong><br>

                                Should you have any questions or require assistance during the booking process, our
                                dedicated support team is here to help. Reach out to us at
                                <strong>(bc200206394@vu.edu.pk)</strong> or the chat icon is showing you can also contact us
                                there.<br>

                                Thank you for choosing <strong>Vehicle Renting System!</strong> We look forward to making
                                your booking
                                experience even more rewarding.<br>

                                Best regards,<br>
                                The <strong>VRS(Vehicle Renting System)</strong> Team<br>
                            </p>
                        @endforeach
                        <div class="">
                            {{ $notifications->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
