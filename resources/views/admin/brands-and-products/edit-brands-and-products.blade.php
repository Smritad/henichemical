@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Edit Brands & Products</u></h4>
						<div class="card-content">
						<form action="{{route('admin.edit_brands_and_products')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
                            <input type="hidden" name="brands_and_products_id" value="{{$fetch_brands_and_products_details->id}}">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group row">
										<div class="col-md-6">
											<label>Brand Name <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="brand_name" id="brand_name" placeholder="Enter Brand Name" value="{{ $fetch_brands_and_products_details->brand_name }}" required>

											<input type="hidden" class="form-control" name="brand_slug" id="brand_slug" value="{{$fetch_brands_and_products_details->brand_slug}}">
										</div>

										<div class="col-md-6">
											<label>Application Name <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="application_name" id="application_name" placeholder="Enter Application Name" value="{{ $fetch_brands_and_products_details->application_name }}" required>

											<input type="hidden" class="form-control" name="application_slug" id="application_slug" value="{{$fetch_brands_and_products_details->application_slug}}">
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label>Short Description <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="short_description" placeholder="Enter Short Description" value="{{ $fetch_brands_and_products_details->short_description }}" required>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label>Description <span class="text-danger"> *</span></label>
											<textarea class="form-control editor" name="description" id="description" required>{{ $fetch_brands_and_products_details->description }}</textarea>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group row">
										<div class="col-md-12">
											<label>Image</label>
											<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*">
											<input type="hidden" name="old_img_src" value="{{$fetch_brands_and_products_details->img_src}}">

											<div class="image-preview" id="img_preview">
												<img src="{{asset('public/assets/images/brands-and-products/'.$fetch_brands_and_products_details->img_src)}}" alt="Image">
											</div>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label>Icon Image</label>
											<input type="file" class="form-control" id="icon_img_src" name="icon_img_src" accept="image/*">
											<input type="hidden" name="old_icon_img_src" value="{{$fetch_brands_and_products_details->icon_img_src}}">

											<div class="icon-image-preview" id="icon_img_preview">
												<img src="{{asset('public/assets/images/brands-and-products/'.$fetch_brands_and_products_details->icon_img_src)}}" alt="Image">
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-12">
									<button type="submit" name="submit" class="btn btn-primary btn-sm waves-effect waves-light">Submit</button>
								</div>
							</div>
						</form>
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

				//	Image Upload
				const img_src = document.getElementById('img_src');
				const img_preview = document.getElementById('img_preview');

				img_src.addEventListener('change', function () {
					preview_image(img_src, img_preview);
				});

				function preview_image(input, preview) 
				{
					if(input.files && input.files[0]) 
					{
						const reader = new FileReader();
						reader.onload = function(e){
							preview.querySelector('img').setAttribute('src', e.target.result);
						};
						reader.readAsDataURL(input.files[0]);
					}
				}

				//	Icon Image Upload
				const icon_img_src = document.getElementById('icon_img_src');
				const icon_img_preview = document.getElementById('icon_img_preview');

				icon_img_src.addEventListener('change', function () {
					preview_icon_image(icon_img_src, icon_img_preview);
				});

				function preview_icon_image(input, preview) 
				{
					if(input.files && input.files[0]) 
					{
						const reader = new FileReader();
						reader.onload = function(e){
							preview.querySelector('img').setAttribute('src', e.target.result);
						};
						reader.readAsDataURL(input.files[0]);
					}
				}
			});
		</script>

		<style>
			.image-preview 
			{
				width: 100%;
				height: 200px;
				margin-top: 10px;
			}

			.image-preview img 
			{
				max-width: 100%;
				max-height: 100%;
				border: 1px solid #ccc;
			}

			.icon-image-preview 
			{
				width: 100%;
				height: 200px;
				margin-top: 10px;
			}

			.icon-image-preview img 
			{
				max-width: 100%;
				max-height: 100%;
				border: 1px solid #ccc;
			}
		</style>
@endsection
