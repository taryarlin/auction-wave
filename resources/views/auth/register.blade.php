@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                        <h2 class="title">စာရင်းသွင်းပါ</h2>
                        <p>ယုံကြည်စိတ်ချစွာစာရင်းပေးသွင်းနိုင်ပါသည်။</p>
                    </div>
                    @include('frontend.layouts.page_info')
                    <form class="login-form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-user"></i></label>
                            <input type="text" name="name" id="login-email" placeholder="နာမည်အပြည့်အစုံ" required>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="email" name="email" id="login-email" placeholder="အီးမေးလ်လိပ်စာ" required>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="fa-thin fa-phone"></i></label>
                            <input type="text" name="phone" id="login-email" placeholder="ဖုန်း" required>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="password" id="login-pass" placeholder="စကားဝှက်" required>
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="password_confirmation" id="login-pass" placeholder="စကားဝှက်အားပြန်ရိုက်ပါ" required>
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>

                        <div class="form-group mb-30">
                            <label for="login-pass"></label>
                            <textarea class="form-control" name="address"  placeholder="နေရပ်လိပ်စာ-"></textarea>
                        </div>

                        <div class="form-group checkgroup mb-30">
                            <input type="checkbox" name="terms" id="check"><label for="check">The Terms of Use apply</label>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="custom-button" value="register" name="submit">စာရင်းသွင်းပါ</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">အကောင့်တစ်ခုရှိနေပြီလား။</h3>
                        <p>အကောင့်ဝင်ပြီး သင်၏ Dashboard သို့သွားပါ။</p>
                        <a href="login.php" class="custom-button transparent">၀င်ရောက်ပါ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
