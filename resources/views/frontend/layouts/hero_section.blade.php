<div class="hero-section style-2">
    <div class="container">
        <ul class="breadcrumb">
            <li>
                <a href="/">ပင်မစာမျက်နှာ<i class="fa-solid fa-arrow-right" style="padding-left:20px;padding-right:20px;"></i></a>
            </li>

            <li>
                <a href="/auctions">စာမျက်နှာများ<i class="fa-solid fa-arrow-right" style="padding-left:20px;padding-right:20px;"></i></a>
            </li>

            @if (!auth()->guard('customer')->check())
                <li>
                    <a href="{{ route('login') }}">စာရင်းသွင်းပါ</a>
                </li>
            @endif
        </ul>
    </div>
    <div class="bg_img hero-bg bottom_center" data-background="{{ asset('assets/images/hero-bg.png') }}"></div>
</div>
