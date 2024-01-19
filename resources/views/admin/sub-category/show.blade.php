@extends('admin.layout')
@section('title', 'Category')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">
        <div class="card p-3">
            <h4 class="card-header  p-0 mb-3">Sub category details</h4>

            <p class="mb-1"><strong>Category ID:</strong> {{ $category->category_id }}</p>
            <p class="mb-1"><strong>Name:</strong> {{ $category->name }}</p>
            <p class="mb-1"><strong>Order:</strong> {{ $category->order }}</p>

            @if ($category->image)
                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }} Image" style="max-width: 300px;">
            @else
                <p>No image available</p>
            @endif

            <div class="mt-3">
                <a href="{{ route('sub-categories.index') }}" class="btn btn-secondary">Back to Categories</a>
                <a href="{{ route('sub-categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>

                <form method="post" action="{{ route('sub-categories.destroy', $category->id) }}" class="d-inline"
                    onsubmit="return confirm('Are you sure you want to delete this category?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endsection
