@extends('frontend.layouts.app')

@section('content')
    <!--============= Banner Section Starts Here =============-->
    <section class="banner-section bg_img" data-background="{{ asset('assets/images/banner-bg.png') }}" style="background-image: url({{ asset('assets/images/banner-bg.png') }}); ">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner-content cl-white">
                        <h5 class="cate" data-aos="fade-down" data-aos-duration="1000">Online Auction System</h5>
                        <!-- <h3 class="title" data-aos="zoom-out-up" data-aos-duration="1200"><span class="d-xl-block">သင့်ရဲ့ ကြွယ်ဝမှုကို </span> လေလံပွဲတွင် ပြသလေ့ရှိပါသလား?</h3> -->
                        <p class="pras" data-aos="zoom-out-down" data-aos-duration="1300">
                        အွန်လိုင်းလေလံစနစ်တွင်ပါဝင်ပြီး ဒစ်ဂျစ်တယ်စျေးကွက်အား မြှင့်တင်နိုင်ရန် မတူညီသော ပစ္စည်းများအား ယခုပဲ ဝင်ရောက်ကြည့်ရှုလိုက်ပါ။
                        </p>
                        <a href="{{ route('register') }}" class="custom-button yellow btn-large" data-aos="zoom-out-up" data-aos-duration="1500">စတင်လိုက်ပါ</a>
                    </div>
                </div>
                <div class="d-none d-lg-block col-lg-6" data-aos="fade-right" data-aos-duration="1200">
                    <div class="banner-thumb-2">
                        <img src="{{ asset('assets/images/banner.png') }}" alt="banner">
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-shape d-none d-lg-block">
            <img src="{{ asset('assets/images/banner-shape.png') }}" alt="css">
        </div>
    </section>
    <!--============= Banner Section Ends Here =============-->
    <!-- home page -->

    <!--============= Art Auction Section Starts Here =============-->
    @foreach ($categories as $key => $category)
        <section class="car-auction-section padding-bottom padding-top oh">
            <div class="container">
                <div class="section-header-3" data-aos="zoom-out-down" data-aos-duration="1200">
                    <div class="left">
                        <div class="thumb">
                            <img src="{{ $category->acsr_image }}" alt="header-icons">
                        </div>
                        <div class="title-area">
                            <h2 class="title">{{ $category->name }}</h2>
                            <p>We offer affordable {{ $category->name }}</p>
                        </div>
                    </div>
                    <a href="{{ route('product.index') }}" class="normal-button">View All</a>
                </div>
                <div class="row justify-content-center mb-30-none">
                    @foreach ($category->products as $product)
                        <div class="col-sm-10 col-md-6 col-lg-4">
                            <div class="auction-item-2" data-aos="zoom-out-up" data-aos-duration="2200">
                                <div class="auction-thumb">
                                    <a href="{{ route('product.detail', $product->id) }}"><img src="{{ $product->acsr_images ? $product->acsr_images[0] : asset('assets/images/no-product-image.png') }}" class="" style="width: 100%; height: 300px; object-fit: cover" alt="product"></a>
                                    <a href="#0" class="rating"><i class="far fa-star"></i></a>
                                    <a href="{{ route('product.detail', $product->id) }}" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <div class="bid-area">
                                        <div class="bid-amount">
                                            <div class="icon">
                                                <i class="flaticon-auction"></i>
                                            </div>
                                            <div class="amount-content">
                                                <div class="current">Current Bid</div>
                                                <div class="amount">{{ $product->auctions->first()->pivot->amount ?? $product->starting_price }} MMK</div>
                                            </div>
                                        </div>
                                        <div class="bid-amount">
                                            <div class="icon">
                                                <i class="flaticon-money"></i>
                                            </div>
                                            <div class="amount-content">
                                                <div class="current">Buy Now</div>
                                                <div class="amount">{{ $product->fixed_price }} MMK</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter26"></div>
                                        </div>
                                        <span class="total-bids">{{ $product->auctions->count() }} Bids</span>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('product.detail', $product->id) }}" class="custom-button">Submit a bid</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endforeach
    <!--============= Art Auction Section Ends Here =============-->

    <!--============= Popular Auction Section Starts Here =============-->
    <section class="popular-auction padding-top pos-rel" style="margin-bottom: 60px;">
        <div class="popular-bg bg_img" data-background="{{ asset('assets/images/popular-bg.png') }}"></div>
        <div class="container">
            <div class="section-header cl-white" data-aos="fade-down" data-aos-duration="1000">
                <span class="cate">Closing Within 24 Hours</span>
                <h2 class="title" data-aos="fade-down" data-aos-duration="1500">Popular Auctions</h2>
                <p>Bid and win great deals,Our auction process is simple, efficient, and transparent.</p>
            </div>
            <div class="popular-auction-wrapper">
                <div class="row justify-content-center mb-30-none">
                    @foreach ($popular_products as $popular_product)
                        <div class="col-lg-6">
                            <div class="auction-item-3" data-aos="zoom-out-up" data-aos-duration="1500">
                                <div class="auction-thumb">
                                    <a href="{{ route('product.detail', $product->id) }}"><img src="{{ $product->acsr_images[0] }}" alt="popular"></a>
                                    <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">Current Bid</div>
                                            <div class="amount">{{ $product->current_bid }} MMK</div>
                                        </div>
                                    </div>
                                    <div class="bids-area">
                                        Total Bids : <span class="total-bids">{{ $product->auctions->count() }} Bids</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!--============= Popular Auction Section Ends Here =============-->

    <!--============= Call In Section Starts Here =============-->
    <section class="call-in-section pt-max-xl-0">
        <div class="container">
            <div class="call-wrapper cl-white bg_img" data-background="{{ asset('assets/images/call-bg.png') }}" style="background-image: url({{ asset('assets/images/call-bg.png') }});">
                <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                    <h3 class="title">အခမဲ့စာရင်းသွင်းပြီး ယခုပဲ လေလံဆွဲခြင်း စတင်ပါ!</h3>
                    <p>ပစ္စည်းအမျိုးအစားများစွာအား ကြည့်ရှုနိုင်ပါတယ်။</p>
                </div>
                <a href="{{ route('register') }}" class="custom-button white">Register</a>
            </div>
        </div>
    </section>
    <!--============= Call In Section Ends Here =============-->
    <!--============= How Section Starts Here =============-->
    <section class="how-section padding-top">
        <div class="container">
            <div class="how-wrapper section-bg">
                <div class="section-header text-lg-left" data-aos="zoom-out-up" data-aos-duration="1200">
                    <h2 class="title">ဘယ်လို အလုပ် လုပ်သလဲ ?</h2>
                    <p>လွယ်ကူသော အဆင့် ၃ ဆင့်</p> 
                    <p><a href="{{ route('about-us') }}">အသေးစိတ်အချက်အလက်များအတွက်</a></p>
                </div>
                <div class="row justify-content-center mb--40">
                    <div class="col-md-6 col-lg-4">
                        <div class="how-item">
                            <div class="how-thumb" data-aos="zoom-out-up" data-aos-duration="1000">
                                <img src="{{ asset('assets/images/how1.png') }}" alt="how">
                            </div>
                            <div class="how-content" data-aos="zoom-out-up" data-aos-duration="1200">
                                <h4 class="title">စာရင်းပေးသွင်းပါ</h4>
                                <p>Credit Card မလိုအပ်ပါ</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="how-item">
                            <div class="how-thumb" data-aos="zoom-out-up" data-aos-duration="1200">
                                <img src="{{ asset('assets/images/how2.png') }}" alt="how">
                            </div>
                            <div class="how-content" data-aos="zoom-out-up" data-aos-duration="1400">
                                <h4 class="title">လေလံဆွဲပါ</h4>
                                <p>လေလံဆွဲခြင်းသည် အခမဲ့ဖြစ်ပြီး အနိုင်ရရှိမှသာ ငွေပေးချေရန်လိုအပ်ပါတယ်</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="how-item">
                            <div class="how-thumb" data-aos="zoom-out-up" data-aos-duration="1400">
                                <img src="{{ asset('assets/images/how3.png') }}" alt="how">
                            </div>
                            <div class="how-content" data-aos="zoom-out-up" data-aos-duration="1600">
                                <h4 class="title">လေလံအောင်မြင်ခြင်း</h4>
                                <p>ပျော်ရွှင်ပြီး စိတ်လှုပ်ရှားစရာ ကောင်းပါတယ်</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--============= How Section Ends Here =============-->
    <!--============= Client Section Starts Here =============-->
    <!-- <section class="client-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                <h2 class="title">Don’t just take our word for it!</h2>
                <p>Our hard work is paying off. Great reviews from amazing customers.</p>
            </div>
            <div class="m--10">
                <div class="client-slider owl-theme owl-carousel">
                <div class="client-slider owl-theme owl-carousel">
                    <div class="client-item">
                        <div class="client-content">
                            <p>I can't stop bidding! It's a great way to spend some time and I want everything on Sbidu.</p>
                        </div>
                        <div class="client-author">
                            <div class="thumb">
                                <a href="#0">
                                    <img src="{{ asset('assets/images/client01.png') }}" alt="client">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#0">Alexis Moore</a></h6>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="client-item">
                        <div class="client-content">
                            <p>I came I saw I won. Love what I have won, and will try to win something else.</p>
                        </div>
                        <div class="client-author">
                            <div class="thumb">
                                <a href="#0">
                                    <img src="{{ asset('assets/images/client02.png') }}" alt="client">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#0">Darin Griffin</a></h6>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="client-item">
                        <div class="client-content">
                            <p>This was my first time, but it was exciting. I will try it again. Thank you so much.</p>
                        </div>
                        <div class="client-author">
                            <div class="thumb">
                                <a href="#0">
                                    <img src="{{ asset('assets/images/client03.png') }}" alt="client">
                                </a>
                            </div>
                            <div class="content">
                                <h6 class="title"><a href="#0">Tom Powell</a></h6>
                                <div class="ratings">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> -->
    <!--============= Client Section Ends Here =============-->
@endsection
