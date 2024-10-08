<x-filament-panels::page>
    <div class="table-container">
        <table class="filament-table">
            <h3 class="text-xl font-bold mb-4">လေလံစုစုပေါင်း: {{ $bid_histories_total }} </h3>
            <div class="product-info mb-4"style="display: flex; align-items: center; justify-content: center; text-align: center;">
                <p class="product-name" style="margin-right: 100px; font-family: 'Arial', sans-serif; font-weight: bold; font-style: italic; font-size: 30px; color: #333;">{{ $product_name }}</p>
                <div class="product-images">
                @foreach ($product_images as $image)
                    <img src="{{ asset('storage/'.$image) }}" alt="product" style="width: 400px; height: auto;">
                @endforeach
            </div>
            </div>
            <tbody>
                <tr>
                    <td><b>လေလံဆွဲသူများ</b></td>
                    <td><b>လေလံဆွဲချိန်</b></td>
                    <td><b>လွန်ခဲ့သောအချိန်က</b></td>
                    <td><b>လေလံပမာဏ</b></td>
                </tr>
                @forelse ($bid_histories as $bid_history)
                
                <tr>
                    <td>{{ $bid_history->name }}</td>
                    <td>{{ $bid_history->pivot->created_at }}</td>
                    <td>{{ $bid_history->pivot->created_at->diffForHumans() }}</td>
                    <td>{{ number_format($bid_history->pivot->amount) }} MMK</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" style="text-align: center">No Bid</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <style>
        .table-container {
            border-radius: 8px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 16px;
            margin-bottom: 20px;
        }

        .filament-table {
            width: 100%;
            border-collapse: collapse;
        }

        .filament-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
            color: #6b7280;
        }
    </style>
</x-filament-panels::page>
