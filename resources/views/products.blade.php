@extends('layouts.app')
@section('content')
<style>.list-three-col {
    display: flex;
    flex-wrap: wrap;
    list-style: none;
    padding: 0;
    margin: 0;
}

.list-three-col li {
    width: 33.33%;
    padding: 5px 0;
    word-break: break-word;
}
</style>
    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/contact-banner.jpg')}}'); background-position: center top;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
                        <h1>Products</h1>
                        <ul>
                            <li><a href="{{ route('/') }}">Home</a></li>
                            <li>Products</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="products-page-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="product-page-title">
                        <h2>Product by Brands</h2>
                    </div>
                    <div class="product_group">
                        <ul class="list-two-col">
                            @php
                                $list_product_brands	= DB::table('brands_and_products')
                                                        ->where('status','=','1')
                                                        ->get();
                            @endphp

                            @foreach($list_product_brands AS $list_product_brands_ind)
                                <li>
                                    <a href="{{ route('products_by_brands',['slug' => $list_product_brands_ind->brand_slug]) }}">
                                        {{ $list_product_brands_ind->brand_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-page-title">
                        <h2>Product by Applications</h2>
                    </div>
                    <div class="product_group">
                        <ul class="list-two-col">
                            @php
                                $list_product_applications	= DB::table('brands_and_products')
                                                            ->where('status','=','1')
                                                            ->get();
                            @endphp

                            @foreach($list_product_applications AS $list_product_applications_ind)
                                <li>
                                    <a href="{{ route('products_by_applications',['slug' => $list_product_applications_ind->application_slug]) }}">
                                        {{ $list_product_applications_ind->application_name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row pT40">
                <div class="col-md-12">
                    <div class="product-page-title">
                        <h2>Product by Alphabetical Listing</h2>
                    </div>
<div class="products-listings">
    @php
        $list_products = DB::table('products')
            ->join('brands_and_products', 'brands_and_products.id', '=', 'products.brand_id')
            ->where('products.status', '=', '1')
            ->select('products.*', 'brands_and_products.application_name', 'brands_and_products.application_slug')
            ->orderBy('products.product_name')
            ->get();
    @endphp

    @foreach($list_products->groupBy(function ($product) {
        $firstChar = strtoupper(substr($product->product_name, 0, 1));
        return is_numeric($firstChar) ? 'A' : $firstChar;
    }) as $letter => $products)
        <div class="product_group">
            <h2 class="product-alpha-title">{{ $letter }}</h2>
            <ul class="list-three-col">
                @foreach($products as $product)
                    <li>
                        <a href="{{ route('product_details', ['application_slug' => $product->application_slug, 'slug' => $product->slug]) }}">
                            {{ $product->product_name }} ({{ $product->application_name }})
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
        <hr>
    @endforeach
</div>
                </div>
            </div>
        </div>
    </section>
@endsection