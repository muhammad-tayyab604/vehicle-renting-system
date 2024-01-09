@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')

            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Booking List</h1>
                <br>
                @if ($bookings->isEmpty())
                    <div class="flex justify-center mt-5 text-gray-500 text-3xl">
                        <p>No booking has been made.</p>
                    </div>
                @endif
                @foreach ($bookings as $booking)
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                        <table class="w-full text-sm text-center">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Image
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Order. No.
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Make/Model
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Reservations Status
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>

                                    <th scope="col" class="px-6 py-3">
                                        Approve/Reject
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-white border-b text-center dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row" class="px-6 py-4  whitespace-nowrap ">
                                        <img src="{{ asset($booking->vehicle->photo) }}" class="w-40" alt="">
                                    </th>
                                    <td class="px-6 py-4">
                                        {{ $booking->order_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $booking->vehicle->make }}/{{ $booking->vehicle->model }}
                                    </td>
                                    @if ($booking->reservation_status === 'Accepted')
                                        <td class="px-6 py-4 text-green-600 font-bold">Accepted</td>
                                    @elseif ($booking->reservation_status === 'Rejected')
                                        <td class="px-6 py-4 text-red-600 font-bold">Rejected</td>
                                    @elseif ($booking->reservation_status === 'Cancelled')
                                        <td class="px-6 py-4 text-red-600 font-bold">Cancelled By User</td>
                                    @else
                                        <td class="px-6 py-4 text-[var(--text-color)] font-bold">Pending</td>
                                    @endif
                                    <td class="px-6 py-4">
                                        {{ $booking->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $booking->email }}
                                    </td>

                                    <td class="px-6 py-4">
                                        <a href="{{ route('reservation.details', $booking) }}"
                                            class="bg-[var(--main-color)] font-bold p-3 pl-10 pr-10 text-lg rounded-lg hover:bg-[var(--secondary-color)] duration-300">View</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
            <div class="pagination mt-4">
                {{ $bookings->links() }}
            </div>
        </div>
    </section>
@endsection
