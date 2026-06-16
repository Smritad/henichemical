@extends('layouts.app')
@section('meta_title', 'Careers at HENI Chemicals | Join Our R&D & Commercial Teams')
@section('meta_description', 'Explore current openings and career opportunities at HENI. Be part of a growing global specialty chemical company.')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
    <style>
        .mobile-wrapper { margin-bottom: 20px; }
        .error-text {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            display: block;
            min-height: 16px;
        }
        input.invalid { border: 1px solid red; }

        /* intl-tel-input — make the flag input fill the column */
        .iti { width: 100%; }
        /* Keep the country dropdown above the Bootstrap modal (modal z-index ~1050) */
        .iti__country-list { z-index: 1100; }
    </style>
    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/career-banner.jpg')}}'); background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
            <h1>Careers – Grow with HENI Chemicals</h1>
                        <ul>
                            <li><a href="{{ route('/') }}">Home</a></li>
                            <li>Careers</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="careers-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="career-title">
                        <h3>{{ $fetch_career_page_details->title_one }}</h3>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="career-text">
                        {!! $fetch_career_page_details->description !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="careers-wrap-one" style="background-image:url('{{asset('public/assets/images/careers/'.$fetch_career_page_details->img_src)}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="career-title-one">
                        <h3>{{ $fetch_career_page_details->title_two }}<span>.</span></h3>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="careers-wrap-two">
        <div class="container">
            @php
                $list_job_posts	= DB::table('job_posts')
                                ->where('status','=','1')
                                ->get();

                $total_job_posts = count($list_job_posts);
            @endphp

            @foreach($list_job_posts AS $index => $list_job_posts_ind)
                <div class="row">
                    <div class="col-md-10">
                        <div class="job-title">
                            <h3>{{ $list_job_posts_ind->title }}</h3>
                            <p><i class="fa fa-map-marker"></i> <b>Location</b> - {{ $list_job_posts_ind->location }} | <i class="fa fa-money" aria-hidden="true"></i> <b>Salary</b> - {{ $list_job_posts_ind->salary }}</p>

                            {!! $list_job_posts_ind->description !!}
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="button-2">
                            <a data-toggle="modal" data-target="#career_form_popup" data-title="{{ $list_job_posts_ind->title }}" class="button apply-now">Apply Now <span><i class="fa fa-angle-right"></i></span></a>
                        </div>
                    </div>
                </div>
                
                @if($index < $total_job_posts - 1)
                    <hr>
                @endif
            @endforeach
        </div>
    </section>

    <div id="career_form_popup" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Please fill out the form.</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{route('send_job_enquiry')}}" method="POST" class="contact-us-form career-popup-form" enctype="multipart/form-data" id="job_enquiry_form">
                            @csrf

                            <input type="hidden" id="job_title" name="job_title">

                            <div class="col-md-12">
                                <input type="text" name="name" class="form-control" placeholder="Your Name*" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                            </div>
                            <div class="col-md-12">
                                <input type="email" name="email" class="form-control" placeholder="Email Address*" oninput="validate_email(this);" required>
                            </div>
                            <div class="col-md-12 mobile-wrapper">
                                <input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Mobile No.*" oninput="validate_mobile_number(this);" maxlength="20" required>
                                <small id="mobile_error" class="error-text"></small>
                            </div>
                            <div class="col-md-12">
                                <label>Upload Your CV:</label>
                                <input type="file" name="document_src" class="form-control" placeholder="Upload CV*" accept=".pdf" required>
                            </div>
                            <div class="col-md-12" id="otp-section" style="display: none;">
                                <input type="text" class="form-control" name="otp" placeholder="Enter OTP*" oninput="this.value = this.value.replace(/[^0-9]/g, '');"  minlength="6" maxlength="6">
                            </div>
                            <div class="col-md-12">
                                <textarea type="text" name="about" class="form-control" placeholder="About Yourself*" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="g-recaptcha mB20" data-sitekey="6LcIXyEqAAAAAHSFTtbyCvsgrhhk2fBSOfI6TvwZ"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="button-2">
                                    <button type="submit" class="button">Submit <span><i class="fa fa-angle-right"></i></span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- intl-tel-input library --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
    <script>
        /* ─── intl-tel-input setup (single instance for #mobile_no) ───────── */
        var itiInstances = {};

        (function () {
            var mobileEl = document.querySelector("#mobile_no");
            if (!mobileEl) return;

            itiInstances['mobile_no'] = window.intlTelInput(mobileEl, {
                // Auto-detect the visitor's country by IP; fall back to India
                initialCountry: "auto",
                geoIpLookup: function (callback) {
                    fetch("https://ipapi.co/json/")
                        .then(function (res) { return res.json(); })
                        .then(function (data) {
                            callback(data && data.country_code ? data.country_code : "in");
                        })
                        .catch(function () { callback("in"); });
                },
                // separateDialCode ON → shows the +91 / +1 / +44 dial code next to the flag
                separateDialCode: true,
                autoPlaceholder: "aggressive",
                preferredCountries: ["in", "us", "gb", "ae"],
                // Append dropdown to <body> so it isn't clipped inside the modal
                dropdownContainer: document.body,
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
            });
        })();

        /* Returns "+91 9087654321" style string for a given mobile input id */
        function build_mobile_with_code(inputId) {
            var inputEl = document.getElementById(inputId);
            var iti     = itiInstances[inputId];
            var raw     = inputEl ? inputEl.value.trim() : '';
            if (!iti || !raw) return raw;

            var dialCode = iti.getSelectedCountryData().dialCode;            // "1", "91", "44"…
            var e164     = (typeof iti.getNumber === 'function') ? iti.getNumber() : ''; // +19087654321

            var national;
            if (e164 && e164.indexOf('+' + dialCode) === 0) {
                national = e164.substring(dialCode.length + 1);
            } else {
                national = raw.replace(/[^0-9]/g, '');
                if (national.indexOf(dialCode) === 0) {
                    national = national.substring(dialCode.length);
                }
            }
            return '+' + dialCode + ' ' + national;
        }
    </script>

    <script>
        function validate_email(input) 
        {
            const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            
            const disallowedChars = /[~$?&*^%#+\/<>|\\{}[\]`!;:"']/;
            
            if(!regex.test(input.value.trim()) || disallowedChars.test(input.value) || input.value.includes('@@')) 
            {
                input.setCustomValidity('Please enter a valid email address');
            } 
            else 
            {
                input.setCustomValidity('');
            }
        }

        function validate_mobile_number(input) 
        {
            // Allow +, digits and spaces so typing "+1 ..." can auto-detect the country
            var value = input.value.replace(/[^0-9+\s]/g, '');
            if (value !== input.value) { input.value = value; }

            var errorEl    = document.getElementById('mobile_error');
            var digitCount = value.replace(/[^0-9]/g, '').length;

            if (digitCount === 0) {
                errorEl.innerText = '';
                input.setCustomValidity('');
                input.classList.remove('invalid');
                return;
            }

            // Validate against the selected/detected country via intl-tel-input
            var iti = itiInstances['mobile_no'];
            if (iti && typeof iti.isValidNumber === 'function') {
                if (iti.isValidNumber()) {
                    errorEl.innerText = '';
                    input.setCustomValidity('');
                    input.classList.remove('invalid');
                } else {
                    errorEl.innerText = 'Enter a valid mobile number';
                    input.setCustomValidity('Invalid');
                    input.classList.add('invalid');
                }
            }
        }
    </script>

    <script>
        $(document).ready(function(){
            $('.apply-now').click(function(){
                var title = $(this).data('title');
                $('#job_title').val(title);
            });
        });
    </script>

    <script>
        
        function get_validated_emails() 
        {
            return JSON.parse(localStorage.getItem('validated_emails')) || [];
        }
    
        function store_validated_email(email) 
        {
            let validated_emails = get_validated_emails();
            
            if(!validated_emails.includes(email)) 
            {
                validated_emails.push(email);
                localStorage.setItem('validated_emails', JSON.stringify(validated_emails));
            }
        }
    
        function is_email_validated(email) 
        {
            let validated_emails = get_validated_emails();
            
            return validated_emails.includes(email);
        }
        
        document.getElementById('job_enquiry_form').addEventListener('submit', function(e) {
            e.preventDefault();
            var form = document.getElementById('job_enquiry_form');
            var formData = new FormData(form);
            var submit_button = form.querySelector('button[type="submit"]');
            var fileInput = document.querySelector('input[name="document_src"]');
            var file = fileInput.files[0];
            var email = formData.get('email');

            // ✅ Store mobile number as "+91 9087654321"
            formData.set('mobile_no', build_mobile_with_code('mobile_no'));

            // ✅ Validate mobile number via the library before anything else
            var iti = itiInstances['mobile_no'];
            if (iti && typeof iti.isValidNumber === 'function' && !iti.isValidNumber()) {
                alert('Please enter a valid mobile number.');
                document.getElementById('mobile_error').innerText = 'Enter a valid mobile number';
                document.getElementById('mobile_no').classList.add('invalid');
                return;
            }
        
            // Check file size (limit to 1MB)
            if(file.size > 1024 * 1024) 
            {
                alert('Please upload PDF file up to 1MB.');
                return;
            }
        
            // Check if the selected file is not a PDF
            if(file.type !== 'application/pdf') 
            {
                alert('Please upload only PDF file.');
                return;
            }

            function show_loader() 
            {
                submit_button.disabled = true;
                submit_button.innerHTML = 'Processing <span class="loader"></span>';
            }

            function hide_loader() 
            {
                submit_button.disabled = false;
                submit_button.innerHTML = 'Submit <span><i class="fa fa-angle-right"></i></span>';
            }
            
            show_loader();
            
            var recaptchaResponse = grecaptcha.getResponse();
            if(recaptchaResponse.length == 0) 
            {
                alert('Please verify that you are not a robot.');
                hide_loader();
            }
            
            if(is_email_validated(email)) 
            {
                formData.delete('otp');
                process_form_submission(form.action, formData, hide_loader);
            } 
            else if(document.getElementById('otp-section').style.display === 'none')
            {
                //  Send OTP
                fetch('{{ route("send_otp") }}', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    hide_loader();

                    if(data.success) 
                    {
                        document.getElementById('otp-section').style.display = 'block';
                        alert('OTP sent to your email');
                    } 
                    else 
                    {
                        alert('Failed to send OTP');
                    }
                });
            } 
            else 
            {
                process_form_submission(form.action, formData, hide_loader);
            }
        });
        
        function process_form_submission(url, formData, hide_loader) 
        {
            fetch(url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) 
                {
                    store_validated_email(formData.get('email'));
                    
                    setTimeout(function() {
                        hide_loader();

                        window.location.href = "{{ route('thank_you') }}";
                    }, 1000);
                } 
                else 
                {
                    alert('Invalid OTP');
                    hide_loader();
                }
            });
        }
    </script>

    <style>
        .loader 
        {
            border: 4px solid #f3f3f3;
            border-radius: 50%;
            border-top: 4px solid #3498db;
            width: 20px;
            height: 20px;
            animation: spin 2s linear infinite;
            display: inline-block;
            margin-left: 5px;
        }

        @keyframes spin 
        {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
@endsection