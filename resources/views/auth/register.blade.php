@extends('frontend.layouts.app')

@section('content')
    @php
    $breadcrumb = [
        [
            'name' => 'Register',
            'route' => ''
        ]
    ];
    @endphp
    @include('frontend.layouts.hero_section')

    <section class="account-section padding-bottom">
        <div class="container">
            <div class="account-wrapper mt--100 mt-lg--440">
                <div class="left-side">
                    <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                        <h2 class="title">အကောင့်ဖွင့်ရန်</h2>
                        <p>ပစ္စည်းများကို လေလံဆွဲနိုင်ရန် အကောင့်ဖွင့်ပါ!</p>
                    </div>
                    @include('frontend.layouts.page_info')
                    <form class="login-form" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="fa-solid fa-user"></i></label>
                            <input type="text" name="name" id="login-email" placeholder="Full Name" required>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="email" name="email" id="login-email" placeholder="Email Address" required>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-email"><i class="far fa-envelope"></i></label>
                            <input type="text" name="phone" id="login-email" placeholder="Phone" required>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="password" id="login-pass" placeholder="Password" required>
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>
                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <input type="password" name="password_confirmation" id="login-pass" placeholder="Retype Password" required>
                            <span class="pass-type"><i class="fas fa-eye"></i></span>
                        </div>

                        <div class="form-group mb-30">
                            <label for="login-pass"><i class="fas fa-lock"></i></label>
                            <textarea class="form-control" name="address"></textarea>
                        </div>

                        <div class="form-group checkgroup mb-30">
                            <input type="checkbox" name="terms" id="check"><label for="check">The Terms of Use apply</label>
                        </div>
                        <div class="form-group mb-0">
                            <button type="submit" class="custom-button" value="register" name="submit">SIGN UP</button>
                        </div>
                    </form>
                </div>
                <div class="right-side cl-white">
                    <div class="section-header mb-0">
                        <h3 class="title mt-0">အကောင့်ရှိပြီးသားလား?</h3>
                        <p>အကောင့်ထဲဝင်ပြီး လေလံဆွဲခြင်းစတင်ပါ</p>
                        <a href="login.php" class="custom-button transparent">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
