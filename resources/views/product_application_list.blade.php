@extends('layouts.app')
@section('meta_title', $metaData['title'])
@section('meta_description', $metaData['description'])
@section('meta_robots', $metaData['robots'] ?? 'index, follow')
@section('canonical_url', $metaData['canonical'] ?? url()->current())

@section('og_title', $metaData['og_title'] ?? $metaData['title'])
@section('og_description', $metaData['og_description'] ?? $metaData['description'])
@section('og_image', $metaData['og_image'] ?? asset('public/assets/images/default-og.jpg'))
@section('og_url', url()->current())

@section('hreflang_in', $metaData['hreflang_in'] ?? url()->current())
@section('hreflang_default', $metaData['hreflang_default'] ?? url()->current())


@section('content')

<br>
<br>
<br>
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
<style>
    .breadcrumb {
    padding: 8px 15px;
    margin-bottom: 20px;
    list-style: none;
    border-radius: 4px;
    }
    
    .banner-custom-sec .product-heading {
        background-image: url(https://henichemicals.com/public/assets/images/products/LF7S1CQSZG5iEDbDlFQX.webp);
        background-position: center right;
        background-size: contain;
        background-repeat: no-repeat;
        padding: 90px 0;
    }
</style>
<!-- Simple Breadcrumb -->
<div class="container my-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('/') }}">Home</a></li>
            <li class="breadcrumb-item">Brands & Products</li>
            <li class="breadcrumb-item active" aria-current="page">{{ $product->product_name }}</li>
        </ol>
    </nav>
</div>

<!-- <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/pharma-banner.jpg')}}');">-->
<!--        <div class="container">-->
<!--            <div class="row">-->
<!--                <div class="col-md-12">-->
<!--                    <div class="breadcrum-content">-->
                        <!--<h1>{{ $metaData['h1'] }}</h1>    -->
<!--                        <h1>{{ $product->product_name }}</h1>-->
<!--                        <ul>-->
<!--                            <li><a href="{{route('/')}}">Home</a></li>-->
<!--                            <li>Brands & Products</li>-->
<!--                            <li>{{ $product->product_name }}</li>-->
<!--                        </ul>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </section>-->
<!--<div class="container">-->
<!--    <div class="row">-->
<!--        <div class="col-md-12">-->
<!--            <div class="remaining-app-title">-->
<!--                <h2>Choose your application for<br> <span>{{ $product->product_name }}</span></h2>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->

<!--    <div class="row application-popup-row">-->
<!--        {{-- Debugging Step: Check if $applications is empty or contains invalid data --}}-->
<!--        @if ($applications->isEmpty())-->
<!--            <p>No applications available for this product.</p>-->
<!--        @else-->
<!--            @foreach ($applications as $application)-->
<!--                {{-- Check if $application is not null and has necessary properties --}}-->
<!--                @if ($application && isset($application->application_slug, $application->product_slug))-->
<!--                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">-->
<!--                        <div class="service-block-one">-->
<!--                            <div class="inner-box">-->
<!--                                <div class="image-box overlay_effect is_show">-->
<!--                                    <figure class="image overlay_effect_in">-->
<!--                                        <a href="{{ route('product_details', ['application_slug' => $application->application_slug, 'slug' => $application->product_slug]) }}">-->
<!--                                            <img src="{{ asset('public/assets/images/brands-and-products/' . $application->img_src) }}" class="matrix3d_1" alt="">-->
<!--                                        </a>-->
<!--                                    </figure>-->
<!--                                    <div class="icon-box">-->
<!--                                        <img src="{{ asset('public/assets/images/brands-and-products/' . $application->icon_img_src) }}" alt="">-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                                <div class="lower-content">-->
<!--                                    <h3>-->
<!--                                        <a href="{{ route('product_details', ['application_slug' => $application->application_slug, 'slug' => $application->product_slug]) }}">-->
<!--                                            {{ $application->application_name }}-->
<!--                                        </a>-->
<!--                                    </h3>-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                @else-->
<!--                    {{-- Debugging Step: Output when an invalid $application is found --}}-->
<!--                    <p class="error-message">Invalid application data for: {{ $application ? $application->application_name : 'N/A' }}</p>-->
<!--                @endif-->
<!--            @endforeach-->
<!--        @endif-->
<!--    </div>-->
<!--</div>-->





{{-- Banner Section --}}
<section class="banner-custom-sec">
    <div class="container">
        <div class="product-heading-box">
            <div class="row">
                <div class="col-12">
                    <div class="product-heading">

                        {{-- Brand Name (Top, Green) --}}
                        @if(!empty($productListing->brand_name))
                            
                            </p>
                        @endif

                        {{-- Product Title (Below) --}}
                        <h1>
                            {{ $productListing->product_title ?? $product->product_name }}
                        </h1>
 <div class="product-enqury">
                                <a href="#" class="button"
                                   data-toggle="modal"
                                   data-target="#product_enquiry_modal"
                                   onclick="">
                                    Enquiry Now
                                </a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

    
    
    {{-- About Product --}}
<section class="product-with-img-wrap product-details-new-one-img-wrap">
    <div class="container">
        <div class="">
            <div class="col-xl-12">
                <div class="product-with-img-text details-new-one-with-img-text-sec">
                    <p style="color: rgb(51, 51, 51); font-family: productsans-regular; font-size: 16px; text-align: justify;">{!! $productListing->product_info_desc ?? '' !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
   




@if(!empty($productListing) && !empty($productListing->grades_heading))
<section class="application-wrap details-two-pea-wrap new-green-app-row-sec">
    <div class="container">

        {{-- Section Heading --}}
        <div class="page-title page-title-two text-center">
            <h2>{{ $productListing->grades_heading }}</h2>
            @if(!empty($productListing->grades_description))
                <p>{{ $productListing->grades_description }}</p>
            @endif
        </div>

        <div class="row">
            @php
                $grades = !empty($productListing->grades)
                    ? json_decode($productListing->grades, true)
                    : [];
            @endphp

            @if(empty($grades))
                <div class="col-12">
                    <p class="text-center">No grades available.</p>
                </div>
            @else
                @foreach($grades as $grade)
                    @php
                        // Default: no link
                        $titleLink = null;

                        // First word of grade title
                        $firstWord = explode(' ', $grade['title'] ?? '')[0] ?? '';

                        // Check applications for a valid link
                        if(!empty($applications) && $applications->isNotEmpty()) {
                            foreach($applications as $app) {
                                if(
                                    !empty($app->application_name) &&
                                    (
                                        stripos($firstWord, $app->application_name) !== false ||
                                        stripos($app->application_name, $firstWord) !== false
                                    )
                                ) {
                                    $titleLink = route('product_details', [
                                        'application_slug' => $app->application_slug,
                                        'slug' => $app->product_slug
                                    ]);
                                    break;
                                }
                            }
                        }

                        // Alt text for grade icon
                        $gradeAlt = !empty(trim($grade['icon_alt'] ?? ''))
                            ? $grade['icon_alt']
                            : (($grade['title'] ?? 'Product grade') . ' grade icon');
                    @endphp

                    {{-- Only show the grade card if a valid link exists --}}
                    @if($titleLink)
                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mb-4">
                            <a href="{{ $titleLink }}" class="service-block-one-link">

                                <div class="service-block-one h-100">
                                    <div class="inner-box">

                                        {{-- Image Section --}}
                                        <div class="image-box overlay_effect is_show">
                                            @if(!empty($grade['icon']))
                                                <figure class="image overlay_effect_in">
                                                    <img
                                                        src="{{ asset('public/assets/images/products/grades/' . $grade['icon']) }}"
                                                        alt="{{ $gradeAlt }}"
                                                        class="matrix3d_1"
                                                        loading="lazy"
                                                    >
                                                </figure>
                                            @endif

                                            <div class="text-box-new-sec">
                                                <p>{{ $grade['brand'] ?? '' }}</p>
                                            </div>

                                            <div class="icon-box details-new-one-icon-box">
                                                <img
                                                    src="https://anvayafoundation.com/henichemicals/public/frontend/img/product/papers.png"
                                                    alt="Product grade category icon"
                                                    loading="lazy"
                                                >
                                            </div>
                                        </div>

                                        {{-- Content Section --}}
                                        <div class="lower-content">
                                            <h3>{{ $grade['title'] ?? '' }}</h3>

                                            <div class="new-green-app-text">
                                                @if(!empty($grade['brand']))
                                                    <p>{{ $grade['brand'] }}</p>
                                                @endif

                                                @if(!empty($grade['description']))
                                                    <p>{{ $grade['description'] }}</p>
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </a>
                        </div>
                    @endif

                @endforeach
            @endif
        </div>
    </div>
</section>
@endif

<style>
/* Make entire card clickable */
.service-block-one-link {
    display: block;
    text-decoration: none;
    color: inherit;
    transition: transform 0.3s;
}
.service-block-one-link:hover .service-block-one {
    transform: translateY(-5px);
}
/* Ensure full height for inner boxes */
.service-block-one.h-100 {
    height: 100%;
}
</style>






{{-- Unique Section --}}
@if(!empty($productListing) && !empty($productListing->unique_heading))
<section class="feature-wrap mct-oil-uni-feature-wrap-sec" style="background:#fff; padding-bottom:0;">
    <div class="container">
        <div class="row">

            {{-- Heading --}}
            <div class="col-xl-12">
                <div class="feature-text">
                    <div class="page-title page-title-two text-center">
                        <h2>{{ $productListing->unique_heading }}</h2>
                    </div>

                    @if(!empty($productListing->unique_description))
                        <p>{{ $productListing->unique_description }}</p>
                    @endif

                    @if(!empty($productListing->unique_title))
                        <p><strong>{{ $productListing->unique_title }}</strong></p>
                    @endif
                </div>
            </div>

            @php
                $uniqueItems = !empty($productListing->unique)
                    ? json_decode($productListing->unique, true)
                    : [];
            @endphp

            @foreach($uniqueItems as $item)
                @php
                    $iconAlt = !empty(trim($item['icon_alt'] ?? ''))
                        ? $item['icon_alt']
                        : ($item['title'] ?? 'Unique feature icon');
                @endphp

                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
                    <div class="fx-services-details-feature-single">

                        <div class="icon">
                            @if(!empty($item['icon']))
                                <img
                                    src="{{ asset('public/assets/images/products/unique/' . $item['icon']) }}"
                                    alt="{{ $iconAlt }}"
                                    loading="lazy"
                                >
                            @endif
                        </div>

                        <div class="content">
                            <h5>{{ $item['title'] ?? '' }}</h5>
                            <p>{{ $item['description'] ?? '' }}</p>
                        </div>

                    </div>
                </div>
                
            @endforeach

        </div>
    </div>
</section>
@endif

{{-- Certifications --}}
@if(!empty($productListing) && !empty($productListing->certification_heading))
<section class="certification-new-sec">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <div class="page-title page-title-two text-center">
                <h2>{{ $productListing->certification_heading }}</h2>
            </div></div>
            @php
                $certifications = !empty($productListing->certifications) ? json_decode($productListing->certifications, true) : [];
            @endphp
            @foreach($certifications as $cert)
            <div class="col-md-3">
                <div class="certi-box-sec">
                    <div class="certi-box-img-sec">
                        @if(!empty($cert['image']))
                            <img src="{{ asset('public/assets/images/products/certifications/'.$cert['image']) }}" alt="{{ $cert['image_alt'] ?? 'Certification' }}">
                        @endif
                    </div>
                    <h4>{{ $cert['title'] ?? '' }}</h4>
                    <p>{{ $cert['description'] ?? '' }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Why Choose --}}
@if(!empty($productListing) && !empty($productListing->why_choose_desc))
<section class="safety-wrap">
    <div class="container">
        <div class="row align-items-center">

            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <div class="safty-info ck-content">
                    <div class="page-title page-title-two"></div>
                    <p>{!! $productListing->why_choose_desc !!}</p>
                </div>
            </div>

            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="safety-img text-right">
                    @if(!empty($productListing->why_choose_image))
                        @php
                            $whyChooseAlt = !empty(trim($productListing->why_choose_image_alt ?? ''))
                                ? $productListing->why_choose_image_alt
                                : 'Why choose ' . ($productListing->product_name ?? 'this product');
                        @endphp

                        <img
                            src="{{ asset('public/assets/images/products/' . $productListing->why_choose_image) }}"
                            alt="{{ $whyChooseAlt }}"
                            class="img-responsive"
                            loading="lazy"
                        >

                        <div class="expCounter animation-float1">
                            <img
                                src="https://anvayafoundation.com/henichemicals/public/frontend/img/product/safety-at-work.png"
                                alt="Safety at work illustration"
                                loading="lazy"
                            >
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
@endif


{{-- Safety Section --}}
@if(!empty($productListing) && (!empty($productListing->safety_image) || !empty($productListing->safety_description)))
<section class="why-choose-wrap">
  <div class="container">
    <div class="row">

      @if(!empty($productListing->safety_image))
        @php
            $safetyImage = asset('public/assets/images/products/' . $productListing->safety_image);
            $safetyAlt   = $productListing->safety_image_alt ?? 'Product safety information image';
        @endphp

        <div class="why-img col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12"
             style="background-image: url('{{ $safetyImage }}');
                    position: relative;">

          {{-- Hidden img for ALT text --}}
          <img
              src="{{ $safetyImage }}"
              alt="{{ $safetyAlt }}"
              style="opacity:0; width:1px; height:1px; position:absolute;"
          />
        </div>
      @endif

      @if(!empty($productListing->safety_description))
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
          <div class="why-info ck-content">
            <div class="page-title page-title-two"></div>
            <p>{!! $productListing->safety_description !!}</p>
          </div>
        </div>
      @endif

    </div>
  </div>
</section>
@endif



{{-- Buy Section --}}
@if(!empty($productListing))
<section class="r-and-d-wrap">
  <div class="container">
    <div class="">
      <div class="col-md-12">
        <div class="r-and-d-text wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
          <div class="page-title page-title-two"></div>
          <p>{!! $productListing->buy_description ?? '' !!}</p>
          <div class="button-2 looking-new-sec">
            <a href="https://henichemicals.com/contact-us" class="btn button" >
              <span><i class="fa fa-phone"></i></span> Contact Us
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- Quote Section --}}
@if(!empty($productListing))
<div class="footer-top-banner-section"> 
  <div class="container">
    <div class="footer-top-banner-wrap">
      <div class="section-title white wow animate fadeInLeft" data-wow-delay="200ms" data-wow-duration="1500ms">
        <h2>{{ $productListing->quote_heading ?? 'Get a Quote' }}</h2>
        <p>{{ $productListing->quote_description ?? '' }}</p>
      </div>
      <div class="btn-grp">
          <span>
          <b>Call Us :</b>
        <a href="tel:{{ $productListing->quote_phone ?? '+918425871463' }}">
          {{ $productListing->quote_phone ?? '+91 8425871463' }}
        </a>
        </span>
        <span>
        <b>Email :</b>
        <a href="mailto:{{ $productListing->quote_email ?? 'sales@henichemicals.com' }}">
           {{ $productListing->quote_email ?? 'sales@henichemicals.com' }}
        </a>
        </span>
      </div>
    </div>
  </div>
</div>
@endif

{{-- FAQs --}}
@if(!empty($productListing) && !empty($productListing->faqs_heading))
<section class="faqs-wrap">
  <div class="container">
    <div class="">
      <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="faq-wrap">
          <div class="page-title page-title-two text-center">
            <h4>{{ $productListing->faqs_heading }}</h4>
          </div>
          @php
            $faqs = !empty($productListing->faqs) ? json_decode($productListing->faqs, true) : [];
          @endphp
          @foreach($faqs as $i => $faq)
            <div class="panel mt-panel new-panel">
                <div class="acod-head">
                    <h4 class="acod-title">
                        <a data-toggle="collapse" href="#faq{{ $i }}">
                            {{ $faq['question'] ?? '' }}
                        <span class="indicator"><i class="fa fa-angle-up"></i></span>
                        </a>
                    </h4>
                </div>
                <div id="faq{{ $i }}" class="acod-body collapse ck-content">
                    <div class="acod-content">
                        {!! $faq['answer'] ?? '' !!}
                    </div>
                </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
@endif

    
	<!-- Modal -->
<div class="modal fade lookin-modal-popup-sec" id="contactModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Contact Us</h4>
            </div>

            <div class="modal-body">
                <form id="contactForm">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary look-btn">Send</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
$('#contactForm').on('submit', function(e) {
    e.preventDefault();
    alert('Form submitted!');
    $('#contactModal').modal('hide');
});
</script>
{{-- ── Product Enquiry Modal ── --}}
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

                        {{-- Hidden fields — using correct variables for this page --}}
                        <input type="hidden" name="product_id"
                               id="product_enquiry_id"
                               value="{{ $product->id ?? '' }}">

                        <input type="hidden" name="product_name_hidden"
                               value="{{ $product->product_name ?? '' }}">

                        <input type="hidden" name="brand_name"
                               value="{{ $productListing->brand_name ?? '' }}">

                        {{-- No application_slug/name on this listing page — left empty --}}
                        <input type="hidden" name="application_slug" value="">
                        <input type="hidden" name="application_name" value="">

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
                            <input type="text" class="form-control" name="mobile_no"
                                   id="mobile_no_3"
                                   placeholder="Mobile No.*"
                                   oninput="validate_mobile_number(this, 'mobile_error_3');"
                                   minlength="10" maxlength="15" required>
                            <small id="mobile_error_3" class="error-text"></small>
                        </div>

                        <div class="col-md-12" id="produt-enquiry-otp-section" style="display:none;">
                            <input type="text" class="form-control" name="otp"
                                   id="enquiry_otp_input"
                                   placeholder="Enter OTP*"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                   minlength="6" maxlength="6">
                        </div>

                        <div class="col-md-12">
                            <textarea class="form-control" name="user_message"
                                      placeholder="Your Message"></textarea>
                        </div>

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


{{-- Load reCAPTCHA ONCE with explicit render callback --}}
<script>
var recaptchaEnquiryWidgetId = null;

function onRecaptchaLoad() {
    // Only one widget on this page — no document download modal here
    recaptchaEnquiryWidgetId = grecaptcha.render('recaptcha_enquiry', {
        sitekey: '6LcIXyEqAAAAAHSFTtbyCvsgrhhk2fBSOfI6TvwZ'
    });
}
</script>

<script src="https://www.google.com/recaptcha/api.js?onload=onRecaptchaLoad&render=explicit" async defer></script>{{-- ── Product Enquiry form ───────────────────────────────────────── --}}
<script>
document.getElementById('product_enquiry_form').addEventListener('submit', function(e) {
    e.preventDefault();

    var form       = this;
    var formData   = new FormData(form);
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
    var value   = input.value.replace(/[^0-9]/g, '').substring(0, 15);
    var errorEl = document.getElementById(errorId);

    var validLength   = value.length >= 10 && value.length <= 15;
    var sameDigits    = /^(\d)\1+$/.test(value);
    var seq           = '0123456789';
    var rseq          = '9876543210';
    var isSequential  = seq.includes(value) || rseq.includes(value);
    var firstFiveSame = /^(\d)\1{4}/.test(value);

    var digitCount = {};
    for (var i = 0; i < value.length; i++) {
        var d = value[i];
        digitCount[d] = (digitCount[d] || 0) + 1;
    }
    var maxRepeat      = value.length > 0 ? Math.max.apply(null, Object.values(digitCount)) : 0;
    var tooManyRepeats = value.length > 0 && (maxRepeat / value.length > 0.8);
    var startsWithZero = value.charAt(0) === '0';
    var validStart     = true;
    if (value.length === 10) { validStart = /^[6-9]/.test(value); }

    if (validLength && !sameDigits && !firstFiveSame && !isSequential
        && !tooManyRepeats && !startsWithZero && validStart) {
        errorEl.innerText = '';
        input.setCustomValidity('');
        input.classList.remove('invalid');
    } else {
        errorEl.innerText = 'Enter a valid mobile number';
        input.setCustomValidity('Invalid');
        input.classList.add('invalid');
    }
    input.value = value;
}
</script>
@endsection
