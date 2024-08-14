@extends('frontend.layouts.app')

@section('content')
    @php
        $breadcrumb = [
            [
                'name' => 'Home',
                'route' => '/'
            ],
            [
                'name' => 'FAQ',
                'route' => ''
            ]
        ];
    @endphp
    @include('frontend.layouts.hero_section')

    <section class="faq-section padding-bottom mt--240 mt-lg--440 pos-rel">
        <div class="container">
            <div class="section-header cl-white mw-100 left-style">
                <h2 class="title">FAQ</h2>
                <p>သင်ရှာဖွေနေသော အရာအား မတွေ့ရှိပါက ကျွန်ုပ်တို့ထံသို့ ဆက်သွယ်မေးမြန်းနိုင်ပါတယ်။</p>
            </div>
            <div class="row mb--50">
                <div class="col-lg-8 mb-50">
                    <div class="faq-wrapper">
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">လေလံဆွဲခြင်း ဘယ်လိုစတင်ရမလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>အသုံးပြုသူသည် စာရင်းပေးသွင်းထားသော အကောင့်ရှိလျှင် လေလံဆွဲခြင်းပြုလုပ်နိုင်ပါသည်။ မိမိလိုချင်သော ပစ္စည်းအား ဝင်ရောက်ကြည့်ရှုကာ လေလံဆွဲခြင်း စတင်နိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">လေလံတိုးခြင်းကို ပယ်ဖျက်နိုင်ပါသလား။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>လေလံတိုးခြင်းကို မပယ်ဖျက်နိုင်ပါ။ လေလံတိုးထားသော ပမာဏကို ဖြည့်သွင်းပြီးပါက ပယ်ဖျက်၍မရနိုင်ပါ။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">လေလံဆွဲသူတွေ ဘယ်လိုစာရင်းပေးသွင်းနိုင်သလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>စာရင်းပေးသွင်းခြင်းမှတဆင့် မိမိ၏ကိုယ်ရေးအချက်အလက်များ ပြည့်စုံစွာဖြည့်၍ စာရင်းပေးသွင်းနိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">အွန်လိုင်းလေလံ စနစ်ကို မည်သူမဆို ကြည့်ရှုနိုင်သလား။ </span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>မည်သူမဆိုကြည့်ရှုနိုင်ပါသည်။ သို့သော် စာရင်းပေးသွင်းထားသော အကောင့်ရှိမှသာ လေလံဆွဲခြင်းပြုလုပ်နိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">အွန်လိုင်းလေလံစနစ်ရဲ့ ရည်ရွက်ချက်က ဘာလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>ဒစ်ဂျစ်တယ် စျေးကွက်စနစ်အား ပိုမိုအဆင့်မြင့်စေရန်နှင့် အင်တာနက်ရရှိသော နေရာများမှတဆင့် မတူညီသောပစ္စည်းများအား တစ်နေရာထဲတွင် အလွယ်တကူရရှိနိုင်စေရန် ရည်ရွယ်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">အွန်လိုင်းလေလံစနစ်ရဲ့ ကောင်းကျိုးကဘာလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>နေရာအခက်အခဲပြသနာများ ဖြေရှင်းပေးနိုင်ခြင်း၊ ၂၄နာရီ ဝန်ဆောင်မှု ရရှိနိုင်ခြင်း၊ ပစ္စည်းတစ်ခုခြင်းစီ၏ အချက်အလက်များအားသေချာကြည့်ရှုနိုင်ခြင်း တို့ပဲဖြစ်ပါတယ်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">မည်သူသည် လေလံဆွဲထားသောပစ္စည်းအား ရရှိနိုင်မည်နည်း။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>လေလံတိုးနှုန်းနှင့်အတူ အမြင့်ဆုံးစျေးပေးနိုင်သောသူသည် ပစ္စည်းအားရရှိမည်ဖြစ်သည်။ သို့မဟုတ် သတ်မှတ်ထားသော စျေးအတိုင်း ဝယ်ယူနိုင်လျှင် ပစ္စည်းအား ပိုင်ဆိုင်မည်ဖြစ်သည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">လေလံတိုးခြင်းအောင်မြင်သော ပစ္စည်းအား မည်ကဲ့သို့ပို့ဆောင်ပေးသနည်း။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>ပို့ဆောင်ပေးရန် ရွေးချယ်မှုတွင် ဖော်ပြထားပြီး အနည်းဆုံးအချိန် ၁ပတ်မှ ၂ပတ်ခန့် ကြာမြင့်နိုင်ပါသည်။ အိမ်အရောက် ငွေချေစနစ် သို့မဟုတ် ဆိုင်တွင် လာရောက်ထုတ်ယူနိုင်ပါသည်။</p>
                            </div>
                        </div>
                        <div class="faq-item">
                            <div class="faq-title">
                                <img src="./assets/images/faq.png" alt="css"><span class="title">Buyer premium percent ဆိုတာဘာလဲ။</span><span class="right-icon"></span>
                            </div>
                            <div class="faq-content">
                                <p>Buyer premium percentဆိုတာ လေလံအောင်ထားသော ပစ္စည်းတန်ဖိုး၏ ရာခိုင်နှုန်းအလိုက် ပေးဆောင်ရသည်။ ဝယ်ယူသူသည် ပစ္စည်း၏တန်ဖိုးနှင့်အတူ Buyer premium percent အား ပေးချေရပါမည်။</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-50">
                    <aside class="sticky-menu">
                        <div class="faq-video mb-30">
                            <!-- <a href="https://www.youtube.com/watch?v=azlmxNYHOAM&t=15s&pp=ygUjaG93IHRvIGRvIGJpZCBpbiBhcnQgYXVjdGlvbiBvbmxpbmU%3D" class="video-area popup"> -->
                            <a href="https://www.youtube.com/watch?v=f7w1e95oBQo" class="video-area popup">
                                <img src="./assets/images/video.png" alt="faq">
                                <div class="video-button-2">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                    <i class="fas fa-play"></i>
                                </div>
                            </a>
                            <h5 class="title">ဗီဒီယိုကို ကြည့်ပါ။</h5>
                    </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
@endsection

