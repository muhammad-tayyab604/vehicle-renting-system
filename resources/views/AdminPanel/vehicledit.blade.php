@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] ml-6 p-6 bg-[var(--background-color)] ">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Edit Vehicle</h1>
                <br>

                <div class="container flex justify-center items-center">
                    <div class="main w-[80%]">
                        <h2 class="title">Update or Delete Vehicle</h2>
                        @if (session('success'))
                            <div class="text-xl font-semibold text-center" style="color: green;">{{ session('success') }}
                            </div>
                        @else
                            <div class="text-xl font-semibold text-center" style="color: red;">{{ session('error') }}</div>
                        @endif
                        <div class="">
                            @if ($noVehicleMessage)
                                <div class="noVehicle flex justify-center mt-72 text-gray-500">
                                    {{ $noVehicleMessage }}
                                </div>
                            @else
                                @foreach ($vehicles as $vehicle)
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg mb-4">
                                        <table class="w-full text-sm text-center  ">
                                            <thead
                                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Image
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Make
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Model
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Category
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Price
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Driver's Fee
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Color
                                                    </th>
                                                    <th scope="col" class="px-6 py-3">
                                                        Edit
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="bg-white border-b ">
                                                    <th scope="row" class="px-6 py-4 whitespace-nowrap ">
                                                        <img src="{{ asset($vehicle->photo) }}" class="w-52"
                                                            alt="">
                                                    </th>
                                                    <td class="px-6 py-4">
                                                        {{ $vehicle->make }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $vehicle->model }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $vehicle->category->name }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $vehicle->price }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $vehicle->drivers_fee }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        {{ $vehicle->color }}
                                                    </td>
                                                    <td class="px-6 py-4">
                                                        <div class="">
                                                            <a
                                                                href="{{ route('admin.edit.vehicles.getVehicleUpdate', ['id' => $vehicle->id]) }}"><i
                                                                    class="fa-solid fa-pen-to-square text-2xl hover:text-[var(--secondary-color)] duration-300"></i></a>
                                                            <br>
                                                            <form
                                                                action="{{ route('admin.edit.vehicles.delete', ['id' => $vehicle->id]) }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="delete-vehicle" type="submit"><i
                                                                        class="fa-solid fa-trash text-2xl hover:text-[var(--main-color)] duration-300 mt-4"></i></button>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                @endforeach
                            @endif
                            <div class="pagination mt-4">
                                {{ $vehicles->links() }}
                            </div>
                        </div>
                    </div>


                </div>

            </div>
        </div>
    </section>
@endsection
