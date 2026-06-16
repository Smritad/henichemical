@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
    <div class="main-content">
        <div class="row row-inline-block small-spacing">
            <div class="col-xs-12">
                <div class="box-content">
                    <div class="col-md-12">

                        <!-- Accordion Sections -->
                        <button class="accordion" data-url="{{ route('admin.show_about_us_history') }}">
                            History <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>
                        <br><br>
                        <button class="accordion" data-url="{{ route('admin.show_about_us_r_and_d') }}">
                            R & D <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>
                         <br><br>
                        <button class="accordion" data-url="{{ route('admin.show_about_us_quality_control') }}">
                            Quality Control <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>
                        <br><br>
                        <button class="accordion" data-url="{{ route('admin.list_about_us_why_zon') }}">
                            Why ZON <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function () {

    $('.accordion').on('click', function () {
        let $this = $(this);
        let list = $this.next('.accordion_list');
        let url = $this.data('url');

        // Close all other accordions
        $('.accordion_list').not(list).slideUp();
        $('.accordion').not($this).removeClass('active');

        // Toggle current
        if (list.is(':visible')) {
            list.slideUp();
            $this.removeClass('active');
        } else {
            list.slideDown();
            $this.addClass('active');

            // Load content via AJAX if empty
            if (list.children().length === 0 && url) {
                list.html('<p>Loading...</p>');
                $.get(url, function(data) {
                    list.html(data);
                });
            }
        }
    });

});
</script>

<style>
.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    font-size: 16px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.3s;
}

.accordion:hover {
    background-color: #ddd;
}

.accordion.active {
    background-color: #ccc;
}

.arrow {
    font-size: 24px;
    font-weight: bold;
    transition: transform 0.3s ease;
}

.accordion.active .arrow {
    transform: rotate(180deg); /* ▼ → ▲ */
}

.accordion_list {
    display: none;
    padding: 15px 18px;
    background: #fff;
    margin-bottom: 15px;
    border-left: 3px solid #ccc;
}
</style>
@endsection
