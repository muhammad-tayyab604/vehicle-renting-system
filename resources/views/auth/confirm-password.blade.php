@extends('layouts.authLayout')
@section('content')
    <section class="registrationForm">
        <div class="rheading">
            <h1>Confirm Your Password</h1>
        </div>
        <div class="regform">
            <form class="rform" method="POST" action="{{ route('password.confirm') }}">
                @csrf
                <div class="mb-4 text-sm text-[var(--text-color)]">
                    {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                </div>
                <!-- Password -->
                <div>
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" placeholder="Enter your new password..." />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <button class="rsubmit">Confirm Password</button>
            </form>
        </div>
    </section>
@endsection
