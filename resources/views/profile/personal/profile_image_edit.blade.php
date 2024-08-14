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
                                    <h4 class="title">Personal Profile Image Edit</h4>
                                    <span class="edit"><a href="{{ route('profile.personal.index') }}"><i class="flaticon-left-arrow"></i> Back</a></span>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <form method="post" action="{{ route('profile.personal.profile-image.update') }}" enctype="multipart/form-data" class="contact-form" id="contact_form">
                                            @csrf
                                            @method('PATCH')

                                            <div class="form-group">
                                                <label for="images"><i class="fas fa-images"></i></label>
                                                <input type="file" placeholder="Profile Image" name="profile" class="images-input" id="imageInput">
                                                <img id="imagePreview" src="{{ $auth_user->profile }}" alt="Image Preview" class="border mt-2" style="display: {{ $auth_user->profile ? 'flex' : 'none' }}; width: 200px;">

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
    $(document).ready(function() {
        $('#imageInput').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endpush
