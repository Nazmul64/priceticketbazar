@extends('Admin.master')

@section('content')
<div class="container mt-4">
    <h3>🎟 Lottery Purchases</h3>

    <!-- Filter Tabs -->
    <div class="mb-3">
        @php $types = ['daily','7days','15days','1month','3months','6months','1year']; @endphp
        @foreach($types as $type)
            <a href="{{ route('admin.lottery.purchases', ['type'=>$type]) }}"
               class="btn btn-sm {{ ($winType == $type) ? 'btn-primary' : 'btn-outline-primary' }}">
               {{ strtoupper($type) }}
            </a>
        @endforeach
        <a href="{{ route('admin.lottery.purchases') }}" class="btn btn-sm btn-outline-secondary">All</a>
    </div>

    <!-- Search -->
    <div class="mb-3">
        <input type="text" id="lotterySearch" class="form-control" placeholder="Search lottery by name...">
    </div>

    <table class="table table-bordered align-middle" id="lotteryTable">
        <thead>
            <tr>
                <th>Lottery Name</th>
                <th>Type</th>
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
                    <td>{{ $lottery->win_type }}</td>
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
                <tr><td colspan="6" class="text-center">No new lotteries found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.getElementById('lotterySearch').addEventListener('keyup', function(){
    let filter = this.value.toLowerCase();
    document.querySelectorAll('#lotteryTable tbody tr').forEach(row => {
        row.style.display = row.cells[0].textContent.toLowerCase().includes(filter) ? '' : 'none';
    });
});
</script>
@endsection
