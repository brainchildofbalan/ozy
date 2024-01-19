@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="container">
        <h2>Category Details</h2>

        <p><strong>Category ID:</strong> {{ $category->category_id }}</p>
        <p><strong>Name:</strong> {{ $category->name }}</p>
        <p><strong>Order:</strong> {{ $category->order }}</p>

        @if ($category->image)
            <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }} Image" style="max-width: 300px;">
        @else
            <p>No image available</p>
        @endif

        <div class="mt-3">
            <a href="{{ route('service-categories.index') }}" class="btn btn-secondary">Back to Categories</a>
            <a href="{{ route('service-categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>

            <form method="post" action="{{ route('service-categories.destroy', $category->id) }}" class="d-inline"
                onsubmit="return confirm('Are you sure you want to delete this category?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
