@extends('front-end.layout')
@section('title', 'Create new product')
@section('content')


    <div class="bread-crumbs">
        <div class="container">
            <div class="scoll-wrapper-list">
                <ul>
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <span>About us</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <section class="about-us-wrapper">
        <div class="container">
            <div class="about-us-main">
                <div class="row align-items-center">
                    <div class="col-12 col-lg-6 doted-wrapper">
                        <div class="about-image-wrapper">
                            <img src="{{ asset('/assets/front-end/images/about-us/abt_bg.jpg') }}" />
                        </div>

                    </div>
                    <div class="col-12 col-lg-6">
                        <div class="w-100 about-content-wrapper">
                            <h3>Discover Natural Wellness with Ozyarabia</h3>
                            <p>
                                ozyarabia is a curated marketplace that exhibits and sells natural & sustainable
                                products from passionate entrepreneurs across the country. We are your partners in
                                your journey to a cleaner, safer, healthier, and sustainable living.
                                <br> <br>
                                We source wellness products that are truly natural and organic. Most of them you
                                won’t find in the shops. A wide range of essential oils, hair
                                care products, skin care products, and more eco-friendly products.

                                We care about how products are made because we really know you do.
                                <br> <br>
                                We want you to know that you are sourcing the best in health and beauty and
                                environmentally good products.
                            </p>
                            <a href="/products" class="about-us-btn">
                                <span>Find products</span>
                                <span class="arrow"></span>
                            </a>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </section>



    {{-- product section start --}}
    <section class="product-section">
        <div class="container">
            <div class="product-section-wrapper">
                <div class="product-section-heading">
                    <h4 class="title-heading font-second">Latest products</h4>
                    <a href="/products" class="explore-link">
                        <span>Explore products</span>
                        <span class="arrow"></span>
                    </a>
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



    {{-- servers section start --}}

    <section class="service-section">
        <div class="container">
            <div class="service-section-wrapper">
                <div class="product-section-heading">
                    <h4 class="title-heading font-second">Latest Services</h4>
                    <a href="/services" class="explore-link">
                        <span>Explore Services</span>
                        <span class="arrow"></span>
                    </a>
                </div>
            </div>
            <div class="service-section-list-wrapper row">
                @if (count($services) > 0)
                    @foreach ($services as $service)
                        <div class="service-section-list-item col-12 col-sm-6 col-lg-3">

                            <a href="/services/{{ Str::slug(explode(',', $service->category_id)[1]) }}/{{ $service->url }}"
                                class="service-main-wrapper">
                                <div class="service-image-wrapper">
                                    <div class="service-image-inner">
                                        <img src="{{ Storage::url($service->image) }}" alt={{ $service->name }}>
                                    </div>
                                </div>
                                <div class="service-content">
                                    <h4>{{ $service->name }}</h4>
                                    <p>{{ $service->thumb_description }}</p>
                                    <a href="/services/{{ Str::slug(explode(',', $service->category_id)[1]) }}/{{ $service->url }}"
                                        class="explore-link">
                                        <span>Learn more</span>
                                        <span class="arrow-blue"></span>
                                    </a>
                                </div>
                            </a>

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
    </section>
    {{-- servers section end --}}


@endsection
