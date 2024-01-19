@extends('front-end.layout')
@section('title', 'Create new product')
@section('content')



    <div class="bread-crumbs">
        <div class="container">
            <ul>
                <li>
                    <a href="/">Home</a>
                </li>
                <li>
                    <a href="/products">Products</a>
                </li>
                <li>
                    <a
                        href="/products/{{ Str::slug(explode(',', $products->category_id)[1]) }}">{{ explode(',', $products->category_id)[1] }}</a>
                </li>


                <li>
                    <a
                        href="/products/{{ Str::slug(explode(',', $products->category_id)[1]) }}/{{ Str::slug(explode(',', $products->sub_category_id)[1]) }}">{{ explode(',', $products->sub_category_id)[1] }}</a>
                </li>

                <li>
                    <span>{{ $products->name }}</span>
                </li>
            </ul>
        </div>
    </div>

    {{-- <a href="/products/{{ Str::slug(explode(',', $product->category_id)[1]) }}/{{ Str::slug(explode(',', $product->sub_category_id)[1]) }}/{{ $product->url }}" --}}

    <section class="product-details-wrapper">
        <div class="container">
            <div class="product-details-inner row">
                <div class="product-image-slider col-12 col-lg-5">

                    <div class="slider-inner">


                        <!-- Slider main container -->
                        <div class="swiper">
                            <!-- Additional required wrapper -->
                            <div class="swiper-wrapper">
                                <!-- Slides -->
                                @foreach (explode(', ', $products->images) as $image)
                                    <div class="swiper-slide">
                                        <div class="image-wrapper-slider">
                                            <img src="{{ Storage::url($image) }}" alt="">
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <!-- If we need pagination -->
                            <div class="swiper-pagination"></div>

                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>

                            <!-- If we need scrollbar -->
                            {{-- <div class="swiper-scrollbar"></div> --}}
                        </div>

                    </div>

                </div>
                <div class="product-content-and-action-wrapper col-12 col-lg-7">

                    <h3 class="title-wrapper">
                        {{ $products->name }}
                    </h3>
                    <div class="button-wrapper">
                        <button class="product-add-cart-btn" onclick="addToCart('{{ $products->product_code }}')">
                            <span> <img src="{{ asset('/assets/front-end/images/header/cart.svg') }}" alt=""></span>
                            <span>Add to cart</span>
                        </button>
                        <a href="" class="whatsap-message">
                            <img src="{{ asset('/assets/front-end/images/products/whatsapp.svg') }}" alt="">
                        </a>
                    </div>

                    <div class="info-main">
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo maxime odio quis eos optio
                            exercitationem
                        </p>
                    </div>
                    <div class="content-wrapper">
                        {!! $products->description !!}

                    </div>
                </div>
            </div>
        </div>
    </section>





@endsection
