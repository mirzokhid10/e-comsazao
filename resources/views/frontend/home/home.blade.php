@extends('frontend.layouts.master')

@section('content')
    {{-- <!--============================
        MAIN MENU START
    ==============================--> --}}

    {{-- <!--============================
        MAIN MENU END
    ==============================--> --}}


    {{-- <!--============================
        MOBILE MENU START
    ==============================--> --}}
    {{-- <section id="wsus__mobile_menu">
            <span class="wsus__mobile_menu_close"><i class="fal fa-times"></i></span>
            <ul class="wsus__mobile_menu_header_icon d-inline-flex">

                <li><a href="wishlist.html"><i class="far fa-heart"></i> <span>2</span></a></li>

                <li><a href="compare.html"><i class="far fa-random"></i> </i><span>3</span></a></li>
            </ul>
            <form>
                <input type="text" placeholder="Search">
                <button type="submit"><i class="far fa-search"></i></button>
            </form>

            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home"
                        role="tab" aria-controls="pills-home" aria-selected="true">Categories</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile"
                        role="tab" aria-controls="pills-profile" aria-selected="false">main menu</button>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                    <div class="wsus__mobile_menu_main_menu">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <ul class="wsus_mobile_menu_category">
                                <li><a href="#"><i class="fas fa-star"></i> hot promotions</a></li>
                                <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThreew" aria-expanded="false"
                                        aria-controls="flush-collapseThreew"><i class="fal fa-tshirt"></i> fashion</a>
                                    <div id="flush-collapseThreew" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="#">men's</a></li>
                                                <li><a href="#">wemen's</a></li>
                                                <li><a href="#">kid's</a></li>
                                                <li><a href="#">others</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThreer" aria-expanded="false"
                                        aria-controls="flush-collapseThreer"><i class="fas fa-tv"></i> electronics</a>
                                    <div id="flush-collapseThreer" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="#">Consumer Electronic</a></li>
                                                <li><a href="#">Accessories & Parts</a></li>
                                                <li><a href="#">other brands</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThreerrp" aria-expanded="false"
                                        aria-controls="flush-collapseThreerrp"><i class="fas fa-chair-office"></i>
                                        furnicture</a>
                                    <div id="flush-collapseThreerrp" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="#">home</a></li>
                                                <li><a href="#">office</a></li>
                                                <li><a href="#">restaurent</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThreerrw" aria-expanded="false"
                                        aria-controls="flush-collapseThreerrw"><i class="fal fa-mobile"></i> Smart
                                        Phones</a>
                                    <div id="flush-collapseThreerrw" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="#">apple</a></li>
                                                <li><a href="#">xiaomi</a></li>
                                                <li><a href="#">oppo</a></li>
                                                <li><a href="#">samsung</a></li>
                                                <li><a href="#">vivo</a></li>
                                                <li><a href="#">others</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#"><i class="fas fa-home-lg-alt"></i> Home & Garden</a></li>
                                <li><a href="#"><i class="far fa-camera"></i> Accessories</a></li>
                                <li><a href="#"><i class="fas fa-heartbeat"></i> healthy & Beauty</a></li>
                                <li><a href="#"><i class="fal fa-gift-card"></i> Gift Ideas</a></li>
                                <li><a href="#"><i class="fal fa-gamepad-alt"></i> Toy & Games</a></li>
                                <li><a href="#"><i class="fal fa-gem"></i> View All Categories</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <div class="wsus__mobile_menu_main_menu">
                        <div class="accordion accordion-flush" id="accordionFlushExample2">
                            <ul>
                                <li><a href="index.html">home</a></li>
                                <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree" aria-expanded="false"
                                        aria-controls="flush-collapseThree">shop</a>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample2">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="#">men's</a></li>
                                                <li><a href="#">wemen's</a></li>
                                                <li><a href="#">kid's</a></li>
                                                <li><a href="#">others</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="vendor.html">vendor</a></li>
                                <li><a href="blog.html">blog</a></li>
                                <li><a href="daily_deals.html">campain</a></li>
                                <li><a href="#" class="accordion-button collapsed" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseThree101" aria-expanded="false"
                                        aria-controls="flush-collapseThree101">pages</a>
                                    <div id="flush-collapseThree101" class="accordion-collapse collapse"
                                        data-bs-parent="#accordionFlushExample2">
                                        <div class="accordion-body">
                                            <ul>
                                                <li><a href="404.html">404</a></li>
                                                <li><a href="faqs.html">faq</a></li>
                                                <li><a href="invoice.html">invoice</a></li>
                                                <li><a href="about_us.html">about</a></li>
                                                <li><a href="team.html">team</a></li>
                                                <li><a href="product_grid_view.html">product grid view</a></li>
                                                <li><a href="product_grid_view.html">product list view</a></li>
                                                <li><a href="team_details.html">team details</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="track_order.html">track order</a></li>
                                <li><a href="daily_deals.html">daily deals</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    --}}
    {{-- <!--============================
        MOBILE MENU END
    ==============================--> --}}


    {{-- <!--==========================
        POP UP START
    ===========================--> --}}
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
    {{-- <!--==========================
        POP UP END
    ===========================--> --}}


    {{-- <!--==========================
      PRODUCT MODAL VIEW START
    ===========================--> --}}

    {{-- <!--==========================
      PRODUCT MODAL VIEW END
    ===========================--> --}}


    {{-- <!--============================
        BANNER PART 2 START
    ==============================--> --}}
    @include('frontend.home.sections.banner-slider')
    {{-- <!--============================
        BANNER PART 2 END
    ==============================--> --}}


    {{-- <!--============================
        FLASH SELL START
    ==============================--> --}}
    @include('frontend.home.sections.flash-sale')

    {{-- <!--============================
        FLASH SELL END
    ==============================--> --}}


    {{-- <!--============================
       MONTHLY TOP PRODUCT START
    ==============================--> --}}
{{--    @include('frontend.home.sections.top-product')--}}
    {{-- <!--============================
       MONTHLY TOP PRODUCT END
    ==============================--> --}}


    {{-- <!--============================
        BRAND SLIDER START
    ==============================--> --}}
{{--    @include('frontend.home.sections.brand-slider')--}}

    {{-- <!--============================
        BRAND SLIDER END
    ==============================--> --}}


    {{-- <!--============================
        SINGLE BANNER START
    ==============================--> --}}
    {{-- @include('frontend.home.sections.single-banner') --}}

    {{-- <!--============================
        SINGLE BANNER END
    ==============================--> --}}


    {{-- <!--============================
        HOT DEALS START
    ==============================--> --}}

{{--    @include('frontend.home.sections.hot-deals')--}}

    {{-- <!--============================
        HOT DEALS END
    ==============================--> --}}


    {{-- <!--============================
        ELECTRONIC PART START
    ==============================--> --}}

{{--    @include('frontend.home.sections.category-product-slider-one')--}}

    {{-- <!--============================
        ELECTRONIC PART END
    ==============================--> --}}


    {{-- <!--============================
        ELECTRONIC PART START
    ==============================--> --}}

{{--    @include('frontend.home.sections.category-product-slider-two')--}}

    {{-- <!--============================
        ELECTRONIC PART END
    ==============================--> --}}


    {{-- <!--============================
        LARGE BANNER  START
    ==============================--> --}}
    {{-- @include('frontend.home.sections.large-banner') --}}
    {{-- <!--============================
        LARGE BANNER  END
    ==============================--> --}}


    {{-- <!--============================
        WEEKLY BEST ITEM START
    ==============================--> --}}
{{--    @include('frontend.home.sections.weekly-items')--}}
    {{-- <!--============================
        WEEKLY BEST ITEM END
    ==============================--> --}}


    {{-- <!--============================
      HOME SERVICES START
    ==============================--> --}}
    {{-- @include('frontend.home.sections.services') --}}

    {{-- <!--============================
        HOME SERVICES END
    ==============================--> --}}


    {{-- <!--============================
        HOME BLOGS START
    ==============================--> --}}
    {{-- @include('frontend.home.sections.blog') --}}

    {{-- <!--============================
    HOME BLOGS END
==============================--> --}}
@endsection
