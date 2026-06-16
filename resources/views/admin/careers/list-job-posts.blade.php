<div class="banner-section">
	<h4 class="box-title">List Job Posts</h4>
	<button class="btn btn-xs btn-primary" onclick="window.location.href = '{{route('admin.show_add_job_post')}}'">Add</button>
</div>
<div class="table-responsive">
	<table class="table table-bordered">
		<thead> 
			<tr> 
				<th>Sr No.</th>
				<th>Title</th>
				<th>Location</th>
				<th>Salary</th>
				<th>Action</th> 
			</tr> 
		</thead> 
		<tbody> 
			<?php $i = 1; ?>
			@if(COUNT($list_job_posts) > 0)
				@foreach($list_job_posts as $list_job_posts_ind)
					<tr> 
						<th scope="row">{{$i++}}</th>
						<td>{{ $list_job_posts_ind->title }}</td>
						<td>{{ $list_job_posts_ind->location }}</td>
						<td>{{ $list_job_posts_ind->salary }}</td>
						<td>
							<a href="{{route('admin.view_job_post_details')}}/{{$list_job_posts_ind->id}}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>

							<a href="javascript:void(0)" class="btn btn-xs btn-danger" title="Delete" onclick="confirm_delete({{$list_job_posts_ind->id}})"><i class="fa fa-trash" aria-hidden="true"></i></a>

							@if($list_job_posts_ind->status == 1)
								<a href="{{route('admin.deactivate_job_post')}}/{{$list_job_posts_ind->id}}" class="btn btn-xs btn-danger" title="Deactivate"><i class="fa fa-thumbs-down" aria-hidden="true"></i></a>
							@else
								<a href="{{route('admin.activate_job_post')}}/{{$list_job_posts_ind->id}}" class="btn btn-xs btn-success" title="Activate"><i class="fa fa-thumbs-up" aria-hidden="true"></i></a>
							@endif

							<script>
								function confirm_delete(id) 
								{
									var confirmation = confirm("Are you sure you want to delete this job post?");
									
									if(confirmation)
									{
										window.location.href = "{{route('admin.delete_job_post')}}/"+id;
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
				
