@extends('layouts.app')
@section('meta_title', $metaData['title'])
@section('meta_description', $metaData['description'])
@section('meta_robots', $metaData['robots'] ?? 'index, follow')
@section('canonical_url', $metaData['canonical_url'] ?? url()->current())

@section('og_title', $metaData['og_title'] ?? $metaData['title'])
@section('og_description', $metaData['og_description'] ?? $metaData['description'])
@section('og_image', $metaData['og_image'] ?? asset('public/assets/images/default-og.jpg'))
@section('og_url', url()->current())

@section('hreflang_in', $metaData['hreflang_in'] ?? url()->current())
@section('hreflang_default', $metaData['hreflang_default'] ?? url()->current())

@section('content')

@php
    $productName     = $brand_products->product_name ?? '';
    $productNameLower = strtolower(trim($productName));

    // Breadcrumb data from brands_and_products
    $breadcrumb_application_slug = $fetch_brands_and_products_details->first()->application_slug ?? '';
    $breadcrumb_application_name = $fetch_brands_and_products_details->first()->application_name ?? '';
    $breadcrumb_product_name     = $fetch_product_details->first()->product_name ?? $productName;

    // Industry display — from breadcrumb application_name or formatted from slug
    $industry_display = !empty($breadcrumb_application_name)
        ? $breadcrumb_application_name
        : ucwords(str_replace('-', ' ', $breadcrumb_application_slug));
@endphp


{{-- ================================================================
     PAGE STYLES
     ================================================================ --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
<style>
.brand-display {
    background-color: #28a745;
    color: #fff;
    font-size: 28px;
    font-weight: 700;
    border-radius: 8px;
}
.product-enqury {
    text-align: center;
    margin-top: 15px;
}
.mobile-wrapper {
    margin-bottom: 20px;
}
.error-text {
    color: red;
    font-size: 12px;
    display: block;
    margin-top: 5px;
    min-height: 16px;
}
input.invalid {
    border: 1px solid red;
}

/* intl-tel-input — make the flag input fill the column */
.iti { width: 100%; }
/* Keep the country dropdown above the Bootstrap modal (modal z-index ~1050) */
.iti__country-list { z-index: 1100; }

.product-enqury .button {
    padding: 11px 30px;
    border: none;
    border-radius: 30px;
    text-transform: uppercase;
    cursor: pointer;
    color: #000;
    transition: all 1000ms;
    font-size: 15px;
    position: relative;
    overflow: hidden;
    outline: 2px solid var(--color-two);
    width: max-content;
    font-family: 'productsans-bold';
    display: inline-block;
}
.loader {
    border: 4px solid #f3f3f3;
    border-radius: 50%;
    border-top: 4px solid #3498db;
    width: 20px;
    height: 20px;
    animation: spin 2s linear infinite;
    display: inline-block;
    margin-left: 5px;
}
@keyframes spin {
    0%   { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

{{-- ================================================================
     BANNER / BREADCRUMB
     ================================================================ --}}
<section class="product-banner-wrap">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="row">
            <div class="col-md-12">
                <div class="product-breadcrum-content">
                    <ul>
                        <li><a href="{{ url('/') }}">Home</a></li>
                        <li>Brands &amp; Products</li>

                        {{-- Industry name from breadcrumb (specialty-and-fine-chemicals → Specialty and Fine Chemicals) --}}
                        @if(!empty($breadcrumb_application_slug))
                        <li>
                            <a href="{{ route('products_by_applications', ['slug' => $breadcrumb_application_slug]) }}">
                                {{ $industry_display }}
                            </a>
                        </li>
                        @endif

                        {{-- Product name --}}
                        <li>{{ $breadcrumb_product_name }}</li>
                    </ul>
                </div>
            </div>
        </div>

      {{-- Product Heading --}}
<div class="product-heading-box">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">

            <div class="product-heading text-center">

                @if($productNameLower === 'aqueaux')

                    <img src="{{ asset('public/assets/images/products/4LgF4fXIaSRXt9vWV9aa.png') }}"
                         alt="Aqueaux"
                         style="width:200px; height:100px; display:block; margin:0 auto;">

                @elseif($productNameLower === 'oleane')

                    <img src="{{ asset('public/assets/images/products/Oleane-Logo.png') }}"
                         alt="ZONOea"
                         style="width:200px; height:150px; display:block; margin:0 auto;">

                @else

                    {{-- Default product image --}}
                    @if(!empty($brand_products->product_image))
                        
                    @endif

                    <h1>{{ $brand_products->product_name }}</h1>
                    <h2>{{ $brand_products->product_title }}</h2>

                @endif


                {{-- Enquiry Button (always visible) --}}
                <div class="product-enqury">
                    <a href="#"
                       class="button"
                       data-toggle="modal"
                       data-target="#product_enquiry_modal"
                       onclick="set_product_enquiry_id('{{ $fetch_product_details->first()->id }}')">
                        Enquiry Now
                    </a>
                </div>

            </div>

        </div>
    </div>
</div>

    </div>
</section>

{{-- ================================================================
     PRODUCT CONTENT — Two layouts based on product_heading presence
     ================================================================ --}}

@if(!empty($brand_products->product_heading) || !empty($brand_products->product_info_heading_2_1))

    {{-- ── Layout A: OEA / Aqueaux style ── --}}

    @if(!empty($brand_products->product_heading))
    <section class="products-details-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="products_page_text wow fadeInRight animated oea-page-text"
                         data-wow-delay="700ms" data-wow-duration="700ms">
                        <div class="page-title oea-page-title" data-aos="flip-left">
                            <h2>{{ $brand_products->product_heading }}</h2>
                        </div>
                        <p>{{ $brand_products->product_info_desc }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->product_info_heading_2_1))
    <section class="safety-wrap oea-safety-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-title page-title-two oea-safety-title-sec">
                        <h2>{{ $brand_products->product_info_heading_2_1 }}</h2>
                        <p>{{ $brand_products->product_info_title_2_1 }}</p>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-xs-12">
                    <div class="safety-img text-right aqueaux-two-img-sec">
                        <img src="{{ asset('public/assets/images/products/info/' . $brand_products->product_info_image_2_1) }}"
                             alt="{{ $brand_products->product_name }}"
                             class="img-responsive">
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-xs-12">
                    <div class="safty-info">
                        <ul class="listing ck-content">
                            <p>{!! $brand_products->product_info_description_2_1 !!}</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->why_choose_desc))
    <section class="r-and-d-wrap aqueaux-green-one-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="r-and-d-text wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
                        <ul class="listing ck-content">
                            <p>{!! $brand_products->why_choose_desc !!}</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->applications))
        @php $apps = json_decode($brand_products->applications, true); @endphp
        @if(!empty($apps) && count($apps) > 0)
        <section class="application-wrap">
            <div class="container">
                <div class="page-title page-title-two text-center">
                    <h2>{{ $brand_products->applications_heading }}</h2>
                </div>
                <div class="row">
                    @foreach($apps as $app)
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="service-block-one">
                            <div class="inner-box">
                                <div class="image-box overlay_effect is_show">
                                    <figure class="image overlay_effect_in">
                                        <img src="{{ isset($app['image']) && $app['image']
                                                ? asset('public/assets/images/products/applications/' . $app['image'])
                                                : asset('frontend/img/default.png') }}"
                                             alt="Product application: Chemical solution for industrial use">
                                    </figure>
                                </div>
                                <div class="lower-content">
                                    <h3>{{ $app['title'] ?? '' }}</h3>
                                    <p>{{ $app['description'] ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @endif
    @endif

    @php $applications = json_decode($brand_products->applications_industries, true); @endphp
    @if(!empty($applications) && count($applications) > 0)
    <section class="feature-wrap aqueaux-feature-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="feature-text">
                        <div class="page-title page-title-two text-center">
                            <h2>{{ $brand_products->applications_industries_heading }}</h2>
                        </div>
                    </div>
                </div>
                @foreach($applications as $application)
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="fx-services-details-feature-single">
                        <div class="content ck-content">
                            <h5>{{ $application['title'] ?? '' }}</h5>
                            {!! $application['description'] ?? '' !!}
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->safety_image) || !empty($brand_products->safety_description))
    <section class="why-choose-wrap oea-why-choose-wrap">
        <div class="container">
            <div class="row">
                <div class="why-img oea-why-us-sec col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12"
                     style="background-image: url('{{ $brand_products->safety_image
                         ? asset('public/assets/images/products/safety/' . $brand_products->safety_image)
                         : asset('public/assets/images/default-safety.webp') }}');">
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="why-info">
                        <ul class="listing ck-content">
                            <p>{!! $brand_products->safety_description !!}</p>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->quote_title) || !empty($brand_products->quote_description))
    <section class="r-and-d-wrap oea-innovation-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-10">
                    <div class="r-and-d-text wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
                        <div class="page-title page-title-two">
                            <h2>{{ $brand_products->quote_title }}</h2>
                        </div>
                        <p>{{ $brand_products->quote_description }}</p>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="button-2 looking-new-sec oea-btn-sec">
                        <a href="{{ route('contact_us') }}" class="btn button">
                            <span><i class="fa fa-phone"></i></span> Contact Us
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

@else

    {{-- ── Layout B: Standard product style ── --}}

    @if(!empty($brand_products->product_info_image) || !empty($brand_products->product_info_desc))
    <section class="product-with-img-wrap product-details-new-one-img-wrap">
        <div class="container">
            <div class="row">
                @if(!empty($brand_products->product_info_image))
                <div class="col-xl-6 col-lg-6 col-md-4 col-sm-12">
                    <div class="product-with-img product-detnewone-with-img-wrap">
                        <img src="{{ asset('public/assets/images/products/info/' . $brand_products->product_info_image) }}"
                             class="img-responsive"
                             alt="{{ $brand_products->product_info_image_alt ?? $brand_products->product_name }}">
                    </div>
                </div>
                @endif
                @if(!empty($brand_products->product_info_desc))
                <div class="col-xl-6 col-lg-6 col-md-8 col-sm-12">
                    <div class="product-with-img-text details-new-one-with-img-text-sec">
                        <p>{{ $brand_products->product_info_desc }}</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    <section class="feature-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="feature-text">
                        <div class="page-title page-title-two text-center">
                            <h2>{{ $brand_products->features_heading ?? 'Key Features & Benefits' }}</h2>
                        </div>
                        <p>{{ $brand_products->features_description }}</p>
                    </div>
                </div>

                @foreach(json_decode($brand_products->features) as $feature)
                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                    <div class="fx-services-details-feature-single">
                        <div class="icon">
                            <img src="{{ asset('public/assets/images/products/features/' . $feature->icon) }}"
                                 alt="{{ !empty(trim($feature->icon_alt ?? '')) ? $feature->icon_alt : $feature->title }}">
                        </div>
                        <div class="content">
                            <h5>{{ $feature->title }}</h5>
                            <p>{{ $feature->description }}</p>
                            <div class="reflect-icon">
                                <img src="{{ asset('public/assets/images/products/features/' . $feature->icon) }}"
                                     alt="{{ !empty(trim($feature->icon_alt ?? '')) ? $feature->icon_alt : $feature->title }}">
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @if(!empty($brand_products->applications))
    <section class="application-wrap">
        <div class="container">
            <div class="page-title page-title-two text-center">
                <h2>{{ $brand_products->applications_heading }}</h2>
            </div>
            <div class="row">
                @foreach(json_decode($brand_products->applications, true) as $app)
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="service-block-one">
                        <div class="inner-box">
                            <div class="image-box overlay_effect is_show">
                                <figure class="image overlay_effect_in">
                                    <img src="{{ isset($app['image']) && $app['image']
                                            ? asset('public/assets/images/products/applications/' . $app['image'])
                                            : asset('frontend/img/default.png') }}"
                                         alt="Product application: Industrial chemical solution in use">
                                </figure>
                                <div class="icon-box details-new-one-icon-box">
                                    <img src="https://anvayafoundation.com/henichemicals/public/frontend/img/product/papers.png"
                                         alt="Image showing various paper products">
                                </div>
                            </div>
                            <div class="lower-content">
                                <h3>{{ $app['title'] ?? '' }}</h3>
                                <p>{{ $app['description'] ?? '' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->certification_heading))
    <section class="certification-new-sec">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title page-title-two text-center">
                        <h2>{{ $brand_products->certification_heading }}</h2>
                    </div>
                </div>
                @php
                    $certifications = !empty($brand_products->certifications)
                        ? json_decode($brand_products->certifications, true)
                        : [];
                @endphp
                @if(!empty($certifications) && is_array($certifications))
                    @foreach($certifications as $cert)
                    <div class="col-md-3">
                        <div class="certi-box-sec">
                            <div class="certi-box-img-sec">
                                @if(!empty($cert['image']))
                                <img src="{{ asset('public/assets/images/products/certifications/' . $cert['image']) }}"
                                     alt="{{ $cert['image_alt'] ?? 'Certification' }}"
                                     class="img-fluid">
                                @endif
                            </div>
                            <h4>{{ $cert['title'] ?? '' }}</h4>
                            <p>{{ $cert['description'] ?? '' }}</p>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @endif

    @php
        $specifications = json_decode($brand_products->specifications, true);
        $specs_columns  = json_decode($brand_products->specs_columns ?? '[]', true) ?: ['Parameter', 'Details'];
    @endphp

    @if(!empty($specifications))
    <section class="technical-wrap">
        <div class="container">
            <div class="col-12">
                <div class="page-title text-center page-title-two">
                    <h2>{{ $brand_products->specs_heading }}</h2>
                </div>
                <div class="technical-table">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th>{{ $specs_columns[0] ?? 'Parameter' }}</th>
                                <th>{{ $specs_columns[1] ?? 'Details' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($specifications as $spec)
                            <tr>
                                <td>{{ $spec['parameter'] ?? '' }}</td>
                                <td>{{ $spec['detail'] ?? '' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->spreadsheet_heading) || !empty($brand_products->spreadsheets))
    <section class="products-details-two details-new-one-function-sec">
        <div class="container">
            <div class="row">
                @if(!empty($brand_products->spreadsheet_heading))
                <div class="col-12">
                    <p class="details-new-one-more-info-sec">{{ $brand_products->spreadsheet_heading }}</p>
                </div>
                @endif

                @php
                    $spreadsheets = !empty($brand_products->spreadsheets)
                        ? json_decode($brand_products->spreadsheets, true)
                        : [];
                @endphp

                @if(!empty($spreadsheets))
                    @foreach($spreadsheets as $sheet)
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6">
                        <div class="products-details-box">
                            <div class="pbmit-ihbox-style-7 wow fadeInLeft" data-wow-delay="400ms" data-wow-duration="400ms">
                                <div class="pbmit-ihbox-box">
                                    <div class="pbmit-icon-wrapper">
                                        <h2 class="pbmit-element-title details-new-one-element-title-sec">
                                            {{ $sheet['title'] ?? '' }}
                                        </h2>
                                        <div class="pbmit-ihbox-icon">
                                            <div class="pbmit-ihbox-icon-wrapper">
                                                <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                    <a href="#"
                                                       data-toggle="modal"
                                                       data-target="#product_modal"
                                                       onclick="set_product_modal('{{ $brand_products->id }}', 'Spreadsheet', '{{ $sheet['title'] ?? '' }}')">
                                                        <i class="fa fa-download"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
    @endif

    @if($brand_products->safety_description || $brand_products->safety_image)
    <section class="safety-wrap">
        <div class="container">
            <div class="row align-items-center">
                @if($brand_products->safety_description)
                <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12 d-flex align-items-center">
                    <div class="safety-info w-100 ck-content">
                        <p class="listing">{!! $brand_products->safety_description !!}</p>
                    </div>
                </div>
                @endif
                <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    @php
                        $safetyImage = $brand_products->safety_image
                            ? asset('public/assets/images/products/safety/' . $brand_products->safety_image)
                            : asset('frontend/img/default.png');
                        $safetyAlt = $brand_products->safety_image_alt ?? 'Product safety image';
                    @endphp
                    <div class="safety-img text-right"
                         style="background-image:url('{{ $safetyImage }}');
                                background-size:cover;background-position:center;
                                min-height:300px;border-radius:20px;position:relative;">
                        <img src="{{ $safetyImage }}" alt="{{ $safetyAlt }}"
                             style="opacity:0;width:1px;height:1px;position:absolute;">
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if(!empty($brand_products->why_choose_desc) || !empty($brand_products->why_choose_image))
    <section class="why-choose-wrap">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    @php
                        $whyChooseImage = !empty($brand_products->why_choose_image)
                            ? asset('public/assets/images/products/why_choose/' . $brand_products->why_choose_image)
                            : asset('frontend/img/product/chemical2.webp');
                        $whyChooseAlt = $brand_products->why_choose_image_alt ?? 'Why choose this product';
                    @endphp
                    <div class="why-img1"
                         style="background-image:url('{{ $whyChooseImage }}');
                                background-size:cover;background-position:center;
                                border-radius:40px;min-height:350px;position:relative;">
                        <img src="{{ $whyChooseImage }}" alt="{{ $whyChooseAlt }}"
                             style="opacity:0;width:1px;height:1px;position:absolute;">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12 d-flex align-items-center">
                    <div class="why-info w-100 ck-content">
                        <p class="listing">{!! $brand_products->why_choose_desc !!}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    @if($brand_products->quote_title || $brand_products->quote_description || $brand_products->quote_contact || $brand_products->quote_email)
    <div class="footer-top-banner-section">
        <div class="container">
            <div class="footer-top-banner-wrap">
                <div class="section-title white wow animate fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
                    @if($brand_products->quote_title)
                        <h2>{{ $brand_products->quote_title }}</h2>
                    @endif
                    @if($brand_products->quote_description)
                        <p>{{ $brand_products->quote_description }}</p>
                    @endif
                </div>
                <div class="btn-grp">
                    @if(!empty($brand_products->quote_contact))
                        <b style="color:#fff;">Call Us:</b>
                        <a href="tel:{{ $brand_products->quote_contact }}">{{ $brand_products->quote_contact }}</a>
                    @endif
                    @if(!empty($brand_products->quote_email))
                        <b style="color:#fff;">Email:</b>
                        <a href="mailto:{{ $brand_products->quote_email }}">{{ $brand_products->quote_email }}</a>
                    @endif
                </div>
            </div>
        </div>
        <svg class="arrow-vector" width="147" height="147" viewBox="0 0 147 147" xmlns="http://www.w3.org/2000/svg">
            <g>
                <path d="M0.727728 0H147.001V27.3823L27.6537 147L0 119.617L81.5055 38.9117L0.727728 39.6323V0Z"></path>
                <path d="M147.002 146.999V54.7637L107.705 93.6754V146.999H147.002Z"></path>
            </g>
        </svg>
    </div>
    @endif

    <section class="faqs-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="faq-wrap">
                        <div class="page-title page-title-two text-center">
                            <h4>{{ $brand_products->faqs_heading }}</h4>
                        </div>
                        <div class="faq-1">
                            @php
                                $faqs = !empty($brand_products->faqs)
                                    ? json_decode($brand_products->faqs, true)
                                    : [];
                            @endphp
                            @if(!empty($faqs))
                                @foreach($faqs as $key => $faq)
                                <div class="panel mt-panel">
                                    <div class="acod-head">
                                        <h4 class="acod-title">
                                            <a data-toggle="collapse" href="#faq{{ $key }}">
                                                {{ $faq['question'] }}
                                                <span class="indicator"><i class="fa fa-angle-up"></i></span>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="faq{{ $key }}" class="acod-body collapse ck-content">
                                        <div class="acod-content">
                                            {!! $faq['answer'] !!}
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endif
{{-- ── End content layouts ── --}}


{{-- ================================================================
     MODALS
     ================================================================ --}}

{{-- ── Download Document Modal ── --}}
<div class="modal brochure_popup fade" id="product_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Download Document</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('send_product_document_enquiry') }}" method="POST"
                          class="contact-us-form" id="product_document_form">
                        @csrf
                        <input type="hidden" name="product_id"    id="product_id"    value="">
                        <input type="hidden" name="document_name" id="document_name" value="">
                        <input type="hidden" name="sheet_title"   id="sheet_title"   value="">
                        <input type="hidden" name="brand_name"    id="brand_name"
                               value="{{ ($productNameLower !== 'zonoea') ? ($brand_display ?? $brand_products->brand_name ?? '') : '' }}">

                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email"
                                   placeholder="Email Address*" required>
                        </div>
                        <div class="col-md-6 mobile-wrapper">
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no_2"
                                   placeholder="Mobile No.*"
                                   oninput="validate_mobile_number(this, 'mobile_error_2');"
                                   maxlength="20" required>
                            <small id="mobile_error_2" class="error-text"></small>
                        </div>

                        <div class="col-md-12" id="otp-section" style="display:none;">
                            <input type="text" class="form-control" name="otp" id="otp_input"
                                   placeholder="Enter OTP*" minlength="6" maxlength="6"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                        </div>

                        {{-- reCAPTCHA Widget #1 — explicit render --}}
                        <div class="col-md-12">
                            <div id="recaptcha_doc" class="mB20"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="button-2">
                                <button type="submit" class="button" id="doc_submit_btn">
                                    Submit <span><i class="fa fa-angle-right"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- ── Product Enquiry Modal ── --}}
<div class="modal brochure_popup fade" id="product_enquiry_modal" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Product Enquiry</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <form action="{{ route('send_product_enquiry') }}" method="POST"
                          class="contact-us-form" id="product_enquiry_form">
                        @csrf

                        {{-- Hidden context fields — populated from breadcrumb / page data --}}
                        <input type="hidden" name="product_id"        id="product_enquiry_id"        value="">
                        <input type="hidden" name="application_slug"  id="enquiry_application_slug"  value="{{ $breadcrumb_application_slug }}">
                        <input type="hidden" name="application_name"  id="enquiry_application_name"  value="{{ $industry_display }}">
                        <input type="hidden" name="brand_name"
                               value="{{ ($productNameLower !== 'zonoea') ? ($brand_display ?? $brand_products->brand_name ?? '') : '' }}">
                        <input type="hidden" name="product_name_hidden" value="{{ $brand_products->product_name ?? '' }}">

                        <div class="col-md-12">
                            <input type="text" class="form-control" name="name"
                                   placeholder="Your Name*"
                                   oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')"
                                   required>
                        </div>
                        <div class="col-md-6">
                            <input type="email" class="form-control" name="email"
                                   placeholder="Email Address*"
                                   oninput="validate_email(this);" required>
                        </div>
                        <div class="col-md-6 mobile-wrapper">
                            <input type="text" class="form-control" name="mobile_no" id="mobile_no_3"
                                   placeholder="Mobile No.*"
                                   oninput="validate_mobile_number(this, 'mobile_error_3');"
                                   maxlength="20" required>
                            <small id="mobile_error_3" class="error-text"></small>
                        </div>

                        <div class="col-md-12" id="produt-enquiry-otp-section" style="display:none;">
                            <input type="text" class="form-control" name="otp" id="enquiry_otp_input"
                                   placeholder="Enter OTP*"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                   minlength="6" maxlength="6">
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="user_message"
                                      placeholder="Your Message"></textarea>
                        </div>

                        {{-- reCAPTCHA Widget #2 — explicit render --}}
                        <div class="col-md-12">
                            <div id="recaptcha_enquiry" class="mB20"></div>
                        </div>

                        <div class="col-md-12">
                            <div class="button-2">
                                <button type="submit" class="button" id="enquiry_submit_btn">
                                    Submit <span><i class="fa fa-angle-right"></i></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


{{-- ================================================================
     JAVASCRIPT
     ================================================================ --}}

{{-- intl-tel-input library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
// ── Country-code phone inputs (one instance per mobile field) ────────
var itiInstances = {};

(function () {
    var itiOptions = {
        // Auto-detect the visitor's country by IP; fall back to India
        initialCountry: "auto",
        geoIpLookup: function (callback) {
            fetch("https://ipapi.co/json/")
                .then(function (res) { return res.json(); })
                .then(function (data) {
                    callback(data && data.country_code ? data.country_code : "in");
                })
                .catch(function () { callback("in"); });
        },
        // separateDialCode ON → shows the +91 / +1 / +44 dial code next to the flag
        // (matches the Contact Us page behaviour)
        separateDialCode: true,
        autoPlaceholder: "aggressive",
        preferredCountries: ["in", "us", "gb", "ae"],
        // Append dropdown to <body> so it isn't clipped inside the modal
        dropdownContainer: document.body,
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
    };

    var docMobile = document.querySelector("#mobile_no_2");
    if (docMobile) {
        itiInstances['mobile_no_2'] = window.intlTelInput(docMobile, itiOptions);
    }

    var enqMobile = document.querySelector("#mobile_no_3");
    if (enqMobile) {
        itiInstances['mobile_no_3'] = window.intlTelInput(enqMobile, itiOptions);
    }
})();

// Returns "+91 9087654321" style string for a given mobile input id
function build_mobile_with_code(inputId) {
    var inputEl = document.getElementById(inputId);
    var iti     = itiInstances[inputId];
    var raw     = inputEl ? inputEl.value.trim() : '';
    if (!iti || !raw) return raw;

    var dialCode = iti.getSelectedCountryData().dialCode;            // "1", "91", "44"…
    var e164     = (typeof iti.getNumber === 'function') ? iti.getNumber() : ''; // +19087654321

    var national;
    if (e164 && e164.indexOf('+' + dialCode) === 0) {
        national = e164.substring(dialCode.length + 1);
    } else {
        // Fallback: strip everything but digits, then drop a leading dial code if present
        national = raw.replace(/[^0-9]/g, '');
        if (national.indexOf(dialCode) === 0) {
            national = national.substring(dialCode.length);
        }
    }
    return '+' + dialCode + ' ' + national;
}
</script>

<script>
// ── Utility helpers ──────────────────────────────────────────────────
function set_product_modal(productId, documentName, sheetTitle) {
    document.getElementById('product_id').value    = productId;
    document.getElementById('document_name').value = documentName;
    document.getElementById('sheet_title').value   = sheetTitle;
}
function set_product_enquiry_id(id) {
    document.getElementById('product_enquiry_id').value = id;
}
function set_product_id(id, document_name) {
    document.getElementById('product_id').value    = id;
    document.getElementById('document_name').value = document_name;
}
function redirect_to_product_details(element) {
    window.location.href = element.getAttribute('data-url');
}

// ── reCAPTCHA explicit render ────────────────────────────────────────
// Two separate widget IDs prevent the "always reads widget #1" bug
var recaptchaDocWidgetId     = null;
var recaptchaEnquiryWidgetId = null;

function onRecaptchaLoad() {
    recaptchaDocWidgetId = grecaptcha.render('recaptcha_doc', {
        sitekey: '6LcIXyEqAAAAAHSFTtbyCvsgrhhk2fBSOfI6TvwZ'
    });
    recaptchaEnquiryWidgetId = grecaptcha.render('recaptcha_enquiry', {
        sitekey: '6LcIXyEqAAAAAHSFTtbyCvsgrhhk2fBSOfI6TvwZ'
    });
}
</script>

{{-- Load reCAPTCHA ONCE with explicit render callback --}}
<script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>

{{-- ── Document Download form ─────────────────────────────────────── --}}
<script>
document.getElementById('product_document_form').addEventListener('submit', function(e) {
    e.preventDefault();

    var form       = this;
    var formData   = new FormData(form);

    // ✅ Store mobile number as "+91 9087654321"
    formData.set('mobile_no', build_mobile_with_code('mobile_no_2'));

    var submitBtn  = document.getElementById('doc_submit_btn');
    var otpSection = document.getElementById('otp-section');
    var otpInput   = document.getElementById('otp_input');
    var email      = formData.get('email');

    function show_loader() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Processing...';
    }
    function hide_loader() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Submit <span><i class="fa fa-angle-right"></i></span>';
    }
    function show_doc_error(msg) {
        hide_loader();
        alert(msg);
    }

    // ✅ Validate mobile number via the library
    var docIti = itiInstances['mobile_no_2'];
    if (docIti && typeof docIti.isValidNumber === 'function' && !docIti.isValidNumber()) {
        alert('Please enter a valid mobile number.');
        document.getElementById('mobile_error_2').innerText = 'Enter a valid mobile number';
        return;
    }

    // reCAPTCHA — use widget ID not default getResponse()
    var captcha = grecaptcha.getResponse(recaptchaDocWidgetId);
    if (!captcha || captcha.length === 0) {
        alert('Please verify that you are not a robot.');
        return;
    }

    show_loader();

    // Step 1: Send OTP
    if (otpSection.style.display === 'none' || otpSection.style.display === '') {
        var otpData = new FormData();
        otpData.append('_token', '{{ csrf_token() }}');
        otpData.append('email', email);

        fetch('{{ route("send_otp") }}', {
            method: 'POST',
            body: otpData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            hide_loader();
            if (data.success) {
                otpSection.style.display = 'block';
                otpInput.setAttribute('required', 'required');
                alert('OTP sent to your email. Please check your inbox.');
            } else {
                show_doc_error(data.error || 'Failed to send OTP. Please try again.');
                grecaptcha.reset(recaptchaDocWidgetId);
            }
        })
        .catch(function() {
            show_doc_error('Something went wrong. Please try again.');
            grecaptcha.reset(recaptchaDocWidgetId);
        });
        return;
    }

    // Step 2: Validate OTP
    if (!otpInput.value || otpInput.value.length !== 6) {
        alert('Please enter a valid 6-digit OTP.');
        hide_loader();
        return;
    }

    // Step 3: Submit
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        hide_loader();
        if (data.success) {
            window.location.href = data.download_url;
        } else {
            grecaptcha.reset(recaptchaDocWidgetId);
            show_doc_error(data.message || 'Invalid OTP. Please try again.');
        }
    })
    .catch(function() {
        hide_loader();
        grecaptcha.reset(recaptchaDocWidgetId);
        show_doc_error('Something went wrong. Please try again.');
    });
});
</script>

{{-- ── Product Enquiry form ───────────────────────────────────────── --}}
<script>
document.getElementById('product_enquiry_form').addEventListener('submit', function(e) {
    e.preventDefault();

    var form       = this;
    var formData   = new FormData(form);

    // ✅ Store mobile number as "+91 9087654321"
    formData.set('mobile_no', build_mobile_with_code('mobile_no_3'));

    var submitBtn  = document.getElementById('enquiry_submit_btn');
    var otpSection = document.getElementById('produt-enquiry-otp-section');
    var otpInput   = document.getElementById('enquiry_otp_input');
    var email      = formData.get('email');

    function show_loader() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Processing...';
    }
    function hide_loader() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Submit <span><i class="fa fa-angle-right"></i></span>';
    }

    // Show inline error inside modal — never raw JSON alert
    function show_enquiry_error(msg) {
        hide_loader();
        var old = document.getElementById('enquiry_error_msg');
        if (old) old.remove();
        var div = document.createElement('div');
        div.id = 'enquiry_error_msg';
        div.style.cssText = 'background:#fff3cd;border:1px solid #ffc107;color:#856404;'
            + 'padding:10px 14px;border-radius:6px;margin:10px 15px 0;font-size:14px;';
        div.innerHTML = '&#9888; ' + msg;
        form.insertBefore(div, form.firstChild);
        // Scroll to top of modal body so error is visible
        var modalBody = form.closest('.modal-body');
        if (modalBody) modalBody.scrollTop = 0;
    }

    // Show inline success notice
    function show_otp_notice(msg) {
        var old = document.getElementById('enquiry_otp_notice');
        if (old) old.remove();
        var div = document.createElement('div');
        div.id = 'enquiry_otp_notice';
        div.style.cssText = 'color:#155724;'
            + 'padding:10px 14px;border-radius:6px;margin:10px 15px 0;font-size:14px;';
        div.innerHTML = '&#10003; ' + msg;
        otpSection.parentNode.insertBefore(div, otpSection);
    }

    // ✅ Validate mobile number via the library
    var enqIti = itiInstances['mobile_no_3'];
    if (enqIti && typeof enqIti.isValidNumber === 'function' && !enqIti.isValidNumber()) {
        show_enquiry_error('Please enter a valid mobile number.');
        document.getElementById('mobile_error_3').innerText = 'Enter a valid mobile number';
        return;
    }

    // reCAPTCHA — use explicit widget ID
    var captcha = grecaptcha.getResponse(recaptchaEnquiryWidgetId);
    if (!captcha || captcha.length === 0) {
        show_enquiry_error('Please verify that you are not a robot.');
        return;
    }

    show_loader();

    // Step 1: Send OTP
    if (otpSection.style.display === 'none' || otpSection.style.display === '') {
        var otpData = new FormData();
        otpData.append('_token', '{{ csrf_token() }}');
        otpData.append('email', email);

        fetch('{{ route("send_otp") }}', {
            method: 'POST',
            body: otpData,
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(function(r) { return r.json(); })
        .then(function(data) {
            hide_loader();
            if (data.success) {
                // Remove old error/notice
                var oldErr = document.getElementById('enquiry_error_msg');
                if (oldErr) oldErr.remove();
                // Show OTP field + success notice
                otpSection.style.display = 'block';
                otpInput.setAttribute('required', 'required');
                show_otp_notice('OTP sent to ' + email + '. Please check your inbox.');
            } else {
                grecaptcha.reset(recaptchaEnquiryWidgetId);
                show_enquiry_error(data.error || 'Failed to send OTP. Please try again.');
            }
        })
        .catch(function() {
            grecaptcha.reset(recaptchaEnquiryWidgetId);
            show_enquiry_error('Something went wrong. Please try again.');
        });
        return;
    }

    // Step 2: Validate OTP length
    if (!otpInput.value || otpInput.value.length !== 6) {
        show_enquiry_error('Please enter a valid 6-digit OTP.');
        hide_loader();
        return;
    }

    // Step 3: Submit enquiry
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        hide_loader();
        if (data.success) {
            // Close modal silently then redirect — no alert
            $('#product_enquiry_modal').modal('hide');
            window.location.href = data.redirect_url;
        } else {
            grecaptcha.reset(recaptchaEnquiryWidgetId);
            show_enquiry_error(data.message || 'Something went wrong. Please try again.');
        }
    })
    .catch(function() {
        hide_loader();
        grecaptcha.reset(recaptchaEnquiryWidgetId);
        show_enquiry_error('Something went wrong. Please try again.');
    });
});
</script>

{{-- ── Mobile number validation ───────────────────────────────────── --}}
<script>
function validate_mobile_number(input, errorId) {
    // Allow +, digits and spaces so typing "+1 ..." can auto-detect the country
    var value = input.value.replace(/[^0-9+\s]/g, '');
    if (value !== input.value) { input.value = value; }

    var errorEl    = document.getElementById(errorId);
    var digitCount = value.replace(/[^0-9]/g, '').length;

    if (digitCount === 0) {
        errorEl.innerText = '';
        input.setCustomValidity('');
        input.classList.remove('invalid');
        return;
    }

    // Validate against the selected/detected country via intl-tel-input
    var iti = itiInstances[input.id];
    if (iti && typeof iti.isValidNumber === 'function') {
        if (iti.isValidNumber()) {
            errorEl.innerText = '';
            input.setCustomValidity('');
            input.classList.remove('invalid');
        } else {
            errorEl.innerText = 'Enter a valid mobile number';
            input.setCustomValidity('Invalid');
            input.classList.add('invalid');
        }
    }
}
</script>

@endsection