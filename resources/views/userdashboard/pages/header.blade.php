<header role="banner">
      <!-- Sidebar toggle button -->
      <button
        class="hamburger"
        id="hamburgerBtn"
        aria-label="Toggle sidebar menu"
        title="Toggle menu"
      >
        ☰
      </button>

      <!-- Header right controls -->
      <div class="header-controls" role="group" aria-label="Header controls">
         <a href="{{route('frontend')}}" class="text-balck"style="background:#F5CE0D;padding:14px;color:white;border-radius:50px;">Home</a>
        <!-- Theme Customizer toggle -->
        <button
          id="themeCustomizerBtn"
          title="Theme Customizer"
          aria-haspopup="true"
          aria-expanded="false"
        >
          🎨
        </button>

        <!-- Dark mode toggle -->
        <button
          id="darkModeToggle"
          aria-pressed="false"
          title="Toggle light/dark"
        >
          ⚙️
        </button>


        <!-- User info -->
        <div class="user-info" aria-label="User">
          <img
            src="https://avatars.githubusercontent.com/u/132064086?s=64&v=4"
            alt="User avatar"
          />
         <span>{{ auth()->user()->name }}</span>
        </div>
      </div>

      <!-- Theme Customizer Panel -->
      <div class="theme-customizer" id="themeCustomizer">
        <h3>Theme Customizer</h3>

        <!-- Theme variation -->
        <div class="theme-section">
          <p>Theme Variation</p>
          <label><input type="radio" name="theme" value="light" /> Light</label>
          <label><input type="radio" name="theme" value="dark" /> Dark</label>
          <label
            ><input type="radio" name="theme" value="semi-dark" checked /> Semi
            Dark</label
          >
          <label
            ><input type="radio" name="theme" value="semi-dark" checked /> Semi
            Dark</label
          >
          <label
            ><input type="radio" name="theme" value="minimal" /> Sidebar
            Theme</label
          >
        </div>

        <!-- Header color selector -->
        <div class="theme-section">
          <p>Header Colors</p>
          <div class="color-palette">
            <span style="background: #2962ff" data-color="#2962ff"></span>
            <span style="background: #1a237e" data-color="#1a237e"></span>
            <span style="background: #d50000" data-color="#d50000"></span>
            <span style="background: #2e7d32" data-color="#2e7d32"></span>
            <span style="background: #6a1b9a" data-color="#6a1b9a"></span>
            <span style="background: #6d4c41" data-color="#6d4c41"></span>
            <span style="background: #c2185b" data-color="#c2185b"></span>
            <span style="background: #ff6d00" data-color="#ff6d00"></span>
          </div>

          <!-- Hidden inputs to store color & alpha -->
          <input type="hidden" id="headerColor" value="#072029" />
          <input type="hidden" id="headerAlpha" value="1" />
        </div>
      </div>
    </header>
