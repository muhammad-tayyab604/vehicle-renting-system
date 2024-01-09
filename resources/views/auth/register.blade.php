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
        <div class="regform">
            <form class="rform" method="POST" action="{{ route('register') }}" preventDefault>
                <p class="rtitle">Register</p>
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
                    <x-text-input class="rinput" id="cnic" type="text" name="cnic" required autocomplete="cnic"
                        placeholder="CNIC without spaces or (-)" />
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
                        <a href="{{ route('AdminRegister') }}"
                            class="bg-[var(--main-color)] px-10 py-2 rounded-lg text-white font-bold text-xl">Login As
                            Admin?</a>
                    @endif

                </div>




                <button class="rsubmit">Register</button>
                <p class="rsignin">Already have an acount ? <a href="{{ route('login') }}">Signin</a> </p>
            </form>
        </div>
    </section>
@endsection
