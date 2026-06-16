@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Add Certificate</u></h4>
						<div class="card-content">
							@if(session('success'))
								<div class="alert alert-success">{{ session('success') }}</div>
							@endif
							<form action="{{ route('admin.add_certificate') }}" method="post" enctype="multipart/form-data">
								{{ csrf_field() }}
								<div class="row">
									<div class="col-md-4">
										<div class="form-group row">
											<div class="col-md-12">
												<label>Image <span class="text-danger"> *</span></label>
												<input type="file" class="form-control" id="img_src" name="img_src" accept="image/*">
												@if ($errors->has('img_src'))
													<span class="text-danger">{{ $errors->first('img_src') }}</span>
												@endif
												<div class="image-preview" id="img_preview">
													<img src="" alt="Image" style="display:none;">
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
					if(img_src.files && img_src.files[0]) {
						const reader = new FileReader();
						reader.onload = function(e){
							const imgTag = img_preview.querySelector('img');
							imgTag.setAttribute('src', e.target.result);
							imgTag.style.display = 'block';
						};
						reader.readAsDataURL(img_src.files[0]);
					}
				});
			});
		</script>

		<style>
			.image-preview {
				width: 200px;
				height: 200px;
				margin-top: 10px;
			}
			.image-preview img {
				width: 100%;
				max-height: 100%;
				border: 1px solid #ccc;
			}
		</style>
	</div>
</div>
@endsection
