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
                    <td>{{ $lottery->user_package_buys_count }}</td>
                    <td>{{ round($lottery->user_package_buys_sum_price ) }}$</td>
                    <td>
                        <span class="badge {{ $lottery->status == 'completed' ? 'bg-success' : 'bg-warning' }}">
                            {{ ucfirst($lottery->status) }}
                        </span>
                    </td>
                    <td>
                        @if($lottery->status != 'completed')
                            <a href="{{ route('admin.lottery.showDeclare', $lottery->id) }}"
                               class="btn btn-sm btn-primary">
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
@endsection
<script>
    // lottery resutel javascript
const randomCheckbox = document.getElementById("randomCheckbox");
const manualSelect = document.getElementById("manual-select");

randomCheckbox.addEventListener("change", function () {
    manualSelect.style.display = this.checked ? "none" : "block";
});

// Show prize input when a user is selected
document.querySelectorAll(".user-list").forEach((list) => {
    list.addEventListener("change", function (e) {
        if (e.target.type === "radio") {
            const prizeInput =
                this.closest(".winner-section").querySelector(".prize-input");
            prizeInput.style.display = "block";
        }
    });
});

// 🔎 Search filter
document.getElementById("searchBox").addEventListener("keyup", function () {
    const query = this.value.toLowerCase();
    document.querySelectorAll(".user-item").forEach((item) => {
        const name = item.dataset.name;
        item.style.display = name.includes(query) ? "block" : "none";
    });
});

// end

// lottery show javascript
document.getElementById("lotterySearch").addEventListener("keyup", function () {
    let filter = this.value.toLowerCase();
    document.querySelectorAll("#lotteryTable tbody tr").forEach((row) => {
        row.style.display = row.cells[0].textContent
            .toLowerCase()
            .includes(filter)
            ? ""
            : "none";
    });
});

// end

</script>
