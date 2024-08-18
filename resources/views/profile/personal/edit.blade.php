@extends('frontend.layouts.app')

@section('content')
    @include('frontend.layouts.hero_section')

    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                @include('profile.partials.sidebar', ['current_route' => request()->routeIs('profile.personal.*')])
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">ကိုယ်ရေးအကျဉ်းပြင်ဆင်မှု</h4>
                                    <span class="edit"><a href="{{ route('profile.personal.index') }}"><i class="flaticon-left-arrow"></i> နောက်သို့</a></span>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form method="post" action="{{ route('profile.personal.update') }}" class="contact-form" id="contact_form">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name"><i class="far fa-user"></i></label>
                                                <input type="text" placeholder="သင့်နာမည်" name="name" value="{{ $auth_user->name }}" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="email"><i class="fas fa-envelope-open-text"></i></label>
                                                <input type="text" placeholder="သင့်အီးမေးလ်IDကိုထည့်ပါ" name="email" value="{{ $auth_user->email }}" id="email">
                                            </div>
                                            <div class="form-group">
                                                <label for="phone"><i class="fas fa-phone"></i></label>
                                                <input type="number" placeholder="သင့်ဖုန်းနံပါတ်ကိုထည့်ပါ" name="phone" value="{{ $auth_user->phone }}" id="phone">
                                            </div>
                                            <div class="form-group">
                                                <label for="date_of_birth"><i class="fas fa-calendar"></i></label>
                                                <input type="date" placeholder="မွေးသက္ကရာဇ်" name="date_of_birth" value="{{ $auth_user->date_of_birth ? Carbon\Carbon::parse($auth_user->date_of_birth)->format('Y-m-d') : '' }}" id="date_of_birth">
                                            </div>
                                            <div class="form-group">
                                                <label for="address" class="address"><i class="far fa-envelope"></i></label>
                                                <textarea name="address" id="address" placeholder="လိပ်စာအပြည့်အစုံကိုထည့်ပါ">{{ $auth_user->address }}</textarea>
                                            </div>
                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class="custom-button">ပြင်ဆင်ပါ</button>
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
