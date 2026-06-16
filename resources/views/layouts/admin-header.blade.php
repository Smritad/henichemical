<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Heni Chemicals</title>

	<!-- Main Styles -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/styles/style.min.css')}}">
	
	<!-- Material Design Icon -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/fonts/material-design/css/materialdesignicons.css')}}">

	<!-- mCustomScrollbar -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/waves/waves.min.css')}}">

	<!-- Sweet Alert -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/sweet-alert/sweetalert.css')}}">
	
	<!-- Percent Circle -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/percircle/css/percircle.css')}}">

	<!-- Chartist Chart -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/chart/chartist/chartist.min.css')}}">

	<!-- FullCalendar -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/fullcalendar/fullcalendar.min.css')}}">
	<link rel="stylesheet" href="{{asset('public/admin/assets/plugin/fullcalendar/fullcalendar.print.css')}}" media='print'>
<link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/41.0.0/classic/ckeditor.css">
 
      <script src="https://cdn.tiny.cloud/1/egdhznm24pvhum0tb03r9g3lpmjrlz1ux4hac6z5m6dori11/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
	<!-- Color Picker -->
	<link rel="stylesheet" href="{{asset('public/admin/assets/color-switcher/color-switcher.min.css')}}">
</head>

<body>
<div class="main-menu">
	<header class="header">
		<a href="{{route('admin.admin_home')}}" class="logo">Heni Chemicals</a>
		<button type="button" class="button-close fa fa-times js__menu_close"></button>
	</header>
	<!-- /.header -->
	<div class="content">

		<div class="navigation">
@php
    $roleId      = Auth::check() ? Auth::user()->role_id : null;
    $isAdmin     = $roleId == 1;
    $isHR        = $roleId == 3;
    $isSales     = $roleId == 4;
    $isTechnical = $roleId == 5;

    // Enquiries: Technical gets NONE
    $showContactEnquiry  = $isAdmin || $isSales;
    $showProductDocEnq   = $isAdmin || $isSales;
    $showProductEnquiry  = $isAdmin || $isSales;
    $showBrochureEnquiry = $isAdmin || $isSales;
    $showJobEnquiry      = $isAdmin || $isHR;
    $showEnquiriesMenu   = $showContactEnquiry || $showProductDocEnq
                        || $showProductEnquiry || $showBrochureEnquiry
                        || $showJobEnquiry;
@endphp

<ul class="menu js__accordion">

    {{-- Dashboard: everyone --}}
    <li class="{{ Route::currentRouteName() == 'admin.admin_home' ? 'current' : '' }}">
        <a class="waves-effect" href="{{ route('admin.admin_home') }}">
            <i class="menu-icon mdi mdi-view-dashboard"></i><span>Dashboard</span>
        </a>
    </li>

    {{-- Basic Details / Home Page / About Us: Admin + Technical --}}
    @if($isAdmin || $isTechnical)
        <li class="{{ Route::currentRouteName() == 'admin.show_update_basic_details' ? 'current' : '' }}">
            <a class="waves-effect" href="{{ route('admin.show_update_basic_details') }}">
                <i class="menu-icon fa fa-bar-chart"></i><span>Basic Details</span>
            </a>
        </li>

        <li class="{{ in_array(Route::currentRouteName(), ['admin.home_page_details','admin.view_banner_details','admin.view_key_point_details','admin.view_certificate_details']) ? 'current' : '' }}">
            <a class="waves-effect" href="{{ route('admin.home_page_details') }}">
                <i class="menu-icon fa fa-home"></i><span>Home Page</span>
            </a>
        </li>

        <li class="{{ in_array(Route::currentRouteName(), ['admin.about_us_details','admin.view_about_us_why_zon_details']) ? 'current' : '' }}">
            <a class="waves-effect" href="{{ route('admin.about_us_details') }}">
                <i class="menu-icon fa fa-info-circle"></i><span>About Us</span>
            </a>
        </li>
    @endif

    {{-- Brochures: Admin + Sales + Technical --}}
    @if($isAdmin || $isSales || $isTechnical)
        <li class="{{ in_array(Route::currentRouteName(), ['admin.show_add_brochure','admin.list_brochures','admin.view_brochure_details']) ? 'current' : '' }}">
            <a class="waves-effect parent-item js__control" href="#">
                <i class="menu-icon fa fa-file-pdf-o"></i>
                <span>Brochures</span>
                <span class="menu-arrow fa fa-angle-down"></span>
            </a>
            <ul class="sub-menu js__content">
                <li class="{{ Route::currentRouteName() == 'admin.show_add_brochure' ? 'current' : '' }}">
                    <a href="{{ route('admin.show_add_brochure') }}">Add Brochure</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'admin.list_brochures' ? 'current' : '' }}">
                    <a href="{{ route('admin.list_brochures') }}">List Brochures</a>
                </li>
            </ul>
        </li>
    @endif

    {{-- Brands & Products: Admin + Technical --}}
    @if($isAdmin || $isTechnical)
        <li class="{{ in_array(Route::currentRouteName(), ['admin.show_add_brands_and_products','admin.list_brands_and_products','admin.view_brands_and_products_details','admin.list_products','admin.show_add_product','admin.view_product_details','admin.list_product_applications','admin.listing-products']) ? 'current' : '' }}">
            <a class="waves-effect parent-item js__control" href="#">
                <i class="menu-icon fa fa-cubes"></i>
                <span>Brands & Products</span>
                <span class="menu-arrow fa fa-angle-down"></span>
            </a>
            <ul class="sub-menu js__content">
                <li class="{{ Route::currentRouteName() == 'admin.show_add_brands_and_products' ? 'current' : '' }}">
                    <a href="{{ route('admin.show_add_brands_and_products') }}">Add Brands & Products</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'admin.list_brands_and_products' ? 'current' : '' }}">
                    <a href="{{ route('admin.list_brands_and_products') }}">List Brands & Products</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'admin.listing-products' ? 'current' : '' }}">
                    <a href="{{ route('admin.listing-products') }}">Parent Page</a>
                </li>
            </ul>
        </li>
    @endif

    {{-- Careers: Admin + HR + Technical --}}
    @if($isAdmin || $isHR || $isTechnical)
        <li class="{{ in_array(Route::currentRouteName(), ['admin.career_details','admin.view_job_post_details']) ? 'current' : '' }}">
            <a class="waves-effect" href="{{ route('admin.career_details') }}">
                <i class="menu-icon fa fa-briefcase"></i><span>Careers</span>
            </a>
        </li>
    @endif

    {{-- Events: Admin + Sales + Technical --}}
    @if($isAdmin || $isSales || $isTechnical)
        <li class="{{ in_array(Route::currentRouteName(), ['admin.show_add_event','admin.list_events','admin.view_event_details']) ? 'current' : '' }}">
            <a class="waves-effect parent-item js__control" href="#">
                <i class="menu-icon fa fa-calendar"></i>
                <span>Events</span>
                <span class="menu-arrow fa fa-angle-down"></span>
            </a>
            <ul class="sub-menu js__content">
                <li class="{{ Route::currentRouteName() == 'admin.show_add_event' ? 'current' : '' }}">
                    <a href="{{ route('admin.show_add_event') }}">Add Event</a>
                </li>
                <li class="{{ Route::currentRouteName() == 'admin.list_events' ? 'current' : '' }}">
                    <a href="{{ route('admin.list_events') }}">List Events</a>
                </li>
            </ul>
        </li>
    @endif

    {{-- Enquiries: NOT shown for Technical --}}
    @if($showEnquiriesMenu)
        <li class="{{ in_array(Route::currentRouteName(), ['admin.list_contact_us_enquiry','admin.list_product_document_enquiry','admin.list_product_enquiry','admin.list_brochure_enquiry','admin.list_job_enquiry']) ? 'current' : '' }}">
            <a class="waves-effect parent-item js__control" href="#">
                <i class="menu-icon fa fa-envelope"></i>
                <span>Enquiries</span>
                <span class="menu-arrow fa fa-angle-down"></span>
            </a>
            <ul class="sub-menu js__content">
                @if($showContactEnquiry)
                    <li class="{{ Route::currentRouteName() == 'admin.list_contact_us_enquiry' ? 'current' : '' }}">
                        <a href="{{ route('admin.list_contact_us_enquiry') }}">Contact Us Enquiry</a>
                    </li>
                @endif
                @if($showProductDocEnq)
                    <li class="{{ Route::currentRouteName() == 'admin.list_product_document_enquiry' ? 'current' : '' }}">
                        <a href="{{ route('admin.list_product_document_enquiry') }}">Product Document Enquiry</a>
                    </li>
                @endif
                @if($showProductEnquiry)
                    <li class="{{ Route::currentRouteName() == 'admin.list_product_enquiry' ? 'current' : '' }}">
                        <a href="{{ route('admin.list_product_enquiry') }}">Product Enquiry</a>
                    </li>
                @endif
                @if($showBrochureEnquiry)
                    <li class="{{ Route::currentRouteName() == 'admin.list_brochure_enquiry' ? 'current' : '' }}">
                        <a href="{{ route('admin.list_brochure_enquiry') }}">Brochure Enquiry</a>
                    </li>
                @endif
                @if($showJobEnquiry)
                    <li class="{{ Route::currentRouteName() == 'admin.list_job_enquiry' ? 'current' : '' }}">
                        <a href="{{ route('admin.list_job_enquiry') }}">Job Enquiry</a>
                    </li>
                @endif
            </ul>
        </li>
    @endif

</ul>		</div>
	</div>
</div>

<div class="fixed-navbar">
	<div class="pull-left">
		<button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
		<h1 class="page-title">
		    @if(Auth::user()->role_id == 1)
			    Admin
			@elseif(Auth::user()->role_id == 3)
			    HR
			@elseif(Auth::user()->role_id == 4)
			    Sales
			@elseif(Auth::user()->role_id == 5)
			    Technical
			@else
			    Admin
			@endif
		</h1>
		<!-- /.page-title -->
	</div>
	<!-- /.pull-left -->
	<div class="pull-right">
		
		
	

		
		<div class="ico-item">
			<img src="{{ asset('public/admin/assets/images/logout.png') }}" alt="" class="ico-img">
			<ul class="sub-ico-item">
				
				<li>	<a href="{{ route('logout') }}"
   onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Log Out</a>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

		
				</li>
			</ul>
			<!-- /.sub-ico-item -->
		</div>
		<!-- /.ico-item -->
	</div>
	<!-- /.pull-right -->
</div>
<!-- /.fixed-navbar -->

<div id="notification-popup" class="notice-popup js__toggle" data-space="50">
	<h2 class="popup-title">Your Notifications</h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Anna William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-warning"><i class="fa fa-warning"></i></span>
					<span class="name">Update Status</span>
					<span class="desc">Failed to get available update data. To ensure the please contact us.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Michael Zenaty</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">50 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Simon</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">1 hour</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-violet"><i class="fa fa-flag"></i></span>
					<span class="name">Account Contact Change</span>
					<span class="desc">A contact detail associated with your account has been changed.</span>
					<span class="time">2 hours</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Helen 987</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Yesterday</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Denise Jenny</span>
					<span class="desc">Like your post: “Contact Form 7 Multi-Step”</span>
					<span class="time">Oct, 28</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Thomas William</span>
					<span class="desc">Like your post: “Facebook Messenger”</span>
					<span class="time">Oct, 27</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>
<!-- /#notification-popup -->

<div id="message-popup" class="notice-popup js__toggle" data-space="50">
	<h2 class="popup-title">Recent Messages<a href="#" class="pull-right text-danger">New message</a></h2>
	<!-- /.popup-title -->
	<div class="content">
		<ul class="notice-list">
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">John Doe</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">10 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Harry Halen</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">15 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Thomas Taylor</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">30 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Jennifer</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/80x80" alt=""></span>
					<span class="name">Helen Candy</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">45 min</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Anna Cavan</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 hour ago</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar bg-success"><i class="fa fa-user"></i></span>
					<span class="name">Jenny Betty</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 day ago</span>
				</a>
			</li>
			<li>
				<a href="#">
					<span class="avatar"><img src="http://placehold.it/128x128" alt=""></span>
					<span class="name">Denise Peterson</span>
					<span class="desc">Amet odio neque nobis consequuntur consequatur a quae, impedit facere repellat voluptates.</span>
					<span class="time">1 year ago</span>
				</a>
			</li>
		</ul>
		<!-- /.notice-list -->
		<a href="#" class="notice-read-more">See more messages <i class="fa fa-angle-down"></i></a>
	</div>
	<!-- /.content -->
</div>

<!-- #color-switcher -->
@yield('content')
		<!-- /.row -->		
		<footer class="footer">
			<ul class="list-inline">
				{{-- <li>{{ date('Y') }} © Heni Chemicals. All Rights Reserved.</li> --}}
				{{-- <li><a href="#">Privacy</a></li>
				<li><a href="#">Terms</a></li>
				<li><a href="#">Help</a></li> --}}
			</ul>
		</footer>
	</div>
	<!-- /.main-content -->
</div><!--/#wrapper -->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
	<!-- 
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="{{asset('public/admin/assets/scripts/jquery.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/scripts/modernizr.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/plugin/nprogress/nprogress.js')}}"></script>
	<script src="{{asset('public/admin/assets/plugin/sweet-alert/sweetalert.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/plugin/waves/waves.min.js')}}"></script>
	<!-- Full Screen Plugin -->
	<script src="{{asset('public/admin/assets/plugin/fullscreen/jquery.fullscreen-min.js')}}"></script>

	<!-- Google Chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

	<!-- chart.js Chart -->
	<script src="{{asset('public/admin/assets/plugin/chart/chartjs/Chart.bundle.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/scripts/chart.chartjs.init.min.js')}}"></script>

	<!-- FullCalendar -->
	<script src="{{asset('public/admin/assets/plugin/moment/moment.js')}}"></script>
	<script src="{{asset('public/admin/assets/plugin/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/scripts/fullcalendar.init.js')}}"></script>

	<!-- Sparkline Chart -->
	<script src="{{asset('public/admin/assets/plugin/chart/sparkline/jquery.sparkline.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/scripts/chart.sparkline.init.min.js')}}"></script>

	<script src="{{asset('public/admin/assets/scripts/main.min.js')}}"></script>
	<script src="{{asset('public/admin/assets/color-switcher/color-switcher.min.js')}}"></script>
	
	<!-- ck editor -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-s6sCJ0EXs6KwQFB6Pv7BlK39V9yzwbT9lCjyBjy/CwI=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.ckeditor.com/ckeditor5/34.0.0/classic/ckeditor.js"></script>
    <!-- Summernote CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.css" rel="stylesheet">

<!-- Summernote JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote.min.js"></script>
<script>
  $(document).ready(function() {
      $('#summernote').summernote({
          height: 250,        // editor height
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontsize', 'color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link']],
              ['view', ['fullscreen', 'codeview']]
          ]
      });
  });
</script>
<script>
  $(document).ready(function() {
      $('#summernote1').summernote({
          height: 250,        // editor height
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontsize', 'color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link']],
              ['view', ['fullscreen', 'codeview']]
          ]
      });
  });
</script>
 <script>
  $(document).ready(function() {
      $('#summernote2').summernote({
          height: 250,        // editor height
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontsize', 'color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link']],
              ['view', ['fullscreen', 'codeview']]
          ]
      });
  });
</script>
 <script>
  $(document).ready(function() {
      $('#summernote3').summernote({
          height: 250,        // editor height
          toolbar: [
              ['style', ['bold', 'italic', 'underline', 'clear']],
              ['font', ['fontsize', 'color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['insert', ['link']],
              ['view', ['fullscreen', 'codeview']]
          ]
      });
  });
</script>

    <script>
  ClassicEditor
    .create(document.querySelector('#description'))
    .catch(error => {
      console.error(error);
    });
</script>
 <script>
  ClassicEditor
    .create(document.querySelector('#head_office_address'))
    .catch(error => {
      console.error(error);
    });
</script>
<script>
  ClassicEditor
    .create(document.querySelector('#site_location'))
    .catch(error => {
      console.error(error);
    });
</script>
<script>
  ClassicEditor
    .create(document.querySelector('#title'))
    .catch(error => {
      console.error(error);
    });
</script>
    <script type="text/javascript">
        function showDiv(select) {
            if (select.value == 1) {
                document.getElementById('hidden_div').style.display = "block";
            } else {
                document.getElementById('hidden_div').style.display = "none";
            }
        }
    </script>
    

	<!-- DataTable -->
	<link href="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.6/datatables.min.js"></script>
    
    <script>
        $(document).ready(function() {
            $('.datatable').DataTable();
        });
    </script>

	<!-- Datepicker -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

	<script>
		$(document).ready(function() {
			$(".custom-datepicker").datepicker({
				format: 'dd-mm-yyyy',
      			autoclose: true 
			});

			$('#datetimepicker').datetimepicker({
				format: 'DD-MM-YYYY hh:mm:ss A',
				icons: {
					time: 'fa fa-clock-o',
					date: 'fa fa-calendar',
					up: 'fa fa-chevron-up',
					down: 'fa fa-chevron-down',
					previous: 'fa fa-chevron-left',
					next: 'fa fa-chevron-right',
					today: 'fa fa-calendar-check-o',
					clear: 'fa fa-trash',
					close: 'fa fa-times'
				}
			});
		});
	</script>

	<!-- Tags Input -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>

	<script>
        $(document).ready(function () {
            $('.tags-input').tagsinput();
        });
    </script>

	<style>
		.bootstrap-tagsinput
		{
			width: 100%;
			line-height: 35px;
		}

		.bootstrap-tagsinput .tag
		{
			font-size: 14px;
		}
	</style>


	<!-- Select 2 -->
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

	<script>
		$(document).ready(function() {
			$('.select2').select2({
				placeholder: 'Select Option'
			});
		});
	</script>

	<style>
		.select2-container--default .select2-selection--multiple .select2-selection__rendered
		{
			padding: 10px 5px;
		}
	</style>
	
 
 
<script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#editor').value = editor.getData();
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor1'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#editor1').value = editor.getData();
        }
    });
});
</script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#faq-editor'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#faq-editor').value = editor.getData();
        }
    });
});
</script>
 <script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor6'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#editor6').value = editor.getData();
        }
    });
});
</script>
 
 
 <script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor2'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#editor2').value = editor.getData();
        }
    });
});
</script>

 <script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor5'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#editor5').value = editor.getData();
        }
    });
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    let editor;
    ClassicEditor
        .create(document.querySelector('#editor3'))
        .then(newEditor => {
            editor = newEditor;
        })
        .catch(error => { console.error(error); });
 
    // Attach submit listener to the form
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // Update textarea value with CKEditor data
        if (editor) {
            document.querySelector('#editor').value = editor.getData();
        }
    });
});
</script>

<script>
    $('#applications').owlCarousel({
    loop: true,
    margin: 20,          // spacing between items
    nav: true,           // next/prev arrows
    dots: false,         // remove dots if not needed
    stagePadding: 0,     // ✅ prevent half cut items
    responsive: {
        0: { items: 1 },
        768: { items: 2 },
        1024: { items: 3 }
    }
});
</script>

</body>
</html>