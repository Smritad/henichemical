@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Add Job Post</u></h4>
						<div class="card-content">
							<form action="{{route('admin.add_job_post')}}" method="post">
							{{csrf_field()}}
								<div class="row">
									<div class="col-md-12">
										<div class="form-group row">
											<div class="col-md-12">
												<label>Title <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="title" placeholder="Enter Title" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-6">
												<label>Location <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="location" placeholder="Enter Location" required>
											</div>
											<div class="col-md-6">
												<label>Salary <span class="text-danger"> *</span></label>
												<input type="text" class="form-control" name="salary" placeholder="Enter Salary" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Descripiton <span class="text-danger"> *</span></label>
												<textarea class="form-control editor" name="description" id="description" required></textarea>
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
