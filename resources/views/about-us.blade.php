@extends('layouts.app')

@section('meta_title', 'About HENI Chemicals | Legacy of Innovation Since 1960s')
@section('meta_description', 'Learn about HENI\'s legacy, global vision, brand ZON, and commitment to sustainability & quality in specialty chemical manufacturing.')

@section('content')
    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/about-banner.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
                       <h1>About Us – HENI’s Journey of Innovation & Excellence</h1>
                        <ul>
                            <li><a href="{{route('/')}}">Home</a></li>
                            <li>About Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="history-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title" data-aos="flip-left">
                        <h2> History & Future - Rising of the brand ZON (Sun)</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="history-text">
                        @php
                            $fetch_about_us_history_details = DB::table('about_us_history')
                                                            ->where('id','=','1')
                                                            ->first();
                        @endphp

                        <!--<img src="{{asset('public/assets/images/about-us-history/'.$fetch_about_us_history_details->img_src)}}" class="img-responsive wow fadeInUp animated" data-wow-delay="700ms" data-wow-duration="700ms">-->

                        {!! $fetch_about_us_history_details->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @php
        $fetch_about_us_r_and_d_details = DB::table('about_us_r_and_d')
                                        ->where('id','=','1')
                                        ->first();
    @endphp
    <!--<section class="r-and-d-wrap" style="background-image:url('{{asset('public/assets/images/about-us-r-and-d/'.$fetch_about_us_r_and_d_details->img_src)}}');">-->
    <section class="r-and-d-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="r-and-d-text wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
                        <div class="page-title" data-aos="flip-left">
                            <h2>R&D</h2>
                        </div>

                        {!! $fetch_about_us_r_and_d_details->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="quality-control-wrap">
        <div class="container">
            <div class="row">
                @php
                    $fetch_about_us_quality_control_details = DB::table('about_us_quality_control')
                                                            ->where('id','=','1')
                                                            ->first();
                @endphp
                <div class="col-md-6">
                    <div class="aboutContent">
                        <div class="page-title" data-aos="flip-left">
                            <h2>Quality Control</h2>
                        </div>

                        {!! $fetch_about_us_quality_control_details->description !!}
                        
                        <!--<div class="hr"></div>
                        <div class="row mb43">
                            <div class="col-md-6">
                                <div class="iconBox01">
                                    <span>01</span>
                                    <h3>
                                        {{ $fetch_about_us_quality_control_details->point_one }}
                                    </h3>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="iconBox01 ib01Last">
                                    <span>02</span>
                                    <h3>
                                        {{ $fetch_about_us_quality_control_details->point_two }}
                                    </h3>
                                </div>
                            </div>
                        </div>-->
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="aboutImg text-right wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
                        <img src="{{asset('public/assets/images/about-us-quality-control/'.$fetch_about_us_quality_control_details->img_src)}}" alt="Heni Chemicals quality control laboratory with advanced testing equipment">
                        <div class="expCounter">
                            <span class="counters appeared" data-count="25" data-suffix="" data-format="plain">{{ $fetch_about_us_quality_control_details->no_of_experience }}</span>
                            <span>Years of Experience</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--<section class="whyus-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title text-center" data-aos="flip-left">
                        <h2>Why ZON</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="testCategories wow fadeInUp animated" data-wow-delay="700ms" data-wow-duration="700ms">
                        <div class="row">
                            @php
                                $list_about_us_why_zon  = DB::table('about_us_why_zon')
                                                        ->where('status','=','1')
                                                        ->get();
                            @endphp

                            @foreach ($list_about_us_why_zon AS $list_about_us_why_zon_ind)
                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                    <div class="testCatItem">
                                        {{-- <h3 class="heebo">Custom<br> Manufacturing</h3> --}}
                                        {!! $list_about_us_why_zon_ind->title !!}

                                        <p>{{ $list_about_us_why_zon_ind->description }}</p>
                                        
                                        <div class="whyus-icon">
                                            <img src="{{asset('public/assets/images/about-us-why-zon/'.$list_about_us_why_zon_ind->img_src)}}">
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>-->
@endsection