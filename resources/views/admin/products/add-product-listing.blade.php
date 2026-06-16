@extends('layouts.admin-header')

@section('content')
<style>
hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #4c4747;
}
</style>

<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Add Product listing</u></h4>
						<div class="card-content">
						    @if(session('success'))
    <script>
        alert("{{ session('success') }}");
    </script>
@endif

@if(session('error'))
    <script>
        alert("{{ session('error') }}");
    </script>
@endif

<form action="{{ route('admin.add_product_listing') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="brand_id" value="{{ $brand_id }}">

    <!-- Section 1: Basic Info -->
    <div class="mb-5 border-bottom pb-3" >
        <h4 class="mb-3">Section 1: Basic Info</h4>
        <div class="row g-3">
            
<div class="col-md-6">
    <label>Product Name</label>
    <select class="form-control" id="product_select" name="product_id" required>
        <option value="">Select Product</option>
        @foreach($products_with_multiple_brands as $product)
            <option value="{{ $product->id }}">{{ $product->product_name }}</option>
        @endforeach
    </select>
</div>


            <div class="col-md-6">
                <label>Brand No.</label>
                <input type="text" class="form-control" name="brand_no" placeholder="Enter Brand Number" oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            </div>
            <div class="col-md-6" style="margin-top: 25px;">
                <label>Product Type</label>
                <select class="form-control" name="product_type">
                    <option value="">Select Option</option>
                    <option value="API">API</option>
                    <option value="Lipophilic Excipients">Lipophilic Excipients</option>
                    <option value="Ester">Ester</option>
                </select>
            </div>
            <div class="col-md-6" style="margin-top: 25px;">
    <label>Product Name</label>
    <input type="text" class="form-control" id="product_name_input" name="product_name" placeholder="Enter Product Name" readonly required>
</div>

<script>
    // When the dropdown value changes
    document.getElementById('product_select').addEventListener('change', function() {
        var selectedText = this.options[this.selectedIndex].text; // get selected product name
        document.getElementById('product_name_input').value = selectedText; // fill the input field
    });
</script>
            
            <div class="col-md-12" style="margin-top: 25px;">
                <label>Product Title</label>
                <input type="text" class="form-control" name="product_title" placeholder="Enter Product Title">
            </div>
           <div class="col-md-12" style="margin-top: 25px;">
    <label>Product Image</label>
    <input type="file" class="form-control" name="product_image" accept="image/*" required onchange="previewImage(event)">
    <div style="margin-top: 15px;">
        <img id="imagePreview" src="" alt="Preview will appear here" style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
    </div>
</div>


        </div>
    </div>
<hr class="my-4">

    <!-- Section 2: Product Information -->
    <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
        <h4 class="mb-3">Section 2: Product Information</h4>
        <div class="row g-3">
           
            <div class="col-md-6">
                <label>Description</label>
                <textarea class="form-control editor" id="editor" name="product_info_description" id="editor4"></textarea>
            </div>
        </div>
    </div>
<hr class="my-4">

   <!-- Section 3: Our Grades -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 3: Our Grades</h4>
    
    <div class="mb-2">
        <label>Heading</label>
        <input type="text" class="form-control" name="grades_heading" placeholder="Enter Heading">
    </div>
    
    <div class="mb-2" style="margin-top: 25px;">
        <label>Description</label>
        <input type="text" class="form-control" name="grades_description" placeholder="Enter Description">
    </div>
    @php
$applications = DB::table('brands_and_products')
    ->where('id', '!=', 9)
    ->pluck('application_name');
@endphp
@php
$brands = DB::table('brands_and_products as bp')
    ->join('products as p', 'p.brand_id', '=', 'bp.id')
    ->select('bp.id as brand_id', 'bp.brand_name', 'p.brand_no')
    ->get();
@endphp
    <table class="table table-bordered" id="grades_table">
        <thead>
            <tr>
                 <th>Title</th>
                <th>Brand</th>
                <th>Icon</th>
                <th>Description</th>
                <th>
                    <button type="button" class="btn btn-sm btn-success" onclick="addGrade()">+</button>
                </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function addGrade() {
        let row = `
            <tr>
            <td>
                    <input type="text" class="form-control" name="grades[title][]" placeholder="Title">
                </td>
                <td>
                    <input type="text" class="form-control" name="grades[brand][]" placeholder="Brand">
                </td>
                <td>
                    <input type="file" name="features_icon[]" class="form-control" accept="image/*,.svg,.webp" onchange="previewFeatureImage(event, this)">
                    <img src="" alt="Preview" style="max-width: 80px; margin-top: 8px; display: none; border: 1px solid #ddd; padding: 3px; border-radius: 5px;">
                </td>
                
                <td>
                    <input type="text" class="form-control" name="grades[description][]" placeholder="Description">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button>
                </td>
            </tr>
        `;
        document.querySelector("#grades_table tbody").insertAdjacentHTML('beforeend', row);
    }

    function removeRow(btn) {
        btn.closest("tr").remove();
    }

    function previewFeatureImage(event, input) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(){
                let img = input.nextElementSibling; // the <img> just after input
                img.src = reader.result;
                img.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
    }
</script>
<hr class="my-4">


<!-- Section 4: What Makes Us Unique -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 4: What Makes Us Unique</h4>
    
     <div class="mb-2">
        <label>Heading</label>
        <input type="text" class="form-control" name="unique_heading" placeholder="Enter Heading">
    </div>
    
    <div class="mb-2">
        <label>Description</label>
        <input type="text" class="form-control" name="unique_description" placeholder="Enter Description">
    </div>
    
    <div class="mb-2">
        <label>title</label>
        <input type="text" class="form-control" name="unique_title" placeholder="Enter title">
    </div>
    
    <table class="table table-bordered" id="unique_table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Title</th>
                <th>Description</th>
                <th>
                    <button type="button" class="btn btn-sm btn-success" onclick="addUnique()">+</button>
                </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function addUnique() {
        let row = `
            <tr>
                <td>
                    <input type="file" name="unique[icon][]" class="form-control" accept="image/*,.svg,.webp" onchange="previewUniqueImage(event, this)">
                    <img src="" alt="Preview" style="max-width: 80px; margin-top: 8px; display: none; border: 1px solid #ddd; padding: 3px; border-radius: 5px;">
                </td>
                <td>
                    <input type="text" class="form-control" name="unique[title][]" placeholder="Title">
                </td>
                <td>
                    <input type="text" class="form-control" name="unique[description][]" placeholder="Description">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button>
                </td>
            </tr>
        `;
        document.querySelector("#unique_table tbody").insertAdjacentHTML('beforeend', row);
    }

    function removeRow(btn) {
        btn.closest("tr").remove();
    }

    function previewUniqueImage(event, input) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function(){
                let img = input.nextElementSibling; // <img> right after input
                img.src = reader.result;
                img.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
    }
</script>

<hr class="my-4">


<!-- Section 5: Our Certifications -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 5: Our Certifications</h4>
    
    <div class="mb-2">
        <label>Heading</label>
        <input type="text" class="form-control" name="certification_heading" placeholder="Enter Heading">
    </div>
    
    <div class="mb-2">
        <label>Description</label>
        <input type="text" class="form-control" name="certification_description" placeholder="Enter Description">
    </div>
    
    <table class="table table-bordered" id="certification_table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>
                    <button type="button" class="btn btn-sm btn-success" onclick="addCertification()">+</button>
                </th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>

<script>
    function addCertification() {
        let row = `
            <tr>
                <td>
                    <input type="file" name="certification[image][]" class="form-control" accept="image/*,.svg,.webp" onchange="previewCertificationImage(event, this)">
                    <img src="" alt="Preview" style="max-width: 80px; margin-top: 8px; display: none; border: 1px solid #ddd; padding: 3px; border-radius: 5px;">
                </td>
                <td>
                    <input type="text" class="form-control" name="certification[title][]" placeholder="Title">
                </td>
                <td>
                    <input type="text" class="form-control" name="certification[description][]" placeholder="Description">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button>
                </td>
            </tr>
        `;
        document.querySelector("#certification_table tbody").insertAdjacentHTML('beforeend', row);
    }

    function removeRow(btn) {
        btn.closest("tr").remove();
    }

    function previewCertificationImage(event, input) {
        let file = event.target.files[0];
        if (file) {
            let reader = new FileReader();
            reader.onload = function () {
                let img = input.nextElementSibling; // the <img> just after input
                img.src = reader.result;
                img.style.display = "block";
            }
            reader.readAsDataURL(file);
        }
    }
</script>


   

   <hr class="my-4">


   <!-- Section 6: Why Choose -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 6: Why Choose</h4>
    <textarea class="form-control editor" name="why_choose_description" id="editor1"></textarea>

    <input type="file" class="form-control mt-2" name="why_choose_image" accept="image/*" onchange="previewWhyChoose(event)">

    <!-- Preview Container -->
    <div style="margin-top: 10px;">
        <img id="whyChoosePreview" src="" alt="Preview will appear here" style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
    </div>
</div>

<script>
function previewWhyChoose(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('whyChoosePreview');
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>


<hr class="my-4">


 <!-- Section 7: Safety & Handling -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 7: Handling and Packaging</h4>
    <textarea class="form-control editor" name="safety_description" id="editor2"></textarea>

    <input type="file" class="form-control mt-2" name="safety_image" accept="image/*" onchange="previewSafetyImage(event)">

    <!-- Preview -->
    <div style="margin-top: 10px;">
        <img id="safetyImagePreview" src="" alt="Preview will appear here" 
             style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
    </div>
</div>

<script>
function previewSafetyImage(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('safetyImagePreview');
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>

<hr class="my-4">


<!-- Section 8: Looking to Buy -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 8: Looking to Buy</h4>
    <textarea class="form-control editor" name="buy_description" id="editor3"></textarea>
</div>
<hr class="my-4">

    <!-- Section 9: Get a Quote -->
    <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
        <h4 class="mb-3">Section 9: Get a Quote</h4>
        <input type="text" class="form-control mb-2" name="quote_title" placeholder="Title">
        <textarea class="form-control mb-2" name="quote_description" placeholder="Description"></textarea>
        <input type="text" class="form-control mb-2" name="quote_contact" placeholder="Contact Number">
        <input type="email" class="form-control mb-2" name="quote_email" placeholder="Email">
    </div>
<hr class="my-4">

    <!-- Section 10: FAQs -->
    <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
        <h4 class="mb-3">Section 10: FAQs</h4>
        <div class="mb-2">
            <label>Heading</label>
            <input type="text" class="form-control" name="faqs_heading" placeholder="Enter Faqs Heading">
        </div>
        <table class="table table-bordered" id="faqs_table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Answer</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addFaq()">+</button></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
<hr class="my-4">
<!-- Meta Title -->
        <div class="mb-3">
            <label for="meta_title" class="form-label">
                Meta Title
            </label>
            <input type="text"
                   id="meta_title"
                   class="form-control"
                   name="meta_title"
                   value="{{ $fetch_product_details->meta_title ?? '' }}"
                   placeholder="Enter meta title (SEO)">
        </div>

        <!-- Meta Description -->
        <div class="mb-3">
            <label for="meta_description" class="form-label">
                Meta Description
            </label>
            <textarea id="meta_description"
                      class="form-control"
                      name="meta_description"
                      rows="3"
                      placeholder="Enter meta description (SEO)">{{ $fetch_product_details->meta_description ?? '' }}</textarea>
        </div>
        
        <!-- Canonical URL -->
<div class="mb-3">
    <label for="canonical_url" class="form-label">
        Canonical URL
    </label>
    <input type="url"
           id="canonical_url"
           class="form-control"
           name="canonical_url"
           value="{{ $fetch_product_details->canonical_url ?? '' }}"
           placeholder="https://example.com/product-url">
</div>



<!-- OG Description -->
<div class="mb-3">
    <label for="og_description" class="form-label">
        OG Description
    </label>
    <textarea id="og_description"
              class="form-control"
              name="og_description"
              rows="3"
              placeholder="Enter Open Graph description">{{ $fetch_product_details->og_description ?? '' }}</textarea>
</div>



<!-- Hreflang India -->
<div class="mb-3">
    <label for="hreflang_in" class="form-label">
        Hreflang (India)
    </label>
    <input type="url"
           id="hreflang_in"
           class="form-control"
           name="hreflang_in"
           value="{{ $fetch_product_details->hreflang_in ?? '' }}"
           placeholder="https://example.com/in/product-url">
</div>

<!-- Hreflang Default -->
<div class="mb-3">
    <label for="hreflang_default" class="form-label">
        Hreflang (x-default)
    </label>
    <input type="url"
           id="hreflang_default"
           class="form-control"
           name="hreflang_default"
           value="{{ $fetch_product_details->hreflang_default ?? '' }}"
           placeholder="https://example.com/product-url">
</div>

        <br>
    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<!-- Dynamic Rows JS -->
<script>
    // function addFeature() {
    //     document.querySelector("#features_table tbody").insertAdjacentHTML("beforeend",
    //         `<tr>
    //             <td><input type="file" name="features_icon[]" class="form-control" accept="image/*,.svg,.webp"></td>
    //             <td><input type="text" name="features_title[]" class="form-control"></td>
    //             <td><input type="text" name="features_desc[]" class="form-control"></td>
    //             <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
    //         </tr>`);
    // }

    function addApplication() {
        document.querySelector("#applications_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="file" name="applications_image[]" class="form-control" accept="image/*"></td>
                <td><input type="text" name="applications_title[]" class="form-control"></td>
                <td><input type="text" name="applications_desc[]" class="form-control"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addSpec() {
        document.querySelector("#specs_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="specs_param[]" class="form-control"></td>
                <td><input type="text" name="specs_detail[]" class="form-control"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addSheet() {
        document.querySelector("#sheets_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="sheet_title[]" class="form-control"></td>
                <td><input type="file" name="sheet_file[]" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addFaq() {
        document.querySelector("#faqs_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="faq_question[]" class="form-control" placeholder="Enter Faqs Question"></td>
                <td><textarea name="faq_answer[]" class="form-control" placeholder="Enter Faqs Answer"></textarea></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }
</script>
					</div>
					</div>
				</div>
			</div>
		</div>

		<script>
			document.addEventListener("DOMContentLoaded", function() {
				const product_name = document.getElementById("product_name");
				const slug = document.getElementById("slug");
				const application_name = document.getElementById("application_name");
				const application_slug = document.getElementById("application_slug");
				
				product_name.addEventListener("input", function() {
					const product_name_value = product_name.value;
					const slug_value = product_name_value
					.toLowerCase()
					.replace(/ /g, "-")
					.replace(/[^\w-]/g, "");
					
					slug.value = slug_value;
				});

				//	Image Upload
				const img_src = document.getElementById('img_src');
				const img_preview = document.getElementById('img_preview');

				img_src.addEventListener('change', function () {
					preview_image(img_src, img_preview);
				});

				function preview_image(input, preview) 
				{
					if(input.files && input.files[0]) 
					{
						const reader = new FileReader();
						reader.onload = function(e){
							preview.querySelector('img').setAttribute('src', e.target.result);
						};
						reader.readAsDataURL(input.files[0]);
					}
				}
			});
		</script>
<script>
function previewImage(event) {
    let reader = new FileReader();
    reader.onload = function(){
        let output = document.getElementById('imagePreview');
        output.src = reader.result;
        output.style.display = "block";
    };
    reader.readAsDataURL(event.target.files[0]);
}
</script>

		<style>
			.image-preview 
			{
				width: 100%;
				height: 200px;
				margin-top: 10px;
			}

			.image-preview img 
			{
				max-width: 100%;
				max-height: 100%;
				border: 1px solid #ccc;
			}
		</style>
@endsection
