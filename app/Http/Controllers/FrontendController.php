<?php

    namespace App\Http\Controllers;
    use Session;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Http;
    use Illuminate\Support\Str;
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Hash;
    use App\Mail\ContactEnquiry;
    use App\Mail\BrochureEnquiry;
    use App\Mail\ProductDocumentEnquiry;
    use App\Mail\ProductEnquiry;
    use App\Mail\JobEnquiry;
    use App\Mail\OTPMail;

    use Illuminate\Support\Facades\Mail;
    use DB;
    use DateTime;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Log;
    use Illuminate\Support\Facades\Cache;
  
    class FrontendController extends Controller
    {
        //  Home
        public function index()
        {
            return view('welcome');
        }


        //  About Us
        public function about_us()
        {
            return view('about-us');
        }


 


        //  Contact Us
        public function contact_us()
        {
            return view('contact-us');
        }

        public function application_details()
        {
            return view('application-details');
        }


        public function send_contact_us_enquiry(Request $request)
        {
            Log::info('Contact enquiry: Request received', $request->all());
        
            $name         = $request->input('name');
            $email        = $request->input('email');
            $mobile_no    = $request->input('mobile_no');
            $user_subject = $request->input('subject');
            $user_message = $request->input('user_message');
            $otp          = $request->input('otp');
            $recaptcha    = $request->input('g-recaptcha-response');
        
            // ------------------ reCAPTCHA ------------------
            $secret_key = "6LcIXyEqAAAAANEnq6wES3JLx3TNWjPgDU2secJH";
            $response   = Http::asForm()->post(
                "https://www.google.com/recaptcha/api/siteverify",
                ['secret' => $secret_key, 'response' => $recaptcha]
            );
            $result = json_decode($response->body());
        
            if (!$response->successful() || empty($result->success)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Recaptcha verification failed'
                ]);
            }
        
            // ------------------ OTP validation ------------------
            if ($otp) {
                $cachedOtp = Cache::get('otp_' . $email);
                if ($cachedOtp != $otp) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid OTP'
                    ]);
                }
            }
        
            // ------------------ Save enquiry ------------------
            DB::table('contact_us_enquiry')->insert([
                'name'         => $name,
                'email'        => $email,
                'mobile_no'    => $mobile_no,
                'subject'      => $user_subject,
                'user_message' => $user_message,
            ]);
        
            // ------------------ Send mail to admin ------------------
            try {
                Mail::to("sales@henichemicals.com")
                    ->cc([
                        "sales@henichemicals.com",
                    ])
                    ->send(new ContactEnquiry(
                        $name,
                        $email,
                        $mobile_no,
                        $user_subject,
                        $user_message
                    ));
            } catch (\Exception $e) {
                Log::error('Contact enquiry: Admin mail sending failed', [
                    'error' => $e->getMessage()
                ]);
            }
        
            // ------------------ Send confirmation mail to user ------------------
            try {
                Mail::to($email)
                    ->send(new \App\Mail\ContactEnquiryUserConfirmation(
                        $name,
                        $user_subject,
                        $user_message
                    ));
            } catch (\Exception $e) {
                Log::error('Contact enquiry: User mail sending failed', [
                    'error' => $e->getMessage()
                ]);
            }
        
            return response()->json([
                'success' => true,
                'message' => 'Your enquiry has been submitted. Confirmation email sent.'
            ]);
        }


    	





    	
    	public function thank_you()
        {
            return view('thank-you');
        }


        //  Brochure
        
// 404
        public function error_page()
        {
            return view('error-page');
        }
      
public function brochure()
        {
            return view('brochure');
        }
public function send_brochure_enquiry(Request $request)
{
    try {
        $brochure_id = $request->brochure_id;
        $email       = $request->email;
        $mobile_no   = $request->mobile_no;
        $otp         = $request->otp;
        $recaptcha   = $request->input('g-recaptcha-response');

        /* ── reCAPTCHA ──────────────────────────────────────── */
        $secret_key = "6LcIXyEqAAAAANEnq6wES3JLx3TNWjPgDU2secJH";
        $response   = Http::asForm()->post(
            'https://www.google.com/recaptcha/api/siteverify',
            ['secret' => $secret_key, 'response' => $recaptcha]
        );
        $result = json_decode($response->body());

        if (!$response->successful() || !$result->success) {
            return response()->json([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please refresh and try again.'
            ]);
        }

        /* ── OTP Validation ─────────────────────────────────── */
        $storedOtp = Cache::get('otp_' . $email);

        if (!$otp || !$storedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.'
            ]);
        }

        if ((string)$storedOtp !== (string)$otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please check and try again.'
            ]);
        }

        /* ── Fetch Brochure ─────────────────────────────────── */
        $brochure = DB::table('brochures')->where('id', $brochure_id)->first();

        if (!$brochure) {
            return response()->json([
                'success' => false,
                'message' => 'Brochure not found.'
            ]);
        }

        /* ── Build clean download filename ─────────────────────
           Uses brochure title, strips special chars, appends .pdf
        ──────────────────────────────────────────────────────── */
        $originalExtension = pathinfo($brochure->document_src, PATHINFO_EXTENSION) ?: 'pdf';
        $cleanTitle        = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $brochure->title);
        $cleanTitle        = trim($cleanTitle, '_');
        $downloadFilename  = $cleanTitle . '.' . $originalExtension;
        // e.g. "HENI_Product_Brochure_2025.pdf"

        $pdfPath = public_path('assets/documents/brochures/' . $brochure->document_src);

        /* ── Save Enquiry ───────────────────────────────────── */
        DB::table('brochure_enquiry')->insert([
            'brochure_id' => $brochure->id,
            'email'       => $email,
            'mobile_no'   => $mobile_no,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        /* ── Invalidate OTP after use ───────────────────────── */
        Cache::forget('otp_' . $email);

        /* ── Admin Mail ─────────────────────────────────────── */
        try {
            Mail::to('sales@henichemicals.com')
                ->send(new BrochureEnquiry($brochure->title, $email, $mobile_no));
        } catch (\Exception $e) {
            Log::error('Admin mail failed', ['error' => $e->getMessage()]);
        }

        /* ── User Mail with PDF (named attachment) ──────────── */
        try {
            Mail::to($email)->send(
                new \App\Mail\BrochureUserConfirmation(
                    $brochure->title,
                    $pdfPath,
                    $downloadFilename   // ← pass clean name to Mailable
                )
            );
        } catch (\Exception $e) {
            Log::error('User mail failed', ['error' => $e->getMessage()]);
        }

        /* ── Response ───────────────────────────────────────── */
        return response()->json([
            'success'      => true,
            'download_url' => url('public/assets/documents/brochures/' . $brochure->document_src),
            'file_name'    => $downloadFilename,   // ← JS uses this for the <a download> attribute
            'redirect_url' => url('/thank-you'),
        ]);

    } catch (\Exception $e) {
        Log::error('Brochure enquiry error', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.'
        ]);
    }
}



        //  Products By Brands
//       public function products_by_brands($slug)
// {
//     $brand_slug = $slug;

//     // Fetch Brand Details
//     $fetch_products_by_brands_details = DB::table('brands_and_products')
//         ->where('brand_slug', '=', $brand_slug)
//         ->first();

//     if (!$fetch_products_by_brands_details) {
//         abort(404);
//     }

//     // Fetch products with application_slug
//     $list_lipophilic_excipients_products = DB::table('products')
//         ->join('brands_and_products', 'products.brand_id', '=', 'brands_and_products.id')
//         ->select(
//             'products.*',
//             'brands_and_products.application_slug',
//             'brands_and_products.brand_name'
//         )
//         ->where('brands_and_products.brand_slug', '=', $brand_slug)
//         ->get();

//     return view('products-by-brands', compact('list_lipophilic_excipients_products', 'fetch_products_by_brands_details'));
// }

public function products_by_brands($slug)
{
    $brand_slug = $slug;

    // Fetch Brand Details with meta fields
    $fetch_products_by_brands_details = DB::table('brands_and_products')
        ->where('brand_slug', '=', $brand_slug)
        ->first();

    if (!$fetch_products_by_brands_details) {
        abort(404);
    }

    // Fetch products for the brand
    $list_lipophilic_excipients_products = DB::table('products')
        ->join('brands_and_products', 'products.brand_id', '=', 'brands_and_products.id')
        ->select(
            'products.*',
            'brands_and_products.application_slug',
            'brands_and_products.brand_name'
        )
        ->where('brands_and_products.brand_slug', '=', $brand_slug)
        ->get();

    // Prepare meta info
    $metaData = [
        'title' => $fetch_products_by_brands_details->meta_title ?? $fetch_products_by_brands_details->brand_name,
        'description' => $fetch_products_by_brands_details->meta_description ?? 'Explore our brand offering at HENI Chemicals.',
        'h1' => $fetch_products_by_brands_details->h1_heading ?? $fetch_products_by_brands_details->brand_name,
    ];

    return view('products-by-brands', compact('list_lipophilic_excipients_products', 'fetch_products_by_brands_details', 'metaData'));
}


        //  Products By Applications
        // public function products_by_applications($slug)
        // {
        //     $application_slug = $slug;

        //     //	Fetch Details
        //     $fetch_products_by_applications_details 	= DB::table('brands_and_products')
        //                                                 ->where('application_slug', '=', $application_slug)
        //                                                 ->first();

        //     return view('products-by-applications',['slug' => $application_slug],compact('fetch_products_by_applications_details'));
        // }

public function products_by_applications($slug)
{
    $application_slug = $slug;

    $fetch_products_by_applications_details = DB::table('brands_and_products')
        ->where('application_slug', '=', $application_slug)
        ->first();

    if (!$fetch_products_by_applications_details) {
        abort(404, 'Application not found');
    }

    $metaData = [
        'title' => $fetch_products_by_applications_details->application_title ?? $fetch_products_by_applications_details->application_name ?? 'HENI Chemicals',
        'description' => $fetch_products_by_applications_details->application_description ?? 'Explore our brand offerings at HENI Chemicals.',
        'h1' => $fetch_products_by_applications_details->application_heading ?? $fetch_products_by_applications_details->application_name ?? $application_slug,
    ];
//dd($metaData);
    return view('products-by-applications', [
        'slug' => $application_slug,
        'fetch_products_by_applications_details' => $fetch_products_by_applications_details,
        'metaData' => $metaData,
    ]);
}

        // Product Details
//       public function product_details($application_slug, $slug)
// {
//     $fetch_product_details  = DB::table('products')->where('slug', $slug)->first();

//     $fetch_brands_and_products_details = DB::table('brands_and_products')
//         ->where('id', $fetch_product_details->brand_id)
//         ->where('application_slug', $application_slug)
//         ->first();
   
// dd($slug);
//     return view('product-details', compact('fetch_product_details', 'fetch_brands_and_products_details'));
// }
// public function product_details($application_slug, $slug)
// {
//     // Get product details for the given slug (multiple products may exist)
//     $fetch_product_details  = DB::table('products')->where('slug', $slug)->get();  // Multiple products

//     // Get the brand and product details based on brand_id and application_slug
//     $fetch_brands_and_products_details = DB::table('brands_and_products')
//         ->whereIn('id', $fetch_product_details->pluck('brand_id'))  // Use whereIn to handle multiple brand_ids
//         // ->where('application_slug', $application_slug)
//         ->get();

//     // Debugging: Check the slug value
//     //  dd($fetch_brands_and_products_details);

//     return view('product-details', compact('fetch_product_details', 'fetch_brands_and_products_details'));
// }




// public function product_details($application_slug, $slug)
// {
//     $fetch_product_details = DB::table('products')
//         ->where('slug', $slug)
//         ->get();
        
//     dd($slug,$application_slug);

//     if ($fetch_product_details->isEmpty()) {
//         abort(404);
//     }

//     $fetch_brands_and_products_details = DB::table('brands_and_products')
//         ->whereIn('id', $fetch_product_details->pluck('brand_id'))
//         ->get();

//     // Prepare meta data
//     $metaData = [
//         'title' => $fetch_product_details->first()->meta_title ?? $fetch_product_details->first()->product_name,
//         'description' => $fetch_product_details->first()->meta_description ?? '',
//         'h1' => $fetch_product_details->first()->h1_heading ?? $fetch_product_details->first()->product_name,
//     ];

//     return view('product-details', compact('fetch_product_details', 'fetch_brands_and_products_details', 'metaData'));
// }




public function product_details($application_slug, $slug)
{
    // Step 1: fetch product(s) with given slug
    $fetch_product_details = DB::table('products')
        ->where('slug', $slug)
        ->get();

    if ($fetch_product_details->isEmpty()) {
        abort(404);
    }

    // Step 2: collect all brand_ids from these products
    $brandIds = $fetch_product_details->pluck('brand_id')->unique();

    // Step 3: check brands_and_products for matching brand & application_slug
    $fetch_brands_and_products_details = DB::table('brands_and_products')
        ->whereIn('id', $brandIds)
        ->where('application_slug', $application_slug)
        ->get();

    if ($fetch_brands_and_products_details->isEmpty()) {
        abort(404, 'No brand found for this application slug');
    }

    // Step 4: fetch the product from matched brands that also matches current slug
    $brand_products = DB::table('products')
        ->whereIn('brand_id', $fetch_brands_and_products_details->pluck('id'))
        ->where('slug', $slug)
        ->first();

    if (!$brand_products) {
        abort(404);
    }

    // Step 5: get brand info from products table
$brand_id = $brand_products->brand_id ?? null;
$brand_no = $brand_products->brand_no ?? null;

// Optionally, get brand name from brands_and_products table using brand_id
$brand_name = $brand_id 
    ? DB::table('brands_and_products')->where('id', $brand_id)->value('brand_name') 
    : null;

// Prepare display string
$brand_display = ($brand_name && $brand_no) ? $brand_name . ' - ' . $brand_no : $brand_name ?? '';

    /// Step 6: Prepare meta data (from matched brand + application slug product)
$metaData = [
    'title'            => $brand_products->meta_title ?? $brand_products->product_name,
    'description'      => $brand_products->meta_description ?? '',
    'canonical_url'    => $brand_products->canonical_url ?? url()->current(),
    'og_description'   => $brand_products->og_description ?? $brand_products->product_name,
    'hreflang_in'      => $brand_products->hreflang_in ?? '',
    'hreflang_default' => $brand_products->hreflang_default ?? '',
    'h1'               => $brand_products->h1_heading ?? $brand_products->product_name,
];


    return view('product-details', compact(
    'fetch_product_details',
    'fetch_brands_and_products_details',
    'brand_products',
    'brand_display',
    'brand_id',
    'brand_no',
    'metaData'
));

}





//  public function product_details($slug)
//         {
//             $product_slug = $slug;

//             //	Fetch Details
//             $fetch_product_details 	= DB::table('products')
//                                     ->where('slug', '=', $product_slug)
//                                     ->first();

//             $fetch_brands_and_products_details 	= DB::table('brands_and_products')
//                                                 ->where('id', '=', $fetch_product_details->brand_id)
//                                                 ->first();

//             return view('product-details',['slug' => $product_slug],compact('fetch_product_details', 'fetch_brands_and_products_details'));
//         }
        
        
//         public function product_details($application_slug, $slug)
// {
//     // Fetch product details by slug
//     $fetch_product_details = DB::table('products')
//         ->where('slug', $slug)
//         ->first();

//     // Handle not found
//     if (!$fetch_product_details) {
//         abort(404);
//     }

//     // Fetch brand details
//     $fetch_brands_and_products_details = DB::table('brands_and_products')
//         ->where('id', $fetch_product_details->brand_id)
//         ->first();

//     // Return view
//     return view('product-details', compact(
//         'fetch_product_details',
//         'fetch_brands_and_products_details',
//         'slug',
//         'application_slug'
//     ));
// }

         // Send OTP
// public function send_otp(Request $request)
// {
//     $email = $request->email;

//     if (!$email) {
//         return response()->json(['success' => false, 'error' => 'Email is required']);
//     }

//     $otp = rand(100000, 999999); // 6-digit OTP
//     Cache::put('otp_'.$email, $otp, now()->addMinutes(5)); // OTP valid for 5 min

//     // Send OTP email
//     Mail::to($email)->send(new OTPMail($otp));

//     return response()->json(['success' => true]);
// }


public function send_product_document_enquiry(Request $request)
{
    Log::info('Product Document Enquiry: Request received', $request->all());

    $product_id    = $request->input('product_id');
    $document_name = $request->input('document_name');
    $email         = $request->input('email');
    $sheet_title         = $request->input('sheet_title');
    $brand_name        = $request->input('brand_name');

    $mobile_no     = $request->input('mobile_no');
    $otp           = $request->input('otp');
    $recaptcha     = $request->input('g-recaptcha-response');

    // ------------------ reCAPTCHA verification ------------------
    $secret_key = "6LcIXyEqAAAAANEnq6wES3JLx3TNWjPgDU2secJH";
    $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
        'secret'   => $secret_key,
        'response' => $recaptcha,
    ]);

    $result = json_decode($response->body());
    if (!$response->successful() || empty($result->success)) {
        return response()->json([
            'success' => false,
            'message' => 'reCAPTCHA verification failed'
        ]);
    }

    // ------------------ OTP validation ------------------
    if ($otp) {
        $cachedOtp = Cache::get('otp_' . $email);
        if ($cachedOtp != $otp) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP'
            ]);
        }
    }

    // ------------------ Fetch product & basic details ------------------
    $product = DB::table('products')->where('id', $product_id)->first();
    $basic   = DB::table('basic_details')->where('id', 1)->first();

    if (!$product || !$basic) {
        return response()->json([
            'success' => false,
            'message' => 'Invalid product'
        ]);
    }

    // ------------------ Save enquiry ------------------
    DB::table('product_document_enquiry')->insert([
        'product_id'    => $product->id,
        'document_name' => $document_name,
        'email'         => $email,
        'mobile_no'     => $mobile_no
    ]);

    // ------------------ Determine PDF path ------------------
    $paths = [
        "IP"          => "products-ip/{$product->ip_src}",
        "USP"         => "products-usp/{$product->usp_src}",
        "BP"          => "products-bp/{$product->bp_src}",
        "EP"          => "products-ep/{$product->ep_src}",
        "USP-NF"      => "products-usp-nf/{$product->usp_nf_src}",
        "Spreadsheet" => "products-spreadsheet/{$product->spreadsheet_src}",
        "ACS"         => "products-acs/{$product->acs_src}",
    ];

    if (!isset($paths[$document_name])) {
        return response()->json([
            'success' => false,
            'message' => 'Document not found'
        ]);
    }

    $file_path = public_path('assets/documents/' . $paths[$document_name]);

   // ------------------ Send mail to admin ------------------
try {
    // Build PDF display name here
    $pdf_display_name = trim("{$brand_name} ({$sheet_title}).pdf");

    Mail::to('sales@henichemicals.com')
        ->cc(['sales@henichemicals.com'])
        ->send(new \App\Mail\ProductDocumentEnquiry(
            $product->product_name, // Product Name
            $brand_name,            // Brand Name
            $sheet_title,           // Sheet Title
            $email,                 // User Email
            $mobile_no,             // User Mobile
            $pdf_display_name       // PDF Display Name
        ));

    Log::info('Admin mail sent successfully');
} catch (\Exception $e) {
    Log::error('Admin mail sending failed', ['error' => $e->getMessage()]);
}

    // ------------------ Send mail to user with attached PDF ------------------
try {
    Mail::to($email)
        ->send(new \App\Mail\ProductDocumentUserConfirmation(
            $product->product_name,   // Product name from DB
            $brand_name,              // Brand name from request
            $sheet_title,             // Sheet title from request
            $document_name,           // Document type
            $file_path                // PDF path
        ));

    Log::info('User confirmation mail sent with PDF', ['email' => $email]);
} catch (\Exception $e) {
    Log::error('User mail sending failed', ['error' => $e->getMessage()]);
}


    // ------------------ Return success JSON ------------------
    // return response()->json([
    //     'success' => true,
    //     'message' => 'Your requested document has been sent to your email.'
    // ]);
    
    // ------------------ Return success JSON ------------------
return response()->json([
    'success' => true,
    'download_url' => route('thank_you') // JS will redirect
]);

}





    	
 

public function send_product_enquiry(Request $request)
{
    Log::info('STEP 1: send_product_enquiry started');

    // Always return JSON (AJAX only)
    if (!$request->ajax()) {
        return response()->json(['success' => false, 'message' => 'Invalid request.'], 400);
    }

    $product_id       = $request->input('product_id');
    $name             = $request->input('name');
    $email            = $request->input('email');
    $mobile_no        = $request->input('mobile_no');
    $user_message     = $request->input('user_message');
    $otp              = $request->input('otp');
    $recaptcha        = $request->input('g-recaptcha-response');
    $application_slug = $request->input('application_slug');
    $application_name = $request->input('application_name');
    $brand_name       = $request->input('brand_name');
    $product_name_hidden = $request->input('product_name_hidden');

    Log::info('STEP 2: Request data', [
        'product_id'       => $product_id,
        'name'             => $name,
        'email'            => $email,
        'mobile_no'        => $mobile_no,
        'application_slug' => $application_slug,
        'application_name' => $application_name,
        'brand_name'       => $brand_name,
        'recaptcha'        => $recaptcha ? 'present' : 'missing',
    ]);

    // ========================= reCAPTCHA =========================
    $secret_key = "6LcIXyEqAAAAANEnq6wES3JLx3TNWjPgDU2secJH";

    try {
        $response = Http::timeout(10)->asForm()->post(
            "https://www.google.com/recaptcha/api/siteverify",
            ['secret' => $secret_key, 'response' => $recaptcha]
        );
        $result = json_decode($response->body());

        if (!$response->successful() || empty($result->success) || $result->success !== true) {
            Log::error('reCAPTCHA failed', ['result' => $result]);
            return response()->json([
                'success' => false,
                'message' => 'reCAPTCHA verification failed. Please tick the checkbox and try again.'
            ]);
        }
    } catch (\Exception $e) {
        Log::error('reCAPTCHA HTTP error', ['error' => $e->getMessage()]);
        return response()->json([
            'success' => false,
            'message' => 'Could not verify reCAPTCHA. Please try again.'
        ]);
    }

    Log::info('STEP 3 PASSED: reCAPTCHA verified');

    // ========================= OTP =========================
    $cachedOtp = Cache::get('otp_' . $email);

    Log::info('OTP check', ['entered' => $otp, 'cached' => $cachedOtp]);

    if (empty($otp)) {
        return response()->json(['success' => false, 'message' => 'OTP is required.']);
    }

    if ((string)$cachedOtp !== (string)$otp) {
        Log::error('Invalid OTP');
        return response()->json([
            'success'   => false,
            'message'   => 'Invalid OTP. Please re-enter the correct OTP.',
            'otp_error' => true
        ]);
    }

    Log::info('OTP PASSED');

    // ========================= PRODUCT =========================
    $fetch_product_details = DB::table('products')->where('id', $product_id)->first();

    if (!$fetch_product_details) {
        Log::error('Product not found', ['product_id' => $product_id]);
        return response()->json([
            'success' => false,
            'message' => 'Product not found. Please refresh the page and try again.'
        ]);
    }

    // ========================= BUILD INDUSTRY DISPLAY =========================
    // Pull from application_name field first (already human-readable)
    // Fallback: convert slug "specialty-and-fine-chemicals" → "Specialty And Fine Chemicals"
    $industry_display = '';
    if (!empty($application_name)) {
        $industry_display = $application_name;
    } elseif (!empty($application_slug)) {
        $industry_display = ucwords(str_replace('-', ' ', $application_slug));
    }

    // ========================= DB INSERT =========================
    DB::table('product_enquiry')->insert([
        'product_id'   => $fetch_product_details->id,
        'name'         => $name,
        'email'        => $email,
        'mobile_no'    => $mobile_no,
        'user_message' => $user_message ?: null,
        'created_at'   => now(),
        'updated_at'   => now(),
    ]);

    Log::info('Enquiry saved to DB');

   // ========================= ADMIN MAIL =========================
try {
    Mail::to('sales@henichemicals.com')
        ->cc(['sales@henichemicals.com'])
        ->send(new \App\Mail\ProductEnquiry(
            $name,
            $fetch_product_details->product_name,
            $email,
            $mobile_no,
            $user_message,
            $industry_display,
            $brand_name
        ));
    Log::info('Admin mail sent successfully');

} catch (\Exception $e) {
    // Log full details so you can see EXACTLY what failed
    Log::error('Admin mail FAILED', [
        'error'   => $e->getMessage(),
        'file'    => $e->getFile(),
        'line'    => $e->getLine(),
        'to'      => 'sales@henichemicals.com',
        'product' => $fetch_product_details->product_name ?? 'unknown',
    ]);
}

    // ========================= USER CONFIRMATION MAIL =========================
    try {
        Mail::to($email)
            ->send(new \App\Mail\ProductEnquiryUserConfirmation(
                $name,
                $fetch_product_details->product_name,
                $industry_display
            ));
        Log::info('User confirmation mail sent');
    } catch (\Exception $e) {
        Log::error('User confirmation mail failed', ['error' => $e->getMessage()]);
    }

    // Clear OTP
    Cache::forget('otp_' . $email);

    return response()->json([
        'success'      => true,
        'message'      => 'Your enquiry has been submitted successfully!',
        'redirect_url' => route('thank_you')
    ]);
}



        //  Careers
        public function careers()
        {
            $fetch_career_page_details 	= DB::table('career_page_details')
                                        ->where('id', '=', '1')
                                        ->first();
            return view('careers', compact('fetch_career_page_details'));
        }

    //     public function send_job_enquiry(Request $request)
    // 	{
    // 		$job_title = $request->input('job_title');
    //         $name = $request->input('name');
    // 		$email = $request->input('email');
    // 		$mobile_no = $request->input('mobile_no');
    //         $document_src = $request->file('document_src');
    // 		$about = $request->input('about');
    //         $otp = $request->input('otp');
            
    //         $recaptcha = $request->input('g-recaptcha-response');
            
    //         $secret_key = "6LcIXyEqAAAAANEnq6wES3JLx3TNWjPgDU2secJH";

    //         $url = "https://www.google.com/recaptcha/api/siteverify";
    
    //         $response = Http::asForm()->post($url, [
    //             'secret' => $secret_key,
    //             'response' => $recaptcha,
    //         ]);
        
    //         $result = json_decode($response->body());
            
    //         if($response->successful() && $result->success == true) 
    //         {
    //             // Validate OTP
    //             if($otp && Cache::get('otp_'.$email) != $otp) 
    //             {
    //                 return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    //             }
    
    //             if($request->hasFile('document_src')) 
    //             {
    //                 $document_src_path = public_path('assets/documents/cv/'.$document_src->getClientOriginalName());
    
    //                 try 
    //                 {
    //                     $document_src->move(public_path('assets/documents/cv'), $document_src->getClientOriginalName());
                        
    //                     //  Fetch Basic Details
    //             		$fetch_basic_details 	= DB::table('basic_details')
    //         								    ->where('id','=','1')
    //         								    ->first();
            								    
    //         			//  Insert Job Enquiry Details
    //         			$values=array('job_title'=>$job_title, 'name'=>$name, 'email'=>$email, 'mobile_no'=>$mobile_no, 'document_src'=>$document_src->getClientOriginalName(), 'about'=>$about);
            		
    //             		$insert_query 	= DB::table('job_enquiry')
    //             						->insert($values);
    
    //                     // Send Mail
    //                     Mail::to($fetch_basic_details->career_enquiry_email)->send(new JobEnquiry($job_title, $name, $email, $mobile_no, $document_src_path, $about));
    
    //                     //  unlink($document_src_path);
    
    //                     return response()->json(['success' => true]);
    //                 } 
    //                 catch (\Exception $e) 
    //                 {
    //                     Log::error('Error while sending email: '.$e->getMessage());
    //                     echo "An error occurred while sending the email.";
    //                 }
    //             }
    //             else
    //             {
    //                 echo "Document source file not found.";
    
    //                 return response()->json(['success' => false]);
    //             }
    //         }
    // 	}
public function send_job_enquiry(Request $request)
{
    $job_title   = $request->input('job_title');
    $name        = $request->input('name');
    $email       = $request->input('email');
    $mobile_no   = $request->input('mobile_no');
    $document    = $request->file('document_src');
    $about       = $request->input('about');
    $otp         = $request->input('otp');
    $recaptcha   = $request->input('g-recaptcha-response');

    // ✅ Verify Google Recaptcha
    $secret_key = "6LcIXyEqAAAAANEnq6wES3JLx3TNWjPgDU2secJH";
    $url = "https://www.google.com/recaptcha/api/siteverify";

    $response = Http::asForm()->post($url, [
        'secret'   => $secret_key,
        'response' => $recaptcha,
    ]);

    $result = json_decode($response->body());

    if ($response->successful() && $result->success == true) {

        // ✅ Validate OTP
        if ($otp && Cache::get('otp_' . $email) != $otp) {
            return back()->withErrors(['otp' => 'Invalid OTP'])->withInput();
        }

        if ($request->hasFile('document_src')) {

            $fileName = time() . '_' . $document->getClientOriginalName();
            $document->move(public_path('assets/documents/cv'), $fileName);
            $document_src_path = public_path('assets/documents/cv/' . $fileName);

            try {
                // ✅ Save Job Enquiry
                DB::table('job_enquiry')->insert([
                    'job_title'    => $job_title,
                    'name'         => $name,
                    'email'        => $email,
                    'mobile_no'    => $mobile_no,
                    'document_src' => $fileName,
                    'about'        => $about,
                ]);

                // ✅ Send Mail only to fixed email
                Mail::to("sales@henichemicals.com")
                    ->send(new JobEnquiry($job_title, $name, $email, $mobile_no, $document_src_path, $about));

                // ✅ Redirect to Thank You page
                return redirect()->route('thank_you')->with('success', 'Your job enquiry has been submitted successfully!');

            } catch (\Exception $e) {
                \Log::error('Error while sending job enquiry email: ' . $e->getMessage());
                return back()->withErrors(['mail' => 'Failed to send enquiry, please try again.'])->withInput();
            }
        } else {
            return back()->withErrors(['document_src' => 'Please upload your CV'])->withInput();
        }
    }

    return back()->withErrors(['recaptcha' => 'Recaptcha verification failed'])->withInput();
}


        //  Products
        public function products()
        {
            //dd('dsfs');
            return view('products');
        }


        //  Search
  public function search(Request $request)
{
    $keyword = trim($request->keyword);

    // ---------------- Split keyword like: ZONPrime - 142 ----------------
    $brandName = $keyword;
    $brandNo   = null;

    if (strpos($keyword, '-') !== false) {
        [$brandName, $brandNo] = array_map('trim', explode('-', $keyword, 2));
    }

    /* ================= PRODUCTS ================= */
   $list_products = DB::table('products')
    ->join('brands_and_products', 'brands_and_products.id', '=', 'products.brand_id')
    ->where('products.status', 1)
    ->where(function ($q) use ($keyword, $brandName, $brandNo) {

        $q->where('products.product_name', 'LIKE', "%{$keyword}%")
          ->orWhere('products.product_type', 'LIKE', "%{$keyword}%")
          ->orWhere('products.short_description', 'LIKE', "%{$keyword}%")
          ->orWhere('products.description', 'LIKE', "%{$keyword}%");

        if ($brandName) {
            $q->orWhere('brands_and_products.brand_name', 'LIKE', "%{$brandName}%");
        }

        if ($brandNo) {
            $q->orWhere('products.brand_no', 'LIKE', "%{$brandNo}%");
        }

        if ($brandName && $brandNo) {
            $q->orWhere(function ($sub) use ($brandName, $brandNo) {
                $sub->where('brands_and_products.brand_name', 'LIKE', "%{$brandName}%")
                    ->where('products.brand_no', 'LIKE', "%{$brandNo}%");
            });
        }
    })

    // ✅ ADD THIS ORDER BY LOGIC
    ->orderByRaw("
        CASE 
            WHEN products.product_name LIKE ? THEN 1
            WHEN brands_and_products.brand_name LIKE ? AND products.brand_no LIKE ? THEN 2
            WHEN brands_and_products.brand_name LIKE ? THEN 3
            WHEN products.brand_no LIKE ? THEN 4
            ELSE 5
        END
    ", [
        "%{$keyword}%",
        "%{$brandName}%", "%{$brandNo}%",
        "%{$brandName}%",
        "%{$brandNo}%"
    ])

    ->select(
        'products.*',
        'brands_and_products.brand_name',
        'brands_and_products.application_name',
        'brands_and_products.application_slug'
    )
    ->get();

    /* ================= BRAND ================= */
    $fetch_brand_details = DB::table('brands_and_products')
        ->where('status', 1)
        ->where('brand_name', 'LIKE', "%{$brandName}%")
        ->first();

    /* ================= APPLICATION ================= */
    $fetch_application_details = DB::table('brands_and_products')
        ->where('status', 1)
        ->where('application_name', 'LIKE', "%{$keyword}%")
        ->first();

    /* ================= BROCHURES ================= */
    $list_brochures = DB::table('brochures')
        ->where('status', 1)
        ->where('title', 'LIKE', "%{$keyword}%")
        ->get();

    return view('search-result', compact(
        'keyword',
        'list_products',
        'list_brochures',
        'fetch_brand_details',
        'fetch_application_details'
    ));
}

        
        
        //  Get Product Application Ajax
      public function get_product_applications(Request $request)
{
    $product_id = $request->input('product_id');

    $fetch_product_details = DB::table('products')
        ->where('id', $product_id)
        ->first();

    $products_with_same_name = DB::table('products')
        ->where('product_name', $fetch_product_details->product_name)
        ->distinct()
        ->get();

    $list_product_applications = DB::table('brands_and_products')
        ->whereIn('id', $products_with_same_name->pluck('brand_id'))
        ->where('status', '=', '1')
        ->get();

    $data = $list_product_applications->map(function ($application) use ($fetch_product_details) {
        $product_slug = DB::table('products')
            ->where('brand_id', $application->id)
            ->where('product_name', $fetch_product_details->product_name)
            ->value('slug');

        return [
            'img_src'            => asset('public/assets/images/brands-and-products/' . $application->img_src),
            'icon_img_src'       => asset('public/assets/images/brands-and-products/' . $application->icon_img_src),
            'application_name'   => $application->application_name,
            'product_slug'       => $product_slug,
            'application_slug'   => $application->application_slug, // ✅ Add this line
            'product_name'       => $fetch_product_details->product_name,
        ];
    });

    return response()->json($data);
}






      
        
        
     


public function send_otp(Request $request)
{
    try {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $otp   = rand(100000, 999999);

        Cache::put('otp_' . $email, $otp, now()->addMinutes(5));

        // Send OTP via mail
        Mail::to($email)->send(new OTPMail($otp));

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error'   => $e->getMessage(), // send reason to frontend
        ], 500);
    }
}
public function verify_otp(Request $request)
{
    // Validate input
    $request->validate([
        'email' => 'required|email',
        'otp'   => 'required|digits:6',
    ]);

    $email = $request->email;
    $otp   = $request->otp;

    // Check OTP directly from DB where it hasn't expired
    $record = DB::table('otps')
        ->where('email', $email)
        ->where('otp', $otp)
        ->where('expires_at', '>', now())
        ->latest('created_at') // in case multiple OTPs exist, pick the latest
        ->first();

    if ($record) {
        // ✅ OTP is correct, optionally delete it after verification
        DB::table('otps')->where('id', $record->id)->delete();

        return response()->json([
            'success' => true,
            'message' => 'OTP verified successfully'
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'Invalid or expired OTP'
        ]);
    }
}




//       public function productApplicationList($slug = null)
// {
//     if (empty($slug)) {
//         abort(404, 'No product slug provided.');
//     }

//     // Your existing logic
//     $product = DB::table('products')->where('slug', $slug)->first();

//     if (!$product) {
//         abort(404);
//     }

//   $applications = DB::table('products')
//     ->join('brands_and_products', 'products.brand_id', '=', 'brands_and_products.id')
//     ->select(
//         'brands_and_products.id',
//         'brands_and_products.application_slug',
//         'products.slug as product_slug',
//         'brands_and_products.application_name',
//         'brands_and_products.img_src',
//         'brands_and_products.icon_img_src',
//         'products.product_name'
//     )
//     ->where('products.product_name', $product->product_name)
//     ->groupBy('brands_and_products.id', 'brands_and_products.application_slug', 'products.slug', 'brands_and_products.application_name', 'brands_and_products.img_src', 'brands_and_products.icon_img_src', 'products.product_name')
//     ->get();

// // dd($applications);
//     return view('product_application_list', compact('product', 'applications'));
// }

public function productApplicationList($slug = null)
{
    if (empty($slug)) {
        abort(404, 'No product slug provided.');
    }

    // Fetch product from products table (only active)
    $product = DB::table('products')
        ->where('slug', $slug)
        ->where('status', 1) // ✅ only active products
        ->first();

    if (!$product) {
        abort(404, 'Product not found or inactive.');
    }

    // Fetch product details from products_listing (only active)
    $productListing = DB::table('products_listing')
        ->leftJoin('brands_and_products', 'products_listing.brand_id', '=', 'brands_and_products.id')
        ->select(
            'products_listing.*',
            'brands_and_products.brand_name'
        )
        ->where('products_listing.slug', $slug)
        ->where('products_listing.status', 1) // ✅ only active listings
        ->first();

    if (!$productListing) {
        abort(404, 'Product listing not found or inactive.');
    }

    // Decode grades JSON for Blade
    $grades = !empty($productListing->grades) ? json_decode($productListing->grades, true) : [];

    // Fetch applications (from brands_and_products join)
    $applications = DB::table('products')
        ->join('brands_and_products', 'products.brand_id', '=', 'brands_and_products.id')
        ->select(
            'brands_and_products.id',
            'brands_and_products.application_slug',
            'products.slug as product_slug',
            'brands_and_products.application_name',
            'brands_and_products.img_src',
            'brands_and_products.icon_img_src',
            'products.product_name',
            'products.product_info_image'
        )
        ->where('products.product_name', $product->product_name)
        ->where('products.status', 1) // ✅ only active products
        ->groupBy(
            'brands_and_products.id',
            'brands_and_products.application_slug',
            'products.slug',
            'brands_and_products.application_name',
            'brands_and_products.img_src',
            'brands_and_products.icon_img_src',
            'products.product_name',
            'products.product_info_image'
        )
        ->get();

    // SEO Meta Data
    $metaData = [
        'title'           => $productListing->meta_title ?? $product->product_name,
        'description'     => $productListing->meta_description ?? '',
        'canonical_url'   => $productListing->canonical_url ?? '',
        'og_description'  => $productListing->og_description ?? '',
        'hreflang_in'     => $productListing->hreflang_in ?? '',
        'hreflang_default'=> $productListing->hreflang_default ?? '',
        'h1'              => $productListing->h1_heading ?? $product->product_name,
    ];

    return view('product_application_list', compact('product', 'productListing', 'applications', 'grades', 'metaData'));
}



    }
    
    
?>