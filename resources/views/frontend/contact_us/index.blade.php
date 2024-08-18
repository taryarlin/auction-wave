@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="contact-section padding-bottom">
        <div class="container">
            <div class="contact-wrapper padding-top padding-bottom mt--100 mt-lg--440">
                <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                    <h5 class="cate">ဆက်သွယ်ရန်</h5>
                    <!-- <h2 class="title">get in touch</h2> -->
                    <p> ဘာအကူအညီ လိုအပ်ပါသလဲ? လူကြီးမင်းသိလိုရာများကိုဆက်သွယ်မေးမြန်းနိုင်ပါတယ်။</p>
                </div>
                <div class="row">
                    <div class="col-xl-8 col-lg-7">
                        <form class="contact-form" id="contact_form">
                            <div class="form-group">
                                <label for="name"><i class="far fa-user"></i></label>
                                <input type="text" placeholder="သင့်နာမည်" name="name" id="name">
                            </div>
                            <div class="form-group">
                                <label for="name"><i class="fas fa-envelope-open-text"></i></label>
                                <input type="text" placeholder="သင့်အီးမေးလ်IDကိုထည့်ပါ" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="message" class="message"><i class="far fa-envelope"></i></label>
                                <textarea name="message" id="message" placeholder="သင်၏Messageကိုရိုက်ထည့်ပါ"></textarea>
                            </div>
                            <div class="form-group text-center mb-0">
                                <button type="submit" class="custom-button">ပေးပို့ပါ</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-xl-4 col-lg-5 d-lg-block d-none">
                        <img src="./assets/images/contact.png" class="w-100" alt="images">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

