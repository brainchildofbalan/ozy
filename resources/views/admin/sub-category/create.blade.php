@extends('admin.layout')
@section('title', 'Create new sub category')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">
        {{-- <?php var_dump($categoriesList); ?> --}}
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




        <form action="{{ route('sub-categories.store') }}" method="POST" enctype="multipart/form-data">
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
                    <h5 class="card-header p-0">Create sub category</h5>
                    <a href="{{ route('sub-categories.index') }}" class="btn btn-primary">View all sub category</a>
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

                        {{-- relative_category_id --}}
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">Category</label>
                            <div class="col-md-10">

                                <select id="defaultSelect" name="relative_category_id"
                                    class="form-select @error('relative_category_id') is-invalid @enderror">
                                    <option value="" {{ old('relative_category_id') == '' ? 'selected' : '' }}>Default
                                        select
                                    </option>

                                    @foreach ($categoriesList as $category)
                                        <option value="{{ $category->category_id }},{{ $category->name }}"
                                            {{ old('relative_category_id') == $category->category_id . ',' . $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('relative_category_id')
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























                        <div class="mb-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ms-auto">Create sub category</button>
                        </div>
                    </div>

                </div>


            </div>


        </form>
    </div>
@endsection
