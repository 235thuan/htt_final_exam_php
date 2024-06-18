@extends('layouts.app')
@section('header')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold leading-tight text-gray-900">Categories</h1>
    </div>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Categories</h2>
                <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Create Category</a>

                @if ($categories->isEmpty())
                    <p>No categories found.</p>
                @else
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $category->name }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-4">
                        {{ $categories->links() }} <!-- Render pagination links -->
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
