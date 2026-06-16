@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
    <div class="main-content">
        <div class="row row-inline-block small-spacing">
            <div class="col-xs-12">
                <div class="box-content">
                    <div class="col-md-12">

                       <button class="accordion" id="manage_career_page_details">
                            Career Page Details
                            <span class="arrow">&#9660;</span> 
                        </button>
                        
                        <div class="accordion_list" id="career_page_details"></div>
                        <br>
                        <br>
                        <button class="accordion" id="manage_job_posts">
                            Job Posts
                            <span class="arrow">&#9660;</span>
                        </button>
                        
                        <div class="accordion_list" id="job_posts"></div>


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

    $(".accordion").on("click", function () {

        let accordionList = $(this).next(".accordion_list");

        if (accordionList.is(":visible")) {
            accordionList.slideUp();
            $(this).removeClass("active");
        } else {

            // Close other accordions
            $(".accordion_list").slideUp();
            $(".accordion").removeClass("active");

            accordionList.slideDown();
            $(this).addClass("active");

            if (accordionList.children().length === 0) {

                let url = ($(this).attr("id") === "manage_career_page_details")
                    ? "{{ route('admin.show_career_page_details') }}"
                    : "{{ route('admin.list_job_posts') }}";

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function (data) {
                        accordionList.html(data);
                    }
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
    transition: 0.3s;
}

.accordion:hover,
.accordion.active {
    background-color: #ccc;
}

.arrow {
    font-size: 26px;        /* BIG arrow */
    font-weight: bold;
    transition: transform 0.3s ease;
}

/* Arrow up when open */
.accordion.active .arrow {
    transform: rotate(180deg); /* ▼ → ▲ */
}

.accordion_list {
    display: none;
    padding: 15px 18px;
    background: #fff;
    margin-bottom: 15px;
}

</style>
@endsection
