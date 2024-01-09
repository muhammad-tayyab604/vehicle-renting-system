@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Discount Coupons</h1>
                <hr>
                <br>

                <div class="flex justify-center items-center">
                    <form class="form" action="{{ route('coupons.store') }}" method="POST">
                        @csrf
                        <p class="title">Add Discounts</p>
                        <div class="">
                            <label for="">Name:</label>
                            <input class="input" name="name" value="{{ old('name') }}"
                                placeholder="Name of discount e.x. Winter Discount" type="text">
                        </div>

                        <div class="">
                            <label for="Form-Label" class="text-[var(--text-color)]">Discount Type:</label>
                            <div class="w-full ">
                                <select name="discount_type" id="discount_type" class="rounded-xl">
                                    <option value="" disabled selected>Choose Discount</option>
                                    <option value="percentage">Percentage</option>
                                    <option value="fixed_price">Fixed Prce</option>
                                </select>
                            </div>
                        </div>

                        <div class="">
                            <label for="">Redemption</label>
                            <input type="number" placeholder="e.x. 2 (How many users can use this discount?)"
                                name="redemptions" class="input">
                        </div>

                        <div class="percentage_div">
                            <div class="">
                                <label for="">Percentage Amount</label>
                                <input type="text" placeholder="e.x. 25% NOTE:Don't write % sign"
                                    name="percentage_amount" class="input">
                            </div>
                        </div>

                        <div class="fixed_div">
                            <div class="">
                                <label for="">Fixed Amount</label>
                                <input type="text" placeholder="e.x. 2500" name="fixed_amount" class="input">
                            </div>
                        </div>
                        @if (session('success'))
                            <p class="couponSuccess text-center bg-green-300 p-4 rounded-lg font-bold text-green-600">
                                {{ session('success') }}
                            </p>
                        @endif
                        @if (session('failed'))
                            <p class="couponSuccess text-center bg-red-300 p-4 rounded-lg font-bold text-red-600">
                                {{ session('failed') }}
                            </p>
                        @endif
                        <button type="submit" class="submit">Add This Discount</button>
                    </form>

                </div>

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Set default input to fixed_amount
            $(".percentage_div").hide();
            $(".fixed_div").show();


            // Handle change event of the discount type select
            $("#discount_type").change(function() {
                var selectedValue = $(this).val();

                if (selectedValue === "percentage") {
                    $(".percentage_div").show();
                    $(".fixed_div").hide();
                } else if (selectedValue === "fixed_price") {
                    $(".percentage_div").hide();
                    $(".fixed_div").show();
                } else {
                    $(".percentage_div").hide();
                    $(".fixed_div").hide();
                }
            });
        });
    </script>
@endsection
