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
    {{-- @if ($url)
        <section class="category-wrapper">
            <div class="container">
                <div class="category-wrapper-main">
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
    @endif --}}
    {{-- cartegory list end --}}








    {{-- product section start --}}
    <section class="service-section">
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
                                        <a href="/" class="explore-link">
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

        </div>
    </section>
    {{-- product section end --}}





@endsection
