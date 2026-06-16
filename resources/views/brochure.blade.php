@extends('layouts.app')

@section('meta_title', 'HENI Chemicals Product Brochure | Download PDF')
@section('meta_description', 'Explore our complete product catalog covering APIs, esters, nutraceuticals, cosmetic ingredients & industrial chemicals.')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/18.2.1/css/intlTelInput.css">
<style>.mobile-wrapper {
    margin-bottom: 20px;
}

.error-text {
    color: red;
    font-size: 12px;
    margin-top: 5px;
    display: block;
    min-height: 16px;
}

input.invalid {
    border: 1px solid red;
}

/* intl-tel-input — make the flag input fill the column */
.iti { width: 100%; }
/* Keep the country dropdown above the Bootstrap modal (modal z-index ~1050) */
.iti__country-list { z-index: 1100; }</style>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <section class="breadcrum-banner" style="background-image:url('{{asset('public/frontend/img/banner/about-banner.jpg')}}');">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrum-content">
            <h1>Download Our Product Brochure</h1>
                        <ul>
                            <li><a href="{{route('/')}}">Home</a></li>
                            <li>Brochure</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="download-bro-area">
        <div class="container">
            <div class="row">
                @php
                    $list_brochures = DB::table('brochures')
                                    ->where('status','=','1')
                                    ->orderBy('created_at', 'desc')
                                    ->get();
                @endphp

                @foreach ($list_brochures AS $list_brochures_ind)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-6 col-xs-6" style="margin-top: 20px;">
                        <div class="pbmit-ihbox-style-7 brocure_box wow fadeInLeft animated" data-wow-delay="700ms" data-wow-duration="700ms">
                            <div class="brocure_ihbox_box" style="background-image:url('{{asset('public/assets/images/brochures/'.$list_brochures_ind->img_src)}}');background-size: cover;">
                                <div class="pbmit-icon-wrapper">
                                    <h2 class="pbmit-element-title">{{ $list_brochures_ind->title }}</h2>
                                    <div class="pbmit-ihbox-icon">
                                        <div class="pbmit-ihbox-icon-wrapper">
                                            <div class="pbmit-icon-wrapper pbmit-icon-type-icon">
                                                <a href="#" data-toggle="modal" data-target="#brochure_modal" title="Download PDF" onclick="set_brochure_id('{{ $list_brochures_ind->id }}')"><i class="fa fa-file-pdf-o"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="modal brochure_popup fade" id="brochure_modal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Download Brochure</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <form action="{{route('send_brochure_enquiry')}}" method="POST" class="contact-us-form" id="brochure_form">
                            @csrf
                            <input type="hidden" name="brochure_id" id="brochure_id" value="">
                            <!--<div class="col-md-6">
                                <input type="text" class="form-control" name="name" placeholder="Your Name*" oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '')" required>
                            </div>-->
                            <div class="col-md-6">
                                <input type="email" class="form-control" name="email" placeholder="Email Address*" oninput="validate_email(this);" required>
                            </div>
                           <div class="col-md-6 mobile-wrapper">
    <input 
        type="text" 
        class="form-control" 
        name="mobile_no" 
        id="mobile_no"
        placeholder="Mobile No.*" 
        oninput="validate_mobile_number(this);" 
        maxlength="20" 
        required
    >
    <small id="mobile_error" class="error-text"></small>
</div>
                            <!--<div class="col-md-6">
                                <input type="text" class="form-control" name="company_name" placeholder="Company Name*" required>
                            </div>
                            <div class="col-md-12">
                                <input type="text" class="form-control" name="subject" placeholder="Subject*" required>
                            </div>-->
                            <div class="col-md-12" id="otp-section" style="display: none;">
        <input type="text" class="form-control" name="otp" id="otp_input" placeholder="Enter OTP*" minlength="6" maxlength="6" oninput="this.value = this.value.replace(/[^0-9]/g, '');">

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
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> -->
            </div>
        </div>
    </div>
    
   <script src="https://www.google.com/recaptcha/api.js" async defer></script>

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
/* ─── Validators ─────────────────────────────────────────── */
function validate_email(input) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    const bad   = /[~$?&*^%#+\/<>|\\{}[\]`!;:"']/;
    const ok    = regex.test(input.value.trim()) &&
                  !bad.test(input.value) &&
                  !input.value.includes('@@');
    input.setCustomValidity(ok ? '' : 'Please enter a valid email address');
    toggleError(input, ok ? '' : 'Enter a valid email address');
}

function validate_mobile_number(input) {
    // Allow +, digits and spaces so typing "+1 ..." can auto-detect the country
    var value = input.value.replace(/[^0-9+\s]/g, '');
    if (value !== input.value) { input.value = value; }

    const errorEl    = document.getElementById('mobile_error');
    const digitCount = value.replace(/[^0-9]/g, '').length;

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

function toggleError(input, msg) {
    let err = input.parentElement.querySelector('.field-error');
    if (!err) {
        err = document.createElement('small');
        err.className = 'error-text field-error';
        input.parentElement.appendChild(err);
    }
    err.innerText = msg;
    input.classList.toggle('invalid', !!msg);
}

/* ─── Set brochure ID from card click ────────────────────── */
function set_brochure_id(id) {
    document.getElementById('brochure_id').value = id;
    /* reset form state each time modal opens */
    document.getElementById('otp-section').style.display = 'none';
    document.getElementById('otp_input').value = '';
    document.getElementById('brochure_form').reset();
    document.getElementById('brochure_id').value = id; // re-set after reset()
    if (typeof grecaptcha !== 'undefined') grecaptcha.reset();
}

/* ─── Form submission ────────────────────────────────────── */
document.getElementById('brochure_form').addEventListener('submit', function (e) {
    e.preventDefault();

    const form       = this;
    const submitBtn  = form.querySelector('button[type="submit"]');
    const otpSection = document.getElementById('otp-section');
    const emailInput = form.querySelector('[name="email"]');
    const mobileInput= document.getElementById('mobile_no');

    /* --- Trigger inline validators --- */
    validate_email(emailInput);
    validate_mobile_number(mobileInput);

    /* --- Validate mobile via the library before anything else --- */
    const iti = itiInstances['mobile_no'];
    if (iti && typeof iti.isValidNumber === 'function' && !iti.isValidNumber()) {
        document.getElementById('mobile_error').innerText = 'Enter a valid mobile number';
        mobileInput.classList.add('invalid');
        return;
    }

    /* --- Block if any other field is invalid --- */
    if (!form.checkValidity()) {
        form.reportValidity();
        return;
    }

    /* --- reCAPTCHA check --- */
    if (grecaptcha.getResponse().length === 0) {
        alert('Please verify that you are not a robot.');
        return;
    }

    function showLoader() {
        submitBtn.disabled = true;
        submitBtn.innerHTML = 'Processing… <span class="loader"></span>';
    }
    function hideLoader() {
        submitBtn.disabled = false;
        submitBtn.innerHTML = 'Submit <span><i class="fa fa-angle-right"></i></span>';
    }

    showLoader();
    const formData = new FormData(form);

    /* ✅ Store mobile number as "+91 9087654321" for both OTP + final submit */
    formData.set('mobile_no', build_mobile_with_code('mobile_no'));

    /* ══════════════════════════════════════
       STEP 1 — Send OTP (first submission)
    ══════════════════════════════════════ */
    if (otpSection.style.display === 'none') {
        fetch('{{ route("send_otp") }}', {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(data => {
            hideLoader();
            if (data.success) {
                otpSection.style.display = 'block';
                document.getElementById('otp_input').required = true;
                /* Give user a clear cue */
                submitBtn.innerHTML = 'Verify OTP & Download <span><i class="fa fa-angle-right"></i></span>';
                alert('OTP sent to ' + formData.get('email'));
            } else {
                alert(data.message || 'Failed to send OTP. Please try again.');
            }
        })
        .catch(() => { hideLoader(); alert('Something went wrong. Please try again.'); });

        return; // stop here
    }

    /* ══════════════════════════════════════
       STEP 2 — Verify OTP & download PDF
    ══════════════════════════════════════ */
    const otpVal = document.getElementById('otp_input').value.trim();
    if (otpVal.length < 6) {
        hideLoader();
        alert('Please enter the 6-digit OTP sent to your email.');
        return;
    }

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(r => r.json())
    .then(data => {
        hideLoader();

        if (data.success) {
            /* ── Trigger download with proper filename ── */
            const link       = document.createElement('a');
            link.href        = data.download_url;
            link.download    = data.file_name;   // ← real filename from server
            link.style.display = 'none';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);

            /* ── Dismiss modal, then redirect to Thank You ── */
            $('#brochure_modal').modal('hide');
            setTimeout(() => {
                window.location.href = data.redirect_url;
            }, 800);
        } else {
            alert(data.message || 'Invalid OTP. Please try again.');
        }
    })
    .catch(() => { hideLoader(); alert('Something went wrong. Please try again.'); });
});
</script>

<style>
.loader {
    border: 3px solid #f3f3f3;
    border-radius: 50%;
    border-top: 3px solid #3498db;
    width: 18px;
    height: 18px;
    animation: spin 0.9s linear infinite;
    display: inline-block;
    vertical-align: middle;
    margin-left: 6px;
}
@keyframes spin { to { transform: rotate(360deg); } }
.error-text { color: red; font-size: 12px; margin-top: 4px; display: block; min-height: 16px; }
input.invalid { border: 1px solid red !important; }
.mobile-wrapper { margin-bottom: 20px; }
</style>

@endsection