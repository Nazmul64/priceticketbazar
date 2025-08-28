@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3>🎟 Lottery Purchases</h3>

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Lottery Name</th>
                <th>Price per Ticket</th>
                <th>Tickets Sold</th>
                <th>Total Amount</th>
                <th>Declare</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lotteries as $lottery)
                <tr>
                    <td>{{ $lottery->name }}</td>
                    <td>{{ number_format($lottery->price, 2) }}</td>
                    <td>{{ $lottery->user_package_buys_count }}</td>
                    <td>{{ number_format($lottery->user_package_buys_sum_price ?? 0, 2) }}</td>
                    <td>
                        <a href="{{ route('admin.lottery.showDeclare', $lottery->id) }}" class="btn btn-sm btn-primary">
                            Declare Winners
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center">No lotteries found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
