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
                        @if(!session()->has('frontUser'))
                            <li><a href="{{ route('home') }}#aboutUs">About US</a></li>
                            <li class="{{ request()->is('candidates') || request()->is('candidates/*') ? 'active' : '' }}"><a href="{{ route('candidates') }}">candidates</a></li>
                            <li class="{{ request()->is('families') ? 'active' : '' }} {{ request()->is('family-register') }}"><a href="{{ route('families') }}">family</a></li>
                            <li class="{{ request()->is('sign-up') ? 'active' : '' }}"><a href="{{ route('sign-up') }}">sign up</a></li>
                        @elseif(session()->get('frontUser')->role != "family")
                             {{-- candidate manu --}}
                            <li class="{{ request()->routeIs('view-families') ? 'active' : '' }}"><a href="{{ route('view-families') }}">View Families</a></li>
                            <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Support</a></li>
                            <li class="{{ request()->routeIs('candidate-manage-profile') ? 'active' : '' }}"><a href="{{ route('candidate-manage-profile') }}">Manage Profile</a></li>
                            <li class="{{ request()->routeIs('candidate-manage-calender') ? 'active' : '' }}"><a href="{{ url('candidate/manage-calender') }}">Manage Calender</a></li>
                            {{-- <li class="#"><a href="#">Messages</a></li> --}}
                            <li class="{{ request()->routeIs('family-reviews') ? 'active' : '' }}"><a href="{{ route('family-reviews') }}">Reviews</a></li>
                        @else
                            {{-- family menu --}}
                            <li class="{{ request()->routeIs('view-candidates') ? 'active' : '' }}"><a href="{{ route('view-candidates') }}">View Candidates</a></li>
                            <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Support</a></li>
                            <li class="{{ request()->routeIs('family-manage-profile') ? 'active' : '' }}"><a href="{{ route('family-manage-profile') }}">Manage Profile</a></li>
                            {{-- <li class="#"><a href="#">Messages</a></li> --}}
                            {{-- <li class="{{ request()->routeIs('candidate-reviews') ? 'active' : '' }}"><a href="{{ route('candidate-reviews') }}">Reviews</a></li> --}}
                            <li class="{{ request()->routeIs('transactions') ? 'active' : '' }}"><a href="{{ route('transactions') }}">Transactions</a></li>
                        @endif
                        @if(session()->has('frontUser'))
                            {{-- <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Support</a></li> --}}
                            <li><a href="{{ route('user-logout') }}">Logout</a></li>
                            <li><a href="javaScript:;" class="search-btn"><i class="fa fa-search"></i></a></li>
                        @else
                            <li><a href="{{ route('contact-us') }}">Contact us</a></li>
                            <li class="{{ request()->is('user-login') ? 'active' : '' }}"><a href="{{ route('user-login') }}">Login</a></li>
                            <li><a href="javaScript:;" class="search-btn"><i class="fa fa-search"></i></a></li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>
<div class="search-box search-elem">
    <a href="javaScript:;" class="close btn btn-primary round">x</a>
    <div class="inner row">
        <form name="frm" method="post" action="{{ route('search') }}">
            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 mx-auto">
                <div class="w-100 input-group d-flex flex-direction-row flex-wrap align-items-center">
                        @csrf
                        <select class="form-field" required name="type">
                            <option value="family">Search for Family</option>
                            <option value="candidate">Search for Candidate</option>
                        </select>
                        <input type="text" placeholder="Enter Area or City" id="search-field" class="form-field address-input" name="search" required>
                        <div class="input-group-append">
                            <button id="" type="submit" class="submit btn btn-link text-secondary"><i class="fa fa-search"></i></button>
                        </div>
                </div>
            </div>
        </form>
    </div>
</div>
