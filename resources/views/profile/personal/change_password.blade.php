@extends('frontend.layouts.app')

@section('content')
    @php
        $breadcrumb = [
            [
                'name' => 'Home',
                'route' => '/'
            ],
            [
                'name' => 'Profile Personal',
                'route' => '/profile'
            ],
            [
                'name' => 'Change Password',
                'route' => ''
            ]
        ];
    @endphp
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
                                    <h4 class="title">စကား၀ှက်ပြောင်းရန်</h4>
                                    <span class="edit"><a href="{{ route('profile.personal.index') }}"><i class="flaticon-left-arrow"></i> Back</a></span>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form method="post" action="{{ route('profile.personal.update-password') }}" class="contact-form" id="contact_form">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-group">
                                                <label for="currentPassword"><i class="fas fa-lock"></i></label>
                                                <input type="password" name="current_password" id="currentPassword" placeholder="ယခုအသုံးပြုနေသောစကား၀ှက်">
                                            </div>
                                            <div class="form-group">
                                                <label for="newPassword"><i class="fas fa-lock"></i></label>
                                                <input type="password" name="new_password" id="newPassword" placeholder="စကား၀ှက်အသစ် ရေးရန်">
                                            </div>
                                            <div class="form-group">
                                                <label for="confirmPassword"><i class="fas fa-lock"></i></label>
                                                <input type="password" name="confirm_password" id="confirmPassword" placeholder="စကား၀ှက်အသစ် ပြန်ရေးရန်">
                                            </div>
                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class="custom-button">Submit</button>
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
