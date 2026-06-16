@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Edit Why ZON</u></h4>
						<div class="card-content">
						<form action="{{route('admin.edit_about_us_why_zon')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
                            <input type="hidden" name="why_zon_id" value="{{$fetch_about_us_why_zon_details->id}}">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group row">
										<div class="col-md-12">
											<label>Title <span class="text-danger"> *</span></label>
											<textarea class="form-control editor" name="title" id="title" placeholder="Enter Title">{{ $fetch_about_us_why_zon_details->title }}</textarea>
				
											@if ($errors->has('title'))
												<span class="text-danger">{{ $errors->first('title') }}</span>
											@endif
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-12">
											<label>Description <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="description" placeholder="Enter Description" value="{{ $fetch_about_us_why_zon_details->description }}">
				
											@if ($errors->has('description'))
												<span class="text-danger">{{ $errors->first('description') }}</span>
											@endif
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group row">
										<div class="col-md-12">
											<label>Image <span class="text-danger"> *</span></label>
											<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*">
											<input type="hidden" name="old_img_src" value="{{$fetch_about_us_why_zon_details->img_src}}">
				
											@if ($errors->has('img_src'))
												<span class="text-danger">{{ $errors->first('img_src') }}</span>
											@endif
				
											<div class="image-preview" id="img_preview">
												<img src="{{asset('public/assets/images/about-us-why-zon/'.$fetch_about_us_why_zon_details->img_src)}}" alt="Image">
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
			input.no-arrows::-webkit-inner-spin-button,
			input.no-arrows::-webkit-outer-spin-button 
			{
				-webkit-appearance: none;
				margin: 0;
			}

			.image-preview 
			{
				width: 200px;
				height: 200px;
				margin-top: 10px;
			}

			.image-preview img 
			{
				width: 100%;
				max-height: 100%;
				border: 1px solid #ccc;
			}
		</style>
@endsection
