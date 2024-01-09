@extends('layouts.app')
@section('content')
    <section class="dashboard" id="dashboard">
        <div class="dashboardMain">
            @include('components.dashLayout')
            <div class="dashboardRight">
                <h1 class="dashboardHeading">My Notifications</h1>
                <div class="dashboardMainContainer">
                    @if ($notifications->isEmpty())
                        <div class="flex justify-center mt-5 text-gray-500 text-3xl">
                            <p>Your Notifications Will Show Here</p>
                        </div>
                    @endif
                    <div class="bg-[#eeeeee] mt-2 p-1">
                        @foreach ($notifications as $notification)
                            <a href="{{ route('dismissNotification', $notification) }}"><i
                                    class="fa-solid fa-xmark absolute left-[81%]"></i></a>
                            <a href="{{ route('myReservations') }}">
                                <p class="hover:bg-slate-400 duration-300">Hi! <span
                                        class="font-bold">{{ $notification->data['name'] }}</span>, your
                                    reservations for
                                    <span class="font-bold">{{ $notification->data['make'] }} -
                                        {{ $notification->data['model'] }}</span> has been
                                    @if ($notification->data['status'] === 'Accepted')
                                        <span class="font-bold text-green-600">{{ $notification->data['status'] }}</span>
                                    @else
                                        <span class="font-bold text-red-600">{{ $notification->data['status'] }}</span>
                                    @endif
                                </p>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
