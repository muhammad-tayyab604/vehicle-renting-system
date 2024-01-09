@extends('layouts.app')
@section('content')
    <section class="cart" id="cart">
        <div class="main flex justify-between">
            <h1 class="translate-y-24 text-5xl text-[var(--main-color)] font-bold">Cart</h1>
        </div>

        <div class="cartMain">
            <div class="leftCart">
                {{-- Messages Start --}}
                <div class="successMessage">
                    <p class="text-green-700 font-bold text-lg ml-4">{{ session('favSuccess') }}</p>
                </div>
                <div class="successMessage">
                    <p class="text-green-700 font-bold text-lg ml-4">{{ session('ItemAddedd') }}</p>
                </div>
                <div class="successMessage">
                    <p class="text-red-700 font-bold text-lg ml-4">{{ session('delCart') }}</p>
                </div>
                @if ($cartItem->isEmpty())
                    <div class="flex justify-center items-center p-32">
                        <p class="text-gray-500 text-3xl">There is Nothing in Cart</p>
                    </div>
                @else
                    {{-- Messages End --}}
                    <div class="-z-50 w-[100%] p-3 bg-[var(--background-color)] flex justify-between">
                        <a href="{{ route('delete.all.cart.items') }}" class="pl-3 text-xl text-[var(--main-color)]"><i
                                class="fa-solid fa-trash cursor-pointer" style="color: var(--main-color);"></i> Delete
                            All</a>
                    </div>
                    <hr>
                @endif

                @foreach ($cartItem as $item)
                    <table>
                        <tr>
                            <td class="text-center"><img src="{{ asset($item->photo) }}" alt=""></td>
                            <td class="text-center w-52">{{ $item->make }} - {{ $item->model }}</td>
                            <td class="text-center w-52">{{ $item->color }}</td>
                            <td class="text-center">{{ $item->price }} <span
                                    class="text-[var(--main-color)] text-[12px]">/day</span> <br>
                                <a href="{{ route('cart.delete', ['id' => $item['id']]) }}"><i
                                        class="fa-solid fa-trash text-2xl hover:[color:var(--main-color)] text-center"
                                        style="color: var(--text-color)"></i></a>
                                @if (collect(session('fav', []))->contains('id', $item->id))
                                    <button><a href="{{ route('fav.delete', ['id' => $item['id']]) }}"><i
                                                class="fa-solid fa-heart text-2xl p-2 text-center"
                                                style="color: var(--main-color)"></i></a></button>
                            </td>
                        @else
                            <button><a href="{{ route('add.to.fav', ['vehicle' => $item->id]) }}"><i
                                        class="fa-solid fa-heart text-2xl p-2 text-center"
                                        style="color: var(--text-color)"></i></a></button> </td>
                @endif
                <td class="text-center">
                    <a href="{{ route('proceedtocheckout', $item) }}"
                        class="bg-[var(--main-color)] p-4 rounded-lg drop-shadow-lg text-[var(--background-color)] text-xl font-bold hover:bg-[var(--secondary-color)] duration-300">Rent
                        Now</a>
                </td>
                </tr>
                </table>
                <hr>
                @endforeach
            </div>
    </section>
@endsection
