@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Profile</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('admin.dashboard') }}">Dashboard</a></div>
                <div class="breadcrumb-item">Profile</div>
            </div>
        </div>
        <div class="section-body">
            <h2 class="section-title">Hi, <span>{{ Auth::user()->name }}</span>!
            </h2>
            <p class="section-lead">
                Change information about yourself on this page.
            </p>

            <div class="col-12 col-md-12 col-lg-12">
                <div class="row mt-4">
                    <!-- Profile Overview -->
                    <div class="col-md-12 col-lg-4 mb-4">
                        <div class="card profile-widget">
                            <div class="profile-widget-header text-center">
                                <img src="{{ Auth::user()->image ? asset('' . Auth::user()->image) : asset('backend/assets/img/avatar/avatar-1.png') }}"
                                    alt="Profile Picture" class="rounded-circle profile-widget-picture" width="100">

                                <h5 class="mt-3 mb-0">{{ Auth::user()->name }}</h5>
                                <small class="text-muted">E-Commerce Manager</small>
                            </div>
                            <div class="profile-widget-description px-4 py-3">
                                Ujang is a dedicated eCommerce manager with a passion for building seamless online
                                shopping experiences. He leads product management, customer strategy, and backend
                                logistics.
                            </div>
                            <div class="profile-widget-items d-flex justify-content-around p-3 border-top">
                                <div class="text-center">
                                    <div class="profile-widget-item-label">Products</div>
                                    <div class="profile-widget-item-value">240</div>
                                </div>
                                <div class="text-center">
                                    <div class="profile-widget-item-label">Orders</div>
                                    <div class="profile-widget-item-value">1.2K</div>
                                </div>
                                <div class="text-center">
                                    <div class="profile-widget-item-label">Followers</div>
                                    <div class="profile-widget-item-value">6.8K</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Edit Form -->
                    <div class="col-md-12 col-lg-8">
                        <div class="card">
                            <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data"
                                class="needs-validation" novalidate>
                                @csrf
                                <div class="card-header">
                                    <h4>Edit Profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Profile Image</label>
                                        <input type="file" class="form-control" name="image">
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" name="name"
                                                value="{{ Auth::user()->name }}">
                                            <div class="invalid-feedback">Please fill in the first name.</div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>User Name</label>
                                            <input type="text" class="form-control" name="username"
                                                value="{{ Auth::user()->username }}">
                                            <div class="invalid-feedback">Please fill in the last name.</div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ Auth::user()->email }}">
                                            <div class="invalid-feedback">Please provide a valid email.</div>
                                        </div>
                                        <div class="form-group col-md-6 col-sm-12">
                                            <label>Phone</label>
                                            <input type="tel" class="form-control" name="phone"
                                                value="{{ Auth::user()->phone ?? 'Not Phone Number Provided' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="card">
                            <form method="post" class="needs-validation" novalidate=""
                                action="{{ route('admin.password.update') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-header">
                                    <h4>Update Password</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-lg-4 col-12">
                                            <label>Current Password</label>
                                            <input type="password" name="current_password" class="form-control">
                                        </div>
                                        <div class="form-group col-lg-4 col-12">
                                            <label>New Password</label>
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                        <div class="form-group col-lg-4 col-12">
                                            <label>Confirm Password</label>
                                            <input type="password" name="password_confirmation" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
    </section>
@endsection
