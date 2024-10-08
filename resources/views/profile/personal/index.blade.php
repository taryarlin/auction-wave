@extends('frontend.layouts.app')

@section('content')
@php
    $breadcrumb = [
        [
            'name' => 'Home',
            'route' => '/'
        ],
        [
            'name' => 'Personal Profile',
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
                                    <h4 class="title">ကိုယ်ရေးအကျဥ်း</h4>
                                    <span class="edit"><a href="{{ route('profile.personal.edit') }}"><i class="flaticon-edit"></i> ပြင်ဆင်ရန်</a></span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">အမည်</div>
                                        <div class="info-value">{{ $auth_user->name }}</div>
                                    </li>
                                    <li>
                                        <div class="info-name">အီးမေးလ်</div>
                                        <div class="info-value">{{ $auth_user->email }}</div>
                                    </li>
                                    <li>
                                        <div class="info-name">ဖုန်း</div>
                                        <div class="info-value">{{ $auth_user->phone }}</div>
                                    </li>
                                    <!-- <li>
                                        <div class="info-name">Date of Birth</div>
                                        <div class="info-value">{{ $auth_user->date_of_birth }}</div>
                                    </li> -->
                                    <li>
                                        <div class="info-name">မြို့အမည်</div>
                                        <div class="info-value">{{ $auth_user->address }}</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="dash-pro-item dashboard-widget">
                                <div class="header">
                                    <h4 class="title">စကားဝှက်ပြောင်းရန်</h4>
                                    <span class="edit"><a href="{{ route('profile.personal.change-password') }}"><i class="flaticon-edit"></i> ပြောင်းရန်</a></span>
                                </div>
                                <ul class="dash-pro-body">
                                    <li>
                                        <div class="info-name">စကားဝှက်</div>
                                        <div class="info-value">xxxxxxxxxxxxxxxx</div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
