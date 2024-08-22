<div class="col-sm-10 col-md-7 col-lg-4">
    <div class="dashboard-widget mb-30 mb-lg-0">
        <div class="user">
            <div class="thumb-area">
                @php
                    $auth_user = auth()->guard('customer')->user();
                @endphp
                <div class="thumb border border-secondary">
                    <img src="{{ $auth_user->profile }}" alt="{{ $auth_user->name }}">
                </div>
                <label for="profile-pic" class="profile-pic-edit bg-secondary">
                    <a href="{{ route('profile.personal.profile-image.edit') }}" class="text-white"><i class="flaticon-pencil"></i></a>
                </label>
            </div>
            <div class="content">
                <h5 class="title"><a href="#0">{{ $auth_user->name }}</a></h5>
            </div>
        </div>
        <ul class="dashboard-menu">
            <li>
                <a href="{{ route('profile.dashboard') }}" class="{{ $current_route == request()->routeIs('profile.dashboard') ? 'active' : '' }}"><i class="flaticon-dashboard"></i>အသုံးပြုသူမှတ်တမ်း</a>
            </li>
            <li>
                <a href="{{ route('profile.personal.index') }}" class="{{ $current_route == request()->routeIs('profile.personal.*') ? 'active' : '' }}"><i class="flaticon-user"></i>ကိုယ်ရေးအကျဥ်း</a>
            </li>
            <!-- <li>
                <a href="{{ route('profile.my-product.index') }}" class="{{ $current_route == request()->routeIs('profile.my-product.*') ? 'active' : '' }}"><i class="flaticon-bag"></i>My Products</a>
            </li> -->
            <!-- <li>
                <a href="{{ route('profile.my-bid.index') }}" class="{{ $current_route == request()->routeIs('profile.my-bid.*') ? 'active' : '' }}"><i class="flaticon-auction"></i>My Bids</a>
            </li> -->
            <li>
                <a href="{{ route('profile.winning-bid.index') }}" class="{{ $current_route == request()->routeIs('profile.winning-bid.*') ? 'active' : '' }}"><i class="flaticon-best-seller"></i>အနိုင်ရှိသော လေလံများ</a>
            </li>
        </ul>
    </div>
</div>
