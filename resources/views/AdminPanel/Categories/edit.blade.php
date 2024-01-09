@extends('layouts.adminLayout')
@section('content')
    <section class="adminpanel">
        <div class="mainAdminPanel flex justify-center">
            @include('components.adminnavbar')
            <div class="rightAdmin w-[80%] h-[auto] p-6 bg-[var(--background-color)] ml-4">
                <h1 class="text-center text-5xl pb-4 font-semibold text-[var(--text-color)] mt-6">Update Categories</h1>
                <br>
                <div class="container flex justify-center items-center">
                    <form class="form" action="{{ route('admin.category.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data">
                        <h2 class="title">Update This Category</h2>
                        @csrf

                        <div class="form-group">
                            <label for="category" class="text-[var(--text-color)]">Category Name</label>
                            <input placeholder="example: Car" type="text" value="{{ $category->name }}" id="category"
                                name="name" class="form-control input" required>
                        </div>
                        @if (session('success'))
                            <div class="message text-xl" style="color: green;">{{ session('success') }}</div>
                        @endif
                        @if (session('Failed'))
                            <div class="message text-xl" style="color: rgb(255, 0, 0);">{{ session('Failed') }}</div>
                        @endif
                        <button type="submit" class="submit">Update Category</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
