<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="javascript:;" class="dash_logo d-flex justify-content-center"><img
            src="{{ asset('frontend/images/logo_2.png') }}" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="{{ setActive(['vendor.dashbaord']) }}" href="{{ route('vendor.dashbaord') }}"><i
                    class="fas fa-tachometer"></i>Dashboard</a></li>
        <li><a class="{{ setActive(['vendor.shop-profile']) }}" href="{{ route('vendor.shop-profile.index') }}"><i
                    class="far fa-user"></i> My Shop
                Profile</a>
        </li>
        <li><a class="{{ setActive(['vendor.profile']) }}" href="{{ route('vendor.profile') }}"><i
                    class="far fa-user"></i> My Profilee</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}"
                    onclick="event.preventDefault();
            this.closest('form').submit();"><i
                        class="far fa-sign-out-alt"></i> Log out</a>
            </form>
        </li>

    </ul>
</div>
