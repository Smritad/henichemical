@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Update Basic Details</u></h4>
						<div class="card-content">
							<form action="{{route('admin.update_basic_details')}}" method="post" enctype="multipart/form-data">
							{{csrf_field()}}
								<div class="row">
									<div class="col-md-12">
										<div class="form-group row">
											<div class="col-md-6">
												<label>Email</label>
												<input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{$fetch_basic_details->email}}" required>
											</div>
											<div class="col-md-6">
												<label>Mobile No.</label>
												<input type="text" class="form-control" name="mobile_no" placeholder="Enter Mobile Number" oninput="this.value = this.value.replace(/[^0-9]/g, '');
												if (this.value.length < 10) { this.setCustomValidity('Please enter at least 10 digits.'); }
												else { this.setCustomValidity(''); }" minlength="10" maxlength="12" value="{{$fetch_basic_details->mobile_no}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-6">
												<label>Enquiry Email</label>
												<input type="email" class="form-control" name="enquiry_email" placeholder="Enter Enquiry Email" value="{{$fetch_basic_details->enquiry_email}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Head Office Address Iframe Link</label>
												<input type="text" class="form-control" name="head_office_address_iframe_link" placeholder="Enter Head Office Address Iframe Link" value="{{$fetch_basic_details->head_office_address_iframe_link}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Site Location Iframe Link</label>
												<input type="text" class="form-control" name="site_location_iframe_link" placeholder="Enter Site Location Iframe Link" value="{{$fetch_basic_details->site_location_iframe_link}}" required>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Linkedin Link</label>
												<input type="text" class="form-control" name="linkedin_link" placeholder="Enter Linkedin Link" value="{{$fetch_basic_details->linkedin_link}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Facebook Link</label>
												<input type="text" class="form-control" name="facebook_link" placeholder="Enter Facebook Link" value="{{$fetch_basic_details->facebook_link}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Instagram Link</label>
												<input type="text" class="form-control" name="instagram_link" placeholder="Enter Instagram Link" value="{{$fetch_basic_details->instagram_link}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Youtube Link</label>
												<input type="text" class="form-control" name="youtube_link" placeholder="Enter Youtube Link" value="{{$fetch_basic_details->youtube_link}}">
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Head Office Address</label>
												<textarea class="form-control editor" name="head_office_address" id="head_office_address" placeholder="Enter Head Office Address" required>{{$fetch_basic_details->head_office_address}}</textarea>
											</div>
										</div>
										<div class="form-group row">
											<div class="col-md-12">
												<label>Site Location</label>
												<textarea class="form-control editor" name="site_location" id="site_location" placeholder="Enter Site Location" required>{{$fetch_basic_details->site_location}}</textarea>
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