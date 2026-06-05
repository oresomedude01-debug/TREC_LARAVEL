@extends('layouts.app')

@section('title', 'Admin Login')

@section('styles')
<style>
  .login-container {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #f8fafc;
    padding: 2rem;
  }

  .login-card {
    background: #fff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 3rem;
    max-width: 420px;
    width: 100%;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
  }

  .login-header {
    text-align: center;
    margin-bottom: 2.5rem;
  }

  .login-logo {
    font-size: 1.5rem;
    font-weight: 900;
    color: #dc2626;
    margin-bottom: 0.5rem;
    font-family: var(--font-h);
  }

  .login-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 0.5rem;
    font-family: var(--font-h);
  }

  .login-subtitle {
    font-size: 0.9rem;
    color: #64748b;
    opacity: 0.8;
  }

  .form-group {
    margin-bottom: 1.5rem;
  }

  .form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 600;
    color: #1e293b;
    margin-bottom: 0.5rem;
    letter-spacing: 0.5px;
  }

  .form-input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    font-size: 1rem;
    color: #1e293b;
    background: #f8fafc;
    transition: all 0.2s;
    font-family: inherit;
  }

  .form-input:focus {
    outline: none;
    border-color: #dc2626;
    background: #fff;
    box-shadow: 0 0 0 3px rgba(220, 38, 38, 0.1);
  }

  .error-message {
    color: #dc2626;
    font-size: 0.875rem;
    margin-top: 0.4rem;
  }

  .login-btn {
    width: 100%;
    padding: 0.875rem 1.5rem;
    background: #dc2626;
    color: #fff;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.2s;
    margin-top: 1.5rem;
    box-shadow: 0 2px 4px rgba(220, 38, 38, 0.15);
  }

  .login-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(220, 38, 38, 0.2);
  }

  .login-btn:active {
    transform: translateY(0);
  }

  .error-alert {
    background: #fee2e2;
    border: 1px solid #fecaca;
    color: #991b1b;
    padding: 1rem;
    border-radius: 8px;
    margin-bottom: 1.5rem;
    font-size: 0.875rem;
  }
</style>
@endsection

@section('content')
<div class="login-container">
  <div class="login-card">
    <div class="login-header">
      <div class="login-logo">TREC</div>
      <h1 class="login-title">Admin Login</h1>
      <p class="login-subtitle">The Ripple Effect Consult</p>
    </div>

    @if ($errors->any())
      <div class="error-alert">
        <strong>Login failed:</strong><br>
        @foreach ($errors->all() as $error)
          {{ $error }}
        @endforeach
      </div>
    @endif

    <form method="POST" action="{{ url('/login') }}">
      @csrf

      <div class="form-group">
        <label for="email" class="form-label">Email Address</label>
        <input
          type="email"
          id="email"
          name="email"
          class="form-input"
          value="{{ old('email') }}"
          required
          autofocus
          autocomplete="email"
        >
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group">
        <label for="password" class="form-label">Password</label>
        <input
          type="password"
          id="password"
          name="password"
          class="form-input"
          required
          autocomplete="current-password"
        >
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror
      </div>

      <button type="submit" class="login-btn">Sign In</button>
    </form>

    <div style="margin-top: 2rem; text-align: center; padding-top: 1.5rem; border-top: 1px solid #e2e8f0;">
      <p style="font-size: 0.875rem; color: #64748b;">
        Demo credentials:<br>
        <strong style="color: #1e293b;">Email:</strong> test@example.com<br>
        <strong style="color: #1e293b;">Password:</strong> password
      </p>
    </div>
  </div>
</div>
@endsection
