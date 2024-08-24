@extends('frontend.layouts.app')

@section('content')
    <!--============= Banner Section Starts Here =============-->
    <section class="banner-section bg_img" data-background="{{ asset('assets/images/banner-bg.png') }}" style="background-image: url({{ asset('assets/images/banner-bg.png') }}); ">
        <div class="container">
            <div class="row align-items-center justify-content-between">
                <div class="col-lg-6 col-xl-6">
                    <div class="banner-content cl-white">
                        <h5 class="cate" data-aos="fade-down" data-aos-duration="1000">အွန်လိုင်းလေလံစနစ်</h5>
                        <!-- <h3 class="title" data-aos="zoom-out-up" data-aos-duration="1200"><span class="d-xl-block">သင့်ရဲ့ ကြွယ်ဝမှုကို </span> လေလံပွဲတွင် ပြသလေ့ရှိပါသလား?</h3> -->
                        <p class="pras" data-aos="zoom-out-down" data-aos-duration="1300">
                        အွန်လိုင်းလေလံစနစ်တွင်ပါဝင်ပြီး ဒစ်ဂျစ်တယ်စျေးကွက်အား မြှင့်တင်နိုင်ရန် မတူညီသော ပစ္စည်းများအား ယခုပဲ ဝင်ရောက်ကြည့်ရှု၍ လေလံဆွဲနိုင်ပါသည်။
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
                            <p>လေလံအမျိုးအစားများ- {{ $category->name }}</p> 
                        </div>
                    </div>
                    <a href="{{ route('product.index') }}" class="normal-button">အားလုံးကိုကြည့်ရန်</a>
                </div>
                <div class="row justify-content-center mb-30-none">
                    @foreach ($category->products as $product)
                        <div class="col-sm-10 col-md-6 col-lg-4">
                            @include('frontend.products._partials.auction_card')
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
                <!-- <span class="cate">Closing Within 24 Hours</span> -->
                <h2 class="title" data-aos="fade-down" data-aos-duration="1500">လူကြိုက်များသောလေလံပစ္စည်းများ</h2>
                <p>ပစ္စည်းများအား ယခုပဲလေလံဆွဲပါ။ ကျွန်ုပ်တို့၏ လုပ်ငန်းစဥ်များသည် ရိုးရှင်းသည်။ ထိရောက်ပြီး ပွင့်လင်းမြင်သာမှုရှိသည်။
                </p>
            </div>
            <div class="popular-auction-wrapper">
                <div class="row justify-content-center mb-30-none">
                    @foreach ($popular_products as $popular_product)
                        <div class="col-lg-6">
                            <div class="auction-item-3" data-aos="zoom-out-up" data-aos-duration="1500">
                                <div class="auction-thumb">
                                    <a href="{{ route('product.detail', $popular_product->id) }}"><img src="{{ $popular_product->acsr_images ? $popular_product->acsr_images[0] : asset('assets/images/no-product-image.png') }}" class="" style="width: 100%; height: 200px; object-fit: cover" alt="product"></a>
                                    <a href="{{ route('product.detail', $popular_product->id) }}" class="bid"><i class="flaticon-auction"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="{{ route('product.detail', $popular_product->id) }}">{{ $popular_product->name }}</a>
                                    </h6>
                                    <div class="bid-amount">
                                        <div class="icon">
                                            <i class="flaticon-auction"></i>
                                        </div>
                                        <div class="amount-content">
                                            <div class="current">လက်ရှိလေလံဈေးနှုန်း</div>
                                            <div class="amount">{{ $popular_product->current_bid }} ကျပ်</div>
                                        </div>
                                    </div>
                                    <div class="bids-area">
                                    စုစုပေါင်းလေလံ : <span class="total-bids">{{ $popular_product->auctions->count() }} ခု</span>
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
                <a href="{{ route('register') }}" class="custom-button white">စာရင်းသွင်းပါ</a>
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
@endsection
