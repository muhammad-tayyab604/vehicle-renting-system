@extends('layouts.app')
@section('content')
    <section class="dashboard" id="dashboard">

        <div class="dashboardMain">
            @include('components.dashLayout')
            <div class="dashboardRight">
                <h1 class="dashboardHeading">My Reservations</h1>
                @if (session('success'))
                    <p class="text-green-600 font-bold">{{ session('success') }}</p>
                @endif
                @if (Session::has('paymentSuccess'))
                    <div class="alert alert-success text-center pt-2">
                        <p class="text-green-600 font-bold text-xl">{{ Session::get('paymentSuccess') }}</p>
                    </div>
                @endif
                @if (Session::has('paymentUnsuccessful'))
                    <div class="alert alert-success text-center pt-2">
                        <p class="text-red-600 font-bold text-xl">{{ Session::get('paymentUnsuccessful') }}</p>
                    </div>
                @endif
                <div class="importantNote border border-black p-4 w-[60vw] pt-2 mb-4 bg-[var()]">
                    <p class="title ">Important Note:</p>
                    <p class="ml-8 font-bold text-md">

                        If you've chosen to pay in cash, please wait until we confirm your booking. Payment should only be
                        made after your reservation has been officially accepted to ensure a smooth transaction process.
                        Thank you for your cooperation.</p>
                </div>
                <div class="dashboardMainContainer">
                    @if ($bookings->isEmpty())
                        <div class="flex justify-center mt-5 text-gray-500 text-3xl">
                            <p>No Reservations</p>
                        </div>
                    @endif
                    @foreach ($bookings as $booking)
                        <div class="bg-[#eeeeee] flex justify-between h-16 mt-5">
                            <div class="">
                                <p class="font-semibold">Order#{{ $booking->order_number }}</p>
                                <p class="-translate-y-8 text-[var(--text-color)]">Placed on {{ $booking->created_at }}</p>
                            </div>
                            @if ($booking->reservation_status === 'Cancelled')
                                <div
                                    class="mt-2 mr-3 uppercase text-[var(--main-color)] font-bold hover:text-[var(--secondary-color)] duration-300 cursor-not-allowed">
                                    Cancelled
                                </div>
                            @elseif ($booking->reservation_status === 'Rejected')
                                <div
                                    class="mt-2 mr-3 uppercase text-[var(--main-color)] font-bold hover:text-[var(--secondary-color)] duration-300">
                                    <i class="fa-solid fa-ban"></i>
                                </div>
                            @elseif ($booking->payment_status === 'Paid')
                                <div
                                    class="mt-2 mr-3 uppercase text-[var(--main-color)] font-bold hover:text-[var(--secondary-color)] duration-300">
                                    <i class="fa-solid fa-check-double"></i>
                                </div>
                            @else
                                <div
                                    class="mt-2 mr-3 uppercase text-[var(--main-color)] font-bold hover:text-[var(--secondary-color)] duration-300 cursor-not-allowed">
                                    <a href="{{ route('reservation.cancellation', $booking) }}">Cancel Reservations?</a>
                                </div>
                            @endif
                        </div>
                        {{-- Table --}}
                        <div class="relative overflow-x-auto shadow-md">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Vehicle Image
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Make/Model
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Color
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Reservation Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Payment Status
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Pick Up Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Drop Date
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Price
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Payment Method
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class=" border-b text-[var(--text-color)]">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                            <img src="{{ asset($booking->vehicle->photo) }}" alt="" class="w-96">
                                        </th>
                                        <th scope="row"
                                            class="px-6 py-4 font-medium text-[var(--text-color)] whitespace-nowrap ">
                                            {{ $booking->vehicle->make }}/{{ $booking->vehicle->model }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $booking->vehicle->color }}
                                        </td>
                                        @if ($booking->reservation_status === 'Accepted')
                                            <td class="px-6 py-4 font-bold text-green-600">
                                                {{ $booking->reservation_status }}</td>
                                        @elseif($booking->reservation_status === 'Rejected')
                                            <td class="px-6 py-4 font-bold text-red-600">{{ $booking->reservation_status }}
                                            </td>
                                        @elseif ($booking->reservation_status === 'Cancelled')
                                            <td class="px-6 py-4 font-bold text-[var(--main-color)]">
                                                {{ $booking->reservation_status }}
                                            @else
                                            <td class="px-6 py-4 font-bold text-[var(--text-color)]">
                                                {{ $booking->reservation_status }}

                                            </td>
                                        @endif

                                        @if ($booking->payment_status === 'pending')
                                            <td class="px-6 py-4">
                                                {{ $booking->payment_status }}
                                            </td>
                                        @else
                                            <td class="px-6 py-4 text-green-600 font-bold">
                                                {{ $booking->payment_status }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4">
                                            {{ $booking->pickup_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $booking->drop_date }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}
                                        </td>
                                        @if ($booking->payment_method === 'online')
                                            @if ($booking->payment_status === 'pending')
                                                <td class="px-6 py-4">
                                                    @if ($booking->reservation_status === 'pending')
                                                        <p class="text-red-600 font-bold">Your Reservation is not Accepted
                                                            Yet!</p>
                                                    @elseif ($booking->reservation_status === 'Rejected')
                                                        <p class="text-red-600 font-bold">Your
                                                            Reservation is Rejected by the admin!</p>
                                                    @elseif ($booking->reservation_status === 'Cancelled')
                                                        <p class="text-red-600 font-bold">Reservation Cancelled</p>
                                                    @else
                                                        <a href="{{ route('proceedToPay', $booking) }}"
                                                            class="bg-[var(--main-color)] p-1 text-white text-md font-bold rounded-lg hover:bg-[var(--secondary-color)] hover:text-[var(--text-color)] duration-300">Pay
                                                            Now</a>
                                                    @endif

                                                </td>
                                            @else
                                                <td class="px-6 py-4 text-green-600 font-bold">
                                                    Get your Vehicle on ({{ $booking->pickup_date }})
                                                </td>
                                            @endif
                                        @else
                                            <td class="px-6 py-4">
                                                <a href="">Cash On Delivery(COD)</a>
                                            </td>
                                        @endif
                                    </tr>

                                </tbody>
                            </table>

                        </div>
                    @endforeach
                    <div class="mt-4">
                        {{ $bookings->links() }}
                    </div>
                </div>


            </div>
        </div>
    </section>
@endsection
