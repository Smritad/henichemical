@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">List Brochures</h4>
					<div class="table-responsive">

						@if(COUNT($list_brochures) > 0)
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
									<th>Date</th>
									<th>Action</th> 
								</tr> 
							</thead> 
							<tbody> 
								<?php $i = 1; ?>
								@if(COUNT($list_brochures) > 0)
									@foreach($list_brochures as $list_brochures_ind)
										<tr> 
											<th scope="row">{{$i++}}</th>
											<td><img src="{{asset('public/assets/images/brochures/'.$list_brochures_ind->img_src)}}" style="width: 150px; height:100px;"></td>
											<td>{{$list_brochures_ind->title}}</td>
											<td>{{date('d M Y', strtotime($list_brochures_ind->created_at))}}</td>
											<td>
												<a href="{{route('admin.view_brochure_details')}}/{{$list_brochures_ind->id}}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

												<a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Delete" onclick="confirm_delete({{$list_brochures_ind->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>

												@if($list_brochures_ind->status == 1)
													<a href="{{route('admin.deactivate_brochure')}}/{{$list_brochures_ind->id}}" class="btn btn-xs btn-danger" title="Deactivate"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
												@else
													<a href="{{route('admin.activate_brochure')}}/{{$list_brochures_ind->id}}" class="btn btn-xs btn-success" title="Activate"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
												@endif

												<script>
													function confirm_delete(id) 
													{
														var confirmation = confirm("Are you sure you want to delete this brochure?");
														
														if(confirmation)
														{
															window.location.href = "{{route('admin.delete_brochure')}}/"+id;
														}
													}
												</script>
											</td> 
										</tr> 
									@endforeach
								@else
									<tr>
										<td colspan="5" class="text-danger text-center">List Is Empty!</td>
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
				
