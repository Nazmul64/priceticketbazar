<aside id="sidebar" class="sidebar" aria-label="Sidebar navigation">
      <!-- Close Button -->
      <button id="closeSidebarBtn" class="close-btn" aria-label="Close sidebar">
        ✖
      </button>

      <!-- User Level Info -->
      <div class="level">
        {{-- <div class="level-badge">
          <span class="level-number">Level 3</span>
          <span class="star" aria-hidden="true">★</span>
        </div> --}}
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
            <a href="{{route('user.chat')}}"><i class="fa">🔁</i>Live Chat</a>
          </li>

          <li class="menu-section"><strong>Lottery</strong></li>
          <li>
            <a href="{{route('userlotter.index')}}"><i class="fa">📈</i>Lottery</a>
          </li>

          <li>
            <a href="{{route('userlotter.history')}}"><i class="fa">🕘</i>Lottery History</a>
          </li>

          <li class="menu-section"><strong>Money Exchange</strong></li>
         <li>
            <a href="{{route('indexconvert')}}">💱 Money Exchange</a>
        </li>
         <li class="menu-section"><strong>All ticket</strong></li>
          <li>
            <a href="{{route('all.ticket')}}"><i class="fa">📈</i>All ticket</a>
            <a href="{{route('my.ticket')}}"><i class="fa">📈</i>My ticket</a>
          </li>
          <li class="menu-section"><strong>Deposits</strong></li>
          <li>
            <a href="{{route('deposite.create')}}"><i class="fa">➕</i>Create Deposit</a>
          </li>
          <li>
            <a href="#"><i class="fa">👛</i>Deposit History</a>
          </li>

          <li class="menu-section"><strong>Withdraw</strong></li>
          <li>
            <a href="{{route('Withdraw.index')}}"><i class="fa">💸</i>Withdraw</a>
          </li>
          <li>
            <a href="{{route('Withdraw.history')}}"><i class="fa">📄</i>Withdraw History</a>
          </li>

          <li class="menu-section"><strong>Referral</strong></li>
          <li>
            <a href="{{route('my.referrals')}}"><i class="fa">👥</i>Referred Users</a>
          </li>
          <li>
            <a href="{{route('user.commissions')}}"><i class="fa">🎁</i>Referral Commissions</a>
          </li>

          <li class="menu-section"><strong>Teligram Support</strong></li>
        <li>
            <a href="#"><i class="fa">🎧</i>Support </a>
        </li>

          <li>
            <a href="{{route('profile.index')}}"><i class="fa">✏️</i>Edit Profile</a>
          </li>
          <li>
            <a href="{{route('password.index')}}"><i class="fa">🔑</i>Change Password</a>
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
