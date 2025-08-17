@extends('userdashboard.master')
@section('content')
    <h1 class="dashboard-header">Dashboard</h1>

     <div class="cards-grid" aria-label="Stats">

    <!-- Total Invest -->
    <div class="card" tabindex="0">
        <div class="icon">💰</div>
        <div>
            <div class="label">Total Invest</div>
            <div class="value">${{ round($totalInvest) }}</div>
        </div>
    </div>

    <!-- Total Deposit -->
    <div class="card" tabindex="0">
        <div class="icon">💳</div>
        <div>
            <div class="label">Total Deposit</div>
            <div class="value">${{ round($mainDeposit) }}</div>
        </div>
    </div>

    <!-- Direct Referral Income -->
    <div class="card" tabindex="0">
        <div class="icon">👥</div>
        <div>
            <div class="label">Direct Referral ({{ $commissionSetting->refer_commission }}%)</div>
            <div class="value">${{ round($user->refer_income) }}</div>
        </div>
    </div>

    <!-- Generation Income -->
    @foreach($generationIncomePerLevel as $level => $amount)
    <div class="card" tabindex="0">
        <div class="icon">🔗</div>
        <div>
            <div class="label">Generation Level {{ $level }} ({{ $commissionSetting->{'generation_level_'.$level} }}%)</div>
            <div class="value">${{ round($amount) }}</div>
        </div>
    </div>
    @endforeach

    <!-- Weekly Team Deposit -->
    <div class="card" tabindex="0">
        <div class="icon">🏢</div>
        <div>
            <div class="label">Weekly Team Deposit (0-500 USD)</div>
            <div class="value">${{ round($weeklyDeposit) }}</div>
        </div>
    </div>

    <!-- Weekly Team Commission -->
    <div class="card" tabindex="0">
        <div class="icon">💵</div>
        <div>
            <div class="label">Weekly Team Commission ({{ $commissionSetting->weekly_team_commission }}%)</div>
            <div class="value">${{ round($weeklyTeamCommission) }}</div>
        </div>
    </div>

    <!-- Main Balance -->
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
    <input
        id="referral-url"
        type="text"
        readonly
        value="{{ url('/register?ref=' . Auth::user()->ref_code) }}"
    />
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
.referral-section {
    margin-top: 20px;
    background-color: transparent;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0px 3px 8px rgba(0,0,0,0.1);
    max-width: 400px;
}
.referral-section label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
}
.referral-section input {
    width: calc(100% - 70px);
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
}
.copy-btn {
    background: #28a745;
    color: white;
    border: none;
    padding: 8px 12px;
    margin-left: 5px;
    border-radius: 6px;
    cursor: pointer;
}
.copy-btn:hover {
    background: #218838;
}
</style>


      <table aria-label="Recent Transactions">
        <thead>
          <tr>
            <th>#</th>
            <th>Type</th>
            <th>Transaction ID</th>
            <th>Amount</th>
            <th>Date</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>DEPOSIT</td>
            <td>abcd1234</td>
            <td class="green-text">+100$</td>
            <td>01 Jul 2025</td>
          </tr>
          <tr>
            <td>2</td>
            <td>WITHDRAW</td>
            <td>vhbkjsdlfdSdf</td>
            <td class="red-text">-20$</td>
            <td>10 Jul 2025</td>
          </tr>
          <tr>
            <td>3</td>
            <td>DEPOSIT</td>
            <td>gfjkdslfjsdklf</td>
            <td class="green-text">50$</td>
            <td>15 Jul 2025</td>
          </tr>
        </tbody>
      </table>
@endsection
