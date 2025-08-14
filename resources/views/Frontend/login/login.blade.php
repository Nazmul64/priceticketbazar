@extends('Frontend.master')

@section('content')
<div class="login-container">
    <!-- Animated Background -->
    <div class="bg-gradient"></div>
    <div class="floating-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="login-wrapper">
        <div class="login-card">
            <div class="card-header">
                <div class="logo-container">
                    <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Logo" class="logo">
                </div>
                <h1>Welcome Back</h1>
                <p>Sign in to your account</p>
            </div>

            <!-- Session Alerts -->
            @if(session('success'))
                <div class="alert success">
                    <svg class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    {{ session('success') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert error">
                    <svg class="alert-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="15" y1="9" x2="9" y2="15"/>
                        <line x1="9" y1="9" x2="15" y2="15"/>
                    </svg>
                    {{ session('error') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                            <line x1="18" y1="6" x2="6" y2="18"></line>
                            <line x1="6" y1="6" x2="18" y2="18"></line>
                        </svg>
                    </button>
                </div>
            @endif

            <form method="POST" action="{{ route('login.submit') }}" class="form" novalidate>
                @csrf

                <div class="input-grid">
                    <!-- Email Input -->
                    <div class="input-wrapper">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email', 'user@gmail.com') }}"
                            required
                            autocomplete="email"
                            class="@error('email') invalid @enderror"
                        >
                        <label for="email">Email Address</label>
                        <div class="input-highlight"></div>
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                <polyline points="22,6 12,13 2,6"/>
                            </svg>
                        </div>
                        @error('email')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Password Input -->
                    <div class="input-wrapper password-wrapper">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            class="@error('password') invalid @enderror"
                        >
                        <label for="password">Password</label>
                        <div class="input-highlight"></div>
                        <div class="input-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"/>
                                <circle cx="12" cy="16" r="1"/>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"/>
                            </svg>
                        </div>
                        <button type="button" class="toggle-password" onclick="togglePassword('password')" aria-label="Toggle password visibility">
                            <svg class="eye-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </button>
                        @error('password')
                            <span class="error-msg">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Remember & Forgot -->
                <div class="form-options">
                    <div class="checkbox-wrapper">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            <span class="checkmark"></span>
                            Remember Me
                        </label>
                    </div>
                    <a href="#" class="forgot-link">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <span class="btn-text">Sign In</span>
                    <div class="btn-loader">
                        <div class="spinner"></div>
                    </div>
                </button>

                <!-- Register Link -->
                <div class="form-footer">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="link">Create Account</a></p>
                </div>
            </form>

            <!-- Social Login (Optional) -->
            <div class="divider">
                <span>or continue with</span>
            </div>

            <div class="social-buttons">
                <button type="button" class="social-btn google">
                    <svg class="social-icon" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>

                <button type="button" class="social-btn facebook">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="#1877F2">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                    Facebook
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.parentElement.querySelector('.toggle-password');
    const icon = button.querySelector('.eye-icon');

    if (field.type === 'password') {
        field.type = 'text';
        icon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
    } else {
        field.type = 'password';
        icon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>';
    }
}

// Form submission animation
document.querySelector('.form').addEventListener('submit', function(e) {
    const btn = document.querySelector('.submit-btn');
    btn.classList.add('loading');
});

// Input validation animations
document.querySelectorAll('input[required]').forEach(input => {
    input.addEventListener('invalid', function() {
        this.parentElement.classList.add('invalid');
    });

    input.addEventListener('input', function() {
        if (this.validity.valid) {
            this.parentElement.classList.remove('invalid');
            this.classList.remove('invalid');
        }
    });
});

// Auto-hide alerts
setTimeout(() => {
    document.querySelectorAll('.alert').forEach(alert => {
        alert.style.opacity = '0';
        alert.style.transform = 'translateY(-10px)';
        setTimeout(() => alert.remove(), 300);
    });
}, 5000);
</script>
@endsection

<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --secondary: #8b5cf6;
    --accent: #06b6d4;
    --success: #10b981;
    --error: #ef4444;
    --warning: #f59e0b;
    --white: #ffffff;
    --gray-50: #f9fafb;
    --gray-100: #f3f4f6;
    --gray-200: #e5e7eb;
    --gray-300: #d1d5db;
    --gray-400: #9ca3af;
    --gray-500: #6b7280;
    --gray-600: #4b5563;
    --gray-700: #374151;
    --gray-800: #1f2937;
    --gray-900: #111827;
    --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
    --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
    --radius-sm: 0.375rem;
    --radius-md: 0.5rem;
    --radius-lg: 0.75rem;
    --radius-xl: 1rem;
}

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.login-container {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    overflow: hidden;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
}

.bg-gradient {
    position: absolute;
    inset: 0;
    background:
        radial-gradient(circle at 20% 80%, rgba(120, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255, 119, 198, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 40% 40%, rgba(120, 219, 255, 0.3) 0%, transparent 50%);
    animation: gradientShift 8s ease-in-out infinite;
}

@keyframes gradientShift {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

.floating-orbs {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.orb {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(255,255,255,0.1), rgba(255,255,255,0.2));
    backdrop-filter: blur(20px);
    animation: float 6s ease-in-out infinite;
}

.orb-1 {
    width: 300px;
    height: 300px;
    top: -150px;
    right: -150px;
    animation-delay: 0s;
}

.orb-2 {
    width: 200px;
    height: 200px;
    bottom: -100px;
    left: -100px;
    animation-delay: 2s;
}

.orb-3 {
    width: 150px;
    height: 150px;
    top: 50%;
    left: 10%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    33% { transform: translateY(-30px) rotate(120deg); }
    66% { transform: translateY(15px) rotate(240deg); }
}

.login-wrapper {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 420px;
}

.login-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-xl);
    box-shadow:
        var(--shadow-xl),
        0 0 0 1px rgba(255, 255, 255, 0.05);
    padding: 2.5rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.login-card:hover {
    transform: translateY(-5px);
    box-shadow:
        0 25px 50px -12px rgba(0, 0, 0, 0.25),
        0 0 0 1px rgba(255, 255, 255, 0.1);
}

.card-header {
    text-align: center;
    margin-bottom: 2rem;
}

.logo-container {
    margin-bottom: 1.5rem;
}

.logo {
    width: 80px;
    height: auto;
    filter: drop-shadow(0 4px 8px rgba(0,0,0,0.1));
    transition: transform 0.3s ease;
}

.logo:hover {
    transform: scale(1.05);
}

.card-header h1 {
    font-size: 2rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.5rem;
    line-height: 1.2;
}

.card-header p {
    color: var(--gray-500);
    font-size: 1rem;
    font-weight: 400;
}

/* Alert Styles */
.alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    border-radius: var(--radius-lg);
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    border: 1px solid;
    position: relative;
    transition: all 0.3s ease;
}

.alert.success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    border-color: rgba(16, 185, 129, 0.2);
}

.alert.error {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error);
    border-color: rgba(239, 68, 68, 0.2);
}

.alert-icon {
    width: 1.25rem;
    height: 1.25rem;
    stroke-width: 2;
    flex-shrink: 0;
}

.alert-close {
    position: absolute;
    right: 0.75rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: inherit;
    opacity: 0.7;
    transition: opacity 0.2s ease;
    padding: 0.25rem;
    border-radius: var(--radius-sm);
}

.alert-close:hover {
    opacity: 1;
}

.alert-close svg {
    width: 1rem;
    height: 1rem;
    stroke-width: 2;
}

/* Form Styles */
.form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.input-wrapper {
    position: relative;
}

.input-wrapper input {
    width: 100%;
    height: 4rem;
    padding: 1.5rem 1rem 0.5rem 3.5rem;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    font-size: 1rem;
    color: var(--gray-700);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
    margin-top:20px;
}

.input-wrapper input::placeholder {
    color: transparent;
}

.input-wrapper label {
    position: absolute;
    left: 3.5rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    font-size: 1rem;
    font-weight: 400;
    pointer-events: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: rgba(255, 255, 255, 0.9);
    padding: 0 0.25rem;
    z-index: 2;
}

.input-wrapper input:focus,
.input-wrapper input:not(:placeholder-shown),
.input-wrapper input:valid {
    border-color: var(--primary);
    background: rgba(255, 255, 255, 0.95);
}

.input-wrapper input:focus + label,
.input-wrapper input:not(:placeholder-shown) + label,
.input-wrapper input:valid + label {
    top: 0;
    left: 1rem;
    font-size: 0.75rem;
    font-weight: 600;
    color: var(--primary);
    transform: translateY(-50%);
    background: rgba(255, 255, 255, 0.95);
}

.input-icon {
    position: absolute;
    left: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    transition: color 0.3s ease;
    pointer-events: none;
    z-index: 1;
}

.input-icon svg {
    width: 1.25rem;
    height: 1.25rem;
    stroke-width: 2;
}

.input-wrapper input:focus ~ .input-icon {
    color: var(--primary);
}

.input-highlight {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 2px;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    transform: translateX(-50%);
}

.input-wrapper input:focus ~ .input-highlight {
    width: 100%;
}

.toggle-password {
    position: absolute;
    right: 1.25rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0.5rem;
    border-radius: var(--radius-sm);
    transition: all 0.2s ease;
    z-index: 3;
}

.toggle-password:hover {
    color: var(--gray-600);
    background: var(--gray-100);
}

.eye-icon {
    width: 1.25rem;
    height: 1.25rem;
    stroke-width: 2;
}

.error-msg {
    position: absolute;
    bottom: -1.25rem;
    left: 0;
    color: var(--error);
    font-size: 0.75rem;
    font-weight: 500;
}

.input-wrapper.invalid input,
.input-wrapper input.invalid {
    border-color: var(--error);
    background: rgba(239, 68, 68, 0.05);
}

.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.checkbox-wrapper input[type="checkbox"] {
    display: none;
}

.checkmark {
    position: relative;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid var(--gray-300);
    border-radius: var(--radius-sm);
    background: var(--white);
    transition: all 0.2s ease;
    flex-shrink: 0;
    cursor: pointer;
}

.checkbox-wrapper input:checked + label .checkmark {
    background: var(--primary);
    border-color: var(--primary);
}

.checkbox-wrapper input:checked + label .checkmark::after {
    content: '';
    position: absolute;
    top: 2px;
    left: 6px;
    width: 4px;
    height: 8px;
    border: 2px solid var(--white);
    border-top: 0;
    border-left: 0;
    transform: rotate(45deg);
}

.checkbox-wrapper label {
    font-size: 0.875rem;
    color: var(--gray-600);
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    line-height: 1.5;
}

.forgot-link {
    color: var(--primary);
    text-decoration: none;
    font-size: 0.875rem;
    font-weight: 500;
    transition: color 0.2s ease;
}

.forgot-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

.submit-btn {
    position: relative;
    width: 100%;
    height: 3.5rem;
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: var(--white);
    border: none;
    border-radius: var(--radius-lg);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.submit-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
    transition: left 0.6s ease;
}

.submit-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-lg);
}

.submit-btn:hover::before {
    left: 100%;
}

.submit-btn:active {
    transform: translateY(0);
}

.btn-loader {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: inherit;
    opacity: 0;
    transition: opacity 0.3s ease;
}

.submit-btn.loading .btn-text {
    opacity: 0;
}

.submit-btn.loading .btn-loader {
    opacity: 1;
}

.spinner {
    width: 1.5rem;
    height: 1.5rem;
    border: 2px solid rgba(255,255,255,0.3);
    border-top: 2px solid var(--white);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

.form-footer {
    text-align: center;
    margin-top: 1rem;
}

.form-footer p {
    color: var(--gray-500);
    font-size: 0.875rem;
}

.link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    transition: color 0.2s ease;
}

.link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

/* Social Login */
.divider {
    position: relative;
    text-align: center;
    margin: 2rem 0 1.5rem;
}

.divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--gray-200);
}

.divider span {
    background: rgba(255, 255, 255, 0.95);
    color: var(--gray-400);
    font-size: 0.875rem;
    padding: 0 1rem;
    position: relative;
    z-index: 1;
}

.social-buttons {
    display: flex;
    gap: 1rem;
}

.social-btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    height: 3rem;
    border: 2px solid var(--gray-200);
    background: var(--white);
    border-radius: var(--radius-lg);
    font-size: 0.875rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.social-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    border-color: var(--gray-300);
}

.social-icon {
    width: 1.25rem;
    height: 1.25rem;
}

.social-btn.google {
    color: var(--gray-700);
}

.social-btn.facebook {
    color: #1877F2;
}

@media (max-width: 640px) {
    .login-card {
        padding: 2rem;
        margin: 0.5rem;
        border-radius: var(--radius-lg);
    }

    .card-header h1 {
        font-size: 1.75rem;
    }

    .social-buttons {
        flex-direction: column;
    }
}

/* Enhanced accessibility */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Focus visibility for keyboard navigation */
.submit-btn:focus-visible,
.toggle-password:focus-visible,
.link:focus-visible,
.forgot-link:focus-visible,
.social-btn:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}

input:focus-visible {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

/* Smooth page transitions */
.login-container {
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading state improvements */
.submit-btn.loading {
    pointer-events: none;
    cursor: not-allowed;
}

/* Custom scrollbar for better UX */
::-webkit-scrollbar {
    width: 8px;
}

::-webkit-scrollbar-track {
    background: var(--gray-100);
    border-radius: var(--radius-sm);
}

::-webkit-scrollbar-thumb {
    background: var(--gray-300);
    border-radius: var(--radius-sm);
}

::-webkit-scrollbar-thumb:hover {
    background: var(--gray-400);
}

/* Dark mode support (if needed) */
@media (prefers-color-scheme: dark) {
    .login-card {
        background: rgba(31, 41, 55, 0.95);
        color: var(--white);
    }

    .card-header p {
        color: var(--gray-300);
    }

    .input-wrapper input {
        background: rgba(55, 65, 81, 0.8);
        color: var(--white);
        border-color: var(--gray-600);
    }

    .input-wrapper label {
        color: var(--gray-400);
    }

    .checkbox-wrapper label {
        color: var(--gray-300);
    }

    .form-footer p {
        color: var(--gray-400);
    }

    .social-btn {
        background: rgba(55, 65, 81, 0.8);
        border-color: var(--gray-600);
        color: var(--white);
    }

    .divider span {
        background: rgba(31, 41, 55, 0.95);
    }
}

/* Print styles */
@media print {
    .login-container {
        background: white !important;
    }

    .floating-orbs,
    .bg-gradient {
        display: none !important;
    }

    .login-card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
    }
}
</style>
