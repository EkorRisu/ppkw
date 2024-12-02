<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>Login Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Arial', sans-serif;
    }
  </style>
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-100">
  <div class="w-full max-w-md bg-white shadow-lg rounded-lg p-8">
    <h2 class="text-3xl font-bold text-center mb-4">Login</h2>
    <p class="text-gray-500 text-center mb-6">Welcome back! Please login to your account.</p>

    <!-- Login Form -->
    <x-guest-layout>
      <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
          <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
          <x-text-input id="email" class="block mt-2 w-full p-3 border border-gray-300 rounded-md bg-white text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
          <x-text-input id="password" class="block mt-2 w-full p-3 border border-gray-300 rounded-md bg-white text-gray-800 shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500" type="password" name="password" required autocomplete="current-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
          <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
          <label for="remember_me" class="ml-2 text-sm text-gray-700">{{ __('Remember me') }}</label>
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-gray-500 hover:text-gray-700">
              {{ __('Forgot your password?') }}
            </a>
          @endif

          <x-primary-button class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500">
            {{ __('Log in') }}
          </x-primary-button>
        </div>
      </form>
    </x-guest-layout>
  </div>
</body>
</html>
