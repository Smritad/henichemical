<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ===== Google Tag Manager (MUST load early, bypass Rocket Loader) ===== -->
    <script data-cfasync="false">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-K7VTQ42X');</script>
    <!-- ===== End Google Tag Manager ===== -->

    <!-- Google tag (gtag.js) — shared init for Google Ads + GA4 -->
    <script data-cfasync="false" async src="https://www.googletagmanager.com/gtag/js?id=AW-17846379241"></script>
    <script data-cfasync="false">
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'AW-17846379241'); // Google Ads
        gtag('config', 'G-0L4BGSNB3C');   // GA4
    </script>
    <!-- GA4 library (config handled above) -->
    <script data-cfasync="false" async src="https://www.googletagmanager.com/gtag/js?id=G-0L4BGSNB3C"></script>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Google Search Console -->
    <meta name="google-site-verification" content="sQ7uvRmgeL7PoNJPLrCqF9vqYeDmtO-HOcyyjWf5_5Y">

    <!-- SEO -->
    <title>@yield('meta_title', 'HENI Chemicals | Global Supplier of Specialty & Industrial Chemicals')</title>
    <meta name="description" content="@yield('meta_description', 'Manufacturer & exporter of APIs, esters, excipients, and specialty chemicals. Serving USA, UK, Europe, Middle East & Asia.')">
    <meta name="robots" content="@yield('meta_robots', 'index, follow')">
    <link rel="canonical" href="{{ rtrim(url()->current(), '/') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', 'HENI Chemicals | Global Supplier of Specialty & Industrial Chemicals')">
    <meta property="og:description" content="@yield('og_description', 'Manufacturer & exporter of APIs, esters, excipients, and specialty chemicals.')">
    <meta property="og:image" content="@yield('og_image', asset('public/assets/images/default-og.jpg'))">
    <meta property="og:url" content="@yield('og_url', url()->current())">
    <meta property="og:type" content="@yield('og_type', 'website')">

    <!-- Hreflang -->
    <link rel="alternate" hreflang="en-IN" href="@yield('hreflang_in', url()->current())">
    <link rel="alternate" hreflang="x-default" href="@yield('hreflang_default', url()->current())">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/frontend/img/logo/fav.webp') }}">

    <!-- ===== Resource hints: warm up third-party connections early ===== -->
    <link rel="preconnect" href="https://maxcdn.bootstrapcdn.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com" crossorigin>
    <link rel="preconnect" href="https://ajax.googleapis.com" crossorigin>
    <link rel="preconnect" href="https://www.googletagmanager.com">
    <link rel="dns-prefetch" href="https://cdn.jsdelivr.net">
    <link rel="dns-prefetch" href="https://unpkg.com">
    <link rel="dns-prefetch" href="https://snap.licdn.com">

    <!-- ===== Stylesheets ===== -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/css/swiper.min.css">

    <link rel="stylesheet" href="{{ asset('public/frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/media.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/effect.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/hover.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/application-slider.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/frontend/css/owl.theme.default.min.css') }}">

    <!-- AOS + reCAPTCHA (safe to defer) -->
    <script data-cfasync="false" defer src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <script data-cfasync="false" async defer src="https://www.google.com/recaptcha/api.js"></script>
    <script type="text/javascript">
_linkedin_partner_id = "10299281";
window._linkedin_data_partner_ids = window._linkedin_data_partner_ids || [];
window._linkedin_data_partner_ids.push(_linkedin_partner_id);
</script><script type="text/javascript">
(function(l) {
if (!l){window.lintrk = function(a,b){window.lintrk.q.push([a,b])};
window.lintrk.q=[]}
var s = document.getElementsByTagName("script")[0];
var b = document.createElement("script");
b.type = "text/javascript";b.async = true;
b.src = "https://snap.licdn.com/li.lms-analytics/insight.min.js";
s.parentNode.insertBefore(b, s);})(window.lintrk);
</script>
<noscript>
<img height="1" width="1" style="display:none;" alt="" src="https://px.ads.linkedin.com/collect/?pid=10299281&fmt=gif" />
</noscript>
</head>
<body>
    <!-- ===== Google Tag Manager (noscript) ===== -->
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-K7VTQ42X"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
    </noscript>
    <!-- ===== End Google Tag Manager (noscript) ===== -->

    <header>
        @php
            $fetch_basic_details = DB::table('basic_details')->where('id', '=', '1')->first();
        @endphp

        <section class="main_menu">
            <div class="container">
                <div class="row v-center">
                    <div class="header-item item-left">
                        <div class="logo">
                            <a href="{{ route('/') }}">
                                <img src="{{ asset('public/frontend/img/logo/heni-logo.webp') }}" alt="henichemicals logo" loading="lazy">
                            </a>
                        </div>
                    </div>

                    <div class="header-item item-center">
                        <div class="menu-overlay"></div>
                        <nav class="menu">
                            <div class="mobile-menu-head">
                                <div class="go-back"><i class="fa fa-angle-left"></i></div>
                                <div class="current-menu-title"></div>
                                <div class="mobile-menu-close">&times;</div>
                            </div>
                            <ul class="menu-main">
                                <li><a href="{{ route('/') }}">Home</a></li>
                                <li><a href="{{ route('about_us') }}">About Us</a></li>
                                <li class="menu-item-has-children">
                                    <a href="javascript:void(0);">Brands &amp; Products <i class="fa fa-angle-down"></i></a>
                                    <div class="sub-menu mega-menu row mega-menu-column-4 scrollbar" id="style-3">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-md-4 list-item">
                                                        <h3>Product by Brands</h3>
                                                        <ul class="brands-list">
                                                            @php
                                                                $list_product_brands = DB::table('brands_and_products')
                                                                    ->where('status', '=', '1')
                                                                    ->get();

                                                                // Custom URL overrides for specific brands (keyed by brand_slug)
                                                                $brand_url_overrides = [
                                                                    'zonpmea' => 'https://henichemicals.com/cosmeceuticals/palmitoylethanolamide-pea',
                                                                    'zonpea'  => 'https://henichemicals.com/food-nutraceuticals-chemicals/palmitoylethanolamide-pea',
                                                                ];
                                                            @endphp
                                                            @foreach($list_product_brands as $brand)
                                                                <li>
                                                                    <a href="{{ $brand_url_overrides[$brand->brand_slug] ?? route('products_by_brands', ['slug' => $brand->brand_slug]) }}">
                                                                        {{ $brand->brand_name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                            {{-- Static Brand: ZONOea --}}
                                                            <li>
                                                                <a href="https://henichemicals.com/food-nutraceuticals-chemicals/oleane">
                                                                    <img src="{{ asset('public/assets/images/products/oleane-logo-new.png') }}"
                                                                        alt="ZONOea"
                                                                        style="width:90px; height:auto; margin-right:5px;"
                                                                        loading="lazy"></a>
                                                            </li>
                                                            {{-- Static Brand: Aqueaux --}}
                                                            <li>
                                                                <a href="https://henichemicals.com/food-nutraceuticals-chemicals/aqueaux">
                                                                    <img src="{{ asset('public/assets/images/products/4LgF4fXIaSRXt9vWV9aa.png') }}"
                                                                        alt="Aqueaux"
                                                                        style="width:95px; height:auto; margin-right:5px;"
                                                                        loading="lazy">
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-8 list-item">
                                                        <h3>Product by Applications</h3>
                                                        <ul>
                                                            @php
                                                                $list_product_applications = DB::table('brands_and_products')
                                                                    ->where('status', '1')
                                                                    ->select('application_name', 'application_slug')
                                                                    ->distinct()
                                                                    ->get();
                                                            @endphp

                                                            @foreach($list_product_applications as $item)
                                                                <li>
                                                                    <a href="{{ route('products_by_applications', ['slug' => $item->application_slug]) }}">
                                                                        {{ $item->application_name }}
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6 list-item">
                                                <h3>Product by Alphabetical Listing</h3>
                                                <div class="row">
                                                    @php
                                                        $list_products = DB::table('products')
                                                            ->leftJoin('products_listing', 'products.slug', '=', 'products_listing.slug')
                                                            ->select(
                                                                'products.product_name',
                                                                DB::raw('MAX(products.id) as id'),
                                                                DB::raw('MAX(products.slug) as slug'),
                                                                DB::raw('MAX(products.brand_id) as brand_id')
                                                            )
                                                            ->where('products.status', 1)
                                                            ->where(function ($q) {
                                                                $q->where('products_listing.status', 1)
                                                                  ->orWhereNull('products_listing.status');
                                                            })
                                                            ->orderBy('products.product_name')
                                                            ->groupBy('products.product_name')
                                                            ->get();

                                                        $brand_slugs = DB::table('brands_and_products')
                                                            ->pluck('application_slug', 'id')
                                                            ->toArray();

                                                        $column_size = ceil(count($list_products) / 3);
                                                    @endphp

                                                    @for($i = 0; $i < 3; $i++)
                                                        <div class="list-item col-md-4">
                                                            <ul class="vertical-alphabetical-list">
                                                                @php $current_alphabet = null; @endphp

                                                                @foreach ($list_products->slice($i * $column_size, $column_size) as $product)
                                                                    @php
                                                                        $first_character = strtoupper(substr($product->product_name, 0, 1));
                                                                        $first_character = ctype_alpha($first_character) ? $first_character : 'A';

                                                                        if ($first_character != $current_alphabet) {
                                                                            $current_alphabet = $first_character;
                                                                            echo "<span>$current_alphabet</span>";
                                                                        }

                                                                        $product_applications = DB::table('products')
                                                                            ->where('product_name', $product->product_name)
                                                                            ->distinct()
                                                                            ->pluck('brand_id');

                                                                        $has_multiple_applications = $product_applications->count() > 1;
                                                                        $brand_slug = $brand_slugs[$product->brand_id] ?? null;
                                                                    @endphp

                                                                    <li>
                                                                        @if ($has_multiple_applications || !$brand_slug)
                                                                            @if ($product->slug)
                                                                                <a href="{{ route('product_application_list', ['slug' => $product->slug]) }}">
                                                                                    {{ $product->product_name }}
                                                                                </a>
                                                                            @else
                                                                                <span>{{ $product->product_name }}</span>
                                                                            @endif
                                                                        @elseif ($brand_slug && $product->slug)
                                                                            <a href="{{ url($brand_slug . '/' . $product->slug) }}">
                                                                                {{ $product->product_name }}
                                                                            </a>
                                                                        @else
                                                                            <span>{{ $product->product_name }}</span>
                                                                        @endif
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="{{ route('brochure') }}">Brochure</a></li>
                                <li><a href="{{ route('careers') }}">Careers</a></li>
                                <li><a href="{{ route('contact_us') }}">Contact Us</a></li>
                            </ul>
                        </nav>
                    </div>

                    <div class="header-item header-right-item item-right">
                        <ul>
                            <li class="search-icon"><a data-toggle="modal" data-target="#search-popup"><i class="fa fa-search"></i> <span>Search</span></a></li>
                            <li class="social-icon"><a href="{{ $fetch_basic_details->linkedin_link }}"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                        <div class="mobile-menu-trigger"><span></span></div>
                    </div>
                </div>
            </div>
        </section>
    </header>

    @yield('content')

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-address">
                        <h5 class="footer-title">Head Office</h5>
                        {!! $fetch_basic_details->head_office_address !!}
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-address">
                        <h5 class="footer-title">Site Location</h5>
                        {!! $fetch_basic_details->site_location !!}
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer-contact">
                        <h5 class="footer-title">Contact Us</h5>
                        <ul class="footer-contact-info">
                            <li><i class="fa fa-phone"></i> <a href="tel:91{{ $fetch_basic_details->mobile_no }}">+91 {{ $fetch_basic_details->mobile_no }}</a></li>
                            <li><i class="fa fa-envelope"></i> <a href="mailto:{{ $fetch_basic_details->email }}">{{ $fetch_basic_details->email }}</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-1 col-xl-1 col-lg-1 col-md-1 col-sm-6 col-xs-12">
                    <div class="footer-link">
                        <h5 class="footer-title">Links</h5>
                        <ul>
                            <li><a href="{{ route('about_us') }}">About Us</a></li>
                            <li><a href="{{ route('products') }}">Products</a></li>
                            <li><a href="{{ route('careers') }}">Careers</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-6 col-xs-12">
                    <div class="footer-social-col">
                        <h5 class="footer-title">Social</h5>
                        <ul class="footer-social">
                            <li><a href="{{ $fetch_basic_details->linkedin_link }}"><i class="fa fa-linkedin"></i></a></li>
                        </ul>
                        <div class="make-india-logo">
                            <img src="https://henichemicals.com/public/assets/images/make-in-india.webp"
                                 class="img-responsive"
                                 width="300" height="200"
                                 style="aspect-ratio: 3 / 2;"
                                 loading="lazy" decoding="async"
                                 alt="Make in India">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row copyright-row">
                <div class="col-md-7">
                    <div class="copyright-text">
                        <p>Copyright &copy; {{ date('Y') }} Heni Chemicals. All rights reserved</p>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="copyright-text copyright-text-right">
                        <p>Designed by <a href="https://matrixbricks.com/" target="_blank" rel="noopener">Matrix Bricks</a></p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Search popup -->
    <div id="search-popup" class="search-popup-modal modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{ route('search') }}" method="POST">
                            @csrf
                            <div class="col-md-12">
                                <div class="input-box">
                                    <i class="fa fa-search"></i>
                                    <input type="text" class="form-control" name="keyword" placeholder="Find your products" required>
                                    <button type="submit" class="button">Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Remaining Applications popup -->
    <div id="remaining-app-popup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="modal-content"></div>
            </div>
        </div>
    </div>

    <a id="button"></a>

    <!-- ===== jQuery FIRST (required by plugins below) ===== -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.5.0/js/swiper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper-animation@1/build/SwiperAnimation.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rellax/1.12.1/rellax.min.js"></script>
    <script src="{{ asset('public/frontend/js/owl.carousel.js') }}"></script>
    <script src="{{ asset('public/frontend/js/wow.min.js') }}"></script>
    <script src="{{ asset('public/frontend/js/menu.js') }}"></script>
    <script src="{{ asset('public/frontend/js/jquery.easeScroll.js') }}"></script>
    <script src="{{ asset('public/frontend/js/custom.js') }}"></script>

    <!-- Rellax init (guarded) -->
    <script>
        if (document.querySelector('.rellax')) {
            var rellax = new Rellax('.rellax');
        }
    </script>

    <!-- Remaining applications popup handler -->
    <script>
    $(document).ready(function () {
        var product_details_route_template = '{{ url("/") }}/__APPLICATION_SLUG__/__SLUG__';

        $('#remaining-app-popup').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var product_id = button.data('product-id');

            $.ajax({
                url: '{{ route("get_product_applications") }}',
                method: 'GET',
                data: { product_id: product_id },
                success: function (response) {
                    var modal_content = $('#modal-content');
                    modal_content.empty();

                    modal_content.append(`
                        <div class="row">
                            <div class="col-md-12">
                                <div class="remaining-app-title">
                                    <h2>Choose your application for<br> <span></span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="row application-popup-row"></div>
                    `);

                    response.forEach(function (application) {
                        var product_url = product_details_route_template
                            .replace('__APPLICATION_SLUG__', application.application_slug)
                            .replace('__SLUG__', application.product_slug);

                        var application_html = `
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="service-block-one">
                                    <div class="inner-box">
                                        <div class="image-box overlay_effect is_show">
                                            <figure class="image overlay_effect_in">
                                                <a href="#" class="product-link" data-url="${product_url}">
                                                    <img src="${application.img_src}" class="matrix3d_1" alt="">
                                                </a>
                                            </figure>
                                            <div class="icon-box">
                                                <img src="${application.icon_img_src}">
                                            </div>
                                        </div>
                                        <div class="lower-content">
                                            <h3>
                                                <a href="#" class="product-link" data-url="${product_url}">
                                                    ${application.application_name}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;

                        modal_content.find('.application-popup-row').append(application_html);
                    });

                    $('.remaining-app-title span').text(response.length > 0 ? response[0].product_name : '');
                }
            });
        });

        $(document).on('click', '.product-link', function (event) {
            event.preventDefault();
            window.location.href = $(this).data('url');
        });
    });
    </script>

    @stack('scripts')
</body>
</html>