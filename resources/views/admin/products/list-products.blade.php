@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="banner-section">
						<h4 class="box-title">List Products - {{ $application_name }} ({{ $brand_name }})</h4>
						<button class="btn btn-xs btn-primary" onclick="window.location.href = '{{route('admin.show_add_product', ['id' => $brand_id])}}'">Add Product</button>
						<!--<button class="btn btn-xs btn-primary" onclick="window.location.href = '{{route('admin.show_add_product_listing', ['id' => $brand_id])}}'">Add Product listing</button>-->
<br><br>
					</div>
					
					<div class="table-responsive">

						@if(COUNT($list_products) > 0)
							@php $datatable = " datatable"; @endphp
						@else
							@php $datatable = ""; @endphp
						@endif

						<table class="table table-bordered {{ $datatable }}">
							<thead> 
								<tr> 
									<th>Sr No.</th>
									<!--<th>Image</th>-->
									<th>Info Image</th>
									<th>Product Name</th>
									<th>Added On</th>
									<th>Action</th> 
								</tr> 
							</thead> 
							<tbody> 
								<?php $i = 1; ?>
								@if(COUNT($list_products) > 0)
									@foreach($list_products as $list_products_ind)
										<tr> 
											<th scope="row">{{$i++}}</th>
											@php
    // Try product_listing image first
    $productImage = DB::table('products_listing')
                        ->where('id', $list_products_ind->id)
                        ->value('product_image');

    // If not found, check in products table
    if (!$productImage) {
        $productImage = DB::table('products')
                        ->where('id', $list_products_ind->id)
                        ->value('product_image');
    }
@endphp

<!--<td>-->
<!--    @if($productImage)-->
<!--        <img src="{{ asset('public/assets/images/products/'.$productImage) }}" style="width: 150px; height:100px;">-->
<!--    @else-->
<!--        <span>No Image</span>-->
<!--    @endif-->
<!--</td>-->

											<td><img src="{{asset('public/assets/images/products/info/'.$list_products_ind->product_info_image)}}" style="width: 150px; height:100px;"></td>
											<td>{{ $list_products_ind->product_name }}</td>
											<td>{{ date('d M Y', strtotime($list_products_ind->created_at)) }}</td>
											<td>
											    <a href="{{route('admin.list_product_applications')}}/{{$list_products_ind->id}}" class="btn btn-xs btn-primary" title="Other Applications"><i class="fa fa-list" aria-hidden="true"></i></a>
											    

                                                    <a href="{{ route('admin.view_product_details', $list_products_ind->id) }}" 
                                                       class="btn btn-xs btn-warning" title="Edit">
                                                       <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </a>

	
												<a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Delete" onclick="confirm_delete({{$list_products_ind->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
	
												@if($list_products_ind->status == 1)
													<a href="{{route('admin.deactivate_product')}}/{{$list_products_ind->id}}" class="btn btn-xs btn-danger" title="Deactivate"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
												@else
													<a href="{{route('admin.activate_product')}}/{{$list_products_ind->id}}" class="btn btn-xs btn-success" title="Activate"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
												@endif
	
												<script>
													function confirm_delete(id) 
													{
														var confirmation = confirm("Are you sure you want to delete this product?");
														
														if(confirmation)
														{
															window.location.href = "{{route('admin.delete_product')}}/"+id;
														}
													}
												</script>
											</td> 
										</tr> 
									@endforeach
								@else
									<tr>
										<td colspan="5" class="text-danger text-center">List Is Empty!</td>
									</tr>
								@endif
							</tbody> 
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		const brand_name = document.getElementById("brand_name");
		const brand_slug = document.getElementById("brand_slug");
		const application_name = document.getElementById("application_name");
		const application_slug = document.getElementById("application_slug");
		
		brand_name.addEventListener("input", function() {
			const brand_name_value = brand_name.value;
			const brand_slug_value = brand_name_value
			.toLowerCase()
			.replace(/ /g, "-")
			.replace(/[^\w-]/g, "");
			
			brand_slug.value = brand_slug_value;
		});

		application_name.addEventListener("input", function() {
			const application_name_value = application_name.value;
			const application_slug_value = application_name_value
			.toLowerCase()
			.replace(/ /g, "-")
			.replace(/[^\w-]/g, "");
			
			application_slug.value = application_slug_value;
		});
	});
</script>

<style>
	.banner-section 
	{
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>