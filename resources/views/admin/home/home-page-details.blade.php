@extends('layouts.admin-header')

@section('content')
<div id="wrapper">
	<div class="main-content">
		<div class="row row-inline-block small-spacing">
			<div class="col-xs-12">
				<div class="box-content">
					<div class="col-md-12">
						<button class="accordion" data-url="{{ route('admin.list_banners') }}">
                            Banners
                            <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>
<br><br>
                        <button class="accordion" data-url="{{ route('admin.list_key_points') }}">
                            Key Points
                            <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>
<br><br>
                        <button class="accordion" data-url="{{ route('admin.list_certificates') }}">
                            Certificates
                            <span class="arrow">&#9660;</span>
                        </button>
                        <div class="accordion_list"></div>
                            
                        </div> 
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#manage_banners").click(function() {
                var accordion_list = $(this).next(".accordion_list");

                if(accordion_list.is(":visible")) 
                {
                    accordion_list.slideUp();
                    $(this).removeClass("active");
                } 
                else 
                {
                    accordion_list.slideDown();
                    $(this).addClass("active");

                    if(accordion_list.children().length === 0) 
                    {
                        $.ajax({
                            url: "{{ route('admin.list_banners') }}",
                            method: "GET",
                            success: function(data) {
                                accordion_list.html(data);
                            }
                        });
                    }
                }
            });

            $("#manage_key_points").click(function() {
                var accordion_list = $(this).next(".accordion_list");

                if(accordion_list.is(":visible")) 
                {
                    accordion_list.slideUp();
                    $(this).removeClass("active");
                } 
                else 
                {
                    accordion_list.slideDown();
                    $(this).addClass("active");

                    if(accordion_list.children().length === 0) 
                    {
                        $.ajax({
                            url: "{{ route('admin.list_key_points') }}",
                            method: "GET",
                            success: function(data) {
                                accordion_list.html(data);
                            }
                        });
                    }
                }
            });

            $("#manage_certificates").click(function() {
                var accordion_list = $(this).next(".accordion_list");

                if(accordion_list.is(":visible")) 
                {
                    accordion_list.slideUp();
                    $(this).removeClass("active");
                } 
                else 
                {
                    accordion_list.slideDown();
                    $(this).addClass("active");

                    if(accordion_list.children().length === 0) 
                    {
                        $.ajax({
                            url: "{{ route('admin.list_certificates') }}",
                            method: "GET",
                            success: function(data) {
                                accordion_list.html(data);
                            }
                        });
                    }
                }
            });

            $("#manage_about_us_why_zon").click(function() {
                var accordion_list = $(this).next(".accordion_list");

                if(accordion_list.is(":visible")) 
                {
                    accordion_list.slideUp();
                    $(this).removeClass("active");
                } 
                else 
                {
                    accordion_list.slideDown();
                    $(this).addClass("active");

                    if(accordion_list.children().length === 0) 
                    {
                        $.ajax({
                            url: "",
                            method: "GET",
                            success: function(data) {
                                accordion_list.html(data);
                            }
                        });
                    }
                }
            });
        });
    </script>
<script>
$(document).ready(function () {

    $('.accordion').on('click', function () {

        let $this = $(this);
        let accordionList = $this.next('.accordion_list');
        let url = $this.data('url');

        if (accordionList.is(':visible')) {
            accordionList.slideUp();
            $this.removeClass('active');
            return;
        }

        // Close others
        $('.accordion_list').slideUp();
        $('.accordion').removeClass('active');

        accordionList.slideDown();
        $this.addClass('active');

        if (accordionList.children().length === 0 && url) {
            accordionList.html('<p>Loading...</p>');

            $.get(url, function (data) {
                accordionList.html(data);
            });
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
    font-size: 28px; /* BIG arrow */
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
}

    </style>
@endsection
