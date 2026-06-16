@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Edit Banner</u></h4>
						<div class="card-content">
							<form action="{{route('admin.edit_banner')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
								<input type="hidden" name="banner_id" value="{{$fetch_banner_details->id}}">
								<div class="row">
									<div class="col-md-8">
										<div class="form-group row">
											<div class="col-md-12">
												<label>Title One <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="title_one" placeholder="Enter Title One" value="{{$fetch_banner_details->title_one}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Title Two <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="title_two" placeholder="Enter Title Two" value="{{$fetch_banner_details->title_two}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>URL <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="link" placeholder="Enter URL" value="{{$fetch_banner_details->link}}" required>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group row">
											<div class="col-md-12">
												<label>Image</label>
												<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*">
												<input type="hidden" name="old_img_src" value="{{$fetch_banner_details->img_src}}">

												<div class="image-preview" id="img_preview">
													<img src="{{asset('public/assets/images/banners/'.$fetch_banner_details->img_src)}}" alt="Image">
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
			document.addEventListener('DOMContentLoaded', function () {
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
		</style>
