<x-filament-panels::page>
    <div class="table-container">
        <table class="filament-table">
            <h3 class="text-xl font-bold mb-4">Total Bid: {{ $bid_histories_total }} </h3>
            <tbody>
                <tr>
                    <td><b>Bidder</b></td>
                    <td><b>Bid Datetime</b></td>
                    <td><b>Since</b></td>
                    <td><b>Bid Amount</b></td>
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
