@extends('admin.layout')
@section('title', 'Create new product')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">

        {{-- @if ($errors->any())
            <?php var_dump($errors->all()); ?>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif --}}

        <form action="{{ route('services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- <label for="name">Name:</label>
            <input class="@error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror

            <label for="description">Description:</label>
            <textarea name="description">{{ old('description') }}</textarea> --}}

            <!-- Add other form fields based on your model attributes -->



            <div class="w-100">
                <!-- HTML5 Inputs -->
                <div class="card mb-3 flex-row justify-content-between align-items-center p-3">
                    <h5 class="card-header p-0">Create new product</h5>
                    <a href="{{ route('services.index') }}" class="btn btn-primary">View all product</a>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        {{-- name --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    placeholder="Enter name" name="name" value="{{ old('name') }}">
                                @error('name')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- description --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Description</label>
                            <div class="col-md-10">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" type="text"
                                    placeholder="Enter description" name="description">
                                    {{ old('description') }}
                                </textarea>
                                @error('description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- thumb_description --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">thumbnail description</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('thumb_description') is-invalid @enderror" type="text"
                                    placeholder="Enter thumb_description" name="thumb_description">{{ old('thumb_description') }}</textarea>
                                @error('thumb_description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- image --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Image</label>
                            <div class="col-md-10">
                                <input class="form-control @error('image') is-invalid @enderror" type="file"
                                    placeholder="Enter quantity" name="image" value="{{ old('image') }}">
                                @error('image')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- category_id --}}
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">Category</label>
                            <div class="col-md-10">

                                <select id="defaultSelect" name="category_id"
                                    class="form-select @error('category_id') is-invalid @enderror">
                                    <option value="" {{ old('category_id') == '' ? 'selected' : '' }}>Default
                                        select
                                    </option>

                                    @foreach ($categories as $category)
                                        <option value="{{ $category->category_id }},{{ $category->name }}"
                                            {{ old('category_id') == $category->category_id . ',' . $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- relative_products --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">relative_products</label>
                            <div class="col-md-10">
                                <input class="form-control @error('relative_products') is-invalid @enderror" type="text"
                                    placeholder="Enter relative_products" name="relative_products"
                                    value="{{ old('relative_products') }}">
                                @error('relative_products')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
























                        <div class="mb-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ms-auto">Create Product</button>
                        </div>
                    </div>

                </div>


            </div>


        </form>
    </div>
@endsection
