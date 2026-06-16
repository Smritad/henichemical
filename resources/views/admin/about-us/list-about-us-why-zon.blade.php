<div class="banner-section">
	<h4 class="box-title">List Why ZON</h4>
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
			@if(COUNT($list_about_us_why_zon) > 0)
				@foreach($list_about_us_why_zon as $list_about_us_why_zon_ind)
					<tr> 
						<th scope="row">{{$i++}}</th>
						<th scope="row">{!! $list_about_us_why_zon_ind->title !!}</th>
						<td><img src="{{asset('public/assets/images/about-us-why-zon/'.$list_about_us_why_zon_ind->img_src)}}" style="width: 150px; height:100px;"></td>
						<td>
							<a href="{{route('admin.view_about_us_why_zon_details')}}/{{$list_about_us_why_zon_ind->id}}" class="btn btn-xs btn-warning" title="Edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
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
				
