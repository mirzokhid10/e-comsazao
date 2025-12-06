@extends('frontend.layouts.master')

@section('title')
    {{ $settings->site_name }} || Login
@endsection

@section('content')
    {{-- <!--============================
             BREADCRUMB START
        ==============================--> --}}
    <section id="wsus__breadcrumb">
        <div class="wsus_breadcrumb_overlay">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h4>{{ __('auth.login / register') }}</h4>
                        <ul>

                            <li><a href="/">{{ __('auth.home') }}</a></li>
                            <li><a href="#">{{ __('auth.login / register') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <!--============================
            BREADCRUMB END
        ==============================--> --}}


    {{-- <!--============================
           LOGIN/REGISTER PAGE START
        ==============================--> --}}
    <section id="wsus__login_register">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 m-auto">
                    <div class="wsus__login_reg_area">
                        <ul class="nav nav-pills mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-homes" type="button" role="tab" aria-controls="pills-homes"
                                    aria-selected="true">{{ __('auth.login') }}</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="pills-profile-tab2" data-bs-toggle="pill"
                                    data-bs-target="#pills-profiles" type="button" role="tab"
                                    aria-controls="pills-profiles" aria-selected="true">{{ __('auth.signup') }}</button>
                            </li>
                        </ul>
                        <div class="tab-content" id="pills-tabContent2">
                            <div class="tab-pane fade show active" id="pills-homes" role="tabpanel"
                                aria-labelledby="pills-home-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="email" type="email" name="email"
                                                placeholder="{{ __('auth.User Name') }}" required>
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password"
                                                placeholder="{{ __('auth.Password') }}" required>
                                        </div>
                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefault">{{ __('auth.Remember me') }}</label>
                                            </div>
                                            <a class="forget_p"
                                                href="forget_password.html">{{ __('auth.forget password ?') }}</a>
                                        </div>
                                        <button class="common_btn" type="submit">{{ __('auth.login') }}</button>
                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-profiles" role="tabpanel"
                                aria-labelledby="pills-profile-tab2">
                                <div class="wsus__login">
                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="wsus__login_input">
                                            <i class="fas fa-user-tie"></i>
                                            <input id="name" type="text" name="name"
                                                placeholder="{{ __('auth.Name') }}" required>
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="far fa-envelope"></i>
                                            <input id="email" type="email" name="{{ __('auth.Email') }}" required
                                                placeholder="Email">
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password" type="password" name="password"
                                                placeholder="{{ __('auth.Password') }}">
                                        </div>
                                        <div class="wsus__login_input">
                                            <i class="fas fa-key"></i>
                                            <input id="password_confirmation" type="password" name="password_confirmation"
                                                placeholder="{{ __('auth.Confirm Password') }}">
                                        </div>
                                        <div class="wsus__login_save">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input" type="checkbox"
                                                    id="flexSwitchCheckDefault03">
                                                <label class="form-check-label"
                                                    for="flexSwitchCheckDefault03">{{ __('auth.I consent to the privacy policy') }}</label>
                                            </div>
                                        </div>
                                        <button class="common_btn" type="submit">{{ __('auth.signup') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- <!--============================
        LOGIN/REGISTER PAGE END
    ==============================--> --}}
@endsection
