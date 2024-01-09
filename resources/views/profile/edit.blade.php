@extends('layouts.app')
@section('content')
    <div class="heading">
        <h2 class="font-semibold mt-20 text-center text-3xl text-[var(--text-color)] leading-tight">
            {{ auth()->user()->name }}'s {{ __('Profile') }}
        </h2>
    </div>
    {{-- <section class="registration"> --}}




    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 ">
            <div class="profileSettings p-16 sm:p-8  sm:rounded-lg">
                <div class="profeilheading">
                    <h2 class="text-xl font-bold bg-white text-[var(--text-color)]">
                        {{ __('Profile Information') }}
                    </h2>

                    <p class="mt-1 text-md text-[var(--text-color)]">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profileSettings p-4 sm:p-8 shadow sm:rounded-lg">
                <div class="profeilheading">
                    <h2 class="text-xl font-bold text-[var(--text-color)]">
                        {{ __('Update Password') }}
                    </h2>

                    <p class="mt-1 text-md text-[var(--text-color)]">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </div>

                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-red-200 shadow sm:rounded-lg">
                <div class="profeilheading">

                    <h2 class="text-lg font-bold text-red-800">
                        {{ __('Danger Zone') }}
                    </h2>

                    <p class="mt-1 text-sm font-bold text-[var(--main-color)]">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
                    </p>
                </div>
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    </div>
    {{-- </section> --}}
@endsection
