@extends('layouts.authLayout')
@section('content')
    <!-- Session Status -->
    <section class="registrationForm">
        <div class="rhcontainer">
            <a href="{{ route('index') }}"><button class="rhsubmit">Home</button></a>
        </div>

        <div class="rheading">
            <h1>Vehicle Renting System</h1>
            <x-auth-session-status class="mb-4" :status="session('status')" />

            @if (session('success'))
                <div class="message" style="color: green;">{{ session('success') }}</div>
            @endif
        </div>
        <div class="regform">

            <form class="rform" method="POST" action="{{ route('login') }}">
                <p class="rtitle">Login</p>
                @csrf
                @if (session('loginError'))
                    <div class="" style="color: red">
                        {{ session('loginError') }}
                    </div>
                @endif
                <!-- Email Address -->
                <label>
                    <input required value="{{ old('email') }}" id="email" name="email"
                        placeholder="example@gmail.com" type="email" class="rinput">
                </label>

                <!-- Password -->
                <div class="inputWithIcon mt-4">
                    <x-text-input id="password" class="rinput" type="password" name="password" required
                        autocomplete="new-password" placeholder="Password..." />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <i class="toggle-Pass fa-regular fa-eye" onclick="togglePassword('password')"></i>
                </div>

                <!-- Confirm Password -->
                <div class="inputWithIcon mt-4">
                    <x-text-input id="password_confirmation" class="rinput" placeholder="Confirm Password..."
                        type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    <i class="toggle-Pass fa-regular fa-eye" onclick="togglePassword('password_confirmation')"></i>
                </div>


                <button class="rsubmit">Login</button>
                <!-- Remember Me -->
                <div class="rememberMe">
                    <label for="remember_me" class="">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-[var(--main-color)] shadow-sm focus:ring-[var(--secondary-color)]"
                            name="remember">
                        <span class="ml-2 text-sm text-[var(--text-color)]">{{ __('Remember me') }}</span>
                    </label>
                    <div class="forgotPass">
                        @if (Route::has('password.request'))
                            <a class="forgotPass" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                    </div>
                </div>


                <p class="rsignin">Don't have account ? <a href="{{ route('register') }}">Signup</a> </p>

            </form>
        </div>
    </section>
@endsection
