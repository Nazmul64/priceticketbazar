@extends('Frontend.master')

@section('content')
<div class="register-container">
    <!-- Animated Background -->
    <div class="bg-gradient"></div>
    <div class="floating-orbs">
        <div class="orb orb-1"></div>
        <div class="orb orb-2"></div>
        <div class="orb orb-3"></div>
    </div>

    <div class="register-wrapper">
        <div class="register-card">
            <div class="card-header">
                <div class="logo-container">
                    <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Logo" class="logo">
                </div>
                <h1>Welcome Back</h1>
                <p>Create your account to get started</p>
            </div>

           <form action="{{ route('register.submit') }}" method="POST" class="form" novalidate>
    @csrf

    <div class="input-grid">
        {{-- Full Name --}}
        <div class="input-wrapper">
            <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            <label for="name">Full Name</label>
            <div class="input-highlight"></div>
            @error('name')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        {{-- Phone --}}
        <div class="input-wrapper phone-wrapper">
            <div class="phone-container">
                <input type="tel" name="phone" id="phone" value="{{ old('phone') }}" required>
                <label for="phone">Phone Number</label>
            </div>
            <div class="input-highlight"></div>
            @error('phone')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        {{-- Email --}}
        <div class="input-wrapper">
            <input type="email" name="email" id="email" value="{{ old('email') }}" required>
            <label for="email">Email Address</label>
            <div class="input-highlight"></div>
            @error('email')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        {{-- Referral Code (Optional) --}}
        <div class="input-wrapper">
            <input type="text" name="ref_code" id="ref_code" value="{{ old('ref_code', request('ref')) }}">
            <label for="ref_code">Referral Code</label>
            <div class="input-highlight"></div>
            <small class="helper-text">Optional</small>
            @error('ref_code')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        {{-- Username --}}
        <div class="input-wrapper">
            <input type="text" name="username" id="username" value="{{ old('username') }}" required>
            <label for="username">Username</label>
            <div class="input-highlight"></div>
            @error('username')<span class="error-msg">{{ $message }}</span>@enderror
        </div>

        {{-- Password --}}
        <div class="input-wrapper password-wrapper">
            <input type="password" name="password" id="password" required>
            <label for="password">Password</label>
            <button type="button" class="toggle-password" onclick="togglePassword('password')">👁</button>
            <div class="input-highlight"></div>
            @error('password')<span class="error-msg">{{ $message }}</span>@enderror
        </div>
    </div>

    {{-- Confirm Password --}}
    <div class="input-wrapper full-width">
        <input type="password" name="password_confirmation" id="password_confirmation" required>
        <label for="password_confirmation">Confirm Password</label>
        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">👁</button>
        <div class="input-highlight"></div>
    </div>

    {{-- Terms --}}
    <div class="checkbox-wrapper">
        <input type="checkbox" name="terms" id="terms" required>
        <label for="terms">
            <span class="checkmark"></span>
            I agree to the <a href="#" class="link">Terms & Conditions</a>
        </label>
    </div>

    {{-- Submit --}}
    <button type="submit" class="submit-btn">
        <span class="btn-text">Create Account</span>
        <div class="btn-loader"><div class="spinner"></div></div>
    </button>

    <div class="form-footer">
        <p>Already have an account? <a href="{{ route('user.login') }}" class="link">Sign In</a></p>
    </div>
</form>

        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling.nextElementSibling;
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
        }
    });
});
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

.register-container {
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

.register-wrapper {
    position: relative;
    z-index: 10;
    width: 100%;
    max-width: 480px;
}

.register-card {
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

.register-card:hover {
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

.input-grid {
    display: grid;
    grid-template-columns: 1fr;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Base input styles */
.input-wrapper input {
    width: 100%;
    height: 3.5rem;
    padding: 1rem 1rem 0.5rem;
    border: 2px solid var(--gray-200);
    border-radius: var(--radius-lg);
    background: rgba(255, 255, 255, 0.8);
    backdrop-filter: blur(10px);
    font-size: 1rem;
    color: var(--gray-700);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    outline: none;
}

/* Medium devices (tablets) - 768px and up */
@media (min-width: 768px) {
    .register-wrapper {
        max-width: 550px;
    }

    .input-grid {
        grid-template-columns: 1fr 1fr;
        gap: 1.75rem;
    }

    .input-wrapper input {
        height: 4rem;
        padding: 1.25rem 1rem 0.75rem;
        font-size: 1.1rem;
    }

    .register-card {
        padding: 3rem;
    }
}

/* Large devices (desktops) - 1024px and up */
@media (min-width: 1024px) {
    .register-wrapper {
        max-width: 650px;
    }

    .input-grid {
        gap: 2rem;
    }

    .input-wrapper input {
        height: 4.5rem;
        padding: 1.5rem 1.25rem 1rem;
        font-size: 1.125rem;
        border-radius: var(--radius-xl);
    }

    .register-card {
        padding: 3.5rem;
    }

    .submit-btn {
        height: 4rem;
        font-size: 1.125rem;
    }
}

/* Extra large devices - 1280px and up */
@media (min-width: 1280px) {
    .register-wrapper {
        max-width: 750px;
    }

    .input-wrapper input {
        height: 5rem;
        padding: 1.75rem 1.5rem 1.25rem;
        font-size: 1.2rem;
    }

    .register-card {
        padding: 4rem;
    }

    .submit-btn {
        height: 4.5rem;
        font-size: 1.2rem;
    }
}

.input-wrapper {
    position: relative;
}

.full-width {
    grid-column: 1 / -1;
}

.input-wrapper label {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-400);
    font-size: 1rem;
    font-weight: 400;
    pointer-events: none;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: transparent;
}

/* Responsive label adjustments for larger screens */
@media (min-width: 1024px) {
    .input-wrapper label {
        left: 1.25rem;
        font-size: 1.125rem;
    }
}

@media (min-width: 1280px) {
    .input-wrapper label {
        left: 1.5rem;
        font-size: 1.2rem;
    }
}

.input-wrapper input:focus,
.input-wrapper input:not(:placeholder-shown) {
    border-color: var(--primary);
    background: rgba(255, 255, 255, 0.95);
}

.input-wrapper input:focus + label,
.input-wrapper input:not(:placeholder-shown) + label {
    top: 0.75rem;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--primary);
    transform: translateY(0);
}

/* Responsive focused label adjustments */
@media (min-width: 1024px) {
    .input-wrapper input:focus + label,
    .input-wrapper input:not(:placeholder-shown) + label {
        top: 1rem;
        font-size: 0.875rem;
    }
}

@media (min-width: 1280px) {
    .input-wrapper input:focus + label,
    .input-wrapper input:not(:placeholder-shown) + label {
        top: 1.25rem;
        font-size: 1rem;
    }
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

.phone-container {
    position: relative;
    display: flex;
    align-items: center;
    width: 100%;
}

.country-code {
    position: absolute;
    left: 1rem;
    top: 50%;
    transform: translateY(-50%);
    color: var(--gray-600);
    font-weight: 600;
    font-size: 1rem;
    z-index: 2;
    background: transparent;
    pointer-events: none;
}

/* Responsive country code adjustments */
@media (min-width: 1024px) {
    .country-code {
        left: 1.25rem;
        font-size: 1.125rem;
    }
}

@media (min-width: 1280px) {
    .country-code {
        left: 1.5rem;
        font-size: 1.2rem;
    }
}

.phone-wrapper input {
    padding-left: 4.5rem;
}

.phone-wrapper label {
    left: 4.5rem;
}

/* Responsive phone wrapper adjustments */
@media (min-width: 1024px) {
    .phone-wrapper input {
        padding-left: 5rem;
    }

    .phone-wrapper label {
        left: 5rem;
    }
}

@media (min-width: 1280px) {
    .phone-wrapper input {
        padding-left: 5.5rem;
    }

    .phone-wrapper label {
        left: 5.5rem;
    }
}

/* Fixed phone label positioning - এইটাই মূল সমাধান */
.phone-wrapper input:focus + label,
.phone-wrapper input:not(:placeholder-shown) + label {
    left: 1rem;
    top: 0.75rem;
    font-size: 0.75rem;
    background: rgba(255, 255, 255, 0.9);
    padding: 0 0.25rem;
    border-radius: 2px;
}

/* Responsive phone focused label adjustments */
@media (min-width: 1024px) {
    .phone-wrapper input:focus + label,
    .phone-wrapper input:not(:placeholder-shown) + label {
        left: 1.25rem;
        top: 1rem;
        font-size: 0.875rem;
    }
}

@media (min-width: 1280px) {
    .phone-wrapper input:focus + label,
    .phone-wrapper input:not(:placeholder-shown) + label {
        left: 1.5rem;
        top: 1.25rem;
        font-size: 1rem;
    }
}

.password-wrapper {
    position: relative;
}

.toggle-password {
    position: absolute;
    right: 1rem;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--gray-400);
    cursor: pointer;
    padding: 0.25rem;
    border-radius: var(--radius-sm);
    transition: all 0.2s ease;
    z-index: 3;
}

/* Responsive toggle password adjustments */
@media (min-width: 1024px) {
    .toggle-password {
        right: 1.25rem;
        padding: 0.5rem;
    }
}

@media (min-width: 1280px) {
    .toggle-password {
        right: 1.5rem;
    }
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

/* Responsive eye icon adjustments */
@media (min-width: 1024px) {
    .eye-icon {
        width: 1.5rem;
        height: 1.5rem;
    }
}

.helper-text {
    position: absolute;
    right: 0.75rem;
    top: 0.75rem;
    font-size: 0.75rem;
    color: var(--gray-400);
    font-weight: 500;
}

/* Responsive helper text adjustments */
@media (min-width: 1024px) {
    .helper-text {
        right: 1rem;
        top: 1rem;
        font-size: 0.875rem;
    }
}

@media (min-width: 1280px) {
    .helper-text {
        right: 1.25rem;
        top: 1.25rem;
        font-size: 1rem;
    }
}

.error-msg {
    position: absolute;
    bottom: -1.25rem;
    left: 0;
    color: var(--error);
    font-size: 0.75rem;
    font-weight: 500;
}

.input-wrapper.invalid input {
    border-color: var(--error);
    background: rgba(239, 68, 68, 0.05);
}

.checkbox-wrapper {
    display: flex;
    align-items: flex-start;
    gap: 0.75rem;
    margin-bottom: 2rem;
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
    align-items: flex-start;
    gap: 0.75rem;
    line-height: 1.5;
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
    margin-bottom: 1.5rem;
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
}

.form-footer p {
    color: var(--gray-500);
    font-size: 0.875rem;
}

.alert {
    padding: 0.75rem 1rem;
    border-radius: var(--radius-md);
    font-size: 0.875rem;
    font-weight: 500;
    margin-top: 1rem;
    border: 1px solid;
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

@media (max-width: 640px) {
    .register-card {
        padding: 1.5rem;
        margin: 0.5rem;
        border-radius: var(--radius-lg);
    }

    .card-header h1 {
        font-size: 1.75rem;
    }

    .input-grid {
        grid-template-columns: 1fr;
        gap: 1.25rem;
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
.link:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}

input:focus-visible {
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}
</style>
