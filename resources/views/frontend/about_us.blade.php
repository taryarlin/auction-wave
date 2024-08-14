@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="about-section">
        <div class="container">
            <div class="about-wrapper mt--100 mt-lg--440 padding-top">
                <div class="row">
                    <div class="col-lg-7 col-xl-6">
                        <div class="about-content">
                            <h4 class="subtitle" data-aos="fade-down" data-aos-duration="1000">ကျွန်ုပ်တို့၏ အကြောင်း</h4>
                            <h2 class="title" data-aos="fade-down" data-aos-duration="1200"><span class="d-block">အွန်လိုင်းလေလံစနစ်မှ</span> ကြိုဆိုပါတယ်</h2> <br>
                            <p class="gra" data-aos="fade-down" data-aos-duration="1300">ကျွန်ုပ်တို့ရည်ရွယ်ချက်မှာ အသုံးပြုသူများနှင့် ရောင်းချသူများ အဆင်ပြေပြီး လုံခြုံစိတ်ချရသော ပတ်ဝန်းကျင်ဖြစ်စေရန် ​ဖြစ်ပါတယ်။ ကျွန်ုပ်တို့၏ စနစ်မှာ အသုံးပြုသူများ၏ လိုအပ်ချက်များနှင့် ကိုက်ညီမှုရှိစေရန် ရေးဆွဲထားပါသည်။</p>
                            <p class="gra" data-aos="fade-down" data-aos-duration="1300">အွန်လိုင်းလေလံစနစ်အား အသုံးပြုခြင်းအတွက် ကျေးဇူးတင်ပါတယ်။ အသုံးပြုသူများရဲ့ အတွေ့အကြုံများပေါ်မူတည်ပြီး ဆက်လက်၍ အဆင့်မြှင့်တင်နိုင်အောင် ကြိုးစားသွားပါမည်။ သင့်အနေနဲ့ မေးခွန်းများမေးရန် သို့မဟုတ် သုံးသပ်ချက်များ ပြောကြားလိုလျှင် ကျွန်ုပ်တို့အား အချိန်မရွေးဆက်သွယ်နိုင်ပါသည်။</p>
                            <!-- <div class="item-area" data-aos="fade-down" data-aos-duration="1600">
                                <div class="item">
                                    <div class="thumb">
                                        <img src="./assets/images/about1.png" alt="about">
                                    </div>
                                    <p>award-winning team</p>
                                </div>
                                <div class="item">
                                    <div class="thumb">
                                        <img src="./assets/images/about2.png" alt="about">
                                    </div>
                                    <p>AFFILIATIONS</p>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </div>
                <div class="about-thumb">
                    <img src="./assets/images/about3.png" alt="about">
                </div>
            </div>
        </div>
    </section>

    <section class="overview-section padding-top" style="padding-bottom:120px;">
        <div class="container mw-lg-100 p-lg-0">
            <div class="row m-0">
                <div class="col-lg-6 p-0">
                    <div class="overview-content">
                        <div class="section-header text-lg-left" data-aos="zoom-out-down" data-aos-duration="1000">
                            <h2 class="title">သင် ဘာကို မျှော်လင့်နိုင်မလဲ?</h2>
                            <p></p>
                        </div>
                        <div class="row mb--50">
                            <div class="col-sm-6">
                                <div class="expert-item">
                                    <div class="thumb">
                                        <img src="./assets/images/overview1.png" alt="overview">
                                    </div>
                                    <div class="content">
                                        <h6 class="title">လေလံပွဲ ကျင်းပခြင်း</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="expert-item">
                                    <div class="thumb">
                                        <img src="./assets/images/overview2.png" alt="overview">
                                    </div>
                                    <div class="content">
                                        <h6 class="title">လွယ်ကူစွာ ငွေပေးချေမှု</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="expert-item">
                                    <div class="thumb">
                                        <img src="./assets/images/email2.png" alt="overview">
                                    </div>
                                    <div class="content">
                                        <h6 class="title">အီးမေးလ် အကြောင်းကြားစာများ</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="expert-item">
                                    <div class="thumb">
                                        <img src="./assets/images/videoa.png" alt="overview">
                                    </div>
                                    <div class="content">
                                        <h6class="title">လမ်းညွှန်ဗီဒီယိုများ</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pl-30 pr-0">
                    <div class="w-100 h-100 bg_img" data-background="./assets/images/overview-bg.png"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="client-section padding-top padding-bottom">
        <div class="container">
            <div class="section-header" data-aos="zoom-out-down" data-aos-duration="1200">
                <h2 class="title">Our Profile!</h2>
                <!-- <p>Our hard work is paying off. Great reviews from amazing customers.</p> -->
            </div>
            <div class="container mw-lg-100 p-lg-0 mx-auto p-2">
                <div class="row">
                    <div class="col-md-6 d-flex justify-content-end mb-1">
                        <div class="card" style="width: 18rem;">
                            <img src="./assets/images/girl1.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">
                                    Name - Thae Su Aye <br>
                                    Roll No - 5CS-21 <br>
                                    Section - Frontend <br>
                                    Phone - 09691385060 <br>
                                    E-mail - thaesuaye@ucsh.edu.mm <br>
                                    Address - University of Computer Studies, Hinthada
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex justify-content-start mb-1">
                        <div class="card" style="width: 18rem;">
                            <img src="./assets/images/girl2.png" class="card-img-top" alt="...">
                            <div class="card-body">
                                <p class="card-text">
                                    Name - Khaing Khaing Soe <br>
                                    Roll No - 5CS-7 <br>
                                    Section - Backend <br>
                                    Phone - 09400752917 <br>
                                    E-mail - khinekhinesoe@ucsh.edu.mm <br>
                                    Address - University of Computer Studies, Hinthada
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="about-section">
        <div class="container">

            <div class="anime-wrapper">
                <div class="anime-1 plus-anime">
                    <img src="{{ asset('assets/images/p1.png') }}" alt="footer">
                </div>
                <div class="anime-2 plus-anime">
                    <img src="{{ asset('assets/images/p2.png') }}" alt="footer">
                </div>
                <div class="anime-3 plus-anime">
                    <img src="{{ asset('assets/images/p3.png') }}" alt="footer">
                </div>
                <div class="anime-5 zigzag">
                    <img src="{{ asset('assets/images/c2.png') }}" alt="footer">
                </div>
                <div class="anime-6 zigzag">
                    <img src="{{ asset('assets/images/c3.png') }}" alt="footer">
                </div>
                <div class="anime-7 zigzag">
                    <img src="{{ asset('assets/images/c4.png') }}" alt="footer">
                </div>
            </div>
            <div class="newslater-content">
                <div class="section-header left-style mb-low" data-aos="fade-down" data-aos-duration="1100">
                    <h5 class="cate" id="help">အသုံးပြုရန် လမ်းညွှန်ချက်များ ဖတ်ရန်</h5><br>
                    <p>၁။ အွန်လိုင်းလေလံစနစ်အား အသုံးပြုရန် စာရင်းသွင်းခြင်း (သို့မဟုတ်)           လက်မှတ်ထိုးဝင်ရောက်ထားရန် လိုအပ်ပါသည်။ </p><br>
                    <p>၂။ အသုံးပြုသူတွင် အကောင့်မရှိပါက စာရင်းပေးသွင်း၍ လိုအပ်သောအချက်အလက်များဖြည့်သွင်းကာ အကောင့်သစ်ဖွင့်နိုင်သည်။ </p><br>
                    <p>၃။ လေလံဆွဲထားသော ပစ္စည်းများအား ပုံများကိုနှိပ်ကာ အသေးစိတ်အချက်အလက်နှင့်တကွ လေလံပစ္စည်းများကိုကြည့်ရှုနိုင်သည်။ </p><br>
                    <p>၄။ လေလံပစ္စည်းတစ်ခုချင်းစီတွင် လေလံဆွဲထားသော ပစ္စည်းအား မည်သည့်စျေးနှုန်းဖြင့် လေလံဆွဲထားကြောင်း ကြည့်ရှုနိုင်ပါသည်။ </p><br>
                    <p>၅။ အသုံးပြုသူသည် သတ်မှတ်ထားသော လေလံတိုးနှုန်းနှင့်အတူ လက်ရှိစျေးနှုန်းထက်ပို၍ ပေးမှသာ လေလံတိုးခြင်းအောင်မြင်မည်။ </p><br>
                    <p>၆။ လေလံပစ္စည်းများအား သတ်မှတ်ထားသောအချိန်အတွင်းတွင်သာ လေလံဆွဲခွင့်ပြုသည်။ </p><br>
                    <p>၇။ လေလံအောင်မြင်ပါက ပစ္စည်း၏တန်ဖိုးနှင့်အတူ Buyer premium percent အားပေးချေရပါမည်။ </p> <br>
                    <p>၈။ အသုံးပြုသူသည် ထွက်လိုလျှင် ထွက်ရန်ခလုတ်အားနှိပ်ကာ အသုံးပြုခြင်း ရပ်ဆိုင်းနိုင်ပါသည်။</p>
                </div>
            </div>
        </div>
    </section>
@endsection

