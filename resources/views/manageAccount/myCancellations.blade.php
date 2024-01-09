@extends('layouts.app')
@section('content')
    <section class="dashboard" id="dashboard">
        <div class="dashboardMain">
            @include('components.dashLayout')
            <div class="dashboardRight">
                <h1 class="dashboardHeading">My Cancellations</h1>
                <div class="importantNote border border-black p-4 w-[60vw] pt-2 mb-4 bg-[var()]">
                    <p class="title ">Important Note:</p>
                    <p class="ml-8 font-bold text-md">

                        If you've accidentally canceled your booking and wish to reverse it, please email our admin team at
                        [bc200206394@vu.edu.pk]. Provide your booking details, like (Order#, Your Email, CNIC#, Phone#) and
                        we'll assist you in resolving the
                        cancellation. Thank you for reaching out.</p>
                </div>
                <div class="dashboardMainContainer">
                    @foreach ($cancellaionBookings as $booking)
                        @if ($booking->reservation_status === 'Cancelled')
                            <div class="bg-[#eeeeee] flex justify-between h-16">
                                <div class="">
                                    <p class="font-semibold">Order#{{ $booking->order_number }}</p>
                                    <p class="-translate-y-8 text-[var(--text-color)]">Cancelled on
                                        {{ $booking->updated_at }}</p>
                                </div>
                                <div class="mt-2 mr-3 uppercase text-[var(--secondary-color)] font-bold">
                                    <i class="fa-solid fa-ban text-3xl" style="color: var(--main-color);"></i>
                                </div>
                            </div>
                            <div class="relative mb-6 overflow-x-auto shadow-md sm:rounded-lg">
                                <table class="w-full text-sm text-center">
                                    <thead
                                        class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Image
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Total Payment
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Make/Model
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Color
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Dates
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Reservation Status
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4  whitespace-nowrap dark:text-white">
                                                <img src="{{ asset($booking->vehicle->photo) }}" class="w-40"
                                                    alt="">
                                            </th>
                                            <td class="px-6 py-4">
                                                {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}/ <span
                                                    class="text-[var(--main-color)]">day</span>
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $booking->vehicle->make }}/{{ $booking->vehicle->model }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $booking->vehicle->color }}
                                            </td>
                                            <td class="px-6 py-4">
                                                {{ $booking->pickup_date }}/{{ $booking->drop_date }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="bg-[#eeeeee] rounded-3xl">{{ $booking->reservation_status }}</p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
