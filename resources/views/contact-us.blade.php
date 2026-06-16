@extends('layouts.app')

@section('meta_title', 'Contact HENI Chemicals | Global Exporter from India')
@section('meta_description', 'Reach out to our sales, technical, or export team. Based in Thane (Mumbai) with manufacturing in Sarigam, Gujarat.')

@section('content')
    @php
        $fetch_basic_details 	= DB::table('basic_details')
                                ->where('id','=','1')
                                ->first();
    @endphp

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">

    <style>.mobile-wrapper {
    position: relative;
    margin-bottom: 20px;
}

.error-text {
    color: red;
    font-size: 12px;
    display: block;
    margin-top: 5px;
    min-height: 16px; /* keeps space fixed even when empty */
}

/* makes the flag dropdown fill the bootstrap column nicely */
.iti { width: 100%; }
</style>
    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/about-banner.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
            <h1>Contact Us – We're Here to Help</h1>
                        <ul>
                            <li><a href="{{route('/')}}">Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-one-wrap">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="contact-one__content wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
                        <ul class="list-unstyled contact-one__info">
                            <li class="contact-one__info__item">
                                <div class="contact-one__info__icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-one__info__content">
                                    <p class="contact-one__info__text">Head Office & R&D</p>
                                    {{-- <p class="contact-one__info__title">Plot A-161, Wagle Industrial Estate,<br>Thane (Mumbai), 400 604<br>India.</p> --}}
                                    {!! $fetch_basic_details->head_office_address !!}
                                </div>
                            </li>
                            <li class="contact-one__info__item">
                                <div class="contact-one__info__icon">
                                    <i class="fa fa-map-marker"></i>
                                </div>
                                <div class="contact-one__info__content">
                                    <p class="contact-one__info__text">Site Location</p>
                                    {!! $fetch_basic_details->site_location !!}
                                </div>
                            </li>
                            <li class="contact-one__info__item">
                                <div class="contact-one__info__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="contact-one__info__content">
                                    <p class="contact-one__info__text">Have any question?</p>
                                    <p class="contact-one__info__title"><a href="tel:91{{ $fetch_basic_details->mobile_no }}">+91 {{ $fetch_basic_details->mobile_no }}</a></p>
                                </div>
                            </li>
                            <li class="contact-one__info__item">
                                <div class="contact-one__info__icon">
                                    <i class="fa fa-envelope"></i>
                                </div>
                                <div class="contact-one__info__content">
                                    <p class="contact-one__info__text">Send email</p>
                                    <p class="contact-one__info__title"><a href="mailto:{{ $fetch_basic_details->email }}">{{ $fetch_basic_details->email }}</a></p>
                                </div>
                            </li>
                        </ul>

                        <div class="contact-one__content__thumb">
                            <img src="{{asset('public/frontend/img/contact/contact-img.jpg')}}" alt="laboix">
                        </div>
                        <div class="contact-one__content__social">
                            <a href="{{ $fetch_basic_details->linkedin_link }}"> <i class="fa fa-linkedin" aria-hidden="true"></i> <span class="sr-only">Linkedin</span></a>
                            <!--<a href="{{ $fetch_basic_details->facebook_link }}"> <i class="fa fa-facebook-f" aria-hidden="true"></i> <span class="sr-only">Facebook</span> </a>
                            <a href="{{ $fetch_basic_details->instagram_link }}"> <i class="fa fa-instagram" aria-hidden="true"></i> <span class="sr-only">Instagram</span> </a>
                            <a href="{{ $fetch_basic_details->youtube_link }}"> <i class="fa fa-youtube" aria-hidden="true"></i> <span class="sr-only">Youtube</span> </a>-->
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="page-title" data-aos="flip-left">
                                <h2>Feel free to write us anytime</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <form action="{{route('send_contact_us_enquiry')}}" method="POST" class="contact-us-form wow fadeInRight animated" id="contact_us_form" data-wow-delay="700ms" data-wow-duration="700ms">
                            @csrf
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Your Name*" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                            </div>
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Address*" oninput="validate_email(this);" required>
                            </div>
                          <div class="col-md-6">
    <input 
        type="text" 
        class="form-control" 
        name="mobile_no" 
        id="mobile_no"
        placeholder="Mobile No.*"
        oninput="validateMobile(this)" 
        minlength="10"
        maxlength="15"
        required
    >
    <small id="mobile_error" class="error-text"></small>
</div>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="subject" placeholder="Subject*" required>
                            </div>
                           <div class="col-md-6" id="otp-section" style="display: none;">
                            <input type="text"
                                   class="form-control"
                                   name="otp"
                                   id="otp_input"
                                   placeholder="Enter OTP*"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');"
                                   minlength="6"
                                   maxlength="6">
                            </div>

                            <div class="col-md-12">
                                <textarea type="text" class="form-control" name="user_message" placeholder="Write a message*" required></textarea>
                            </div>
                            <div class="col-md-12">
                                <div class="g-recaptcha mB20" data-sitekey="6LcIXyEqAAAAAHSFTtbyCvsgrhhk2fBSOfI6TvwZ"></div>
                            </div>
                            <div class="col-md-12">
                                <div class="button-2">
                                    <button type="submit" class="button">Send Message <span><i class="fa fa-angle-right"></i></span></button>
                                </div>
                            </div>
                        </form>

<!-- intl-tel-input library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/intlTelInput.min.js"></script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    console.log("STEP 0: DOM ready, starting intl-tel-input setup");

    console.log("STEP 1: intl-tel-input script loaded?", typeof window.intlTelInput); // should print "function"

    var mobileInputEl = document.querySelector("#mobile_no");
    console.log("STEP 2: mobile input found?", mobileInputEl); // should print the <input> element, NOT null

    if (!mobileInputEl) {
        console.error("STEP 2-FAILED: #mobile_no not found in DOM, stopping.");
        return;
    }

    var iti = window.intlTelInput(mobileInputEl, {
        initialCountry: "auto",   // ✅ auto-detect country from user's IP
        geoIpLookup: function (callback) {
            console.log("STEP 3: geoIpLookup started, calling ipapi.co...");

            fetch("https://ipapi.co/json/")
                .then(res => {
                    console.log("STEP 4: ipapi.co responded, status =", res.status); // should be 200
                    return res.json();
                })
                .then(data => {
                    console.log("STEP 5: ipapi.co data =", data);
                    console.log("STEP 6: country_code =", data.country_code); // e.g. "DE", "US", "IN"
                    callback(data.country_code);
                    console.log("STEP 7: callback done, flag should now update");
                })
                .catch(err => {
                    console.error("STEP 4-FAILED: ipapi.co request failed →", err);
                    console.log("Falling back to India flag");
                    callback("in"); // fallback so flag is never blank
                });
        },
        separateDialCode: true,   // shows +49 / +1 / +91 next to the flag
        utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/js/utils.js"
    });

    console.log("STEP 8: intlTelInput initialized, iti =", iti);
    window.iti = iti; // accessible to validateMobile() and form submit

    setTimeout(function () {
        console.log("STEP 9 (after 3s): selected country =", iti.getSelectedCountryData());
    }, 3000);


    // ================= FORM SUBMIT (inside DOM ready so iti is guaranteed) =================

    document.getElementById('contact_us_form').addEventListener('submit', function (e) {
        e.preventDefault();

        var form = document.getElementById('contact_us_form');
        var formData = new FormData(form);

        // ✅ Build "+49 1701234567" / "+91 9087654321" style value using the
        // auto-detected (or manually selected) country code
        var dialCode = iti.getSelectedCountryData().dialCode;          // e.g. "91", "1", "49"
        var nationalNumber = document.getElementById('mobile_no').value.trim();
        formData.set('mobile_no', "+" + dialCode + " " + nationalNumber);

        var submit_button = form.querySelector('button[type="submit"]');
        var email = formData.get('email');
        var otpSection = document.getElementById('otp-section');
        var otpInput = document.getElementById('otp_input');

        function show_loader() {
            submit_button.disabled = true;
            submit_button.innerHTML = 'Processing <span class="loader"></span>';
        }

        function hide_loader() {
            submit_button.disabled = false;
            submit_button.innerHTML = 'Send Message <span><i class="fa fa-angle-right"></i></span>';
        }

        show_loader();

        // ✅ Validate mobile number via the library before doing anything
        if (window.iti && typeof iti.isValidNumber === 'function' && !iti.isValidNumber()) {
            alert('Please enter a valid mobile number');
            document.getElementById('mobile_error').innerText = "Enter a valid mobile number";
            hide_loader();
            return;
        }

        // ✅ reCAPTCHA check
        var recaptchaResponse = grecaptcha.getResponse();
        if (recaptchaResponse.length === 0) {
            alert('Please verify that you are not a robot.');
            hide_loader();
            return;
        }

        // ✅ If email already validated → submit directly
        if (is_email_validated(email)) {
            otpInput.removeAttribute('required');
            formData.delete('otp');
            process_form_submission(form.action, formData, hide_loader);
            return;
        }

        // ✅ If OTP not sent yet → send OTP
        if (otpSection.style.display === 'none') {
            let emailForm = new FormData();
            emailForm.append("email", email);
            emailForm.append("_token", "{{ csrf_token() }}");

            fetch('{{ route("send_otp") }}', {
                method: 'POST',
                body: emailForm
            })
            .then(response => response.json())
            .then(data => {
                hide_loader();

                if (data.success) {
                    otpSection.style.display = 'block';

                    // ✅ Make OTP required only now
                    otpInput.setAttribute('required', 'required');

                    alert('OTP sent to your email');
                } else {
                    alert(data.error || 'Failed to send OTP');
                }
            })
            .catch(err => {
                hide_loader();
                alert("Something went wrong: " + err.message);
            });

            return;
        }

        // ✅ OTP validation before final submit
        if (!otpInput.value || otpInput.value.length !== 6) {
            alert('Please enter a valid 6-digit OTP');
            hide_loader();
            return;
        }

        // ✅ Final submission with OTP
        process_form_submission(form.action, formData, hide_loader);
    });

}); // ===== end DOMContentLoaded =====


// ================= HELPER FUNCTIONS (global, used by form + validateMobile) =================

function get_validated_emails() {
    return JSON.parse(localStorage.getItem('validated_emails')) || [];
}

function store_validated_email(email) {
    let validated_emails = get_validated_emails();
    if (!validated_emails.includes(email)) {
        validated_emails.push(email);
        localStorage.setItem('validated_emails', JSON.stringify(validated_emails));
    }
}

function is_email_validated(email) {
    let validated_emails = get_validated_emails();
    return validated_emails.includes(email);
}

function process_form_submission(url, formData, hide_loader) {
    fetch(url, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            store_validated_email(formData.get('email'));

            setTimeout(function () {
                hide_loader();
                window.location.href = "{{ route('thank_you') }}";
            }, 1000);
        } else {
            alert(data.message || 'Invalid OTP');
            hide_loader();
        }
    })
    .catch(err => {
        hide_loader();
        alert("Something went wrong: " + err.message);
    });
}

function validateMobile(input) {
    // keep only digits, max 15
    let value = input.value.replace(/[^0-9]/g, '').substring(0, 15);
    input.value = value;

    let errorEl = document.getElementById('mobile_error');

    if (value.length === 0) {
        errorEl.innerText = "";
        input.setCustomValidity("");
        return;
    }

    // utils.js may still be loading on the very first keystrokes
    if (window.iti && typeof window.iti.isValidNumber === 'function') {
        if (window.iti.isValidNumber()) {
            errorEl.innerText = "";
            input.setCustomValidity("");
        } else {
            errorEl.innerText = "Enter a valid mobile number";
            input.setCustomValidity("Invalid");
        }
    }
}
</script>


          </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-map-wrap">
        <div class="container">
            <div class="row">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="google_map">
                        <h3>Head Office & R&D</h3>
                        <iframe src="{{ $fetch_basic_details->head_office_address_iframe_link }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-6 col-xs-6">
                    <div class="google_map">
                        <h3>Site Location</h3>
                        <iframe src="{{ $fetch_basic_details->site_location_iframe_link }}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
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