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

        <form method="post" action="{{ route('service-categories.update', $category->id) }}" enctype="multipart/form-data">
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
                    <h5 class="card-header p-0">Create new product</h5>
                    <a href="{{ route('service-categories.index') }}" class="btn btn-primary">View all product</a>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        {{-- name --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Name</label>
                            <div class="col-md-10">
                                <input class="form-control @error('name') is-invalid @enderror" type="text"
                                    placeholder="Enter name" name="name" value="{{ old('name', $category->name) }}">
                                @error('name')
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

                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }} Image"
                            style="max-width: 100px;">

























                        <div class="mb-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ms-auto">Create Product</button>
                        </div>
                    </div>

                </div>


            </div>


        </form>
    </div>
@endsection
