@extends('layouts.app')
@section('content')
   
    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/about-banner.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
                        <h1>Application Details</h1>
                        <ul>
                            <li><a href="{{route('/')}}">Home</a></li>
                            <li>Application-details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    
   <section class="application-page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="remaining-app-title">
                        <h2>Choose your application for<br> <span>2-Ethylhexyl Oleate</span></h2>
                    </div>
                </div>
            </div>
            <div class="row application-popup-row">
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="service-block-one">
                                        <div class="inner-box">
                                            <div class="image-box overlay_effect is_show">
                                                <figure class="image overlay_effect_in">
                                                    <a href="#" class="product-link" data-url="https://anvayafoundation.com/henichemicals/product-details/2-ethylhexyl-oleate-1">
                                                        <img src="https://anvayafoundation.com/henichemicals/public/assets/images/brands-and-products/K89dlsIWBnXYe9PtWexQ.png" class="matrix3d_1" alt="">
                                                    </a>
                                                </figure>
                                                <div class="icon-box">
                                                    <img src="https://anvayafoundation.com/henichemicals/public/assets/images/brands-and-products/CpaMkUWkznDhncGxtiDn.png">
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <h3>
                                                    <a href="#" class="product-link" data-url="https://anvayafoundation.com/henichemicals/product-details/2-ethylhexyl-oleate-1">
                                                        Cosmetics
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="service-block-one">
                                        <div class="inner-box">
                                            <div class="image-box overlay_effect is_show">
                                                <figure class="image overlay_effect_in">
                                                    <a href="#" class="product-link" data-url="https://anvayafoundation.com/henichemicals/product-details/2-ethylhexyl-oleate-1-1-1">
                                                        <img src="https://anvayafoundation.com/henichemicals/public/assets/images/brands-and-products/6NHGqph1D56yq2b7sVmQ.png" class="matrix3d_1" alt="">
                                                    </a>
                                                </figure>
                                                <div class="icon-box">
                                                    <img src="https://anvayafoundation.com/henichemicals/public/assets/images/brands-and-products/hNVn0ERzZSEpa8cCrmrM.png">
                                                </div>
                                            </div>
                                            <div class="lower-content">
                                                <h3>
                                                    <a href="#" class="product-link" data-url="https://anvayafoundation.com/henichemicals/product-details/2-ethylhexyl-oleate-1-1-1">
                                                        Industrial Lubricants
                                                    </a>
                                                </h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>
    </section>
    
    
@endsection