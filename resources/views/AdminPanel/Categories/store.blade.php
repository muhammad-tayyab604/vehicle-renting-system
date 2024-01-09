@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel ">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)] mt-6">Add Categories</h1>
                <br>
                <div class="container flex justify-center items-center">
                    <form class="form" action="{{ route('admin.category.store') }}" method="POST"
                        enctype="multipart/form-data">
                        <h2 class="title">Add New Category</h2>
                        @csrf

                        <div class="form-group">
                            <label for="category" class="text-[var(--text-color)]">Category Name</label>
                            <input placeholder="example: Car" type="text" id="category" name="name"
                                class="form-control input" required>
                        </div>
                        @if (session('success'))
                            <div class="message text-xl" style="color: green;">{{ session('success') }}</div>
                        @endif
                        @if (session('Failed'))
                            <div class="message text-xl" style="color: rgb(255, 0, 0);">{{ session('Failed') }}</div>
                        @endif
                        <button type="submit" class="submit">Add Category</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
