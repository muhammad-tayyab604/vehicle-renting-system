@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Dashboard</h1>
                <br>
                <div class="mainForCount p-4 grid grid-cols-4">
                    {{-- Available Cars --}}
                    <div
                        class=" box h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-8 rounded-lg border-l-4 border-[var(--secondary-color)] flex justify-between p-6 pt-10 hover:scale-110 duration-300">
                        <div class="availableCars">
                            <a href="{{ route('admin.edit.vehicles.vehicledit') }}">
                                <p class="text-center text-xl text-[var(--secondary-color)]  font-bold">Total Cars</p>
                            </a>
                            <p class="text-xl">{{ $vehicleCount }}</p>
                        </div>
                        <div class="carIcon">
                            <i class="fa-solid fa-car text-3xl text-[var(--text-color)]"></i>
                        </div>
                    </div>
                    {{-- End Available Cars --}}
                    {{-- Total Users --}}
                    <div
                        class=" box h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-8 rounded-lg border-l-4 border-[var(--text-color)] flex justify-between p-6 pt-10 hover:scale-110 duration-300">
                        <div class="availableCars">
                            <a href="{{ route('verify.customer') }}">
                                <p class="text-center text-xl text-[var(--text-color)] font-bold">Total Users</p>
                            </a>
                            <p class="text-xl">{{ $userCount }}</p>
                        </div>
                        <div class="carIcon">
                            <i class="fa-solid fa-users text-3xl text-[var(--text-color)]"></i>
                        </div>
                    </div>
                    {{-- End total users --}}
                    {{-- Total Reservations --}}
                    <div
                        class=" box h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-8 rounded-lg border-l-4 border-[var(--buttonCL)] flex justify-between p-6 pt-10 hover:scale-110 duration-300">
                        <div class="availableCars">
                            <a href="{{ route('admin.booking.list') }}">
                                <p class="text-center text-xl text-[var(--buttonCL)]  font-bold">Total Resrvations</p>
                            </a>
                            <p class="text-xl">{{ $bookingCount }}</p>
                        </div>
                        <div class="carIcon">
                            <i class="fa-solid fa-book text-3xl text-[var(--text-color)]"></i>
                        </div>
                    </div>
                    {{-- End Reservations --}}
                    {{-- Total Categories --}}
                    <div
                        class=" box h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-8 rounded-lg border-l-4 border-[var(--buttonCL)] flex justify-between p-6 pt-10 hover:scale-110 duration-300">
                        <div class="availableCars">
                            <a href="{{ route('admin.categoryIndex') }}">
                                <p class="text-center text-xl text-[var(--secondary-color)]  font-bold">Total Categories</p>
                            </a>
                            <p class="text-xl">{{ $categoryCount }}</p>
                        </div>
                        <div class="carIcon">
                            <i class="fa-solid fa-gears text-3xl text-[var(--text-color)]"></i>
                        </div>
                    </div>
                    {{-- Total Categories --}}

                    {{-- Manage Payments --}}
                    <div
                        class=" box h-32 w-72 bg-[var(--background-color)] shadow-2xl mb-8 rounded-lg border-l-4 border-[var(--secondary-color)] flex justify-between p-6 pt-10 hover:scale-110 duration-300">
                        <div class="managePayment">
                            <a href="https://dashboard.stripe.com/test/payments" target="__blank">
                                <p class="text-center text-xl text-[var(--main-color)]  font-bold">Manage Payments</p>
                            </a>
                            <p class="text-xl">20</p>
                        </div>
                        <div class="carIcon">
                            <i class="fa-solid fa-file-invoice-dollar text-3xl text-[var(--text-color)]"></i>
                        </div>
                    </div>
                    {{-- Manage Payments End --}}
                </div>
                <hr>
                <br>
                <p class="text-xl text-[var(--text-color)] mb-4">Recent Bookings</p>
                @foreach ($bookings as $booking)
                    <div class="relative overflow-x-auto shadow-md mb-4">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Total Price
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Delivery Date
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

                                    <td class="px-6 py-4 text-green-600 font-bold">
                                        {{ $booking->payment_status }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $booking->name }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $booking->email }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}
                                    </td>


                                    <td class="px-6 py-4 text-green-600 font-bold">
                                        {{ $booking->pickup_date }}
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                @endforeach
                <div class="pagination">
                    {{ $bookings->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
