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
    <input type="text" id="lotterySearch" class="form-control mb-3" placeholder="Search lottery by name...">

    <table class="table table-bordered align-middle" id="lotteryTable">
        <thead>
            <tr>
                <th>Lottery Name</th>
                <th>Type</th>
                <th>Price per Ticket</th>
                <th>Tickets Sold</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Declare</th>
            </tr>
        </thead>
        <tbody>
            @forelse($lotteries as $lottery)
                <tr>
                    <td>{{ $lottery->name }}</td>
                    <td>{{ $lottery->win_type }}</td>
                    <td>{{ round($lottery->price) }}$</td>
                    <td>{{ $lottery->tickets_sold }}</td>
                    <td>{{ round($lottery->total_amount) }}$</td>
                    <td>
                        <span class="badge {{ $lottery->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($lottery->status) }}
                        </span>
                    </td>
                    <td>
                        @if($lottery->status != 'completed')
                            <a href="{{ route('admin.lottery.showDeclare', $lottery->id) }}" class="btn btn-sm btn-primary">
                               Declare Winners
                            </a>
                        @else
                            <span class="text-muted">Already Declared</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr><td colspan="7" class="text-center">No lotteries found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

<script>
document.getElementById("lotterySearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    document.querySelectorAll("#lotteryTable tbody tr").forEach((row) => {
        row.style.display = row.cells[0].textContent.toLowerCase().includes(filter) ? "" : "none";
    });
});
</script>
@endsection
