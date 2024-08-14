<div class="auction-item-2" data-aos="zoom-out-up" data-aos-duration="1000">
    <div class="auction-thumb">
        <a href="{{ route('product.detail', $product->id) }}"><img src="{{ $product->acsr_images ? $product->acsr_images[0] : asset('assets/images/no-product-image.png') }}" class="" style="width: 100%; height: 300px; object-fit: cover" alt="product"></a>
        <a href="{{ route('product.detail', $product->id) }}" class="bid"><i class="flaticon-auction"></i></a>
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
                <div id="product_bid_counter{{ $product->id }}" data-product-id="{{ $product->id }}" data-end-date="{{ \Carbon\Carbon::parse($product->end_datetime)->format('Y/m/d') }}"></div>
            </div>
            <span class="total-bids">{{ $product->auctions()->count() }} Bids</span>
        </div>
        <div class="text-center">
            <a href="{{ route('product.detail', $product->id) }}" class="custom-button">Submit a bid</a>
        </div>
    </div>
</div>

@push('script')
<script>
    $(document).ready(function () {
        const product_id = "{{ $product->id }}";
        if ($("#product_bid_counter" + product_id).length) {

            let endDate = $("#product_bid_counter" + product_id).data('end-date');

            let counterElement = document.querySelector("#product_bid_counter" + product_id);
            let myCountDown = new ysCountDown(endDate, function(remaining, finished) {
                let message = "";
                if (finished) {
                    message = "Expired";
                } else {
                    var re_days = remaining.totalDays;
                    var re_hours = remaining.hours;
                    message += re_days + "d  : ";
                    message += re_hours + "h  : ";
                    message += remaining.minutes + "m  : ";
                    message += remaining.seconds + "s";
                }
                counterElement.textContent = message;
            });
        }
    });
</script>
@endpush
