@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                        <h2 class="title">မင်္ဂလာပါ။</h2>
                        <p>သင်၏ အကောင့်ကို ဤနေရာတွင် သင်ဝင်ရောက်နိုင်ပါသည်။</p>
                    </div>

                    @include('frontend.layouts.page_info')

                    <form class="login-form" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="email"><i class="far fa-envelope"></i></label>
                            <input type="email" name="email" id="login-email" placeholder="အီးမေးလ်လိပ်စာ">
                        </div>
                        <div class="form-group">
                            <label for="password"><i class="fas fa-lock"></i></label>
                            <input type="password" name="password" id="login-pass" placeholder="စကားဝှက်">
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group mt-3 mb-3">
                            <a href="{{ route('password.request') }}">စကားဝှက်မေ့နေပါသလား?</a>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="custom-button">၀င်ရောက်ပါ</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">အကောင့်ရှိပြီလား?</h3>
                        <p>စာရင်းသွင်းပြီး သင့်အကောင့်ကို ဖန်တီးပါ။</p>
                        <a href="{{ route('register') }}" class="custom-button transparent">စာရင်းသွင်းပါ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
