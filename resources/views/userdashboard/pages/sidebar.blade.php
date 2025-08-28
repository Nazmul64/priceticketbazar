<aside id="sidebar" class="sidebar" aria-label="Sidebar navigation">
      <!-- Close Button -->
      <button id="closeSidebarBtn" class="close-btn" aria-label="Close sidebar">
        ✖
      </button>

      <!-- User Level Info -->
      <div class="level">
        <div class="level-badge">
          <span class="level-number">Level 3</span>
          <span class="star" aria-hidden="true">★</span>
        </div>
        <small class="level-title">{{ auth()->user()->name }}</small>
      </div>


      <!-- Navigation Menu -->
      <nav class="menu" aria-label="Main navigation">
        <ul>
          <li class="menu-section"><strong>General</strong></li>
          <li>
            <a href="{{route('user.dashboard')}}" class="active"><i class="fa">🏠</i>Dashboard</a>
          </li>
          <li>
            <a href="{{route('user.chat')}}"><i class="fa">🔁</i>Live Chart</a>
          </li>

          <li class="menu-section"><strong>Lottery</strong></li>
          <li>
            <a href="{{route('userlotter.index')}}"><i class="fa">📈</i>Lottery</a>
          </li>
          <li>
            <a href="{{route('userlotter.history')}}"><i class="fa">🕘</i>Lottery History</a>
          </li>

          <li class="menu-section"><strong>Transfer & Request</strong></li>
          <li>
            <a href="transfermeny.html"><i class="fa">💱</i>Transfer Money</a>
          </li>
          <li>
            <a href="sendmany.html"><i class="fa">✈️</i>Send Request Money</a>
          </li>
          <li>
            <a href="receivmoneyrequest.html"><i class="fa">🤝</i>Receive Request Money</a>
          </li>

          <li class="menu-section"><strong>Deposits</strong></li>
          <li>
            <a href="{{route('deposite.create')}}"><i class="fa">➕</i>Create Deposit</a>
          </li>
          <li>
            <a href="depositehistory.html"><i class="fa">👛</i>Deposit History</a>
          </li>

          <li class="menu-section"><strong>Payouts</strong></li>
          <li>
            <a href="withrow.html"><i class="fa">💸</i>Payout</a>
          </li>
          <li>
            <a href="withrowhistory.html"><i class="fa">📄</i>Payout History</a>
          </li>

          <li class="menu-section"><strong>Referral</strong></li>
          <li>
            <a href="{{route('my.referrals')}}"><i class="fa">👥</i>Referred Users</a>
          </li>
          <li>
            <a href="{{route('user.commissions')}}"><i class="fa">🎁</i>Referral Commissions</a>
          </li>

          <li class="menu-section"><strong>Account</strong></li>
          <li>
            <a href="supporttecket.html"><i class="fa">🎧</i>Support Ticket</a>
          </li>
          <li>
            <a href="profile.html"><i class="fa">✏️</i>Edit Profile</a>
          </li>
          <li>
            <a href="#"><i class="fa">🔒</i>2FA Security</a>
          </li>
          <li>
            <a href="changepassword.html"><i class="fa">🔑</i>Change Password</a>
          </li>
         <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-link p-0 m-0 align-baseline text-danger">
                    <i class="fa">🚪</i> Logout
                </button>
            </form>
        </li>

        </ul>
      </nav>
    </aside>
