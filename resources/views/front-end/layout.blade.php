<?php use Illuminate\Support\Facades\Request; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $seo->title ?? 'Ozyarabia - Wellness products' }}</title>
    <link rel="preload" as="image" href="{{ asset('/assets/front-end/images/header/ozyarabia-logo.png') }}">
    <meta name="description"
        content="{{ $seo->description ?? 'Trusted spa products & spa equipment suppliers in  Abu Dhabi, UAE. We offer skin care products, massage oils, beauty products and accessories, disposables, spa furniture and more.  Avail Premium quality spa consumables in reasonable prices in the UAE' }}">
    <meta name="keywords"
        content="{{ $seo->keywords ?? 'Spa acessories, Spa products, Spa disposables, Spa cosumables, Spa beauty product suppliers, Cosmetic suppliers, Spa massage oils, Luxury spa products online, Spa equipent suppliers, Leading spa and hotel  suppliers, Spa products online, Essential oil suppliers, Spa and skin care products, Salon and spa equipments in UAE, Beauty supply store in UAE,' }}">
    <link rel="canonical" href="{{ $seo->canonical_url ?? 'https://ozyarabia.com/' }}">
    <meta name="author" content="{{ $seo->author ?? 'Ozyarabia' }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph Tags for Social Sharing -->
    <meta property="og:title" content="{{ $seo->og_title ?? 'Ozyarabia - Wellness products' }}">
    <meta property="og:description" content="{{ $seo->og_description ?? 'Trusted spa products & spa equipment suppliers in  Abu Dhabi, UAE. We offer skin care products, massage oils, beauty products and accessories, disposables, spa furniture and more.  Avail Premium quality spa consumables in reasonable prices in the UAE' }}">
    @if (isset($seo) && property_exists($seo, 'image') && $seo->image)
    <meta property="og:image" content="{{ Request::root() . Storage::url($seo->image) }}">
@endif
    <meta property="og:url" content="{{ $seo->og_url ?? 'https://ozyarabia.com/' }}">
    <meta property="og:locale" content="{{ $seo->locale ?? 'en_GB' }}">
    <meta property="og:site_name" content="{{ $seo->og_site_name ?? 'ozyarabia' }}">
    <meta property="og:type" content="{{ $seo->og_type ?? 'website' }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="{{ asset('/assets/front-end/images/header/fav.png') }}" type="image/png">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Playfair+Display:wght@1,400;1,600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/assets/front-end/css/bootstrap.min.css') }}?v={{ env('CSS_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('/assets/front-end/css/swiper-bundle.min.css') }}?v={{ env('CSS_VERSION') }}">
    <link rel="stylesheet" href="{{ asset('/assets/front-end/css/style.css') }}?v={{ env('CSS_VERSION') }}">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-W2M63JFSME"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-W2M63JFSME');
    </script>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TP7ZBQ3G');</script>
    <!-- End Google Tag Manager -->
</head>

<body>
    <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TP7ZBQ3G"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    {{-- seach canvas --}}
    <div class="search-main">
        <div class="container">
            <div class="search-input">
                <form id="searchFrom">
                    <input type="search" name="search-products" id="search-products" placeholder="Search here...">
                    {{-- <button type="submit">
                        <img src="{{ asset('/assets/front-end/images/header/search.svg') }}" alt="Product searchs"
                            width="20px" height="20px">
                    </button> --}}

                </form>
                <button class="close-search" type=""></button>

            </div>
        </div>
    </div>

    <div class="search-main-items">
        <div class="container">
            <div class="search-input-items">
                <div id="itemsContainer"></div>
            </div>
        </div>
    </div>

    <header class="w-100 relative d-flex align-items-center">
        <div class="container h-100">
            <div class="w-100 d-flex align-items-center h-100">

                <div class="logo-wrapper">
                    <a href="/">
                        <img src="{{ asset('/assets/front-end/images/header/ozyarabia-logo.png') }}" alt=""
                            width="79px" height="48.84px">
                    </a>
                </div>


                <div class="menu-wrapper ms-auto">
                    <ul>
                        <li>
                            <a href="/">Home</a>
                        </li>
                        <li>
                            <a href="/about-us">About Us</a>
                        </li>
                        <li class="have-menu">
                            <a href="/services">Services</a>
                            <div class="menu-child">
                                <ul>

                                    @isset($service_category)
                                        <div>

                                            @foreach ($service_category as $item)
                                                <li><a href="/services/{{ $item->url }}">{{ $item->name }}</a></li>
                                            @endforeach
                                        </div>
                                    @endisset

                                </ul>
                            </div>
                        </li>
                        <li class="have-menu">
                            <a href="/products">Products</a>
                            <div class="menu-child">
                                <ul>

                                    @isset($product_category)
                                        <div>

                                            @foreach ($product_category as $item)
                                                <li><a href="/products/{{ $item->url }}">{{ $item->name }}</a></li>
                                            @endforeach
                                        </div>
                                    @endisset

                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="/contact-us">Contact Us</a>
                        </li>


                        <li>
                            <a href="/gallery" class="gallery-btn">
                                <span>
                                    Gallery
                                </span>
                            </a>
                        </li>
                    </ul>


                </div>
                <div class="search-click">
                    <button class="search-wrapper">
                        <img src="{{ asset('/assets/front-end/images/header/search.svg') }}" alt="Product searchs"
                            width="20px" height="20px">
                    </button>
                </div>
                <div class="cart-icon">
                    <span class="cart-icon-nums inc-num">1</span>
                    <a href="javasript:void(0)">
                        <img src="{{ asset('/assets/front-end/images/header/cart.svg') }}" alt="">
                    </a>
                </div>
                <div class="menu-mob-icon">
                    <button>
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
            </div>
        </div>

    </header>
   
    <main>  @yield('content')</main>
    <footer class="footer-wrapper">

        <div class="footer-inner">
            <div class="container">
                <div class="s">


                    <div class="footer-logo-wrapper">
                        <span>
                            <img src="{{ asset('/assets/front-end/images/header/logo.png') }}" alt="">
                        </span>

                    </div>

                    <div class="footer-link-wrapper">

                        <div class="footer-link-quick">
                            <h3 class="footer-heading font-second">
                                Quick Links
                            </h3>
                            <ul class="common-footer-links">
                                <li>
                                    <a href="/">Home</a>


                                </li>
                                <li>
                                    <a href="/about-us">About us</a>
                                </li>
                                <li>
                                    <a href="/contact-us">Contact us</a>
                                </li>
                                <li>
                                    <a href="/gallery">gallery</a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-link-service">
                            <h3 class="footer-heading font-second">
                                Services and products
                            </h3>
                            <div class="footer-multiple-links">
                                <ul class="common-footer-links">

                                    @isset($service_category)
                                        @foreach ($service_category as $item)
                                            <li class="menu"><a
                                                    href="/services/{{ $item->url }}">{{ $item->name }}</a></li>
                                        @endforeach
                                    @endisset


                                </ul>

                                <ul class="common-footer-links">
                                    @isset($product_category)
                                        @foreach ($product_category as $item)
                                            <li><a href="/products/{{ $item->url }}">{{ $item->name }}</a></li>
                                        @endforeach
                                    @endisset


                                </ul>
                            </div>
                        </div>
                        <div class="footer-link-social">


                            <h3 class="footer-heading font-second">
                                Connact with us
                            </h3>

                            <ul class="common-footer-links">
                                <li>
                                    Address : <a href="https://maps.app.goo.gl/dGpKWTjMmWjPs1K87" target="_blank">
                                        Fahad Marzoq AIRashidi GENERAL TRAD. & CONT.CO.,
                                        Kuwait - Abraq Khaitan -
                                        Street 22 - Block 9 -
                                        Abdulaziz Ahamad Al-Qadah
                                        - Off. 13 - Mezzanine



                                </li>
                                <li>
                                    </a>

                                    Mobile : <a href="tel:+965 6045 9575" target="_blank">
                                        +965 6045 9575
                                    </a>
                                </li>
                                <li>
                                    </a>

                                    Email : <a href="mailto:info@ozyarabia.com" target="_blank">
                                        info@ozyarabia.com
                                    </a>
                                </li>
                            </ul>




                            <ul class="footer-social-media-links">
                                <li>
                                    <a href="https://www.facebook.com/ozyarabia.me" target="_blank">
                                        <img src="{{ asset('/assets/front-end/images/footer/facebook.svg') }}"
                                            alt=""></a>
                                </li>
                                <li>
                                    <a href="https://www.instagram.com/ozyarabia.me/" target="_blank">
                                        <img src="{{ asset('/assets/front-end/images/footer/instagram.svg') }}"
                                            alt=""></a>
                                </li>
                            </ul>
                        </div>


                    </div>






                </div>
            </div>
        </div>

        <div class="footer-copyright">
            Copyright © 2024 Ozyarabia All Rights Reserved.
        </div>



    </footer>
    <div class="offset-wrapper">
        <div class="offset-title">
            <h3>Cart <span>(<span class="inc-num"></span>)</span></h3>
            <button class="offset-close"></button>
        </div>

        <div class="offset-items">
            <div class="cart-main"></div>
            <div class="cart-main-empty">
                <div class="no-data-found">
                    <span class="no-found-error-icon"></span>
                    <h3 class="font-second"> Sorry!</h3>
                    <p>Cart is empty</p>
                </div>
            </div>
        </div>


        <div class="offset-checkout">
            <a href="/checkout">
                Checkout</a>
        </div>
    </div>
    <div class="offset-overlay"></div>





    <div class="menu-offset-wrapper">
        <div class="menu-offset-title">
            <h3>Menu</h3>
            <button class="menu-offset-close"></button>
        </div>

        <div class="menu-offset-items">

            <ul>
                <li>
                    <a href="/">Home <span class="arrow"></span></a>
                </li>
                <li>
                    <a href="/about-us">About us <span class="arrow"></span></a>
                </li>
                <li>
                    <a href="/services">Services <span class="arrow"></span></a>
                </li>

                @isset($service_category)
                    @foreach ($service_category as $item)
                        <li class="menu"><a href="/services/{{ $item->url }}">{{ $item->name }} <span
                                    class="arrow"></span></a></li>
                    @endforeach
                @endisset

                <li>
                    <a href="/products">Products <span class="arrow"></span></a>
                </li>

                @isset($product_category)
                    @foreach ($product_category as $item)
                        <li class="menu"><a href="/products/{{ $item->url }}">{{ $item->name }} <span
                                    class="arrow"></span></a></li>
                    @endforeach
                @endisset

                <li>
                    <a href="/gallery">Gallery <span class="arrow"></span></a>
                </li>

                <li>
                    <a href="/contact-us">Contact us <span class="arrow"></span></a>
                </li>
            </ul>

        </div>



    </div>
    <div class="menu-offset-overlay"></div>



    <div class="social-media-icons">
        <ul>
            <li>
                {{-- whatsapp --}}
                <a href="https://wa.me/+96560459575" target="_blank">
                    <img src="{{ asset('/assets/front-end/images/social-links/whatsapp.svg') }}" />
                </a>
            </li>
            <li>
                {{-- instagram --}}
                <a href="https://www.instagram.com/ozyarabia.me/" target="_blank">
                    <img src="{{ asset('/assets/front-end/images/social-links/instagram.svg') }}" />
                </a>
            </li>
            <li>
                {{-- call --}}
                <a href="tel:+965 6045 9575" target="_blank">
                    <img src="{{ asset('/assets/front-end/images/social-links/calling.svg') }}" />
                </a>
            </li>
            <li>
                <a href="https://www.facebook.com/ozyarabia.me" target="_blank">
                    <img src="{{ asset('/assets/front-end/images/social-links/facebook.svg') }}" />
                </a>
            </li>
        </ul>
    </div>












</body>



<script src="{{ asset('/assets/front-end/js/swiper-bundle.min.js') }}?v={{ env('CSS_VERSION') }}"></script>
<script src="{{ asset('/assets/front-end/js/main.js') }}?v={{ env('CSS_VERSION') }}"></script>
<script src="{{ asset('/assets/front-end/js/lazysizes.min.js') }}?v={{ env('CSS_VERSION') }}"></script>
<script>
    var main_token = '{{ csrf_token() }}';
</script>

</html>
