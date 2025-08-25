@extends('userdashboard.master')
@section('content')
<div class="container">
    <div class="page-header floating">
        <h1>💳 Deposit Money</h1>
        <p>Secure and fast transactions for your convenience</p>
    </div>

    <div class="deposit-card">
        <form id="depositForm" action="{{ route('deposite.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-row">
                <!-- Payment Method -->
                <div class="form-group">
                    <label class="form-label">💎 Payment Method</label>
                    <select class="form-control" id="paymentMethod" name="payment_method">
                        <option value="">Select Payment Method</option>
                        @foreach ($wallets as $wallet)
                            <option value="{{ $wallet->bankname }}">{{ $wallet->bankname }}</option>
                        @endforeach
                    </select>
                    @error('payment_method')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Amount -->
                <div class="form-group">
                    <label class="form-label">💰 Deposit Amount</label>
                    <input type="number" class="form-control" name="amount" id="amount"
                           placeholder="Enter amount (e.g., 100.00)" step="0.01" min="1">
                    @error('amount')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Transaction ID -->
            <div class="form-group">
                <label class="form-label">📝 Transaction ID</label>
                <textarea class="form-control" name="transaction_id" id="transaction_id"
                          placeholder="Add transaction ID or payment reference..." rows="3"></textarea>
                @error('transaction_id')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Deposit Numbers -->
            <div class="mb-3">
                <label class="form-label">📞 Deposit Numbers</label>
                <div class="deposit-numbers">
                    @foreach ($wallets as $wallet)
                        @if($wallet->accountnumber)
                            <div class="deposit-number">
                                <span class="number-text">
                                    {{ $wallet->bankname }} - {{ $wallet->accountnumber }}
                                </span>
                                <button type="button" class="copy-btn" onclick="copyToClipboard('{{ $wallet->accountnumber }}', this)">
                                    📋 Copy
                                </button>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Screenshot -->
            <div class="mb-3">
                <label class="form-label">📷 Screenshot</label>
                <input type="file" name="screenshot" id="photoInput" class="form-control" accept="image/*">
                @error('screenshot')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <!-- Image Preview -->
            <div class="mb-3">
                <label class="form-label">Image Preview</label><br>
                <img id="photoPreview" src="#" alt="Preview"
                     style="max-width: 150px; display: none; border: 1px solid #ccc; padding: 5px; border-radius: 5px;">
            </div>

            <button type="submit" class="submit-btn" id="submitBtn">Submit Deposit Request</button>
        </form>
    </div>

    <!-- Transaction History -->
    <div class="transactions-section mt-5">
        <h2 class="section-title">📊 Transaction History</h2>
        <div class="table-container">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>📅 Date</th>
                        <th>🏦 Method</th>
                        <th>📝 Transaction ID</th>
                        <th>💵 Amount</th>
                        <th>📷 Screenshot</th>
                        <th>📈 Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transactions as $transaction)
                        <tr>
                            <td>{{ $transaction->created_at?->format('d M, Y') }}</td>
                            <td>{{ $transaction->payment_method ?? '' }}</td>
                            <td>{{ $transaction->transaction_id ?? '' }}</td>
                            <td>{{ round($transaction->amount ?? 0, 2) }}</td>
                            <td>
                                @if($transaction->screenshot)
                                    <img src="{{ asset('uploads/deposite/' . $transaction->screenshot) }}"
                                         alt="Screenshot" class="img-thumbnail" width="60">
                                @else
                                    N/A
                                @endif
                            </td>
                            <td>
                                @if($transaction->status === 'approved')
                                    <span class="badge bg-success">Approved</span>
                                @elseif($transaction->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @elseif($transaction->status === 'rejected')
                                    <span class="badge bg-danger">Rejected</span>
                                @else
                                    <span class="badge bg-secondary">Unknown</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No transactions found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
.deposit-numbers {
    display: flex;
    flex-direction: column;
    gap: 10px;
}
.deposit-number {
    display: flex;
    align-items: center;
    gap: 12px;
    background: #f9f9f9;
    border: 1px solid #ccc;
    padding: 8px 12px;
    border-radius: 8px;
    font-weight: 600;
}
.number-text {
    flex: 1;
    font-size: 16px;
    color: #333;
}
.copy-btn {
    background: #0d6efd;
    border: none;
    color: white;
    padding: 6px 12px;
    border-radius: 6px;
    cursor: pointer;
    transition: 0.2s;
}
.copy-btn:hover {
    background: #0b5ed7;
}
.copy-btn.copied {
    background: #198754 !important;
}
</style>

<script>
function copyToClipboard(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        btn.textContent = "✅ Copied!";
        btn.classList.add("copied");
        setTimeout(() => {
            btn.textContent = "📋 Copy";
            btn.classList.remove("copied");
        }, 1500);
    });
}

document.getElementById('photoInput').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const preview = document.getElementById('photoPreview');
        preview.src = URL.createObjectURL(file);
        preview.style.display = 'block';
    }
});
</script>
@endsection
