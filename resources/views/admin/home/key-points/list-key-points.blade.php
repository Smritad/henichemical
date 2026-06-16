<div class="banner-section">
	<h4 class="box-title">List Key Points</h4>
</div>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead> 
			<tr> 
				<th>Sr No.</th>
				<th>Title</th>
				<th>Image</th>
				<th>Action</th> 
			</tr> 
		</thead> 
		<tbody> 
			<?php $i = 1; ?>
			@if(COUNT($list_key_points) > 0)
				@foreach($list_key_points as $list_key_points_ind)
					<tr> 
						<th scope="row">{{$i++}}</th>
						<th scope="row">{!! $list_key_points_ind->title !!}</th>
						<td><img src="{{asset('public/assets/images/key-points/'.$list_key_points_ind->img_src)}}" style="width: 150px; height:100px;"></td>
						<td>
							<a href="{{route('admin.view_key_point_details')}}/{{$list_key_points_ind->id}}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
						</td> 
					</tr> 
				@endforeach
			@else
				<tr>
					<td colspan="4" class="text-danger text-center">List Is Empty!</td>
				</tr>
			@endif
		</tbody> 
	</table>
</div>

<style>
	.banner-section 
	{
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>
				
