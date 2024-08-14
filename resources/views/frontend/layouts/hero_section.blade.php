<div class="hero-section style-2">
    <div class="container">
        <ul class="breadcrumb">
            @foreach (isset($breadcrumb) ? $breadcrumb : [] as $item)
            <li>
                <a href="{{ $item['route'] }}">{{ $item['name'] }} {!! $item['route'] != '' ? '<i class="fa fa-arrow-right mx-3"></i>' : '' !!}</a>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="bg_img hero-bg bottom_center" data-background="{{ asset('assets/images/hero-bg.png') }}"></div>
</div>
