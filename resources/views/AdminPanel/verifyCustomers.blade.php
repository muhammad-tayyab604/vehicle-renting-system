@extends('layouts.adminLayout')
@section('content')
    <section class="adminPanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Verify Customers</h1>
                <hr>
                <br>
                @if ($users->isEmpty())
                    <div class="flex justify-center mt-5 text-gray-500 text-3xl">
                        <p>No Registered Users</p>
                    </div>
                @else
                    {{-- @foreach ($users as $unVerifiedUsers) --}}
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="p-4">

                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Name
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Email
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        CNIC
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Phone Number
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Role
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Registered at
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Verified
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $unverifyUser)
                                    <tr class="bg-white border-b ">
                                        <td class="w-4 p-4">
                                        </td>
                                        <th scope="row" class="px-6 py-4 font-medium text-gray-400 whitespace-nowrap ">
                                            {{ $unverifyUser->name }}
                                        </th>
                                        <td class="px-6 py-4">
                                            {{ $unverifyUser->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $unverifyUser->cnic }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $unverifyUser->phonenumber }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $unverifyUser->role }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $unverifyUser->created_at }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if ($unverifyUser->verifiedUser === 1)
                                                <span class="text-green-600">Verified</span>
                                            @else
                                                <span class="text-red-600">Not Verified</span>
                                            @endif
                                        </td>
                                        <td class="flex items-center px-6 py-4 space-x-3">
                                            @if ($unverifyUser->verifiedUser === 0)
                                                <form action="{{ route('admin.verify.customer', $unverifyUser) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-[var(--secondary-color)] p-2 text-[var(--text-color)] rounded-xl font-bold hover:bg-[var(--main-color)] duration-300">Verify</button>
                                                </form>
                                            @else
                                                <form action="{{ route('admin.unVerify.customer', $unverifyUser) }}"
                                                    method="POST">
                                                    @csrf
                                                    <button type="submit"
                                                        class="bg-[var(--main-color)] p-2 text-[var(--text-color)] rounded-xl font-bold hover:bg-[var(--secondary-color)] duration-300">Refute</button>
                                                </form>
                                            @endif


                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif

                <div class="pagination mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </section>
@endsection
