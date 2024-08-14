@extends('frontend.layouts.app')
@section('css')
<style>
    select, input, textarea, button {
        padding-left: 40px;
        border-top: none;
        border-left: none;
        border-right: none;
    }

    .preview-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .preview-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
    }

</style>
@endsection
@section('content')
    @php
        $breadcrumb = [
            [
                'name' => 'Home',
                'route' => '/'
            ],
            [
                'name' => 'Profile',
                'route' => '/profile'
            ],
            [
                'name' => 'My Products',
                'route' => '/profile/my-product'
            ],
            [
                'name' => 'Edit',
                'route' => ''
            ]
        ];
    @endphp
    @include('frontend.layouts.hero_section')

    <section class="dashboard-section padding-bottom mt--240 mt-lg--325 pos-rel">
        <div class="container">
            <div class="row justify-content-center">
                @include('profile.partials.sidebar', ['current_route' => request()->routeIs('profile.my-product.*')])
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-12">
                            <div class="dash-pro-item mb-30 dashboard-widget">
                                <div class="header">
                                    <h4 class="title">Product Edit</h4>
                                    <a href="{{ route('profile.my-product.index') }}">
                                        <span class="edit"><i class="flaticon-left-arrow"></i> Back</span>
                                    </a>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form class="contact-form" method="POST" action="{{ route('profile.my-product.update', $product->id) }}" enctype="multipart/form-data" id="contact_form">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-group">
                                                <label for="name"><i class="far fa-user"></i></label>
                                                <input type="text" placeholder="Name" name="name" value="{{ $product->name }}" id="name">
                                            </div>
                                            <div class="form-group">
                                                <label for="categoryId"><i class="fas fa-list"></i></label>
                                                <select name="category_id" id="categoryId">
                                                    <option value="">--- Select Category ---</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $category->id == $product->category_id ? 'selected' : '' }}>{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="startingPrice"><i class="fas fa-tag"></i></label>
                                                <input type="number" placeholder="Starting Price" name="starting_price" value="{{ $product->starting_price }}" id="startingPrice">
                                            </div>
                                            <div class="form-group">
                                                <label for="fixedPrice"><i class="fas fa-tag"></i></label>
                                                <input type="number" placeholder="Fixed Price" name="fixed_price" value="{{ $product->fixed_price }}" id="fixedPrice">
                                            </div>
                                            <div class="form-group">
                                                <label for="startDatetime"><i class="fas fa-calendar"></i></label>
                                                <input type="date" placeholder="Start Datetime" name="start_datetime" value="{{ Carbon\Carbon::parse($product->start_datetime)->format('Y-m-d') }}" id="startDatetime">
                                            </div>
                                            <div class="form-group">
                                                <label for="endDatetime"><i class="fas fa-calendar"></i></label>
                                                <input type="date" placeholder="end Datetime" name="end_datetime" value="{{ Carbon\Carbon::parse($product->end_datetime)->format('Y-m-d') }}" id="endDatetime">
                                            </div>
                                            <div class="form-group">
                                                <label for="buyerPremiumPercent"><i class="fas fa-percent"></i></label>
                                                <input type="number" placeholder="Buyer Premium Percent" name="buyer_premium_percent" value="{{ $product->buyer_premium_percent }}" id="buyerPremiumPercent">
                                            </div>
                                            <div class="form-group">
                                                <label for="bidIncrement"><i class="fas fa-chart-line"></i></label>
                                                <input type="number" placeholder="Bid Increment" name="bid_increment" value="{{ $product->bid_increment }}" id="bidIncrement">
                                            </div>
                                            <div class="form-group">
                                                <label for="images"><i class="fas fa-images"></i></label>
                                                <input type="file" placeholder="Images" name="images[]" class="images-input" multiple id="images">
                                                <div class="mt-1">
                                                    <div class="preview-container">
                                                        @foreach ($product->acsr_images as $image)
                                                        <img src="{{ asset($image) }}" class="preview-image" alt="">
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="description" class="description"><i class="fas fa-align-left"></i></label>
                                                <textarea name="description" id="description" placeholder="Description">{{ $product->description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="deliveryOption" class="description"><i class="fas fa-truck-loading"></i></label>
                                                <textarea name="delivery_option" id="deliveryOption" placeholder="Delivery Option">{{ $product->delivery_option }}</textarea>
                                            </div>

                                            <div class="form-group text-center mb-0">
                                                <button type="submit" class="custom-button">Update</button>
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

@push('script')
<script>
    $(document).ready(function () {
        $('.images-input').on('change', function(event) {
            var files = event.target.files;
            $('.preview-container').empty();

            $.each(files, function(index, file) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    var img = $('<img>').attr('src', e.target.result).addClass('preview-image');
                    $('.preview-container').append(img);
                }
                reader.readAsDataURL(file);
            });
        });
    });
</script>
@endpush
