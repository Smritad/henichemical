<div class="card-content">
	<form action="{{route('admin.update_about_us_history')}}" method="post" enctype="multipart/form-data">
		{{csrf_field()}}
		@if($fetch_about_us_history_details)
			<div class="row">
				<div class="col-md-8">
					<div class="form-group row">
						<div class="col-md-12">
							<label>Description <span class="text-danger"> *</span></label>
							<textarea class="form-control editor" name="description" id="description" rows="5">{{$fetch_about_us_history_details->description}}</textarea>

							@if ($errors->has('description'))
								<span class="text-danger">{{ $errors->first('description') }}</span>
							@endif
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group row">
						<div class="col-md-12">
							<label>Image <span class="text-danger"> </span></label>
							<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*">
							<input type="hidden" name="old_img_src" value="{{$fetch_about_us_history_details->img_src}}">

							@if ($errors->has('img_src'))
								<span class="text-danger">{{ $errors->first('img_src') }}</span>
							@endif

							<div class="image-preview" id="img_preview">
								<img src="{{asset('public/assets/images/about-us-history/'.$fetch_about_us_history_details->img_src)}}" alt="Image">
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
		@else
			<div class="row">
				<div class="col-md-8">
					<div class="form-group row">
						<div class="col-md-12">
							<label>Description <span class="text-danger"> *</span></label>
							<textarea class="form-control editor" name="description" id="description1" rows="5"></textarea>

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

							@if ($errors->has('img_src'))
								<span class="text-danger">{{ $errors->first('img_src') }}</span>
							@endif

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
		@endif
	</form>
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
<script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
 
    <script>
  ClassicEditor
    .create(document.querySelector('#description'))
    .catch(error => {
      console.error(error);
    });
</script>


<style>
	.banner-section 
	{
		display: flex;
		justify-content: space-between;
		align-items: center;
	}

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
				
