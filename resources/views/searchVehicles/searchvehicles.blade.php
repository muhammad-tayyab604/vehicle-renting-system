@extends('layouts.app')
@section('content')

    <section class="search flex">
        <div class="searchLeft translate-y-32  h-[100vh]  ">
            <form class=" bg-white border border-black rounded-md p-4" action="{{ route('searchvehicles') }}" method="GET">
                <div class="colors w-52 ml-3 pt-3">
                    <p class="text-md md:text-2xl font-medium border-b border-black">Available Colors</p>
                    <br>
                    @foreach ($vehicleColor as $colors)
                        <label>
                            <input class="text-[var(--main-color)]" type="radio" value="{{ $colors }}" name="color"
                                {{ old('color') === $colors ? 'checked' : '' }}>
                            <span>{{ $colors }}</span>
                        </label>
                    @endforeach
                </div>
                <hr>
                <div class="model w-60 ml-3 pt-3 ">
                    <p class="text-2xl font-medium border-b border-black">Available Models</p>
                    <br>
                    @foreach ($vehicleModel as $model)
                        <label>
                            <input class="text-[var(--main-color)]" type="radio" value="{{ $model }}"
                                name="model">
                            <span>{{ $model }}</span>
                        </label>
                    @endforeach
                </div>
                <hr>
                <div class="price w-80 ml-3 pt-3">
                    <p class="text-2xl font-medium border-b border-black w-56">Price Range</p>
                    <br>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="price_range" value="0-30000">
                        <span>0 - 30000</span>
                    </label>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="price_range" value="31000-60000">
                        <span>31000-60000</span>
                    </label> <br>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="price_range" value="61000-90000">
                        <span>61000-90000</span>
                    </label>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="price_range" value="91000-130000">
                        <span>91000-130000</span>
                    </label>
                </div>
                <div class="dricer-fee  w-60 ml-3 pt-3">
                    <p class="text-2xl font-medium border-b border-black w-56">Driver's Fee</p>
                    <br>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="drivers_fee_range" value="0-1000">
                        <span>0 - 1000</span>
                    </label>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="drivers_fee_range" value="1100-4000">
                        <span>1100-4000</span>
                    </label> <br>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="drivers_fee_range" value="4100-6000">
                        <span>4100-6000</span>
                    </label>
                    <label>
                        <input class="text-[var(--main-color)]" type="radio" name="drivers_fee_range" value="6100-8000">
                        <span>6100-8000</span>
                    </label>
                </div>
                <div class="search-by ml-3 mr-3 pt-3 pb-3 text-center">
                    <br>
                    <hr>
                    <button type="submit"
                        class="text-center p-4 bg-[var(--secondary-color)] text-[var(--background-color)] hover:bg-[var(--main-color)] duration-300 text-xl rounded-lg font-bold w-[100%]">Search</button>
                </div>
            </form>

        </div>
        <div class="searchVehicle ">




            <form action="{{ route('searchvehicles') }}" method="GET">
                <div class="text-center">
                    <div class="relative inline-block text-left">
                        <select name="category" id="category" class=" border-none rounded-[15px]">
                            <option disabled selected>--Categories--</option>
                            <br>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>

                    </div>

                    <i class="fa-solid fa-magnifying-glass translate-x-9 text-[var(--text-color)] text-xl"></i>
                    <input name="query" type="text" placeholder="Search e.g:Honda Civic"
                        value="{{ request()->input('query') }}">
                    <button type="submit"
                        class="bg-[var(--main-color)] text-xl p-2 pl-5 pr-5 rounded-lg text-white font-medium hover:bg-[var(--secondary-color)] duration-300">Search</button>
                </div>
        </div>
        </form>
        </div>



        <div class="searchedContainer w-[100%] justify-center items-center ">
            {{-- First Div Start --}}
            <div class="successMessage">
                <p class="text-green-600 mb-4 font-bold text-xl">{{ session('cartSuccess') }}</p>
            </div>
            <div class="successMessage">
                <p class="text-green-600 mb-4 font-bold text-xl">{{ session('favSuccess') }}</p>
            </div>

            @if ($vehicles->isEmpty())
                <div class="noVehicle flex justify-center mt-5 text-gray-500 text-3xl">
                    <p>No Vehicle Found</p>
                </div>
                <div class="noVehicle flex justify-center mt-5 text-gray-500 text-lg">
                    <p>Availabe Vehicles</p>
                </div>
                <hr class="border-black pb-10">

                {{-- Available Vehicle --}}
                <div class="flex flex-wrap gap-4">
                    @foreach ($availableVehicles as $Availvehicle)
                        <div class="max-w-sm bg-white border border-gray-200 relative rounded-lg shadow">
                            <!-- Cart and Fav Icons -->
                            <div class="absolute flex justify-between w-full px-4">
                                <div>
                                    @if (collect(session('fav', []))->contains('id', $Availvehicle->id))
                                        <a href="{{ route('fav.delete', ['id' => $Availvehicle->id]) }}">
                                            <i
                                                class="fa-solid fa-heart text-2xl mt-4 text-[var(--main-color)] cursor-pointer"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('add.to.fav', ['vehicle' => $Availvehicle->id]) }}">
                                            <i
                                                class="fa-solid fa-heart text-2xl mt-4 text-[var(--secondary-color)] hover:text-[var(--main-color)] duration-300 cursor-pointer"></i>
                                        </a>
                                    @endif
                                </div>
                                <div>
                                    @if (collect(session('cart', []))->contains('id', $Availvehicle->id))
                                        <a href="{{ route('cart.delete', ['id' => $Availvehicle->id]) }}">
                                            <i
                                                class="fa-solid fa-cart-shopping mt-4 text-2xl text-[var(--main-color)] cursor-pointer"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('add.to.cart', ['vehicle' => $Availvehicle->id]) }}">
                                            <i
                                                class="fa-solid fa-cart-shopping mr-4 mt-4 text-2xl text-[var(--secondary-color)] hover:text-[var(--main-color)] duration-300 cursor-pointer"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Image -->
                            <a href="#">
                                @if (auth()->check())
                                    <a href="{{ route('proceedtocheckout', $Availvehicle) }}"><img class="rounded-t-lg"
                                            src="{{ asset($Availvehicle->photo) }}" alt=""></a>
                                @else
                                    <a href="{{ route('login') }}"><img class="rounded-t-lg"
                                            src="{{ asset($Availvehicle->photo) }}" alt=""></a>
                                @endif
                            </a>

                            <!-- Content -->
                            <div class="p-5">

                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">
                                    {{ $Availvehicle->make }}
                                    (RS {{ $Availvehicle->price }} <span class="text-[var(--main-color)]">/day</span>)
                                </h5>

                                <div class="searchCarDetails grid grid-cols-2">
                                    <p class="text-[var(--text-color)]">Model: {{ $Availvehicle->model }}</p>
                                    <p class="text-[var(--text-color)]">Color: {{ $Availvehicle->color }}</p>
                                    <p class="text-[var(--text-color)]">Category: {{ $Availvehicle->category->name }}</p>
                                    <p class="pb-5 text-[var(--text-color)]">Driver's Fee:
                                        {{ $Availvehicle->drivers_fee }}</p>
                                </div>
                                @if (auth()->check())
                                    <a href="{{ route('proceedtocheckout', $Availvehicle) }}">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-lg font-medium  text-center text-white bg-[var(--main-color)] hover:bg-[var(--secondary-color)] duration-100 rounded-lg focus:ring-4 focus:outline-none">
                                            Rent Now
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-lg font-medium  text-center text-white bg-[var(--main-color)] hover:bg-[var(--secondary-color)] duration-100 rounded-lg focus:ring-4 focus:outline-none">
                                            Rent Now
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                {{-- Searched Vehicles OR All Vehicles --}}
                <div class="flex flex-wrap gap-4 mt-16">


                    @foreach ($vehicles as $vehicle)
                        <div class="max-w-sm bg-white border border-gray-200 relative rounded-lg shadow">
                            <!-- Cart and Fav Icons -->
                            @if (auth()->check())
                                <div class="absolute flex justify-between w-full px-4">
                                    <div>
                                        @if (collect(session('fav', []))->contains('id', $vehicle->id))
                                            <a href="{{ route('fav.delete', ['id' => $vehicle->id]) }}">
                                                <i
                                                    class="fa-solid fa-heart text-2xl mt-4 text-[var(--main-color)] cursor-pointer"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('add.to.fav', ['vehicle' => $vehicle->id]) }}">
                                                <i
                                                    class="fa-solid fa-heart text-2xl mt-4 text-[var(--secondary-color)] hover:text-[var(--main-color)] duration-300 cursor-pointer"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div>
                                        @if (collect(session('cart', []))->contains('id', $vehicle->id))
                                            <a href="{{ route('cart.delete', ['id' => $vehicle->id]) }}">
                                                <i
                                                    class="fa-solid fa-cart-shopping mt-4 text-2xl text-[var(--main-color)] cursor-pointer"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('add.to.cart', ['vehicle' => $vehicle->id]) }}">
                                                <i
                                                    class="fa-solid fa-cart-shopping mr-4 mt-4 text-2xl text-[var(--secondary-color)] hover:text-[var(--main-color)] duration-300 cursor-pointer"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            @else
                                <div class="absolute flex justify-between w-full px-4">

                                </div>
                            @endif

                            <!-- Image -->
                            <a href="#">
                                @if (auth()->check())
                                    <a href="{{ route('proceedtocheckout', $vehicle) }}"><img class="rounded-t-lg"
                                            src="{{ asset($vehicle->photo) }}" alt=""></a>
                                @else
                                    <a href="{{ route('login') }}"><img class="rounded-t-lg"
                                            src="{{ asset($vehicle->photo) }}" alt=""></a>
                                @endif
                            </a>

                            <!-- Content -->
                            <div class="p-5">

                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-black">
                                    {{ $vehicle->make }}
                                    (RS {{ $vehicle->price }} <span class="text-[var(--main-color)]">/day</span>)
                                </h5>

                                <div class="searchCarDetails grid grid-cols-2">
                                    <p class="text-[var(--text-color)]">Model: {{ $vehicle->model }}</p>
                                    <p class="text-[var(--text-color)]">Color: {{ $vehicle->color }}</p>
                                    <p class="text-[var(--text-color)]">Category: {{ $vehicle->category->name }}</p>
                                    <p class="pb-5 text-[var(--text-color)]">Driver's Fee:
                                        {{ $vehicle->drivers_fee }}</p>
                                </div>
                                @if (auth()->check())
                                    <a href="{{ route('proceedtocheckout', $vehicle) }}">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-lg font-medium  text-center text-white bg-[var(--main-color)] hover:bg-[var(--secondary-color)] duration-100 rounded-lg focus:ring-4 focus:outline-none">
                                            Rent Now
                                        </button>
                                    </a>
                                @else
                                    <a href="{{ route('login') }}">
                                        <button
                                            class="inline-flex items-center px-3 py-2 text-lg font-medium  text-center text-white bg-[var(--main-color)] hover:bg-[var(--secondary-color)] duration-100 rounded-lg focus:ring-4 focus:outline-none">
                                            Rent Now
                                        </button>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            <div class="mr-20 mt-4">

                <a href="{{ route('searchvehicles') }}"><button
                        class="bg-[var(--secondary-color)] text-sm p-2 pl-4 pr-4 rounded-lg text-white font-medium hover:bg-[var(--main-color)] duration-300">All
                        Vehicles</button></a>
            </div>
            <div class="pagination mt-4">
                {{ $vehicles->links() }}
            </div>
        </div>
    </section>
@endsection
