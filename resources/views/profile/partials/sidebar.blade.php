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
                <label for="profile-pic" class="profile-pic-edit bg-secondary"><i class="flaticon-pencil"></i></label>
                <input type="file" id="profile-pic" class="d-none">
            </div>
            <div class="content">
                <h5 class="title"><a href="#0">{{ $auth_user->name }}</a></h5>
            </div>
        </div>
        <ul class="dashboard-menu">
            <li>
                <a href="{{ route('profile.dashboard') }}" class="{{ $current_route == request()->routeIs('profile.dashboard') ? 'active' : '' }}"><i class="flaticon-dashboard"></i>Dashboard</a>
            </li>
            <li>
                <a href="{{ route('profile.personal.index') }}" class="{{ $current_route == request()->routeIs('profile.personal.*') ? 'active' : '' }}"><i class="flaticon-user"></i>Personal Profile </a>
            </li>
            <li>
                <a href="{{ route('profile.my-product.index') }}" class="{{ $current_route == request()->routeIs('profile.my-product.*') ? 'active' : '' }}"><i class="flaticon-bag"></i>My Products</a>
            </li>
            <li>
                <a href="{{ route('profile.my-bid.index') }}" class="{{ $current_route == request()->routeIs('profile.my-bid.*') ? 'active' : '' }}"><i class="flaticon-auction"></i>My Bids</a>
            </li>
            <li>
                <a href="winning-bid.php"><i class="flaticon-best-seller"></i>Winning Bids</a>
            </li>
            <li>
                <a href="favorite.php"><i class="flaticon-star"></i>My Favorites</a>
            </li>
        </ul>
    </div>
</div>
