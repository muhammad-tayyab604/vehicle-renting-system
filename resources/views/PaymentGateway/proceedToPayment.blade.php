<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') Vehilce Renting System</title>
    @vite('resources/css/app.css', 'js/scrollreveal.js', 'resources/css/style.css')
    <link rel="stylesheet" href="{{ asset('web/css/main.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    {{-- Icons CDN --}}
    <script src="https://kit.fontawesome.com/9460aaea96.js" crossorigin="anonymous"></script>
    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    {{-- Scroll reveal --}}
    <script src="https://unpkg.com/scrollreveal"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500&family=Roboto:wght@300&display=swap"
        rel="stylesheet">
</head>

<body>
    <section class="checkout" id="checkout">
        <h1 class="heading text-4xl font-bold">Vehicle Renting System</h1>
        <div class="MainCheckoutDiv">
            <div class="leftCheckout">
                <div class="-translate-y-9">
                    <a href="{{ route('myReservations') }}" class="text-[var(--buttonCL)] font-bold text-xl"><i
                            class="fa-solid fa-arrow-left p-2"></i>Back</a>
                </div>

                <div class="orderDetails -translate-y-9">
                    <div class="">
                        <h1 class="text-3xl text-[var(--buttonCL)] drop-shadow-md font-bold">
                            {{ $booking->vehicle->make }}
                            {{ $booking->vehicle->model }} For Checkout</h1>
                        <hr>
                        <img src="{{ asset($booking->vehicle->photo) }}" alt="">
                    </div>
                </div>
                <div class="userAndVehicleInfo flex justify-between items-center">
                    <div class="mt-4 vehicleInfo">
                        <h1 class="p-4 border-b-2 border-black text-xl font-medium text-[var(--buttonCL)]">Vehicle
                            Information
                        </h1>
                        <p
                            class="bg-[var(--secondary-light)] mt-4 border-b-2 p-4 text-lg text-[var(--main-color)] font-bold">
                            Rent
                            Per day:
                            <span class="text-black">RS
                                {{ $booking->vehicle->price }}</span>
                        </p>
                        <p class=" p-4 text-lg text-[var(--main-color)] font-bold">Driver's Fee Per day: <span
                                class="text-black">RS
                                {{ $booking->vehicle->drivers_fee }}</span></p>
                        <p
                            class="bg-[var(--secondary-light)] border-b-2 p-4 text-lg text-[var(--main-color)] font-bold">
                            Total Payment:
                            <span class="text-black">RS
                                {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}</span>
                        </p>
                    </div>
                    <div class="mt-4 userInfo">
                        <h1 class="p-4 border-b-2 border-black text-xl font-medium text-[var(--buttonCL)]">Your
                            Information
                        </h1>
                        <p
                            class="bg-[var(--secondary-light)] mt-4 border-b-2 p-4 text-lg text-[var(--main-color)] font-bold">
                            Pick-up
                            by:<span class="text-black">

                                {{ auth()->user()->name }}
                            </span>
                        </p>

                        <p class="p-4 text-lg text-[var(--main-color)] font-bold"> Email
                            To:<span class="text-black">

                                {{ auth()->user()->email }}</p>
                        </span>
                        <p
                            class="bg-[var(--secondary-light)] mt-4 border-b-2 p-4 text-lg text-[var(--main-color)] font-bold">
                            CNIC:<span class="text-black">

                                {{ auth()->user()->cnic }}
                            </span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="rightCheckout">
                <div class="text-center">
                    <div class="col-md-6 col-md-offset-3">
                        <div class="panel panel-default credit-card-box">

                            <div class="panel-body">
                                <div class=" pt-4">
                                    <h3 class="title">Payment Details</h3>
                                </div>
                                <form action="{{ route('proceedToPay.post', $booking) }}" method="post">
                                    @csrf
                                    <div class="text-start">
                                        <i class="fa-solid fa-tags text-[var(--text-color)]"></i>
                                        <label for=""
                                            class="text-[var(--text-color)] font-semibold">Discount:</label>
                                        <input class="input" type="text" name="discount_code"
                                            placeholder="Discount Code (If Applicable)">
                                    </div>
                                    @if (session('Error'))
                                        <p class="text-start text-red-600 font-bold mt-4">{{ session('Error') }}</p>
                                    @endif
                                    <br>
                                    <hr>
                                    <p class="text-left p-4 text-lg font-bold">Order Summary</p>
                                    <div class="orderSummary flex justify-between">
                                        <div class="text-start text-[var(--text-color)] pl-4 font-semibold">
                                            <p>Items total</p>
                                            <p>Driver's Fee</p>
                                            <p>Total Payment</p>
                                        </div>
                                        <div class="text-start text-[var(--text-color)] pr-4">
                                            <p>Rs. {{ $booking->vehicle->price }}</p>
                                            <p>Rs. {{ $booking->vehicle->drivers_fee }}</p>
                                            <p>Rs. {{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}</p>
                                        </div>
                                    </div>
                                    <input type="hidden" name="vehicle_price"
                                        value="{{ $booking->vehicle->price + $booking->vehicle->drivers_fee }}">

                                    <button class="submit mt-4 w-full" type="submit">Pay Now</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</body>

<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

<script type="text/javascript">
    $(function() {

        /*------------------------------------------
        --------------------------------------------
        Stripe Payment Code
        --------------------------------------------
        --------------------------------------------*/

        var $form = $(".require-validation");

        $('form.require-validation').bind('submit', function(e) {
            var $form = $(".require-validation"),
                inputSelector = ['input[type=email]', 'input[type=password]',
                    'input[type=text]', 'input[type=file]',
                    'textarea'
                ].join(', '),
                $inputs = $form.find('.required').find(inputSelector),
                $errorMessage = $form.find('div.error'),
                valid = true;
            $errorMessage.addClass('hidden');

            $('.has-error').removeClass('has-error');
            $inputs.each(function(i, el) {
                var $input = $(el);
                if ($input.val() === '') {
                    $input.parent().addClass('has-error');
                    $errorMessage.removeClass('hidden');
                    e.preventDefault();
                }
            });

            if (!$form.data('cc-on-file')) {
                e.preventDefault();
                Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                Stripe.createToken({
                    number: $('.card-number').val(),
                    cvc: $('.card-cvc').val(),
                    exp_month: $('.card-expiry-month').val(),
                    exp_year: $('.card-expiry-year').val()
                }, stripeResponseHandler);
            }

        });

        /*------------------------------------------
        --------------------------------------------
        Stripe Response Handler
        --------------------------------------------
        --------------------------------------------*/
        function stripeResponseHandler(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hidden')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                /* token contains id, last4, and card type */
                var token = response['id'];

                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>

</html>
