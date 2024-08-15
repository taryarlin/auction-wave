<!--============= ScrollToTop Section Starts Here =============-->
<div class="overlayer" id="overlayer" style="display:none">
    <div class="loader">
        <div class="loader-inner"></div>
    </div>
</div>
<a href="#0" class="scrollToTop"><i class="fas fa-angle-up"></i></a>
<div class="overlay"></div>
<!--============= ScrollToTop Section Ends Here =============-->
<!--============= Header Section Starts Here =============-->
<header>
    <div class="header-top">
        <div class="container">
            <div class="header-top-wrapper">
                <ul class="customer-support">
                    <li class="cmn-support-text">
                        <a href="#0" class="mr-3">
                            <i class="fas fa-phone-alt"></i>
                            <span class="ml-2 d-none d-sm-inline-block">အကူအညီ (+၉၅၉) ၄၀၀ ၇၅၂ ၉၁၇</span></a>
                    </li>
                </ul>
                <ul class="cart-button-area">
                    <li>
                        @if (auth()->guard('customer')->check())
                            <a href="{{ route('profile.personal.index') }}" class="user-button">
                                <i class="far fa-user"></i>
                            </a>
                            |
                            <form action="{{ route('logout') }}" method="POST" class="d-inline-block">
                                @csrf
                                <button type="submit" class="user-button">
                                    <i class="fas fa-sign-out-alt"></i>
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" style="color: white;">
                                Login
                            </a>
                            |
                            <a href="{{ route('register') }}" style="color: white;">
                                Register
                            </a>
                        @endif
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="header-bottom">
        <div class="container">
            <div class="header-wrapper">
                <div class="logo">
                    <a href="/">
                        <img src="{{ asset('assets/images/pg-logo.png') }}" alt="logo" width="20" height="50">
                    </a>
                </div>
                <ul class="menu ml-auto">
                    <li>
                        <a href="/">Home</a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">Auction</a>
                    </li>
                    <li>
                        <a href="#">Pages</a>
                        <ul class="submenu">
                            {{-- <li>
                                <a href="#0">Product</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="auction.php">Product Page</a>
                                    </li>
                                    <li>
                                        <a href="details.php">Product Details</a>
                                    </li>
                                </ul>
                            </li> --}}
                            <li>
                                <a href="#0">My Account</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="{{ route('register') }}">Sign Up</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('login') }}">Sign In</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="#0">Dashboard</a>
                                <ul class="submenu">
                                    <li>
                                        <a href="./Dashboard.php">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="./personal-profile.php">Personal Profile</a>
                                    </li>
                                    <li>
                                        <a href="./mybid.php">My Bids</a>
                                    </li>
                                    <li>
                                        <a href="./winning-bid.php">Winning Bids</a>
                                    </li>
                                    <li>
                                        <a href="./alert.php">My Alert</a>
                                    </li>
                                    <li>
                                        <a href="./fovorite.php">My Favorites</a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <a href="{{ route('about-us') }}">About Us</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}">Faqs</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('contact.store') }}">Contact</a>
                    </li>
                </ul>
                <form class="search-form">
                    <!-- <input type="text" placeholder="Search for picture....">
                    <button type="submit"><i class="fas fa-search"></i></button> -->
                </form>
                <div class="search-bar d-md-none">
                    <a href="#0"><i class="fas fa-search"></i></a>
                </div>
                <div class="header-bar d-lg-none">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>
<!--============= Header Section Starts Here =============-->
