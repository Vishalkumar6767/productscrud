<!-- resources/views/products/edit.blade.php -->

@extends('layouts.app')

@section('content')
<div class="product-container">
    <h1 class="page-title">Edit Category</h1>

    <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" value="{{ $category->name }}" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="cost" class="form-label">Short Name</label>
            <input type="text" name="short_name" id="cost" value="{{ $category->short_name }}" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="price" class="form-label">Parent Id</label>
            <input type="number" name="parent_id" id="price" value="{{ $category->parent_id }}" class="form-control" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
