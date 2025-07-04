@extends('vendor.layouts.master')

@section('title')
    User Profile
@endsection

@section('content')

    {{-- <!--=============================
        DASHBOARD START
      ==============================--> --}}
    <section id="wsus__dashboard">
        <div class="container-fluid">
            @include('vendor.layouts.sidebar')
            <div class="row">
                <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
                    <div class="dashboard_content mt-2 mt-md-0">
                        <h3><i class="far fa-user"></i> profile</h3>
                        <div class="wsus__dashboard_profile">
                            <div class="wsus__dash_pro_area">
                                <h4>basic information</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('vendor.profile.update') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-xl-3 col-sm-6 col-md-6 text-center">
                                            <div class="wsus__dash_pro_img">
                                                <img src="{{ Auth::user()->image ? Auth::user()->image : asset('frontend/images/ts-2.jpg') }}"
                                                    alt="img" class="img-fluid w-50">
                                                <input type="file" name="image" id="image">
                                            </div>
                                        </div>
                                        <div class="col-xl-9">
                                            <div class="row">
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-user-tie"></i>
                                                        <input type="text" placeholder="Name" name="name"
                                                            value="{{ Auth::user()->name }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fas fa-user-tie"></i>
                                                        <input type="text" placeholder="Last Name" name="username"
                                                            value="{{ Auth::user()->username }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="fal fa-envelope-open"></i>
                                                        <input type="email" placeholder="Email" name="email"
                                                            value="{{ Auth::user()->email }}">
                                                    </div>
                                                </div>
                                                <div class="col-xl-6 col-md-6">
                                                    <div class="wsus__dash_pro_single">
                                                        <i class="far fa-phone-alt"></i>
                                                        <input type="text" placeholder="Phone" name="phone"
                                                            value="{{ Auth::user()->phone }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xl-12 d-flex justify-content-end align-items-center">
                                            <button type="submit" class="common_btn mb-4 mt-2">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="wsus__dashboard_profile mt-5">
                        <div class="wsus__dash_pro_area">
                            <h4>Update Password</h4>
                            <div class="wsus__dash_pass_change mt-2">
                                <form method="POST" action="{{ route('vendor.profile.update.password') }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class="col-xl-4 col-md-4">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-unlock-alt"></i>
                                                <input type="password" placeholder="Current Password"
                                                    name="current_password">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-lock-alt"></i>
                                                <input type="password" placeholder="New Password" name="password">
                                            </div>
                                        </div>
                                        <div class="col-xl-4 col-md-4">
                                            <div class="wsus__dash_pro_single">
                                                <i class="fas fa-lock-alt"></i>
                                                <input type="password" placeholder="Confirm Password"
                                                    name="password_confirmation">
                                            </div>
                                        </div>
                                        <div class="col-xl-12 d-flex justify-content-end align-items-center">
                                            <button class="common_btn" type="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    {{-- <!--=============================
        DASHBOARD START
      ==============================--> --}}
@endsection
