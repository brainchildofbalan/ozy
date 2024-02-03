@extends('admin.layout')
@section('title', 'Create new testimonials')
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

        <form method="post" action="{{ route('testimonials.update', $category->id) }}" enctype="multipart/form-data">
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
                    <h5 class="card-header p-0">Create new testimonial</h5>
                    <a href="{{ route('testimonials.index') }}" class="btn btn-primary">View all testimonials</a>
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


                        {{-- star --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">star</label>
                            <div class="col-md-10">
                                <input class="form-control @error('star') is-invalid @enderror" type="text"
                                    placeholder="Enter star" name="star" value="{{ old('star', $category->star) }}">
                                @error('star')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- designation --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">designation</label>
                            <div class="col-md-10">
                                <input class="form-control @error('designation') is-invalid @enderror" type="text"
                                    placeholder="Enter designation" name="designation"
                                    value="{{ old('designation', $category->designation) }}">
                                @error('designation')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- description --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">description</label>
                            <div class="col-md-10">
                                <textarea class="form-control @error('description') is-invalid @enderror" type="text" placeholder="Enter description"
                                    name="description">{{ old('description', $category->description) }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>




                        {{-- is_home --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Featured testimonial</label>
                            <div class="col-md-10">
                                <input class="form-check-input @error('is_home') is-invalid @enderror" type="checkbox"
                                    name="is_home" id="is_home" value="1"
                                    {{ old('is_home', $category->is_home) ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_home">
                                    Show in home page
                                </label>
                                @error('is_home')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

























                        <div class="mb-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ms-auto">Create testimonial</button>
                        </div>
                    </div>

                </div>


            </div>


        </form>
    </div>
@endsection
