@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Edit Event</u></h4>
						<div class="card-content">
						<form action="{{route('admin.edit_event')}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}}
                            <input type="hidden" name="event_id" value="{{$fetch_event_details->id}}">
							<div class="row">
								<div class="col-md-8">
									<div class="form-group row">
										<div class="col-md-12">
											<label>Title <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $fetch_event_details->title }}" required>

											<input type="hidden" class="form-control" name="slug" id="slug" value="{{$fetch_event_details->slug}}">
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label>Short Description <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="short_description" placeholder="Enter Short Description" value="{{ $fetch_event_details->short_description }}" required>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-6">
											<label>Event By <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="event_by" placeholder="Enter Event By" value="{{ $fetch_event_details->event_by }}" required>
										</div>
										<div class="col-md-6">
											<label>Event Date <span class="text-danger"> *</span></label>
											<input type="text" class="form-control custom-datepicker" name="event_date" placeholder="Select Event Date" value="{{ date( 'd-m-Y', strtotime($fetch_event_details->event_date)) }}" required>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-md-12">
											<label>Description <span class="text-danger"> *</span></label>
											<textarea class="form-control editor" name="description" id="description" required>{{ $fetch_event_details->description }}</textarea>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group row">
										<div class="col-md-12">
											<label>Image</label>
											<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*">
											<input type="hidden" name="old_img_src" value="{{$fetch_event_details->img_src}}">

											<div class="image-preview" id="img_preview">
												<img src="{{asset('public/assets/images/events/'.$fetch_event_details->img_src)}}" alt="Image">
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
				const title = document.getElementById("title");
				const slug = document.getElementById("slug");
				
				title.addEventListener("input", function() {
					const title_value = title.value;
					const slug_value = title_value
					.toLowerCase()
					.replace(/ /g, "-")
					.replace(/[^\w-]/g, "");
					
					slug.value = slug_value;
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
@endsection
