@extends('layouts.admin-header')

@section('content')
<style>hr {
    margin-top: 20px;
    margin-bottom: 20px;
    border: 0;
    border-top: 1px solid #4c4747;
}</style>
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<h4 class="box-title"><u>Edit Product listing</u></h4>
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
@php
    $grades         = $fetch_product_details1 && $fetch_product_details1->grades ? json_decode($fetch_product_details1->grades, true) : [];
    $unique         = $fetch_product_details1 && $fetch_product_details1->unique ? json_decode($fetch_product_details1->unique, true) : [];
    $certifications = $fetch_product_details1 && $fetch_product_details1->certifications ? json_decode($fetch_product_details1->certifications, true) : [];
    $faqs           = $fetch_product_details1 && $fetch_product_details1->faqs ? json_decode($fetch_product_details1->faqs, true) : [];
@endphp


<form action="{{ route('admin.edit_product_listing') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="product_id" value="{{ $fetch_product_details1->id }}">
    <input type="hidden" name="brand_id" value="{{ $fetch_product_details1->brand_id }}">
    <input type="hidden" name="old_slug" value="{{ $fetch_product_details1->slug }}">

    <!-- Section 1: Basic Info -->
    <div class="mb-5 border-bottom pb-3">
        <h4 class="mb-3">Section 1: Basic Info</h4>
        <div class="row g-3">
             <div class="col-md-6">
    <label>Product Name</label>
    <select class="form-control" id="product_select" name="product_idd" required>
        <option value="">Select Product</option>
        @foreach($products_with_multiple_brands as $product)
        dd($products_with_multiple_brands);
            <option value="{{ $product->id }}"
                {{ isset($fetch_product_details1) && $fetch_product_details1->product_name == $product->product_name ? 'selected' : '' }}>
                {{ $product->product_name }}
            </option>
        @endforeach
    </select>
</div>
            <div class="col-md-6">
                <label>Brand No.</label>
                <input type="text" class="form-control" name="brand_no"
                       value="{{ $fetch_product_details1->brand_no ?? '' }}"

                       oninput="this.value=this.value.replace(/[^0-9]/g,'');">
            </div>
            <div class="col-md-6" style="margin-top: 25px;">
                <label>Product Type</label>
            <select class="form-control" name="product_type">
    <option value="">Select Option</option>
    <option value="API" {{ ($fetch_product_details1->product_type ?? '') == 'API' ? 'selected' : '' }}>API</option>
    <option value="Lipophilic Excipients" {{ ($fetch_product_details1->product_type ?? '') == 'Lipophilic Excipients' ? 'selected' : '' }}>Lipophilic Excipients</option>
    <option value="Ester" {{ ($fetch_product_details1->product_type ?? '') == 'Ester' ? 'selected' : '' }}>Ester</option>
</select>

            </div>
           
           

<div class="col-md-6" style="margin-top: 25px;">
    <label>Product Name</label>
    <input type="text" class="form-control" id="product_name_input"
           name="product_name"
           value="{{ $fetch_product_details1->product_name ?? '' }}" readonly required>
</div>

<script>
    // When dropdown changes, update input field
    document.getElementById('product_select').addEventListener('change', function() {
        var selectedText = this.options[this.selectedIndex].text;
        document.getElementById('product_name_input').value = selectedText;
    });

    // Trigger once on page load if a product is already selected
    window.addEventListener('DOMContentLoaded', function() {
        var select = document.getElementById('product_select');
        if (select.value) {
            var selectedText = select.options[select.selectedIndex].text;
            document.getElementById('product_name_input').value = selectedText;
        }
    });
</script>

            
            <div class="col-md-6" style="margin-top: 25px;">
                <label>Slug (optional)</label>
                <input type="text" class="form-control" name="slug" value="{{ $fetch_product_details1->slug ?? '' }}" placeholder="Auto-generated if left empty">
            </div>
            <div class="col-md-12" style="margin-top: 25px;">
                <label>Product Title</label>
                <input type="text" class="form-control" name="product_title" value="{{ $fetch_product_details1->product_title ?? ''}}">
            </div>
           <div class="col-md-12" style="margin-top: 25px;">
    <label>Product Image</label><br>
    @if(!empty($fetch_product_details1->product_image))
        <img src="{{ asset('public/assets/images/products/'.$fetch_product_details1->product_image) }}" width="80">
        <input type="hidden" name="old_product_image" value="{{ $fetch_product_details1->product_image ?? '' }}">
    @endif
    <input type="file" class="form-control mt-2" name="product_image" accept="image/*">
</div>

        </div>
    </div>

<hr class="my-4">

    <!-- Section 2: Product Information -->
    <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
        <h4 class="mb-3">Section 2: Product Information</h4>
        <textarea class="form-control editor" name="product_info_description" id="editor">{{ $fetch_product_details1->product_info_desc ?? ''}}</textarea>
    </div>
<hr class="my-4">

    <!-- Section 3: Our Grades -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 3: Our Grades</h4>

    <div class="mb-2">
        <label>Heading</label>
        <input type="text" class="form-control"
               name="grades_heading"
               value="{{ $fetch_product_details1->grades_heading ?? '' }}">
    </div>

    <div class="mb-2" style="margin-top: 30px;">
        <label>Description</label>
        <input type="text" class="form-control"
               name="grades_description"
               value="{{ $fetch_product_details1->grades_description ?? '' }}">
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
                <th>Icon ALT</th>
               
                <th>Description</th>
                <th>
                    <button type="button" class="btn btn-sm btn-success" onclick="addGrade()">+</button>
                </th>
            </tr>
        </thead>
        <tbody>
        @foreach($grades as $i => $g)
            <tr>
                
                 <!-- Title -->
                <td>
                   <select class="form-control" name="grades[title][]">
    <option value="">Select Application</option>
    @foreach($applications as $app)
        <option value="{{ $app }}"
            {{ (isset($g['title']) && $g['title'] == $app) ? 'selected' : '' }}>
            {{ $app }}
        </option>
    @endforeach
</select>
                </td>
                <!-- Brand -->
                <td>
                    <select class="form-control" name="grades[brand][]">
    <option value="">Select Brand</option>
    @foreach($brands as $b)
        @php
            $fullBrand = $b->brand_name . ' - ' . $b->brand_no;
        @endphp

        <option value="{{ $fullBrand }}"
            {{ (isset($g['brand']) && $g['brand'] == $fullBrand) ? 'selected' : '' }}>
            {{ $fullBrand }}
        </option>
    @endforeach
</select>
                </td>

                <!-- Icon -->
                <td>
                    @if(!empty($g['icon']))
                        <img src="{{ asset('public/assets/images/products/grades/'.$g['icon']) }}"
                             alt="{{ $g['icon_alt'] ?? '' }}"
                             width="50"><br>

                        <input type="hidden"
                               name="old_grades_icon[{{ $i }}]"
                               value="{{ $g['icon'] }}">
                    @endif

                    <input type="file"
                           name="grades_icon[{{ $i }}]"
                           class="form-control"
                           accept="image/*,.svg,.webp">
                </td>

                <!-- Icon ALT -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="grades_icon_alt[]"
                           value="{{ $g['icon_alt'] ?? '' }}"
                           placeholder="Enter icon alt text">
                </td>

               

                <!-- Description -->
                <td>
                    <input type="text" class="form-control"
                           name="grades[description][]"
                           value="{{ $g['description'] ?? '' }}">
                </td>

                <!-- Remove -->
                <td>
                    <button type="button"
                            class="btn btn-sm btn-danger"
                            onclick="removeRow(this)">x</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<hr class="my-4">

   <!-- Section 4: What Makes Us Unique -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 4: What Makes Us Unique</h4>

    <input type="text" class="form-control mb-2"
           name="unique_heading"
           value="{{ $fetch_product_details1->unique_heading ?? '' }}">

    <input type="text" class="form-control mb-2"
           name="unique_description"
           value="{{ $fetch_product_details1->unique_description ?? '' }}">

    <input type="text" class="form-control mb-2"
           name="unique_title"
           value="{{ $fetch_product_details1->unique_title ?? '' }}">

    <table class="table table-bordered" id="unique_table">
        <thead>
            <tr>
                <th>Icon</th>
                <th>Icon ALT</th>
                <th>Title</th>
                <th>Description</th>
                <th>
                    <button type="button"
                            class="btn btn-sm btn-success"
                            onclick="addUnique()">+</button>
                </th>
            </tr>
        </thead>

        <tbody>
        @foreach($unique as $i => $u)
            <tr>
                <!-- Icon -->
                <td>
                    @if(!empty($u['icon']))
                        <img src="{{ asset('public/assets/images/products/unique/'.$u['icon']) }}"
                             alt="{{ $u['icon_alt'] ?? '' }}"
                             width="50"><br>

                        <input type="hidden"
                               name="old_unique_icon[{{ $i }}]"
                               value="{{ $u['icon'] }}">
                    @endif

                    <input type="file"
                           name="unique_icon[{{ $i }}]"
                           class="form-control"
                           accept="image/*,.svg,.webp">
                </td>

                <!-- Icon ALT -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="unique_icon_alt[]"
                           value="{{ $u['icon_alt'] ?? '' }}"
                           placeholder="Enter icon alt text">
                </td>

                <!-- Title -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="unique[title][]"
                           value="{{ $u['title'] ?? '' }}">
                </td>

                <!-- Description -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="unique[description][]"
                           value="{{ $u['description'] ?? '' }}">
                </td>

                <!-- Remove -->
                <td>
                    <button type="button"
                            class="btn btn-sm btn-danger"
                            onclick="removeRow(this)">x</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<hr class="my-4">

    <!-- Section 5: Certifications -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 5: Our Certifications</h4>

    <input type="text" class="form-control mb-2"
           name="certification_heading"
           value="{{ $fetch_product_details1->certification_heading ?? '' }}">

    <input type="text" class="form-control mb-2"
           name="certification_description"
           value="{{ $fetch_product_details1->certification_description ?? '' }}">

    <table class="table table-bordered" id="certification_table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Image ALT</th>
                <th>Title</th>
                <th>Description</th>
                <th>
                    <button type="button"
                            class="btn btn-sm btn-success"
                            onclick="addCertification()">+</button>
                </th>
            </tr>
        </thead>

        <tbody>
        @foreach($certifications as $i => $c)
            <tr>
                <!-- Image -->
                <td>
                    @if(!empty($c['image']))
                        <img src="{{ asset('public/assets/images/products/certifications/'.$c['image']) }}"
                             alt="{{ $c['image_alt'] ?? '' }}"
                             width="50"><br>

                        <input type="hidden"
                               name="old_certification_image[{{ $i }}]"
                               value="{{ $c['image'] }}">
                    @endif

                    <input type="file"
                           name="certification_image[{{ $i }}]"
                           class="form-control"
                           accept="image/*,.svg,.webp">
                </td>

                <!-- Image ALT -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="certification_image_alt[]"
                           value="{{ $c['image_alt'] ?? '' }}"
                           placeholder="Enter image alt text">
                </td>

                <!-- Title -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="certification[title][]"
                           value="{{ $c['title'] ?? '' }}">
                </td>

                <!-- Description -->
                <td>
                    <input type="text"
                           class="form-control"
                           name="certification[description][]"
                           value="{{ $c['description'] ?? '' }}">
                </td>

                <!-- Remove -->
                <td>
                    <button type="button"
                            class="btn btn-sm btn-danger"
                            onclick="removeRow(this)">x</button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>

<hr class="my-4">



   <!-- Section 6: Why Choose -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 6: Why Choose</h4>

    <textarea class="form-control editor"
              name="why_choose_description"
              id="editor1">{{ $fetch_product_details1->why_choose_desc ?? '' }}</textarea>

    @if(!empty($fetch_product_details1) && !empty($fetch_product_details1->why_choose_image))
        <div class="mt-2">
            <img src="{{ asset('public/assets/images/products/'.$fetch_product_details1->why_choose_image) }}"
                 alt="{{ $fetch_product_details1->why_choose_image_alt ?? '' }}"
                 width="80">
            <input type="hidden"
                   name="old_why_choose_image"
                   value="{{ $fetch_product_details1->why_choose_image }}">
        </div>
    @endif

    <!-- Image ALT -->
    <input type="text"
           class="form-control mt-2"
           name="why_choose_image_alt"
           placeholder="Enter image alt text"
           value="{{ $fetch_product_details1->why_choose_image_alt ?? '' }}">

    <!-- Image Upload -->
    <input type="file"
           class="form-control mt-2"
           name="why_choose_image"
           accept="image/*,.svg,.webp">
</div>

<hr class="my-4">


  <!-- Section 7: Handling & Packaging -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 7: Handling and Packaging</h4>

    <textarea class="form-control editor"
              name="safety_description"
              id="editor2">{{ $fetch_product_details1->safety_description ?? '' }}</textarea>

    @if(!empty($fetch_product_details1) && !empty($fetch_product_details1->safety_image))
        <div class="mt-2">
            <img src="{{ asset('public/assets/images/products/'.$fetch_product_details1->safety_image) }}"
                 alt="{{ $fetch_product_details1->safety_image_alt ?? '' }}"
                 width="80">
            <input type="hidden"
                   name="old_safety_image"
                   value="{{ $fetch_product_details1->safety_image }}">
        </div>
    @endif

    <!-- Image ALT -->
    <input type="text"
           class="form-control mt-2"
           name="safety_image_alt"
           placeholder="Enter image alt text"
           value="{{ $fetch_product_details1->safety_image_alt ?? '' }}">

    <!-- Image Upload -->
    <input type="file"
           class="form-control mt-2"
           name="safety_image"
           accept="image/*,.svg,.webp">
</div>

<hr class="my-4">


    <!-- Section 8: Looking to Buy -->
    <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
        <h4 class="mb-3">Section 8: Looking to Buy</h4>
        <textarea class="form-control editor" name="buy_description" id="editor3">{{ $fetch_product_details1->buy_description ?? ''}}</textarea>
    </div>
<hr class="my-4">

    <!-- Section 9: Get a Quote -->
    <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
        <h4 class="mb-3">Section 9: Get a Quote</h4>
        <input type="text" class="form-control mb-2" name="quote_title" value="{{ $fetch_product_details1->quote_title ?? '' }}">
        <textarea class="form-control mb-2" name="quote_description">{{ $fetch_product_details1->quote_description ?? '' }}</textarea>
        <input type="text" class="form-control mb-2" name="quote_contact" value="{{ $fetch_product_details1->quote_contact ?? '' }}">
        <input type="email" class="form-control mb-2" name="quote_email" value="{{ $fetch_product_details1->quote_email ?? '' }}">
    </div>
<hr class="my-4">

    <!-- Section 10: FAQs -->
<div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">
    <h4 class="mb-3">Section 10: FAQs</h4>
    <input type="text" class="form-control mb-2" name="faqs_heading" value="{{ $fetch_product_details1->faqs_heading ?? '' }}">
    <table class="table table-bordered" id="faqs_table">
        <thead>
            <tr>
                <th>Question</th>
                <th>Answer</th>
                <th><button type="button" class="btn btn-sm btn-success" onclick="addFaq()">+</button></th>
            </tr>
        </thead>
        <tbody>
        @foreach($faqs as $index => $f)
            <tr>
                <td><input type="text" class="form-control" name="faq_question[]" value="{{ $f['question'] ?? '' }}"></td>
                <td><textarea class="form-control faq-editor" name="faq_answer[]">{{ $f['answer'] ?? '' }}</textarea></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">X</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>


<!-- Meta Title -->
        <div class="mb-3">
            <label for="meta_title" class="form-label">
                Meta Title
            </label>
            <input type="text"
                   id="meta_title"
                   class="form-control"
                   name="meta_title"
                   value="{{ $fetch_product_details1->meta_title ?? '' }}"
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
                      placeholder="Enter meta description (SEO)">{{ $fetch_product_details1->meta_description ?? '' }}</textarea>
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
           value="{{ $fetch_product_details1->canonical_url ?? '' }}"
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
              placeholder="Enter Open Graph description">{{ $fetch_product_details1->og_description ?? '' }}</textarea>
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
           value="{{ $fetch_product_details1->hreflang_in ?? '' }}"
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
           value="{{ $fetch_product_details1->hreflang_default ?? '' }}"
           placeholder="https://example.com/product-url">
</div>
        <br>
<hr class="my-4">

    <div class="text-end">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>

<!-- Dynamic JS -->
<script>
function addGrade() {

    let applications = @json($applications);
    let brands = @json($brands);

    // Application dropdown
    let appOptions = '<option value="">Select Application</option>';
    applications.forEach(function(app){
        appOptions += `<option value="${app}">${app}</option>`;
    });

    // Brand dropdown (IMPORTANT: same format as DB)
    let brandOptions = '<option value="">Select Brand</option>';
    brands.forEach(function(b){
        let fullBrand = `${b.brand_name} - ${b.brand_no}`;
        brandOptions += `<option value="${fullBrand}">${fullBrand}</option>`;
    });

    document.querySelector("#grades_table tbody").insertAdjacentHTML('beforeend',
        `<tr>
            <td>
                <select class="form-control" name="grades[title][]">
                    ${appOptions}
                </select>
            </td>

            <td>
                <select class="form-control" name="grades[brand][]">
                    ${brandOptions}
                </select>
            </td>

            <td>
                <input type="file" name="grades_icon[]" class="form-control" accept="image/*,.svg,.webp">
            </td>

            <td>
                <input type="text" class="form-control" name="grades_icon_alt[]" placeholder="Enter icon alt text">
            </td>

            <td>
                <input type="text" class="form-control" name="grades[description][]" placeholder="Description">
            </td>

            <td>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button>
            </td>
        </tr>`
    );
}function addUnique() {
    document.querySelector("#unique_table tbody").insertAdjacentHTML('beforeend',
        `<tr>
            <td><input type="file" name="unique_icon[]" class="form-control" accept="image/*,.svg,.webp"></td>
            <td><input type="text" class="form-control" name="unique[title][]" placeholder="Title"></td>
            <td><input type="text" class="form-control" name="unique[description][]" placeholder="Description"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button></td>
        </tr>`);
}
function addCertification() {
    document.querySelector("#certification_table tbody").insertAdjacentHTML('beforeend',
        `<tr>
            <td><input type="file" name="certification_image[]" class="form-control" accept="image/*,.svg,.webp"></td>
            <td><input type="text" class="form-control" name="certification[title][]" placeholder="Title"></td>
            <td><input type="text" class="form-control" name="certification[description][]" placeholder="Description"></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button></td>
        </tr>`);
}

function removeRow(btn) {
    btn.closest("tr").remove();
}
</script>
<!-- Section 10: FAQs -->

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize CKEditor for all existing FAQ textareas
    document.querySelectorAll('.faq-editor').forEach(textarea => {
        ClassicEditor
            .create(textarea)
            .then(editor => {
                textarea._editorInstance = editor; // store instance for submit
            })
            .catch(error => console.error(error));
    });

    // Add FAQ row dynamically
    window.addFaq = function() {
        const tbody = document.querySelector("#faqs_table tbody");
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td><input type="text" class="form-control" name="faq_question[]" placeholder="Question"></td>
            <td><textarea class="form-control faq-editor" name="faq_answer[]" placeholder="Answer"></textarea></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">X</button></td>
        `;
        tbody.appendChild(tr);

        // Initialize CKEditor for new textarea
        const textarea = tr.querySelector('.faq-editor');
        ClassicEditor
            .create(textarea)
            .then(editor => {
                textarea._editorInstance = editor;
            })
            .catch(error => console.error(error));
    };

    // Remove FAQ row
    window.removeRow = function(btn) {
        const tr = btn.closest('tr');
        const textarea = tr.querySelector('.faq-editor');
        if (textarea && textarea._editorInstance) {
            textarea._editorInstance.destroy(); // clean up CKEditor
        }
        tr.remove();
    };

    // Update textareas before form submit
    const form = document.querySelector('form');
    form.addEventListener('submit', function() {
        document.querySelectorAll('.faq-editor').forEach(textarea => {
            if (textarea._editorInstance) {
                textarea.value = textarea._editorInstance.getData();
            }
        });
    });
});
</script>

<script>
  ClassicEditor
    .create(document.querySelector('#description1'))
    .catch(error => {
      console.error(error);
    });
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
		
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

		<script>
            $(document).ready(function() {
                $(".delete-icon").click(function() {
                    var delete_url = $(this).data('url');
                    var confirm_delete = confirm("Are you sure you want to delete this document?");
                    
                    if(confirm_delete) 
                    {
                        window.location.href = delete_url;
                    }
                });
            });
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
