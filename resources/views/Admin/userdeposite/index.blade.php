@extends('Admin.master')

@section('content')
<div class="container-fluid my-4">

    <div class="card shadow-lg border-0">
        <div class="card-body">

            {{-- 🔍 Custom Search --}}
            <div class="mb-3 position-relative">
                <input type="text" id="customSearchBox" class="form-control" placeholder="Search Deposit Data...">
                <small id="typingIndicator"
                       class="text-muted position-absolute"
                       style="right:10px; top:50%; transform:translateY(-50%); display:none;">
                    ⌨️ Typing...
                </small>
            </div>

            {{-- 📊 Deposit Data Table --}}
            <div class="table-responsive">
                <table id="commissionTable" class="table table-hover table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Bank Name</th>
                            <th>Amount</th>
                            <th>Transaction ID</th>
                            <th>Screenshot</th>
                            <th>Account Number</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody class="text-center">
                        @forelse ($deposite as $item)
                            <tr>
                                {{-- Bank Name --}}
                                <td>{{ $item->method_type->bankname ?? 'N/A' }}</td>

                                {{-- Amount --}}
                                <td>{{ $item->amount ?? 'N/A' }}</td>

                                {{-- Transaction ID --}}
                                <td>{{ $item->transaction_id ?? 'N/A' }}</td>

                                {{-- Screenshot --}}
                                <td>
                                    @if(!empty($item->screenshot))
                                        <a href="{{ asset('uploads/deposite/' . $item->screenshot) }}" target="_blank">
                                            <img src="{{ asset('uploads/deposite/' . $item->screenshot) }}"
                                                 alt="Deposit Screenshot" class="img-thumbnail" width="60">
                                        </a>
                                    @else
                                        <span class="text-muted">No Photo</span>
                                    @endif
                                </td>

                                {{-- Account Number --}}
                                <td>{{ $item->method_type->accountnumber ?? 'N/A' }}</td>

                                {{-- Status Dropdown --}}
                                <td>
                                    <form action="{{ route('deposites.updateStatus', $item->id) }}" method="POST">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()"
                                                class="form-select form-select-sm">
                                            <option value="pending"  {{ $item->status === 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                            <option value="approved" {{ $item->status === 'approved' ? 'selected' : '' }}>✅ Approved</option>
                                            <option value="rejected" {{ $item->status === 'rejected' ? 'selected' : '' }}>❌ Rejected</option>
                                        </select>
                                    </form>
                                </td>

                                {{-- Action Buttons --}}
                                <td>
                                    <a href="#"
                                       class="btn btn-sm btn-info" title="Wallet Setting">
                                        <i class="bi bi-wallet2"></i>
                                    </a>

                                    <a href="#"
                                       class="btn btn-sm btn-primary" title="Edit Deposit">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <a href="{{ route('approve.delete', $item->id) }}"
                                       class="btn btn-sm btn-danger" title="Delete"
                                       onclick="return confirm('Are you sure you want to delete this deposit?')">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-muted text-center">🚫 No Deposit Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>
@endsection
