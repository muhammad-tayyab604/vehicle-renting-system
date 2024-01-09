<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Vehilce Renting System | Admin Panel</title>
    @vite('resources/css/app.css', 'js/scrollreveal.js', 'resources/css/dashboard.css')
    {{-- Main.css --}}
    {{-- jQuery CDN --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    {{-- jQuery CDN Ends --}}
    <link rel="stylesheet" href="{{ asset('web/css/main.css') }}">
    {{-- Icons CDN --}}
    <script src="https://kit.fontawesome.com/9460aaea96.js" crossorigin="anonymous"></script>
    <link href='https://unpkg.com/css.gg@2.0.0/icons/css/profile.css' rel='stylesheet'>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- Scroll reveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>
    {{-- Favicon --}}
    <link rel="icon" type="image/x-icon" href="{{ asset('icons/favicon.png') }}">

    {{-- Favicon --}}
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300&display=swap"
        rel="stylesheet">
</head>

<body>
    <div class="headerMain p-7">
        <header class="h-20">
            <a href="{{ route('adminIndex') }}" class="text-3xl font-bold"> Admin Panel</a>
            <div class="hamburger">
                <i id="icon1" class="fa-solid fa-bars"></i>
            </div>

            <div class="authIcons">
                <a href="{{ route('index') }}"><i class="fa-solid fa-house"></i></a>
                <i class="profile fa-solid fa-user-tie "></i>
            </div>
            </ul>


            <ul class="links">
                <li>{{ auth()->user()->name }}</li>
                <li>{{ auth()->user()->email }}</li>
                <li>You are {{ auth()->user()->role }}</li>
                <hr>
                <li><a href="{{ route('profile.edit') }}">Profile Setting</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">Logout</a>

                    </form>
                </li>
            </ul>

        </header>
    </div>
    <main>

        @yield('content')
        {{-- @include('layouts.layout2') --}}
    </main>
    </div>
    </section>

    <!-- JS File -->
    <script src="{{ asset('web/js/main.js') }}"></script>
    {{-- Scroll reveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>

    @yield('scripts')
</body>

</html>
