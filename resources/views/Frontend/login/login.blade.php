@extends('Frontend.master')

@section('content')
<div class="auth-container">
    <!-- Background Elements -->
    <div class="bg-pattern"></div>
    <div class="floating-shapes">
        <div class="shape shape-1"></div>
        <div class="shape shape-2"></div>
        <div class="shape shape-3"></div>
    </div>

    <!-- Main Content -->
    <div class="auth-wrapper">
        <div class="auth-card">
            <!-- Header -->
            <div class="auth-header">
                <div class="logo-section">
                    <img src="{{ asset('frontend/assets/images/logo.png') }}" alt="Logo" class="logo">
                    <h1 class="auth-title">Welcome back</h1>
                    <p class="auth-subtitle">Sign in to continue to your account</p>
                </div>
            </div>

            <!-- Alert Messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    <svg class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('success') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <svg class="alert-icon" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ session('error') }}
                    <button type="button" class="alert-close" onclick="this.parentElement.remove()">
                        <svg viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
            @endif

            <!-- Login Form -->
            <form method="POST" action="{{ route('login.submit') }}" class="auth-form" novalidate>
                @csrf

                <!-- Email Field -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input
                            type="email"
                            name="email"
                            id="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            placeholder=" "
                            class="form-input @error('email') is-invalid @enderror"
                        >
                        <label for="email" class="form-label">Email address</label>
                        <div class="input-icon">
                            <svg viewBox="0 0 20 20" fill="currentColor">
                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"/>
                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"/>
                            </svg>
                        </div>
                        @error('email')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Password Field -->
                <div class="form-group">
                    <div class="input-wrapper">
                        <input
                            type="password"
                            name="password"
                            id="password"
                            required
                            autocomplete="current-password"
                            placeholder=" "
                            class="form-input @error('password') is-invalid @enderror"
                        >
                        <label for="password" class="form-label">Password</label>
                        <div class="input-icon">
                            <svg viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <button type="button" class="password-toggle" onclick="togglePassword('password')" aria-label="Toggle password visibility">
                            <svg class="eye-open" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z"/>
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd"/>
                            </svg>
                            <svg class="eye-closed" viewBox="0 0 20 20" fill="currentColor" style="display: none;">
                                <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd"/>
                                <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z"/>
                            </svg>
                        </button>
                        @error('password')
                            <span class="error-message">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Form Options -->
                <div class="form-options">
                    <div class="remember-section">
                        <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} class="checkbox-input">
                        <label for="remember" class="checkbox-label">
                            <span class="checkbox-custom"></span>
                            Remember me
                        </label>
                    </div>
                    <a href="#" class="forgot-link">Forgot password?</a>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <span class="btn-text">Sign in</span>
                    <div class="btn-loader">
                        <div class="spinner"></div>
                    </div>
                </button>

                <!-- Register Link -->
                <div class="auth-footer">
                    <span>Don't have an account?</span>
                    <a href="{{ route('register') }}" class="register-link">Create account</a>
                </div>
            </form>

            <!-- Social Login -->
            {{-- <div class="social-divider">
                <span>Or continue with</span>
            </div>

            <div class="social-buttons">
                <button type="button" class="social-btn google-btn">
                    <svg class="social-icon" viewBox="0 0 24 24">
                        <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                        <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                        <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                        <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                    </svg>
                    Google
                </button>

                <button type="button" class="social-btn apple-btn">
                    <svg class="social-icon" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M18.71 19.5c-.83 1.24-1.71 2.45-3.05 2.47-1.34.03-1.77-.79-3.29-.79-1.53 0-2 .77-3.27.82-1.31.05-2.3-1.32-3.14-2.53C4.25 17 2.94 12.45 4.7 9.39c.87-1.52 2.43-2.48 4.12-2.51 1.28-.02 2.5.87 3.29.87.78 0 2.26-1.07 3.81-.91.65.03 2.47.26 3.64 1.98-.09.06-2.17 1.28-2.15 3.81.03 3.02 2.65 4.03 2.68 4.04-.03.07-.42 1.44-1.38 2.83M13 3.5c.73-.83 1.94-1.46 2.94-1.5.13 1.17-.34 2.35-1.04 3.19-.69.85-1.83 1.51-2.95 1.42-.15-1.15.41-2.35 1.05-3.11z"/>
                    </svg>
                    Apple
                </button>
            </div> --}}
        </div>
    </div>
</div>

<script>
// Password toggle functionality
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const eyeOpen = field.parentElement.querySelector('.eye-open');
    const eyeClosed = field.parentElement.querySelector('.eye-closed');

    if (field.type === 'password') {
        field.type = 'text';
        eyeOpen.style.display = 'none';
        eyeClosed.style.display = 'block';
    } else {
        field.type = 'password';
        eyeOpen.style.display = 'block';
        eyeClosed.style.display = 'none';
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // Form submission loading state
    const form = document.querySelector('.auth-form');
    const submitBtn = document.querySelector('.submit-btn');

    form.addEventListener('submit', function() {
        submitBtn.classList.add('loading');
        submitBtn.disabled = true;
    });

    // Input focus animations
    const inputs = document.querySelectorAll('.form-input');
    inputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });

        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });

        // Check if input has value on page load
        if (input.value) {
            input.parentElement.classList.add('focused');
        }
    });

    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.opacity = '0';
            alert.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                if (alert.parentElement) {
                    alert.remove();
                }
            }, 300);
        });
    }, 5000);
});
</script>

<style>
:root {
    --primary: #6366f1;
    --primary-dark: #4f46e5;
    --primary-light: #a5b4fc;
    --secondary: #8b5cf6;
    --accent: #06b6d4;
    --success: #10b981;
    --error: #ef4444;
    --warning: #f59e0b;
    --text-primary: #1f2937;
    --text-secondary: #6b7280;
    --text-light: #9ca3af;
    --border: #e5e7eb;
    --border-focus: #d1d5db;
    --bg-white: #ffffff;
    --bg-gray-50: #f9fafb;
    --bg-gray-100: #f3f4f6;
    --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
    --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1);
    --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
    --radius: 12px;
    --radius-lg: 16px;
    --transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
}

* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

body {
    font-family: 'Inter', system-ui, -apple-system, sans-serif;
    line-height: 1.6;
    color: var(--text-primary);
    -webkit-font-smoothing: antialiased;
}

/* Main Container */
.auth-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1.5rem;
    position: relative;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f093fb 100%);
    background-size: 200% 200%;
    animation: gradientMove 8s ease infinite;
    overflow: hidden;
}

@keyframes gradientMove {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}

.bg-pattern {
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 40%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 40%);
}

.floating-shapes {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.shape {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    animation: float 6s ease-in-out infinite;
}

.shape-1 {
    width: 120px;
    height: 120px;
    top: 20%;
    right: 20%;
    animation-delay: 0s;
}

.shape-2 {
    width: 80px;
    height: 80px;
    bottom: 30%;
    left: 15%;
    animation-delay: 2s;
}

.shape-3 {
    width: 60px;
    height: 60px;
    top: 60%;
    right: 10%;
    animation-delay: 4s;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); opacity: 0.3; }
    50% { transform: translateY(-20px) rotate(180deg); opacity: 0.6; }
}

/* Auth Card */
.auth-wrapper {
    width: 100%;
    max-width: 420px;
    z-index: 10;
}

.auth-card {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-lg);
    padding: 2.5rem;
    box-shadow: var(--shadow-xl);
    transition: var(--transition);
}

.auth-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
}

/* Header */
.auth-header {
    text-align: center;
    margin-bottom: 2rem;
}

.logo {
    width: 48px;
    height: 48px;
    margin-bottom: 1.5rem;
    filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
}

.auth-title {
    font-size: 1.875rem;
    font-weight: 700;
    color: var(--text-primary);
    margin-bottom: 0.5rem;
    letter-spacing: -0.025em;
}

.auth-subtitle {
    font-size: 0.9rem;
    color: var(--text-secondary);
    font-weight: 400;
}

/* Alert Styles */
.alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem;
    border-radius: var(--radius);
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
    font-weight: 500;
    position: relative;
    animation: slideDown 0.3s ease;
}

@keyframes slideDown {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    border: 1px solid rgba(16, 185, 129, 0.2);
}

.alert-error {
    background: rgba(239, 68, 68, 0.1);
    color: var(--error);
    border: 1px solid rgba(239, 68, 68, 0.2);
}

.alert-icon {
    width: 1.25rem;
    height: 1.25rem;
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
    padding: 0.25rem;
    border-radius: 0.25rem;
    transition: var(--transition);
}

.alert-close:hover {
    opacity: 1;
    background: rgba(0, 0, 0, 0.05);
}

.alert-close svg {
    width: 1rem;
    height: 1rem;
}

/* Form Styles */
.auth-form {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

.form-group {
    position: relative;
}

.input-wrapper {
    position: relative;
    transition: var(--transition);
}

.form-input {
    width: 100%;
    height: 56px;
    padding: 16px 16px 16px 48px;
    border: 2px solid var(--border);
    border-radius: var(--radius);
    background: var(--bg-white);
    font-size: 0.9rem;
    color: var(--text-primary);
    transition: var(--transition);
    outline: none;
}

.form-input:focus {
    border-color: var(--primary);
    box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
}

.form-input.is-invalid {
    border-color: var(--error);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

.form-input:not(:placeholder-shown),
.input-wrapper.focused .form-input {
    padding-top: 22px;
    padding-bottom: 10px;
}

.form-label {
    position: absolute;
    left: 48px;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.9rem;
    color: var(--text-light);
    pointer-events: none;
    transition: var(--transition);
    background: var(--bg-white);
    padding: 0 4px;
}

.form-input:not(:placeholder-shown) + .form-label,
.input-wrapper.focused .form-label {
    top: 12px;
    left: 44px;
    font-size: 0.75rem;
    font-weight: 500;
    color: var(--primary);
}

.form-input.is-invalid:not(:placeholder-shown) + .form-label,
.input-wrapper.focused .form-input.is-invalid + .form-label {
    color: var(--error);
}

.input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    color: var(--text-light);
    transition: var(--transition);
}

.input-wrapper.focused .input-icon {
    color: var(--primary);
}

.password-toggle {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    width: 20px;
    height: 20px;
    background: none;
    border: none;
    color: var(--text-light);
    cursor: pointer;
    padding: 0;
    transition: var(--transition);
}

.password-toggle:hover {
    color: var(--text-secondary);
}

.error-message {
    display: block;
    font-size: 0.8rem;
    color: var(--error);
    margin-top: 0.5rem;
    padding-left: 0.25rem;
}

/* Form Options */
.form-options {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0.5rem 0;
}

.remember-section {
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.checkbox-input {
    display: none;
}

.checkbox-label {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 0.875rem;
    color: var(--text-secondary);
    cursor: pointer;
    user-select: none;
}

.checkbox-custom {
    width: 18px;
    height: 18px;
    border: 2px solid var(--border-focus);
    border-radius: 4px;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: var(--transition);
    position: relative;
}

.checkbox-input:checked + .checkbox-label .checkbox-custom {
    background: var(--primary);
    border-color: var(--primary);
}

.checkbox-input:checked + .checkbox-label .checkbox-custom::after {
    content: '✓';
    color: white;
    font-size: 12px;
    font-weight: bold;
}

.forgot-link {
    font-size: 0.875rem;
    color: var(--primary);
    text-decoration: none;
    font-weight: 500;
    transition: var(--transition);
}

.forgot-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

/* Submit Button */
.submit-btn {
    position: relative;
    width: 100%;
    height: 56px;
    background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
    color: white;
    border: none;
    border-radius: var(--radius);
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: var(--transition);
    overflow: hidden;
    margin-top: 0.5rem;
}

.submit-btn:hover:not(:disabled) {
    transform: translateY(-1px);
    box-shadow: var(--shadow-lg);
}

.submit-btn:disabled {
    opacity: 0.7;
    cursor: not-allowed;
}

.btn-loader {
    position: absolute;
    inset: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: var(--transition);
}

.submit-btn.loading .btn-text {
    opacity: 0;
}

.submit-btn.loading .btn-loader {
    opacity: 1;
}

.spinner {
    width: 20px;
    height: 20px;
    border: 2px solid rgba(255, 255, 255, 0.3);
    border-top: 2px solid white;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Auth Footer */
.auth-footer {
    text-align: center;
    font-size: 0.875rem;
    color: var(--text-secondary);
    margin-top: 1.5rem;
}

.register-link {
    color: var(--primary);
    text-decoration: none;
    font-weight: 600;
    margin-left: 0.25rem;
    transition: var(--transition);
}

.register-link:hover {
    color: var(--primary-dark);
    text-decoration: underline;
}

/* Social Login */
.social-divider {
    position: relative;
    text-align: center;
    margin: 2rem 0 1.5rem;
}

.social-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--border);
}

.social-divider span {
    background: rgba(255, 255, 255, 0.95);
    color: var(--text-light);
    font-size: 0.85rem;
    padding: 0 1rem;
    position: relative;
}

.social-buttons {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1rem;
}

.social-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.75rem;
    height: 48px;
    background: var(--bg-white);
    border: 2px solid var(--border);
    border-radius: var(--radius);
    font-size: 0.875rem;
    font-weight: 500;
    cursor: pointer;
    transition: var(--transition);
    color: var(--text-secondary);
}

.social-btn:hover {
    transform: translateY(-1px);
    box-shadow: var(--shadow-md);
    border-color: var(--border-focus);
}

.social-icon {
    width: 18px;
    height: 18px;
}

.apple-btn {
    color: #000;
}

/* Responsive Design */
@media (max-width: 640px) {
    .auth-container {
        padding: 1rem;
    }

    .auth-card {
        padding: 2rem;
    }

    .auth-title {
        font-size: 1.625rem;
    }

    .social-buttons {
        grid-template-columns: 1fr;
    }
}

/* Accessibility */
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}

/* Focus styles for keyboard navigation */
.submit-btn:focus-visible,
.social-btn:focus-visible,
.forgot-link:focus-visible,
.register-link:focus-visible {
    outline: 2px solid var(--primary);
    outline-offset: 2px;
}

.form-input:focus-visible {
    outline: none;
}

/* Print styles */
@media print {
    .auth-container {
        background: white !important;
    }

    .floating-shapes,
    .bg-pattern {
        display: none !important;
    }

    .auth-card {
        box-shadow: none !important;
        border: 1px solid #ccc !important;
    }
}
</style>
@endsection
