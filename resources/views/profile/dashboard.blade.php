@extends('frontend.layouts.app')
@section('css')
<style>
    .status {
        background: whitesmoke;
        font-size: 13px;
        border-radius: 10px;
        padding: 2px 8px;
    }

    .status.status-pending {
        background: rgb(251, 153, 73) !important;
        color: rgb(54, 54, 54) !important;
    }

    .status.status-approved {
        background: rgb(161, 238, 44) !important;
        color: rgb(54, 54, 54) !important;
    }

    .status.status-finished {
        background: rgb(0, 179, 255) !important;
        color: whitesmoke !important;
    }
</style>
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
                'name' => 'Dashboard',
                'route' => ''
            ]
        ];
    @endphp
    @include('frontend.layouts.hero_section')

    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                @include('profile.partials.sidebar', ['current_route' => request()->routeIs('profile.dashboard')])
                <div class="col-lg-8">
                    <div class="dashboard-widget mb-40">
                        <div class="dashboard-title mb-30">
                            <h5 class="title">လုပ်ဆောင်ချက်များ</h5>
                        </div>
                        <div class="row justify-content-center mb-30-none">
                            <!-- <div class="col-md-4 col-sm-6">
                                <div class="dashboard-item">
                                    <div class="thumb">
                                        <img src="../assets/images/icon3.png" alt="dashboard">
                                    </div>
                                    <div class="content">
                                        <h2 class="title"><span class="counter">{{ $my_products->total() }}</span></h2>
                                        <h6 class="info">ကျွန်ုပ်၏ပစ္စည်းများ</h6>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-item">
                                    <div class="thumb">
                                        <img src="../assets/images/icon4.png" alt="dashboard">
                                    </div>
                                    <div class="content">
                                        <h2 class="title"><span class="counter">{{ $active_bids->total() }}</span></h2>
                                        <h6 class="info">လက်ရှိလေလံများ</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-6">
                                <div class="dashboard-item">
                                    <div class="thumb">
                                        <img src="../assets/images/icon5.png" alt="dashboard">
                                    </div>
                                    <div class="content">
                                        <h2 class="title"><span class="counter">{{ $winning_bids->total() }}</span></h2>
                                        <h6 class="info">အနိုင်ရသောလေလံများ</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dashboard-widget">
                        <h5 class="title mb-10">လေလံမှတ်တမ်း</h5>
                        <div class="dashboard-purchasing-tabs">
                            <ul class="nav-tabs nav">
                                <!-- <li>
                                    <a href="#myProduct" class="{{ request()->tag ? (request()->tag == 'my-product' ? 'active' : '') : 'active' }}" data-toggle="tab">ကျွန်ုပ်၏ပစ္စည်းများ</a>
                                </li> -->
                                <li>
                                    <a href="#activeBid" class="{{ request()->tag == 'active-bid' ? 'active' : '' }}" data-toggle="tab">လက်ရှိလေလံများ</a>
                                </li>
                                <li>
                                    <a href="#WinningBid" class="{{ request()->tag == 'winning-bid' ? 'active' : '' }}" data-toggle="tab">အနိုင်ရသောလေလံများ</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane show fade {{ request()->tag ? (request()->tag == 'my-product' ? 'active' : '') : 'active' }}" id="myProduct">
                                    <table class="purchasing-table">
                                        <thead>
                                            <th>Item</th>
                                            <th>Bid Price</th>
                                            <th>Highest Bid</th>
                                            <th>Lowest Bid</th>
                                            <th>Status</th>
                                            <th>Expire Datetime</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($my_products as $my_product)
                                            <tr>
                                                <td data-purchase="item">{{ $my_product->name }}</td>
                                                <td data-purchase="bid price">{{ number_format($my_product->bid_increment) }} MMK</td>
                                                <td data-purchase="highest bid">{{ number_format($my_product->auctions()->max('amount')) }} MMK</td>
                                                <td data-purchase="lowest bid">{{ number_format($my_product->auctions()->min('amount')) }} MMK</td>
                                                <td data-purchase="status"><span class="rating status status-{{ $my_product->status }}">{{ ucfirst($my_product->status) }}</span></td>
                                                <td data-purchase="expire datetime">{{ $my_product->end_datetime }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-2">
                                        {{ $my_products->appends([
                                            'tag' => 'my-product',
                                        ])->links() }}
                                    </div>
                                </div>
                                <div class="tab-pane show fade {{ request()->tag == 'active-bid' ? 'active' : '' }}" id="activeBid">
                                    <table class="purchasing-table">
                                        <thead>
                                            <th>Item</th>
                                            <th>Bid Price</th>
                                            <th>Highest Bid</th>
                                            <th>Lowest Bid</th>
                                            <th>Status</th>
                                            <th>Expire Datetime</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($active_bids as $active_bid)
                                            <tr>
                                                <td data-purchase="item">{{ $active_bid->name }}</td>
                                                <td data-purchase="bid price">{{ number_format($active_bid->bid_increment) }} MMK</td>
                                                <td data-purchase="highest bid">{{ number_format($active_bid->auctions()->max('amount')) }} MMK</td>
                                                <td data-purchase="lowest bid">{{ number_format($active_bid->auctions()->min('amount')) }} MMK</td>
                                                <td data-purchase="status"><span class="rating status status-{{ $active_bid->status }}">{{ ucfirst($active_bid->status) }}</span></td>
                                                <td data-purchase="expire datetime">{{ $active_bid->end_datetime }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-2">
                                        {{ $active_bids->appends([
                                            'tag' => 'active-bid',
                                        ])->links() }}
                                    </div>
                                </div>
                                <div class="tab-pane show fade {{ request()->tag == 'winning-bid' ? 'active' : '' }}" id="WinningBid">
                                    <table class="purchasing-table">
                                        <thead>
                                            <th>Item</th>
                                            <th>Bid Price</th>
                                            <th>Highest Bid</th>
                                            <th>Lowest Bid</th>
                                            <th>Won Amount</th>
                                            <th>Won Datetime</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($winning_bids as $winning_bid)
                                            <tr>
                                                <td data-purchase="item">{{ $winning_bid->name }}</td>
                                                <td data-purchase="bid price">{{ number_format($winning_bid->bid_increment) }} MMK</td>
                                                <td data-purchase="highest bid">{{ number_format($winning_bid->auctions()->max('amount')) }} MMK</td>
                                                <td data-purchase="lowest bid">{{ number_format($winning_bid->auctions()->min('amount')) }} MMK</td>
                                                <td data-purchase="won amount">{{ number_format($winning_bid->won_amount) }} MMK</td>
                                                <td data-purchase="won datetime">{{ $winning_bid->won_datetime }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-end mt-2">
                                        {{ $winning_bids->appends([
                                            'tag' => 'winning-bid',
                                        ])->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
