@extends('layouts.app')

@section('content')
<style>
.service-block-one .inner-box .lower-content {
    height: 100px; /* Remove or override this */
}

@media (max-width: 480px) {
    .service-block-one .inner-box .lower-content {
		height: 80px;
		padding: 10px !important;
	}
}

@media only screen and (min-width: 481px) and (max-width: 767px) {
    .service-block-one .inner-box .lower-content {
        /* padding: 10px; */
        height: 75px;
        text-align: center;
    }
}

@media only screen and (min-width: 768px) and (max-width: 991px) {
    .service-block-one .inner-box .lower-content {
        /* padding: 10px; */
        height: 75px;
        text-align: center;
    }
}
</style>
<div class="container">
    <div class="remaining-app-title">
        <h2>Choose your application for<br> <span>{{ $product->product_name }}</span></h2>
    </div>

    <div class="row application-popup-row">
        @foreach ($applications as $application)
            @php
                $product_url = url($application->application_slug . '/' . $application->product_slug);
            @endphp

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                <div class="service-block-one">
                    <div class="inner-box">
                        <div class="image-box overlay_effect is_show">
                            <figure class="image overlay_effect_in">
                                <a href="{{ $product_url }}">
                                    <img src="{{ $application->img_src }}" class="matrix3d_1" alt="">
                                </a>
                            </figure>
                            <div class="icon-box">
                                <img src="{{ $application->icon_img_src }}">
                            </div>
                        </div>
                        <div class="lower-content">
    <h3 style="margin: 0; padding: 0;">
        <a href="{{ $product_url }}">
            {{ $application->application_name }}
        </a>
    </h3>
</div>

                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
