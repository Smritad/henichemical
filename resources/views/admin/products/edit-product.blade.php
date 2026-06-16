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
						<h4 class="box-title"><u>Edit Product</u></h4>
						<div class="card-content">
<form action="{{ route('admin.edit_product') }}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="hidden" name="product_id" value="{{ $fetch_product_details->id }}">
    <input type="hidden" name="brand_id" value="{{ $fetch_product_details->brand_id }}">

   <!-- Section 1: Basic Info -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 1: Basic Info</h4>
        <div class="row g-3 section-striped">
            <!-- Brand No. -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Brand No.</label>
                <input type="text" class="form-control" name="brand_no"
                       value="{{ $fetch_product_details->brand_no }}"
                       placeholder="Enter brand number (e.g. B-101)">
            </div>

            <!-- Product Type -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Product Type</label>
                <select class="form-control" name="product_type">
                    <option value="">Select product type</option>
                    <option value="API" {{ $fetch_product_details->product_type == 'API' ? 'selected' : '' }}>API</option>
                    <option value="Lipophilic Excipients" {{ $fetch_product_details->product_type == 'Lipophilic Excipients' ? 'selected' : '' }}>Lipophilic Excipients</option>
                    <option value="Ester" {{ $fetch_product_details->product_type == 'Ester' ? 'selected' : '' }}>Ester</option>
                </select>
            </div>

            <!-- Product Name -->
            <div class="col-md-6">
                <label class="form-label fw-bold">Product Name</label>
                <input type="text" class="form-control" name="product_name"
                       value="{{ $fetch_product_details->product_name }}" required
                       placeholder="Enter product name">
            </div>

            <!-- Product Title -->
            <div class="col-md-12">
                <label class="form-label fw-bold">Product Title</label>
                <input type="text" class="form-control" name="product_title"
                       value="{{ $fetch_product_details->product_title }}"
                       placeholder="Enter product title or tagline">
            </div>

            <!-- Product Image -->
<div class="col-md-12">
    <label class="form-label fw-bold">Product Image</label>

    @if($fetch_product_details->product_image)
        <div class="mb-2 border p-2 rounded bg-white position-relative d-inline-block">
            <img src="{{ asset('public/assets/images/products/'.$fetch_product_details->product_image) }}" width="120">
            
            <!-- Delete Icon -->
            <a href="javascript:void(0);" 
   class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"
   style="font-size: 12px; cursor:pointer;"
   data-url="{{ route('admin.product.delete_image', ['id' => $fetch_product_details->id]) }}"
   onclick="deleteProductImage(this)">
   &times;
</a>
<p></p>

        </div>
    @endif

    <input type="file" class="form-control" name="product_image" accept="image/*">
    <input type="hidden" name="old_product_image" value="{{ $fetch_product_details->product_image }}">
    
     <small class="text-muted d-block mt-1">
        Note: Image must be in <strong>WEBP</strong> format and size should not exceed <strong>2 KB</strong>.
    </small>
</div>
        </div>
    </div>
</section>
<script>
function deleteProductImage(el) {
    if (!confirm("Are you sure you want to delete this image?")) return;

    let url = el.getAttribute('data-url');

    fetch(url, {
        method: "DELETE",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
        },
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            alert("Image deleted successfully!");
            location.reload();
        } else {
            alert("Something went wrong!");
        }
    })
    .catch(err => console.error(err));
}
</script>
<!-- Divider Line -->
<p class="section-divider"></p>



        <!-- Section 2: Product Information -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 2: Product Information </h4>
    <div class="row g-4 mt-3">
    
        <!-- Product Heading -->
        <div class="col-md-6">
            <label for="product_heading" class="form-label">Product Heading (Optional)<span class="text-danger"></span></label>
            <label>Product Heading (Optional)</label>

<div style="background: #fff8e1; border-left: 4px solid #f9a825; border-radius: 6px;
padding: 10px 14px; margin-bottom: 15px; font-size: 13px; color: #5d4037;">
    <strong>ℹ️ Note:</strong>
    Fill this to use <strong>Zonoea layout</strong>; leave empty for <strong>standard layout</strong>.
</div>
            <input type="text" id="product_heading" class="form-control" 
                   name="product_heading"
                   value="{{ $fetch_product_details->product_heading ?? '' }}" 
                   placeholder="Enter product heading name" >
        </div>
    
       <!-- Product Info Image -->
<div class="col-md-6">
    <label for="product_info_image" class="form-label">Product Info Image</label>

    @if(!empty($fetch_product_details->product_info_image))
        <div class="mb-2">
            <img src="{{ asset('public/assets/images/products/info/'.$fetch_product_details->product_info_image) }}" 
                 alt="{{ $fetch_product_details->product_info_image_alt ?? 'Product Info Image' }}" 
                 class="img-thumbnail" width="120">
        </div>
    @endif

    <input type="file" 
           id="product_info_image" 
           class="form-control mb-2"
           name="product_info_image" 
           accept="image/*">

    <input type="hidden" 
           name="old_product_info_image" 
           value="{{ $fetch_product_details->product_info_image ?? '' }}">

    <!-- ALT Tag Input -->
    <label for="product_info_image_alt" class="form-label mt-2">
        Product Info Image ALT Text
    </label>
    <input type="text" 
           id="product_info_image_alt"
           class="form-control"
           name="product_info_image_alt"
           placeholder="Enter image alt text"
           value="{{ $fetch_product_details->product_info_image_alt ?? '' }}">
</div>

        <!-- Product Info Description -->
        <div class="col-md-12" >
            <label for="product_info_description" style="margin-top: 25px;" class="form-label">Product Information Description</label>
            <textarea id="product_info_description" 
                      class="form-control editor" rows="5"
                      name="product_info_description"
                      placeholder="Enter detailed product information here">{{ $fetch_product_details->product_info_desc ?? '' }}</textarea>
        </div>
    </div>
    </div>
    </section>
<p class="section-divider"></p>

    <!-- Section 2.1: Product Information -->
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4"> Section 2.1: Product Information </h4>
            <div style="background: #fff8e1; border-left: 4px solid #f9a825; border-radius: 6px;
            padding: 12px 16px; margin-bottom: 20px; font-size: 14px; color: #5d4037;">
    <strong>ℹ️ Note:</strong>
    Filling this section will display the product page in the
    <strong>Zonoea layout</strong> — a two-column format with extended product information.
    If you leave this section empty, the product page will follow the
    <strong>standard layout</strong> used for regular product entries.
</div>
    <div class="row g-3 mt-2">
        <!-- Product Information Heading -->
        <div class="col-md-6">
            <label for="product_info_heading_2_1" class="form-label">Product Information Heading</label>
            <input type="text" id="product_info_heading_2_1" class="form-control"
                   name="product_info_heading_2_1"
                   value="{{ $fetch_product_details->product_info_heading_2_1 ?? '' }}"
                   placeholder="Enter product information heading">
        </div>
    
        <!-- Product Information Title -->
        <div class="col-md-6">
            <label for="product_info_title_2_1" class="form-label">Product Information Title</label>
            <input type="text" id="product_info_title_2_1" class="form-control"
                   name="product_info_title_2_1"
                   value="{{ $fetch_product_details->product_info_title_2_1 ?? '' }}"
                   placeholder="Enter product information title">
        </div>
    
        <!-- Product Information Description -->
        <div class="col-md-12" style="margin-top: 25px;" >
            <label for="product_info_description_2_1" class="form-label">Product Information Description</label>
            <textarea id="editor5" class="form-control editor"
                      name="product_info_description_2_1"
                      placeholder="Enter detailed product information">{{ $fetch_product_details->product_info_description_2_1 ?? '' }}</textarea>
        </div>
    
        <!-- Product Information Image -->
        <div class="col-md-6" style="margin-top: 25px;">
            <label for="product_info_image_2_1" class="form-label">Product Information Image</label>
            @if(!empty($fetch_product_details->product_info_image_2_1))
                <div class="mb-2">
                    <img src="{{ asset('public/assets/images/products/info/'.$fetch_product_details->product_info_image_2_1) }}" 
                         alt="Product Info Image" class="img-thumbnail" width="120">
                </div>
            @endif
            <input type="file" id="product_info_image_2_1" class="form-control"
                   name="product_info_image_2_1" accept="image/*">
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

        <input type="text" class="form-control mb-2" name="features_heading"
               value="{{ $fetch_product_details->features_heading }}" 
               placeholder="Enter features section heading">

        <input type="text" class="form-control mb-2" name="features_description"
               value="{{ $fetch_product_details->features_description }}" 
               placeholder="Enter short features description">

        <table class="table table-bordered" id="features_table">
            <thead>
                <tr>
                    <th>Icon</th>
                    <th>Icon ALT</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>
                        <button type="button" class="btn btn-sm btn-success" onclick="addFeature()">+</button>
                    </th>
                </tr>
            </thead>
            <tbody>
            @foreach(json_decode($fetch_product_details->features, true) ?? [] as $f)
                <tr>
                    <!-- Icon -->
                    <td>
                        @if(!empty($f['icon']))
                            <img src="{{ asset('public/assets/images/products/features/'.$f['icon']) }}" 
                                 alt="{{ $f['icon_alt'] ?? '' }}" 
                                 width="40"><br>
                        @endif

                        <input type="file" 
                               name="features_icon[]" 
                               class="form-control mt-1" 
                               accept="image/*,.svg,.webp">

                        <input type="hidden" 
                               name="old_features_icon[]" 
                               value="{{ $f['icon'] }}">
                    </td>

                    <!-- Icon ALT -->
                    <td>
                        <input type="text" 
                               name="features_icon_alt[]" 
                               class="form-control"
                               value="{{ $f['icon_alt'] ?? '' }}"
                               placeholder="Enter icon alt text">
                    </td>

                    <!-- Title -->
                    <td>
                        <input type="text" 
                               name="features_title[]" 
                               class="form-control"
                               value="{{ $f['title'] }}"
                               placeholder="Enter feature title">
                    </td>

                    <!-- Description -->
                    <td>
                        <input type="text" 
                               name="features_desc[]" 
                               class="form-control"
                               value="{{ $f['description'] }}"
                               placeholder="Enter feature description">
                    </td>

                    <!-- Remove -->
                    <td>
                        <button type="button" 
                                class="btn btn-sm btn-danger"
                                onclick="this.closest('tr').remove()">X</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
</section>

<p class="section-divider"></p>


    <!-- Section 4: Applications by Industry -->
   
    <section class="product-section bg-light py-4">
        <div class="container">
            <h4 class="section-heading mb-4">Section 4: Applications by Industry</h4>
    <!-- Applications Heading -->
    <div class="mb-3">
        <label for="applications_heading" class="form-label">Section Heading</label>
        <input type="text" id="applications_heading" 
               class="form-control" name="applications_heading"
               value="{{ $fetch_product_details->applications_heading ?? '' }}" 
               placeholder="Enter applications section heading">
    </div>
    
    <!-- Applications Description (new field) -->
    <div class="mb-4">
        <label for="applications_description" class="form-label">Section Description</label>
        <textarea id="applications_description" 
                  class="form-control" name="applications_description" rows="3"
                  placeholder="Enter applications section description">{{ $fetch_product_details->applications_description ?? '' }}</textarea>
    </div>
    
    <!-- Applications Table -->
    <table class="table table-bordered" id="applications_table">
        <thead>
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th>
                    <button type="button" class="btn btn-sm btn-success" onclick="addApplication()">+</button>
                </th>
            </tr>
        </thead>
<tbody>
@foreach(json_decode($fetch_product_details->applications, true) ?? [] as $a)
    <tr>
        <!-- Image -->
        <td>
            @if(!empty($a['image']))
                <img src="{{ asset('public/assets/images/products/applications/'.$a['image']) }}"
                     alt="{{ $a['image_alt'] ?? '' }}"
                     width="40" class="mb-1"><br>
            @endif

            <input type="file" 
                   name="applications_image[]" 
                   class="form-control mt-1" 
                   accept="image/*">

            <input type="hidden" 
                   name="old_applications_image[]" 
                   value="{{ $a['image'] ?? '' }}">
        </td>

        <!-- Image ALT -->
        <td>
            <input type="text" 
                   name="applications_image_alt[]" 
                   class="form-control"
                   value="{{ $a['image_alt'] ?? '' }}"
                   placeholder="Enter image alt text">
        </td>

        <!-- Title -->
        <td>
            <input type="text" 
                   name="applications_title[]" 
                   class="form-control"
                   value="{{ $a['title'] ?? '' }}"
                   placeholder="Enter application title">
        </td>

        <!-- Description -->
        <td>
            <input type="text" 
                   name="applications_desc[]" 
                   class="form-control"
                   value="{{ $a['description'] ?? '' }}"
                   placeholder="Enter application description">
        </td>

        <!-- Remove -->
        <td>
            <button type="button" 
                    class="btn btn-sm btn-danger"
                    onclick="this.closest('tr').remove()">X</button>
        </td>
    </tr>
@endforeach
</tbody>
    </table>
    
    </div>
    </section>
     <p class="section-divider"></p>
   
  <!-- Section 5: Our Certifications -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 5: Our Certifications</h4>

        <div class="mb-5 border-bottom pb-3" style="margin-top: 61px;">

            <div class="mb-2">
                <label>Heading</label>
                <input type="text" class="form-control"
                       name="certification_heading"
                       placeholder="Enter Certifications Heading"
                       value="{{ old('certification_heading', $fetch_product_details->certification_heading ?? '') }}">
            </div>

            <div class="mb-2" style="margin-top: 25px;">
                <label>Description</label>
                <input type="text" class="form-control"
                       name="certification_description"
                       placeholder="Enter Certifications Description"
                       value="{{ old('certification_description', $fetch_product_details->certification_description ?? '') }}">
            </div>

            <table class="table table-bordered" id="certification_table">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Image ALT</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>
                            <button type="button" class="btn btn-sm btn-success" onclick="addCertification()">+</button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $certifications = json_decode($fetch_product_details->certifications ?? '[]', true);
                    @endphp

                    @if (is_array($certifications))
                        @foreach($certifications as $i => $cert)
                            <tr>
                                <!-- Image -->
                                <td>
                                    @if(!empty($cert['image']))
                                        <img src="{{ asset('public/assets/images/products/certifications/' . $cert['image']) }}"
                                             alt="{{ $cert['image_alt'] ?? '' }}"
                                             width="60" class="mb-2">
                                    @endif

                                    <input type="file"
                                           name="certification[image][{{ $i }}]"
                                           class="form-control"
                                           accept="image/*,.svg,.webp">

                                    <input type="hidden"
                                           name="old_certifications[{{ $i }}][image]"
                                           value="{{ $cert['image'] ?? '' }}">
                                </td>

                                <!-- Image ALT -->
                                <td>
                                    <input type="text"
                                           class="form-control"
                                           name="certification[image_alt][{{ $i }}]"
                                           value="{{ $cert['image_alt'] ?? '' }}"
                                           placeholder="Enter image alt text">
                                </td>

                                <!-- Title -->
                                <td>
                                    <input type="text"
                                           class="form-control"
                                           name="certification[title][{{ $i }}]"
                                           value="{{ $cert['title'] ?? '' }}"
                                           placeholder="Title">
                                </td>

                                <!-- Description -->
                                <td>
                                    <input type="text"
                                           class="form-control"
                                           name="certification[description][{{ $i }}]"
                                           value="{{ $cert['description'] ?? '' }}"
                                           placeholder="Description">
                                </td>

                                <!-- Remove -->
                                <td>
                                    <button type="button"
                                            class="btn btn-sm btn-danger"
                                            onclick="removeRow(this)">x</button>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
</section>


<p class="section-divider"></p>

    <!-- Section 6: General Specifications -->
    <section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 6: General Specifications</h4>
        <div class="mb-2">    <label>Heading Specifications</label>
    <input type="text" class="form-control" name="heading_specifications"
           value="{{ $fetch_product_details->specs_heading }}"
           placeholder="Enter Heading Specifications">
</div>
   
    <table class="table table-bordered" id="specs_table">
    <thead>
    <tr>
        @php
            // Default column names if not set
            $columns = json_decode($fetch_product_details->specs_columns, true) ?? ['Parameter', 'Details'];
        @endphp

        @foreach($columns as $c)
            <th>
                <input type="text" name="specs_columns[]" class="form-control"
                       value="{{ $c }}" placeholder="Column Name">
            </th>
        @endforeach

        <th>
            <button type="button" class="btn btn-sm btn-success" onclick="addSpec()">+</button>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($fetch_product_details->specifications, true) ?? [] as $s)
        <tr>
            <td><input type="text" name="specs_param[]" class="form-control" value="{{ $s['parameter'] ?? '' }}" placeholder="Enter {{ $columns[0] }}"></td>
            <td><input type="text" name="specs_detail[]" class="form-control" value="{{ $s['detail'] ?? '' }}" placeholder="Enter {{ $columns[1] }}"></td>
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
        <input type="text" class="form-control mb-2" name="spreadsheet_heading"
           value="{{ $fetch_product_details->spreadsheet_heading }}" placeholder="Enter spreadsheet section heading">
    <table class="table table-bordered" id="sheets_table">
        <thead>
        <tr>
            <th>Title</th>
            <th>File</th>
            <th><button type="button" class="btn btn-sm btn-success" onclick="addSheet()">+</button></th>
        </tr>
        </thead>
        <tbody>
        @foreach(json_decode($fetch_product_details->spreadsheets, true) ?? [] as $sh)
            <tr>
                <td><input type="text" name="sheet_title[]" class="form-control" value="{{ $sh['title'] }}" placeholder="Enter spreadsheet title"></td>
                <td>
                    @if($sh['file'])
                        <a href="{{ asset('public/assets/documents/products/spreadsheets/'.$sh['file']) }}" target="_blank">{{ $sh['file'] }}</a><br>
                    @endif
                    <input type="file" name="sheet_file[]" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx">
                    <input type="hidden" name="old_sheet_file[]" value="{{ $sh['file'] }}">
                </td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
</section>

<p class="section-divider"></p>

   <!-- Section 7: Safety -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 7: Safety</h4>

        <textarea class="form-control editor"
                  name="safety_description"
                  id="editor1"
                  placeholder="Enter safety and handling information">
            {{ $fetch_product_details->safety_description }}
        </textarea>

        @if($fetch_product_details->safety_image)
            <div class="mb-2">
                <img src="{{ asset('public/assets/images/products/safety/'.$fetch_product_details->safety_image) }}"
                     alt="{{ $fetch_product_details->safety_image_alt ?? '' }}"
                     width="120">
            </div>
        @endif

        <input type="file"
               class="form-control mt-2"
               name="safety_image"
               accept="image/*">

        <input type="hidden"
               name="old_safety_image"
               value="{{ $fetch_product_details->safety_image }}">

        <!-- ✅ ALT Tag -->
        <input type="text"
               class="form-control mt-2"
               name="safety_image_alt"
               placeholder="Enter safety image alt text"
               value="{{ $fetch_product_details->safety_image_alt ?? '' }}">
    </div>
</section>

<p class="section-divider"></p>


   <!-- Section 9: Why Choose -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 9: Why Choose</h4>

        <textarea class="form-control editor"
                  name="why_choose_description"
                  id="editor"
                  placeholder="Enter reasons why customers should choose this product">
            {{ $fetch_product_details->why_choose_desc }}
        </textarea>

        @if($fetch_product_details->why_choose_image)
            <div class="mb-2">
                <img src="{{ asset('public/assets/images/products/why_choose/'.$fetch_product_details->why_choose_image) }}"
                     alt="{{ $fetch_product_details->why_choose_image_alt ?? '' }}"
                     width="120">
            </div>
        @endif

        <input type="file"
               class="form-control mt-2"
               name="why_choose_image"
               accept="image/*">

        <input type="hidden"
               name="old_why_choose_image"
               value="{{ $fetch_product_details->why_choose_image }}">

        <!-- ✅ ALT Tag -->
        <input type="text"
               class="form-control mt-2"
               name="why_choose_image_alt"
               placeholder="Enter why choose image alt text"
               value="{{ $fetch_product_details->why_choose_image_alt ?? '' }}">
    </div>
</section>


<p class="section-divider"></p>

    <!-- Section 10: Quote -->
    <section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 10: Quote </h4>
    <input type="text" class="form-control mb-2" name="quote_title" value="{{ $fetch_product_details->quote_title }}" placeholder="Enter quote section title">
    <textarea class="form-control mb-2" name="quote_description" placeholder="Enter short description for quote">{{ $fetch_product_details->quote_description }}</textarea>
    <input type="text" class="form-control mb-2" name="quote_contact" value="{{ $fetch_product_details->quote_contact }}" placeholder="Enter contact number">
    <input type="email" class="form-control mb-2" name="quote_email" value="{{ $fetch_product_details->quote_email }}" placeholder="Enter contact email">

</div>
</section>
<p class="section-divider"></p>


    <!-- Section 11: FAQs -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 11: FAQs </h4>
        <div class="mb-2">
            <label>Heading</label>
            <input type="text" class="form-control" 
                   name="faqs_heading"  placeholder="Enter Faqs Heading"
                   value="{{ old('faqs_heading', $fetch_product_details->faqs_heading) }}">
        </div>

        <table class="table table-bordered w-100" id="faqs_table">
            <thead>
                <tr>
                    <th style="width: 40%;">Question</th>
                    <th style="width: 50%;">Answer</th>
                    <th style="width: 10%;">
                        <button type="button" class="btn btn-sm btn-success" onclick="addFaq()">+</button>
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach(json_decode($fetch_product_details->faqs, true) ?? [] as $faq)
                    <tr>
                        <td>
                            <input type="text" name="faq_question[]" class="form-control w-100" 
                                   value="{{ $faq['question'] }}" placeholder="Enter FAQ question">
                        </td>
                        <td>
                            <textarea name="faq_answer[]" class="form-control w-100" 
                                      id="editor8" placeholder="Enter FAQ answer">{{ $faq['answer'] }}</textarea>
                        </td>
                        <td>
                            <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
    <p class="section-divider"></p>

    
    <!-- Section 12: Applications Across Industries -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">Section 12: Applications Across Industries </h4>
<!-- Section Heading -->
<div class="mb-3">
    <label for="applications_industries_heading" class="form-label">Applications Across Industries Heading</label>
    <input type="text" id="applications_industries_heading" class="form-control"
           name="applications_industries_heading"
           value="{{ $fetch_product_details->applications_industries_heading ?? '' }}"
           placeholder="Enter section heading">
</div>

<!-- Applications Table -->
<table class="table table-bordered" id="applications_industries_table">
    <thead>
    <tr>
        <th>Title</th>
        <th>Description</th>
        <th>
            <button type="button" class="btn btn-sm btn-success" onclick="addIndustryApplication()">+</button>
        </th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode($fetch_product_details->applications_industries ?? '[]', true) as $index => $ai)
        <tr>
            <td>
                <input type="text" name="applications_industries_title[]" 
                       class="form-control" 
                       value="{{ $ai['title'] ?? '' }}" 
                       placeholder="Enter title">
            </td>
            <td>
                <textarea name="applications_industries_desc[]" 
                          class="form-control editor6"
                          placeholder="Enter description">{{ $ai['description'] ?? '' }}</textarea>
            </td>
            <td>
                <button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

</div>
</section>

 <!-- Section 12: Applications Across Industries -->
<section class="product-section bg-light py-4">
    <div class="container">
        <h4 class="section-heading mb-4">SEO </h4>
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
<br>
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
        <br>
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

<br>

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
<br>


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
<br>
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
</div>
</section>
    <div class="mt-4">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
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
<script>
    function addFeature() {
        document.querySelector("#features_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="file" name="features_icon[]" class="form-control" accept="image/*,.svg,.webp"></td>
                <td><input type="text" name="features_icon_alt[]" class="form-control"></td>
                <td><input type="text" name="features_title[]" class="form-control"></td>
                <td><input type="text" name="features_desc[]" class="form-control"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

    function addApplication() {
        document.querySelector("#applications_table tbody").insertAdjacentHTML("beforeend",
            `<tr>
                <td><input type="file" name="applications_image[]" class="form-control" accept="image/*"></td>
                                <td><input type="text" name="applications_image_alt[]" class="form-control"></td>

                <td><input type="text" name="applications_title[]" class="form-control"></td>
                <td><input type="text" name="applications_desc[]" class="form-control"></td>
                <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
            </tr>`);
    }

   function addSpec() {
    document.querySelector("#specs_table tbody").insertAdjacentHTML("beforeend",
        `<tr>
            <td><input type="text" name="specs_param[]" class="form-control" placeholder="Enter parameter"></td>
            <td><input type="text" name="specs_detail[]" class="form-control" placeholder="Enter detail"></td>
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

   
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {

    // Function to initialize CKEditor on a given textarea
    function initEditor(textarea) {
        ClassicEditor
            .create(textarea)
            .catch(error => console.error(error));
    }

    // Initialize CKEditor for existing FAQ textareas
    document.querySelectorAll('#faqs_table textarea').forEach(initEditor);

    // Add FAQ row
    window.addFaq = function() {
        const tbody = document.querySelector("#faqs_table tbody");
        const tr = document.createElement('tr');

        tr.innerHTML = `
            <td><input type="text" name="faq_question[]" class="form-control" placeholder="Enter FAQ Question"></td>
            <td><textarea name="faq_answer[]" class="form-control" placeholder="Enter FAQ Answer"></textarea></td>
            <td><button type="button" class="btn btn-sm btn-danger" onclick="this.closest('tr').remove()">X</button></td>
        `;

        tbody.appendChild(tr);

        // Initialize CKEditor for the newly added textarea
        initEditor(tr.querySelector('textarea'));
    };

    // Attach submit listener to update all textareas with CKEditor data
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        document.querySelectorAll('#faqs_table textarea').forEach(textarea => {
            const editorInstance = textarea._ckeditorInstance;
            if (editorInstance) {
                textarea.value = editorInstance.getData();
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
<script>
    let certificationIndex = {{ isset($certifications) && is_array($certifications) ? count($certifications) : 0 }};

    function addCertification() {
        let row = `
            <tr>
                <td>
                    <input type="file" name="certification[image][${certificationIndex}]" class="form-control" accept="image/*,.svg,.webp">
                </td>
                <td>
                    <input type="text" class="form-control" name="certification[title][${certificationIndex}]" placeholder="Title">
                </td>
                <td>
                    <input type="text" class="form-control" name="certification[description][${certificationIndex}]" placeholder="Description">
                </td>
                <td>
                    <button type="button" class="btn btn-sm btn-danger" onclick="removeRow(this)">x</button>
                </td>
            </tr>
        `;
        document.querySelector("#certification_table tbody").insertAdjacentHTML('beforeend', row);
        certificationIndex++;
    }

    function removeRow(btn) {
        btn.closest("tr").remove();
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
</script>		<style>
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
