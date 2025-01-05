
@extends('layouts.app')

@section('content')
<div class="product-container">
    <h1 class="page-title">Product List</h1>
    <div class="product-header">
        <div class="header-left">
            <form action="{{ route('products.index') }}" method="GET" class="search-container">
                <div class="search-input-group">
                    <input type="text" 
                           id="searchInput" 
                           name="search" 
                           class="search-input" 
                           placeholder="Search products..."
                           value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary search-submit">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>
        </div>
        <div class="header-right">
            <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
        </div>
    </div>
    <div id="loader" class="loader-container" style="display: none;">
        <div class="loader"></div>
    </div>

    <div class="product-table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Sub-category</th>
                    <th>Cost</th>
                    <th>Price</th>
                    <th>Attachments</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subCategory->name }}</td>
                        <td>{{ $product->cost }}</td>
                        <td>{{ $product->price }}</td>
                        <td>
                            @if($product->attachments->count() > 0)
                                <ul class="attachment-list">
                                    @foreach ($product->attachments as $attachment)
                                        <li>
                                            <a href="{{ asset('storage/assets/attachments/' . $attachment->stored_name) }}" 
                                               class="attachment-link" 
                                               target="_blank">
                                                {{ $attachment->original_name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                <span>No attachments</span>
                            @endif
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('products.destroy', $product->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
