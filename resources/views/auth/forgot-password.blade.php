@extends('layouts.authLayout')
@section('content')
    <section class="registrationForm">
        <div class="rhcontainer">
            <a href="{{ route('index') }}"><button class="rhsubmit">Home</button></a>
        </div>
        <div class="rheading">
            <h1>Enter your email address</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

        </div>

        <div class="regform">
            <form class="rform" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="mb-4 text-sm text-[var(--text-color)]">
                    {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                </div>
                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" placeholder="example@gmail.com"
                        name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <button class="rsubmit">Send Reset Link</button>
            </form>
        </div>
    </section>
@endsection
