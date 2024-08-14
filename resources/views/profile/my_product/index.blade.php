@extends('frontend.layouts.app')
@section('css')
<style>
    .status {
        background: whitesmoke;
        font-size: 13px;
        border-radius: 10px;
        padding: 2px 8px;
    }

    .status.status-pending {
        background: rgb(251, 153, 73) !important;
        color: rgb(54, 54, 54) !important;
    }

    .status.status-approved {
        background: rgb(161, 238, 44) !important;
        color: rgb(54, 54, 54) !important;
    }

    .status.status-rejected {
        background: rgb(223, 0, 0) !important;
        color: whitesmoke !important;
    }
</style>
@endsection
@section('content')
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
                                    <h4 class="title">My Products</h4>
                                    <span class=""><a href="{{ route('profile.my-product.create') }}"><i class="fas fa-plus"></i> Create</a></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-30-none justify-content-center">
                        @foreach ($products as $product)
                        <div class="col-sm-12 col-md-6 col-lg-6 product-{{ $product->id }}">
                            <div class="auction-item-2" data-aos="zoom-out-up" data-aos-duration="1000">
                                <div class="auction-thumb">
                                    <a href="{{ route('product.detail', $product->id) }}"><img src="{{ $product->acsr_images ? $product->acsr_images[0] : asset('assets/images/no-product-image.png') }}" class="" style="width: 100%; height: 300px; object-fit: cover" alt="product"></a>
                                    <a href="#0" class="rating status status-{{ $product->status }}">{{ ucfirst($product->status) }}</a>
                                    <a href="{{ route('profile.my-product.edit', $product->id) }}" class="bid"><i class="flaticon-edit"></i></a>
                                </div>
                                <div class="auction-content">
                                    <h6 class="title">
                                        <a href="{{ route('product.detail', $product->id) }}">{{ $product->name }}</a>
                                    </h6>
                                    <div class="bid-area">
                                        <div class="bid-amount">
                                            <div class="icon">
                                                <i class="flaticon-auction"></i>
                                            </div>
                                            <div class="amount-content">
                                                <div class="current">Current Bid</div>
                                                <div class="amount">{{ number_format($product->starting_price) }} MMK</div>
                                            </div>
                                        </div>
                                        <div class="bid-amount">
                                            <div class="icon">
                                                <i class="flaticon-money"></i>
                                            </div>
                                            <div class="amount-content">
                                                <div class="current">Buy Now</div>
                                                <div class="amount">{{ number_format($product->fixed_price) }} MMK</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="countdown-area">
                                        <div class="countdown">
                                            <div id="bid_counter1"></div>
                                        </div>
                                        <span class="total-bids">{{ $product->auctions()->count() }} Bids</span>
                                    </div>
                                    <div class="text-center">
                                        <a href="{{ route('profile.my-product.edit', $product->id) }}" class="custom-button w-25 mx-1"><i class="flaticon-edit"></i></a>
                                        <a href="#0" class="custom-button w-25 mx-1 pink delete-btn" data-id="{{ $product->id }}" data-delete-url="{{ route('profile.my-product.delete', $product->id) }}"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="d-flex justify-content-center mt-5">
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        $('.delete-btn').on('click', function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let deletUrl = $(this).data('delete-url');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.post(deletUrl, {
                        _token: "{{ csrf_token() }}",
                        _method: 'DELETE',
                    })
                    .then((res) => {
                        if (res.result == 1) {
                            $(`.product-${id}`).remove();

                            Swal.fire('Deleted!', res.message);
                        } else {
                            Swal.fire('', res.message, 'error');
                        }
                    })
                    .fail((error) => {
                        console.log(error);
                    });
                }
            });
        });
    });
</script>
@endpush
