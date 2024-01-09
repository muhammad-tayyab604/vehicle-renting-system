@extends('layouts.app')
@section('content')
    @auth
        <section class="checkout" id="checkout">

            <div class="MainCheckoutDiv">

                <div class="leftCheckout">
                    <div class="orderDetails">
                        <div class="">
                            <h1 class="text-3xl text-[var(--buttonCL)] drop-shadow-md font-bold">{{ $vehicle->make }}
                                {{ $vehicle->model }} For Rent</h1>
                            <hr>
                            <img src="{{ asset($vehicle->photo) }}" alt="">
                        </div>
                    </div>
                    <div class="mt-4">
                        <h1 class="p-4 border-b-2 border-black text-xl font-medium text-[var(--buttonCL)]">Vehicle Information
                        </h1>
                        <p class="bg-[var(--secondary-light)] mt-4 border-b-2 p-4 text-lg text-[var(--main-color)] font-bold">
                            Rent
                            Per day:
                            <span class="text-black">RS
                                {{ $vehicle->price }}</span>
                        </p>
                        <p class=" p-4 text-lg text-[var(--main-color)] font-bold">Driver's Fee Per day: <span
                                class="text-black">RS
                                {{ $vehicle->drivers_fee }}</span></p>
                        <p class="bg-[var(--secondary-light)] border-b-2 p-4"><span class="font-bold">Pick-up
                                by:</span>
                            {{ auth()->user()->name }}</p>
                        <p class="border-b-2 p-4"> <span class="font-bold ">Email To:</span>
                            {{ auth()->user()->email }}</p>
                        <div class="border border-black p-2 mt-4 bg-[var(--secondary-light)]">
                            <p class="mt-4 mb-4 border-b-2 border-black font-bold text-[var(--buttonCL)]">*Note: These documents
                                require when you
                                pickup the
                                Vehicle*</p>
                            <ol>
                                <li>1. Original CNIC</li>
                                <li>2. Copy of CNIC</li>
                                <li>3. 1 Your recent Photograph</li>
                                <li>4. Your Driving License</li>
                                <li>5. 1 Witness</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="rightCheckout">
                    <h1 class="pt-3 pb-6 font-bold text-2xl">PKR {{ $vehicle->price }} <span
                            class="text-[var(--main-color)]">/day</span></h1>
                    <hr>
                    <div class="orderTotal pt-3 pb-2 flex items-center justify-between">
                        <p>Items Total</p>
                        <p>RS. {{ $itemTotal }}</p>
                    </div>

                    <div class="totalPayment  pb-2 flex items-center justify-between">
                        <p>Total Payment</p>
                        <p>RS. {{ $totalPayment }}</p>
                    </div>
                    <div class="p-4">
                        <p class="text-xl text-[var(--buttonCL)] font-semibold ">Get Quick Quote</p>
                    </div>
                    <hr>
                    <form class="p-4" action="{{ route('booking.submit', $vehicle) }}" method="POST">
                        @csrf

                        <div class="form-control">
                            <label for="name" class="text-[var(--text-color)]">Name:</label>
                            <input class="input mb-4" name="name" placeholder="Enter Your Name..." type="text"
                                value="{{ auth()->user()->name }}" required>

                        </div>
                        <div class="form-control">
                            <label for="age" class="text-[var(--text-color)]">Age:</label>
                            <input class="input mb-4" name="age" placeholder="Enter Your Age(Must be 18 OR Plus)"
                                type="number" step="0.01" required>
                        </div>
                        <div class="form-control">
                            <label for="email" class="text-[var(--text-color)]">Email:</label>
                            @if (session('failedEmail'))
                                <div class="message text-red-600 font-bold">{{ session('failedEmail') }}</div>
                            @endif
                            <input class="input mb-4" name="email" placeholder="Enter Your Email..." type="email" required
                                value="{{ auth()->user()->email }}">
                        </div>
                        <div class="form-control">
                            <label for="number" class="text-[var(--text-color)]">Number:</label>
                            @if (session('failedNumber'))
                                <div class="message text-red-600 font-bold">{{ session('failedNumber') }}</div>
                            @endif
                            <input class="input mb-4" name="number" placeholder="Enter Your Number..." type="number"
                                step="0.01" required value="{{ auth()->user()->phonenumber }}">
                        </div>
                        <div class="form-control">
                            <label for="address" class="text-[var(--text-color)]">Pickup Address:</label>
                            <textarea name="address" class="input mb-4" placeholder="Pickup Address..." id="" required></textarea>
                        </div>
                        <div class="form-control">
                            <label for="vehicle" class="text-[var(--text-color)]">Vehicle Name:</label>
                            <input class="input mb-4" name="vehicle" type="text" value="{{ $vehicle->make }}" readonly>
                        </div>
                        <div class="form-control">
                            <label for="pickup_date" class="text-[var(--text-color)]">Pickup Date:</label>
                            <input class="input mb-4" name="pickup_date" type="date" required>
                        </div>

                        <div class="form-control">
                            <label for="drop_date" class="text-[var(--text-color)]">Drop Date:</label>
                            <input class="input mb-4" name="drop_date" type="date" required>
                        </div>

                        <div class="form-control">
                            <label for="payment_method" class="text-[var(--text-color)]">Payment Method:</label>
                            <select name="payment_method" class="input mb-4" required>
                                <option value="cash">Cash</option>
                                <option value="online">Online</option>
                            </select>
                        </div>
                        <div class="form-control">
                            <label for="message" class="text-[var(--text-color)]">Message:</label>
                            <textarea name="message" class="input mb-4" placeholder="Your Message(Optional)" id=""></textarea>
                        </div>

                        <div>
                            @if (session('failedBookingDate'))
                                <p class="text-red-600 font-bold">{{ session('failedBookingDate') }}</p>
                            @endif
                        </div>
                        <div>
                            @if (session('failed'))
                                <p class="text-red-600 font-bold">{{ session('failed') }}</p>
                            @endif
                        </div>

                        <div class="flex justify-center items-center">
                            <button type="submit"
                                class="bg-[var(--main-color)] p-4 w-full text-xl text-[var(--background-color)] font-bold rounded-lg hover:bg-[var(--secondary-color)] duration-300">Book
                                Now</button>

                        </div>


                    </form>
                </div>
            </div>
        </section>
    @else
        {{ route('login') }};

    @endauth
@endsection
