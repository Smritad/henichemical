@extends('layouts.app')
@section('content')
	@php
		$fetch_basic_details 	= DB::table('basic_details')
								->where('id','=','1')
								->first();
	@endphp

<section class="banner-section">
    <div class="banner-carousel owl-theme owl-carousel">

        @php
            $list_banners = DB::table('banners')
                ->where('status', '1')
                ->get();
        @endphp

        @foreach($list_banners as $index => $list_banners_ind)
            <div class="slide-item">

                <!--<div class="image-layer"-->
                <!--     style="background-image:url({{ asset('public/assets/images/banners/'.$list_banners_ind->img_src) }})">-->
                <!--</div>-->
                
                <div class="image-layer" >
                    <img src="{{ asset('public/assets/images/banners/'.$list_banners_ind->img_src) }}" width="1920" height="800" alt="{{ $list_banners_ind->title_one ?? 'HENI Chemicals' }}" {{ $index === 0 ? 'fetchpriority=high' : 'loading=lazy' }}>
                </div>

                <div class="container">
                    <div class="content-box">

                        {{-- H1 ONLY for 2nd slider (index = 1) --}}
                        @if($index === 1)
                            <h1 style="position:absolute;left:-9999px;">
                                HENI Chemicals – Manufacturer &amp; Global Supplier
                            </h1>
                        @endif

                        <h4 class="chemistry-anim">{{ $list_banners_ind->title_one }}</h4>
                        <h2><span>{{ $list_banners_ind->title_two }}</span></h2>
<div class="btn-box">
								<div class="button-slider">
									<a href="{{ $list_banners_ind->link }}" class="button">View More <span><i class="fa fa-angle-right"></i></span></a>
								</div>
							</div>
                    </div>
                </div>

            </div>
        @endforeach

    </div>
</section>

	<section class="benefit-box-sec">
		<div class="container">
			<div class="row">
				@php
					$list_key_points	= DB::table('key_points')
										->where('status','=','1')
										->get();
				@endphp

				@foreach($list_key_points AS $list_key_points_ind)
					<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
						<div class="pbmit-ihbox-style-7">
							<div class="pbmit-ihbox-box">
								<div class="pbmit-icon-wrapper">
									<h2 class="pbmit-element-title">{!! $list_key_points_ind->title !!}</h2>
									<div class="pbmit-ihbox-icon">
										<div class="pbmit-ihbox-icon-wrapper">
											<div class="pbmit-icon-wrapper pbmit-icon-type-icon">
												<img src="{{asset('public/assets/images/key-points/'.$list_key_points_ind->img_src)}}" loading="lazy">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				@endforeach
			</div>
		</div>
	</section>

	<section class="application-area">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-title text-center">
						<h2>Applications</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="owl-carousel owl-theme" id="applications">
						@php
							$list_product_applications	= DB::table('brands_and_products')
														->where('status','=','1')
														->where('id','!=',9)
														->get();
						@endphp

						@foreach($list_product_applications AS $list_product_applications_ind)
							<div class="item">
								<div class="service-block-one">
									<div class="inner-box">
										<div class="image-box overlay_effect">
											<figure class="image overlay_effect_in">
												<a href="{{ route('products_by_applications',['slug' => $list_product_applications_ind->application_slug]) }}">
													<img src="{{asset('public/assets/images/brands-and-products/'.$list_product_applications_ind->img_src)}}" class="matrix3d_1" alt="Specialty chemical product pack by Heni Chemicals for industrial applications" loading="lazy">
												</a>
											</figure>

											<div class="icon-box">
												<img src="{{asset('public/assets/images/brands-and-products/'.$list_product_applications_ind->icon_img_src)}}" alt="Heni Chemicals premium chemical product bottle – high-performance formulation" loading="lazy">
											</div>
										</div>
										<div class="lower-content">
											<h3><a href="{{ route('products_by_applications',['slug' => $list_product_applications_ind->application_slug]) }}">{{ $list_product_applications_ind->application_name }}</a></h3>
											<!-- <h6>ZONqs</h6> -->
											<p>{{ $list_product_applications_ind->short_description }}</p>
										</div>
									</div>
								</div>
							</div>
						@endforeach
					</div>
				</div>
			</div>
		</div>
	</section>

	@php
		$fetch_event_details	= DB::table('events')
								->where('status','=','1')
								->where('is_featured','=','1')
								->first();
	@endphp

	@if($fetch_event_details)
		<!--<section class="event-sec">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="page-title text-center"  data-aos="flip-left">
							<h2>Events</h2>
						</div>
					</div>
				</div>
				<div class="row event_row">
					@php
						$fetch_event_one_details	= DB::table('events')
													->where('status','=','1')
													->where('is_featured','=','1')
													->latest('event_date')
													->first();
					@endphp

					<div class="col-md-6">
						<div class="event-img event-img1 rellax" data-rellax-speed="2">
							<div class="">
								<img src="{{asset('public/assets/images/events/'.$fetch_event_one_details->img_src)}}" class="matrix3d_1 img-responsive">
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="event-content">
							<h3>{{ $fetch_event_one_details->title }}</h3>

							{!! $fetch_event_one_details->description !!}

							<div class="button-2">
								<a href="#" class="button">View More <span><i class="fa fa-angle-right"></i></span></a>
							</div>
						</div>
					</div>
				</div>

				@php
					$fetch_event_two_details	= DB::table('events')
												->where('status','=','1')
												->where('is_featured','=','1')
												->latest('event_date')
												->skip(1)
												->take(1)
												->first();
				@endphp

				@if($fetch_event_two_details)
					<div class="row reverse_col">
						<div class="col-md-6">
							<div class="event-content event-content-two" data-aos="fade-right">
								<h3>{{ $fetch_event_two_details->title }}</h3>

								{!! $fetch_event_two_details->description !!}

								<div class="button-2">
									<a href="#" class="button">View More <span><i class="fa fa-angle-right"></i></span></a>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="event-img event-img2 rellax" data-rellax-speed="1">
								<div class="">
									<img src="{{asset('public/assets/images/events/'.$fetch_event_two_details->img_src)}}" class="img-responsive">
								</div>
							</div>
						</div>
					</div>
				@endif
			</div>
		</section>-->
	@endif

	<section class="event-sec-two">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#past-event"><span>01</span> Upcoming Event</a></li>
						<li><a data-toggle="tab" href="#upcoming-event"><span>02</span> Past Event</a></li>
					</ul>
					<div class="tab-content">
						<div id="past-event" class="tab-pane fade in active">
							@php
								$list_upcoming_events	= DB::table('events')
														->where('status','=','1')
														->whereDate('event_date', '>=', now())
														->get();
							@endphp

							@if(COUNT($list_upcoming_events) > 0)
								<div class="row">
									<div class="owl-carousel owl-theme" id="event">
										@foreach($list_upcoming_events AS $list_upcoming_events_ind)
											<div class="item">
												<article class="pbmit-blog-style-1">
													<div class="post-item">
														<div class="pbminfotech-box-content">
															<div class="pbmit-featured-container">
																<div class="pbmit-featured-img-wrapper overlay_effect">
																	<div class="pbmit-featured-wrapper overlay_effect_in">
																		<img src="{{asset('public/assets/images/events/'.$list_upcoming_events_ind->img_src)}}" class="matrix3d_1 img-fluid" alt="Heni Chemicals event photo – industry networking and brand presentation" loading="lazy">
																	</div>
																</div>
																<a class="pbmit-blog-btn" href="#">
																	<span class="pbmit-button-icon-wrapper">
																		<span class="pbmit-button-icon">
																			<span><img src="{{asset('public/frontend/img/icons/event-green.webp')}}" loading="lazy"></span>
																		</span>
																	</span>
																</a>
																<a class="pbmit-link" href="#"></a>
															</div>
															<div class="pbmit_content">
																<div class="pbmit-category-date-wraper">
																	<div class="pbmit-meta-date-wrapper pbmit-meta-line">
																		<div class="pbmit-meta-date">
																			<span class="pbmit-post-date">
																				<i class="fa fa-calendar"></i> {{ date('F d, Y', strtotime($list_upcoming_events_ind->event_date)) }}
																			</span>
																		</div>
																	</div>
																	<div class="pbmit-meta-author pbmit-meta-line">
																		<span class="pbmit-post-author">
																		<i class="fa fa-user"></i> {{ $list_upcoming_events_ind->event_by }}
																		</span>
																	</div>
																</div>
																<div class="pbmit-content-wrapper">
																	<h3 class="pbmit-post-title">
																		<a href="#">{{ $list_upcoming_events_ind->title }}</a>
																	</h3>
																	<p>{{ $list_upcoming_events_ind->short_description }}</p>
																</div>
															</div>
														</div>
													</div>
												</article>
											</div>
										@endforeach
									</div>
								</div>
							@else
								<div class="row">
									<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">
										<div class="product_item">
											<div class="product_title">
												<h4><a href="javascript:void(0);">There are no upcoming events.</a></h4>
											</div>
										</div>
									</div>
								</div>
							@endif
						</div>
						<div id="upcoming-event" class="tab-pane fade">
							<div class="row">
								<div class="owl-carousel owl-theme" id="event-one">
									@php
										$list_past_events	= DB::table('events')
															->where('status','=','1')
															->whereDate('event_date', '<=', now())
															->get();
									@endphp

									@foreach($list_past_events AS $list_past_events_ind)
										<div class="item">
											<article class="pbmit-blog-style-1">
												<div class="post-item">
													<div class="pbminfotech-box-content">
														<div class="pbmit-featured-container">
															<div class="pbmit-featured-img-wrapper">
																<div class="pbmit-featured-wrapper">
																	<img src="{{asset('public/assets/images/events/'.$list_past_events_ind->img_src)}}" class="img-fluid" alt="Heni Chemicals event photo – industry networking and brand presentation" loading="lazy">
																</div>
															</div>
															<a class="pbmit-blog-btn" href="#">
																<span class="pbmit-button-icon-wrapper">
																	<span class="pbmit-button-icon">
																		<span><img src="{{asset('public/frontend/img/icons/event-green.webp')}}" loading="lazy"></span>
																	</span>
																</span>
															</a>
															<a class="pbmit-link" href="#"></a>
														</div>
														<div class="pbmit_content">
															<div class="pbmit-category-date-wraper">
																<div class="pbmit-meta-date-wrapper pbmit-meta-line">
																	<div class="pbmit-meta-date">
																		<span class="pbmit-post-date">
																		<i class="fa fa-calendar"></i> {{ date('F d, Y', strtotime($list_past_events_ind->event_date)) }}
																		</span>
																	</div>
																</div>
																<div class="pbmit-meta-author pbmit-meta-line">
																	<span class="pbmit-post-author">
																	<i class="fa fa-user"></i> {{ $list_past_events_ind->event_by }}
																	</span>
																</div>
															</div>
															<div class="pbmit-content-wrapper">
																<h3 class="pbmit-post-title">
																	<a href="#">{{ $list_past_events_ind->title }}</a>
																</h3>
																<p>{{ $list_past_events_ind->short_description }}</p>
															</div>
														</div>
													</div>
												</div>
											</article>
										</div>
									@endforeach
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="certificate-sec">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="page-title text-center">
						<h2>Certificates</h2>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="certificate_container">
					@php
						$list_certificates	= DB::table('certificates')
											->where('status','=','1')
											->get();
					@endphp

					@foreach($list_certificates AS $list_certificates_ind)
						<div class="certificate_flex">
							<div class="certificate-logo">
								<img src="{{asset('public/assets/images/certificates/'.$list_certificates_ind->img_src)}}" class="hvr-bob img-responsive" loading="lazy">
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</div>
	</section>

	<section class="newsletter-sec">
		<div class="container">
			<div class="row newsletter-row">
				<div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-6 col-xs-6">
					<div class="newsletter-box1">
						<i class="fa fa-phone"></i>
						<h2>Have any queries?<br>
							<a href="tel:91{{ $fetch_basic_details->mobile_no }}">+91 {{ $fetch_basic_details->mobile_no }}</a>
						</h2>
					</div>
				</div>
				<div class="col-xxl-5 col-xl-5 col-lg-5 col-md-5 col-sm-6 col-xs-6">
					<div class="newsletter-box2">
						<h2>If you have any queries feel free to ask</h2>
					</div>
				</div>
				<div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="newsletter-box3">
						<div class="button-2">
							<a href="{{route('contact_us')}}" class="button"><span><i class="fa fa-phone"></i></span> Contact Us</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection