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
                            <li class="{{ request()->is('candidates') || request()->is('candidates/*') ? 'active' : '' }}">
                                <a href="{{ route('candidates') }}">candidates</a>
                                <ul>
                                    <li><a href="{{ route('candidates-service', ['service' => 'au-pairs']) }}">Au-Pairs</a></li>
                                    <li><a href="{{ route('candidates-service', ['service' => 'nannies']) }}">Nannies</a></li>
                                    <li><a href="{{ route('candidates-service', ['service' => 'babysitters']) }}">Babysitters</a></li>
                                    <li><a href="{{ route('candidates-service', ['service' => 'petsitters']) }}">Pet sitters</a></li>
                                </ul>
                            </li>
                            
                            <li class="{{ request()->is('sign-up/*') ? 'active' : '' }}">
                                <a href="{{ route('sign-up', ['service' => 'candidate']) }}">sign up</a>
                                <ul>
                                    <li><a href="{{ route('sign-up', ['service' => 'candidate']) }}">candidates</a></li>
                                    <li><a href="{{ route('sign-up', ['service' => 'family']) }}">family</a></li>
                                    <li><a href="{{ route('family-register', ['service' => 'family-petsitting']) }}">PetSitting</a></li>
                                </ul>
                            </li>
                        @elseif(session()->get('frontUser')->role != "family" && session()->get('frontUser')->role != "family-petsitting")
                             {{-- candidate manu --}}
                            <li class="{{ request()->routeIs('view-families') ? 'active' : '' }}"><a href="{{ route('view-families') }}">View Families</a></li>
                            <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Support</a></li>
                            <li class="{{ request()->routeIs('candidate-manage-profile') ? 'active' : '' }}"><a href="{{ route('candidate-manage-profile') }}">Manage Profile</a></li>
                            <li class="{{ request()->routeIs('candidate-manage-calender') ? 'active' : '' }}"><a href="{{ url('candidate/manage-calender') }}">Manage Calender</a></li>
                        @else
                            {{-- family menu --}}
                            <li class="{{ request()->routeIs('view-candidates') ? 'active' : '' }}"><a href="{{ route('view-candidates') }}">View Candidates</a></li>
                            <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Support</a></li>
                            <li class="{{ request()->routeIs('family-manage-profile') ? 'active' : '' }}"><a href="{{ route('family-manage-profile') }}">Manage Profile</a></li>
                            <li class="{{ request()->is('reviews') ? 'active' : '' }}"><a href="{{ route('reviews') }}">Reviews</a></li>
                            {{-- subscription status --}}
                            @if(session()->get('frontUser')->user_subscription_status == "active")
                                <li class="{{ request()->routeIs('transactions') ? 'active' : '' }}"><a href="{{ route('transactions') }}">Transactions</a></li>
                            @elseif(session()->get('frontUser')->user_subscription_status == "expired")
                                <li class="{{ request()->routeIs('packages') ? 'active' : '' }}"><a href="{{ route('packages') }}">Reniew Plan</a></li>
                            @else
                                <li class="{{ request()->routeIs('packages') ? 'active' : '' }}"><a href="{{ route('packages') }}">Packages</a></li>
                            @endif
                        
                        @endif
                        
                        @if(session()->has('frontUser'))
                            <li><a href="{{ route('user-logout') }}">Logout</a></li>
                            <li><a href="javaScript:;" class="search-btn"><i class="fa fa-search"></i></a></li>
                            {{-- family checkout --}}
                            @if((session()->get('frontUser')->role == "family" || session()->get('frontUser')->role == "family-petsitting") && session()->get('frontUser')->user_subscription_status != "active")
                                <li><a href="{{ route('checkout') }}" class="cart-icon {{ request()->routeIs('checkout') ? 'active' : '' }}"><i class="fa-solid fa-cart-shopping"></i><span class="counterNumber">{{ session()->has('cart') ? count(session()->get('cart')) : 0 }}</span></a></li>
                            @endif
                        @else
                            <li class="{{ request()->routeIs('packages') ? 'active' : '' }}"><a href="{{ route('packages') }}">Packages</a></li>
                            <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Contact us</a></li>
                            <li class="{{ request()->is('user-login') ? 'active' : '' }}"><a href="{{ route('user-login') }}">Login</a></li>
                            <li><a href="javaScript:;" class="search-btn"><i class="fa fa-search"></i></a></li>
                            {{-- guest user checkout --}}
                            <li><a href="{{ route('checkout') }}" class="cart-icon {{ request()->routeIs('checkout') ? 'active' : '' }}"><i class="fa-solid fa-cart-shopping"></i><span class="counterNumber">{{ session()->has('cart') ? count(session()->get('cart')) : 0 }}</span></a></li>
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
        <form name="frm" method="GET" action="{{ route('search') }}">
            <div class="col-lg-6 col-md-7 col-sm-12 col-xs-12 mx-auto">
                <div class="w-100 input-group d-flex flex-direction-row flex-wrap align-items-center">
                    <select class="form-field" required name="type">
                        <option value="family">Search for Family</option>
                        <option value="candidate">Search for Candidate</option>
                    </select>
                    <input type="text" placeholder="Enter Area or City" id="search-field" class="form-field address-input" name="search_query" required>
                    <div class="input-group-append">
                        <button id="" type="submit" class="submit btn btn-link text-secondary"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
