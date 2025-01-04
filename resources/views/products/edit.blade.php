<!-- resources/views/products/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="product-container">
    <h1 class="page-title">Edit Product</h1>

    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ $product->name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="sub_category_id" class="form-label">Sub-category</label>
            <select name="sub_category_id" id="sub_category_id" class="form-control" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $product->sub_category_id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cost" class="form-label">Cost</label>
            <input type="number" name="cost" id="cost" value="{{ $product->cost }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Price</label>
            <input type="number" name="price" id="price" value="{{ $product->price }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="attachments" class="form-label">Attachments</label>
            <input type="file" name="attachments[]" class="form-control" multiple>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
