@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<h4 class="box-title">List Brands & Products</h4>
					<div class="table-responsive">
<div class="text-right mb-3">
    <button class="btn btn-xs btn-primary"
        onclick="window.location.href='{{ route('admin.show_add_product_listing', ['id' => $brand_id]) }}'">
        Add Product listing
    </button>
</div>
<br>
<br>
						<div class="col-md-2 mt-3">
						


						</div>

						<div class="col-md-12 mt-3">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>#</th>
										<th>Product Name</th>
										<th>Title</th>
										<th>Slug</th>
										<th>Actions</th>
									</tr>
								</thead>
<tbody>
    @forelse($listing_products as $index => $listing)
        <tr>
            <td>{{ $index + 1 }}</td>
            <td>{{ $listing->product_name }}</td>
            <td>{{ $listing->product_title }}</td>
            <td>{{ $listing->slug }}</td>
         <td>
    <div style="display: flex; gap: 5px; align-items: center;">
        <!-- Edit -->
        <a href="{{ route('admin.view_product_details_listing', $listing->id) }}"
           class="btn btn-xs btn-warning" title="Edit">
            <i class="fa fa-pencil"></i>
        </a>

        <!-- Delete -->
        <form action="{{ route('admin.delete_product_listing', $listing->id) }}" 
              method="POST" 
              style="margin: 0;" 
              onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-xs btn-danger" title="Delete">
                <i class="fa fa-trash"></i>
            </button>
        </form>

        <!-- Activate / Deactivate -->
        @if($listing->status == 1)
            <a href="{{ route('admin.deactivate_product_listing', $listing->id) }}"
               class="btn btn-xs btn-danger" title="Deactivate">
                <i class="fa fa-thumbs-down"></i>
            </a>
        @else
            <a href="{{ route('admin.activate_product_listing', $listing->id) }}"
               class="btn btn-xs btn-success" title="Activate">
                <i class="fa fa-thumbs-up"></i>
            </a>
        @endif
    </div>
</td>
        </tr>
    @empty
        <tr>
            <td colspan="5" class="text-center">No product listings found.</td>
        </tr>
    @endforelse
</tbody>
							</table>
						</div>
				
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