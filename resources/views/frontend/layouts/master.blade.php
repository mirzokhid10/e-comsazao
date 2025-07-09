<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no, target-densityDpi=device-dpi" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('frontend/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.nice-number.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/add_row_custon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/mobile_menu.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.exzoom.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/multiple-image-video.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ranger_style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery.classycountdown.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/venobox.min.css') }}">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
    <!-- <link rel="stylesheet" href="css/rtl.css"> -->
    @notifyCss
</head>

<body>

    <!--============================
        HEADER START
    ==============================-->
    @include('frontend.layouts.header')
    <!--============================
        HEADER END
    ==============================-->


    <!--============================
        MAIN MENU START
    ==============================-->
    @include('frontend.layouts.navbar')
    <!--============================
        MOBILE MENU END
    ==============================-->


    <!--==========================
        POP UP START
    ===========================-->
    <!-- <section id="wsus__pop_up">
        <div class="wsus__pop_up_center">
            <div class="wsus__pop_up_text">
                <span id="cross"><i class="fas fa-times"></i></span>
                <h5>get up to <span>75% off</span></h5>
                <h2>Sign up to E-SHOP</h2>
                <p>Subscribe to the <b>E-SHOP</b> market newsletter to receive updates on special offers.</p>
                <form>
                    <input type="email" placeholder="Your Email" class="news_input">
                    <button type="submit" class="common_btn">go</button>
                    <div class="wsus__pop_up_check_box">
                    </div>
                </form>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault11">
                    <label class="form-check-label" for="flexCheckDefault11">
                        Don't show this popup again
                    </label>
                </div>
            </div>
        </div>
    </section> -->
    <!--==========================
        POP UP END
    ===========================-->


    <!--============================
        Main Content Start
    ==============================-->
    @yield('content')
    <!--============================
       Main Content End
    ==============================-->

    <!--============================
        FOOTER PART START
    ==============================-->
    @include('frontend.layouts.footer')
    <!--============================
        FOOTER PART END
    ==============================-->


    <!--============================
        SCROLL BUTTON START
    ==============================-->
    <div class="wsus__scroll_btn">
        <i class="fas fa-chevron-up"></i>
    </div>
    <!--============================
        SCROLL BUTTON  END
    ==============================-->


    <script src="{{ asset('frontend/js/jquery-3.6.0.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/js/Font-Awesome.js') }}"></script>
    <script src="{{ asset('frontend/js/select2.min.js') }}"></script>
    <script src="{{ asset('frontend/js/slick.min.js') }}"></script>
    <script src="{{ asset('frontend/js/simplyCountdown.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.exzoom.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nice-number.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/add_row_custon.js') }}"></script>
    <script src="{{ asset('frontend/js/multiple-image-video.js') }}"></script>
    <script src="{{ asset('frontend/js/sticky_sidebar.js') }}"></script>
    <script src="{{ asset('frontend/js/ranger_jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/ranger_slider.js') }}"></script>
    <script src="{{ asset('frontend/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/js/venobox.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.classycountdown.js') }}"></script>
    <x-notify::notify />
    @notifyJs

    @include('frontend.layouts.scripts')
    @stack('scripts')
</body>

</html>
