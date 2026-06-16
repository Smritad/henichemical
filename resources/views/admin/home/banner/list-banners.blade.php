<div class="banner-section">
	<h4 class="box-title">List Banners</h4>
	<button class="btn btn-xs btn-primary" onclick="window.location.href = '{{route('admin.show_add_banner')}}'">Add</button>
</div>
<div class="table-responsive">
	@if(COUNT($list_banners) > 0)
		@php $datatable = " datatable"; @endphp
	@else
		@php $datatable = ""; @endphp
	@endif

	<table class="table table-bordered {{ $datatable }}">
		<thead> 
			<tr> 
				<th>Sr No.</th>
				<th>Image</th>
				<th>Title One</th>
				<th>Title Two</th>
				<th>Action</th> 
			</tr> 
		</thead> 
		<tbody> 
			<?php $i = 1; ?>
			@if(COUNT($list_banners) > 0)
				@foreach($list_banners as $list_banners_ind)
					<tr> 
						<th scope="row">{{$i++}}</th>
						<td><img src="{{asset('public/assets/images/banners/'.$list_banners_ind->img_src)}}" style="width: 150px; height:100px;"></td>
						<td>{{ $list_banners_ind->title_one }}</td>
						<td>{{ $list_banners_ind->title_two }}</td>
						<td>
							<a href="{{route('admin.view_banner_details')}}/{{$list_banners_ind->id}}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

							<a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Delete" onclick="confirm_delete({{$list_banners_ind->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>

							@if($list_banners_ind->status == 1)
								<a href="{{route('admin.deactivate_banner')}}/{{$list_banners_ind->id}}" class="btn btn-xs btn-danger" title="Deactivate"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
							@else
								<a href="{{route('admin.activate_banner')}}/{{$list_banners_ind->id}}" class="btn btn-xs btn-success" title="Activate"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
							@endif

							<script>
								function confirm_delete(id) 
								{
									var confirmation = confirm("Are you sure you want to delete this banner?");
									
									if(confirmation)
									{
										window.location.href = "{{route('admin.delete_banner')}}/"+id;
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

<style>
	.banner-section 
	{
		display: flex;
		justify-content: space-between;
		align-items: center;
	}
</style>
				
