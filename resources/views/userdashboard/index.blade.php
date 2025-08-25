@extends('userdashboard.master')

@section('content')
<h1 class="dashboard-header">Dashboard</h1>

<div class="cards-grid" aria-label="Stats">
    <div class="card" tabindex="0">
        <div class="icon">💰</div>
        <div>
            <div class="label">Total Invest</div>
            <div class="value">${{ round($totalInvest) }}</div>
        </div>
    </div>

    <div class="card" tabindex="0">
        <div class="icon">💳</div>
        <div>
            <div class="label">Total Deposit</div>
            <div class="value">${{ round($mainDeposit) }}</div>
        </div>
    </div>

    <div class="card" tabindex="0">
        <div class="icon">👥</div>
        <div>
            <div class="label">Direct Referral ({{ $commissionSetting->refer_commission ?? 0 }}%)</div>
            <div class="value">${{ round($referIncome) }}</div>
        </div>
    </div>

    @foreach($generationIncomePerLevel as $level => $amount)
    <div class="card" tabindex="0">
        <div class="icon">🔗</div>
        <div>
            <div class="label">Generation Level {{ $level }} ({{ $commissionSetting->{'generation_level_'.$level} ?? 0 }}%)</div>
            <div class="value">${{ round($amount) }}</div>
        </div>
    </div>
    @endforeach

    <div class="card" tabindex="0">
        <div class="icon">🏢</div>
        <div>
            <div class="label">Weekly Team Deposit</div>
            <div class="value">${{ round($weeklyDeposit) }}</div>
        </div>
    </div>

    <div class="card" tabindex="0">
        <div class="icon">💵</div>
        <div>
            <div class="label">Weekly Team Commission ({{ $commissionSetting->weekly_team_commission ?? 0 }}%)</div>
            <div class="value">${{ round($weeklyTeamCommission) }}</div>
        </div>
    </div>

    <div class="card" tabindex="0">
        <div class="icon">💎</div>
        <div>
            <div class="label">Main Balance</div>
            <div class="value">${{ round($mainBalance) }}</div>
        </div>
    </div>
</div>

<section class="referral-section" aria-label="Referral URL">
    <label for="referral-url">Referral URL</label>
    @if(auth()->user() && auth()->user()->ref_code)
        <input id="referral-url" type="text" readonly
               value="{{ url('/register?ref=' . auth()->user()->ref_code) }}" />
    @else
        <input id="referral-url" type="text" readonly
               value="Referral code not available"
               style="color: red;" />
    @endif
    <button class="copy-btn" id="copyReferralBtn">Copy</button>
</section>

<script>
document.getElementById('copyReferralBtn').addEventListener('click', function() {
    let input = document.getElementById('referral-url');

    // Check if there's a valid referral URL
    if (input.value === 'Referral code not available' || input.value.trim() === '') {
        alert('No referral code available to copy!');
        return;
    }

    input.select();
    input.setSelectionRange(0, 99999);

    try {
        // Modern way
        navigator.clipboard.writeText(input.value).then(function() {
            alert('Referral link copied successfully!');
        }).catch(function() {
            // Fallback for older browsers
            document.execCommand('copy');
            alert('Referral link copied!');
        });
    } catch (err) {
        // Final fallback
        document.execCommand('copy');
        alert('Referral link copied!');
    }
});
</script>

<style>
.dashboard-header {
    margin-bottom: 20px;
    color: #333;
}

.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0px 4px 12px rgba(0,0,0,0.1);
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid #f0f0f0;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0px 6px 20px rgba(0,0,0,0.15);
}

.card:focus {
    outline: 2px solid #007bff;
    outline-offset: 2px;
}

.icon {
    font-size: 32px;
    min-width: 40px;
    text-align: center;
}

.label {
    font-size: 14px;
    color: #666;
    margin-bottom: 5px;
    font-weight: 500;
}

.value {
    font-size: 24px;
    font-weight: bold;
    color: #333;
}

.referral-section {
    margin-top: 30px;
    width: 100%;
    display: flex;
    flex-direction: column;
    gap: 15px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    background-color: rgba(26, 58, 61, 0.85);
    padding: 20px;
    border-radius: 10px;
    border: 1px solid #dee2e6;
}

.referral-section label {
    font-weight: 600;
    color: #333;
    margin-bottom: 5px;
}

.referral-section input {
    width: 100%;
    padding: 10px 12px;
    border-radius: 6px;
    border-top: 1px solid rgba(255, 255, 255, 0.1);
    background-color: rgba(26, 58, 61, 0.85);
    font-size: 14px;
    box-sizing: border-box;
}

.referral-section input:focus {
    outline: none;
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}

.copy-btn {
    width: 100%;
    padding: 12px 16px;
    background: #28a745;
    color: #fff;
    border-radius: 6px;
    cursor: pointer;
    border: none;
    font-weight: 600;
    font-size: 16px;
    transition: background-color 0.2s ease;
}

.copy-btn:hover {
    background: #218838;
}

.copy-btn:active {
    background: #1e7e34;
}

@media (max-width: 768px) {
    .cards-grid {
        grid-template-columns: 1fr;
        gap: 15px;
    }

    .referral-section {
        max-width: 100%;
    }
}
</style>

@endsection
