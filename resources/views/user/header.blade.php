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
                            <li class="{{ request()->is('candidates') ? 'active' : '' }}"><a href="{{ route('candidates') }}">candidates</a></li>
                            <li class="{{ request()->is('families') ? 'active' : '' }} {{ request()->is('family-register') || request()->is('candidate-detail/*') ? 'active' : '' }}"><a href="{{ route('families') }}">family</a></li>
                        @elseif(session()->get('frontUser')->role != "family")
                            <li class="{{ request()->routeIs('edit-candidate') ? 'active' : '' }}"><a href="{{ route('edit-candidate', ['id' =>  Session::has('frontUser') ? Session::get('frontUser')->id : null]) }}">Manage Profile</a></li>
                            <li class="#"><a href="#">View Families</a></li>
                            <li class="{{ request()->routeIs('candidate-manage-calender') ? 'active' : '' }}"><a href="{{ url('candidate/manage-calender') }}">Manage Candidates</a></li>
                            <li class="#"><a href="#">Messages</a></li>
                            <li class="#"><a href="#">Reviews</a></li>
                        @else
                            <li class="{{ request()->routeIs('edit-family') ? 'active' : '' }}"><a href="{{ route('edit-family', ['id' =>  Session::has('frontUser') ? Session::get('frontUser')->id : null]) }}">Manage Profile</a></li>
                            <li class="{{ request()->routeIs('family-manage-calender') ? 'active' : '' }}"><a href="{{ url('family/manage-calender') }}">Manage Calander</a></li>
                            <li class="#"><a href="#">Messages</a></li>
                            <li class="#"><a href="#">Reviews</a></li>
                            <li class="#"><a href="#">Manage Payments</a></li>
                        @endif
                        @if(session()->has('frontUser'))
                            <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}"><a href="{{ route('contact-us') }}">Support</a></li>
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
        <div class="col-lg-5 col-md-7 col-sm-12 col-xs-12 mx-auto">
            <div class="w-100 input-group d-flex flex-direction-row flex-wrap align-items-center">
                <select class="form-field" required>
                    <option value="family">Family</option>
                    <option value="candidate">Candidate</option>
                </select>
                <input type="text" placeholder="Search here" id="search-field" class="form-field address-input">
                <div class="input-group-append">
                    <button id="" type="submit" class="submit btn btn-link text-secondary"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
