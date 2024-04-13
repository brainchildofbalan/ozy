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

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- <label for="name">Name:</label>
            <input class="@error('name') is-invalid @enderror" type="text" name="name" value="{{ old('name') }}">
            @error('name')
                <span class="invalid-feedback">
                    {{ $message }}
                </span>
            @enderror

            <label for="description">Description:</label>
            <textarea id="description" name="description">{{ old('description') }}</textarea> --}}

            <!-- Add other form fields based on your model attributes -->



            <div class="w-100">
                <!-- HTML5 Inputs -->
                <div class="card mb-3 flex-row justify-content-between align-items-center p-3">
                    <h5 class="card-header p-0">Create new product</h5>
                    <a href="{{ route('products.index') }}" class="btn btn-primary">View all product</a>
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
                            <label for="html5-search-input" class="col-md-2 col-form-label">Descritpion</label>
                            <div class="col-md-10">
                                <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description"
                                    placeholder="Enter description" id="exampleFormControlTextarea1" rows="3">{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- price --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Pirce</label>
                            <div class="col-md-10">
                                <input class="form-control @error('price') is-invalid @enderror" type="text"
                                    placeholder="Enter price" name="price" value="{{ old('price') }}">
                                @error('price')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- specifications --}}
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">Specifications</label>
                            <div class="col-md-10">
                                <textarea id="description1" class="form-control @error('specifications') is-invalid @enderror" name="specifications"
                                    placeholder="Enter specifications" id="exampleFormControlTextarea1" rows="3">{{ old('specifications') }}</textarea>
                                @error('specifications')
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
                                    <option value="" {{ old('category_id') == '' ? 'selected' : '' }}>Default select
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
                        {{-- sub_category_id --}}
                        <div class="mb-3 row">
                            <label for="html5-search-input" class="col-md-2 col-form-label">Sub Category</label>
                            <div class="col-md-10">

                                <select id="defaultSelect" name="sub_category_id"
                                    class="form-select @error('sub_category_id') is-invalid @enderror">
                                    <option value="" {{ old('sub_category_id') == '' ? 'selected' : '' }}>Default
                                        select
                                    </option>
                                    @foreach ($subCategories as $category)
                                        <option value="{{ $category->category_id }},{{ $category->name }}"
                                            {{ old('sub_category_id') == $category->category_id . ',' . $category->name ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sub_category_id')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- quantity_in_stock --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">quantity</label>
                            <div class="col-md-10">
                                <input class="form-control @error('quantity_in_stock') is-invalid @enderror" type="text"
                                    placeholder="Enter quantity" name="quantity_in_stock"
                                    value="{{ old('quantity_in_stock') }}">
                                @error('quantity_in_stock')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- related_products --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Related products</label>
                            <div class="col-md-10">
                                <input class="form-control @error('related_products') is-invalid @enderror" type="text"
                                    placeholder="Enter related products" name="related_products"
                                    value="{{ old('related_products') }}">
                                @error('related_products')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- images --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Images</label>
                            <div class="col-md-10">
                                <input class="form-control @error('images') is-invalid @enderror" type="file" multiple
                                    placeholder="Enter quantity" name="images[]" accept="image/*">
                                @error('images')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- is_featured --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Set featured product</label>
                            <div class="col-md-10">
                                <input class="form-check-input @error('is_featured') is-invalid @enderror" type="checkbox"
                                    name="is_featured" id="is_featured" value="1"
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_featured">
                                    Select as featured product
                                </label>
                                @error('is_featured')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- is_valuable --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Set valuable product</label>
                            <div class="col-md-10">
                                <input class="form-check-input @error('is_valuable') is-invalid @enderror"
                                    type="checkbox" name="is_valuable" value="1" id="is_valuable"
                                    {{ old('is_valuable') ? 'checked' : '' }}>
                                <label class="form-check-label ms-2" for="is_valuable">
                                    Select as valuable product
                                </label>
                                @error('is_valuable')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- star_rating --}}
                        <div class="mb-3 row">
                            <label for="star-rating-range" class="col-md-2 col-form-label">Star Rating</label>
                            <div class="col-md-10 d-flex align-items-center">
                                <input class="form-range pe-2" type="range" min="0" max="5" step="0.5"
                                    id="star-rating-range" name="star_rating" value="{{ old('star_rating') ?? 4.5 }}" oninput="this.nextElementSibling.value = this.value">
                                <output class="" for="star-rating-range" id="star-rating-output">{{ old('star_rating') ?? 4.5 }}</output>
                                @error('star_rating')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>



                        {{-- sold_out_items --}}
                        <div class="mb-3 row">
                            <label for="html5-text-input" class="col-md-2 col-form-label">Sold out counter</label>
                            <div class="col-md-10">
                                <input class="form-control @error('sold_out_items') is-invalid @enderror" type="text"
                                    placeholder="Enter Count or anything eg. (1.2k, 1m, 100, etc...)" name="sold_out_items" value="{{ old('sold_out_items') }}">
                                @error('sold_out_items')
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
