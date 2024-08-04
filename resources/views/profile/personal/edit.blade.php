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
                                        <form method="post" action="{{ route('profile.personal.update') }}" class="contact-form" id="contact_form">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name"><i class="far fa-user"></i></label>
                                                <input type="text" placeholder="Your Name" name="name" value="{{ $auth_user->name }}" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><i class="fas fa-envelope-open-text"></i></label>
                                                <input type="text" placeholder="Enter Your Email ID" name="email" value="{{ $auth_user->email }}" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><i class="fas fa-phone"></i></label>
                                                <input type="number" placeholder="Enter Your Phone" name="phone" value="{{ $auth_user->phone }}" id="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="date_of_birth"><i class="fas fa-calendar"></i></label>
                                                <input type="date" placeholder="Date of Birth" name="date_of_birth" value="{{ $auth_user->date_of_birth }}" id="date_of_birth">
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="address"><i class="far fa-envelope"></i></label>
                                                <textarea name="address" id="address" placeholder="Type Your Address">{{ $auth_user->address }}</textarea>
                                            </div>
                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class="custom-button">Update</button>
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
