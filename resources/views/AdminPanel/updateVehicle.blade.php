@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)]">Update Vehicle</h1>
                <br>

                <div class="container flex justify-center items-center">
                    <form class="form" action="{{ route('admin.edit.vehicles.updateVehicle', ['id' => $vehicle->id]) }}"
                        method="POST" enctype="multipart/form-data">
                        <h2 class="title">Update Vehicle's Information</h2>
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="make" class="text-[var(--text-color)]">Make:</label>
                            <input value="{{ $vehicle->make }}" placeholder="example: Honda Civic" type="text"
                                id="make" name="make" class="form-control input" required>
                        </div>

                        <div class="form-group">
                            <label for="model" class="text-[var(--text-color)]">Model:</label>
                            <input value="{{ $vehicle->model }}" placeholder="example: 2023" type="number" id="model"
                                name="model" class="form-control input" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="color" class="text-[var(--text-color)]">Color:</label>
                            <input value="{{ $vehicle->color }}" placeholder="example: Black" type="text" id="color"
                                name="color" class="form-control input" required>
                        </div>

                        <div class="form-group">
                            <label for="price" class="text-[var(--text-color)]">Price:</label>
                            <input value="{{ $vehicle->price }}" placeholder="example: 20000/day" type="number"
                                id="price" name="price" class="form-control input" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="vehicle_category_id" class="text-[var(--text-color)]">Category:</label>
                            <select id="vehicle_category_id" name="vehicle_category_id" class="form-control rounded-xl"
                                required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ $vehicle->vehicle_category_id == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-group">
                            <label for="photo" class="text-[var(--text-color)]">Photo: <span class="text-red-600">NOTE:
                                    Image size(1280px width/720px height)</span></label> <br>

                            <!-- Display the old photo -->
                            @if ($vehicle->photo)
                                <img src="{{ asset($vehicle->photo) }}" alt="Old Photo" class="mb-2"
                                    style="max-width: 100px;">
                                <input type="file" id="photo" name="photo" value="{{ $vehicle->photo }}"
                                    class="form-control-file" accept="image/*">
                            @endif

                            <!-- Input field for new photo -->


                            <!-- Hidden field to store the old photo value -->
                            <input type="hidden" name="old_photo" value="{{ $vehicle->photo }}">
                        </div>
                        @if (session('success'))
                            <div class="message text-xl" style="color: green;">{{ session('success') }}</div>
                        @endif
                        @if (session('Failed'))
                            <div class="message text-xl" style="color: rgb(255, 0, 0);">{{ session('Failed') }}</div>
                        @endif
                        <button type="submit" class="submit">Update Vehicle</button>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection
