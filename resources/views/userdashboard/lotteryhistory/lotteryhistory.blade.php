@extends('userdashboard.master')

@section('content')
<div class="container-fluid mt-4">
    <h5>Lottery History & Results</h5>
    <table class="table table-bordered table-striped custom-table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Lottery Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Photo</th>
                <th>Draw Date</th>
                <th>Win Type</th>
                <th>Status</th>
                <th>Win Status</th>
                <th>Win Amount</th>
            </tr>
        </thead>
        <tbody>
            @forelse($purchases as $purchase)
                @foreach($purchase->results as $result)
                <tr>
                    <td>{{ $purchase->purchased_at->format('Y-m-d') }}</td>
                    <td>{{ $purchase->package->name ?? 'N/A' }}</td>
                    <td>{{ $purchase->price }}</td>
                    <td>{{ $purchase->package->description ?? 'N/A' }}</td>
                    <td>
                        @if($purchase->package && $purchase->package->photo)
                            <img src="{{ asset('uploads/lottery/'.$purchase->package->photo) }}" width="50" alt="Photo">
                        @else
                            N/A
                        @endif
                    </td>
                    <td>{{ $result->draw_date->format('Y-m-d') }}</td>
                    <td>{{ $purchase->package->win_type ?? 'N/A' }}</td>
                    <td>
                        <span class="badge {{ $purchase->status === 'active' ? 'bg-success' : 'bg-secondary' }}">
                            {{ ucfirst($purchase->status) }}
                        </span>
                    </td>
                    <td>
                        <span class="badge {{ $result->win_status == 'won' ? 'bg-success' : 'bg-danger' }}">
                            {{ ucfirst($result->win_status) }}
                        </span>
                    </td>
                    <td>{{ $result->win_amount }}</td>
                </tr>
                @endforeach
            @empty
                <tr>
                    <td colspan="10" class="text-center">No lottery purchases found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
