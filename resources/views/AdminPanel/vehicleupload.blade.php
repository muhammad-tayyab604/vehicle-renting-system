@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Upload Vehicle</h1>
                <br>

                <div class="container flex justify-center items-center">
                    <form class="form" action="{{ route('admin.vehicles.store') }}" method="POST"
                        enctype="multipart/form-data">
                        <h2 class="title">Add New Vehicle</h2>
                        @csrf

                        <div class="form-group">
                            <label for="make" class="text-[var(--text-color)]">Make:</label>
                            <input placeholder="example: Honda Civic" type="text" id="make" name="make"
                                class="form-control input" required :value="old('make', $vehicle - > make)">
                        </div>

                        <div class="form-group">
                            <label for="model" class="text-[var(--text-color)]">Model:</label>
                            <input placeholder="example: 2023" type="number" id="model" name="model"
                                class="form-control input" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="text-[var(--text-color)]">Color:</label>
                            <input placeholder="example: Black" type="text" id="color" name="color"
                                class="form-control input" required>
                        </div>

                        <div class="form-group">
                            <label for="price" class="text-[var(--text-color)]">Price:</label>
                            <input placeholder="example: 20000/day" type="number" id="price" name="price"
                                class="form-control input" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="drivers_fee" class="text-[var(--text-color)]">Driver's Fee</label>
                            <input placeholder="example: 5000/day *NOTE:If you are uploading bicycle then write ZERO(0)"
                                type="number" id="price" name="drivers_fee" class="form-control input" step="0.01"
                                required>
                        </div>

                        <div class="form-group">
                            <label for="category" class="text-[var(--text-color)]">Category:</label>
                            <select id="vehicle_category_id" name="vehicle_category_id" class="form-control rounded-xl"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="photo" class="text-[var(--text-color)]">Photo: <span class="text-red-600">NOTE:
                                    Image size(1280px width/720px height)</span></label> <br>
                            <input type="file" id="" name="photo" class="form-control-file" required>
                        </div>
                        @if (session('success'))
                            <div class="message text-xl" style="color: green;">{{ session('success') }}</div>
                        @endif
                        @if (session('Failed'))
                            <div class="message text-xl" style="color: rgb(255, 0, 0);">{{ session('Failed') }}</div>
                        @endif
                        <button type="submit" class="submit">Add Vehicle</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
