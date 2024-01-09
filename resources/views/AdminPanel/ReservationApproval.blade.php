@extends('layouts.adminLayout')
@section('content')
    <section class="adminPanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Reservation Approval</h1>
                <hr>
                <br>
                <p class="text-2xl text-[var(--main-color)] font-bold">Order.No. <span
                        class="text-[var(--text-color)]">{{ $booking->order_number }}</span></p>
                <div class="mainContent p-20 flex justify-center items-center flex-col">
                    <div
                        class="relative p-4 flex w-[80%] flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div
                            class="relative mx-4 -mt-10 h-96 overflow-hidden rounded-xl bg-blue-gray-500 bg-clip-border text-white shadow-lg shadow-blue-gray-500/40 bg-gradient-to-r from-blue-500 to-blue-600">
                            <img src="{{ $booking->vehicle->photo }}" alt="">
                        </div>
                        <br>
                        <hr class="border border-black">
                        <div class="p-6 flex justify-between">
                            <div class="vehicleInfo">
                                <h5
                                    class="mb-2 block  text-2xl font-bold leading-snug tracking-normal text-[var(--text-color)] antialiased">
                                    Vehicle Infromation
                                </h5>
                                <hr class="border border-black">
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Make: </span>
                                    {{ $booking->vehicle->make }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Model: </span>
                                    {{ $booking->vehicle->model }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Price: </span>
                                    {{ $booking->vehicle->price }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Driver's Fee: </span>
                                    {{ $booking->vehicle->drivers_fee }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Color: </span>
                                    {{ $booking->vehicle->color }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Category: </span>
                                    {{ $booking->vehicle->category->name }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Reservation Status: </span>
                                    {{ $booking->reservation_status }}
                                </p>
                                <hr class="border border-black">
                                <h5
                                    class="mb-2 block  text-2xl font-bold leading-snug tracking-normal text-[var(--text-color)] antialiased">
                                    Payment Information
                                </h5>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Total Payment: </span>
                                    {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}
                                </p>
                                <p class="block  text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Payment Status: </span>
                                    @if ($booking->payment_status === 'Paid')
                                        Paid
                                    @else
                                        Unpaid
                                    @endif
                                </p>
                                <p
                                    class="block mb-8 text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Payment Method: </span>
                                    @if ($booking->payment_method === 'online')
                                        {{ $booking->payment_method }}
                                    @else
                                        {{ $booking->payment_method }}
                                </p>
                                <p>
                                    @if ($booking->payment_status === 'Paid')
                                        <p
                                            class="rounded-lg  text-center align-middle  text-lg font-bold uppercase text-[var(--text-color)] ">
                                            Payment Approved
                                        </p>
                                    @else
                                        @if ($booking->reservation_status === 'Cancelled')
                                            <p
                                                class="rounded-lg  text-center align-middle  text-lg font-bold uppercase text-[var(--main-color)] ">
                                                Canceled By User
                                            </p>
                                        @elseif ($booking->reservation_status === 'Rejected')
                                            <p
                                                class="rounded-lg  text-center align-middle  text-lg font-bold uppercase text-[var(--main-color)] ">
                                                Rejected By Admin
                                            </p>
                                        @else
                                            <a href="{{ route('approveCashPayment.approve', ['id' => $booking->id]) }}"
                                                class="rounded-lg mt-9 bg-[var(--secondary-color)] mb-8 py-3 px-6 text-center align-middle  text-lg font-bold uppercase text-[var(--background-color)] shadow-md shadow-blue-500/20 duration-300 hover:shadow-lg hover:shadow-blue-500/40 hover:bg-[var(--main-color)]">
                                                Approve Payment
                                            </a>
                                        @endif
                                    @endif
                                    @endif
                                </p>
                            </div>
                            <div class="userInfo">
                                <h5
                                    class="mb-2 block  text-2xl font-bold leading-snug tracking-normal text-[var(--text-color)] antialiased">
                                    User Infromation
                                </h5>
                                <hr class="border border-black">
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Name: </span>
                                    {{ $booking->name }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Email: </span>
                                    {{ $booking->email }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">CNIC: </span>
                                    {{ auth()->user()->cnic }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Age: </span>
                                    {{ $booking->age }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Number: </span>
                                    {{ $booking->number }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Payment Method: </span>
                                    {{ $booking->payment_method }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Pick Up Date: </span>
                                    {{ $booking->pickup_date }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Drop Date: </span>
                                    {{ $booking->drop_date }}
                                </p>
                                <p class="block text-lg font-light leading-relaxed text-[var(--text-color)] antialiased">
                                    <span class="font-semibold">Message: </span>
                                    {{ $booking->message }}
                                </p>
                            </div>
                        </div>
                        <div class="p-6 pt-0 mt-9 flex flex-col justify-center items-end ">
                            <div class="">
                                @if (session('success'))
                                    <p class="pb-4 font-bold text-green-600">{{ session('success') }}</p>
                                @endif
                            </div>
                            <div class="flex">
                                @if ($booking->payment_status === 'Paid')
                                    <p
                                        class="rounded-lg bg-green-600 py-3 px-6 text-center align-middle  text-lg font-bold uppercase text-[var(--background-color)] shadow-md">
                                        Paid
                                    </p>
                                @else
                                    @if ($booking->reservation_status === 'Cancelled')
                                        <p
                                            class="rounded-lg bg-[var(--secondary-color)] py-3 px-6 text-center align-middle  text-lg font-bold uppercase text-[var(--background-color)] shadow-md shadow-blue-500/20 duration-300 hover:shadow-lg hover:shadow-blue-500/40 hover:bg-[var(--main-color)]">
                                            Cancelled By User
                                        </p>
                                    @else
                                        <a href="{{ route('reservation.accept', ['id' => $booking->id]) }}"
                                            class="rounded-lg bg-[var(--secondary-color)] py-3 px-6 text-center align-middle  text-lg font-bold uppercase text-[var(--background-color)] shadow-md shadow-blue-500/20 duration-300 hover:shadow-lg hover:shadow-blue-500/40 hover:bg-[var(--main-color)]">
                                            Accept
                                        </a>
                                        <a href="{{ route('reservation.reject', ['id' => $booking->id]) }}"
                                            class="ml-4 rounded-lg bg-[var(--main-color)] py-3 px-6 text-center align-middle  text-lg font-bold uppercase text-[var(--background-color)] shadow-md shadow-blue-500/20 duration-300 hover:shadow-lg hover:shadow-blue-500/40 hover:bg-[var(--secondary-color)]">
                                            Reject
                                        </a>
                                    @endif
                                @endif
                                <a href="{{ route('reservation.delete', ['id' => $booking->id]) }}"
                                    class="ml-4 rounded-lg bg-red-600 py-3 px-6 text-center align-middle  text-lg font-bold uppercase text-[var(--background-color)] shadow-md shadow-blue-500/20 duration-300 hover:shadow-lg hover:shadow-blue-500/40 hover:bg-[var(--main-color)]">
                                    Delete Reservation
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
