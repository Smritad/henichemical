@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Edit Job Post</u></h4>
						<div class="card-content">
						<form action="{{route('admin.edit_job_post')}}" method="post">
						{{csrf_field()}}
                            <input type="hidden" name="job_post_id" value="{{$fetch_job_post_details->id}}">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group row">
										<div class="col-md-12">
											<label>Title <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="title" placeholder="Enter Title" value="{{ $fetch_job_post_details->title }}" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-6">
											<label>Location <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="location" placeholder="Enter Location" value="{{ $fetch_job_post_details->location }}" required>
										</div>
										<div class="col-md-6">
											<label>Salary <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" name="salary" placeholder="Enter Salary" value="{{ $fetch_job_post_details->salary }}" required>
										</div>
									</div>
									<div class="form-group row">
										<div class="col-md-12">
											<label>Description <span class="text-danger"> *</span></label>
											<textarea class="form-control editor" name="description" id="description">{{ $fetch_job_post_details->description }}</textarea>
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
@endsection
