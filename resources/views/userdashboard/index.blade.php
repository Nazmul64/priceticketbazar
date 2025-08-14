@extends('userdashboard.master')
@section('content')
    <h1 class="dashboard-header">Dashboard</h1>

      <div class="cards-grid" aria-label="Stats">
        <div class="card" tabindex="0">
          <div class="icon">💰</div>
          <div>
            <div class="label">Total Invest</div>
            <div class="value">64820$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💳</div>
          <div>
            <div class="label">Total Deposit</div>
            <div class="value">815$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">🏧</div>
          <div>
            <div class="label">Total Withdraw</div>
            <div class="value">325$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
        <div class="card" tabindex="0">
          <div class="icon">💵</div>
          <div>
            <div class="label">Main Balance</div>
            <div class="value">6838.32$</div>
          </div>
        </div>
      </div>

      <section class="referral-section" aria-label="Referral URL">
        <label for="referral-url">Referral URL</label>
        <input
          id="referral-url"
          type="text"
          readonly
          value="https://nhgellary.shop/refer/xyz123"
        />
        <button class="copy-btn" id="copyReferralBtn">Copy</button>
      </section>

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
