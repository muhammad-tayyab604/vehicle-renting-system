@extends('layouts.authLayout')
@section('content')
    <section class="registrationForm ">
        <div class="rheading">
            <h1>Payment Success</h1>
            @if (session('success'))
                <div class="message" style="color: green;">{{ session('success') }}</div>
            @endif
        </div>
        <div class="regform">
            <form class="rform">
                <p class="rtitle">Success</p>
                @csrf
                <p class="rsignin font-bold">Your payment has been successfully submitted! You can review the details in the
                    "My
                    Reservations" tab. Thank you for choosing our services, and we hope you have a fantastic experience. If
                    you have any further questions or need assistance, please don't hesitate to contact us. Enjoy your trip!
                </p>
                <a href="{{ route('myReservations') }}" class="rsubmit text-center">My Reservations</a>
            </form>
        </div>
    </section>
@endsection
