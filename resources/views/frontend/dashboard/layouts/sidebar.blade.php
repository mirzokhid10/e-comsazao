<div class="dashboard_sidebar">
    <span class="close_icon">
        <i class="far fa-bars dash_bar"></i>
        <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{ route('user.dashboard') }}" class="dash_logo"><img src="{{ asset('frontend/images/logo.png') }}"
            alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
        <li><a class="active" href="{{ route('user.dashboard') }}"><i class="fas fa-tachometer"></i>Dashboard</a></li>

        <li><a href="{{ route('user.profile') }}"><i class="far fa-user"></i> My Profile</a></li>
        <li><a class="" href="{{ route('user.address.index') }}"><i class="fas fa-user"></i>Address</a></li>
        <li>
            <form method="POST" action="{{ route('logout') }}" class="">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault();
                this.closest('form').submit();">
                    <i class="far fa-sign-out-alt"></i>
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </li>
    </ul>
</div>
