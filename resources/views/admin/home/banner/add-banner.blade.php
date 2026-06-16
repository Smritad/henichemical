@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Add Brochure</u></h4>
						<div class="card-content">
							<form action="{{route('admin.add_banner')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
								<div class="row">
									<div class="col-md-8">
										<div class="form-group row">
											<div class="col-md-12">
												<label>Title One <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="title_one" placeholder="Enter Title One" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Title Two <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="title_two" placeholder="Enter Title Two" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>URL <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="link" placeholder="Enter URL" required>
											</div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group row">
											<div class="col-md-12">
												<label>Image <span class="text-danger"> *</span></label>
												<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*" required>

												<div class="image-preview" id="img_preview">
													<img src="{{asset('public/assets/images/placeholder-image.webp')}}" alt="Image">
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
