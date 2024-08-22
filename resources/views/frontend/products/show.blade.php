@extends('frontend.layouts.app')

@section('content')
    @php
        $breadcrumb = [
            [
                'name' => 'Home',
                'route' => '/',
            ],
            [
                'name' => 'Auction',
                'route' => '',
            ],
        ];
    @endphp
    @include('frontend.layouts.hero_section')

    <section class="product-details padding-bottom mt--240 mt-lg--440">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2">
                    <div class="product-details-slider-top-wrapper">
                        <div class="product-details-sl owl-theme owl-carousel">
                            @forelse ($product->acsr_images as $image)
                                <img src="{{ $image }}" alt="product">
                            @empty
                                <img src="{{ asset('assets/images/no-product-image.png') }}" alt="product">
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-40-60-80">
                <div class="col-lg-8">
                    <div class="product-details-content">
                        <div class="product-details-header">
                            <h2 class="title">{{ $product->name }}</h2>
                            <!-- <ul>
                                <li>Listing ID: {{ $product->listing_id }}</li>
                                <li>Item #: {{ $product->item_number }}</li>
                            </ul> -->
                        </div>
                        <ul class="price-table mb-30">
                            @if (auth()->guard('customer')->check())
                                @if ($product->customer)
                                <li>
                                    <span class="details">ပိုင်ရှင်အမည် </span>
                                    <h5 class="info">{{ $product->customer->name }}</h5>
                                </li>
                                <li>
                                    <span class="details">ပိုင်ရှင် အီးမေးလ်</span>
                                    <h5 class="info">{{ $product->customer->email }}</h5>
                                </li>
                                <li>
                                    <span class="details">ပိုင်ရှင် ဖုန်းနံပါတ်</span>
                                    <h5 class="info">{{ $product->customer->phone }}</h5>
                                </li>
                                <hr>
                                @endif
                            @endif
                            <li class="header">
                                <h5 class="current">လက်ရှိစျေးနှုန်း</h5>
                                <h3 class="price">{{ number_format($product->current_bid) }} ကျပ်</h3>
                            </li>
                            <li>
                                <span class="details">Buyer's Premium</span>
                                <h5 class="info">{{ $product->buyer_premium_percent }}%</h5>
                            </li>
                            <li>
                                <span class="details">လေလံတိုးနှုန်း</span>
                                <h5 class="info">{{ $product->bid_increment }} ကျပ်</h5>
                            </li>
                            <li>
                                <span class="details">နောက်ဆုံးလေလံပမာဏ</span>
                                <h5 class="info">{{ $product->current_bid + $product->bid_increment }} ကျပ်</h5>
                            </li>
                        </ul>
                        @if (auth()->guard('customer')->check())
                            @if (auth()->guard('customer')->user()->id != $product->customer_id)
                                @if ($product->isExpired())
                                <div class="product-bid-area">
                                    <form action="{{ route('make-bid') }}" method="POST" class="product-bid-form">
                                        @csrf
                                        <div class="search-icon">
                                            <img src="{{ asset('assets/images/search-icon.png') }}" alt="product">
                                        </div>
                                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                                        <input type="number" name="amount" placeholder="လေလံပမာဏ">
                                        <button type="submit" class="custom-button">လေလံပမာဏဖြည့်ပါ</button>
                                    </form>
                                </div>
                                @endif
                            @endif
                        @else
                        <div class="product-bid-area">
                            <form class="product-bid-form">
                                <div class="search-icon">
                                    <img src="{{ asset('assets/images/search-icon.png') }}" alt="product">
                                </div>
                                <input type="number" name="amount" placeholder="လေလံပမာဏ ဖြည့်ပါ" disabled>
                                <a href="{{ route('login') }}" class="custom-button">လေလံဆွဲရန် လော့ဂ်အင်ဝင်ပါ</a>
                            </form>
                        </div>
                        @endif
                        <div class="buy-now-area">
                            <!-- <a href="#0" class="rating custom-button active border"><i class="fas fa-star"></i> Add to Wishlist</a> -->
                            <!-- <div class="share-area">
                                <span>Share to:</span>
                                <ul>
                                    <li>
                                        <a href="#0"><i class="fab fa-facebook-f"></i></a>
                                    </li>
                                    <li>
                                        <a href="#0"><i class="fab fa-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#0"><i class="fab fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="#0"><i class="fab fa-instagram"></i></a>
                                    </li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-sidebar-area">
                        <div class="product-single-sidebar mb-3">
                            <h6 class="title">လေလံပြီးဆုံးချိန်:</h6>
                            <div class="countdown">
                                <div id="product_bid_counter" data-end-date="{{ $product->end_datetime }}"></div>
                            </div>
                            <div class="side-counter-area">
                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="{{ asset('assets/images/icon1.png') }}" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter">{{ $product->auctions->groupBy('id')->count() }}</span></h3>
                                        <p>လက်ရှိလေလံဆွဲနေသူများ</p>
                                    </div>
                                </div>

                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="{{ asset('assets/images/icon3.png') }}" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter">{{ $product->auctions->count() }}</span></h3>
                                        <p>လေလံစုစုပေါင်း</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <a href="#0" class="cart-link">View Shipping, Payment & Auction Policies</a> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="product-tab-menu-area mb-40-60 mt-70-100">
            <div class="container">
                <ul class="product-tab-menu nav nav-tabs">
                    <li>
                        <a href="#details" class="active" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab1.png') }}" alt="product">
                            </div>
                            <div class="content">ဖော်ပြချက်</div>
                        </a>
                    </li>
                    <li>
                        <a href="#delevery" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab2.png') }}" alt="product">
                            </div>
                            <div class="content">ပို့ဆောင်ခြင်း</div>
                        </a>
                    </li>
                    <li>
                        <a href="#history" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab3.png') }}" alt="product">
                            </div>
                            <div class="content">လေလံမှတ်တမ်း ({{ $product->auctions->count() }})</div>
                        </a>
                    </li>
                    <li>
                        <a href="#questions" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab4.png') }}" alt="product">
                            </div>
                            <div class="content">မေးခွန်းများ </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="container">
            <div class="tab-content">
                <div class="tab-pane fade show active" id="details">
                    <div class="tab-details-content">
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="tab-pane fade show" id="delevery">
                    <div class="shipping-wrapper">
                        {!! $product->delivery_option !!}
                    </div>
                </div>

                <div class="tab-pane fade show" id="history">
                    <div class="history-wrapper">
                        <div class="item">
                            <h5 class="title">လေလံမှတ်တမ်း</h5>
                            <div class="history-table-area">
                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th>လေလံဆွဲသူ</th>
                                            <th>ရက်စွဲ</th>
                                            <th>အချိန်</th>
                                            <th>ငွေကြေးပမာဏ</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($auctions as $auction)
                                            <tr>
                                                <td data-history="bidder">
                                                    <div class="user-info">
                                                        <div class="content">
                                                            {{ $auction->name }}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td data-history="date">{{ $auction->pivot->created_at }}</td>
                                                <td data-history="time">{{ $auction->pivot->created_at->diffForHumans() }}</td>
                                                <td data-history="unit price">{{ number_format($auction->pivot->amount) }} ကျပ်</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center mb-3 mt-4">
                                    {{ $auctions->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="tab-pane fade show" id="questions">
                    <h5 class="faq-head-title">အမြဲမေးတတ်သောမေးခွန်းများ</h5>
                    <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">လေလံဆွဲခြင်း ဘယ်လိုစတင်ရမလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>အသုံးပြုသူသည် စာရင်းပေးသွင်းထားသော အကောင့်ရှိလျှင် လေလံဆွဲခြင်းပြုလုပ်နိုင်ပါသည်။ မိမိလိုချင်သော ပစ္စည်းအား ဝင်ရောက်ကြည့်ရှုကာ လေလံဆွဲခြင်း စတင်နိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">လေလံတိုးခြင်းကို ပယ်ဖျက်နိုင်ပါသလား။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>လေလံတိုးခြင်းကို မပယ်ဖျက်နိုင်ပါ။ လေလံတိုးထားသော ပမာဏကို ဖြည့်သွင်းပြီးပါက ပယ်ဖျက်၍မရနိုင်ပါ။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">လေလံဆွဲသူတွေ ဘယ်လိုစာရင်းပေးသွင်းနိုင်သလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>စာရင်းပေးသွင်းခြင်းမှတဆင့် မိမိ၏ကိုယ်ရေးအချက်အလက်များ ပြည့်စုံစွာဖြည့်၍ စာရင်းပေးသွင်းနိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">အွန်လိုင်းလေလံ စနစ်ကို မည်သူမဆို ကြည့်ရှုနိုင်သလား။ </span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>မည်သူမဆိုကြည့်ရှုနိုင်ပါသည်။ သို့သော် စာရင်းပေးသွင်းထားသော အကောင့်ရှိမှသာ လေလံဆွဲခြင်းပြုလုပ်နိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">အွန်လိုင်းလေလံစနစ်ရဲ့ ရည်ရွက်ချက်က ဘာလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>ဒစ်ဂျစ်တယ် စျေးကွက်စနစ်အား ပိုမိုအဆင့်မြင့်စေရန်နှင့် အင်တာနက်ရရှိသော နေရာများမှတဆင့် မတူညီသောပစ္စည်းများအား တစ်နေရာထဲတွင် အလွယ်တကူရရှိနိုင်စေရန် ရည်ရွယ်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">အွန်လိုင်းလေလံစနစ်ရဲ့ ကောင်းကျိုးကဘာလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>နေရာအခက်အခဲပြသနာများ ဖြေရှင်းပေးနိုင်ခြင်း၊ ၂၄နာရီ ဝန်ဆောင်မှု ရရှိနိုင်ခြင်း၊ ပစ္စည်းတစ်ခုခြင်းစီ၏ အချက်အလက်များအားသေချာကြည့်ရှုနိုင်ခြင်း တို့ပဲဖြစ်ပါတယ်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">မည်သူသည် လေလံဆွဲထားသောပစ္စည်းအား ရရှိနိုင်မည်နည်း။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>လေလံတိုးနှုန်းနှင့်အတူ အမြင့်ဆုံးစျေးပေးနိုင်သောသူသည် ပစ္စည်းအားရရှိမည်ဖြစ်သည်။ သို့မဟုတ် သတ်မှတ်ထားသော စျေးအတိုင်း ဝယ်ယူနိုင်လျှင် ပစ္စည်းအား ပိုင်ဆိုင်မည်ဖြစ်သည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">လေလံတိုးခြင်းအောင်မြင်သော ပစ္စည်းအား မည်ကဲ့သို့ပို့ဆောင်ပေးသနည်း။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>ပို့ဆောင်ပေးရန် ရွေးချယ်မှုတွင် ဖော်ပြထားပြီး အနည်းဆုံးအချိန် ၁ပတ်မှ ၂ပတ်ခန့် ကြာမြင့်နိုင်ပါသည်။ အိမ်အရောက် ငွေချေစနစ် သို့မဟုတ် ဆိုင်တွင် လာရောက်ထုတ်ယူနိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <!-- <img src="./assets/images/faq.png" alt="css"> -->
                                <span class="title">Buyer premium percent ဆိုတာဘာလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>Buyer premium percentဆိုတာ လေလံအောင်ထားသော ပစ္စည်းတန်ဖိုး၏ ရာခိုင်နှုန်းအလိုက် ပေးဆောင်ရသည်။ ဝယ်ယူသူသည် ပစ္စည်း၏တန်ဖိုးနှင့်အတူ Buyer premium percent အား ပေးချေရပါမည်။</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(function() {
            var owl = $('.product-details-sl');
            owl.owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true
            });

            if ($("#product_bid_counter").length) {
                // If you need specific date then comment out 1 and comment in 2
                // let endDate = "2020/03/20"; //This is 1
                // let endDate = (new Date().getFullYear()) + '/' + (new Date().getMonth() + 1) + '/' + (new Date().getDate() + 1); //This is 2

                let endDate = $("#product_bid_counter").data('end-date');
                // 2024/7/30


                let counterElement = document.querySelector("#product_bid_counter");
                let myCountDown = new ysCountDown(endDate, function(remaining, finished) {
                    let message = "";
                    if (finished) {
                        message = "Expired";
                    } else {
                        var re_days = remaining.totalDays;
                        var re_hours = remaining.hours;
                        message += re_days + "d  : ";
                        message += re_hours + "h  : ";
                        message += remaining.minutes + "m  : ";
                        message += remaining.seconds + "s";
                    }
                    counterElement.textContent = message;
                });
            }
        })
    </script>
@endpush
