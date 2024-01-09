@extends('layouts.app')
@section('content')
    @guest
        <section class="home" id="home">
            <div class="text">
                <h1><span>Looking</span> for<br> rent a car?</h1>
                <p> Welcome to our Vehicle Renting System! Our Vehicle Renting System is a state-of-the-art platform designed to
                    provide convenient and seamless access to a wide range of vehicles for all your transportation needs.
                    Whether you're planning a weekend getaway, a business trip, or simply need a reliable vehicle for everyday
                    commuting, we've got you covered.</p>
                <div class="appStores">
                    <a href="#appstore"><img src="{{ asset('img/ios.png') }}" alt=""></a>
                    <a href="#playstore"><img src="{{ asset('img/playstore.png') }}" alt=""></a>
                </div>
            </div>
        </section>
    @endguest


    {{-- When user logged in he/she will see this --}}
    @auth
        <section class="loggedInHome bg-[var(--background-color)]" id="home">
            <div class="bgForImage mt-4">
                <div class="vehicle-carousel w-full">
                    <div class="vehicle-slide">
                        <img src="{{ asset('img/banner1.png') }}" alt="Vehicle Image 1">
                    </div>
                    <div class="vehicle-slide">
                        <img src="{{ asset('img/banner2.png') }}" alt="Vehicle Image 2">
                    </div>
                    <a href="{{ route('searchvehicles') }}">
                        <div class="vehicle-slide">
                            <img src="{{ asset('img/banner3.gif') }}" alt="Vehicle Image 3">
                        </div>
                    </a>
                </div>
                <div class="carousel-controls">
                    <button id="prev-button">&larr;</button>
                    <button id="next-button">&rarr;</button>
                </div>
            </div>
        </section>
    @endauth
    {{-- When user logged in he/she will see this Ends --}}

    {{-- Ride Section --}}

    <section class="ride mt-4" id="ride">
        <div class="heading">
            <span>How Its Work</span>
            <h1>Rent with 3 easy steps</h1>
        </div>

        <div class="container-ride">
            <div class="box">
                <i class="fa-solid fa-location-dot w-48"></i>
                <h1>Location</h1>
                <p>To choose your desired location, start with the 'Location'. Here, you can specify your preferred
                    pick-up and drop-off locations. This step allows you to begin your journey from a location convenient
                    for you, whether it's an airport, a city center, or any other spot.</p>
            </div>
            <div class="box">
                <i class="fa-regular fa-calendar-days"></i>
                <h1>Pick-Up/Drop-off Date</h1>
                <p>Once you've set your location, proceed to the 'Pickup/Drop-off Date' card. Here, select the rental dates
                    and times that suit your travel plans. Our flexible options ensure you can rent a vehicle for as long as
                    you need, whether it's a few hours, days, or even months.</p>
            </div>
            <div class="box">
                <i class="fa-solid fa-calendar-check"></i>
                <h1>Book a vehicle</h1>
                <p>In the 'Book a Vehicle' card, review available vehicles based on your location and dates. Click to
                    explore features and pricing. If it's a match, click 'Book Now.' Provide details and payment, then
                    you're ready for your journey.</p>
            </div>
        </div>

    </section>

    {{-- Service Section --}}

    <section class="services" id="services">
        <div class="heading">
            <span>Our Best Cars</span>
            <h1>Rent our top cars </h1>
        </div>
        <div class="services-container">
            @foreach ($vehicles as $index => $vehicle)
                @if ($index < 8)
                    <div class="box">
                        <div class="box-img">
                            @if (auth()->check())
                                <a href="{{ route('proceedtocheckout', $vehicle) }}"><img src="{{ asset($vehicle->photo) }}"
                                        alt=""></a>
                            @else
                                <a href="{{ route('login') }}"><img src="{{ asset($vehicle->photo) }}" alt=""></a>
                            @endif
                        </div>
                        <p>Model:{{ $vehicle->model }}</p>
                        <h3>{{ $vehicle->make }}</h3>
                        <h2>{{ $vehicle->price }}RS <span>/day</span></h2>
                        <h4 class="text-[var(--text-color)]">Color: {{ $vehicle->color }}</h4>
                        <h1 class="text-sm font-semibold">Driver's Fee: {{ $vehicle->drivers_fee }}</h1>
                        @if (auth()->check())
                            <a href="{{ route('proceedtocheckout', $vehicle) }}" class="rentBTN">Rent Now</a>
                        @else
                            <a href="{{ route('login') }}" class="rentBTN">Rent Now</a>
                        @endif

                    </div>
                @endif
            @endforeach
        </div>
    </section>

    {{-- About Section --}}
    <section class="about" id="about">
        <div class="heading">
            <span>About Us</span>
            <h1>We are biggest Rent a car Company</h1>
        </div>
        <div class="about-container">
            <div class="about-img">
                <img src="{{ asset('img/about.png') }}" alt="">
            </div>
            <div class="about-text">
                <p><span>About Us</span> <br> At our Vehicle Renting System, we aim to simplify vehicle rentals. With just a
                    few clicks, explore our diverse fleet, from compact cars to spacious SUVs. We offer options for every
                    need and budget.
                <p class="text-lg text-[var(--secondary-color)] font-bold">Why us:</p>
                <ol>
                    <li>1. Wide Variety: Find the perfect vehicle, be it fuel-efficient or luxury.</li>
                    <li>2. User-Friendly: Our platform makes renting easy—browse, compare, and book effortlessly.</li>
                    <li>3. Transparent Pricing: No hidden fees—enjoy competitive rates.</li>
                    <li>4. Easy Booking: Our straightforward process ensures a hassle-free experience.</li>
                    <li>5. Support: Our team is ready to assist with any questions.</li>
                    <li>6. Safety: Regular maintenance and inspections prioritize your well-being.</li>
                    <li>7. Flexible Rentals: Choose from hourly, daily, or monthly options.</li>
                </ol>
                <br>
                Join our satisfied community, bid transportation worries goodbye, and embark on your journeys with
                confidence. Welcome to the future of vehicle renting!
                </p>
                <a href="#contactUs">Learn More</a>
            </div>
        </div>
    </section>

    {{-- Contact Us --}}
    <section class="contactUs" id="contactUs">
        <div class="heading">
            <span>Contact Us</span>
            <h1>You can Ask any question!</h1>
        </div>
        @if (session('success'))
            <div class="message" style="color: green;">{{ session('success') }}</div>
        @endif

        <div class="contactform">

            <form class="form" action="{{ route('contact.submit') }}" method="POST">
                @csrf
                <h1 class="title">Send Us a message</h1>
                {{-- <label class="label"  for="name">Name:</label> --}}
                <input class="input" type="text" name="name" placeholder="Enter your name" required>

                {{-- <label class="label" for="email">Email:</label> --}}
                <input class="input" type="email" name="email" placeholder="example@gmail.com" required>

                {{-- <label class="label" for="message">Message:</label> --}}
                <textarea class="input" name="message" rows="4" placeholder="Message" required></textarea>

                <button type="submit" class="submit">Submit</button>
            </form>
        </div>

    </section>
@endsection


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
