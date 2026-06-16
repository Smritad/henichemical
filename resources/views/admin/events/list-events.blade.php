@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">List Events</h4>
					<div class="table-responsive">

						@if(COUNT($list_events) > 0)
							@php $datatable = " datatable"; @endphp
						@else
							@php $datatable = ""; @endphp
						@endif

						<table class="table table-bordered {{ $datatable }}">
							<thead> 
								<tr> 
									<th>Sr No.</th>
									<th>Image</th>
									<th>Title</th>
									<th>Event By</th>
									<th>Event Date</th>
									<th>Action</th> 
								</tr> 
							</thead> 
							<tbody> 
								<?php $i = 1; ?>
								@if(COUNT($list_events) > 0)
									@foreach($list_events as $list_events_ind)
										<tr> 
											<th scope="row">{{$i++}}</th>
											<td><img src="{{asset('public/assets/images/events/'.$list_events_ind->img_src)}}" style="width: 150px; height:100px;"></td>
											<td>{{ $list_events_ind->title }}</td>
											<td>{{ $list_events_ind->event_by }}</td>
											<td>{{ date('d M Y', strtotime($list_events_ind->event_date)) }}</td>
											<td>
												<a href="{{route('admin.view_event_details')}}/{{$list_events_ind->id}}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
	
												<a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Delete" onclick="confirm_delete({{$list_events_ind->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>
	
												@if($list_events_ind->status == 1)
													<a href="{{route('admin.deactivate_event')}}/{{$list_events_ind->id}}" class="btn btn-xs btn-danger" title="Deactivate"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
												@else
													<a href="{{route('admin.activate_event')}}/{{$list_events_ind->id}}" class="btn btn-xs btn-success" title="Activate"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
												@endif

												<!--@if($list_events_ind->is_featured == 1)
													<a href="{{route('admin.remove_featured_event', ['id' => $list_events_ind->id])}}" class="btn btn-xs btn-danger" title="Remove Featured"><i class="fa fa-star" aria-hidden="true"></i></a>
												
												@elseif($featured_count < 2)
													
													<a href="{{route('admin.mark_featured_event', ['id' => $list_events_ind->id])}}" class="btn btn-xs btn-success" title="Mark As Featured"><i class="fa fa-star" aria-hidden="true"></i></a>
												@endif-->
	
												<script>
													function confirm_delete(id) 
													{
														var confirmation = confirm("Are you sure you want to delete this event?");
														
														if(confirmation)
														{
															window.location.href = "{{route('admin.delete_event')}}/"+id;
														}
													}
												</script>
											</td> 
										</tr> 
									@endforeach
								@else
									<tr>
										<td colspan="6" class="text-danger text-center">List Is Empty!</td>
									</tr>
								@endif
							</tbody> 
						</table>
					</div>
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
	});
</script>