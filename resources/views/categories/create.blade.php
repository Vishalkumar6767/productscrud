<!-- resources/views/products/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="product-container">
    <h1 class="page-title">Create Categories</h1>

    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data" class="product-form">
        @csrf
        <div class="form-group">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="name" class="form-label">Short Name</label>
            <input type="text" name="short_name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="cost" class="form-label">Parent Id</label>
            <input type="number" name="parent_id" id="cost" class="form-control">
        </div>
       
       
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>
@endsection
