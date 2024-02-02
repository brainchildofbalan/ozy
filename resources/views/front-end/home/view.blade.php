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
                    <div class="banner-image"></div>
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









    {{-- product section start --}}
    <section class="product-section">
        <div class="container">
            <div class="product-section-wrapper">
                <div class="product-section-heading">
                    <h4 class="title-heading font-second">Trending Products</h4>
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


                                            <img src="{{ Storage::url(explode(', ', $product->images)[0]) }}"
                                                alt="">
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
                    <h4 class="title-heading font-second">Our Best Services</h4>
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
                                        <img src="{{ Storage::url($service->image) }}" alt="">
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




    {{-- happy customers start --}}
    <section class="happy-customers">
        <div class="container">
            <div class="happy-customers-main">

                <div class="product-section-heading">
                    <h4 class="title-heading font-second center">Happy customers</h4>

                </div>

                <div class="happy-customers-slider-inner">
                    <div class="happy-customers-slider-items">


                        <div class="happy-customers-item">
                            <div class="happy-customers-star">
                                <div class="happy-customers-star-wrapper">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="happy-customers-content">
                                <p class="happy-customers-description">Incorporating yoga into your routine contributes to
                                    both physical and mental health, promoting a balanced and healthier.</p>
                                <h5 class="happy-customers-name font-second">Lora Minsa</h5>
                                <span class="happy-customers-position">Teacher</span>
                            </div>
                        </div>


                        <div class="happy-customers-item">
                            <div class="happy-customers-star">
                                <div class="happy-customers-star-wrapper">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="happy-customers-content">
                                <p class="happy-customers-description">Incorporating yoga into your routine contributes to
                                    both physical and mental health, promoting a balanced and healthier.</p>
                                <h5 class="happy-customers-name font-second">Lora Minsa</h5>
                                <span class="happy-customers-position">Teacher</span>
                            </div>
                        </div>


                        <div class="happy-customers-item">
                            <div class="happy-customers-star">
                                <div class="happy-customers-star-wrapper">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="happy-customers-content">
                                <p class="happy-customers-description">Incorporating yoga into your routine contributes to
                                    both physical and mental health, promoting a balanced and healthier.</p>
                                <h5 class="happy-customers-name font-second">Lora Minsa</h5>
                                <span class="happy-customers-position">Teacher</span>
                            </div>
                        </div>


                        <div class="happy-customers-item">
                            <div class="happy-customers-star">
                                <div class="happy-customers-star-wrapper">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="happy-customers-content">
                                <p class="happy-customers-description">Incorporating yoga into your routine contributes to
                                    both physical and mental health, promoting a balanced and healthier.</p>
                                <h5 class="happy-customers-name font-second">Lora Minsa</h5>
                                <span class="happy-customers-position">Teacher</span>
                            </div>
                        </div>

                        <div class="happy-customers-item">
                            <div class="happy-customers-star">
                                <div class="happy-customers-star-wrapper">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                    <img src="{{ asset('/assets/front-end/images/customers/01-star.svg') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="happy-customers-content">
                                <p class="happy-customers-description">Incorporating yoga into your routine contributes to
                                    both physical and mental health, promoting a balanced and healthier.</p>
                                <h5 class="happy-customers-name font-second">Lora Minsa</h5>
                                <span class="happy-customers-position">Teacher</span>
                            </div>
                        </div>



                    </div>
                </div>


            </div>
        </div>
    </section>
    {{-- happy customers end --}}




    {{-- product section start --}}
    <section class="product-section">
        <div class="container">
            <div class="product-section-wrapper">
                <div class="product-section-heading">
                    <h4 class="title-heading font-second">Best Value</h4>
                    <a href="/products" class="explore-link">
                        <span>Explore products</span>
                        <span class="arrow"></span>
                    </a>
                </div>
                <div class="product-section-list-wrapper row">
                    @if (count($productsValue) > 0)
                        @foreach ($productsValue as $product)
                            <div class="product-section-list-item col-6 col-sm-4 col-md-3 col-lg-2">
                                <div class="product-wrapper">
                                    <a href="/products/{{ Str::slug(explode(',', $product->category_id)[1]) }}/{{ Str::slug(explode(',', $product->sub_category_id)[1]) }}/{{ $product->url }}"
                                        class="product-links-wrapper">
                                        <div class="product-image-wrapper">


                                            <img src="{{ Storage::url(explode(', ', $product->images)[0]) }}"
                                                alt="">
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
