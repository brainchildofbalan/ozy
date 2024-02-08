@extends('front-end.layout')
@section('title', 'Create new product')
@section('content')

    <section class="banner-section">
        <div class="container">
            <div class="banner-main">


                @foreach ($categoriesMain as $category)
                    <div class="banner-item">
                        <div class="banner-image">
                            <img src="{{ Storage::url($category->image) }}" alt="">
                        </div>
                        <div class="banner-text font-second"> {{ $category->title }}</div>
                        {{-- url --}}
                        <a href="/{{ $category->belongs_to }}/{{ $category->url }}" class="banner-link">
                            <span class="arrow banner-arrow-icon"></span>
                            {{ $category->title }}
                        </a>
                    </div>
                @endforeach
                <div class="banner-item">
                    <div class="banner-image">
                        <img src="{{ asset('/assets/front-end/images/gallery/gallery.jpg') }}" alt="">
                    </div>
                    <div class="banner-text font-second"> Gallery</div>
                    {{-- url --}}
                    <a href="/gallery" class="banner-link">
                        <span class="arrow banner-arrow-icon"></span>
                        Gallery
                    </a>
                </div>

            </div>
        </div>
    </section>




    {{-- cartegory list start --}}
    @if ($url)
        <section class="category-wrapper">
            <div class="container">
                <div class="category-wrapper-main">
                    {{-- active --}}
                    <div class="category-item">
                        <a href="/products/{{ $url }}"
                            class="category-item-link @if ($sub_url === null) active @endif">
                            <img src="{{ asset('/assets/front-end/images/products/image-product.jpg') }}" alt="">
                            <p> All </p>
                        </a>
                    </div>
                    @foreach ($categories as $category)
                        <div class="category-item">
                            <a href="/products/{{ $url }}/{{ $category->url }}"
                                class="category-item-link @if ($sub_url === $category->url) active @endif">
                                <img src="{{ asset('/assets/front-end/images/products/image-product.jpg') }}"
                                    alt="">
                                <p>{{ $category->name }}</p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    {{-- cartegory list end --}}








    {{-- product section start --}}
    <section class="product-section">
        <div class="container">
            <div class="product-section-wrapper">
                <div class="product-section-heading">
                    <h4 class="title-heading font-second">All products</h4>
                    {{-- <a href="/" class="explore-link">
                        <span>Explore products</span>
                        <span class="arrow"></span>
                    </a> --}}
                </div>
                <div class="product-section-list-wrapper row">
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <div class="product-section-list-item col-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="product-wrapper">
                                    <a href="/products/{{ Str::slug(explode(',', $product->category_id)[1]) }}/{{ Str::slug(explode(',', $product->sub_category_id)[1]) }}/{{ $product->url }}"
                                        class="product-links-wrapper">
                                        <div class="product-image-wrapper">


                                            <img data-src="{{ Storage::url(explode(', ', $product->images)[0]) }}"
                                                alt="{{ $product->name }}" loading="lazy" class="lazyload lazy-class">
                                        </div>
                                        <div class="product-text-wrapper">
                                            <span class="item-left">{{ intval($product->quantity_in_stock) }} Left</span>
                                            <p>{{ $product->name }}</p>
                                        </div>
                                    </a>

                                    <div class="product-link-wrapper">
                                        <button class="product-add-cart-btn"
                                            onclick="addToCart('{{ $product->product_code }}')">
                                            <span> <img src="{{ asset('/assets/front-end/images/header/cart.svg') }}"
                                                    alt=""></span>
                                            <span>Add to cart</span>
                                        </button>
                                        {{-- <a href="" class="whatsap-message">
                                            <img src="{{ asset('/assets/front-end/images/products/whatsapp.svg') }}"
                                                alt="">
                                        </a> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="no-data-found">
                            <span class="no-found-error-icon"></span>
                            <h3 class="font-second"> Sorry!</h3>
                            <p>No data found</p>
                        </div>


                    @endif


                </div>
            </div>

        </div>
    </section>
    {{-- product section end --}}





@endsection
