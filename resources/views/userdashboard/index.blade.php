@extends('userdashboard.master')

@section('content')
<h1 class="dashboard-header">Dashboard</h1>

<div class="cards-grid" aria-label="Stats">
    <div class="card" tabindex="0">
        <div class="icon">💰</div>
        <div>
            <div class="label">Win Balance </div>
            <div class="value">${{round($winbalance)}}</div>
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
            <div class="label">Referral commission</div>
            <div class="value">${{ round($referIncome) }}</div>
        </div>
    </div>

    <!--@foreach($generationIncomePerLevel as $level => $amount)-->
    <!--<div class="card" tabindex="0">-->
    <!--    <div class="icon">🔗</div>-->
    <!--    <div>-->
    <!--        <div class="label">Generation Level {{ $level }} ({{ $commissionSetting->{'generation_level_'.$level} ?? 0 }}%)</div>-->
    <!--        <div class="value">${{ round($amount) }}</div>-->
    <!--    </div>-->
    <!--</div>-->
    <!--@endforeach-->

    <!--<div class="card" tabindex="0">-->
    <!--    <div class="icon">🏢</div>-->
    <!--    <div>-->
    <!--        <div class="label">Weekly Team Deposit</div>-->
    <!--        <div class="value">${{ round($weeklyDeposit) }}</div>-->
    <!--    </div>-->
    <!--</div>-->

    <!--<div class="card" tabindex="0">-->
    <!--    <div class="icon">💵</div>-->
    <!--    <div>-->
    <!--        <div class="label">Weekly Team Commission ({{ $commissionSetting->weekly_team_commission ?? 0 }}%)</div>-->
    <!--        <div class="value">${{ round($weeklyTeamCommission) }}</div>-->
    <!--    </div>-->
    <!--</div>-->

    <div class="card" tabindex="0">
        <div class="icon">💎</div>
        <div>
            <div class="label">Main Balance</div>
            <div class="value">${{ round($mainBalance) }}</div>
        </div>
    </div>
@php
    use App\Models\Setting;

    $telegram = Setting::first(); // get first setting record
@endphp

<!--<div class="card" tabindex="0" style="display:flex; align-items:center; padding:16px; border-radius:12px; background:#f5f5f5; box-shadow:0 4px 6px rgba(0,0,0,0.1); width:250px; margin:10px;">-->
<!--    {{-- Telegram Icon (Font Awesome) --}}-->
<!--    <div class="icon" style="font-size:24px; margin-right:12px; color:#0088cc;">-->
<!--        <i class="fab fa-telegram-plane"></i>-->
<!--    </div>-->

<!--    <div>-->
<!--        <div class="label" style="font-weight:bold; color:#333;">Telegram</div>-->
<!--        <div class="value" style="color:#555;">-->
<!--            {{ $telegram->telegram ?? '' }}-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->

</div>

@endsection
