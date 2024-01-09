@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">All Coupons</h1>
                <hr>
                <br>
                <br>
                <div class="importantNote border border-black p-4 w-full pt-2 mb-4 bg-[var()]">
                    <p class="title ">Important Note:</p>
                    <p class="ml-8 font-bold text-md">

                        Before removing a coupon, we kindly request you to withdraw any associated notifications to prevent
                        any potential conflicts or misunderstandings. Clearing notifications ensures a seamless and
                        hassle-free process, allowing for efficient management of your coupons and offers. Your cooperation
                        in this matter is greatly appreciated."</p>
                </div>
                @if (session('couponDeleted'))
                    <p class="text-red-600 text-xl bg-red-300 font-bold p-4 rounded-lg text-center mb-4">
                        {{ session('couponDeleted') }}</p>
                @endif
                @if (session('error'))
                    <p class="text-red-600 text-xl bg-red-300 font-bold p-4 rounded-lg text-center mb-4">
                        {{ session('error') }}</p>
                @endif
                @if (session('success'))
                    <p class="text-green-600 text-xl bg-green-300 font-bold p-4 rounded-lg text-center mb-4">
                        {{ session('success') }}</p>
                @endif
                <div class="relative overflow-x-auto">
                    <table class="w-full text-sm text-center text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Coupon Code
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Amount
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Max Redemptions
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valid
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Notify
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Withdraw
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($coupons as $coupon)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <th scope="row"
                                        class="px-6 py-4 font-medium  whitespace-nowrap text-[var(--text-color)]">
                                        {{ $coupon->id }}
                                    </th>
                                    <td scope="row"
                                        class="px-6 py-4 font-medium  whitespace-nowrap text-[var(--text-color)]">
                                        {{ $coupon->name }}
                                    </td>

                                    <td class="px-6 py-4 text-[var(--text-color)]">
                                        {{ $coupon->amount_off == null ? $coupon->percent_off . '%' : 'PKR. ' . $coupon->amount_off / 100 }}
                                    </td>

                                    <td class="px-6 py-4 text-[var(--text-color)]">
                                        {{ $coupon->max_redemptions }}
                                    </td>

                                    <td class="px-6 py-4 text-[var(--text-color)]">
                                        {{ $coupon->valid === true ? 'Valid' : 'Invalid' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('coupons.delete', $coupon->id) }}"><i
                                                class="fa-solid fa-trash text-[var(--main-color)] text-lg hover:text-[var(--secondary-color)] hover:scale-110 duration-300"></i></a>
                                    </td>
                                    <td>

                                        <form action="{{ route('notify.coupons', $coupon->id) }}" method="post">
                                            @csrf
                                            <input type="hidden" name="coupon_code" value="{{ $coupon->id }}">
                                            <input type="hidden" name="coupon_name" value="{{ $coupon->name }}">
                                            <input type="hidden" name="max_redemptions"
                                                value="{{ $coupon->max_redemptions }}">
                                            <input type="hidden" name="amount_off" value="{{ $coupon->amount_off }}">
                                            <input type="hidden" name="percent_off" value="{{ $coupon->percent_off }}">
                                            <button id="notifyUserButton" type="submit"
                                                class="pl-7 pr-7 p-2 text-white bg-[var(--main-color)] font-semibold rounded-lg hover:bg-[var(--secondary-color)] duration-150">Notify
                                                User</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('withdraw.notification', $coupon->id) }}" method="post">
                                            @csrf
                                            <button type="submit"
                                                class="pl-7 pr-7 p-2 text-white bg-[var(--main-color)] font-semibold rounded-lg hover:bg-[var(--secondary-color)] duration-150">Withdraw
                                                Notification</button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>
    </section>
@endsection
