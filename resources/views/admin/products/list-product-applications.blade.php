@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="banner-section">
						<h4 class="box-title">List Product Applications - {{ $product_name }}</h4>
					</div>

					{{-- Add Application Form --}}
					<div class="card-content">
						<form action="{{ route('admin.add_product_application') }}" method="post">
							{{ csrf_field() }}
							<input type="hidden" name="product_id" value="{{ $product_id }}">
							<div class="form-group row">
								<div class="col-md-6">
									<label>Select Application <span class="text-danger"> *</span></label>
									<select name="application_id" class="form-control" required>
										<option value="">Select Option</option>
										@foreach($list_applications as $list_applications_ind)
											<option value="{{ $list_applications_ind->id }}">{{ $list_applications_ind->application_name }}</option>
										@endforeach
									</select>
								</div>

								<div class="col-md-2">
									<button type="submit" name="submit" class="btn btn-primary" style="margin-top:15%;">Add Application</button>
								</div>
							</div>
						</form>
					</div>
					
					{{-- Applications Table --}}
					<div class="table-responsive mt-3">
						@if(count($list_product_applications) > 0)
							@php $datatable = "datatable"; @endphp
						@else
							@php $datatable = ""; @endphp
						@endif

						<table class="table table-bordered {{ $datatable }}">
							<thead>
								<tr>
									<th>Sr No.</th>
									<th>Application Name</th>
									<th>Added On</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@php $i = 1; @endphp
								@if(count($list_product_applications) > 0)
									@foreach($list_product_applications as $application)
										<tr>
											<th scope="row">{{ $i++ }}</th>
											<td>{{ $application->application_name }}</td>
											<td>{{ date('d M Y', strtotime($application->created_at)) }}</td>
											<td>
												<a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Delete"
												   onclick="confirm_delete({{ $application->id }})">
													<i class="fa fa-trash" aria-hidden="true"></i>
												</a>
												<script>
													function confirm_delete(id) {
														if(confirm("Are you sure you want to delete this product application?")) {
															window.location.href = "{{ route('admin.delete_product_application') }}/" + id;
														}
													}
												</script>
											</td>
										</tr>
									@endforeach
								@else
									<tr>
										<td colspan="4" class="text-danger text-center">List Is Empty!</td>
									</tr>
								@endif
							</tbody>
						</table>
					</div>

					{{-- ✅ Show Add Product Listing + Listing Table only if applications > 1 --}}
					<!--@if(count($list_product_applications) > 1)-->
					<!--	<div class="col-md-2 mt-3">-->
					<!--		<button class="btn btn-xs btn-primary"-->
					<!--			onclick="window.location.href='{{ route('admin.show_add_product_listing', ['id' => $brand_id]) }}'">-->
					<!--			Add Product listing-->
					<!--		</button>-->
					<!--	</div>-->

					<!--	<div class="col-md-12 mt-3">-->
					<!--		<table class="table table-bordered table-striped">-->
					<!--			<thead>-->
					<!--				<tr>-->
					<!--					<th>#</th>-->
					<!--					<th>Product Name</th>-->
					<!--					<th>Title</th>-->
					<!--					<th>Slug</th>-->
					<!--					<th>Actions</th>-->
					<!--				</tr>-->
					<!--			</thead>-->
					<!--			<tbody>-->
					<!--				@forelse($product_listings as $index => $listing)-->
					<!--					<tr>-->
					<!--						<td>{{ $index + 1 }}</td>-->
					<!--						<td>{{ $listing->product_name }}</td>-->
					<!--						<td>{{ $listing->product_title }}</td>-->
					<!--						<td>{{ $listing->slug }}</td>-->
					<!--					<td>-->
                                        <!-- Edit Button -->
     <!--                                   <a href="{{ route('admin.view_product_details_listing', $listing->id) }}"-->
     <!--                                      class="btn btn-xs btn-warning" title="Edit">-->
     <!--                                       <i class="fa fa-pencil" aria-hidden="true"></i>-->
     <!--                                   </a>-->
                                    
                                        <!-- Delete Button -->
     <!--                                   <form action="{{ route('admin.delete_product_listing', $listing->id) }}" -->
     <!--                                         method="POST" -->
     <!--                                         style="display:inline-block;"-->
     <!--                                         onsubmit="return confirm('Are you sure you want to delete this product?');">-->
     <!--                                       @csrf-->
     <!--                                       @method('DELETE')-->
     <!--                                       <button type="submit" class="btn btn-xs btn-danger" title="Delete">-->
     <!--                                           <i class="fa fa-trash"></i>-->
     <!--                                       </button>-->
     <!--                                   </form>-->
     <!--                               </td>-->

					<!--					</tr>-->
					<!--				@empty-->
					<!--					<tr>-->
					<!--						<td colspan="5" class="text-center">No product listings found.</td>-->
					<!--					</tr>-->
					<!--				@endforelse-->
					<!--			</tbody>-->
					<!--		</table>-->
					<!--	</div>-->
					<!--@endif-->

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

		if(brand_name){
			brand_name.addEventListener("input", function() {
				const brand_slug_value = brand_name.value.toLowerCase().replace(/ /g, "-").replace(/[^\w-]/g, "");
				brand_slug.value = brand_slug_value;
			});
		}

		if(application_name){
			application_name.addEventListener("input", function() {
				const application_slug_value = application_name.value.toLowerCase().replace(/ /g, "-").replace(/[^\w-]/g, "");
				application_slug.value = application_slug_value;
			});
		}
	});
</script>

<style>
	.banner-section {
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>
