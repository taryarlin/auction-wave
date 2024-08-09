@extends('frontend.layouts.app')

@section('content')
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
                            <ul>
                                <li>Listing ID: {{ $product->listing_id }}</li>
                                <li>Item #: {{ $product->item_number }}</li>
                            </ul>
                        </div>
                        <ul class="price-table mb-30">
                            @if (auth()->guard('customer')->check())
                            @if ($product->customer)
                            <li>
                                <span class="details">Owner Name</span>
                                <h5 class="info">{{ $product->customer->name }}</h5>
                            </li>
                            <li>
                                <span class="details">Owner Email</span>
                                <h5 class="info">{{ $product->customer->email }}</h5>
                            </li>
                            <li>
                                <span class="details">Owner Phone</span>
                                <h5 class="info">{{ $product->customer->phone }}</h5>
                            </li>
                            <hr>
                            @endif
                            @endif
                            <li class="header">
                                <h5 class="current">Current Price</h5>
                                <h3 class="price">{{ number_format($product->current_bid) }} MMK</h3>
                            </li>

                            <li>
                                <span class="details">Buyer's Premium</span>
                                <h5 class="info">{{ $product->buyer_premium_percent }}%</h5>
                            </li>
                            <li>
                                <span class="details">Bid Increment</span>
                                <h5 class="info">{{ number_format($product->bid_increment) }} MMK</h5>
                            </li>
                            <li>
                                <span class="details">Latest Total Bid Price</span>
                                <h5 class="info">{{ number_format($product->current_bid + $product->bid_increment) }} MMK</h5>
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
                                        <input type="number" name="amount" placeholder="Enter you bid amount">
                                        <button type="submit" class="custom-button">Submit a bid</button>
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
                                <input type="number" name="amount" placeholder="Enter you bid amount" disabled>
                                <a href="{{ route('login') }}" class="custom-button">Login to bid</a>
                            </form>
                        </div>
                        @endif
                        <div class="buy-now-area">
                            <a href="#0" class="rating custom-button active border"><i class="fas fa-star"></i> Add to Wishlist</a>
                            <div class="share-area">
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product-sidebar-area">
                        <div class="product-single-sidebar mb-3">
                            <h6 class="title">This Auction Ends in:</h6>
                            <div class="countdown">
                                <div id="product_bid_counter" data-end-date="{{ \Carbon\Carbon::parse($product->end_datetime)->format('Y/m/d') }}"></div>
                            </div>
                            <div class="side-counter-area">
                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="{{ asset('assets/images/icon1.png') }}" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter">{{ $product->auctions->groupBy('id')->count() }}</span></h3>
                                        <p>Active Bidders</p>
                                    </div>
                                </div>

                                <div class="side-counter-item">
                                    <div class="thumb">
                                        <img src="{{ asset('assets/images/icon3.png') }}" alt="product">
                                    </div>
                                    <div class="content">
                                        <h3 class="count-title"><span class="counter">{{ $product->auctions->count() }}</span></h3>
                                        <p>Total Bids</p>
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
                            <div class="content">Description</div>
                        </a>
                    </li>
                    <li>
                        <a href="#delevery" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab2.png') }}" alt="product">
                            </div>
                            <div class="content">Delivery Options</div>
                        </a>
                    </li>
                    <li>
                        <a href="#history" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab3.png') }}" alt="product">
                            </div>
                            <div class="content">Bid History ({{ $product->auctions->count() }})</div>
                        </a>
                    </li>
                    <li>
                        <a href="#questions" data-toggle="tab">
                            <div class="thumb">
                                <img src="{{ asset('assets/images/tab4.png') }}" alt="product">
                            </div>
                            <div class="content">Questions </div>
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
                            <h5 class="title">Bid History</h5>
                            <div class="history-table-area">
                                <table class="history-table">
                                    <thead>
                                        <tr>
                                            <th>Bidder</th>
                                            <th>date</th>
                                            <th>since</th>
                                            <th>unit price</th>
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
                                                <td data-history="unit price">{{ number_format($auction->pivot->amount) }} MMK</td>
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
                    <h5 class="faq-head-title">Frequently Asked Questions</h5>
                    <div class="faq-wrapper">
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="{{ asset('assets/images/faq.png') }}" alt="css"><span class="title">How to start bidding?</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="{{ asset('assets/images/faq.png') }}" alt="css"><span class="title">Security Deposit / Bidding Power </span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="{{ asset('assets/images/faq.png') }}" alt="css"><span class="title">Delivery time to the destination port </span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="{{ asset('assets/images/faq.png') }}" alt="css"><span class="title">How to register to bid in an auction?</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="{{ asset('assets/images/faq.png') }}" alt="css"><span class="title">How will I know if my bid was successful?</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="{{ asset('assets/images/faq.png') }}" alt="css"><span class="title">What happens if I bid on the wrong lot?</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>All successful bidders can confirm their winning bid by checking the “Sbidu”. In addition, all successful bidders will receive an email notifying them of their winning bid after the auction closes.</p>
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
