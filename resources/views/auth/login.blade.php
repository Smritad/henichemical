<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>Home</title>
	<link rel="stylesheet" href="{{asset('public/assets/styles/style.min.css')}}">

	<!-- Waves Effect -->
	<link rel="stylesheet" href="{{asset('public/assets/plugin/waves/waves.min.css')}}">
    <?php
    $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http");
$currentUrl .= "://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

//echo $currentUrl;
if($currentUrl == 'https://henichemicals.com/login')
{
  //header("Location: /"); // redirects to the home page
  abort(404);
    exit();  
}
    ?>
</head>

<body>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <div id="single-wrapper">
    	<form action="{{ route('login') }}" method="post" class="frm-single">
            @csrf
    		<div class="inside">
    			<div class="title"><strong>Heni Chemicals</strong></div>
    			<!-- /.title -->
    			@if(request()->segment(1) === '61ap0-91kjdser-Ediuf82391')
    			    <div class="frm-title">Admin Login</div>
    			@elseif(request()->segment(1) === '70af9-83mbrdsg-Djpqf23141')
    			    <div class="frm-title">HR Login</div>
    			@elseif(request()->segment(1) === '90fh9-83kjsdf-Fjsdfl9231')
    			    <div class="frm-title">Sales Login</div>
    			    	@elseif(request()->segment(1) === 'P0A61-k9JDSER-EdIuF381')
    			    <div class="frm-title">Technical Login</div>
    			@else
    			    <div class="frm-title">Admin Login</div>
    			@endif
    			<!-- /.frm-title -->
    			<div class="frm-input"><input type="email" placeholder="Username" class="frm-inp form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><i class="fa fa-user frm-ico"></i></div>
              <input type="hidden" name="login_from" value="{{ request()->segment(1) }}">

    			<div class="frm-input"><input type="password" placeholder="Password" class="frm-inp form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><i class="fa fa-lock frm-ico"></i></div>
    			<!-- /.frm-input -->
    			{{-- <div class="clearfix margin-bottom-20">
    				<div class="pull-left">
    					<div class="checkbox primary"><input type="checkbox" id="rememberme"><label for="rememberme">Remember me</label></div>
    				</div>
    				<div class="pull-right"><a href="page-recoverpw.html" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div>
    			</div> --}}
    			
    			<button type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>
    			
    			<!--<a href="page-register.html" class="a-link"><i class="fa fa-key"></i>New to Heni Chemicals? Register.</a>-->
    			<div class="frm-footer">Heni Chemicals © {{ date('Y') }}.</div>
    		</div>
    	</form>
	</div>

<script src="{{asset('public/assets/scripts/jquery.min.js')}}"></script>
<script src="{{asset('public/assets/scripts/modernizr.min.js')}}"></script>
<script src="{{asset('public/assets/plugin/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public/assets/plugin/nprogress/nprogress.js')}}"></script>
<script src="{{asset('public/assets/plugin/waves/waves.min.js')}}"></script>

<script src="{{asset('public/assets/scripts/main.min.js')}}"></script>
</body>
</html>








































