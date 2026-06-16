@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="table-responsive">
						<div style="display: flex; justify-content: space-between; align-items: center;">
							<h4 class="box-title">List Job Enquiry</h4>
							
							<form method="GET" action="{{ route('admin.list_job_enquiry') }}" style="display: flex; gap: 10px;">
							    <input type="date" name="from_date" class="form-control" placeholder="From Date" value="{{ request('from_date') }}">
                                <input type="date" name="to_date" class="form-control" placeholder="To Date" value="{{ request('to_date') }}">
                                <select name="job_title" class="form-control">
                                    <option value="">Select Job Title</option>
                                    @foreach($job_posts as $job_post)
                                        <option value="{{ $job_post }}" {{ request('job_title') == $job_post ? 'selected' : '' }}>{{ $job_post }}</option>
                                    @endforeach
                                </select>
                                <button type="submit" class="btn btn-sm btn-primary">Filter</button>
                            </form>

							@if(COUNT($list_job_enquiry) > 0)
								<a href="{{ route('admin.export_job_enquiry', request()->query()) }}" class="btn btn-sm btn-primary">Export to Excel</a>
							@endif
						</div>

						@if(COUNT($list_job_enquiry) > 0)
							@php $datatable = " datatable"; @endphp
						@else
							@php $datatable = ""; @endphp
						@endif
	<form action="{{ route('admin.list_brochure_enquiry_delete') }}" method="POST" id="bulkDeleteForm">
@csrf
@method('DELETE')

@if(auth()->check() && auth()->user()->is_admin == 1)
<div style="margin-bottom:10px;">
    <button type="submit" class="btn btn-danger btn-sm"
        onclick="return confirm('Are you sure you want to delete selected enquiries?')">
        Delete Selected
    </button>
</div>
@endif

<table class="table table-bordered {{ $datatable }}">
<thead> 
<tr>

@if(auth()->check() && auth()->user()->is_admin == 1)
<th>
    <input type="checkbox" id="selectAll">
</th>
@endif

<th>Sr No.</th>
<th>Job Title</th>
<th>Name</th>
<th>Email</th>
<th>Mobile No.</th>
<th>About</th>
<th>Date</th>
<th>CV</th>

</tr> 
</thead> 

<tbody> 
<?php $i = 1; ?>

@if(COUNT($list_job_enquiry) > 0)

@foreach($list_job_enquiry as $list_job_enquiry_ind)

<tr>

@if(auth()->check() && auth()->user()->is_admin == 1)
<td>
<input type="checkbox" name="ids[]" value="{{ $list_job_enquiry_ind->id }}">
</td>
@endif

<th scope="row">{{$i++}}</th>
<td>{{ $list_job_enquiry_ind->job_title }}</td>
<td>{{ $list_job_enquiry_ind->name }}</td>
<td>{{ $list_job_enquiry_ind->email }}</td>
<td>{{ $list_job_enquiry_ind->mobile_no }}</td>
<td>{{ $list_job_enquiry_ind->about }}</td>
<td>{{ date('d M Y', strtotime($list_job_enquiry_ind->created_at)) }}</td>
<td>
<a href="{{ asset('public/assets/documents/cv/'.$list_job_enquiry_ind->document_src) }}" class="btn btn-sm btn-primary" target="_blank">
View Document
</a>
</td>

</tr>

@endforeach

@else

<tr>
<td colspan="9" class="text-danger text-center">List Is Empty!</td>
</tr>

@endif

</tbody> 
</table>

</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script>

document.getElementById('selectAll').addEventListener('click', function() {

    let checkboxes = document.querySelectorAll('.rowCheckbox');

    checkboxes.forEach(function(checkbox) {
        checkbox.checked = event.target.checked;
    });

});

</script>