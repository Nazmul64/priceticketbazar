@extends('userdashboard.master')

@section('content')
<div class="container-fluid px-4 py-5">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h2 class="fw-bold text-white mb-1">Withdraw Funds</h2>
                    <p class="text-white mb-0">Choose your preferred payment method and withdraw your earnings</p>
                </div>
                <div class="balance-card">
                    <span class="text-white small">Available Balance</span>
                    <h4 class="fw-bold text-white mb-0">{{round($deposite_amount)}}$</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Payment Methods Grid -->
   <div class="row g-4 mb-5">
    @foreach ($waleta_setups as $item)
        <div class="col-lg-3 col-md-6">
            <div class="payment-card h-100" data-method="{{ $item->bankname }}">
                <div class="payment-body">
                    <h5 class="payment-title">{{ $item->bankname ?? '' }}</h5>
                    <div class="payment-info">
                        <div class="info-row">
                            <span class="label">Minimum Withdraw:</span>
                            <span class="value text-success">{{ $item->minimum_withdraw ?? 500 }}-$</span>
                        </div>
                        <div class="info-row">
                            <span class="label">Withdraw Charge:</span>
                            <span class="value text-warning">{{ $withdraw_commission->withdraw_commission ?? 0 }} %</span>
                        </div>
                    </div>
                    <button class="btn btn-withdraw"
                            data-bs-toggle="modal"
                            data-bs-target="#withdrawModal"
                            data-method="{{ $item->bankname }}"
                            data-currency="{{ $item->currency ?? 'BDT' }}"
                            data-min="{{ $item->minimum_withdraw ?? 500 }}"
                            data-max="{{ $item->maximum_withdraw ?? 10000 }}">
                        <i class="fas fa-arrow-right"></i>
                        Withdraw Now
                    </button>
                </div>
            </div>
        </div>
    @endforeach
</div>


    <!-- Recent Transactions -->
    <div class="row">
        <div class="col-12">
            <div class="transactions-section">
                <div class="section-header">
                    <h4 class="section-title">Recent Withdrawals</h4>
                    <div class="section-filters">
                        <select class="form-select form-select-sm">
                            <option>All Status</option>
                            <option>Completed</option>
                            <option>Pending</option>
                            <option>Rejected</option>
                        </select>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table transaction-table">
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
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="https://i.pravatar.cc/40?img=1" class="user-avatar">
                                        <div class="user-details">
                                            <span class="user-name">Showrav Mia</span>
                                            <span class="user-email">showrav@example.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="payment-method">
                                        <i class="fab fa-stripe"></i>
                                        Stripe
                                    </div>
                                </td>
                                <td>
                                    <span class="amount">$50.00</span>
                                </td>
                                <td>
                                    <span class="fee">$3.00</span>
                                </td>
                                <td>
                                    <span class="date">Jan 15, 2024</span>
                                </td>
                                <td>
                                    <span class="badge status-rejected">
                                        <i class="fas fa-times-circle"></i>
                                        Rejected
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="https://i.pravatar.cc/40?img=2" class="user-avatar">
                                        <div class="user-details">
                                            <span class="user-name">John Doe</span>
                                            <span class="user-email">john@example.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="payment-method">
                                        <i class="fab fa-paypal"></i>
                                        Payoneer
                                    </div>
                                </td>
                                <td>
                                    <span class="amount">$120.00</span>
                                </td>
                                <td>
                                    <span class="fee">$3.80</span>
                                </td>
                                <td>
                                    <span class="date">Jan 14, 2024</span>
                                </td>
                                <td>
                                    <span class="badge status-completed">
                                        <i class="fas fa-check-circle"></i>
                                        Completed
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="user-info">
                                        <img src="https://i.pravatar.cc/40?img=3" class="user-avatar">
                                        <div class="user-details">
                                            <span class="user-name">Sarah Wilson</span>
                                            <span class="user-email">sarah@example.com</span>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="payment-method">
                                        <i class="fas fa-mobile-alt"></i>
                                        Nagad
                                    </div>
                                </td>
                                <td>
                                    <span class="amount">৳5,000</span>
                                </td>
                                <td>
                                    <span class="fee">৳76.5</span>
                                </td>
                                <td>
                                    <span class="date">Jan 13, 2024</span>
                                </td>
                                <td>
                                    <span class="badge status-pending">
                                        <i class="fas fa-clock"></i>
                                        Pending
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-outline-primary btn-sm">
                                        <i class="fas fa-eye"></i>
                                        View
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Withdraw Modal -->
<div class="modal fade" id="withdrawModal" tabindex="-1" aria-labelledby="withdrawModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content withdraw-modal">
            <div class="modal-header">
                <h5 class="modal-title" id="withdrawModalLabel">
                    <i class="fas fa-wallet me-2"></i>
                    <span id="modalMethodName">Withdraw Funds</span>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body p-4">
                <form id="withdrawForm"method="post"action="{{route('Withdraw.submit')}}">
                    @csrf
                    <div class="row g-4">
                        <!-- Amount Section -->
                        <div class="col-md-6">
                            <label for="amount" class="form-label fw-semibold">
                                <i class="fas fa-dollar-sign me-1"></i>
                                Enter Amount
                            </label>
                            <div class="input-group input-group-lg">
                                <input type="number" class="form-control amount-input" id="amount"
                                       placeholder="0.00" step="0.01" required>
                                <span class="input-group-text" id="currencySymbol">USD</span>
                            </div>

                        </div>

                        <!-- Wallet Selection -->
                        <div class="col-md-6">
                            <label for="wallet" class="form-label fw-semibold">
                                <i class="fas fa-coins me-1"></i>
                                Select Wallet
                            </label>
                            <select class="form-select form-select-lg" id="wallet" required>
                                <option value="">Choose wallet...</option>
                                @foreach ($waleta_setups as $item)
                                    <option value="main">{{$item->bankname ?? ''}}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Account Information -->
                        <div class="col-12">
                            <label for="accountInfo" class="form-label fw-semibold">
                                <i class="fas fa-info-circle me-1"></i>
                                Account Information
                            </label>
                            <textarea class="form-control" id="accountInfo" rows="4"
                                      placeholder="Enter your account details (email, phone number, account ID, etc.)"
                                      required></textarea>
                        </div>

                        <!-- Fee Calculation -->
                        <div class="col-12">
                            <div class="fee-calculator">
                                <h6 class="fw-semibold mb-3">
                                    <i class="fas fa-calculator me-1"></i>
                                    Fee Calculation
                                </h6>
                                <div class="row g-3">
                                    <div class="col-sm-4">
                                        <div class="fee-item">
                                            <span class="fee-label">Amount:</span>
                                            <span class="fee-value" id="feeAmount">$0.00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="fee-item">
                                            <span class="fee-label">Total Fee:</span>
                                            <span class="fee-value text-warning" id="totalFee">$0.00</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="fee-item">
                                            <span class="fee-label">You'll Receive:</span>
                                            <span class="fee-value text-success fw-bold" id="finalAmount">$0.00</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="modal-footer border-0 px-0 pb-0">
                        <button type="button" class="btn btn-light btn-lg" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="fas fa-paper-plane me-1"></i>
                            Submit Withdrawal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
document.addEventListener('DOMContentLoaded', function() {
    const withdrawModal = document.getElementById('withdrawModal');
    const amountInput = document.getElementById('amount');
    const currencySymbol = document.getElementById('currencySymbol');
    const amountRange = document.getElementById('amountRange');
    const modalMethodName = document.getElementById('modalMethodName');
    const feeAmount = document.getElementById('feeAmount');
    const totalFee = document.getElementById('totalFee');
    const finalAmount = document.getElementById('finalAmount');

    let currentMethod = {
        name: '',
        currency: 'USD',
        min: 0,
        max: 0,
        fixedFee: 0,
        percentageFee: 0
    };

    // Payment method configurations
    const methodConfigs = {
        'Nagad': { currency: 'BDT', min: 1000, max: 10000, fixedFee: 1.5, percentageFee: 1.5 },
        'Payoneer': { currency: 'USD', min: 30, max: 150, fixedFee: 2, percentageFee: 1.5 },
        'Razorpay': { currency: 'INR', min: 100, max: 300, fixedFee: 3, percentageFee: 2 },
        'Stripe': { currency: 'USD', min: 50, max: 500, fixedFee: 2, percentageFee: 2 }
    };

    // Handle withdraw button clicks
    document.querySelectorAll('[data-bs-target="#withdrawModal"]').forEach(button => {
        button.addEventListener('click', function() {
            const method = this.getAttribute('data-method');
            const config = methodConfigs[method];

            currentMethod = {
                name: method,
                ...config
            };

            // Update modal
            modalMethodName.textContent = `${method} Withdraw`;
            currencySymbol.textContent = config.currency;
            amountRange.textContent = `${config.currency} ${config.min} - ${config.max}`;
            amountInput.setAttribute('min', config.min);
            amountInput.setAttribute('max', config.max);
            amountInput.value = '';

            calculateFees();
        });
    });

    // Calculate fees when amount changes
    amountInput.addEventListener('input', calculateFees);

    function calculateFees() {
        const amount = parseFloat(amountInput.value) || 0;
        const percentageFeeAmount = (amount * currentMethod.percentageFee) / 100;
        const totalFeeAmount = currentMethod.fixedFee + percentageFeeAmount;
        const finalAmountValue = amount - totalFeeAmount;

        feeAmount.textContent = `${currentMethod.currency} ${amount.toFixed(2)}`;
        totalFee.textContent = `${currentMethod.currency} ${totalFeeAmount.toFixed(2)}`;
        finalAmount.textContent = `${currentMethod.currency} ${Math.max(0, finalAmountValue).toFixed(2)}`;
    }

    // Form validation
    document.getElementById('withdrawForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const amount = parseFloat(amountInput.value);
        const wallet = document.getElementById('wallet').value;
        const accountInfo = document.getElementById('accountInfo').value;

        // Validation
        if (!amount || amount < currentMethod.min || amount > currentMethod.max) {
            showAlert('error', `Please enter an amount between ${currentMethod.currency} ${currentMethod.min} and ${currentMethod.max}`);
            return;
        }

        if (!wallet) {
            showAlert('error', 'Please select a wallet');
            return;
        }

        if (!accountInfo.trim()) {
            showAlert('error', 'Please enter your account information');
            return;
        }

        // Show success message and close modal
        showAlert('success', 'Withdrawal request submitted successfully! You will receive a confirmation email shortly.');

        // Reset form
        this.reset();
        calculateFees();

        // Close modal after a short delay
        setTimeout(() => {
            bootstrap.Modal.getInstance(withdrawModal).hide();
        }, 2000);
    });

    // Alert system
    function showAlert(type, message) {
        const alertContainer = document.querySelector('.container-fluid');
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show mt-3`;
        alertDiv.style.position = 'fixed';
        alertDiv.style.top = '20px';
        alertDiv.style.right = '20px';
        alertDiv.style.zIndex = '9999';
        alertDiv.style.minWidth = '300px';
        alertDiv.innerHTML = `
            <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;

        document.body.appendChild(alertDiv);

        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Add loading animation to withdraw buttons
    document.querySelectorAll('.btn-withdraw').forEach(button => {
        button.addEventListener('click', function() {
            const originalContent = this.innerHTML;
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
            this.disabled = true;

            setTimeout(() => {
                this.innerHTML = originalContent;
                this.disabled = false;
            }, 1000);
        });
    });

    // Add smooth scrolling to transaction table
    const transactionTable = document.querySelector('.table-responsive');
    if (transactionTable) {
        transactionTable.style.maxHeight = '400px';
        transactionTable.style.overflowY = 'auto';
    }

    // Add payment card selection effect
    document.querySelectorAll('.payment-card').forEach(card => {
        card.addEventListener('click', function() {
            // Remove active class from all cards
            document.querySelectorAll('.payment-card').forEach(c => c.classList.remove('active'));

            // Add active class to clicked card
            this.classList.add('active');

            // Trigger the withdraw button click
            const withdrawBtn = this.querySelector('.btn-withdraw');
            if (withdrawBtn) {
                withdrawBtn.click();
            }
        });
    });
});

// Additional CSS for active state
const additionalCSS = `
.payment-card.active {
    border-color: #667eea !important;
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(102, 126, 234, 0.2) !important;
}

.payment-card.active .payment-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.payment-card.active .payment-title {
    color: white;
}

.payment-card.active .payment-badge {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.alert {
    border: none;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0,0,0,0.1);
}

.alert-success {
    background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
    color: #065f46;
    border-left: 4px solid #10b981;
}

.alert-danger {
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    color: #991b1b;
    border-left: 4px solid #ef4444;
}

/* Loading animation */
@keyframes pulse {
    0% { opacity: 1; }
    50% { opacity: 0.5; }
    100% { opacity: 1; }
}

.btn-withdraw:disabled {
    animation: pulse 1.5s infinite;
}

/* Responsive improvements */
@media (max-width: 576px) {
    .payment-card {
        margin-bottom: 1rem;
    }

    .balance-card {
        min-width: unset;
        width: 100%;
    }

    .modal-lg {
        max-width: 95vw;
    }

    .withdraw-modal .modal-body {
        padding: 1.5rem;
    }

    .fee-calculator .row {
        gap: 0.5rem;
    }

    .fee-item {
        flex-direction: column;
        text-align: center;
        gap: 0.25rem;
    }

    .transaction-table {
        font-size: 0.8rem;
    }

    .user-info {
        gap: 6px;
    }

    .user-avatar {
        width: 32px;
        height: 32px;
    }
}

/* Print styles */
@media print {
    .payment-card, .balance-card {
        box-shadow: none;
        border: 1px solid #e2e8f0;
    }

    .btn-withdraw {
        background: #667eea !important;
        -webkit-print-color-adjust: exact;
    }
}
`;

// Inject additional CSS
const style = document.createElement('style');
style.textContent = additionalCSS;
document.head.appendChild(style);
</script>

@endsection
