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
                                            <?php
                                            
                                            // Check if the pattern exists before processing
                                            if (preg_match('/^products\/(.*?)_ozy/', $image, $matches)) {
                                                $extracted = str_replace('-', ' ', $matches[1]);
                                            } else {
                                                $extracted = ''; // Or handle the case when the pattern is not found
                                            }
                                            
                                            ?>
                                            <img src="{{ Storage::url($image) }}" alt="{{ $extracted }}">
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

                    <div class="free-shipping">

                        <p><span class="arrow"></span>Free shipping on all orders</p>
                        <span>Limited-time offer</span>
                    </div>
                    <div class="star-wrapper">



                        <div class="sold-item">
                            {{ $products->sold_out_items === '0' ? '1.3k' : $products->sold_out_items }} Items sold</div>
                        <div class="start-main">
                            <img src="{{ asset('/assets/front-end/images/stars/' . ($products->star_rating === '0.0' ? '4.5.png' : $products->star_rating . '.png')) }}"
                                alt=""> <span
                                class="count-star">{{ $products->star_rating === '0.0' ? '4.5' : $products->star_rating }}</span>
                        </div>
                    </div>
                    <div class="button-wrapper">
                        <button class="product-add-cart-btn" onclick="addToCart('{{ $products->product_code }}')">
                            <span> <img src="{{ asset('/assets/front-end/images/header/cart.svg') }}"
                                    alt=""></span>
                            <span>Add to cart</span>
                        </button>
                        {{-- <a href="" class="whatsap-message">
                            <img src="{{ asset('/assets/front-end/images/products/whatsapp.svg') }}" alt="">
                        </a> --}}
                    </div>

                    <div class="info-main">
                        <p>
                            The price for this item is currently unavailable. You can add it to your cart and inquire about
                            ordering by reaching out to our customer support team.
                        </p>
                    </div>
                    <div class="content-wrapper">
                        {!! $products->description !!}

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
                    <h4 class="title-heading font-second">More products</h4>
                    <a href="/products" class="explore-link">
                        <span>Explore products</span>
                        <span class="arrow"></span>
                    </a>
                </div>
                <div class="product-section-list-wrapper row">
                    @if (count($related) > 0)
                        @foreach ($related as $product)
                            <div class="product-section-list-item col-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="product-wrapper">
                                    <a href="/products/{{ Str::slug(explode(',', $product->category_id)[1]) }}/{{ Str::slug(explode(',', $product->sub_category_id)[1]) }}/{{ $product->url }}"
                                        class="product-links-wrapper">
                                        <div class="product-image-wrapper">

                                            <?php
                                            $extracted = preg_replace('/^products\/(.*?)_ozy.*$/', '$1', explode(', ', $product->images)[0]);
                                            $extracted = str_replace('-', ' ', $extracted);
                                            ?>
                                            <img data-src="{{ Storage::url(explode(', ', $product->images)[0]) }}"
                                                alt="{{ $extracted }}" loading="lazy" class="lazyload lazy-class">
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
