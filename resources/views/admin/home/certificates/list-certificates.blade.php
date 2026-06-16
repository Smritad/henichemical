<div class="banner-section">
    <h4 class="box-title">List Certificates</h4>
    <a href="{{ route('admin.show_add_certificate') }}" 
       class="btn btn-success btn-sm waves-effect waves-light">
       <i class="fa fa-plus"></i> Add Certificate
    </a>
</div>

<div class="table-responsive">
    <table class="table table-bordered">
        <thead> 
            <tr> 
                <th>Sr No.</th>
                <th>Image</th>
                <th>Date</th>
                <th>Action</th> 
            </tr> 
        </thead> 
        <tbody> 
            @php $i = 1; @endphp
            @if(count($list_certificates) > 0)
                @foreach($list_certificates as $certificate)
                    <tr> 
                        <th scope="row">{{ $i++ }}</th>
                        <td>
                            <img src="{{ asset('public/assets/images/certificates/'.$certificate->img_src) }}" 
                                 style="width: 150px; height:100px;">
                        </td>
                        <td>{{ date('d M Y', strtotime($certificate->created_at)) }}</td>
                        <td>
                            <!-- View certificate -->
                            <a href="{{ asset('public/assets/images/certificates/'.$certificate->img_src) }}" 
                               class="btn btn-xs btn-info" title="View" target="_blank">
                               <i class="fa fa-eye"></i>
                            </a>

                            <!-- Edit certificate -->
                            <a href="{{ route('admin.view_certificate_details', $certificate->id) }}" 
                               class="btn btn-xs btn-warning" title="Edit">
                               <i class="fa fa-pencil"></i>
                            </a>

                            <!-- Delete certificate -->
                            <a href="javascript:void(0)" 
                               class="btn btn-xs btn-danger" 
                               title="Delete" 
                               onclick="confirm_delete({{ $certificate->id }})">
                               <i class="fa fa-trash"></i>
                            </a>
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

<script>
    function confirm_delete(id) {
        if(confirm("Are you sure you want to delete this certificate?")) {
            // Correct route
            window.location.href = "{{ route('admin.delete_certificate', '') }}/" + id;
        }
    }
</script>


<style>
    .banner-section {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }
</style>
