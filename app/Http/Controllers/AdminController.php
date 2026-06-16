<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use DB;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactUsEnquiryExport;
use App\Exports\ProductDocumentEnquiryExport;
use App\Exports\ProductEnquiryExport;
use App\Exports\BrochureEnquiryExport;
use App\Exports\JobEnquiryExport;

class AdminController extends Controller
{
    
	//	About Us Details
	public function about_us_details()
	{
		return view('admin.about-us.about-us-details');
	}

	
	// About Us History
	public function show_about_us_history()
	{
		$fetch_about_us_history_details = DB::table('about_us_history')
										->where('id','=','1')
										->first();

		return view('admin.about-us.update-about-us-history',compact('fetch_about_us_history_details'));
	}

	public function update_about_us_history(Request $request)
	{
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		$validatedData = $request->validate([
			'description' => 'required',
		],
		[
			'description.required' => 'Please enter description'
		]);

		$fetch_about_us_history_details = DB::table('about_us_history')
										->where('id','=','1')
										->first();

		if($fetch_about_us_history_details)
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/about-us-history'), $uploaded_img_src);
			}
			else
			{
				$uploaded_img_src = $old_img_src;
			}

			$updated_at = now()->timezone('Asia/Kolkata');

			$update_values=array('description'=>$description,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
			$update_query 	= DB::table('about_us_history')
							->where('id','=','1')
							->update($update_values);
		}
		else
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/about-us-history'), $uploaded_img_src);
			}

			$insert_values=array('description'=>$description,'img_src'=>$uploaded_img_src);
		
			$insert_query 	= DB::table('about_us_history')
							->insert($insert_values);
		}
		
		return redirect()->route('admin.about_us_details');
	}


	// About Us R & D
	public function show_about_us_r_and_d()
	{
		$fetch_about_us_r_and_d_details = DB::table('about_us_r_and_d')
										->where('id','=','1')
										->first();

		return view('admin.about-us.update-about-us-r-and-d',compact('fetch_about_us_r_and_d_details'));
	}

	public function update_about_us_r_and_d(Request $request)
	{
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		$validatedData = $request->validate([
			'description' => 'required',
		],
		[
			'description.required' => 'Please enter description'
		]);

		$fetch_about_us_r_and_d_details = DB::table('about_us_r_and_d')
										->where('id','=','1')
										->first();

		if($fetch_about_us_r_and_d_details)
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/about-us-r-and-d'), $uploaded_img_src);
			}
			else
			{
				$uploaded_img_src = $old_img_src;
			}

			$updated_at = now()->timezone('Asia/Kolkata');

			$update_values=array('description'=>$description,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
			$update_query 	= DB::table('about_us_r_and_d')
							->where('id','=','1')
							->update($update_values);
		}
		else
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/about-us-r-and-d'), $uploaded_img_src);
			}

			$insert_values=array('description'=>$description,'img_src'=>$uploaded_img_src);
		
			$insert_query 	= DB::table('about_us_r_and_d')
							->insert($insert_values);
		}
		
		return redirect()->route('admin.about_us_details');
	}


	// About Us Quality Control
	public function show_about_us_quality_control()
	{
		$fetch_about_us_quality_control_details = DB::table('about_us_quality_control')
												->where('id','=','1')
												->first();

		return view('admin.about-us.update-about-us-quality-control',compact('fetch_about_us_quality_control_details'));
	}

	public function update_about_us_quality_control(Request $request)
	{
		$point_one = $request->input('point_one');
		$point_two = $request->input('point_two');
		$no_of_experience = $request->input('no_of_experience');
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		$validatedData = $request->validate([
			'point_one' => 'required',
			'point_two' => 'required',
			'no_of_experience' => 'required',
			'description' => 'required',
		],
		[
			'point_one.required' => 'Please enter point 1',
			'point_two.required' => 'Please enter point 2',
			'no_of_experience.required' => 'Please enter number of years of experience',
			'description.required' => 'Please enter description'
		]);

		$fetch_about_us_quality_control_details = DB::table('about_us_quality_control')
												->where('id','=','1')
												->first();

		if($fetch_about_us_quality_control_details)
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/about-us-quality-control'), $uploaded_img_src);
			}
			else
			{
				$uploaded_img_src = $old_img_src;
			}

			$updated_at = now()->timezone('Asia/Kolkata');

			$update_values=array('point_one'=>$point_one,'point_two'=>$point_two,'no_of_experience'=>$no_of_experience,'description'=>$description,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
			$update_query 	= DB::table('about_us_quality_control')
							->where('id','=','1')
							->update($update_values);
		}
		else
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/about-us-quality-control'), $uploaded_img_src);
			}

			$insert_values=array('point_one'=>$point_one,'point_two'=>$point_two,'no_of_experience'=>$no_of_experience,'description'=>$description,'img_src'=>$uploaded_img_src);
		
			$insert_query 	= DB::table('about_us_quality_control')
							->insert($insert_values);
		}
		
		return redirect()->route('admin.about_us_details');
	}


	// About Us Why ZON
	public function list_about_us_why_zon()
	{
		$list_about_us_why_zon 	= DB::table('about_us_why_zon')
								->where('status','=','1')
								->get();

		return view('admin.about-us.list-about-us-why-zon',compact('list_about_us_why_zon'));
	}

	public function view_about_us_why_zon_details($id)
	{
		$why_zon_id = $id;

		$fetch_about_us_why_zon_details	= DB::table('about_us_why_zon')
										->where('id','=',$why_zon_id)
										->first();

		return view('admin.about-us.edit-about-us-why-zon',compact('fetch_about_us_why_zon_details'));
	}

	public function edit_about_us_why_zon(Request $request)
	{
		$why_zon_id = $request->input('why_zon_id');
		$title = $request->input('title');
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		$validatedData = $request->validate([
			'title' => 'required',
			'description' => 'required',
		],
		[
			'title.required' => 'Please enter title',
			'description.required' => 'Please enter description'
		]);

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/about-us-why-zon'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('title'=>$title,'description'=>$description,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('about_us_why_zon')
						->where('id','=',$why_zon_id)
						->update($values);
		
		return redirect()->route('admin.about_us_details');
	}


	// Basic Details
	public function show_update_basic_details()
	{
		$fetch_basic_details 	= DB::table('basic_details')
								->where('id','=','1')
								->first();

		return view('admin.basic-details.update-basic-details',compact('fetch_basic_details'));
	}

	public function update_basic_details(Request $request)
	{
		$email = $request->input('email');
		$mobile_no = $request->input('mobile_no');
		$enquiry_email = $request->input('enquiry_email');
		$head_office_address = $request->input('head_office_address');
		$site_location = $request->input('site_location');
		$head_office_address_iframe_link = $request->input('head_office_address_iframe_link');
		$site_location_iframe_link = $request->input('site_location_iframe_link');
		$linkedin_link = $request->input('linkedin_link');
		$facebook_link = $request->input('facebook_link');
		$instagram_link = $request->input('instagram_link');
		$youtube_link = $request->input('youtube_link');

		$updated_at = now()->timezone('Asia/Kolkata');

		$update_values=array('email'=>$email,'mobile_no'=>$mobile_no,'enquiry_email'=>$enquiry_email,'head_office_address'=>$head_office_address,'site_location'=>$site_location,'head_office_address_iframe_link'=>$head_office_address_iframe_link,'site_location_iframe_link'=>$site_location_iframe_link,'linkedin_link'=>$linkedin_link,'facebook_link'=>$facebook_link,'instagram_link'=>$instagram_link,'youtube_link'=>$youtube_link,'updated_at'=>$updated_at);
	
		$update_query 	= DB::table('basic_details')
						->where('id','=','1')
						->update($update_values);
		
		return redirect()->back();
	}


	//	Brochures
    public function list_brochures()
	{
		$list_brochures = DB::table('brochures')
						->get();

		return view('admin.brochures.list-brochures',compact('list_brochures'));
	}

	public function show_add_brochure()
	{
		return view('admin.brochures.add-brochure');
	}

	public function test()
	{
		return view('auth.login');
	}

	public function add_brochure(Request $request)
	{
		$title = $request->input('title');
		$document_src = $request->file('document_src');
		$img_src = $request->file('img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/brochures'), $uploaded_img_src);
        }else{
            $uploaded_img_src = 'dummy.png';
        }

		if($request->hasFile('document_src')) 
		{
            $uploaded_document_src = Str::random(20).'.'.$document_src->getClientOriginalExtension();
            $document_src->move(public_path('assets/documents/brochures'), $uploaded_document_src);
        }else{
           $uploaded_document_src = 'dummy.pdf'; 
        }

		$values=array('title'=>$title,'document_src'=>$uploaded_document_src,'img_src'=>$uploaded_img_src);
		
		$insert_query 	= DB::table('brochures')
						->insert($values);

		return redirect()->route('admin.list_brochures');
	}

	public function view_brochure_details($id)
	{
		$brochure_id = $id;
		
		$fetch_brochure_details = DB::table('brochures')
									->where('id','=',$brochure_id)
									->first();
		
		return view('admin.brochures.edit-brochuree-new',compact('fetch_brochure_details'));
	}

	public function edit_brochure(Request $request)
	{
		$brochure_id = $request->input('brochure_id');
		$title = $request->input('title');
		$document_src = $request->file('document_src');
		$old_document_src = $request->input('old_document_src');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/brochures'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		if($request->hasFile('document_src')) 
		{
            $uploaded_document_src = Str::random(20).'.'.$document_src->getClientOriginalExtension();
            $document_src->move(public_path('assets/documents/brochures'), $uploaded_document_src);
        }
		else
		{
			$uploaded_document_src = $old_document_src;
		}

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('title'=>$title,'document_src'=>$uploaded_document_src,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('brochures')
						->where('id','=',$brochure_id)
						->update($values);
		
		return redirect()->route('admin.list_brochures');
	}

	public function delete_brochure($id)
	{
		$brochure_id = $id;
		
		$delete_query 	= DB::table('brochures')
						->where('id','=',$brochure_id)
						->limit(1)
						->delete();
		
		return redirect()->back();
	}

	public function deactivate_brochure($id)
	{
		$brochure_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('brochures')
						->where('id','=',$brochure_id)
						->update($values);
		
		return redirect()->back();
	}

	public function activate_brochure($id)
	{
		$brochure_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('brochures')
						->where('id','=',$brochure_id)
						->update($values);
		
		return redirect()->back();
	}


	//	Home Page Details
	public function home_page_details()
	{
		return view('admin.home.home-page-details');
	}


	//	Banner
    public function list_banners()
	{
		$list_banners 	= DB::table('banners')
						->get();

		return view('admin.home.banner.list-banners',compact('list_banners'));
	}

	public function show_add_banner()
	{
		return view('admin.home.banner.add-banner');
	}

	public function add_banner(Request $request)
	{
		$title_one = $request->input('title_one');
		$title_two = $request->input('title_two');
		$link = $request->input('link');
		$img_src = $request->file('img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/banners'), $uploaded_img_src);
        }

		$values=array('title_one'=>$title_one,'title_two'=>$title_two,'link'=>$link,'img_src'=>$uploaded_img_src);
		
		$insert_query 	= DB::table('banners')
						->insert($values);

		return redirect()->route('admin.home_page_details');
	}

	public function view_banner_details($id)
	{
		$banner_id = $id;
		
		$fetch_banner_details 	= DB::table('banners')
								->where('id','=',$banner_id)
								->first();
		
		return view('admin.home.banner.edit-banner',compact('fetch_banner_details'));
	}

	public function edit_banner(Request $request)
	{
		$banner_id = $request->input('banner_id');
		$title_one = $request->input('title_one');
		$title_two = $request->input('title_two');
		$link = $request->input('link');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/banners'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('title_one'=>$title_one,'title_two'=>$title_two,'link'=>$link,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('banners')
						->where('id','=',$banner_id)
						->update($values);
		
		return redirect()->route('admin.home_page_details');
	}

	public function delete_banner($id)
	{
		$banner_id = $id;
		
		$delete_query 	= DB::table('banners')
						->where('id','=',$banner_id)
						->delete();
		
		return redirect()->back();
	}

	public function deactivate_banner($id)
	{
		$banner_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('banners')
						->where('id','=',$banner_id)
						->update($values);
		
		return redirect()->back();
	}

	public function activate_banner($id)
	{
		$banner_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('banners')
						->where('id','=',$banner_id)
						->update($values);
		
		return redirect()->back();
	}


	// Key Points
	public function list_key_points()
	{
		$list_key_points 	= DB::table('key_points')
							->where('status','=','1')
							->get();

		return view('admin.home.key-points.list-key-points',compact('list_key_points'));
	}

	public function view_key_point_details($id)
	{
		$key_point_id = $id;

		$fetch_key_point_details	= DB::table('key_points')
									->where('id','=',$key_point_id)
									->first();

		return view('admin.home.key-points.edit-key-point',compact('fetch_key_point_details'));
	}

	public function edit_key_point(Request $request)
	{
		$key_point_id = $request->input('key_point_id');
		$title = $request->input('title');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		$validatedData = $request->validate([
			'title' => 'required',
		],
		[
			'title.required' => 'Please enter title'
		]);

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/key-points'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('title'=>$title,'img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('key_points')
						->where('id','=',$key_point_id)
						->update($values);
		
		return redirect()->route('admin.home_page_details');
	}


	// Certificates
	public function list_certificates()
	{
		$list_certificates 	= DB::table('certificates')
							->where('status','=','1')
							->get();

		return view('admin.home.certificates.list-certificates',compact('list_certificates'));
	}

	public function view_certificate_details($id)
	{
		$certificate_id = $id;

		$fetch_certificate_details	= DB::table('certificates')
									->where('id','=',$certificate_id)
									->first();

		return view('admin.home.certificates.edit-certificate',compact('fetch_certificate_details'));
	}
// Show Add Certificate Form
public function show_add_certificate()
{
    return view('admin.home.certificates.add-certificate');
}

// Store Certificate in DB
public function add_certificate(Request $request)
{
    $request->validate([
        'img_src' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
    ]);

    if($request->hasFile('img_src')){
        $image = $request->file('img_src');
        $imageName = time().'_'.$image->getClientOriginalName();
        $image->move(public_path('assets/images/certificates/'), $imageName);
    } else {
        $imageName = null;
    }

    DB::table('certificates')->insert([
        'img_src' => $imageName,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('admin.home_page_details')->with('success', 'Certificate added successfully!');
}
public function delete_certificate($id)
{
    $certificate = DB::table('certificates')->where('id', $id)->first();
    if($certificate) {
        // Delete the image from storage
        if(file_exists(public_path('assets/images/certificates/'.$certificate->img_src))) {
            unlink(public_path('assets/images/certificates/'.$certificate->img_src));
        }

        // Delete from database
        DB::table('certificates')->where('id', $id)->delete();
    }

    return redirect()->route('admin.home_page_details')->with('success', 'Certificate deleted successfully.');
}

	public function edit_certificate(Request $request)
	{
		$certificate_id = $request->input('certificate_id');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/certificates'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('img_src'=>$uploaded_img_src,'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('certificates')
						->where('id','=',$certificate_id)
						->update($values);
		
		return redirect()->route('admin.home_page_details');
	}


	// Brands & Products
	public function list_brands_and_products()
	{
		$list_brands_and_products 	= DB::table('brands_and_products')
									->get();

		return view('admin.brands-and-products.list-brands-and-products',compact('list_brands_and_products'));
	}

	public function listing_products()
{
    $listing_products = DB::table('products_listing')->get();
    $brand_id = $listing_products->first()->brand_id ?? null;

    return view('admin.brands-and-products.listing_products', compact('listing_products', 'brand_id'));
}

	
public function deactivate_product_listing($id)
{
    DB::table('products_listing')
        ->where('id', $id)
        ->update([
            'status' => 0,
            'updated_at' => now()
        ]);

    return redirect()->back()->with('success', 'Product deactivated successfully');
}
public function activate_product_listing($id)
{
    DB::table('products_listing')
        ->where('id', $id)
        ->update([
            'status' => 1,
            'updated_at' => now()
        ]);

    return redirect()->back()->with('success', 'Product activated successfully');
}
	public function show_add_brands_and_products()
	{
		return view('admin.brands-and-products.add-brands-and-products');
	}

	public function add_brands_and_products(Request $request)
	{
		$brand_name = $request->input('brand_name');
		$brand_slug = $request->input('brand_slug');
		$application_name = $request->input('application_name');
		$application_slug = $request->input('application_slug');
		$short_description = $request->input('short_description');
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$icon_img_src = $request->file('icon_img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/brands-and-products'), $uploaded_img_src);
        }

		if($request->hasFile('icon_img_src')) 
		{
            $uploaded_icon_img_src = Str::random(20).'.'.$icon_img_src->getClientOriginalExtension();
            $icon_img_src->move(public_path('assets/images/brands-and-products'), $uploaded_icon_img_src);
        }

		$values=array('brand_name'=>$brand_name, 'brand_slug'=>$brand_slug, 'application_name'=>$application_name, 'application_slug'=>$application_slug, 'short_description'=>$short_description, 'description'=>$description, 'img_src'=>$uploaded_img_src);
		
		$insert_query 	= DB::table('brands_and_products')
						->insert($values);
		
		return redirect()->route('admin.list_brands_and_products');
	}

	public function view_brands_and_products_details($id)
	{
		$brands_and_products_id = $id;

		$fetch_brands_and_products_details	= DB::table('brands_and_products')
										->where('id','=',$brands_and_products_id)
										->first();

		return view('admin.brands-and-products.edit-brands-and-products',compact('fetch_brands_and_products_details'));
	}

	public function edit_brands_and_products(Request $request)
	{
		$brands_and_products_id = $request->input('brands_and_products_id');
		$brand_name = $request->input('brand_name');
		$brand_slug = $request->input('brand_slug');
		$application_name = $request->input('application_name');
		$application_slug = $request->input('application_slug');
		$short_description = $request->input('short_description');
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$icon_img_src = $request->file('icon_img_src');
		$old_img_src = $request->input('old_img_src');
		$old_icon_img_src = $request->input('old_icon_img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/brands-and-products'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		if($request->hasFile('icon_img_src')) 
		{
            $uploaded_icon_img_src = Str::random(20).'.'.$icon_img_src->getClientOriginalExtension();
            $icon_img_src->move(public_path('assets/images/brands-and-products'), $uploaded_icon_img_src);
        }
		else
		{
			$uploaded_icon_img_src = $old_icon_img_src;
		}

		$updated_at = now()->timezone('Asia/Kolkata');

$values = array(
    'brand_name' => $brand_name,
    'brand_slug' => $brand_slug,
    'application_name' => $application_name,
    'application_slug' => $application_slug,
    'short_description' => $short_description,
    'description' => $description,
    'img_src' => $uploaded_img_src,
    'icon_img_src' => $uploaded_icon_img_src, // ✅ MISSING FIELD
    'updated_at' => $updated_at
);
		
		$update_query 	= DB::table('brands_and_products')
						->where('id','=',$brands_and_products_id)
						->update($values);
		
		return redirect()->route('admin.list_brands_and_products');
	}

	public function delete_brands_and_products($id)
	{
		$brands_and_products_id = $id;
		
		$delete_query 	= DB::table('brands_and_products')
						->where('id','=',$brands_and_products_id)
						->delete();
		
		return redirect()->back();
	}

	public function deactivate_brands_and_products($id)
	{
		$brands_and_products_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('brands_and_products')
						->where('id','=',$brands_and_products_id)
						->update($values);
		
		return redirect()->back();
	}

	public function activate_brands_and_products($id)
	{
		$brands_and_products_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('brands_and_products')
						->where('id','=',$brands_and_products_id)
						->update($values);
		
		return redirect()->back();
	}


	// Products
public function list_products($id = null)
	{
		$brand_id = $id;

		//	Fetch Brands & Products Details
		$fetch_brands_and_products_details 	= DB::table('brands_and_products')
											->where('id', '=', $brand_id)
											->first();

		$brand_name = $fetch_brands_and_products_details->brand_name;
		$application_name = $fetch_brands_and_products_details->application_name;

		//	List Products
		$list_products 	= DB::table('products')
						->where('brand_id', '=', $brand_id)
						->get();
//dd($list_products);
		return view('admin.products.list-products',compact('brand_id', 'list_products', 'brand_name', 'application_name'));
	}

	public function show_add_product($id)
	{
		$brand_id = $id;

		return view('admin.products.add-product',compact('brand_id'));
	}

public function add_product(Request $request)
{
    // Basic Fields
    $brand_id       = $request->input('brand_id');
    $brand_no       = $request->input('brand_no');
    $product_type   = $request->input('product_type');
    $product_name   = $request->input('product_name');
    $product_heading = $request->input('product_heading');
    $product_title  = $request->input('product_title');
    $slug           = $request->input('slug');
    $faqs_heading   = $request->input('faqs_heading');
    $heading_specifications = $request->input('heading_specifications');
 $meta_title   = $request->input('meta_title');
    $meta_description   = $request->input('meta_description');
     $canonical_url   = $request->input('canonical_url');
     $og_description   = $request->input('og_description');
      $hreflang_in   = $request->input('hreflang_in');
       $hreflang_default   = $request->input('hreflang_default');
    // Product Image
    $uploaded_product_image = null;
    if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');
        $uploaded_product_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products'), $uploaded_product_image);
    }

    // Product Info
    $product_info_image = null;
    if ($request->hasFile('product_info_image')) {
        $file = $request->file('product_info_image');
        $product_info_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/info'), $product_info_image);
    }
    $product_info_description = $request->input('product_info_description');

    // Section 2.1: Product Info
    $product_info_heading_2_1     = $request->input('product_info_heading_2_1');
    $product_info_title_2_1       = $request->input('product_info_title_2_1');
    $product_info_description_2_1 = $request->input('product_info_description_2_1');

    $product_info_image_2_1 = null;
    if ($request->hasFile('product_info_image_2_1')) {
        $file = $request->file('product_info_image_2_1');
        $product_info_image_2_1 = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/info'), $product_info_image_2_1);
    }

    // Key Features
$features_heading     = $request->input('features_heading');
$features_description = $request->input('features_description');

$features = [];

foreach ($request->features_title ?? [] as $i => $title) {

    // Default icon = old icon (if exists)
    $icon = $request->old_features_icon[$i] ?? null;

    // If new icon uploaded
    if ($request->hasFile("features_icon.$i")) {
        $file = $request->file("features_icon.$i");
        $icon = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/features'), $icon);
    }

    $features[] = [
        'icon'        => $icon,
        'icon_alt'    => $request->features_icon_alt[$i] ?? null, // ✅ ALT TAG
        'title'       => $title,
        'description' => $request->features_desc[$i] ?? null,
    ];
}

    // Applications
    $applications_heading = $request->input('applications_heading');
    $applications_description = $request->input('applications_description');
    $applications = [];
    foreach ($request->applications_title ?? [] as $i => $title) {
        $image = null;
        if ($request->hasFile("applications_image.$i")) {
            $file = $request->file("applications_image.$i");
            $image = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products/applications'), $image);
        }
        $applications[] = [
            'image'       => $image,
            'title'       => $title,
            'description' => $request->applications_desc[$i] ?? null,
        ];
    }

    // Specifications
    $specifications = [];
    foreach ($request->specs_param ?? [] as $i => $param) {
        $specifications[] = [
            'parameter' => $param,
            'detail'    => $request->specs_detail[$i] ?? null,
        ];
    }

    // Spreadsheets
    $spreadsheet_heading = $request->input('spreadsheet_heading');
    $spreadsheets = [];
    foreach ($request->sheet_title ?? [] as $i => $title) {
        $fileName = null;
        if ($request->hasFile("sheet_file.$i")) {
            $file = $request->file("sheet_file.$i");
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/documents/products/spreadsheets'), $fileName);
        }
        $spreadsheets[] = [
            'title' => $title,
            'file'  => $fileName,
        ];
    }

    // Safety Section
    $safety_description = $request->input('safety_description');
    $safety_image = null;
    if ($request->hasFile('safety_image')) {
        $file = $request->file('safety_image');
        $safety_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/safety'), $safety_image);
    }

    // Why Choose Us
    $why_choose_description = $request->input('why_choose_description');
    $why_choose_image = null;
    if ($request->hasFile('why_choose_image')) {
        $file = $request->file('why_choose_image');
        $why_choose_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/why_choose'), $why_choose_image);
    }

    // Quote Section
    $quote_title       = $request->input('quote_title');
    $quote_description = $request->input('quote_description');
    $quote_contact     = $request->input('quote_contact');
    $quote_email       = $request->input('quote_email');

    // FAQs
    $faqs = [];
    foreach ($request->faq_question ?? [] as $i => $q) {
        $faqs[] = [
            'question' => $q,
            'answer'   => $request->faq_answer[$i] ?? null,
        ];
    }

    // Certifications
    $certification_heading     = $request->input('certification_heading');
    $certification_description = $request->input('certification_description');
    $certifications = [];
    foreach ($request->input('certification.title', []) as $i => $title) {
        $image = null;
        if ($request->hasFile("certification.image.$i")) {
            $file = $request->file("certification.image.$i");
            $image = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products/certifications'), $image);
        }
        $certifications[] = [
            'image'       => $image,
            'title'       => $title,
            'description' => $request->input("certification.description.$i") ?? null,
        ];
    }

    // Applications Across Industries
    $applications_industries_heading = $request->input('applications_industries_heading');
    $applications_industries = [];
    foreach ($request->applications_industries_title ?? [] as $i => $title) {
        $applications_industries[] = [
            'title' => $title,
            'description' => $request->applications_industries_desc[$i] ?? null,
        ];
    }

    // Slug handling
    if (empty($slug)) {
        $slug = Str::slug($product_name);
    }

    // Insert Into DB
    $last_inserted_id = DB::table('products')->insertGetId([
        'brand_id'                     => $brand_id,
        'brand_no'                     => $brand_no,
        'product_type'                 => $product_type,
        'product_heading'              => $product_heading,
        'product_name'                 => $product_name,
        'product_title'                => $product_title,
        'slug'                         => $slug,
        'product_image'                => $uploaded_product_image,
        'product_info_image'           => $product_info_image,
        'product_info_desc'            => $product_info_description,
        'product_info_heading_2_1'     => $product_info_heading_2_1,
        'product_info_title_2_1'       => $product_info_title_2_1,
        'product_info_description_2_1' => $product_info_description_2_1,
        'product_info_image_2_1'       => $product_info_image_2_1,
        'features_heading'             => $features_heading,
        'features_description'         => $features_description,
        'features'                     => json_encode($features),
        'applications_heading'         => $applications_heading,
        'applications_description'     => $applications_description,
        'applications'                 => json_encode($applications),
        'specs_heading'                => $heading_specifications,
        'specifications'               => json_encode($specifications),
        'spreadsheet_heading'          => $spreadsheet_heading,
        'spreadsheets'                 => json_encode($spreadsheets),
        'safety_description'           => $safety_description,
        'safety_image'                 => $safety_image,
        'why_choose_desc'              => $why_choose_description,
        'why_choose_image'             => $why_choose_image,
        'quote_title'                  => $quote_title,
        'quote_description'            => $quote_description,
        'quote_contact'                => $quote_contact,
        'quote_email'                  => $quote_email,
        'faqs_heading'                 => $faqs_heading,
        'faqs'                         => json_encode($faqs),
        'certification_heading'        => $certification_heading,
        'certification_description'    => $certification_description,
        'certifications'               => json_encode($certifications),
        'applications_industries_heading' => $applications_industries_heading,
        'applications_industries'         => json_encode($applications_industries),
          'meta_title' => $meta_title,
        'meta_description' => $meta_description,
'canonical_url' => $canonical_url,
'og_description' => $og_description,
'hreflang_in' => $hreflang_in,
'hreflang_default' => $hreflang_default,
        'created_at'                  => now(),
        'updated_at'                  => now(),
    ]);

    return redirect()->route('admin.list_products', ['id' => $brand_id])
                     ->with('success', 'Product added successfully!');
}




public function add_product_listing(Request $request)
{
    // ✅ Basic fields
    $brand_id       = $request->input('brand_id');
    $brand_no       = $request->input('brand_no');
    $product_type   = $request->input('product_type');
    $product_name   = $request->input('product_name');
    $product_id       = $request->input('product_id');
    $slug           = $request->input('slug');
 $meta_title   = $request->input('meta_title');
    $meta_description   = $request->input('meta_description');
    $canonical_url   = $request->input('canonical_url');
     $og_description   = $request->input('og_description');
      $hreflang_in   = $request->input('hreflang_in');
       $hreflang_default   = $request->input('hreflang_default');
    $product_title  = $request->input('product_title');
// ✅ Check if product already exists
    $existing = DB::table('products_listing')
              ->where('product_id', $product_id)
              ->orWhere('product_name', $product_name)
              ->first();

if ($existing) {
    return redirect()->back()->with('error', 'This product is already added!');
}

    // ✅ Upload Product Image
    $uploaded_product_image = null;
    if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');
        $uploaded_product_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products'), $uploaded_product_image);
    }

    // ✅ Section 2: Product Information
    $product_info_description = $request->input('product_info_description');

    // ✅ Section 3: Our Grades
    $grades_heading     = $request->input('grades_heading');
    $grades_description = $request->input('grades_description');
    $grades = [];
    if ($request->has('grades')) {
        foreach ($request->grades['title'] ?? [] as $i => $title) {
            $icon = null;
            if ($request->hasFile("features_icon.$i")) {
                $file = $request->file("features_icon.$i");
                $icon = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/products/grades'), $icon);
            }
            $grades[] = [
                'brand'       => $request->grades['brand'][$i] ?? null,
                'icon'        => $icon,
                'title'       => $title,
                'description' => $request->grades['description'][$i] ?? null,
            ];
        }
    }

    // ✅ Section 4: What Makes Us Unique
    $unique_heading     = $request->input('unique_heading');
    $unique_description = $request->input('unique_description');
    $unique_title       = $request->input('unique_title');
    $unique = [];
    if ($request->has('unique')) {
        foreach ($request->unique['title'] ?? [] as $i => $title) {
            $icon = null;
            if ($request->hasFile("unique.icon.$i")) {
                $file = $request->file("unique.icon.$i");
                $icon = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/products/unique'), $icon);
            }
            $unique[] = [
                'icon'        => $icon,
                'title'       => $title,
                'description' => $request->unique['description'][$i] ?? null,
            ];
        }
    }

    // ✅ Section 5: Certifications
    $certification_heading     = $request->input('certification_heading');
    $certification_description = $request->input('certification_description');
    $certifications = [];
    if ($request->has('certification')) {
        foreach ($request->certification['title'] ?? [] as $i => $title) {
            $image = null;
            if ($request->hasFile("certification.image.$i")) {
                $file = $request->file("certification.image.$i");
                $image = Str::random(20) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images/products/certifications'), $image);
            }
            $certifications[] = [
                'image'       => $image,
                'title'       => $title,
                'description' => $request->certification['description'][$i] ?? null,
            ];
        }
    }

    // ✅ Section 6: Why Choose
    $why_choose_description = $request->input('why_choose_description');
    $why_choose_image = null;
    if ($request->hasFile('why_choose_image')) {
        $file = $request->file('why_choose_image');
        $why_choose_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/why_choose'), $why_choose_image);
    }

    // ✅ Section 7: Safety & Handling
    $safety_description = $request->input('safety_description');
    $safety_image = null;
    if ($request->hasFile('safety_image')) {
        $file = $request->file('safety_image');
        $safety_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/safety'), $safety_image);
    }

    // ✅ Section 8: Looking to Buy
    $buy_description = $request->input('buy_description');

    // ✅ Section 9: Get a Quote
    $quote_title       = $request->input('quote_title');
    $quote_description = $request->input('quote_description');
    $quote_contact     = $request->input('quote_contact');
    $quote_email       = $request->input('quote_email');

    // ✅ Section 10: FAQs
    $faqs_heading = $request->input('faqs_heading');
    $faqs = [];
    if ($request->has('faq_question')) {
        foreach ($request->faq_question as $i => $q) {
            $faqs[] = [
                'question' => $q,
                'answer'   => $request->faq_answer[$i] ?? null,
            ];
        }
    }

    // ✅ Get existing product from DB
$existingProduct = DB::table('products_listing')->where('id', $product_id)->first();

// ✅ Slug handling
if ($existingProduct && $existingProduct->product_name !== $product_name) {
    // Product name changed → regenerate slug
    $slug = Str::slug($product_name);
} else {
    // Product name unchanged → keep old slug
    $slug = $existingProduct ? $existingProduct->slug : Str::slug($product_name);
}

// Final slug (duplicates allowed)
$unique_slug = $slug;
    // ✅ Insert into DB
    $last_inserted_id = DB::table('products_listing')->insertGetId([
        'brand_id'                 => $brand_id,
        'brand_no'                 => $brand_no,
        'product_type'             => $product_type,
        'product_name'             => $product_name,
                'product_id'             => $product_id,
        'slug'                    => $unique_slug,

        'product_title'            => $product_title,
        'product_image'            => $uploaded_product_image,

        'product_info_desc'        => $product_info_description,

        'grades_heading'           => $grades_heading,
        'grades_description'       => $grades_description,
        'grades'                   => json_encode($grades),

        'unique_heading'           => $unique_heading,
        'unique_description'       => $unique_description,
        'unique_title'             => $unique_title,
        'unique'                   => json_encode($unique),

        'certification_heading'    => $certification_heading,
        'certification_description'=> $certification_description,
        'certifications'           => json_encode($certifications),

        'why_choose_desc'          => $why_choose_description,
        'why_choose_image'         => $why_choose_image,

        'safety_description'       => $safety_description,
        'safety_image'             => $safety_image,

        'buy_description'          => $buy_description,

        'quote_title'              => $quote_title,
        'quote_description'        => $quote_description,
        'quote_contact'            => $quote_contact,
        'quote_email'              => $quote_email,

        'faqs_heading'             => $faqs_heading,
        'faqs'                     => json_encode($faqs),
  'meta_title' => $meta_title,
        'meta_description' => $meta_description,
'canonical_url' => $canonical_url,
'og_description' => $og_description,
'hreflang_in' => $hreflang_in,
'hreflang_default' => $hreflang_default,
        'created_at'               => now(),
        'updated_at'               => now(),
    ]);

    return redirect()->route('admin.listing-products', ['id' => $brand_id])
                     ->with('success', 'Product added successfully!');
}

	public function show_add_product_listing($id)
	
	{
	   // dd($id);
		$brand_id = $id;
		
	$products_with_multiple_brands = DB::table('products')
    ->selectRaw('MIN(id) as id, product_name')
    ->groupBy('product_name')
    ->havingRaw('COUNT(DISTINCT brand_id) > 1')
    ->get();


//dd($products_with_multiple_brands);

		return view('admin.products.add-product-listing',compact('brand_id','products_with_multiple_brands'));
	}
	
	
	public function view_product_details($id)
	{
		$product_id = $id;

		$fetch_product_details	= DB::table('products')
								->where('id','=',$product_id)
								->first();
								// dd($fetch_product_details);

		return view('admin.products.edit-product',compact('fetch_product_details'));
	}




public function edit_product(Request $request)
{
    $product_id = $request->input('product_id');
    $brand_id   = $request->input('brand_id');
    $meta_title   = $request->input('meta_title');
    $meta_description   = $request->input('meta_description');
 $canonical_url   = $request->input('canonical_url');
     $og_description   = $request->input('og_description');
      $hreflang_in   = $request->input('hreflang_in');
       $hreflang_default   = $request->input('hreflang_default');
    // Basic Fields
    $brand_no       = $request->input('brand_no');
    $product_type   = $request->input('product_type');
    $product_name   = $request->input('product_name');
    $product_title  = $request->input('product_title');
    $faqs_heading   = $request->input('faqs_heading');
    $heading_specifications = $request->input('heading_specifications');

    // ✅ Product Image
    $uploaded_product_image = $request->input('old_product_image');
    if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');
        $uploaded_product_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products'), $uploaded_product_image);
    }

    // ✅ Product Info
    $product_info_image = $request->input('old_product_info_image');
    if ($request->hasFile('product_info_image')) {
        $file = $request->file('product_info_image');
        $product_info_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/info'), $product_info_image);
    }
    $product_info_description = $request->input('product_info_description');
    $product_info_image_alt = $request->input('product_info_image_alt');

    // ✅ Product Info Section 2.1
    $product_heading              = $request->input('product_heading');
    $product_info_heading_2_1     = $request->input('product_info_heading_2_1');
    $product_info_title_2_1       = $request->input('product_info_title_2_1');
    $product_info_description_2_1 = $request->input('product_info_description_2_1');

    $product_info_image_2_1 = $request->input('old_product_info_image_2_1');
    if ($request->hasFile('product_info_image_2_1')) {
        $file = $request->file('product_info_image_2_1');
        $product_info_image_2_1 = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/info'), $product_info_image_2_1);
    }

    // ✅ Features
$features_heading     = $request->input('features_heading');
$features_description = $request->input('features_description');
$features             = [];
$feature_files        = $request->file('features_icon') ?? [];

foreach ($request->features_title ?? [] as $i => $title) {

    // Keep old icon if new one not uploaded
    $icon = $request->old_features_icon[$i] ?? null;

    // Upload new icon if exists
    if (isset($feature_files[$i])) {
        $file = $feature_files[$i];
        $icon = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/features'), $icon);
    }

    $features[] = [
        'icon'        => $icon,
        'icon_alt'    => $request->features_icon_alt[$i] ?? null, // ✅ ALT TAG ADDED
        'title'       => $title,
        'description' => $request->features_desc[$i] ?? null,
    ];
}


   // ✅ Applications
$applications_heading     = $request->input('applications_heading');
$applications_description = $request->input('applications_description');
$applications             = [];
$app_files                = $request->file('applications_image') ?? [];

foreach ($request->applications_title ?? [] as $i => $title) {

    // Keep old image if new one not uploaded
    $image = $request->old_applications_image[$i] ?? null;

    // Upload new image if exists
    if (isset($app_files[$i])) {
        $file = $app_files[$i];
        $image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/applications'), $image);
    }

    $applications[] = [
        'image'       => $image,
        'image_alt'   => $request->applications_image_alt[$i] ?? null, // ✅ ALT TAG ADDED
        'title'       => $title,
        'description' => $request->applications_desc[$i] ?? null,
    ];
}


    // ✅ Specifications
   // ✅ Dynamic Specification Columns
$specs_columns = $request->input('specs_columns', []);

// ✅ Specifications (rows stay same as before)
$specifications = [];
foreach ($request->specs_param ?? [] as $i => $param) {
    $specifications[] = [
        'parameter' => $param,
        'detail'    => $request->specs_detail[$i] ?? null,
    ];
}

// Save



    // ✅ Spreadsheets
    $spreadsheet_heading = $request->input('spreadsheet_heading');
    $spreadsheets = [];
    $sheet_files = $request->file('sheet_file') ?? [];

    foreach ($request->sheet_title ?? [] as $i => $title) {
        $fileName = $request->old_sheet_file[$i] ?? null;
        if (isset($sheet_files[$i])) {
            $file = $sheet_files[$i];
            $fileName = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/documents/products/spreadsheets'), $fileName);
        }
        $spreadsheets[] = [
            'title' => $title,
            'file'  => $fileName,
        ];
    }

    // ✅ Safety
$safety_description = $request->input('safety_description');

// Keep old image if not replaced
$safety_image = $request->input('old_safety_image');

// ALT text
$safety_image_alt = $request->input('safety_image_alt');

// Upload new image if exists
if ($request->hasFile('safety_image')) {
    $file = $request->file('safety_image');
    $safety_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('assets/images/products/safety'), $safety_image);
}


   // ✅ Why Choose
$why_choose_description = $request->input('why_choose_description');

// Keep old image if not replaced
$why_choose_image = $request->input('old_why_choose_image');

// ALT text
$why_choose_image_alt = $request->input('why_choose_image_alt');

// Upload new image if exists
if ($request->hasFile('why_choose_image')) {
    $file = $request->file('why_choose_image');
    $why_choose_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('assets/images/products/why_choose'), $why_choose_image);
}


    // ✅ Quote
    $quote_title       = $request->input('quote_title');
    $quote_description = $request->input('quote_description');
    $quote_contact     = $request->input('quote_contact');
    $quote_email       = $request->input('quote_email');

    // ✅ FAQs
    $faqs = [];
    foreach ($request->faq_question ?? [] as $i => $q) {
        $faqs[] = [
            'question' => $q,
            'answer'   => $request->faq_answer[$i] ?? null,
        ];
    }

   // ✅ Certifications
$certification_heading     = $request->input('certification_heading');
$certification_description = $request->input('certification_description');

$certifications = [];

$cert_titles = $request->input('certification.title', []);
$cert_descs  = $request->input('certification.description', []);
$cert_alts   = $request->input('certification.image_alt', []); // ✅ ALT
$cert_old    = $request->old_certifications ?? [];
$cert_files  = $request->file('certification')['image'] ?? [];

foreach ($cert_titles as $i => $title) {

    // Keep old image if new one not uploaded
    $image = $cert_old[$i]['image'] ?? null;

    // Upload new image if exists
    if (isset($cert_files[$i])) {
        $file  = $cert_files[$i];
        $image = Str::random(20) . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products/certifications'), $image);
    }

    $certifications[] = [
        'image'       => $image,
        'image_alt'   => $cert_alts[$i] ?? null, // ✅ ALT TAG
        'title'       => $title,
        'description' => $cert_descs[$i] ?? null,
    ];
}

    // ✅ Applications Across Industries
    $applications_industries_heading = $request->input('applications_industries_heading');
    $applications_industries = [];
    foreach ($request->applications_industries_title ?? [] as $i => $title) {
        $applications_industries[] = [
            'title' => $title,
            'description' => $request->applications_industries_desc[$i] ?? null,
        ];
    }

    // ✅ Slug handling
    $existingProduct = DB::table('products')->where('id', $product_id)->first();
    $slug = ($existingProduct && $existingProduct->product_name !== $product_name) ? Str::slug($product_name) : ($existingProduct ? $existingProduct->slug : Str::slug($product_name));

    // ✅ Update DB
    DB::table('products')->where('id', $product_id)->update([
        'brand_id'                     => $brand_id,
        'brand_no'                     => $brand_no,
        'product_type'                 => $product_type,
        'product_name'                 => $product_name,
        'product_heading'              => $product_heading,
        'product_title'                => $product_title,
        'slug'                         => $slug,
        'product_image'                => $uploaded_product_image,
        'product_info_image'           => $product_info_image,
                'product_info_image_alt'           => $product_info_image_alt,

        'product_info_desc'            => $product_info_description,
        'product_info_heading_2_1'     => $product_info_heading_2_1,
        'product_info_title_2_1'       => $product_info_title_2_1,
        'product_info_description_2_1' => $product_info_description_2_1,
        'product_info_image_2_1'       => $product_info_image_2_1,
        'features_heading'             => $features_heading,
        'features_description'         => $features_description,
        'features'                     => json_encode($features),
        'applications_heading'         => $applications_heading,
        'applications_description'     => $applications_description,
        'applications'                 => json_encode($applications),
        'specs_heading'                => $heading_specifications,
        'specifications'               => json_encode($specifications),
          'specs_columns' => json_encode($specs_columns),
        'spreadsheet_heading'          => $spreadsheet_heading,
        'spreadsheets'                 => json_encode($spreadsheets),
        'safety_description'           => $safety_description,
        'safety_image'                 => $safety_image,
                'safety_image_alt'                 => $safety_image_alt,

        'why_choose_desc'              => $why_choose_description,
        'why_choose_image'             => $why_choose_image,
                'why_choose_image_alt'             => $why_choose_image_alt,

        'quote_title'                  => $quote_title,
        'quote_description'            => $quote_description,
        'quote_contact'                => $quote_contact,
        'quote_email'                  => $quote_email,
        'faqs_heading'                 => $faqs_heading,
        'faqs'                         => json_encode($faqs),
        'certification_heading'        => $certification_heading,
        'certification_description'    => $certification_description,
        'certifications'               => json_encode($certifications),
        'applications_industries_heading' => $applications_industries_heading,
        'applications_industries'         => json_encode($applications_industries),
                'meta_title' => $meta_title,
        'meta_description' => $meta_description,
'canonical_url' => $canonical_url,
'og_description' => $og_description,
'hreflang_in' => $hreflang_in,
'hreflang_default' => $hreflang_default,
        
    ]);

    return redirect()->route('admin.list_products', ['id' => $brand_id])
                     ->with('success', 'Product updated successfully!');
}



public function deleteProductImage($id)
{
    // Get the current image name
    $product = DB::table('products')->where('id', $id)->first();

    if ($product && $product->product_image) {
        $imagePath = public_path('assets/images/products/'.$product->product_image);
        if (file_exists($imagePath)) {
            unlink($imagePath); // delete file
        }

        // Remove image from database
        DB::table('products')->where('id', $id)->update(['product_image' => null]);
    }

    return response()->json(['success' => true]);
}




public function edit_product_listing(Request $request)
{
    
     //dd($request);
    $product_id    = $request->input('product_id');
        $product_idd       = $request->input('product_idd');
 $meta_title   = $request->input('meta_title');
   $meta_description   = $request->input('meta_description');
 $canonical_url   = $request->input('canonical_url');
     $og_description   = $request->input('og_description');
      $hreflang_in   = $request->input('hreflang_in');
       $hreflang_default   = $request->input('hreflang_default');
    $brand_id      = $request->input('brand_id');
    $brand_no      = $request->input('brand_no');
    $product_type  = $request->input('product_type');
    $product_name  = $request->input('product_name');
    $product_title = $request->input('product_title');
    $slug          = $request->input('slug');
    $old_slug      = $request->input('old_slug');

    $faqs_heading  = $request->input('faqs_heading');

    // ✅ Product Image
    $uploaded_product_image = $request->input('old_product_image');
    if ($request->hasFile('product_image')) {
        $file = $request->file('product_image');
        $uploaded_product_image = Str::random(20).'.'.$file->getClientOriginalExtension();
        $file->move(public_path('assets/images/products'), $uploaded_product_image);
    }

    // ✅ Product Info
    $product_info_description = $request->input('product_info_description');

   // ✅ OUR GRADES
$grades_heading     = $request->input('grades_heading');
$grades_description = $request->input('grades_description');

$grades = [];

if ($request->has('grades.title')) {
    foreach ($request->grades['title'] as $i => $title) {

        // Keep old icon if not replaced
        $icon = $request->old_grades_icon[$i] ?? null;

        // Upload new icon if exists
        if ($request->hasFile("grades_icon.$i")) {
            $file = $request->file("grades_icon.$i");
            $icon = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products/grades'), $icon);
        }

        $grades[] = [
            'brand'       => $request->grades['brand'][$i] ?? null,
            'icon'        => $icon,
            'icon_alt'    => $request->grades_icon_alt[$i] ?? null, // ✅ ALT TAG
            'title'       => $title,
            'description' => $request->grades['description'][$i] ?? null,
        ];
    }
}

   // ✅ WHAT MAKES US UNIQUE
$unique_heading     = $request->input('unique_heading');
$unique_description = $request->input('unique_description');
$unique_title       = $request->input('unique_title');

$unique = [];

if ($request->has('unique.title')) {
    foreach ($request->unique['title'] as $i => $title) {

        // Keep old icon if not replaced
        $icon = $request->old_unique_icon[$i] ?? null;

        // Upload new icon if exists
        if ($request->hasFile("unique_icon.$i")) {
            $file = $request->file("unique_icon.$i");
            $icon = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products/unique'), $icon);
        }

        $unique[] = [
            'icon'        => $icon,
            'icon_alt'    => $request->unique_icon_alt[$i] ?? null, // ✅ ALT TAG
            'title'       => $title,
            'description' => $request->unique['description'][$i] ?? null,
        ];
    }
}

   // ✅ OUR CERTIFICATIONS
$certification_heading     = $request->input('certification_heading');
$certification_description = $request->input('certification_description');

$certifications = [];

if ($request->has('certification.title')) {
    foreach ($request->certification['title'] as $i => $title) {

        // Keep old image if not replaced
        $image = $request->old_certification_image[$i] ?? null;

        // Upload new image if exists
        if ($request->hasFile("certification_image.$i")) {
            $file  = $request->file("certification_image.$i");
            $image = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('assets/images/products/certifications'), $image);
        }

        $certifications[] = [
            'image'       => $image,
            'image_alt'   => $request->certification_image_alt[$i] ?? null, // ✅ ALT TAG
            'title'       => $title,
            'description' => $request->certification['description'][$i] ?? null,
        ];
    }
}


   // ✅ WHY CHOOSE
$why_choose_description = $request->input('why_choose_description');

// Keep old image by default
$why_choose_image = $request->input('old_why_choose_image');

// Upload new image if provided
if ($request->hasFile('why_choose_image')) {
    $file = $request->file('why_choose_image');
    $why_choose_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('assets/images/products'), $why_choose_image);
}

// Image ALT
$why_choose_image_alt = $request->input('why_choose_image_alt');


   // ✅ HANDLING / SAFETY
$safety_description = $request->input('safety_description');

// Keep old image if not replaced
$safety_image = $request->input('old_safety_image');

// Upload new image if provided
if ($request->hasFile('safety_image')) {
    $file = $request->file('safety_image');
    $safety_image = Str::random(20) . '.' . $file->getClientOriginalExtension();
    $file->move(public_path('assets/images/products'), $safety_image);
}

// Image ALT
$safety_image_alt = $request->input('safety_image_alt');


    // ✅ LOOKING TO BUY
    $buy_description = $request->input('buy_description');

    // ✅ GET A QUOTE
    $quote_title       = $request->input('quote_title');
    $quote_description = $request->input('quote_description');
    $quote_contact     = $request->input('quote_contact');
    $quote_email       = $request->input('quote_email');

    // ✅ FAQs
    $faqs = [];
    if ($request->has('faq_question')) {
        foreach ($request->faq_question as $i => $question) {
            if (!empty($question) || !empty($request->faq_answer[$i])) {
                $faqs[] = [
                    'question' => $question,
                    'answer'   => $request->faq_answer[$i] ?? null,
                ];
            }
        }
    }

   // ✅ Slug
// ✅ Get existing product from DB
$existingProduct = DB::table('products_listing')->where('id', $product_id)->first();

// ✅ Slug handling
if ($existingProduct && $existingProduct->product_name !== $product_name) {
    // Product name changed → regenerate slug
    $slug = Str::slug($product_name);
} else {
    // Product name unchanged → keep old slug
    $slug = $existingProduct ? $existingProduct->slug : Str::slug($product_name);
}

// Final slug (duplicates allowed)
$unique_slug = $slug;


    // ✅ Update DB
    DB::table('products_listing')->updateOrInsert(
    ['id' => $product_id], // condition
    [
        'brand_id'                  => $brand_id,
        'brand_no'                  => $brand_no,
        'product_type'              => $product_type,
        'product_name'              => $product_name,
        'product_title'             => $product_title,
        'slug'                      => $unique_slug,
        'product_image'             => $uploaded_product_image,
        'product_info_desc'         => $product_info_description,
                'product_id'             => $product_idd,

        'grades_heading'            => $grades_heading,
        'grades_description'        => $grades_description,
        'grades'                    => json_encode($grades),

        'unique_heading'            => $unique_heading,
        'unique_description'        => $unique_description,
        'unique_title'              => $unique_title,
        'unique'                    => json_encode($unique),

        'certification_heading'     => $certification_heading,
        'certification_description' => $certification_description,
        'certifications'            => json_encode($certifications),

        'why_choose_desc'           => $why_choose_description,
        'why_choose_image'          => $why_choose_image,
        'why_choose_image_alt'          => $why_choose_image_alt,
        'safety_image_alt'          => $safety_image_alt,

        'safety_description'        => $safety_description,
        'safety_image'              => $safety_image,

        'buy_description'           => $buy_description,

        'quote_title'               => $quote_title,
        'quote_description'         => $quote_description,
        'quote_contact'             => $quote_contact,
        'quote_email'               => $quote_email,

        'faqs_heading'              => $faqs_heading,
        'faqs'                      => json_encode($faqs),
         'meta_title' => $meta_title,
        'meta_description' => $meta_description,
'canonical_url' => $canonical_url,
'og_description' => $og_description,
'hreflang_in' => $hreflang_in,
'hreflang_default' => $hreflang_default,
        'updated_at'                => now(),
        'created_at'                => now(), // will be ignored on update
    ]
);


    // ✅ Get the brand_id from the products table for this product
$product = DB::table('products')->where([

    ['brand_id', '=', $brand_id],
    ['brand_no', '=', $brand_no],
])->first();

// dd($product);



// // ✅ Use the brand_id from the products table if found
// $redirect_id = $product ? $product->brand_id : $brand_id;
// dd($redirect_id);



// Redirect to list_product_applications with correct brand ID
// ✅ Use the selected product_idd for redirect
return redirect()->route('admin.listing-products', ['id' => $product_idd])
                 ->with('success', 'Product updated successfully!');


}




public function view_product_details_listing($id)
{
    
    $product_id = $id;

	$fetch_product_details	= DB::table('products')
								->where('id','=',$product_id)
								->first();
								
		$products_with_multiple_brands = DB::table('products')
    ->selectRaw('MIN(id) as id, product_name')
    ->groupBy('product_name')
    ->havingRaw('COUNT(DISTINCT brand_id) > 1')
    ->get();
    
    $fetch_product_details1 = DB::table('products_listing')
        ->where('id', $id)
        ->first();
        
        // dd($fetch_product_details1);

    // If not found, create a dummy empty object
    if (!$fetch_product_details) {
        $fetch_product_details = (object) [
            'id'                      => null,
            'brand_id'                => null,
            'brand_no'                => null,
            'product_type'            => null,
            'product_name'            => null,
            'product_title'           => null,
            'slug'                    => null,
            'product_image'           => null,
            'product_info_desc'       => null,
            'grades_heading'          => null,
            'grades_description'      => null,
            'grades'                  => json_encode([]),
            'unique_heading'          => null,
            'unique_description'      => null,
            'unique_title'            => null,
            'unique'                  => json_encode([]),
            'certification_heading'   => null,
            'certification_description'=> null,
            'certifications'          => json_encode([]),
            'why_choose_desc'         => null,
            'why_choose_image'        => null,
            'safety_description'      => null,
            'safety_image'            => null,
            'buy_description'         => null,
            'quote_title'             => null,
            'quote_description'       => null,
            'quote_contact'           => null,
            'quote_email'             => null,
            'faqs_heading'            => null,
            'faqs'                    => json_encode([]),
        ];
    }

    return view('admin.products.edit-product-listing', compact('fetch_product_details','fetch_product_details1','products_with_multiple_brands'));
}

public function delete_product_listing($id)
{
    try {
        // Delete from products table if exists
        DB::table('products')->where('id', $id)->delete();

        // Delete from products_listing table if exists
        DB::table('products_listing')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Product deleted successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
    }
}


	public function delete_product($id)
	{
		$product_id = $id;
		
		$delete_query 	= DB::table('products')
						->where('id','=',$product_id)
						->delete();
		
		return redirect()->back();
	}

	public function deactivate_product($id)
	{
		$product_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('products')
						->where('id','=',$product_id)
						->update($values);
		
		return redirect()->back();
	}

	public function activate_product($id)
	{
		$product_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('products')
						->where('id','=',$product_id)
						->update($values);
		
		return redirect()->back();
	}
	
	private function generate_unique_slug($slug)
    {
        $original_slug = $slug;
        $count = 1;
    
        while(DB::table('products')->where('slug', $slug)->exists())
        {
            $slug = $original_slug.'-'.$count++;
        }
    
        return $slug;
    }
    
    public function delete_document($id, $document)
    {
        $product_id = $id;
        $document_name = $document;
        
        //  Fetch Product Details
        $fetch_product_details 	= DB::table('products')
        						->where('id','=',$product_id)
        						->first();

        //  IP
        if($document_name == "ip")
        {
            $document_path = public_path('assets/documents/products-ip/'.$fetch_product_details->ip_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('ip_src'=>NULL);
    
            // Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }
        
        //  USP
        if($document_name == "usp")
        {
            $document_path = public_path('assets/documents/products-usp/'.$fetch_product_details->usp_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('usp_src'=>NULL);
    
            //  Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }
        
        //  BP
        if($document_name == "bp")
        {
            $document_path = public_path('assets/documents/products-bp/'.$fetch_product_details->bp_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('bp_src'=>NULL);
    
            //  Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }
        
        //  EP
        if($document_name == "ep")
        {
            $document_path = public_path('assets/documents/products-ep/'.$fetch_product_details->ep_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('ep_src'=>NULL);
    
            //  Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }
        
        //  USP-NF
        if($document_name == "usp_nf")
        {
            $document_path = public_path('assets/documents/products-usp-nf/'.$fetch_product_details->usp_nf_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('usp_nf_src'=>NULL);
    
            //  Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }
        
        //  Spreadsheet
        if($document_name == "spreadsheet")
        {
            $document_path = public_path('assets/documents/products-spreadsheet/'.$fetch_product_details->spreadsheet_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('spreadsheet_src'=>NULL);
    
            //  Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }
        
        //  ACS
        if($document_name == "acs")
        {
            $document_path = public_path('assets/documents/products-acs/'.$fetch_product_details->acs_src);
    
            if(file_exists($document_path)) 
            {
                unlink($document_path);
            }
            
            $values=array('acs_src'=>NULL);
    
            //  Update product table
            $update_query 	= DB::table('products')
    						->where('id','=',$product_id)
    						->update($values);
        }

        return redirect()->back();
    }
	
	
// // Product Applications
// public function list_product_applications($id)
// {
//     // dd($id);
//     $product_id = $id;
    
//     //  Fetch Product Details
//     $fetch_product_details = DB::table('products')
//                             ->where('id', '=', $product_id)
//                             ->first();
                            
//     //  List Product Applications
//     $list_product_applications = DB::table('mapping_product_applications')
//                         ->join('brands_and_products', 'brands_and_products.id', '=', 'mapping_product_applications.application_id')
//                         ->where('mapping_product_applications.product_id', '=', $product_id)
//                         ->where('mapping_product_applications.status', '=', '1')
//                         ->select('mapping_product_applications.*', 'brands_and_products.application_name')
//                         ->get();
                        
//     // Get IDs of associated applications
//     $associated_application_ids = $list_product_applications
//                                 ->pluck('application_id')
//                                 ->toArray();
                                
//     // Get all applications excluding already associated ones
//     $list_applications = DB::table('brands_and_products')
//                         ->where('status', '=', '1')
//                         ->whereNotIn('id', $associated_application_ids)
//                         ->get();
                            
//     $product_name = $fetch_product_details->product_name;
    
//     $brand_id = $fetch_product_details->brand_id;

//     // ✅ Fetch product listings by brand_id
//     $product_listings = DB::table('products_listing')
//                         ->where('brand_id', $product_id)
//                         ->get();
                        

//     return view(
//         'admin.products.list-product-applications',
//         compact(
//             'list_product_applications',
//             'product_id',
//             'product_name',
//             'list_applications',
//             'brand_id',
//             'product_listings' // 👈 new variable for Blade
//         )
//     );
// }

// Product Applications

public function list_product_applications($id)
{
    $product_id = $id;

    // Fetch Product Details
    $fetch_product_details = DB::table('products')
        ->where('id', '=', $product_id)
        ->first();

    if (!$fetch_product_details) {
        abort(404, 'Product not found');
    }

    // List Product Applications
    $list_product_applications = DB::table('mapping_product_applications')
        ->join('brands_and_products', 'brands_and_products.id', '=', 'mapping_product_applications.application_id')
        ->where('mapping_product_applications.product_id', '=', $product_id)
        ->where('mapping_product_applications.status', '=', '1')
        ->select('mapping_product_applications.*', 'brands_and_products.application_name')
        ->get();

    // Get IDs of associated applications
    $associated_application_ids = $list_product_applications
        ->pluck('application_id')
        ->toArray();

    // Get all applications excluding already associated ones
    $list_applications = DB::table('brands_and_products')
        ->where('status', '=', '1')
        ->whereNotIn('id', $associated_application_ids)
        ->get();

    // Get product name + brand_id + brand_no
    $product_name = $fetch_product_details->product_name;
    $brand_id     = $fetch_product_details->brand_id;
    $brand_no     = $fetch_product_details->brand_no;

    // ✅ Fetch product listings by brand_id AND brand_no
    $product_listings = DB::table('products_listing')
        ->where('brand_id', $brand_id)
        ->where('brand_no', $brand_no)
        ->get();

    return view(
        'admin.products.list-product-applications',
        compact(
            'list_product_applications',
            'product_id',
            'product_name',
            'list_applications',
            'brand_id',
            'product_listings'
        )
    );
}


 	
	public function add_product_application(Request $request)
	{
		$product_id = $request->input('product_id');
		$application_id = $request->input('application_id');
		
		//  Fetch Product Details
		$fetch_product_details 	= DB::table('products')
        						->where('id','=',$product_id)
        						->first();

        //  Mapping Product Applications
		$values=array('product_id'=>$product_id, 'application_id'=>$application_id);
		
		$values 	= DB::table('mapping_product_applications')
						->insert($values);	
		
		return redirect()->back();
		
		//  return redirect()->route('admin.list_products',['id' => $fetch_product_details->brand_id]);
	}
	
	public function delete_product_application($id)
	{
		$product_application_id = $id;
		
		$delete_query 	= DB::table('mapping_product_applications')
						->where('id','=',$product_application_id)
						->delete();
		
		return redirect()->back();
	}


	//	Careers Details
	public function career_details()
	{
		return view('admin.careers.career-details');
	}

	
	// 	Career Page Details
	public function show_career_page_details()
	{
		$fetch_career_page_details 	= DB::table('career_page_details')
									->where('id','=','1')
									->first();

		return view('admin.careers.update-career-page-details',compact('fetch_career_page_details'));
	}

	public function update_career_page_details(Request $request)
	{
		$title_one = $request->input('title_one');
		$title_two = $request->input('title_two');
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		$fetch_about_us_history_details = DB::table('career_page_details')
										->where('id','=','1')
										->first();

		if($fetch_about_us_history_details)
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/careers'), $uploaded_img_src);
			}
			else
			{
				$uploaded_img_src = $old_img_src;
			}

			$updated_at = now()->timezone('Asia/Kolkata');

			$update_values=array('title_one'=>$title_one, 'title_two'=>$title_two, 'description'=>$description, 'img_src'=>$uploaded_img_src, 'updated_at'=>$updated_at);
		
			$update_query 	= DB::table('career_page_details')
							->where('id','=','1')
							->update($update_values);
		}
		else
		{
			if($request->hasFile('img_src')) 
			{
				$uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
				$img_src->move(public_path('assets/images/careers'), $uploaded_img_src);
			}

			$insert_values=array('title_one'=>$title_one, 'title_two'=>$title_two, 'description'=>$description, 'img_src'=>$uploaded_img_src);
		
			$insert_query 	= DB::table('career_page_details')
							->insert($insert_values);
		}
		
		return redirect()->route('admin.career_details');
	}


	// 	Job Posts
	public function list_job_posts()
	{
		$list_job_posts = DB::table('job_posts')
						->get();

		return view('admin.careers.list-job-posts',compact('list_job_posts'));
	}

	public function show_add_job_post()
	{
		return view('admin.careers.add-job-post');
	}

	public function add_job_post(Request $request)
	{
		$title = $request->input('title');
		$location = $request->input('location');
		$salary = $request->input('salary');
		$description = $request->input('description');

		$values=array('title'=>$title, 'location'=>$location, 'salary'=>$salary, 'description'=>$description);
		
		$insert_query 	= DB::table('job_posts')
						->insert($values);
		
		return redirect()->route('admin.career_details');
	}

	public function view_job_post_details($id)
	{
		$job_post_id = $id;

		$fetch_job_post_details	= DB::table('job_posts')
								->where('id','=',$job_post_id)
								->first();

		return view('admin.careers.edit-job-post',compact('fetch_job_post_details'));
	}

	public function edit_job_post(Request $request)
	{
		$job_post_id = $request->input('job_post_id');
		$title = $request->input('title');
		$location = $request->input('location');
		$salary = $request->input('salary');
		$description = $request->input('description');

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('title'=>$title, 'location'=>$location, 'salary'=>$salary, 'description'=>$description, 'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('job_posts')
						->where('id','=',$job_post_id)
						->update($values);
		
		return redirect()->route('admin.career_details');
	}

	public function delete_job_post($id)
	{
		$job_post_id = $id;
		
		$delete_query 	= DB::table('job_posts')
						->where('id','=',$job_post_id)
						->delete();
		
		return redirect()->back();
	}

	public function deactivate_job_post($id)
	{
		$job_post_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('job_posts')
						->where('id','=',$job_post_id)
						->update($values);
		
		return redirect()->back();
	}

	public function activate_job_post($id)
	{
		$job_post_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('job_posts')
						->where('id','=',$job_post_id)
						->update($values);
		
		return redirect()->back();
	}


	// Events
	public function list_events()
	{
		$list_events 	= DB::table('events')
						->orderBy('event_date', 'desc')
						->get();

		$featured_count = DB::table('events')
						->where('is_featured', '1')
						->count();

		return view('admin.events.list-events',compact('list_events','featured_count'));
	}

	public function show_add_event()
	{
		return view('admin.events.add-event');
	}

	public function add_event(Request $request)
	{
		$title = $request->input('title');
		$slug = $request->input('slug');
		$short_description = $request->input('short_description');
		$event_by = $request->input('event_by');
		$event_date = $request->input('event_date');
		$description = $request->input('description');
		$img_src = $request->file('img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/events'), $uploaded_img_src);
        }

		$formatted_event_date = DateTime::createFromFormat('d-m-Y', $event_date)->format('Y-m-d');

		$values=array('title'=>$title, 'slug'=>$slug, 'short_description'=>$short_description, 'event_by'=>$event_by, 'event_date'=>$formatted_event_date, 'description'=>$description, 'img_src'=>$uploaded_img_src);
		
		$insert_query 	= DB::table('events')
						->insert($values);
		
		return redirect()->route('admin.list_events');
	}

	public function view_event_details($id)
	{
		$event_id = $id;

		$fetch_event_details	= DB::table('events')
								->where('id','=',$event_id)
								->first();

		return view('admin.events.edit-event',compact('fetch_event_details'));
	}

	public function edit_event(Request $request)
	{
		$event_id = $request->input('event_id');
		$title = $request->input('title');
		$slug = $request->input('slug');
		$short_description = $request->input('short_description');
		$event_by = $request->input('event_by');
		$event_date = $request->input('event_date');
		$description = $request->input('description');
		$img_src = $request->file('img_src');
		$old_img_src = $request->input('old_img_src');

		if($request->hasFile('img_src')) 
		{
            $uploaded_img_src = Str::random(20).'.'.$img_src->getClientOriginalExtension();
            $img_src->move(public_path('assets/images/events'), $uploaded_img_src);
        }
		else
		{
			$uploaded_img_src = $old_img_src;
		}

		$formatted_event_date = DateTime::createFromFormat('d-m-Y', $event_date)->format('Y-m-d');

		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('title'=>$title, 'slug'=>$slug, 'short_description'=>$short_description, 'event_by'=>$event_by, 'event_date'=>$formatted_event_date, 'description'=>$description, 'img_src'=>$uploaded_img_src, 'updated_at'=>$updated_at);
		
		$update_query 	= DB::table('events')
						->where('id','=',$event_id)
						->update($values);
		
		return redirect()->route('admin.list_events');
	}

	public function delete_event($id)
	{
		$event_id = $id;
		
		$delete_query 	= DB::table('events')
						->where('id','=',$event_id)
						->delete();
		
		return redirect()->back();
	}

	public function deactivate_event($id)
	{
		$event_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('events')
						->where('id','=',$event_id)
						->update($values);
		
		return redirect()->back();
	}

	public function activate_event($id)
	{
		$event_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('status'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('events')
						->where('id','=',$event_id)
						->update($values);
		
		return redirect()->back();
	}

	public function remove_featured_event($id)
	{
		$event_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('is_featured'=>'0','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('events')
						->where('id','=',$event_id)
						->update($values);
		
		return redirect()->back();
	}

	public function mark_featured_event($id)
	{
		$event_id = $id;

		//$updated_by = Auth::id();
		$updated_at = now()->timezone('Asia/Kolkata');

		$values=array('is_featured'=>'1','updated_at'=>$updated_at);
		
		$update_query 	= DB::table('events')
						->where('id','=',$event_id)
						->update($values);
		
		return redirect()->back();
	}
	
	
	//  List Contact Us Enquiry
	public function list_contact_us_enquiry(Request $request)
	{
		$query 	= DB::table('contact_us_enquiry')
            	->orderBy('created_at', 'desc');
            						
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }
    
        $list_contact_us_enquiry = $query->get();

		return view('admin.enquiries.list-contact-us-enquiry',compact('list_contact_us_enquiry'));
	}
	
public function bulkDeleteContactEnquiry(Request $request)
{
    // Allow delete only for Super Admin
    if(auth()->user()->is_admin != 1){
        return redirect()->back()->with('error','You do not have delete permission.');
    }

    if ($request->ids && count($request->ids) > 0) {

        DB::table('contact_us_enquiry')
            ->whereIn('id', $request->ids)
            ->delete();

        return redirect()->back()->with('success', 'Selected enquiries deleted successfully');
    }

    return redirect()->back()->with('error', 'Please select at least one record');
}
public function delete($id)
{
    DB::table('contact_us_enquiry')
        ->where('id', $id)
        ->delete();

    return redirect()->back()->with('success', 'Enquiry deleted successfully.');
}
	//  List Product Document Enquiry
	public function list_product_document_enquiry(Request $request)
	{
		$query  = DB::table('product_document_enquiry as pde')
                ->join(DB::raw('(SELECT MAX(id) as id FROM product_document_enquiry GROUP BY mobile_no) as latest'), 'pde.id', '=', 'latest.id')
                ->join('products', 'products.id', '=', 'pde.product_id')
                ->select('pde.*', 'products.product_name')
                ->orderBy('pde.created_at', 'desc');
                                
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('pde.created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('product_name') && $request->product_name != '') 
        {
            $query->where('products.product_name', $request->product_name);
        }
    
        $list_product_enquiry = $query->get();
        
        $products = DB::table('products')->pluck('product_name', 'id');

		return view('admin.enquiries.list-product-document-enquiry',compact('list_product_enquiry', 'products'));
	}
	
public function bulkDeletelistproductdocEnquiry(Request $request)
{
    // Allow delete only for Super Admin
    if(auth()->user()->is_admin != 1){
        return redirect()->back()->with('error','You do not have delete permission.');
    }

    if ($request->ids && count($request->ids) > 0) {

        DB::table('product_document_enquiry')
            ->whereIn('id', $request->ids)
            ->delete();

        return redirect()->back()->with('success', 'Selected enquiries deleted successfully');
    }

    return redirect()->back()->with('error', 'Please select at least one record');
}
	//  List Product Enquiry
	public function list_product_enquiry(Request $request)
	{
		$query  = DB::table('product_enquiry as pe')
                ->join(DB::raw('(SELECT MAX(id) as id FROM product_enquiry GROUP BY mobile_no) as latest'), 'pe.id', '=', 'latest.id')
                ->join('products', 'products.id', '=', 'pe.product_id')
                ->select('pe.*', 'products.product_name')
                ->orderBy('pe.created_at', 'desc');

        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('pe.created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('product_name') && $request->product_name != '') 
        {
            $query->where('products.product_name', $request->product_name);
        }
    
        $list_product_enquiry = $query->get();
        
        /*$sql = $query->toSql();
        $bindings = $query->getBindings();
        $fullSql = vsprintf(str_replace(['?'], ['\'%s\''], $sql), $bindings);
        
        dd($fullSql);*/
        
        $products = DB::table('products')->pluck('product_name', 'id');
    
        return view('admin.enquiries.list-product-enquiry', compact('list_product_enquiry', 'products'));
	}
	
	public function list_product_enquiry_delete(Request $request)
{
    // Allow delete only for Super Admin
    if(auth()->user()->is_admin != 1){
        return redirect()->back()->with('error','You do not have delete permission.');
    }

    if ($request->ids && count($request->ids) > 0) {

        DB::table('product_enquiry')
            ->whereIn('id', $request->ids)
            ->delete();

        return redirect()->back()->with('success', 'Selected enquiries deleted successfully');
    }

    return redirect()->back()->with('error', 'Please select at least one record');
}
	//  List Brochure Enquiry
	public function list_brochure_enquiry(Request $request)
	{
		$query  = DB::table('brochure_enquiry as pde')
                ->join(DB::raw('(SELECT MAX(id) as id FROM brochure_enquiry GROUP BY mobile_no) as latest'), 'pde.id', '=', 'latest.id')
                ->join('brochures', 'brochures.id', '=', 'pde.brochure_id')
                ->select('pde.*', 'brochures.title')
                ->orderBy('pde.created_at', 'desc');
                                
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('pde.created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('brochure_name') && $request->brochure_name != '') 
        {
            $query->where('brochures.title', $request->brochure_name);
        }
    
        $list_brochure_enquiry = $query->get();
        
        $brochures = DB::table('brochures')->pluck('title', 'id');

		return view('admin.enquiries.list-brochure-enquiry',compact('list_brochure_enquiry', 'brochures'));
	}
	
	
	public function list_brochure_enquiry_delete(Request $request)
{
    // Allow delete only for Super Admin
    if(auth()->user()->is_admin != 1){
        return redirect()->back()->with('error','You do not have delete permission.');
    }

    if ($request->ids && count($request->ids) > 0) {

        DB::table('brochure_enquiry')
            ->whereIn('id', $request->ids)
            ->delete();

        return redirect()->back()->with('success', 'Selected enquiries deleted successfully');
    }

    return redirect()->back()->with('error', 'Please select at least one record');
}
	//  List Job Enquiry
	public function list_job_enquiry(Request $request)
	{
		$query  = DB::table('job_enquiry')
                ->orderBy('created_at', 'desc');
                            
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('job_title') && $request->job_title != '') 
        {
            $query->where('job_title', $request->job_title);
        }
    
        $list_job_enquiry = $query->get();
        
        $job_posts = DB::table('job_posts')->pluck('title', 'id');

		return view('admin.enquiries.list-job-enquiry',compact('list_job_enquiry', 'job_posts'));
	}
	public function list_job_enquiry_delete(Request $request)
{
    // Allow delete only for Super Admin
    if(auth()->user()->is_admin != 1){
        return redirect()->back()->with('error','You do not have delete permission.');
    }

    if ($request->ids && count($request->ids) > 0) {

        DB::table('list_job_enquiry')
            ->whereIn('id', $request->ids)
            ->delete();

        return redirect()->back()->with('success', 'Selected enquiries deleted successfully');
    }

    return redirect()->back()->with('error', 'Please select at least one record');
}
	
	//  Excel Export
	public function export_contact_us_enquiry(Request $request)
	{
		$query 	= DB::table('contact_us_enquiry')
            	->orderBy('created_at', 'desc');
            						
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }
    
        $list_contact_us_enquiry = $query->get();

		if(count($list_contact_us_enquiry) > 0) 
		{
			return Excel::download(new ContactUsEnquiryExport($list_contact_us_enquiry), 'contact-us-enquiry.xlsx');
		} 
		else 
		{
			return back()->with('error', 'List is empty');
		}
	}

	public function export_product_document_enquiry(Request $request)
	{
		$query  = DB::table('product_document_enquiry as pde')
                ->join(DB::raw('(SELECT MAX(id) as id FROM product_document_enquiry GROUP BY mobile_no) as latest'), 'pde.id', '=', 'latest.id')
                ->join('products', 'products.id', '=', 'pde.product_id')
                ->select('pde.*', 'products.product_name')
                ->orderBy('pde.created_at', 'desc');
                                
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('pde.created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('product_name') && $request->product_name != '') 
        {
            $query->where('products.product_name', $request->product_name);
        }
    
        $list_product_enquiry = $query->get();

		if(count($list_product_enquiry) > 0) 
		{
			return Excel::download(new ProductDocumentEnquiryExport($list_product_enquiry), 'product-document-enquiry.xlsx');
		} 
		else 
		{
			return back()->with('error', 'List is empty');
		}
	}
	
	public function export_product_enquiry(Request $request)
	{
		$query  = DB::table('product_enquiry as pe')
                ->join(DB::raw('(SELECT MAX(id) as id FROM product_enquiry GROUP BY mobile_no) as latest'), 'pe.id', '=', 'latest.id')
                ->join('products', 'products.id', '=', 'pe.product_id')
                ->select('pe.*', 'products.product_name')
                ->orderBy('pe.created_at', 'desc');

        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('pe.created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('product_name') && $request->product_name != '') 
        {
            $query->where('products.product_name', $request->product_name);
        }
    
        $list_product_enquiry = $query->get();
    
        if(count($list_product_enquiry) > 0)
        {
            return Excel::download(new ProductEnquiryExport($list_product_enquiry), 'product-enquiry.xlsx');
        } 
        else 
        {
            return back()->with('error', 'List is empty');
        }
	}

	public function export_brochure_enquiry(Request $request)
	{
		$query  = DB::table('brochure_enquiry as pde')
                ->join(DB::raw('(SELECT MAX(id) as id FROM brochure_enquiry GROUP BY mobile_no) as latest'), 'pde.id', '=', 'latest.id')
                ->join('brochures', 'brochures.id', '=', 'pde.brochure_id')
                ->select('pde.*', 'brochures.title')
                ->orderBy('pde.created_at', 'desc');
                                
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('pde.created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('brochure_name') && $request->brochure_name != '') 
        {
            $query->where('brochures.title', $request->brochure_name);
        }
    
        $list_brochure_enquiry = $query->get();

		if(count($list_brochure_enquiry) > 0) 
		{
			return Excel::download(new BrochureEnquiryExport($list_brochure_enquiry), 'brochure-enquiry.xlsx');
		} 
		else 
		{
			return back()->with('error', 'List is empty');
		}
	}

	public function export_job_enquiry(Request $request)
	{
		$query  = DB::table('job_enquiry')
                ->orderBy('created_at', 'desc');
                            
        if($request->has('from_date') && $request->has('to_date') && $request->from_date != '' && $request->to_date != '') 
        {
            $fromDate = $request->from_date . ' 00:00:00';
            $toDate = $request->to_date . ' 23:59:59';
            $query->whereBetween('created_at', [$fromDate, $toDate]);
        }
    
        if($request->has('job_title') && $request->job_title != '') 
        {
            $query->where('job_title', $request->job_title);
        }
    
        $list_job_enquiry = $query->get();

		if(count($list_job_enquiry) > 0) 
		{
			return Excel::download(new JobEnquiryExport($list_job_enquiry), 'job-enquiry.xlsx');
		} 
		else 
		{
			return back()->with('error', 'List is empty');
		}
	}
}
