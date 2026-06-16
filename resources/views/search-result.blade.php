@extends('layouts.app')

@section('content')
<style>
.search-title{color:#fff;font-size:48px;font-weight:700;text-align:center}.breadcrum-banner{position:relative;height:300px;background-size:cover;background-position:center;background-repeat:no-repeat;margin-top:72px}.breadcrum-banner::before{content:"";position:absolute;inset:0;background:rgba(0,0,0,.5)}.breadcrum-banner .container{position:relative;z-index:2}
</style>
<section class="breadcrum-banner d-flex align-items-center justify-content-center text-center"
    style="background-image:url('{{ asset('public/frontend/img/banner/contact-banner.jpg') }}');">
    
    <div class="container">
        <h1 class="search-title">Search Result</h1>
    </div>
</section>

<section class="search-page-wrap">
    <div class="container">

        <h2 class="result-title">
            Results for: "{{ $keyword }}"
        </h2>

        {{-- ================= BROCHURES ================= --}}
        @if($list_brochures->count())
            <h3 class="mb-3">Brochures</h3>

            @foreach($list_brochures as $item)
                <div class="serach-items">
                    <h4>
                        <a href="{{ route('brochure') }}">
                            {{ $item->title }}
                        </a>
                    </h4>
                    <a class="read-more" href="{{ route('brochure') }}">
                        View Brochure »
                    </a>
                </div>
                <hr>
            @endforeach
        @endif


        {{-- ================= PRODUCTS ================= --}}
        @if($list_products->count())
            <h3 class="mb-3">Products</h3>

            @foreach($list_products as $item)
                <div class="serach-items">
                    <h4>
                        <a href="{{ route('product_details', [
                            'application_slug' => $item->application_slug,
                            'slug' => $item->slug
                        ]) }}">
                            {{ $item->brand_name }}
                            @if(!empty($item->brand_no))
                                – {{ $item->brand_no }}
                            @endif
                        </a>
                    </h4>

                    <p class="small text-muted">
                        Brand: {{ $item->brand_name }} |
                        Application: {{ $item->application_name }}
                    </p>

                    <a class="read-more" href="{{ route('product_details', [
                        'application_slug' => $item->application_slug,
                        'slug' => $item->slug
                    ]) }}">
                        View Product »
                    </a>
                </div>
                <hr>
            @endforeach
        @endif


        {{-- ================= BRAND ================= --}}
        @if(!empty($fetch_brand_details))
            <h3 class="mb-3">Brand</h3>

            <div class="serach-items">
                <h4>
                    <a href="{{ route('products_by_brands', [
                        'slug' => $fetch_brand_details->brand_slug
                    ]) }}">
                        {{ $fetch_brand_details->brand_name }}
                    </a>
                </h4>
            </div>
            <hr>
        @endif


        {{-- ================= APPLICATION ================= --}}
        @if(!empty($fetch_application_details))
            <h3 class="mb-3">Application</h3>

            <div class="serach-items">
                <h4>
                    <a href="{{ route('products_by_applications', [
                        'slug' => $fetch_application_details->application_slug
                    ]) }}">
                        {{ $fetch_application_details->application_name }}
                    </a>
                </h4>
            </div>
            <hr>
        @endif


        {{-- ================= NO RESULT ================= --}}
        @if(
            $list_products->count() == 0 &&
            $list_brochures->count() == 0 &&
            empty($fetch_brand_details) &&
            empty($fetch_application_details)
        )
            <div class="serach-items text-center">
                <h3>No Result Found!</h3>
            </div>
        @endif

    </div>
</section>

@endsection
