<footer class="bg_img padding-top oh" data-background="{{ asset('assets/images/footer-bg.jpg') }}" style="background-image: url('{{ asset("assets/images/footer-bg.jpg") }}');">
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
                        <a href="{{ route('contact.store') }}" class="custom-button yellow btn-large" data-aos="zoom-out-up" data-aos-duration="1500">ဆက်သွယ်ရန်</a>
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
                <div class="col-sm-6 col-lg-2" data-aos="fade-down" data-aos-duration="1000">
                    <div class="footer-widget widget-links">
                        <h5 class="title"><p>အွန်လိုင်းလေလံစနစ်</h5>
                        <div class="logo">
                            <a href="/">
                                <img src="{{ asset('assets/images/pg-logo.png') }}" alt="logo" width="300" height="100">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-down" data-aos-duration="1300">
                    <div class="footer-widget widget-links">
                       <h5 class="title">လေလံအမျိုးအစားများ</h5>
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
                                <a href="{{ route('product.index') }}">အားလုံးကိုကြည့်ရန်</a>
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-4" data-aos="fade-down" data-aos-duration="1300">
                    <div class="footer-widget widget-links">
                        <h5 class="title">ဆက်သွယ်ရန်</h5>
                        <ul class="links-list">
                            <!-- <li>
                                <a href="{{ route('about-us') }}">About us</a>
                            </li> -->
                            <!-- <li>
                                <a href="{{ route('about-us') }}#help">
                                    <i class="fas fa-book"></i>User guide
                                </a>
                            </li> -->
                            <li>
                                <a href="tel:+959400752917"><i class="fas fa-phone-alt"></i>၀၉-၄၀၀၇၅၂၉၁၇</a>
                            </li>
                            <li>
                                <a href="tel:+959 676598603"><i class="fas fa-blender-phone"></i>၀၉-၆၇၆၅၉၈၆၀၃</a>
                            </li>
                            <li>
                                <a href="mailto:khinekhinesoe@ucsh.edu.mm"><i class="fas fa-envelope-open-text"></i>khinekhinesoe@ucsh.edu.mm</a>
                            </li>
                            <li>
                                <a href="mailto:thaesuaye@ucsh.edu.mm"><i class="fas fa-envelope-open-text"></i>thaesuaye@ucsh.edu.mm</a>
                            </li>
                            <li>
                                <a href="#0"><i class="fas fa-location-arrow"></i>
                                <abbr title="University of Computer Studies, Hinthada" class="text-decoration-none">ကွန်ပျူတာတက္ကသိုလ်၊ဟင်္သာတ။</abbr>
                                </a>
                            </li>
                        </ul>
                        <ul class="social-icons">
                            <li>
                                <a href="https://www.facebook.com/">
                                    <abbr title="Facebook">
                                        <i class="fab fa-facebook-f"></i>
                                    </abbr>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/">
                                    <abbr title="Twitter">
                                        <i class="fab fa-twitter"></i>
                                    </abbr>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/">
                                    <abbr title="Instagram">
                                        <i class="fab fa-instagram"></i>
                                    </abbr>
                                </a>
                            </li>
                            <li>
                                <a href="https://mm.linkedin.com/">
                                    <abbr title="Linked In">
                                        <i class="fab fa-linkedin-in"></i>
                                    </abbr>
                                </a>
                            </li>
                            <li>
                                <a href="http://lms.ucsh.edu.mm/">
                                    <abbr title="ucsh.edu.mm">
                                        <i class="fa fa-link"></i>
                                    </abbr>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-3" data-aos="fade-down" data-aos-duration="1600">
                    <div class="footer-widget widget-links">
                        <h5 class="title">အကူအညီရယူရန်</h5>
                        <ul class="links-list">
                            <li>
                                <a href="{{ route('about-us') }}#help">
                                အသုံးပြုသူလမ်းညွှန်
                                </a>
                            </li>
                            <!-- <li>
                                <a href="{{ route('register') }}">သင့်အကောင့်</a>
                            </li> -->
                            <li>
                                <a href="{{ route('contact.store') }}">ကျွန်ုပ်တိုကိုဆက်သွယ်ရန်</a>
                            </li>
                            <li>
                                <a href="{{ route('faq') }}">မေးလေ့ရှိသောမေးခွန်းများ</a>
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
                <div class="copyright">
                        <p>ကွန်ပျူတာတက္ကသိုလ်၊ဟင်္သာတ</p>
                    </div>
                    <div class="copyright">
                        <p>&copy; မူပိုင်ခွင့် ၂၀၂၄ </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>