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
                                <a href="{{ route('profile.personal.index') }}" class="{{ request()->routeIs('profile.personal.index') . '/*' ? 'active' : '' }}"><i class="flaticon-user"></i>Personal Profile </a>
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
                                    <h4 class="title">Personal Details Edit</h4>
                                    <span class="edit"><a href="{{ route('profile.personal.index') }}"><i class="flaticon-left-arrow"></i> Back</a></span>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form method="post" action="{{ route('profile.personal.update-password') }}" class="contact-form" id="contact_form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="currentPassword"><i class="fas fa-lock"></i></label>
                                                <input type="password" name="current_password" id="currentPassword" placeholder="Current Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="newPassword"><i class="fas fa-lock"></i></label>
                                                <input type="password" name="new_password" id="newPassword" placeholder="New Password">
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmPassword"><i class="fas fa-lock"></i></label>
                                                <input type="password" name="confirm_password" id="confirmPassword" placeholder="Confirm Password">
                                            </div>
                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class="custom-button">Submit</button>
                                            </div>
                                        </form>
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
