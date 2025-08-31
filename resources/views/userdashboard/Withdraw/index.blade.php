@extends('userdashboard.master')

@section('content')
<div class="container-fluid px-4 py-5">

    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12 d-flex align-items-center justify-content-between">
            <div>
                <h2 class="fw-bold text-white mb-1">Withdraw Funds</h2>
                <p class="text-white mb-0">Choose your preferred payment method and withdraw your earnings</p>
            </div>
            <div class="balance-card text-center px-3 py-2 bg-dark rounded">
                <span class="text-white small">Available Balance</span>
                <h4 class="fw-bold text-white mb-0">{{ round($deposite_amount) }}$</h4>
            </div>
        </div>
    </div>

    <!-- Payment Methods Grid -->
    <div class="row g-4 mb-5">
        @foreach ($waleta_setups as $item)
            <div class="col-lg-3 col-md-6">
                <div class="payment-card h-100 p-3 border rounded" data-method="{{ $item->bankname }}">
                    <h5 class="payment-title mb-2">{{ $item->bankname ?? '' }}</h5>
                    <div class="payment-info mb-3">
                        <div class="info-row d-flex justify-content-between">
                            <span class="label">Minimum Withdraw:</span>
                            <span class="value text-success">{{ $item->minimum_withdraw ?? 500 }}$</span>
                        </div>
                        <div class="info-row d-flex justify-content-between">
                            <span class="label">Withdraw Charge:</span>
                            <span class="value text-warning">{{ $withdraw_commission->withdraw_commission ?? 0 }}%</span>
                        </div>
                    </div>
                    <button class="btn btn-primary w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#withdrawModal"
                            data-method="{{ $item->bankname }}"
                            data-currency="{{ $item->currency ?? 'USD' }}"
                            data-min="{{ $item->minimum_withdraw ?? 500 }}"
                            data-max="{{ $item->maximum_withdraw ?? 10000 }}">
                        <i class="fas fa-arrow-right me-1"></i> Withdraw Now
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Recent Transactions -->
    <div class="row">
        <div class="col-12">
            <div class="transactions-section bg-dark p-3 rounded">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-white">Recent Withdrawals</h4>
                    <select class="form-select form-select-sm w-auto">
                        <option>All Status</option>
                        <option>Completed</option>
                        <option>Pending</option>
                        <option>Rejected</option>
                    </select>
                </div>

                <div class="table-responsive">
                    <table class="table table-dark table-striped align-middle">
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Method</th>
                                <th>Amount</th>
                                <th>Fee</th>
                                <th>Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Example rows, replace with dynamic data --}}
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/40?img=1" class="rounded-circle me-2">
                                        <div>
                                            <div>Showrav Mia</div>
                                            <small class="text-muted">showrav@example.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td><i class="fab fa-stripe me-1"></i> Stripe</td>
                                <td>$50.00</td>
                                <td>$3.00</td>
                                <td>Jan 15, 2024</td>
                                <td><span class="badge bg-danger"><i class="fas fa-times-circle me-1"></i> Rejected</span></td>
                                <td><button class="btn btn-outline-light btn-sm"><i class="fas fa-eye me-1"></i> View</button></td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="https://i.pravatar.cc/40?img=2" class="rounded-circle me-2">
                                        <div>
                                            <div>John Doe</div>
                                            <small class="text-muted">john@example.com</small>
                                        </div>
                                    </div>
                                </td>
                                <td><i class="fab fa-paypal me-1"></i> Payoneer</td>
                                <td>$120.00</td>
                                <td>$3.80</td>
                                <td>Jan 14, 2024</td>
                                <td><span class="badge bg-success"><i class="fas fa-check-circle me-1"></i> Completed</span></td>
                                <td><button class="btn btn-outline-light btn-sm"><i class="fas fa-eye me-1"></i> View</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Withdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title" id="withdrawModalLabel"><i class="fas fa-wallet me-2"></i><span id="modalMethodName">Withdraw Funds</span></h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
               <form id="withdrawForm" method="post" action="{{ route('Withdraw.submit') }}">
                    @csrf
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Enter Amount</label>
                            <div class="input-group">
                                <input type="number" name="amount" class="form-control" id="amount" placeholder="0.00" step="0.01" >
                                <span class="input-group-text" id="currencySymbol">USD</span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Select Wallet</label>
                            <select name="wallet_name" class="form-select" id="wallet" >
                                <option value="">Choose wallet...</option>
                                @foreach ($waleta_setups as $item)
                                    <option value="{{ $item->bankname }}">{{ $item->bankname }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12">
                            <label class="form-label">Account Information</label>
                            <textarea class="form-control" name="account_number" id="accountInfo" rows="4" placeholder="Enter account details" ></textarea>
                        </div>
                    </div>

                    <div class="modal-footer border-0 pt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="fas fa-times me-1"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane me-1"></i> Submit Withdrawal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modalMethodName = document.getElementById('modalMethodName');
        const currencySymbol = document.getElementById('currencySymbol');
        const amountInput = document.getElementById('amount');

        document.querySelectorAll('[data-bs-target="#withdrawModal"]').forEach(button => {
            button.addEventListener('click', function() {
                const method = this.dataset.method;
                const currency = this.dataset.currency || 'USD';
                const min = this.dataset.min || 0;
                const max = this.dataset.max || 10000;

                modalMethodName.textContent = method + ' Withdraw';
                currencySymbol.textContent = currency;
                amountInput.setAttribute('min', min);
                amountInput.setAttribute('max', max);
                amountInput.value = '';
            });
        });
    });
</script>
@endpush

@endsection
