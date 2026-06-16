@extends('layouts.admin-header')

@section('content')
<style>hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #4c4747;
}</style>
<style>/* Section heading style */
.section-heading {
    background: #007bff; /* Blue header background */
    color: #fff;
    padding: 10px 15px;
    border-radius: 6px;
    font-size: 18px;
}

/* Zebra striping effect */
.section-striped > div:nth-child(odd) {
    background-color: #f9f9f9;
    padding: 15px;
    border-radius: 6px;
}
.section-striped > div:nth-child(even) {
    background-color: #ffffff;
    padding: 15px;
    border-radius: 6px;
}

/* Section divider line */
.section-divider {
    border: 0;
    height: 2px;
    margin: 30px 0;
}
</style>

<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Add Product</u></h4>
						<div class="card-content">
<form action="{{ route('admin.add_product') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="brand_id" value="{{ $brand_id }}">

    <!-- Section 1: Basic Info -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 1: Basic Info</h4>
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Brand No.</label>
                    <input type="text" class="form-control" name="brand_no"
                           placeholder="Enter Brand Number"
                           oninput="this.value=this.value.replace(/[^0-9]/g,'');">
                </div>
                <div class="col-md-6">
                    <label>Product Type</label>
                    <select class="form-control" name="product_type">
                        <option value="">Select Option</option>
                        <option value="API">API</option>
                        <option value="Lipophilic Excipients">Lipophilic Excipients</option>
                        <option value="Ester">Ester</option>
                    </select>
                </div>
                <div class="col-md-6 mt-3" style="margin-top: 15px;">
                    <label>Product Name</label>
                    <input type="text" class="form-control" name="product_name"
                           placeholder="Enter Product Name" required>
                </div>
                <div class="col-md-6 mt-3" style="margin-top: 15px;">
                    <label>Slug (optional)</label>
                    <input type="text" class="form-control" name="slug"
                           placeholder="Auto-generated if left empty">
                </div>
                <div class="col-md-12 mt-3" style="margin-top: 15px;">
                    <label>Product Title</label>
                    <input type="text" class="form-control" name="product_title"
                           placeholder="Enter Product Title">
                </div>
                <div class="col-md-12 mt-3" style="margin-top: 15px;">
                    <label>Product Image</label>
                    <input type="file" class="form-control" name="product_image"
                           accept="image/*" required onchange="previewProductImage(event)">
                    <div class="mt-2">
                        <img id="productImagePreview" src="" alt="Preview will appear here"
                             style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                    </div>
                    
                     <small class="text-muted d-block mt-1">
                        Note: Image must be in <strong>WEBP</strong> format and size should not exceed <strong>2 KB</strong>.
                    </small>
                </div>
            </div>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 2: Product Information -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 2: Product Information</h4>
            <div class="row g-3">
                <div class="col-md-6">
                   <label>Product Heading (Optional)</label>

<div style="background: #fff8e1; border-left: 4px solid #f9a825; border-radius: 6px;
padding: 10px 14px; margin-bottom: 15px; font-size: 13px; color: #5d4037;">
    <strong>ℹ️ Note:</strong>
    Fill this to use <strong>Zonoea layout</strong>; leave empty for <strong>standard layout</strong>.
</div>
                    <input type="text" class="form-control" name="product_heading"
                           value="{{ $fetch_product_details->product_heading ?? '' }}"
                           placeholder="Enter product heading name" >
                </div>
                <div class="col-md-6">
                    <label>Image</label>
                    <input type="file" class="form-control" name="product_info_image"
                           accept="image/*" onchange="previewProductInfoImage(event)">
                    <div class="mt-2">
                        <img id="productInfoImagePreview" src="" alt="Preview will appear here"
                             style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 15px;">
                    <label>Description</label>
                    <textarea class="form-control editor"
                              name="product_info_description"
                              placeholder="Enter Product Description"></textarea>
                </div>
            </div>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 2.1: Additional Product Info -->
    <section class="product-section bg-light py-4">
        <div class="container">
<h4 class="section-heading mb-4">Section 2.1: Additional Product Information</h4>

<div style="background: #fff8e1; border-left: 4px solid #f9a825; border-radius: 6px;
            padding: 12px 16px; margin-bottom: 20px; font-size: 14px; color: #5d4037;">
    <strong>ℹ️ Note:</strong>
    Filling this section will display the product page in the
    <strong>Zonoea layout</strong> — a two-column format with extended product information.
    If you leave this section empty, the product page will follow the
    <strong>standard layout</strong> used for regular product entries.
</div>            <div class="row g-3">
                <div class="col-md-6">
                    <label>Heading</label>
                    <input type="text" class="form-control" name="product_info_heading_2_1"
                           value="{{ $fetch_product_details->product_info_heading_2_1 ?? '' }}"
                           placeholder="Enter heading">
                </div>
                <div class="col-md-6">
                    <label>Title</label>
                    <input type="text" class="form-control" name="product_info_title_2_1"
                           value="{{ $fetch_product_details->product_info_title_2_1 ?? '' }}"
                           placeholder="Enter title">
                </div>
                <div class="col-md-12 mt-3" style="margin-top: 15px;">
                    <label>Description</label>
                    <textarea class="form-control editor" id="editor5" name="product_info_description_2_1"
                              placeholder="Enter detailed product information">{{ $fetch_product_details->product_info_description_2_1 ?? '' }}</textarea>
                </div>
                <div class="col-md-6 mt-3" style="margin-top: 15px;">
                    <label>Image</label>
                    @if(!empty($fetch_product_details->product_info_image_2_1))
                        <div class="mb-2">
                            <img src="{{ asset('public/assets/images/products/info/'.$fetch_product_details->product_info_image_2_1) }}"
                                 alt="Product Info Image" class="img-thumbnail" width="120">
                        </div>
                    @endif
                    <input type="file" class="form-control" name="product_info_image_2_1" accept="image/*">
                    <input type="hidden" name="old_product_info_image_2_1"
                           value="{{ $fetch_product_details->product_info_image_2_1 ?? '' }}">
                </div>
            </div>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 3: Key Features -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 3: Key Features</h4>
            <div class="mb-2">
                <label>Heading</label>
                <input type="text" class="form-control" name="features_heading" placeholder="Enter Product Heading">
            </div>
            <div class="mb-2">
                <label>Description</label>
                <input type="text" class="form-control" name="features_description" placeholder="Enter Product Description">
            </div>
            <table class="table table-bordered" id="features_table">
                <thead>
                <tr>
                    <th>Icon</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addFeature()">+</button></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 4: Applications by Industry -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 4: Applications by Industry</h4>
            <div class="mb-2">
                <label>Heading</label>
                <input type="text" class="form-control" name="applications_heading" placeholder="Enter Applications Heading">
            </div>
            <div class="mb-4">
                <label>Description</label>
                <textarea class="form-control" name="applications_description"
                          placeholder="Enter applications section description"></textarea>
            </div>
            <table class="table table-bordered" id="applications_table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addApplication()">+</button></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 5: Our Certifications -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 5: Our Certifications</h4>
            <div class="mb-2">
                <label>Heading</label>
                <input type="text" class="form-control" name="certification_heading"
                       placeholder="Enter Certifications Heading">
            </div>
            <div class="mb-2 mt-3">
                <label>Description</label>
                <input type="text" class="form-control" name="certification_description"
                       placeholder="Enter Certifications Description">
            </div>
            <table class="table table-bordered" id="certification_table">
                <thead>
                <tr>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addCertification()">+</button></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 6: General Specifications -->
   <!-- Section 6: General Specifications -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 6: General Specifications</h4>

        <div class="mb-2">
            <label>Heading</label>
            <input type="text" class="form-control" name="specs_heading" value="{{ $fetch_product_details->specs_heading ?? '' }}" placeholder="Enter specification Heading">
        </div>

        <table class="table table-bordered" id="specs_table">
            <thead>
            <tr>
                @php
                    // Load column names if exist, else defaults
                    $columns = json_decode($fetch_product_details->specs_columns ?? '[]', true) ?: ['Parameter','Details'];
                @endphp

                @foreach($columns as $col)
                    <th>
                        <input type="text" name="specs_columns[]" class="form-control" value="{{ $col }}" placeholder="Column Name">
                    </th>
                @endforeach

                <th>
                    <button type="button" class="btn btn-sm btn-success" onclick="addSpec()">+</button>
                </th>
            </tr>
            </thead>
            <tbody>
                @foreach(json_decode($fetch_product_details->specifications ?? '[]', true) as $spec)
                    <tr>
                        <td><input type="text" name="specs_param[]" class="form-control" value="{{ $spec['parameter'] ?? '' }}" placeholder="Enter {{ $columns[0] }}"></td>
                        <td><input type="text" name="specs_detail[]" class="form-control" value="{{ $spec['detail'] ?? '' }}" placeholder="Enter {{ $columns[1] }}"></td>
                        <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

<p class="section-divider"></p>

    <!-- Section 7: Spreadsheets Download -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 7: Spreadsheets Download</h4>
            <div class="mb-2">
                <label>Heading</label>
                <input type="text" class="form-control" name="spreadsheet_heading" placeholder="Enter Spreadsheet Heading">
            </div>
            <table class="table table-bordered" id="sheets_table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>File</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addSheet()">+</button></th>
                </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 8: Safety & Handling -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 8: Safety & Handling</h4>
            <textarea class="form-control editor" name="safety_description" id="editor1"></textarea>
            <input type="file" class="form-control mt-2" name="safety_image" accept="image/*" onchange="previewSafetyImage(event)">
            <div class="mt-2">
                <img id="safetyImagePreview" src="" alt="Preview will appear here"
                     style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
            </div>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 9: Why Choose Us -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 9: Why Choose Us</h4>
            <textarea class="form-control editor" name="why_choose_description" id="editor"></textarea>
            <input type="file" class="form-control mt-2" name="why_choose_image" accept="image/*" onchange="previewWhyChoose(event)">
            <div class="mt-2">
                <img id="whyChoosePreview" src="" alt="Preview will appear here"
                     style="max-width: 200px; display: none; border: 1px solid #ddd; padding: 5px; border-radius: 8px;">
            </div>
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 10: Get a Quote -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 10: Get a Quote</h4>
            <input type="text" class="form-control mb-2" name="quote_title" placeholder="Title">
            <textarea class="form-control mb-2" name="quote_description" placeholder="Description"></textarea>
            <input type="text" class="form-control mb-2" name="quote_contact" placeholder="Contact Number">
            <input type="email" class="form-control mb-2" name="quote_email" placeholder="Email">
        </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 11: FAQs -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 11: FAQs</h4>
            <div class="mb-2">
                <label>Heading</label>
                <input type="text" class="form-control" name="faqs_heading" placeholder="FAQs Heading">
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
    </section>
<p class="section-divider"></p>

    <!-- Section 12: Applications Across Industries -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 12: Applications Across Industries</h4>
            <div class="mb-3">
                <label>Heading</label>
                <input type="text" class="form-control" name="applications_industries_heading"
                       value="{{ $fetch_product_details->applications_industries_heading ?? '' }}"
                       placeholder="Enter section heading">
            </div>
            <table class="table table-bordered" id="applications_industries_table">
                <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th><button type="button" class="btn btn-sm btn-success" onclick="addIndustryApplication()">+</button></th>
                </tr>
                </thead>
                <tbody>
                @foreach(json_decode($fetch_product_details->applications_industries ?? '[]', true) as $ai)
                    <tr>
                        <td><input type="text" class="form-control" name="applications_industries_title[]" value="{{ $ai['title'] ?? '' }}" placeholder="Enter title"></td>
                        <td><textarea class="form-control" name="applications_industries_desc[]" placeholder="Enter description">{{ $ai['description'] ?? '' }}</textarea></td>
                        <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </section>
<p class="section-divider"></p>
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
        
    <!-- Submit -->
    <br>
    <div class="text-end mt-4">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

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
<script>
    function addCertification() {
        let row = `
            <tr>
                <td><input type="file" name="certification[image][]" class="form-control" accept="image/*,.svg,.webp"></td>
                <td><input type="text" class="form-control" name="certification[title][]" placeholder="Title"></td>
                <td><input type="text" class="form-control" name="certification[description][]" placeholder="Description"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button></td>
            </tr>
        `;
        document.querySelector("#certification_table tbody").insertAdjacentHTML('beforeend', row);
    }

    function removeRow(btn) {
        btn.closest("tr").remove();
    }
</script>
<script>
function previewProductInfoImage(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('productInfoImagePreview');
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script>
function previewProductInfoImage(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('productInfoImagePreview');
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script>
function previewProductInfoImage(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('productInfoImagePreview');
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>
<script>
function previewProductImage(event) {
    let file = event.target.files[0];
    if (file) {
        let reader = new FileReader();
        reader.onload = function () {
            let preview = document.getElementById('productImagePreview');
            preview.src = reader.result;
            preview.style.display = "block";
        };
        reader.readAsDataURL(file);
    }
}
</script>

<script>
function addIndustryApplication() {
    let row = `
        <tr>
            <td><input type="text" name="applications_industries_title[]" class="form-control" placeholder="Enter title"></td>
            <td><textarea name="applications_industries_desc[]" class="form-control editor6" placeholder="Enter description"></textarea></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
        </tr>
    `;
    document.querySelector('#applications_industries_table tbody').insertAdjacentHTML('beforeend', row);

    // re-init CKEditor for the new textarea
    initEditors();
}

function initEditors() {
    document.querySelectorAll('.editor6').forEach((el) => {
        if (!el.classList.contains('ck-editor-applied')) {
            ClassicEditor.create(el).then(editor => {
                el.classList.add('ck-editor-applied');
            }).catch(error => {
                console.error(error);
            });
        }
    });
}

// Initialize editors on page load
document.addEventListener("DOMContentLoaded", initEditors);
</script>

<!-- Dynamic Rows JS -->
<script>
    function addFeature() {
        document.querySelector("#features_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="file" name="features_icon[]" class="form-control" accept="image/*,.svg,.webp"></td>
                <td><input type="text" name="features_title[]" class="form-control" placeholder="Enter Features Title"></td>
                <td><input type="text" name="features_desc[]" class="form-control" placeholder="Enter Features Description"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addApplication() {
        document.querySelector("#applications_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="file" name="applications_image[]" class="form-control" accept="image/*"></td>
                <td><input type="text" name="applications_title[]" class="form-control" placeholder="Enter Application Title"></td>
                <td><input type="text" name="applications_desc[]" class="form-control" placeholder="Enter Application Description"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

   

    function addSheet() {
        document.querySelector("#sheets_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="sheet_title[]" class="form-control" placeholder="Enter Spreadsheets details"></td>
                <td><input type="file" name="sheet_file[]" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addFaq() {
        document.querySelector("#faqs_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="faq_question[]" class="form-control" placeholder="Enter Faqs Questions" ></td>
                <td><textarea name="faq_answer[]" class="form-control"  id="editor8" placeholder="Enter Faqs Answer"></textarea></td>
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
    function addFeature() {
        document.querySelector("#features_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td>
                    <input type="file" name="features_icon[]" class="form-control" accept="image/*,.svg,.webp" onchange="previewRowImage(event, this)">
                    <img src="" alt="Preview" style="max-width:80px; margin-top:8px; display:none; border:1px solid #ddd; padding:3px; border-radius:5px;">
                </td>
                <td><input type="text" name="features_title[]" class="form-control" placeholder="Enter Features Title"></td>
                <td><input type="text" name="features_desc[]" class="form-control" placeholder="Enter Features Description"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addApplication() {
        document.querySelector("#applications_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td>
                    <input type="file" name="applications_image[]" class="form-control" accept="image/*" onchange="previewRowImage(event, this)">
                    <img src="" alt="Preview" style="max-width:80px; margin-top:8px; display:none; border:1px solid #ddd; padding:3px; border-radius:5px;">
                </td>
                <td><input type="text" name="applications_title[]" class="form-control" placeholder="Enter Application Title"></td>
                <td><input type="text" name="applications_desc[]" class="form-control" placeholder="Enter Application Description"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

  function addSpec() {
    // Get current column names from header inputs
    let cols = document.querySelectorAll('#specs_table thead input[name="specs_columns[]"]');
    let col1 = cols[0]?.value || "Parameter";
    let col2 = cols[1]?.value || "Details";

    // Add new row with dynamic placeholders
    document.querySelector("#specs_table tbody").insertAdjacentHTML("beforeend",
        `<tr>
            <td><input type="text" name="specs_param[]" class="form-control" placeholder="Enter ${col1}"></td>
            <td><input type="text" name="specs_detail[]" class="form-control" placeholder="Enter ${col2}"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
        </tr>`);
}


    function addSheet() {
        document.querySelector("#sheets_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="sheet_title[]" class="form-control" placeholder="Enter Spreadsheets details"></td>
                <td>
                    <input type="file" name="sheet_file[]" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,image/*" onchange="previewRowImage(event, this)">
                    <img src="" alt="Preview" style="max-width:80px; margin-top:8px; display:none; border:1px solid #ddd; padding:3px; border-radius:5px;">
                </td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addFaq() {
        document.querySelector("#faqs_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="text" name="faq_question[]" class="form-control" placeholder="Enter Faqs Questions" ></td>
                <td><textarea name="faq_answer[]" class="form-control" id="editor8" placeholder="Enter Faqs Answer"></textarea></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    // ✅ Common preview function (works for all file inputs in rows)
    function previewRowImage(event, input) {
        let file = event.target.files[0];
        if (file && file.type.startsWith("image/")) {
            let reader = new FileReader();
            reader.onload = function () {
                let img = input.nextElementSibling; // <img> right after input
                img.src = reader.result;
                img.style.display = "block";
            };
            reader.readAsDataURL(file);
        }
    }
</script>
<script>
(function () {

    /* Hide these when 2.1 IS filled */
    const HIDE_WHEN_FILLED = [
        'section-3',   // Key Features
         'section-5',   // General Specifications
        'section-6',   // General Specifications
        'section-7',   // Spreadsheets Download
        'section-9',   // Why Choose
        'section-11',  // FAQs
    ];

    /* Hide this when 2.1 IS empty */
    const HIDE_WHEN_EMPTY = [
        'section-12',  // Applications Across Industries
    ];

    /* ── Assign IDs to every section ─────────────────── */
    document.querySelectorAll('section.product-section').forEach(sec => {
        const heading = sec.querySelector('.section-heading');
        if (!heading) return;
        const text = heading.textContent.trim();

        if      (text.includes('Section 2.1'))               sec.id = 'section-2-1';
        else if (text.includes('Section 3'))                 sec.id = 'section-3';
         else if (text.includes('Section 5'))                         sec.id = 'section-5';
        else if (text.includes('Section 6'))                 sec.id = 'section-6';
        else if (text.includes('Section 7: Spreadsheets'))   sec.id = 'section-7';
        else if (text.includes('Section 9'))                 sec.id = 'section-9';
        else if (text.includes('Section 11'))                sec.id = 'section-11';
        else if (text.includes('Section 12'))                sec.id = 'section-12';
    });

    /* ── Get the divider <p> sitting just before a section ── */
    function getDividerBefore(section) {
        let prev = section.previousElementSibling;
        while (prev) {
            if (prev.classList && prev.classList.contains('section-divider')) return prev;
            if (prev.tagName === 'SECTION') break;
            prev = prev.previousElementSibling;
        }
        return null;
    }

    /* ── Show or hide a single section ───────────────── */
    function applyVisibility(id, hide) {
        const sec = document.getElementById(id);
        if (!sec) return;

        sec.style.display    = hide ? 'none' : '';
        sec.style.transition = 'opacity .3s';
        sec.style.opacity    = hide ? '0'    : '1';

        const divider = getDividerBefore(sec);
        if (divider) divider.style.display = hide ? 'none' : '';

        /* Remove required from hidden fields so form still submits */
        sec.querySelectorAll('[required]').forEach(el => {
            if (hide) {
                el.dataset.wasRequired = 'true';
                el.removeAttribute('required');
            } else if (el.dataset.wasRequired) {
                el.setAttribute('required', '');
            }
        });
    }

    /* ── Check if Section 2.1 has any filled value ───── */
    function section21HasContent() {
        const sec = document.getElementById('section-2-1');
        if (!sec) return false;

        for (const el of sec.querySelectorAll('input[type="text"], input[type="url"]')) {
            if (el.value.trim() !== '') return true;
        }
        for (const el of sec.querySelectorAll('textarea')) {
            if (el.value.trim() !== '') return true;
        }
        for (const el of sec.querySelectorAll('input[type="file"]')) {
            if (el.files && el.files.length > 0) return true;
        }

        return false;
    }

    /* ── Apply all visibility rules ──────────────────── */
    function evaluate() {
        const filled = section21HasContent();

        /* Sections 3,6,7,9,11 → hide when 2.1 filled */
        HIDE_WHEN_FILLED.forEach(id => applyVisibility(id, filled));

        /* Section 12 → hide when 2.1 is empty */
        HIDE_WHEN_EMPTY.forEach(id => applyVisibility(id, !filled));
    }

    /* ── Attach listeners to every field inside 2.1 ──── */
    function attachListeners() {
        const sec = document.getElementById('section-2-1');
        if (!sec) return;
        sec.querySelectorAll('input, textarea, select').forEach(el => {
            el.addEventListener('input',  evaluate);
            el.addEventListener('change', evaluate);
        });
    }

    /* ── Run on page load (handles edit page pre-filled data) ── */
    document.addEventListener('DOMContentLoaded', function () {
        attachListeners();
        evaluate();
    });

})();
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
