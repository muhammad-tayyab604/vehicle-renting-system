@extends('layouts.app')
@section('content')
    <section class="dashboard" id="dashboard">
        <div class="dashboardMain">
            @include('components.dashLayout')
            <div class="dashboardRight">
                <h1 class="dashboardHeading">Manage My Account</h1>
                <div class="manageAccountContainer">
                    <div class="personalProfile w-[100vw]">
                        <h3>Personal Profile</h3>
                        <hr>
                        <div class="personalInfo">
                            <p class="text-xl"><span class="font-bold">Name:</span> {{ auth()->user()->name }}</p>
                            <p class="text-xl"><span class="font-bold">Email:</span> {{ auth()->user()->email }}</p>
                            <p class="text-xl"><span class="font-bold">CNIC:</span> {{ auth()->user()->cnic }}</p>
                            <p class="text-xl"><span class="font-bold">Number:</span> {{ auth()->user()->phonenumber }}</p>
                            <p class="text-xl"><span class="font-bold">Your Account Created at:</span>
                                {{ auth()->user()->created_at }}</p>
                        </div>

                    </div>
                    <div class="addressBook pb-4">
                        <div
                            class=" box ml-10 h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-4 rounded-lg border-l-4 border-[var(--main-color)] flex justify-between p-6 pt-5 hover:scale-105 duration-300">
                            <div class="availableCars">
                                <a href="{{ route('myReservations') }}">
                                    <p class="text-center text-xl text-[var(--text-color)] font-bold -mb-4">Total Bookings
                                    </p>
                                </a>
                                <p class="text-xl ">{{ $bookingCount }}</p>
                            </div>
                            <div class="carIcon">
                                <i class="fa-solid fa-book text-3xl text-[var(--text-color)]"></i>
                            </div>
                        </div>
                        <div
                            class=" box ml-10 h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-8 rounded-lg border-l-4 border-[var(--main-color)] flex justify-between p-6 pt-5 hover:scale-105 duration-300">
                            <div class="availableCars">
                                <a href="{{ route('mycancellations') }}">
                                    <p class="text-center text-xl text-[var(--text-color)] font-bold -mb-4">Total
                                        Cancellations
                                    </p>
                                </a>
                                <p class="text-xl ">{{ $bookingCancelled }}</p>
                            </div>
                            <div class="carIcon">
                                <i class="fa-solid fa-ban text-3xl text-[var(--text-color)]"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dashboardMainContainer">
                    <p class="heading text-2xl">Recent Orders</p>
                    @foreach ($bookings as $booking)
                        <div class="relative  mb-6 shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left ">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">
                                            Order #
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Placed On
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Item
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Total Payment
                                        </th>
                                        <th scope="col" class="px-6 py-3">
                                            Reservation Status
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap ">
                                            {{ $booking->order_number }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $booking->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <img src="{{ asset($booking->vehicle->photo) }}" class="w-40" alt="">
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}/<span
                                                class="text-[var(--main-color)]">day</span>
                                        </td>
                                        < @if ($booking->reservation_status === 'Accepted')
                                            <td class="font-bold px-6 py-4 text-green-600">
                                                {{ $booking->reservation_status }}</td>
                                        @elseif ($booking->reservation_status === 'Rejected')
                                            <td class="font-bold px-6 py-4 text-red-600">{{ $booking->reservation_status }}
                                            </td>
                                        @elseif ($booking->reservation_status === 'Cancelled')
                                            <td class="font-bold px-6 py-4 text-[var(--main-color)]">
                                                {{ $booking->reservation_status }}
                                            </td>
                                        @else
                                            <td class="font-bold px-6 py-4 text-[var(--text-color)]">
                                                {{ $booking->reservation_status }}
                                            </td>
                    @endif
                    </tr>
                    </tbody>
                    </table>
                </div>
                @endforeach

            </div>

        </div>
        </div>
    </section>
@endsection
