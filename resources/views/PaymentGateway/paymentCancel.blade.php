@extends('layouts.authLayout')
@section('content')
    <section class="registrationForm ">
        <div class="rheading">
            <h1>Payment Cancelled</h1>
            @if (session('success'))
                <div class="message" style="color: green;">{{ session('success') }}</div>
            @endif
        </div>
        <div class="regform">
            <form class="rform">
                <p class="rtitle">Cancelled</p>
                @csrf
                <p class="rsignin font-bold">Your payment has been cancelled. You can check the status of your reservations
                    in the 'My Reservations' tab. If you encounter any issues or have questions, please don't hesitate to
                    reach out to our customer support. We're here to assist you with any concerns you may have.
                </p>
                <a href="{{ route('myReservations') }}" class="rsubmit text-center">My Reservations</a>
            </form>
        </div>
    </section>
@endsection
