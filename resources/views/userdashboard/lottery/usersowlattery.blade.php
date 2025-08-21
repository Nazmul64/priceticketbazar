@extends('userdashboard.master')

@section('content')
<div class="container py-5">
    <h4 class="fw-bold mb-4 text-white">Available Lotteries</h4>
    <div class="row g-4">
        @forelse($lotteries as $lottery)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                <div class="lottery-card">
                    <!-- Lottery Image with Overlay -->
                    <div class="lottery-image-wrapper">
                        <img src="{{ asset('uploads/Lottery/'.$lottery->photo) }}" alt="{{ $lottery->name }}" class="lottery-bg-image">
                        <div class="lottery-overlay">
                            <div class="lottery-header">
                                <h3 class="lottery-title">{{ $lottery->name }}</h3>
                                <div class="lottery-type">{{ ucfirst($lottery->win_type) }} Draw</div>
                            </div>
                            <div class="price-badge">
                                <div class="price-amount">${{round($lottery->price) }}</div>
                                <div class="price-label">Entry Price</div>
                            </div>
                        </div>
                    </div>

                    <!-- Card Content -->
                    <div class="card-content">
                        <!-- Prizes Section -->
                        @if(($lottery->first_prize && !empty(trim($lottery->first_prize))) ||
                            ($lottery->second_prize && !empty(trim($lottery->second_prize))) ||
                            ($lottery->third_prize && !empty(trim($lottery->third_prize))))
                        <div class="prizes-section">
                            <h4 class="section-title">🏆 Prize Pool</h4>
                            <div class="prizes-grid">
                                @if($lottery->first_prize && !empty(trim($lottery->first_prize)))
                                    <div class="prize-item gold">
                                        <span class="prize-position">1st</span>
                                        <span class="prize-amount">{{ $lottery->first_prize }}</span>
                                    </div>
                                @endif
                                @if($lottery->second_prize && !empty(trim($lottery->second_prize)))
                                    <div class="prize-item silver">
                                        <span class="prize-position">2nd</span>
                                        <span class="prize-amount">{{ $lottery->second_prize }}</span>
                                    </div>
                                @endif
                                @if($lottery->third_prize && !empty(trim($lottery->third_prize)))
                                    <div class="prize-item bronze">
                                        <span class="prize-position">3rd</span>
                                        <span class="prize-amount">{{ $lottery->third_prize }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Draw Info -->
                        <div class="draw-info">
                            <div class="info-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <span class="info-label">Draw Date</span>
                                    <span class="info-value">{{ $lottery->draw_date ?? 'Pending' }}</span>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="fas fa-clock"></i>
                                <div>
                                    <span class="info-label">Time Left</span>
                                    <span class="info-value countdown-timer" data-draw-date="{{ $lottery->draw_date }}">Calculating...</span>
                                </div>
                            </div>
                        </div>

                        <!-- Join Button -->
                        <button type="button" class="invest-btn-modern"
                                data-lottery-id="{{ $lottery->id }}"
                                data-lottery-name="{{ $lottery->name }}"
                                data-lottery-price="{{ $lottery->price }}">
                            <span class="btn-text">Join Lottery</span>
                            <span class="btn-icon">🎰</span>
                        </button>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p class="text-white text-center">❌ No active lotteries available right now.</p>
            </div>
        @endforelse
    </div>
</div>

<!-- USDT Payment Modal -->
<div class="modal fade" id="usdtPaymentModal" tabindex="-1" aria-labelledby="usdtPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content custom-modal">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold w-100 text-center" id="usdtPaymentModalLabel"style="color:#1F1F1F;">
                    <i class="fab fa-bitcoin text-black me-2"></i>USDT Payment
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="usdtPaymentForm" method="POST" action="#" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" id="usdt_lottery_id" name="lottery_id">

                    <!-- Lottery Info Display -->
                    <div class="mb-4">
                        <div class="alert alert-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Lottery:</strong> <span id="usdt-lottery-name">-</span>
                                </div>
                                <div class="col-md-6">
                                    <strong>Price:</strong> $<span id="usdt-lottery-price">0</span> USDT
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- USDT Amount -->
                    <div class="mb-3">
                        <label for="usdt_amount" class="form-label"style="color:#1F1F1F !important;">
                            <i class="fas fa-coins text-black me-2"></i>USDT Amount
                        </label>
                        <div class="input-group">
                            <input type="number" class="form-control" id="usdt_amount" name="usdt_amount"
                                   placeholder="Enter USDT amount" min="0.01" step="0.01" required>
                            <span class="input-group-text">USDT</span>
                        </div>
                        <small class="text-muted">Minimum: <span id="usdt-min-amount"style="color:#1F1F1F;">1</span> USDT</small>
                    </div>

                    <!-- Wallet Address -->
                    <div class="mb-3">
                        <label for="wallet_address" class="form-label"style="color:#1F1F1F !important;">
                            <i class="fas fa-wallet text-black me-2"></i>Wallet Address
                        </label>
                        <input type="text" class="form-control" id="wallet_address" name="wallet_address"
                               placeholder="Enter your USDT wallet address" required>
                        <small class="text-muted">Enter the wallet address where you sent USDT from</small>
                    </div>

                    <!-- Transaction Hash -->
                    <div class="mb-3">
                        <label for="transaction_hash" class="form-label"style="color:#1F1F1F !important;">
                            <i class="fas fa-link text-black me-2 "></i>Transaction Hash
                        </label>
                        <input type="text" class="form-control" id="transaction_hash" name="transaction_hash"
                               placeholder="Enter transaction hash/ID" required>
                        <small class="text-muted">Paste the transaction hash from your USDT transfer</small>
                    </div>

                    <!-- Payment Instructions -->
                    <div class="mb-4">
                        <div class="alert alert-warning">
                            <h6 class="mb-2">
                                <i class="fas fa-info-circle me-2"></i>Payment Instructions:
                            </h6>
                            <ol class="mb-0 small">
                                <li>Send the exact USDT amount to our wallet address</li>
                                <li>Copy the transaction hash from your wallet</li>
                                <li>Enter your wallet address and transaction hash above</li>
                                <li>Click "Confirm Payment" to complete the process</li>
                            </ol>
                        </div>
                    </div>

                    <!-- Our USDT Wallet Address Display -->
                    <div class="mb-4">
                        <div class="payment-address-card">
                            <h6 class="mb-2">
                                <i class="fas fa-qrcode text-black me-2"></i>Send USDT to this address:
                            </h6>
                            <div class="address-display">
                                @if($walate->isNotEmpty())
                                    <select id="usdt-wallet-select" class="form-select mb-2">
                                        @foreach($walate as $wallet)
                                            <option value="{{ $wallet->accountnumber }}">{{ $wallet->bankname }} - {{ $wallet->accountnumber }}</option>
                                        @endforeach
                                    </select>
                                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="copyAddress()">
                                        <i class="fas fa-copy"></i> Copy
                                    </button>
                                @else
                                    <input type="text" class="form-control" value="No wallet address found" readonly>
                                    <button type="button" class="btn btn-outline-secondary btn-sm" disabled>
                                        <i class="fas fa-copy"></i> Copy
                                    </button>
                                @endif
                            </div>
                            <small class="text-muted">Select a wallet and click the copy button to copy the address</small>
                        </div>
                    </div>

                    <!-- Terms and Conditions -->
                   <!-- Terms and Conditions -->
                    <div class="mb-3">
                        <div class="form-check d-flex align-items-center">
                            <input
                                class="form-check-input me-2"
                                type="checkbox"
                                id="usdt_terms"
                                required
                                style="
                                    width: 22px;
                                    height: 22px;
                                    background-color: #000000;
                                    border: 2px solid #b10909 !important;
                                    cursor: pointer;
                                    accent-color: #b10909; /* modern browsers will tint checked color */
                                "
                            >
                            <label
                                class="form-check-label fw-bold text-dark"
                                for="usdt_terms"
                                style="font-size: 1rem; line-height: 1.5;"
                            >
                                ⚠️ I confirm that I have sent the exact <span class="text-danger">USDT amount</span> and provided correct transaction details.
                            </label>
                        </div>
                    </div>
                    <!-- Buttons -->
                    <div class="d-flex justify-content-between gap-2">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-2"></i>Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-check me-2"></i>Confirm Payment
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Container & Layout */
.container {
    background: rgba(0, 0, 0, 0.5);
    border-radius: 15px;
    padding: 30px;
}

/* Lottery Card Styling */
.lottery-card {
    background: linear-gradient(145deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    transition: all 0.4s ease;
    backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
    height: 100%;
}

.lottery-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
    border-color: rgba(255, 255, 255, 0.4);
}

/* Image Section */
.lottery-image-wrapper {
    position: relative;
    height: 200px;
    overflow: hidden;
}

.lottery-bg-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.lottery-card:hover .lottery-bg-image {
    transform: scale(1.1);
}

.lottery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 100%);
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 20px;
}

.lottery-header {
    flex: 1;
}

.lottery-title {
    font-size: 1.4rem;
    font-weight: 700;
    color: #ffffff;
    margin: 0 0 5px 0;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
}

.lottery-type {
    color: #ffd700;
    font-size: 0.9rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.price-badge {
    background: linear-gradient(135deg, #ff6b6b, #ee5a24);
    padding: 12px 16px;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 4px 15px rgba(238, 90, 36, 0.3);
}

.price-amount {
    font-size: 1.2rem;
    font-weight: 800;
    color: #ffffff;
    line-height: 1;
}

.price-label {
    font-size: 0.7rem;
    color: rgba(255,255,255,0.9);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

/* Card Content */
.card-content {
    padding: 25px;
    display: flex;
    flex-direction: column;
    height: calc(100% - 200px);
}

/* Section Title */
.section-title {
    font-size: 1rem;
    font-weight: 600;
    color: #ffffff;
    margin: 0 0 15px 0;
    display: flex;
    align-items: center;
    gap: 8px;
}

/* Prizes Section */
.prizes-section {
    margin-bottom: 25px;
}

.prizes-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(80px, 1fr));
    gap: 10px;
}

.prize-item {
    background: linear-gradient(145deg, rgba(255,255,255,0.1), rgba(255,255,255,0.05));
    border: 1px solid rgba(255,255,255,0.2);
    border-radius: 12px;
    padding: 12px 8px;
    text-align: center;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.prize-item::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 3px;
    background: linear-gradient(90deg, transparent, currentColor, transparent);
}

.prize-item.gold {
    color: #ffd700;
    border-color: rgba(255, 215, 0, 0.3);
}

.prize-item.silver {
    color: #c0c0c0;
    border-color: rgba(192, 192, 192, 0.3);
}

.prize-item.bronze {
    color: #cd7f32;
    border-color: rgba(205, 127, 50, 0.3);
}

.prize-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.2);
}

.prize-position {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    margin-bottom: 4px;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.prize-amount {
    display: block;
    font-size: 0.9rem;
    font-weight: 700;
    color: #ffffff;
}

/* Draw Info */
.draw-info {
    background: rgba(255,255,255,0.05);
    border: 1px solid rgba(255,255,255,0.1);
    border-radius: 15px;
    padding: 20px;
    margin-bottom: 25px;
    flex-grow: 1;
}

.info-item {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 15px;
}

.info-item:last-child {
    margin-bottom: 0;
}

.info-item i {
    color: #ffd700;
    font-size: 1.1rem;
    width: 20px;
    text-align: center;
}

.info-label {
    display: block;
    font-size: 0.8rem;
    color: rgba(255,255,255,0.7);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.info-value {
    display: block;
    font-size: 0.95rem;
    color: #ffffff;
    font-weight: 600;
}

/* Modern Invest Button */
.invest-btn-modern {
    width: 100%;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border: none;
    border-radius: 15px;
    padding: 15px 20px;
    color: #ffffff;
    font-weight: 700;
    font-size: 1rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    position: relative;
    overflow: hidden;
    transition: all 0.4s ease;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-top: auto;
}

.invest-btn-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.invest-btn-modern:hover::before {
    left: 100%;
}

.invest-btn-modern:hover {
    background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.4);
}

.invest-btn-modern:active {
    transform: translateY(0);
}

.btn-text {
    position: relative;
    z-index: 2;
}

.btn-icon {
    font-size: 1.2rem;
    position: relative;
    z-index: 2;
}

/* Modal styling */
.custom-modal {
    background: rgba(255, 255, 255, 0.95);
    color: #000000;
    border: 1px solid rgba(0, 0, 0, 0.2);
}

.payment-address-card {
    background: rgba(248, 249, 250, 1);
    border: 1px solid rgba(0, 0, 0, 0.1);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
}

.address-display {
    display: flex;
    gap: 10px;
    align-items: center;
    margin-bottom: 10px;
}

/* Countdown timer styling */
.countdown-timer {
    font-weight: bold;
    color: #ffc107 !important;
    font-size: 0.9rem;
}

.countdown-expired {
    color: #dc3545 !important;
}

.countdown-soon {
    color: #fd7e14 !important;
    animation: blink 1s infinite;
}

.countdown-live {
    color: #28a745 !important;
    font-weight: bold;
}

@keyframes blink {
    0%, 50% { opacity: 1; }
    51%, 100% { opacity: 0.5; }
}

/* Responsive Design */
@media (max-width: 991.98px) {
    .lottery-card {
        margin-bottom: 30px;
    }
}

@media (max-width: 767.98px) {
    .container {
        padding: 20px;
    }

    .lottery-image-wrapper {
        height: 160px;
    }

    .lottery-title {
        font-size: 1.2rem;
    }

    .card-content {
        padding: 20px;
    }

    .address-display {
        flex-direction: column;
        gap: 10px;
    }
}
</style>

<script>
// Copy Address Function
function copyAddress() {
    const walletSelect = document.getElementById('usdt-wallet-select');
    const copyBtn = document.querySelector('[onclick="copyAddress()"]');

    if (!walletSelect || !copyBtn) {
        alert('Copy function not available');
        return;
    }

    const selectedAddress = walletSelect.value;

    if (!selectedAddress || selectedAddress === 'No wallet address found') {
        alert('No valid wallet address to copy');
        return;
    }

    const showFeedback = () => {
        copyBtn.innerHTML = '<i class="fas fa-check text-success"></i> Copied!';
        copyBtn.classList.add('btn-success');
        copyBtn.classList.remove('btn-outline-primary');

        setTimeout(() => {
            copyBtn.innerHTML = '<i class="fas fa-copy"></i> Copy';
            copyBtn.classList.remove('btn-success');
            copyBtn.classList.add('btn-outline-primary');
        }, 2000);
    };

    if (navigator.clipboard && window.isSecureContext) {
        navigator.clipboard.writeText(selectedAddress)
            .then(() => showFeedback())
            .catch(() => fallbackCopy(selectedAddress, showFeedback));
    } else {
        fallbackCopy(selectedAddress, showFeedback);
    }
}

function fallbackCopy(text, callback) {
    const tempInput = document.createElement('input');
    tempInput.style.position = 'absolute';
    tempInput.style.left = '-9999px';
    tempInput.value = text;
    document.body.appendChild(tempInput);

    try {
        tempInput.select();
        tempInput.setSelectionRange(0, 99999);
        const success = document.execCommand('copy');
        if (success && callback) callback();
        else alert('Failed to copy. Please copy manually: ' + text);
    } catch (err) {
        alert('Failed to copy. Please copy manually: ' + text);
    } finally {
        document.body.removeChild(tempInput);
    }
}

// Countdown Timer
function formatCountdown(diff) {
    const days = Math.floor(diff / (1000*60*60*24));
    const hours = Math.floor((diff % (1000*60*60*24)) / (1000*60*60));
    const minutes = Math.floor((diff % (1000*60*60)) / (1000*60));
    const seconds = Math.floor((diff % (1000*60)) / 1000);

    if (days > 0) return `${days}d ${hours}h ${minutes}m`;
    if (hours > 0) return `${hours}h ${minutes}m ${seconds}s`;
    if (minutes > 0) return `${minutes}m ${seconds}s`;
    return `${seconds}s`;
}

function updateCountdown(element) {
    const drawTime = element.getAttribute('data-draw-date');

    if (!drawTime || drawTime.trim() === '' || drawTime === 'Pending') {
        element.textContent = 'Draw time not set';
        element.className = 'countdown-timer text-muted';
        return;
    }

    const diff = new Date(drawTime) - new Date();
    if (diff <= 0) {
        element.textContent = '🎉 Draw Live Now!';
        element.className = 'countdown-timer countdown-live';
        return;
    }

    element.textContent = formatCountdown(diff);

    if (diff < 60000) element.className = 'countdown-timer countdown-soon';
    else if (diff < 3600000) element.className = 'countdown-timer text-warning';
    else element.className = 'countdown-timer text-success';
}

// USDT Modal Setup
function setupUSDTModal() {
    const usdtPaymentModal = document.getElementById('usdtPaymentModal');
    if (!usdtPaymentModal || typeof bootstrap === 'undefined') return;

    const usdtModalInstance = new bootstrap.Modal(usdtPaymentModal);

    document.querySelectorAll('.invest-btn-modern').forEach(button => {
        button.addEventListener('click', e => {
            e.preventDefault();
            const lotteryData = {
                id: button.getAttribute('data-lottery-id'),
                name: button.getAttribute('data-lottery-name'),
                price: button.getAttribute('data-lottery-price')
            };

            if (!lotteryData.id || !lotteryData.name || !lotteryData.price) {
                alert('Error: Missing lottery information');
                return;
            }

            showUSDTPaymentModal(lotteryData, usdtModalInstance);
        });
    });

    const form = document.getElementById('usdtPaymentForm');
    form?.addEventListener('submit', e => {
        e.preventDefault();
        const formData = new FormData(form);
        const amount = parseFloat(formData.get('usdt_amount'));
        const wallet = formData.get('wallet_address');
        const txHash = formData.get('transaction_hash');
        const terms = document.getElementById('usdt_terms').checked;

        if (isNaN(amount) || amount <= 0) return alert('Enter valid USDT amount');
        if (!wallet || wallet.trim().length < 10) return alert('Enter valid wallet address');
        if (!txHash || txHash.trim().length < 10) return alert('Enter valid transaction hash');
        if (!terms) return alert('Please confirm terms');

        alert('USDT payment submitted successfully!');
        usdtModalInstance.hide();
    });
}

function showUSDTPaymentModal(lotteryData, modalInstance) {
    document.getElementById('usdt_lottery_id').value = lotteryData.id;
    document.getElementById('usdt-lottery-name').textContent = lotteryData.name;
    document.getElementById('usdt-lottery-price').textContent = lotteryData.price;
    document.getElementById('usdt-min-amount').textContent = lotteryData.price;

    const amountInput = document.getElementById('usdt_amount');
    if (amountInput) {
        amountInput.setAttribute('min', lotteryData.price);
        amountInput.value = lotteryData.price;
    }

    modalInstance.show();
}

// Initialize Everything
document.addEventListener('DOMContentLoaded', () => {
    // Initialize countdown timers
    const countdownElements = document.querySelectorAll('.countdown-timer');
    countdownElements.forEach(updateCountdown);
    setInterval(() => countdownElements.forEach(updateCountdown), 1000);

    // Setup USDT modal
    setupUSDTModal();
});
</script>

<!-- External Dependencies -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

@endsection
