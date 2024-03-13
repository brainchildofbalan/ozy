@extends('admin.layout')
@section('title', 'Create new seo')
@section('content')
    <div class="flex-grow-1 container-p-x container-p-y">

        @if ($errors->any())
            <?php var_dump($errors->all()); ?>
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="post" action="{{ route('seo.update', $category->id) }}" enctype="multipart/form-data">
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
                    <h5 class="card-header p-0">Create new seo</h5>
                    <a href="{{ route('seo.index') }}" class="btn btn-primary">View all seo</a>
                </div>
                <div class="card mb-0">
                    <div class="card-body">
                        {{-- title --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Title</label>
                            <div class="col-md-10">
                                <input class="form-control @error('title') is-invalid @enderror" type="text"
                                    placeholder="Enter title" name="title"
                                    value="{{ old('title', $category->title ?? '') }}">
                                @error('title')
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
                                <input class="form-control @error('description') is-invalid @enderror" type="text"
                                    placeholder="Enter description" name="description"
                                    value="{{ old('description', $category->description ?? '') }}">
                                @error('description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- keywords --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Keywords</label>
                            <div class="col-md-10">
                                <input class="form-control @error('keywords') is-invalid @enderror" type="text"
                                    placeholder="Enter keywords" name="keywords"
                                    value="{{ old('keywords', $category->keywords ?? '') }}">
                                @error('keywords')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- author --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Author</label>
                            <div class="col-md-10">
                                <input class="form-control @error('author') is-invalid @enderror" type="text"
                                    placeholder="Enter author" name="author"
                                    value="{{ old('author', $category->author ?? '') }}">
                                @error('author')
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
                                <input class="form-control @error('image') is-invalid @enderror" type="text"
                                    placeholder="Enter image" name="image"
                                    value="{{ old('image', $category->image ?? '') }}">
                                @error('image')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- url --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">URL</label>
                            <div class="col-md-10">
                                <input class="form-control @error('url') is-invalid @enderror" type="text"
                                    placeholder="Enter URL" name="url" value="{{ old('url', $category->url ?? '') }}">
                                @error('url')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- canonical_url --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Canonical URL</label>
                            <div class="col-md-10">
                                <input class="form-control @error('canonical_url') is-invalid @enderror" type="text"
                                    placeholder="Enter canonical URL" name="canonical_url"
                                    value="{{ old('canonical_url', $category->canonical_url ?? '') }}">
                                @error('canonical_url')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- type --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('type') is-invalid @enderror" type="text"
                                    placeholder="Enter type" name="type"
                                    value="{{ old('type', $category->type ?? '') }}">
                                @error('type')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- locale --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Locale</label>
                            <div class="col-md-10">
                                <input class="form-control @error('locale') is-invalid @enderror" type="text"
                                    placeholder="Enter locale" name="locale"
                                    value="{{ old('locale', $category->locale ?? '') }}">
                                @error('locale')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- site_name --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Site Name</label>
                            <div class="col-md-10">
                                <input class="form-control @error('site_name') is-invalid @enderror" type="text"
                                    placeholder="Enter site name" name="site_name"
                                    value="{{ old('site_name', $category->site_name ?? '') }}">
                                @error('site_name')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- twitter_creator --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Twitter Creator</label>
                            <div class="col-md-10">
                                <input class="form-control @error('twitter_creator') is-invalid @enderror" type="text"
                                    placeholder="Enter twitter_creator" name="twitter_creator"
                                    value="{{ old('twitter_creator', $category->twitter_creator ?? '') }}">
                                @error('twitter_creator')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- og_type --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_type') is-invalid @enderror" type="text"
                                    placeholder="Enter og_type" name="og_type"
                                    value="{{ old('og_type', $category->og_type ?? '') }}">
                                @error('og_type')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>




                        {{-- og_title --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_title') is-invalid @enderror" type="text"
                                    placeholder="Enter og_title" name="og_title"
                                    value="{{ old('og_title', $category->og_title ?? '') }}">
                                @error('og_title')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- og_description --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_description') is-invalid @enderror" type="text"
                                    placeholder="Enter og_description" name="og_description"
                                    value="{{ old('og_description', $category->og_description ?? '') }}">
                                @error('og_description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- og_image --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_image') is-invalid @enderror" type="file"
                                    placeholder="Enter og_image" name="og_image" value="{{ old('og_image') }}">
                                @error('og_image')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- og_url --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_url') is-invalid @enderror" type="text"
                                    placeholder="Enter og_url" name="og_url"
                                    value="{{ old('og_url', $category->og_url ?? '') }}">
                                @error('og_url')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>




                        {{-- og_locale --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_locale') is-invalid @enderror" type="text"
                                    placeholder="Enter og_locale" name="og_locale"
                                    value="{{ old('og_locale', $category->og_locale ?? '') }}">
                                @error('og_locale')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>



                        {{-- og_site_name --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">OG Type</label>
                            <div class="col-md-10">
                                <input class="form-control @error('og_site_name') is-invalid @enderror" type="text"
                                    placeholder="Enter og_site_name" name="og_site_name"
                                    value="{{ old('og_site_name', $category->og_site_name ?? '') }}">
                                @error('og_site_name')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>





























                        <div class="mb-0 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary ms-auto">Create seo</button>
                        </div>
                    </div>

                </div>


            </div>


        </form>
    </div>
@endsection
