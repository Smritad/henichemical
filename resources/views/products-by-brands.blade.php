@extends('layouts.app')

@section('meta_title', $metaData['title'])
@section('meta_description', $metaData['description'])

@section('content')
<style>
.breadcrum-banner {
    position: relative;
    background-size: cover;
    background-position: center bottom;
    background-repeat: no-repeat;
    /* height: 300px; */
    padding: 150px 0px;
    margin-top: 70px;
}

.breadcrum-banner:after {
	position: absolute;
	width: 100%;
	height: 100%;
	top: 0px;
	left: 0px;
	background-color: #4a4a4a9c;
}</style>
<section class="breadcrum-banner" style="background-image:url('{{ asset('public/frontend/img/banner/pharma-banner.jpg') }}');">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="breadcrum-content">
                         <h1>{{ $metaData['h1'] }}</h1>                    
                         <ul>
                        <li><a href="{{ route('/') }}">Home</a></li>
                        <li>Brands & Products</li>
                        <li>{{ $fetch_products_by_brands_details->brand_name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<br>
<section class="products-details-wrap">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <div class="products_page_img wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
                    <img src="{{ asset('public/assets/images/brands-and-products/' . $fetch_products_by_brands_details->img_src) }}" class="img-responsive" alt="Heni Chemicals specialty chemical product packaging – industrial-grade formulation">
                </div>
            </div>
            <div class="col-md-7 ck-content">
                <div class="products_page_text wow fadeInRight animated" data-wow-delay="700ms" data-wow-duration="700ms">
                    <div class="page-title" data-aos="flip-left">
                        <h2>{{ $fetch_products_by_brands_details->application_name }} ({{ $fetch_products_by_brands_details->brand_name }})</h2>
                    </div>
                    {!! $fetch_products_by_brands_details->description !!}
                </div>
            </div>
        </div>
    </div>
</section>

<section class="products-listing-wrap">
    <div class="container">
        @php
            $productTypes = $fetch_products_by_brands_details->application_name == "Pharmaceuticals" || $fetch_products_by_brands_details->application_name == "Industrial Lubricants"
                ? ['API', 'Lipophilic Excipients', 'Ester']
                : ['All Products'];
        @endphp

        @foreach ($productTypes as $type)
            @php
                $query = DB::table('products')
                            ->where('brand_id', '=', $fetch_products_by_brands_details->id)
                            ->where('status', '=', '1');

                if ($type !== 'All Products') {
                    $query->where('product_type', '=', $type);
                }

                $products = $query->get();
            @endphp

            @if (count($products) > 0)
                <div class="row">
                    <div class="col-md-12">
                        <div class="products-listing-title {{ $type !== 'API' ? 'mT30' : '' }}">
                            <h3>{{ $type === 'All Products' ? 'Products List' : $type }}</h3>
                        </div>
                    </div>
                </div>

                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6">
                            <div class="product_item wow fadeInUp animated" data-wow-delay="700ms" data-wow-duration="700ms"
                                data-url="{{ route('product_details', ['application_slug' => $fetch_products_by_brands_details->application_slug, 'slug' => $product->slug]) }}"
                                onclick="redirect_to_product_details(this)">
                                <div class="product_title">
                                    <h4>
                                        <a href="{{ route('product_details', ['application_slug' => $fetch_products_by_brands_details->application_slug, 'slug' => $product->slug]) }}">
                                            {{ $fetch_products_by_brands_details->brand_name }}{{ $product->brand_no ? ' - ' . $product->brand_no : '' }}
                                        </a>
                                    </h4>
                                   <h5>
                                        <a href="{{ route('product_details', ['application_slug' => $fetch_products_by_brands_details->application_slug, 'slug' => $product->slug]) }}">
                                    
                                            @if(strtolower($product->product_name) === 'aqueaux')
                                                <img 
                                                    src="https://henichemicals.com/public/assets/images/products/Sln0xjbMLlyvlZLSkM4k.png"
                                                    alt="Aqueaux"
                                                    style="max-width:160px; height:auto;"
                                                >
                                            @else
                                                {{ $product->product_name }}
                                            @endif
                                    
                                        </a>
                                    </h5>

                                </div>
                                <div class="product_brand_details">
                                    <div class="product_brand">
                                        {{ $product->product_title }}
                                    </div>
                                    <div class="product_sublink">
                                        <ul>
                                            @if($product->ip_src) <li class="no-after"><a href="javascript:void(0);">IP</a></li> @endif
                                            @if($product->usp_src) <li><a href="javascript:void(0);">USP</a></li> @endif
                                            @if($product->bp_src) <li><a href="javascript:void(0);">BP</a></li> @endif
                                            @if($product->ep_src) <li><a href="javascript:void(0);">EP</a></li> @endif
                                            @if($product->usp_nf_src) <li><a href="javascript:void(0);">USP-NF</a></li> @endif
                                            @if($product->acs_src) <li><a href="javascript:void(0);">ACS</a></li> @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!--<div class="row">-->
                <!--    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12">-->
                <!--        <div class="product_item wow fadeInUp animated" data-wow-delay="700ms" data-wow-duration="700ms">-->
                <!--            <div class="product_title">-->
                                <!--<h4><a href="javascript:void(0);">No products were found.</a></h4>-->
                <!--            </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
            @endif
        @endforeach
    </div>
</section>

<script>
    function redirect_to_product_details(element) {
        var url = element.getAttribute('data-url');
        window.location.href = url;
    }
</script>
@endsection
