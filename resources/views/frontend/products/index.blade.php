@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="featured-auction-section padding-bottom mt--240 mt-lg--440 pos-rel">
        <div class="container">
            <div class="section-header cl-white mw-100 left-style">
                <h3 class="title">Bid on These Featured Auctions!</h3>
            </div>
            <div class="row justify-content-center mb-30-none">
                @foreach ($products as $product)
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <div class="auction-item-2" data-aos="zoom-out-up" data-aos-duration="1000">
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
                                        <div class="amount">{{ $product->starting_price }} MMK</div>
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
    </section>

    {{-- <div class="product-auction padding-bottom">
        <div class="container">

            <div class="row mb-30-none justify-content-center">
                @foreach ($products as $product)
                <div class="col-sm-10 col-md-6 col-lg-4">
                    <div class="auction-item-2" data-aos="zoom-out-up" data-aos-duration="1000">
                        <div class="auction-thumb">
                            <a href="./details.php"><img src="./assets/images/art2.png" alt="product"></a>
                            <a href="#0" class="rating"><i class="far fa-star"></i></a>
                            <a href="#0" class="bid"><i class="flaticon-auction"></i></a>
                        </div>
                        <div class="auction-content">
                            <h6 class="title">
                                <a href="#0">{{ $product->name }}</a>
                            </h6>
                            <div class="bid-area">
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-auction"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Current Bid</div>
                                        <div class="amount">${{ $product->starting_price }}</div>
                                    </div>
                                </div>
                                <div class="bid-amount">
                                    <div class="icon">
                                        <i class="flaticon-money"></i>
                                    </div>
                                    <div class="amount-content">
                                        <div class="current">Buy Now</div>
                                        <div class="amount">${{ $product->fixed_price }}</div>
                                    </div>
                                </div>
                            </div>
                            <div class="countdown-area">
                                <div class="countdown">
                                    <div id="bid_counter1"></div>
                                </div>
                                <span class="total-bids">{{ $product->AuctionList->count() }} Bids</span>
                            </div>
                            <div class="text-center">
                                <a href="#0" class="custom-button">Submit a bid</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div> --}}
@endsection

@push('script')

@endpush
