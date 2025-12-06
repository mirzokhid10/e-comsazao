<footer class="footer_2">
    <div class="container">
        <div class="row justify-content-between">
            <div class="col-xl-3 col-sm-7 col-md-6 col-lg-3">
                <div class="wsus__footer_content">
                    <a class="wsus__footer_2_logo" href="#">
                        <img src="{{ asset('frontend/images/logo_2.png') }}" alt="logo">
                    </a>
                    <a class="action" href="callto:+8896254857456"><i class="fas fa-phone-alt"></i>
                        +8896254857456</a>
                    <a class="action" href="mailto:example@gmail.com"><i class="far fa-envelope"></i>
                        example@gmail.com</a>
                    <p><i class="fal fa-map-marker-alt"></i>
                        {{ __('footer.San Francisco City Hall, San Francisco, CA') }}</p>
                    <ul class="wsus__footer_social">
                        <li><a class="facebook" href="#"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a class="twitter" href="#"><i class="fab fa-twitter"></i></a></li>
                        <li><a class="whatsapp" href="#"><i class="fab fa-whatsapp"></i></a></li>
                        <li><a class="pinterest" href="#"><i class="fab fa-pinterest-p"></i></a></li>
                        <li><a class="behance" href="#"><i class="fab fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{ __('footer.Company') }}</h5>
                    <ul class="wsus__footer_menu">
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.About Us') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Team Member') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Career') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Contact Us') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Affilate') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Order History') }}</a>
                        </li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Team Member') }}</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-sm-5 col-md-4 col-lg-2">
                <div class="wsus__footer_content">
                    <h5>{{ __('footer.Company') }}</h5>
                    <ul class="wsus__footer_menu">
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.About Us') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Team Member') }}</a>
                        </li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Career') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Contact Us') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Affilate') }}</a></li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Order History') }}</a>
                        </li>
                        <li><a href="#"><i class="fas fa-caret-right"></i> {{ __('footer.Team Member') }}</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-sm-7 col-md-8 col-lg-5">
                <div class="wsus__footer_content wsus__footer_content_2">
                    <h3>{{ __('footer.Subscribe To Our Newsletter') }}</h3>
                    <p>{{ __('footer.Get all the latest information on Events, Sales and Offers. Get all the latest information on Events.') }}
                    </p>
                    <form action="{{ route('newsletter-request') }}" method="POST" id="newsletter-form">
                        @csrf
                        <input type="text" placeholder="{{ __('footer.Email...') }}" name="email"
                            class="newsletter_email">
                        <button type="submit" class="common_btn subscribe_btn">{{ __('footer.Subscribe') }}</button>
                    </form>
                    <div class="footer_payment">
                        <p>{{ __('footer.We are using safe payment for:') }}</p>
                        <img src="{{ asset('frontend/images/credit2.png') }}" alt="card" class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="wsus__footer_bottom">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="wsus__copyright d-flex justify-content-center">
                        <p>{{ __('footer.Copyright © 2021 Sazao shop. All Rights Reserved.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@push('scripts')
    <script></script>
@endpush
