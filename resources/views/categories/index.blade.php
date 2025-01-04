<!-- resources/views/products/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="product-container">
    <h1 class="page-title">Category List</h1>
    <a href="{{ route('categories.create') }}" class="btn btn-primary">Create New Category</a>
    <div class="product-table-container">
        <table class="product-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Short Name</th>
                    <th>Parent Id</th>
                   
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->short_name }}</td>
                        <td>{{ $category->parent_id }}</td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST">
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
