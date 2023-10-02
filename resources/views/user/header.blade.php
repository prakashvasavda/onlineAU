<header class="header-sticky">
    <div class="container">
        <div class="menu-wrapper">
            <div class="logo-main">
                <a href="{{ route('home') }}"><img src="{{ asset('front/images/logo.png') }}" alt="logo"></a>
            </div>
            <div class="main-menu">
                <nav class="stellarnav">
                    <ul>
                        <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ route('home') }}">home</a></li>
                        <li><a href="{{ route('about-candidate') }}">about US</a></li>
                        <li class="{{ request()->is('candidates') ? 'active' : '' }}"><a href="{{ route('candidates') }}">candidates</a></li>
                        <li class="{{ request()->is('families') ? 'active' : '' }} {{ request()->is('family-register') ? 'active' : '' }}"><a href="{{ route('families') }}">family</a></li>
                        <li lass="{{ request()->is('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Contact us</a></li>
                        @if(session()->has('frontUser'))
                            <li><a href="{{ route('user-logout') }}">Logout</a></li>
                        @else
                            <li class="{{ request()->is('user-login') ? 'active' : '' }}"><a href="{{ route('user-login') }}">Login</a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
