@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-4">
                    <div class="dashboard-widget mb-30 mb-lg-0">
                        <div class="user">
                            <div class="thumb-area">
                                <div class="thumb border border-secondary">
                                    <img src="{{ $auth_user->profile }}" alt="{{ $auth_user->name }}">
                                </div>
                                <label for="profile-pic" class="profile-pic-edit bg-secondary"><i class="flaticon-pencil"></i></label>
                                <input type="file" id="profile-pic" class="d-none">
                            </div>
                            <div class="content">
                                <h5 class="title"><a href="#0">{{ $auth_user->name }}</a></h5>
                            </div>
                        </div>
                        <ul class="dashboard-menu">
                            <li>
                                <a href="{{ route('profile.dashboard') }}" class="{{ request()->routeIs('profile.dashboard') ? 'active' : '' }}"><i class="flaticon-dashboard"></i>Dashboard</a>
                            </li>
                            <li>
                                <a href="{{ route('profile.personal.index') }}" class="{{ request()->routeIs('profile.personal.index') ? 'active' : '' }}"><i class="flaticon-user"></i>Personal Profile </a>
                            </li>
                            <li>
                                <a href="mybid.php"><i class="flaticon-auction"></i>My Bids</a>
                            </li>
                            <li>
                                <a href="winning-bid.php"><i class="flaticon-best-seller"></i>Winning Bids</a>
                            </li>
                            <li>
                                <a href="alert.php"><i class="flaticon-alarm"></i>My Alerts</a>
                            </li>
                            <li>
                                <a href="favorite.php"><i class="flaticon-star"></i>My Favorites</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Personal Details</h4>
                                    <span class="edit"><i class="flaticon-edit"></i> Edit</span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Name</div>
                                        <div class="info-value">{{ $auth_user->name }}</div>
                                    </li>
                                    <li>
                                        <div class="info-name">Email</div>
                                        <div class="info-value">{{ $auth_user->email }}</div>
                                    </li>
                                    <li>
                                        <div class="info-name">Phone</div>
                                        <div class="info-value">{{ $auth_user->phone }}</div>
                                    </li>
                                    <li>
                                        <div class="info-name">Date of Birth</div>
                                        <div class="info-value">{{ $auth_user->date_of_birth }}</div>
                                    </li>
                                    <li>
                                        <div class="info-name">Address</div>
                                        <div class="info-value">{{ $auth_user->address }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Security</h4>
                                    <span class="edit"><i class="flaticon-edit"></i> Edit</span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">Password</div>
                                        <div class="info-value">xxxxxxxxxxxxxxxx</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
