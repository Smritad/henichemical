<?php

use Illuminate\Support\Facades\Route;

/*  Frontend Routes   */
    //  Home
    Route::get('/clear', function() {
  Artisan::call('cache:clear');
  Artisan::call('config:clear');
  Artisan::call('config:cache');
  Artisan::call('view:clear');

  return "Cleared!";
});





// web.php
// web.php





    Route::get('/', 'App\Http\Controllers\FrontendController@index')->name('/');
    //404 page
//     Route::get('error-page',  [App\Http\Controllers\FrontendController::class, 'error_page'])->name('error_page');

// // fallback route to redirect all 404s
// Route::fallback(function () {
//     return redirect()->route('error_page');
// });
//Route::get('/test-urls', [App\Http\Controllers\FrontendController::class, 'test_url'])->name('test_url');
    //  About Us
    

/* LOGIN PAGES (GET) */
Route::get('/61ap0-91kjdser-Ediuf82391', function () {
    return view('auth.login');
});

Route::get('/70af9-83mbrdsg-Djpqf23141', function () {
    return view('auth.login');
});

Route::get('/90fh9-83kjsdf-Fjsdfl9231', function () {
    return view('auth.login');
});

Route::get('/P0A61-k9JDSER-EdIuF381', function () {
    return view('auth.login');
});


/* LOGOUT */

    Auth::routes();
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('is_admin');
       
//  Admin Dashboard
    Route::get('/admin/home', [App\Http\Controllers\HomeController::class, 'admin_home'])->name('admin.admin_home')->middleware('is_admin');

    //  About Us Details
    Route::get('about-us-details', [App\Http\Controllers\AdminController::class, 'about_us_details'])->name('admin.about_us_details')->middleware('is_admin');
    
    //  About Us History
    Route::get('about-us-history', [App\Http\Controllers\AdminController::class, 'show_about_us_history'])->name('admin.show_about_us_history')->middleware('is_admin');
    Route::post('update-about-us-history', [App\Http\Controllers\AdminController::class, 'update_about_us_history'])->name('admin.update_about_us_history')->middleware('is_admin');

    //  About Us R & Dlist-contact-us-enquiry
    Route::get('about-us-r-and-d', [App\Http\Controllers\AdminController::class, 'show_about_us_r_and_d'])->name('admin.show_about_us_r_and_d')->middleware('is_admin');
    Route::post('update-about-us-r-and-d', [App\Http\Controllers\AdminController::class, 'update_about_us_r_and_d'])->name('admin.update_about_us_r_and_d')->middleware('is_admin');

    //  About Us Quality Control
    Route::get('about-us-quality-control', [App\Http\Controllers\AdminController::class, 'show_about_us_quality_control'])->name('admin.show_about_us_quality_control')->middleware('is_admin');
    Route::post('update-about-us-quality-control', [App\Http\Controllers\AdminController::class, 'update_about_us_quality_control'])->name('admin.update_about_us_quality_control')->middleware('is_admin');

    //  About Us Why ZON
    Route::get('list-about-us-why-zonte', [App\Http\Controllers\AdminController::class, 'list_about_us_why_zon'])->name('admin.list_about_us_why_zon')->middleware('is_admin');
    Route::get('edit-about-us-why-zon/{id?}', [App\Http\Controllers\AdminController::class, 'view_about_us_why_zon_details'])->name('admin.view_about_us_why_zon_details')->middleware('is_admin');
    Route::post('edit-about-us-why-zon-form', [App\Http\Controllers\AdminController::class, 'edit_about_us_why_zon'])->name('admin.edit_about_us_why_zon')->middleware('is_admin');

    //  Basic Details
    Route::get('update-basic-details', [App\Http\Controllers\AdminController::class, 'show_update_basic_details'])->name('admin.show_update_basic_details')->middleware('is_admin');
    Route::post('update-basic-details-form', [App\Http\Controllers\AdminController::class, 'update_basic_details'])->name('admin.update_basic_details')->middleware('is_admin');

    //  Brochures
    Route::get('list-brochures', [App\Http\Controllers\AdminController::class, 'list_brochures'])->name('admin.list_brochures')->middleware('is_admin');
    Route::get('add-brochure', [App\Http\Controllers\AdminController::class, 'show_add_brochure'])->name('admin.show_add_brochure')->middleware('is_admin');
    Route::post('add-brochure-form', [App\Http\Controllers\AdminController::class, 'add_brochure'])->name('admin.add_brochure')->middleware('is_admin');
    Route::get('edit-brochure/{id?}', [App\Http\Controllers\AdminController::class, 'view_brochure_details'])->name('admin.view_brochure_details')->middleware('is_admin');
    Route::post('edit-brochure-form', [App\Http\Controllers\AdminController::class, 'edit_brochure'])->name('admin.edit_brochure')->middleware('is_admin');
    Route::get('delete-brochure/{id?}', [App\Http\Controllers\AdminController::class, 'delete_brochure'])->name('admin.delete_brochure')->middleware('is_admin');
    Route::get('deactivate-brochure/{id?}', [App\Http\Controllers\AdminController::class, 'deactivate_brochure'])->name('admin.deactivate_brochure')->middleware('is_admin');
    Route::get('activate-brochure/{id?}', [App\Http\Controllers\AdminController::class, 'activate_brochure'])->name('admin.activate_brochure')->middleware('is_admin');
//  Brands & Products
    Route::get('list-brands-and-products', [App\Http\Controllers\AdminController::class, 'list_brands_and_products'])->name('admin.list_brands_and_products')->middleware('is_admin');
        Route::get('listing-products', [App\Http\Controllers\AdminController::class, 'listing_products'])->name('admin.listing-products')->middleware('is_admin');
        

Route::get('activate-product-listing/{id}', [App\Http\Controllers\AdminController::class, 'activate_product_listing'])
    ->name('admin.activate_product_listing');

Route::get('deactivate-product-listing/{id}', [App\Http\Controllers\AdminController::class, 'deactivate_product_listing'])
    ->name('admin.deactivate_product_listing');
    
    Route::get('add-brands-and-products', [App\Http\Controllers\AdminController::class, 'show_add_brands_and_products'])->name('admin.show_add_brands_and_products')->middleware('is_admin');
    Route::post('add-brands-and-products-form', [App\Http\Controllers\AdminController::class, 'add_brands_and_products'])->name('admin.add_brands_and_products')->middleware('is_admin');
    Route::get('edit-brands-and-products/{id?}', [App\Http\Controllers\AdminController::class, 'view_brands_and_products_details'])->name('admin.view_brands_and_products_details')->middleware('is_admin');
    Route::post('edit-brands-and-products-form', [App\Http\Controllers\AdminController::class, 'edit_brands_and_products'])->name('admin.edit_brands_and_products')->middleware('is_admin');
    Route::get('delete-brands-and-products/{id?}', [App\Http\Controllers\AdminController::class, 'delete_brands_and_products'])->name('admin.delete_brands_and_products')->middleware('is_admin');
    Route::get('deactivate-brands-and-products/{id?}', [App\Http\Controllers\AdminController::class, 'deactivate_brands_and_products'])->name('admin.deactivate_brands_and_products')->middleware('is_admin');
    Route::get('activate-brands-and-products/{id?}', [App\Http\Controllers\AdminController::class, 'activate_brands_and_products'])->name('admin.activate_brands_and_products')->middleware('is_admin');

    //  Home Page Details
    Route::get('home-page-details', [App\Http\Controllers\AdminController::class, 'home_page_details'])->name('admin.home_page_details')->middleware('is_admin');

    //  Banner
    Route::get('list-banners', [App\Http\Controllers\AdminController::class, 'list_banners'])->name('admin.list_banners')->middleware('is_admin');
    Route::get('add-banner', [App\Http\Controllers\AdminController::class, 'show_add_banner'])->name('admin.show_add_banner')->middleware('is_admin');
    Route::post('add-banner-form', [App\Http\Controllers\AdminController::class, 'add_banner'])->name('admin.add_banner')->middleware('is_admin');
    Route::get('edit-banner/{id?}', [App\Http\Controllers\AdminController::class, 'view_banner_details'])->name('admin.view_banner_details')->middleware('is_admin');
    Route::post('edit-banner-form', [App\Http\Controllers\AdminController::class, 'edit_banner'])->name('admin.edit_banner')->middleware('is_admin');
    Route::get('delete-banner/{id?}', [App\Http\Controllers\AdminController::class, 'delete_banner'])->name('admin.delete_banner')->middleware('is_admin');
    Route::get('deactivate-banner/{id?}', [App\Http\Controllers\AdminController::class, 'deactivate_banner'])->name('admin.deactivate_banner')->middleware('is_admin');
    Route::get('activate-banner/{id?}', [App\Http\Controllers\AdminController::class, 'activate_banner'])->name('admin.activate_banner')->middleware('is_admin');

    //  Key Points
    Route::get('list-key-points', [App\Http\Controllers\AdminController::class, 'list_key_points'])->name('admin.list_key_points')->middleware('is_admin');
    Route::get('edit-key-point/{id?}', [App\Http\Controllers\AdminController::class, 'view_key_point_details'])->name('admin.view_key_point_details')->middleware('is_admin');
    Route::post('edit-key-point-form', [App\Http\Controllers\AdminController::class, 'edit_key_point'])->name('admin.edit_key_point')->middleware('is_admin');

    //  Certificates
    Route::get('list-certificates', [App\Http\Controllers\AdminController::class, 'list_certificates'])->name('admin.list_certificates')->middleware('is_admin');
    Route::get('edit-certificate/{id?}', [App\Http\Controllers\AdminController::class, 'view_certificate_details'])->name('admin.view_certificate_details')->middleware('is_admin');
    Route::post('edit-certificate-form', [App\Http\Controllers\AdminController::class, 'edit_certificate'])->name('admin.edit_certificate')->middleware('is_admin');
Route::get('admin/show_add_certificate', [App\Http\Controllers\AdminController::class, 'show_add_certificate'])->name('admin.show_add_certificate');
Route::post('admin/add_certificate', [App\Http\Controllers\AdminController::class, 'add_certificate'])->name('admin.add_certificate');
Route::get('admin/delete-certificate/{id}', [App\Http\Controllers\AdminController::class, 'delete_certificate'])
    ->name('admin.delete_certificate');

    
    //  Products
    Route::get('list-products/{id?}', [App\Http\Controllers\AdminController::class, 'list_products'])->name('admin.list_products')->middleware('is_admin');
    Route::get('add-product/{id?}', [App\Http\Controllers\AdminController::class, 'show_add_product'])->name('admin.show_add_product')->middleware('is_admin');
    Route::post('add-product-form', [App\Http\Controllers\AdminController::class, 'add_product'])->name('admin.add_product')->middleware('is_admin');
    Route::get('edit-product/{id?}', [App\Http\Controllers\AdminController::class, 'view_product_details'])->name('admin.view_product_details')->middleware('is_admin');
    // listing add/edit product 
        Route::get('list-products-listing/{id?}', [App\Http\Controllers\AdminController::class, 'list_products_listing'])->name('admin.list_products_listing')->middleware('is_admin');

        Route::get('edit-product-listing/{id?}', [App\Http\Controllers\AdminController::class, 'view_product_details_listing'])->name('admin.view_product_details_listing')->middleware('is_admin');
        Route::get('add-product-listing/{id?}', [App\Http\Controllers\AdminController::class, 'show_add_product_listing'])->name('admin.show_add_product_listing')->middleware('is_admin');
Route::delete('delete-product-listing/{id}', [App\Http\Controllers\AdminController::class, 'delete_product_listing'])
    ->name('admin.delete_product_listing')
    ->middleware('is_admin');

    Route::post('add-product-form-listing', [App\Http\Controllers\AdminController::class, 'add_product_listing'])->name('admin.add_product_listing')->middleware('is_admin');
    Route::post('edit-product-form-listing', [App\Http\Controllers\AdminController::class, 'edit_product_listing'])->name('admin.edit_product_listing')->middleware('is_admin');

    Route::post('edit-product-form', [App\Http\Controllers\AdminController::class, 'edit_product'])->name('admin.edit_product')->middleware('is_admin');
    Route::get('delete-product/{id?}', [App\Http\Controllers\AdminController::class, 'delete_product'])->name('admin.delete_product')->middleware('is_admin');
    Route::get('deactivate-product/{id?}', [App\Http\Controllers\AdminController::class, 'deactivate_product'])->name('admin.deactivate_product')->middleware('is_admin');
    Route::get('activate-product/{id?}', [App\Http\Controllers\AdminController::class, 'activate_product'])->name('admin.activate_product')->middleware('is_admin');
    Route::get('delete-document/{id?}/{document?}', [App\Http\Controllers\AdminController::class, 'delete_document'])->name('admin.delete_document')->middleware('is_admin');
    
    //  Product Applications
    Route::get('list-product-applications/{id?}', [App\Http\Controllers\AdminController::class, 'list_product_applications'])->name('admin.list_product_applications')->middleware('is_admin');
    Route::post('add-product-application', [App\Http\Controllers\AdminController::class, 'add_product_application'])->name('admin.add_product_application')->middleware('is_admin');
    Route::get('delete-product-application/{id?}', [App\Http\Controllers\AdminController::class, 'delete_product_application'])->name('admin.delete_product_application')->middleware('is_admin');

    //  Careers Details
    Route::get('career-details', [App\Http\Controllers\AdminController::class, 'career_details'])->name('admin.career_details')->middleware('is_admin');

    //  Career Page Details
    Route::get('career-page-details', [App\Http\Controllers\AdminController::class, 'show_career_page_details'])->name('admin.show_career_page_details')->middleware('is_admin');
    Route::post('update-career-page-details', [App\Http\Controllers\AdminController::class, 'update_career_page_details'])->name('admin.update_career_page_details')->middleware('is_admin');

    //  Job Posts
    Route::get('list-job-posts/{id?}', [App\Http\Controllers\AdminController::class, 'list_job_posts'])->name('admin.list_job_posts')->middleware('is_admin');
    Route::get('add-job-post/{id?}', [App\Http\Controllers\AdminController::class, 'show_add_job_post'])->name('admin.show_add_job_post')->middleware('is_admin');
    Route::post('add-job-post-form', [App\Http\Controllers\AdminController::class, 'add_job_post'])->name('admin.add_job_post')->middleware('is_admin');
    Route::get('edit-job-post/{id?}', [App\Http\Controllers\AdminController::class, 'view_job_post_details'])->name('admin.view_job_post_details')->middleware('is_admin');
    Route::post('edit-job-post-form', [App\Http\Controllers\AdminController::class, 'edit_job_post'])->name('admin.edit_job_post')->middleware('is_admin');
    Route::get('delete-job-post/{id?}', [App\Http\Controllers\AdminController::class, 'delete_job_post'])->name('admin.delete_job_post')->middleware('is_admin');
    Route::get('deactivate-job-post/{id?}', [App\Http\Controllers\AdminController::class, 'deactivate_job_post'])->name('admin.deactivate_job_post')->middleware('is_admin');
    Route::get('activate-job-post/{id?}', [App\Http\Controllers\AdminController::class, 'activate_job_post'])->name('admin.activate_job_post')->middleware('is_admin');

    //  Events
    Route::get('list-events/{id?}', [App\Http\Controllers\AdminController::class, 'list_events'])->name('admin.list_events')->middleware('is_admin');
    Route::get('add-event/{id?}', [App\Http\Controllers\AdminController::class, 'show_add_event'])->name('admin.show_add_event')->middleware('is_admin');
    Route::post('add-event-form', [App\Http\Controllers\AdminController::class, 'add_event'])->name('admin.add_event')->middleware('is_admin');
    Route::get('edit-event/{id?}', [App\Http\Controllers\AdminController::class, 'view_event_details'])->name('admin.view_event_details')->middleware('is_admin');
    Route::post('edit-event-form', [App\Http\Controllers\AdminController::class, 'edit_event'])->name('admin.edit_event')->middleware('is_admin');
    Route::get('delete-event/{id?}', [App\Http\Controllers\AdminController::class, 'delete_event'])->name('admin.delete_event')->middleware('is_admin');
    Route::get('deactivate-event/{id?}', [App\Http\Controllers\AdminController::class, 'deactivate_event'])->name('admin.deactivate_event')->middleware('is_admin');
    Route::get('activate-event/{id?}', [App\Http\Controllers\AdminController::class, 'activate_event'])->name('admin.activate_event')->middleware('is_admin');
    Route::get('remove-featured-event/{id?}', [App\Http\Controllers\AdminController::class, 'remove_featured_event'])->name('admin.remove_featured_event')->middleware('is_admin');
    Route::get('mark-featured-event/{id?}', [App\Http\Controllers\AdminController::class, 'mark_featured_event'])->name('admin.mark_featured_event')->middleware('is_admin');
    
    //  Enquiries
    Route::get('list-contact-us-enquiry', [App\Http\Controllers\AdminController::class, 'list_contact_us_enquiry'])->name('admin.list_contact_us_enquiry')->middleware('is_admin');
    
      
   Route::delete('/contact-us-enquiry/bulk-delete', [App\Http\Controllers\AdminController::class, 'bulkDeleteContactEnquiry'])
    ->name('contact-us-enquiry.bulkDelete');
    
    
    Route::get('list-product-document-enquiry', [App\Http\Controllers\AdminController::class, 'list_product_document_enquiry'])->name('admin.list_product_document_enquiry')->middleware('is_admin');
    
    Route::delete('/list-product-document-enquiry/bulk-delete', [App\Http\Controllers\AdminController::class, 'bulkDeletelistproductdocEnquiry'])->name('list-doc-prod-enquiry.bulkDelete')->middleware('is_admin');
    
    
    Route::get('list-product-enquiry', [App\Http\Controllers\AdminController::class, 'list_product_enquiry'])->name('admin.list_product_enquiry')->middleware('is_admin');
    
      Route::delete('/list-product-enquiry/bulk-delete', [App\Http\Controllers\AdminController::class, 'list_product_enquiry_delete'])->name('admin.list_product_enquiry_delete')->middleware('is_admin');
    
    Route::get('list-brochure-enquiry', [App\Http\Controllers\AdminController::class, 'list_brochure_enquiry'])->name('admin.list_brochure_enquiry')->middleware('is_admin');
    
     Route::delete('list-brochure-enquiry/bulk-delete', [App\Http\Controllers\AdminController::class, 'list_brochure_enquiry_delete'])->name('admin.list_brochure_enquiry_delete')->middleware('is_admin');
    
    
    
    
    Route::get('list-job-enquiry', [App\Http\Controllers\AdminController::class, 'list_job_enquiry'])->name('admin.list_job_enquiry')->middleware('is_admin');
    
    
    Route::get('list-job-enquiry/bulk-delete', [App\Http\Controllers\AdminController::class, 'list_job_enquiry_delete'])
->name('admin.list_job_enquiry_delete')
->middleware('is_admin');

    Route::delete('/ist-contact-us-enquiry/delete/{id}', [App\Http\Controllers\AdminController::class, 'delete'])->name('contact-us-enquiry.delete');
Route::delete('/brochure-enquiry/delete/{id}',[App\Http\Controllers\AdminController::class, 'delete_brochure'])->name('brochure-enquiry.delete');

    //  Excel Export
    Route::get('export-contact-us-enquiry', [App\Http\Controllers\AdminController::class, 'export_contact_us_enquiry'])->name('admin.export_contact_us_enquiry')->middleware('is_admin');
    Route::get('export-product-document-enquiry', [App\Http\Controllers\AdminController::class, 'export_product_document_enquiry'])->name('admin.export_product_document_enquiry')->middleware('is_admin');
    Route::get('export-product-enquiry', [App\Http\Controllers\AdminController::class, 'export_product_enquiry'])->name('admin.export_product_enquiry')->middleware('is_admin');
    Route::get('export-brochure-enquiry', [App\Http\Controllers\AdminController::class, 'export_brochure_enquiry'])->name('admin.export_brochure_enquiry')->middleware('is_admin');
    Route::get('export-job-enquiry', [App\Http\Controllers\AdminController::class, 'export_job_enquiry'])->name('admin.export_job_enquiry')->middleware('is_admin');
// routes/web.php
Route::delete('/admin/product/delete-image/{id}', [App\Http\Controllers\AdminController::class, 'deleteProductImage'])
     ->name('admin.product.delete_image')
     ->middleware('is_admin');
    Route::get('about-us', [App\Http\Controllers\FrontendController::class, 'about_us'])->name('about_us');

    //  Contact Us
    Route::get('contact-us', [App\Http\Controllers\FrontendController::class, 'contact_us'])->name('contact_us');
    Route::post('send-contact-us-enquiry', [App\Http\Controllers\FrontendController::class, 'send_contact_us_enquiry'])->name('send_contact_us_enquiry');
    Route::get('thank-you', [App\Http\Controllers\FrontendController::class, 'thank_you'])->name('thank_you');
    Route::get('products', [App\Http\Controllers\FrontendController::class, 'products'])->name('products');
    Route::get('careers', [App\Http\Controllers\FrontendController::class, 'careers'])->name('careers');

    //  Brochure
    Route::get('brochure', [App\Http\Controllers\FrontendController::class, 'brochure'])->name('brochure');
    Route::post('send-brochure-enquiry', [App\Http\Controllers\FrontendController::class, 'send_brochure_enquiry'])->name('send_brochure_enquiry');
    Route::get('{slug}', [App\Http\Controllers\FrontendController::class, 'productApplicationList'])->name('product_application_list');

    //   Products By Brands
    Route::get('products-by-brands/{slug?}', [App\Http\Controllers\FrontendController::class, 'products_by_brands'])->name('products_by_brands');

    //   Products By Applications
    Route::get('products-by-applications/{slug?}', [App\Http\Controllers\FrontendController::class, 'products_by_applications'])->name('products_by_applications');

    //   Product Details
    Route::get('{application_slug}/{slug}', [App\Http\Controllers\FrontendController::class, 'product_details'])->name('product_details');
    Route::post('send-product-document-enquiry', [App\Http\Controllers\FrontendController::class, 'send_product_document_enquiry'])->name('send_product_document_enquiry');
    Route::post('send-product-enquiry', [App\Http\Controllers\FrontendController::class, 'send_product_enquiry'])->name('send_product_enquiry');
    Route::get('application-details', [App\Http\Controllers\FrontendController::class, 'application_details'])->name('application_details');

    //  Careers
    Route::post('send-job-enquiry', [App\Http\Controllers\FrontendController::class, 'send_job_enquiry'])->name('send_job_enquiry');

    //  Products

    //  Search
    Route::post('search', [App\Http\Controllers\FrontendController::class, 'search'])->name('search');
    
    //  Get Product Application Ajax
    Route::get('get-product-applications', [App\Http\Controllers\FrontendController::class, 'get_product_applications'])->name('get_product_applications');

    //  Send OTP
    Route::post('/send-otp', [App\Http\Controllers\FrontendController::class, 'send_otp'])->name('send_otp');

// Route::get('/login', function () {
//     abort(404);
//     return redirect('/'); // or any other page
// });

/*  Backend Routes   */
   
    

    