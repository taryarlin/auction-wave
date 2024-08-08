<footer class="bg_img padding-top oh" data-background="{{ asset('assets/images/footer-bg.jpg') }}" style="background-image: url({{ asset('assets/images/footer-bg.jpg') }});">
    <div class="footer-top-shape">
        <img src="{{ asset('assets/images/footer-top-shape.png') }}" alt="css">
    </div>
    <div class="anime-wrapper">
        <div class="anime-1 plus-anime">
            <img src="{{ asset('assets/images/p1.png') }}" alt="footer">
        </div>
        <div class="anime-2 plus-anime">
            <img src="{{ asset('assets/images/p2.png') }}" alt="footer">
        </div>
        <div class="anime-3 plus-anime">
            <img src="{{ asset('assets/images/p3.png') }}" alt="footer">
        </div>
        <div class="anime-5 zigzag">
            <img src="{{ asset('assets/images/c2.png') }}" alt="footer">
        </div>
        <div class="anime-6 zigzag">
            <img src="{{ asset('assets/images/c3.png') }}" alt="footer">
        </div>
        <div class="anime-7 zigzag">
            <img src="{{ asset('assets/images/c4.png') }}" alt="footer">
        </div>
    </div>
    <div class="newslater-wrapper">
        <div class="container">
            <div class="newslater-area">
                <div class="newslater-thumb">
                    <img src="{{ asset('assets/images/newslater.png') }}" alt="footer">
                </div>
                <div class="newslater-content">
                    <div class="section-header left-style mb-low" data-aos="fade-down" data-aos-duration="1100">
                        <h5 class="cate">ကျွန်ုပ်တို့ရဲ့ နောက်ဆုံးရ သတင်းတွေကို ပုံမှန် ကျွန်ုပ်တို့၏စနစ်တွင် စစ်ဆေးပြီး နေ့စဉ် နေ့တိုင်း အဆက်မပြတ် ရယူနိုင်ပါသည်။
                        </h5>
                        <!-- <p>ကျွန်ုပ်တို့ရဲ့ နောက်ဆုံးရ သတင်းတွေကို ပုံမှန် ကျွန်ုပ်တို့၏စနစ်တွင် စစ်ဆေးပြီး နေ့စဉ် နေ့တိုင်း အဆက်မပြတ် ရယူနိုင်ပါသည်။</p> -->
                    </div>
                    <form class="subscribe-form">
                        <a href="{{ route('contact-us') }}" class="custom-button yellow btn-large" data-aos="zoom-out-up" data-aos-duration="1500">Contact</a>
                        <!-- <input type="text" placeholder="Enter Your Email" name="email">
                        <button type="submit" class="custom-button">Contact us</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-top padding-bottom padding-top">
        <div class="container">
            <div class="row mb--60">
                <div class="col-sm-6 col-lg-3" data-aos="fade-down" data-aos-duration="1000">
                    <div class="footer-widget widget-links">
                        <h5 class="title">Auction Categories</h5>
                        <ul class="links-list">
                            @php
                                $categories = App\Models\Category::limit(8)->get(['id', 'name']);
                            @endphp
                            @foreach ($categories as $key => $category)
                            <li>
                                <a href="{{ route('product.index') }}">{{ $category->name }}</a>
                            </li>
                            @if (($key + 1) == count($categories))
                            <li>
                                <a href="{{ route('product.index') }}">See all</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-down" data-aos-duration="1300">
                    <div class="footer-widget widget-links">
                        <h5 class="title">About Us</h5>
                        <ul class="links-list">
                            <li>
                                <a href="{{ route('about-us') }}">About us</a>
                            </li>
                            <li>
                                <a href="#0">Help</a>
                            </li>
                            <li>
                                <a href="#0">Affiliates</a>
                            </li>
                            <li>
                                <a href="#0">Jobs</a>
                            </li>
                            <li>
                                <a href="#0">Press</a>
                            </li>
                            <li>
                                <a href="#0">Our blog</a>
                            </li>
                            <li>
                                <a href="#0">Collectors' portal</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-down" data-aos-duration="1600">
                    <div class="footer-widget widget-links">
                        <h5 class="title">We're Here to Help</h5>
                        <ul class="links-list">
                            <li>
                                <a href="#0">Your Account</a>
                            </li>
                            <li>
                                <a href="#0">Safe and Secure</a>
                            </li>
                            <li>
                                <a href="#0">Shipping Information</a>
                            </li>
                            <li>
                                <a href="{{ route('contact-us') }}">Contact Us</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}">Help & FAQ</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-down" data-aos-duration="1800">
                    <div class="footer-widget widget-follow">
                        <h5 class="title">Follow Us</h5>
                        <ul class="links-list">
                            <li>
                                <a href="#0"><i class="fas fa-phone-alt"></i>(646) 663-4575</a>
                            </li>
                            <li>
                                <a href="#0"><i class="fas fa-blender-phone"></i>(646) 968-0608</a>
                            </li>
                            <li>
                                <a href="#0"><i class="fas fa-envelope-open-text"></i><span class="__cf_email__" data-cfemail="9ff7faf3efdffaf1f8f0ebf7faf2fab1fcf0f2">[email&#160;protected]</span></a>
                            </li>
                            <li>
                                <a href="#0"><i class="fas fa-location-arrow"></i>1201 Broadway Suite</a>
                            </li>
                        </ul>
                        <ul class="social-icons">
                            <li>
                                <a href="#0" class="active"><i class="fab fa-facebook-f"></i></a>
                            </li>
                            <li>
                                <a href="#0"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#0"><i class="fab fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#0"><i class="fab fa-linkedin-in"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="copyright-area">
                <div class="footer-bottom-wrapper">
                    <!-- <div class="logo">
                        <a href="index.html"><img src="{{ asset('assets/images/pg-logo.png') }}" alt="logo"></a>
                    </div>
                    <ul class="gateway-area">
                        <li>
                            <a href="#0"><img src="{{ asset('assets/images/paypal.png') }}" alt="footer"></a>
                        </li>
                        <li>
                            <a href="#0"><img src="{{ asset('assets/images/visa.png') }}" alt="footer"></a>
                        </li>
                        <li>
                            <a href="#0"><img src="{{ asset('assets/images/discover.png') }}" alt="footer"></a>
                        </li>
                        <li>
                            <a href="#0"><img src="{{ asset('assets/images/mastercard.png') }}" alt="footer"></a>
                        </li>
                    </ul> -->
                    <div class="copyright">
                        <p>&copy; Copyright 2024
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
