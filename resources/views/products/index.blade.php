@extends('layouts.app')
@section('header')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold leading-tight text-gray-900">Products</h1>
    </div>
@endsection
@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow overflow-hidden sm:rounded-lg">
            <div class="px-4 py-5 sm:px-6">
                <h3 class="text-lg font-medium leading-6 text-gray-900">Product List</h3>

                <!-- Button to Add New Product -->
                <a href="{{ route('products.create') }}" class="btn btn-primary mb-3">Add New Product</a>

                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                <div>
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Category</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->user_id }}</td>
                                <td>{{ $product->category_id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    @if ($product->image)
                                        @if (Str::startsWith($product->image, ['http://', 'https://']))
                                            <img src="{{ $product->image }}" alt="Product Image" style="max-width: 100px;">
                                        @else
                                            <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" style="max-width: 100px;">
                                        @endif
                                    @else
                                        No image available
                                    @endif
                                </td>
                                <td>
                                    <!-- Button to Edit Product -->
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="btn btn-warning">Update</a>

                                    <!-- Form to Delete Product -->
                                    <form action="{{ route('products.delete', $product->id) }}" method="POST"
                                          style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }} <!-- Render pagination links -->
                </div>
            </div>
        </div>
    </div>
@endsection

