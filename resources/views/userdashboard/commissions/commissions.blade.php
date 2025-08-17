@extends('userdashboard.master')
@section('content')
  <h5 class="mb-3">Commissions Log</h5>
<div class="table-responsive">
    <table class="table table-bordered custom-table">
        <thead class="table-dark">
            <tr>
                <th>Date</th>
                <th>Type</th>
                <th>From</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($commissions as $commission)
                <tr>
                    <td>{{ $commission->created_at->format('Y-m-d') }}</td>
                    <td>{{ ucfirst($commission->type) }}</td>
                    <td>{{ $commission->fromUser->name ?? 'Unknown' }}</td>
                    <td><strong>{{ number_format($commission->amount, 2) }}</strong> ৳</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">
                        No commission records found.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
