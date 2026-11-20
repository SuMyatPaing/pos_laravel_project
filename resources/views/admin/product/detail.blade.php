
@extends('admin.layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Product Details</h5>
                    </div>

                    <div class="card-body">

                        <div class="text-center mb-4">
                            <img
                                src="{{ asset('productImage/'.$product->image) }}"
                                class="img-thumbnail"
                                style="width: 200px; height: 200px; object-fit: cover;"
                                alt="{{ $product->name }}">
                        </div>

                        <table class="table table-bordered">
                            <tr>
                                <th>Product ID</th>
                                <td>{{ $product->id }}</td>
                            </tr>

                            <tr>
                                <th>Name</th>
                                <td>{{ $product->name }}</td>
                            </tr>

                            <tr>
                                <th>Price</th>
                                <td>{{ $product->price }} MMK</td>
                            </tr>

                            <tr>
                                <th>Stock</th>
                                <td>{{ $product->stock }}</td>
                            </tr>

                            <tr>
                                <th>Category</th>
                                <td>{{ $product->category_name ?? 'No category' }}</td>
                            </tr>

                            <tr>
                                <th>Description</th>
                                <td>{{ $product->description ?? 'No description' }}</td>
                            </tr>

                            <tr>
                                <th>Created At</th>
                                <td>{{ $product->created_at }}</td>
                            </tr>
                        </table>

                        <a href="{{ route('product#list') }}"
                           class="btn btn-secondary">
                            Back to Products
                        </a>

                        <a href="{{ route('product#edit', $product->id) }}"
                           class="btn btn-primary">
                            Edit Product
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection