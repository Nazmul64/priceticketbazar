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
            <div class="label">Direct Referral ({{ $commissionSetting->refer_commission }}%)</div>
            <div class="value">${{ round($referIncome) }}</div>
        </div>
    </div>

    @foreach($generationIncomePerLevel as $level => $amount)
    <div class="card" tabindex="0">
        <div class="icon">🔗</div>
        <div>
            <div class="label">Generation Level {{ $level }} ({{ $commissionSetting->{'generation_level_'.$level} }}%)</div>
            <div class="value">${{ round($amount) }}</div>
        </div>
    </div>
    @endforeach

    <div class="card" tabindex="0">
        <div class="icon">🏢</div>
        <div>
            <div class="label">Weekly Team Deposit (0-500 USD)</div>
            <div class="value">${{ round($weeklyDeposit) }}</div>
        </div>
    </div>

    <div class="card" tabindex="0">
        <div class="icon">💵</div>
        <div>
            <div class="label">Weekly Team Commission ({{ $commissionSetting->weekly_team_commission }}%)</div>
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
    <input id="referral-url" type="text" readonly value="{{ url('/register?ref=' . $user->ref_code) }}" />
    <button class="copy-btn" id="copyReferralBtn">Copy</button>
</section>

<script>
document.getElementById('copyReferralBtn').addEventListener('click', function() {
    let input = document.getElementById('referral-url');
    input.select();
    input.setSelectionRange(0, 99999);
    document.execCommand('copy');
    alert('Referral link copied!');
});
</script>

<style>
.cards-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
}
.card {
    background: #fff;
    border-radius: 10px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0px 2px 8px rgba(0,0,0,0.1);
}
.icon { font-size: 30px; }
.referral-section { margin-top: 20px; max-width: 400px; }
.referral-section input { width: calc(100% - 70px); padding: 8px; border-radius: 6px; }
.copy-btn { padding: 8px 12px; background: #28a745; color: #fff; border-radius: 6px; cursor: pointer; }
.copy-btn:hover { background: #218838; }
</style>
@endsection
