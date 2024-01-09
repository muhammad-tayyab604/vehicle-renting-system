@extends('layouts.authLayout')
@section('content')
    <section class="registrationForm ">
        <div class="rhcontainer">
            <a href="{{ route('index') }}"><button class="rhsubmit">Home</button></a>
        </div>

        <div class="rheading">
            <h1>Vehicle Renting System</h1>
            @if (session('success'))
                <div class="message" style="color: green;">{{ session('success') }}</div>
            @endif

        </div>
        @if (
            \App\Models\User::whereHas('roles', function ($q) {
                $q->where('name', 'admin');
            })->exists())
            <div
                class="unverifiedContainer flex justify-center items-center flex-col h-[100vh]  bg-[var(--secondary-color)]">
                <div
                    class=" from-slate-300 w-[50vw] h-[50%] bg-gradient-to-l to-slate-100  border border-slate-300 grid grid-col-2 justify-center p-4 gap-4 rounded-lg shadow-md">
                    <div class="col-span-2 text-2xl font-bold capitalize rounded-md text-[var(--main-color)] text-center">
                        Admin Already Registered!

                    </div>
                    <div class="col-span-2 rounded-md text-xl">
                        <p>An admin is already registered in the system. If you are trying to register as an admin, please
                            check with the existing admin or use a different account type.</p>
                    </div>
                </div>
            </div>
        @else
            <div class="regform">
                <form class="rform" method="POST" action="{{ route('register') }}" preventDefault>
                    <p class="rtitle">Admin Registration</p>
                    @csrf

                    <!-- Name -->
                    <div>
                        <x-text-input id="name" class="rinput" type="text" name="name" :value="old('name')" required
                            autofocus autocomplete="name" placeholder="Enter your full name..." />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-text-input id="email" class="rinput" type="email" name="email" :value="old('email')" required
                            autocomplete="username" placeholder="example@gmail.com" />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <!-- Cnic Number -->
                    <div class="mt-4">
                        <x-text-input class="rinput" id="cnic" type="text" name="cnic" required
                            autocomplete="cnic" placeholder="CNIC without spaces or (-)" />
                        @error('cnic')
                            <span role="alert" class="mt-2 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>
                    {{-- Phone Number --}}
                    <div class="mt-4">
                        <x-text-input class="rinput" id="phonenumber" type="number" name="phonenumber" required
                            autocomplete="phonenumber" :value="old('phonenumber')" placeholder="Enter your phone number" />
                        @error('phonenumber')
                            <span role="alert" class="mt-2 text-sm text-red-600">{{ $message }}</span>
                        @enderror
                    </div>

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
                    <!-- Secret Key If admin registration -->

                    <div class="inputWithIcon mt-4">
                        @if (
                            !\App\Models\User::whereHas('roles', function ($q) {
                                $q->where('name', 'admin');
                            })->exists() ||
                                (auth()->check() &&
                                    !auth()->user()->hasRole('admin')))
                            <x-text-input id="secret_code" class="rinput" placeholder="Secret Code..." type="password"
                                name="secret_code" required />
                        @endif

                    </div>




                    <button class="rsubmit">Register</button>
                    <p class="rsignin">Already have an acount ? <a href="{{ route('login') }}">Signin</a> </p>
                </form>
            </div>
        @endif
    </section>
@endsection
