@extends('frontend.layouts.app')

@section('content')
    @php
        $breadcrumb = [
            [
                'name' => 'Home',
                'route' => '/'
            ],
            [
                'name' => 'Profile',
                'route' => '/profile'
            ],
            [
                'name' => 'Winning Bids',
                'route' => ''
            ]
        ];
    @endphp
    @include('frontend.layouts.hero_section')

    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                @include('profile.partials.sidebar', ['current_route' => request()->routeIs('profile.winning-bid.*')])
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Winning Bids</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30-none justify-content-center">
                        @foreach ($products as $product)
                        <div class="col-sm-12 col-md-6 col-lg-6">
                            <div class="auction-item-2" data-aos="zoom-out-up" data-aos-duration="1000">
                                <div class="auction-thumb">
                                    <a href="{{ route('product.detail', $product->id) }}"><img src="{{ $product->acsr_images ? $product->acsr_images[0] : asset('assets/images/no-product-image.png') }}" class="" style="width: 100%; height: 300px; object-fit: cover" alt="product"></a>
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
                                                <div class="amount">{{ number_format($product->starting_price) }} MMK</div>
                                            </div>
                                        </div>
                                        <div class="bid-amount">
                                            <div class="icon">
                                                <i class="flaticon-money"></i>
                                            </div>
                                            <div class="amount-content">
                                                <div class="current">Buy Now</div>
                                                <div class="amount">{{ number_format($product->fixed_price) }} MMK</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter1"></div>
                                        </div>
                                        <span class="total-bids">{{ $product->auctions()->count() }} Bids</span>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('product.detail', $product->id) }}" class="custom-button">Submit a bid</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
