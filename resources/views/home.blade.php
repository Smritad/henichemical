@extends('layouts.admin-header')

@section('content')

<style>
/* ── Lead cards ────────────────────────────────── */
.lcard { border-radius: 12px; overflow: hidden; border: 1px solid rgba(0,0,0,.08); background: #fff; margin-bottom: 20px; transition: box-shadow .15s, transform .15s; text-decoration: none !important; display: block; }
.lcard:hover { box-shadow: 0 6px 20px rgba(0,0,0,.12); transform: translateY(-2px); text-decoration: none !important; }
.lcard-bg { padding: 20px 18px 16px; display: flex; flex-direction: column; gap: 14px; }
.lcard-head { display: flex; align-items: center; gap: 12px; }
.lcard-icon { width: 42px; height: 42px; border-radius: 50%; background: rgba(255,255,255,.25); display: flex; align-items: center; justify-content: center; color: #fff; font-size: 17px; flex-shrink: 0; }
.lcard-title { font-size: 20px; font-weight: 700; color: #fff; line-height: 1.35; text-shadow: 0 1px 2px rgba(0,0,0,.15); }
.lcard-spark { width: 100%; height: 36px; }
.lcard-body { background: #fff; padding: 14px 18px; display: flex; align-items: center; justify-content: space-between; border-top: 1px solid rgba(0,0,0,.06); }
.lcard-num { font-size: 34px; font-weight: 700; color: #2d2d2d; line-height: 1; }
.lcard-link-hint { font-size: 11px; color: #aaa; display: flex; align-items: center; gap: 4px; }
.lcard:hover .lcard-link-hint { color: #555; }

/* ── Section label ─────────────────────────────── */
.dash-section-label { display: flex; align-items: center; gap: 10px; margin: 0 15px 14px; }
.dash-section-label span { font-size: 20px; font-weight: 600; letter-spacing: .08em; text-transform: uppercase; color: black; white-space: nowrap; }
.dash-section-label::after { content: ''; flex: 1; height: 1px; background: #e5e5e5; }

/* ── Base card ─────────────────────────────────── */
.dash-card { background: #fff; border: 1px solid #eeeeee; border-radius: 10px; padding: 16px 18px 14px; margin-bottom: 20px; border-top: 3px solid #ddd; transition: box-shadow .15s; }
.dash-card:hover { box-shadow: 0 2px 12px rgba(0,0,0,.07); }
.dash-card-top { display: flex; align-items: flex-start; justify-content: space-between; margin-bottom: 10px; }
.dash-spark { width: 80px; height: 32px; }
.dash-num { font-size: 28px; font-weight: 700; line-height: 1; color: #333; margin-bottom: 4px; }
.dash-label { font-size: 13px; color: #777; font-weight: 500; }
.dash-footer { font-size: 11px; color: #bbb; margin-top: 8px; padding-top: 8px; border-top: 1px solid #f0f0f0; }
.dash-icon { width: 36px; height: 36px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 15px; }
.dash-icon-red    { background:#FFEBEE; color:#C62828; }
.dash-icon-blue   { background:#E3F2FD; color:#1565C0; }
.dash-icon-green  { background:#E8F5E9; color:#2E7D32; }
.dash-icon-orange { background:#FFF3E0; color:#E65100; }
.dash-card:has(.dash-icon-red)    { border-top-color: #ef5350; }
.dash-card:has(.dash-icon-blue)   { border-top-color: #1e88e5; }
.dash-card:has(.dash-icon-green)  { border-top-color: #43a047; }
.dash-card:has(.dash-icon-orange) { border-top-color: #fb8c00; }
</style>

@php
    $roleId      = Auth::check() ? Auth::user()->role_id : null;
    $isAdmin     = $roleId == 1;
    $isHR        = $roleId == 3;
    $isSales     = $roleId == 4;
    $isTechnical = $roleId == 5;

    // Site overview: Admin + Technical (Technical sees all records except enquiries)
    $showSiteOverview = $isAdmin || $isTechnical;

    // Enquiries: Technical gets NONE
    $showContactEnquiry  = $isAdmin || $isSales;
    $showProductDocEnq   = $isAdmin || $isSales;
    $showProductEnquiry  = $isAdmin || $isSales;
    $showBrochureEnquiry = $isAdmin || $isSales;
    $showJobEnquiry      = $isAdmin || $isHR;
    $showAnyEnquiryCard  = $showContactEnquiry || $showProductDocEnq
                        || $showProductEnquiry || $showBrochureEnquiry
                        || $showJobEnquiry;

    // Counts — only query what we'll display
    $cnt_product_enq  = $showProductEnquiry  ? DB::table('product_enquiry')->count() : 0;
    $cnt_doc_enq      = $showProductDocEnq   ? DB::table('product_document_enquiry')->count() : 0;
    $cnt_contact_enq  = $showContactEnquiry  ? DB::table('contact_us_enquiry')->count() : 0;
    $cnt_brochure_enq = $showBrochureEnquiry ? DB::table('brochure_enquiry')->count() : 0;
    $cnt_job_enq      = $showJobEnquiry      ? DB::table('job_enquiry')->count() : 0;

    $cnt_total_enq = $cnt_product_enq + $cnt_doc_enq + $cnt_contact_enq + $cnt_brochure_enq;
    $showTotalCard = $showContactEnquiry || $showProductDocEnq
                  || $showProductEnquiry || $showBrochureEnquiry;
@endphp

<div id="wrapper">
    <div class="main-content">

        {{-- ═══ SECTION 1 — Site Overview (Admin only) ═══ --}}
        @if($showSiteOverview)
            <div class="dash-section-label"><span>Site overview</span></div>

            <div class="row small-spacing" style="margin-bottom: 10px;">
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <div class="dash-card">
                        <div class="dash-card-top">
                            <div class="dash-icon dash-icon-red"><i class="fa fa-desktop"></i></div>
                            <div class="dash-spark" id="spark-banners"></div>
                        </div>
                        @php $cnt_banners = DB::table('banners')->where('status', 1)->count(); @endphp
                        <div class="dash-num">{{ $cnt_banners }}</div>
                        <div class="dash-label">Total banners</div>
                        <div class="dash-footer">Active only</div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <div class="dash-card">
                        <div class="dash-card-top">
                            <div class="dash-icon dash-icon-blue"><i class="fa fa-cubes"></i></div>
                            <div class="dash-spark" id="spark-products"></div>
                        </div>
                        @php $cnt_products = DB::table('products')->where('status', 1)->count(); @endphp
                        <div class="dash-num">{{ $cnt_products }}</div>
                        <div class="dash-label">Total products</div>
                        <div class="dash-footer">Active only</div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <div class="dash-card">
                        <div class="dash-card-top">
                            <div class="dash-icon dash-icon-green"><i class="fa fa-calendar"></i></div>
                            <div class="dash-spark" id="spark-events"></div>
                        </div>
                        @php $cnt_events = DB::table('events')->where('status', 1)->count(); @endphp
                        <div class="dash-num">{{ $cnt_events }}</div>
                        <div class="dash-label">Total events</div>
                        <div class="dash-footer">Active only</div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <div class="dash-card">
                        <div class="dash-card-top">
                            <div class="dash-icon dash-icon-orange"><i class="fa fa-file-pdf-o"></i></div>
                            <div class="dash-spark" id="spark-brochures"></div>
                        </div>
                        @php $cnt_brochures = DB::table('brochures')->where('status', 1)->count(); @endphp
                        <div class="dash-num">{{ $cnt_brochures }}</div>
                        <div class="dash-label">Total brochures</div>
                        <div class="dash-footer">Active only</div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ═══ SECTION 2 — Leads & Enquiries (filtered per role) ═══ --}}
        @if($showAnyEnquiryCard)
            <div class="dash-section-label" style="margin-top: 28px;">
                <span>Leads &amp; Enquiries</span>
            </div>

            <div class="row small-spacing">

                @if($showTotalCard)
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <div class="lcard" style="cursor: default;">
                        <div class="lcard-bg" style="background: linear-gradient(135deg, #546e7a, #90a4ae);">
                            <div class="lcard-head">
                                <div class="lcard-icon"><i class="fa fa-inbox"></i></div>
                                <span class="lcard-title">Total<br>Enquiries</span>
                            </div>
                            <div class="lcard-spark" id="spark-total-enq"></div>
                        </div>
                        <div class="lcard-body">
                            <div class="lcard-num">{{ $cnt_total_enq }}</div>
                            <i class="fa fa-bar-chart" style="color:#546e7a; font-size:18px;"></i>
                        </div>
                    </div>
                </div>
                @endif

                @if($showProductEnquiry)
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <a href="{{ route('admin.list_product_enquiry') }}" class="lcard">
                        <div class="lcard-bg" style="background: linear-gradient(135deg, #fb8c00, #f4511e);">
                            <div class="lcard-head">
                                <div class="lcard-icon"><i class="fa fa-comments"></i></div>
                                <span class="lcard-title">Product<br>Enquiries</span>
                            </div>
                            <div class="lcard-spark" id="spark-product-enq"></div>
                        </div>
                        <div class="lcard-body">
                            <div class="lcard-num">{{ $cnt_product_enq }}</div>
                            <span class="lcard-link-hint">View all <i class="fa fa-arrow-right" style="font-size:11px;"></i></span>
                        </div>
                    </a>
                </div>
                @endif

                @if($showProductDocEnq)
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <a href="{{ route('admin.list_product_document_enquiry') }}" class="lcard">
                        <div class="lcard-bg" style="background: linear-gradient(135deg, #00897b, #00acc1);">
                            <div class="lcard-head">
                                <div class="lcard-icon"><i class="fa fa-file-text-o"></i></div>
                                <span class="lcard-title">Document<br>Enquiries</span>
                            </div>
                            <div class="lcard-spark" id="spark-doc-enq"></div>
                        </div>
                        <div class="lcard-body">
                            <div class="lcard-num">{{ $cnt_doc_enq }}</div>
                            <span class="lcard-link-hint">View all <i class="fa fa-arrow-right" style="font-size:11px;"></i></span>
                        </div>
                    </a>
                </div>
                @endif

                @if($showContactEnquiry)
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <a href="{{ route('admin.list_contact_us_enquiry') }}" class="lcard">
                        <div class="lcard-bg" style="background: linear-gradient(135deg, #388e3c, #66bb6a);">
                            <div class="lcard-head">
                                <div class="lcard-icon"><i class="fa fa-phone"></i></div>
                                <span class="lcard-title">Contact<br>Enquiries</span>
                            </div>
                            <div class="lcard-spark" id="spark-contact-enq"></div>
                        </div>
                        <div class="lcard-body">
                            <div class="lcard-num">{{ $cnt_contact_enq }}</div>
                            <span class="lcard-link-hint">View all <i class="fa fa-arrow-right" style="font-size:11px;"></i></span>
                        </div>
                    </a>
                </div>
                @endif

                @if($showBrochureEnquiry)
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <a href="{{ route('admin.list_brochure_enquiry') }}" class="lcard">
                        <div class="lcard-bg" style="background: linear-gradient(135deg, #f9a825, #ffca28);">
                            <div class="lcard-head">
                                <div class="lcard-icon"><i class="fa fa-download"></i></div>
                                <span class="lcard-title">Brochure<br>Enquiries</span>
                            </div>
                            <div class="lcard-spark" id="spark-brochure-enq"></div>
                        </div>
                        <div class="lcard-body">
                            <div class="lcard-num">{{ $cnt_brochure_enq }}</div>
                            <span class="lcard-link-hint">View all <i class="fa fa-arrow-right" style="font-size:11px;"></i></span>
                        </div>
                    </a>
                </div>
                @endif

                @if($showJobEnquiry)
                <div class="col-sm-6 col-lg-3 col-xs-12">
                    <a href="{{ route('admin.list_job_enquiry') }}" class="lcard">
                        <div class="lcard-bg" style="background: linear-gradient(135deg, #3949ab, #7c4dff);">
                            <div class="lcard-head">
                                <div class="lcard-icon"><i class="fa fa-user"></i></div>
                                <span class="lcard-title">Job<br>Enquiries</span>
                            </div>
                            <div class="lcard-spark" id="spark-job-enq"></div>
                        </div>
                        <div class="lcard-body">
                            <div class="lcard-num">{{ $cnt_job_enq }}</div>
                            <span class="lcard-link-hint">View all <i class="fa fa-arrow-right" style="font-size:11px;"></i></span>
                        </div>
                    </a>
                </div>
                @endif

            </div>
        @endif

    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-sparklines/2.1.2/jquery.sparkline.min.js"></script>
<script>
$(function () {
    function line(id) {
        if (!$(id).length) return;
        $(id).sparkline([5,6,7,9,9,5,3,2,2,4,6,7], {
            type: 'line', width: '100%', height: '36',
            lineColor: 'rgba(255,255,255,.8)', fillColor: 'rgba(255,255,255,.15)',
            spotColor: false, minSpotColor: false, maxSpotColor: false
        });
    }
    function lineSmall(id, color) {
        if (!$(id).length) return;
        $(id).sparkline([5,6,7,9,9,5,3,2,2,4,6,7], {
            type: 'line', width: '80', height: '32',
            lineColor: color, fillColor: false, spotColor: false
        });
    }
    function bar(id, color) {
        if (!$(id).length) return;
        $(id).sparkline([3,4,5,3,5,6,7], { type: 'bar', height: '32', barColor: color });
    }

    lineSmall('#spark-banners',   '#ef5350');
    lineSmall('#spark-products',  '#1e88e5');
    bar      ('#spark-events',    '#43a047');
    lineSmall('#spark-brochures', '#fb8c00');

    line('#spark-total-enq');
    line('#spark-product-enq');
    line('#spark-doc-enq');
    line('#spark-contact-enq');
    line('#spark-brochure-enq');
    line('#spark-job-enq');
});
</script>
@endsection