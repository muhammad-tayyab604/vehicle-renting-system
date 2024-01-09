@extends('layouts.app')
@section('content')
    <section class="dashboard" id="dashboard">
        <div class="dashboardMain">
            @include('components.dashLayout')
            <div class="dashboardRight">
                <h1 class="dashboardHeading">My Favourite Cars</h1>
                <div class="dashboardMainContainer">
                    @if ($favItem->isEmpty())
                        <div class="flex justify-center items-center mt-20">
                            <p class="text-gray-500 text-3xl">There is Nothing in Favourite</p>
                        </div>
                    @else
                        <div class="-translate-y-2 flex justify-between">
                            <a href="{{ route('fav.mov.all.to.cart') }}">
                                <p
                                    class="font-semibold uppercase text-[var(--main-color)] hover:text-[var(--secondary-color)] transition-all">
                                    Add All Cart</p>
                            </a>
                            <a href="{{ route('fav.clear.all') }}">
                                <p
                                    class="font-semibold uppercase text-[var(--main-color)] hover:text-[var(--secondary-color)] transition-all">
                                    Delete All</p>
                            </a>
                        </div>



                        <div class="bg-[var(--background-color)] flex justify-between h-10">
                            <div class="">
                                <p class="font-semibold">WhishList</p>
                            </div>
                        </div>
                    @endif
                    <div class="successMessage">
                        <p class="text-green-600 mb-4 font-bold text-xl">{{ session('cartSuccess') }}</p>
                    </div>
                    <div class="successMessage">
                        <p class="text-green-600 mb-4 font-bold text-xl">{{ session('allItemsAdded') }}</p>
                    </div>
                    <div class="successMessage">
                        <p class="text-red-600 mb-4 font-bold text-xl">{{ session('delFav') }}</p>
                    </div>
                    @foreach ($favItem as $favVehicle)
                        <div class="bg-[#eeeeee] mt-2 ">
                            <table>
                                <tr>
                                    <td class="text-center flex items-center">
                                        <a href="{{ route('fav.delete', ['id' => $favVehicle['id']]) }}"><i
                                                class="fa-solid fa-trash text-2xl mr-4"
                                                style="color: var(--text-color)"></i></a>
                                        <img src="{{ asset($favVehicle->photo) }}" alt="">
                                    </td>
                                    <td class="text-center w-52">{{ $favVehicle->make }} - {{ $favVehicle->model }}</td>
                                    <td class="text-center w-52">{{ $favVehicle->color }}</td>
                                    <td class="text-center">{{ $favVehicle->price }} <span
                                            class="text-[var(--main-color)]">/day</span> </td>
                                    <td></td>
                                    <td></td>
                                    <td class="text-center">
                                        @if (collect(session('cart', []))->contains('id', $favVehicle->id))
                                            <i
                                                class="fa-solid fa-cart-shopping text-white border rounded-xl text-3xl bg-[var(--main-color)] p-2 pl-7 pr-7 "></i>
                                    </td>
                                @else
                                    <a href="{{ route('add.to.cart', ['vehicle' => $favVehicle->id]) }}"><i
                                            class="fa-solid fa-cart-shopping text-white border rounded-xl text-3xl bg-[var(--main-color)] p-2 pl-7 pr-7 animate-bounce"></i></a>
                                    </td>
                    @endif
                    </tr>
                    </table>
                </div>
                @endforeach

            </div>
        </div>
        </div>
    </section>
@endsection
