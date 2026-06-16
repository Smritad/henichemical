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


    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/pharma-banner.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
                        <!--<h1>{{ $metaData['h1'] }}</h1>    -->
                        <h1>{{ $fetch_products_by_applications_details->application_name }}</h1>
                        <ul>
                            <li><a href="{{route('/')}}">Home</a></li>
                            <li><a href="javascript:void(0);">Brands & Products</a></li>
                            <li>{{ $fetch_products_by_applications_details->application_name }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section class="products-listing-wrap">
    <div class="container">
        @if($fetch_products_by_applications_details->application_name == "Pharmaceuticals" || $fetch_products_by_applications_details->application_name == "Industrial Lubricants")
            @php
                $product_types = ['API', 'Lipophilic Excipients', 'Ester'];
            @endphp

            @foreach($product_types as $type)
                @php
                    $list_products = DB::table('products')
                        ->where('brand_id', '=', $fetch_products_by_applications_details->id)
                        ->where('product_type', '=', $type)
                        ->where('status', '=', '1')
                        ->get();
                @endphp

                @if(count($list_products) > 0)
                    <div class="row">
                        <div class="col-md-12">
                            <div class="products-listing-title {{ $loop->first ? '' : 'mT30' }}">
                                <h3>{{ $type }}</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach($list_products as $product)
                            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                                <div class="product_item wow fadeInUp animated" data-wow-delay="700ms" data-wow-duration="700ms"
                                     data-url="{{ route('product_details', ['application_slug' => $fetch_products_by_applications_details->application_slug, 'slug' => $product->slug]) }}"
                                     onclick="redirect_to_product_details(this)">
                                    <div class="product_title">
                                        <h4><a href="{{ route('product_details', ['application_slug' => $fetch_products_by_applications_details->application_slug, 'slug' => $product->slug]) }}">
                                            {{ $fetch_products_by_applications_details->brand_name }}{{ $product->brand_no ? ' - ' . $product->brand_no : '' }}
                                        </a></h4>
                                        <h5><a href="{{ route('product_details', ['application_slug' => $fetch_products_by_applications_details->application_slug, 'slug' => $product->slug]) }}">{{ $product->product_name }}</a></h5>
                                    </div>
                                    <div class="product_brand_details">
                                       <div class="product_brand">
                                            @if(!empty($product->function))
                                                {!! $product->function !!}
                                            @else
                                                {{ $product->product_heading }}
                                            @endif
                                       </div>

                                        <div class="product_sublink">
                                            <ul>
                                                @if($product->ip_src)<li class="no-after"><a href="javascript:void(0);">IP</a></li>@endif
                                                @if($product->usp_src)<li><a href="javascript:void(0);">USP</a></li>@endif
                                                @if($product->bp_src)<li><a href="javascript:void(0);">BP</a></li>@endif
                                                @if($product->ep_src)<li><a href="javascript:void(0);">EP</a></li>@endif
                                                @if($product->usp_nf_src)<li><a href="javascript:void(0);">USP-NF</a></li>@endif
                                                @if($product->acs_src)<li><a href="javascript:void(0);">ACS</a></li>@endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endforeach

        @else
            <div class="row">
                <div class="col-md-12">
                    <div class="products-listing-title mT30">
                        <h3>Products List</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    if($fetch_products_by_applications_details->application_slug == 'food-nutraceuticals-chemicals') {
                        $list_products = DB::table('products')
                            ->whereIn('brand_id', [2, 9])
                            ->where('status', '=', '1')
                            ->get();
                    } else {
                        $list_products = DB::table('products')
                            ->where('brand_id', '=', $fetch_products_by_applications_details->id)
                            ->where('status', '=', '1')
                            ->get();
                    }
                @endphp

                @if(count($list_products) > 0)
                    @foreach($list_products as $product)
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="product_item wow fadeInUp animated" data-wow-delay="700ms" data-wow-duration="700ms"
                                 data-url="{{ route('product_details', ['application_slug' => $fetch_products_by_applications_details->application_slug, 'slug' => $product->slug]) }}"
                                 onclick="redirect_to_product_details(this)">
                                <div class="product_title">
                                  @php
    $hideBrandTitle =
        $product->brand_id == 9 ||
        strtolower($product->product_name) == 'aqueaux' ||
        strtolower($product->product_name) == 'oleane';
@endphp

@if(!$hideBrandTitle)
    <h4>
        <a href="{{ route('product_details', [
            'application_slug' => $fetch_products_by_applications_details->application_slug,
            'slug' => $product->slug
        ]) }}">
            {{ $fetch_products_by_applications_details->brand_name }}
            {{ $product->brand_no ? ' - ' . $product->brand_no : '' }}
        </a>
    </h4>
@endif
                                    
                                 
                                    
                                   <h5>
    <a href="{{ route('product_details', [
        'application_slug' => $fetch_products_by_applications_details->application_slug,
        'slug' => $product->slug
    ]) }}">

        @if($product->product_name == 'Aqueaux')
            <img
                src="{{ asset('public/assets/images/products/4LgF4fXIaSRXt9vWV9aa.png') }}"
                alt="Aqueaux"
                style="width:145px; height:69px; display:block; margin:0 auto;">

        @elseif($product->product_name == 'Oleane')
            <img
                src="{{ asset('public/assets/images/products/Oleane-Logo.png') }}"
                alt="ZONOea"
                style="width:145px;height: 112px;display:block;margin:0 auto;">

        @else
            {{ $product->product_name }}
        @endif

    </a>
</h5>

                                </div>
                                <div class="product_brand_details">
                                    <div class="product_brand">
                                        {!! $product->function !!}
                                    </div>
                                    <div class="product_sublink">
                                        <ul>
                                            @if($product->ip_src)<li class="no-after"><a href="javascript:void(0);">IP</a></li>@endif
                                            @if($product->usp_src)<li><a href="javascript:void(0);">USP</a></li>@endif
                                            @if($product->bp_src)<li><a href="javascript:void(0);">BP</a></li>@endif
                                            @if($product->ep_src)<li><a href="javascript:void(0);">EP</a></li>@endif
                                            @if($product->usp_nf_src)<li><a href="javascript:void(0);">USP-NF</a></li>@endif
                                            @if($product->acs_src)<li><a href="javascript:void(0);">ACS</a></li>@endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        @endif
    </div>
</section>

<section class="products-details-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="products_page_img wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
<img 
    src="{{ asset('public/assets/images/brands-and-products/' . $fetch_products_by_applications_details->img_src) }}" 
    class="img-responsive"
    alt="{{ $fetch_products_by_applications_details->application_name ?? 'Heni Chemicals specialty chemical solution in branded packaging' }}"
>
                </div>
            </div>
            <div class="col-md-7 ck-content">
                <div class="products_page_text wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
                    <div class="page-title" data-aos="flip-left">
                        <h2>{{ $fetch_products_by_applications_details->application_name }} ({{ $fetch_products_by_applications_details->brand_name }})</h2>
                    </div>
                    {!! $fetch_products_by_applications_details->description !!}
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function redirect_to_product_details(element) {
        var url = element.getAttribute('data-url');
        window.location.href = url;
    }
</script>

@endsection
