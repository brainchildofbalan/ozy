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

        <form method="post" action="{{ route('menus.update', $category->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

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
                    <h5 class="card-header p-0">Create new sub category</h5>
                    <a href="{{ route('menus.index') }}" class="btn btn-primary">View all category</a>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        {{-- title --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">title</label>
                            <div class="col-md-10">
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                    placeholder="Enter title" name="title" value="{{ old('title', $category->title) }}">
                                @error('title')
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
                                    {{-- @foreach ($categoriesList as $category)
                                        <option value="{{ $category->category_id }},{{ $category->name }}"
                                            {{ old('category_id') == $category->category_id . ',' . $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}

                                        </option>
                                    @endforeach --}}

                                    @foreach ($categoriesList as $categoryListed)
                                        <option
                                            value="{{ $categoryListed->category_id }},{{ $categoryListed->name }},{{ $category->url }}"
                                            {{ old('category_id', $category->category_id) == $categoryListed->category_id . ',' . $categoryListed->name . ',' . $categoryListed->url ? 'selected' : '' }}>
                                            {{ $categoryListed->name }}
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


                        {{-- belongs_to --}}
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">Category</label>
                            <div class="col-md-10">

                                <select id="defaultSelect" name="belongs_to"
                                    class="form-select @error('belongs_to') is-invalid @enderror">
                                    <option value="" {{ old('belongs_to') == '' ? 'selected' : '' }}>Default
                                        select
                                    </option>

                                    <option value="products"
                                        {{ old('belongs_to', $category->belongs_to) == 'products' ? 'selected' : '' }}>
                                        products
                                    </option>

                                    <option value="services"
                                        {{ old('belongs_to', $category->belongs_to) == 'services' ? 'selected' : '' }}>
                                        services
                                    </option>


                                </select>
                                @error('belongs_to')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror




















                                <div class="mb-0 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary ms-auto">Create Product</button>
                                </div>
                            </div>

                        </div>


                    </div>


        </form>
    </div>
@endsection
