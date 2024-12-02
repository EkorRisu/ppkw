<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <title>Register Page</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="flex items-center justify-center min-h-screen bg-gray-200">
  <div class="w-full max-w-md bg-white shadow-md rounded-lg p-8">
    <h2 class="text-2xl font-semibold text-center text-gray-800">Create Your Account</h2>
    <p class="text-gray-600 text-center mb-6">Register to get started</p>

    <!-- Registration Form -->
    <x-guest-layout>
      <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name -->
        <div>
          <x-input-label for="name" :value="__('Name')" class="text-gray-700" />
          <x-text-input id="name" class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-gray-600 focus:border-gray-600" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
          <x-input-error :messages="$errors->get('name')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Email Address -->
        <div>
          <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
          <x-text-input id="email" class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-gray-600 focus:border-gray-600" type="email" name="email" :value="old('email')" required autocomplete="username" />
          <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Password -->
        <div>
          <x-input-label for="password" :value="__('Password')" class="text-gray-700" />
          <x-text-input id="password" class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-gray-600 focus:border-gray-600" type="password" name="password" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Confirm Password -->
        <div>
          <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700" />
          <x-text-input id="password_confirmation" class="block mt-2 w-full p-3 border border-gray-300 rounded-lg shadow-sm focus:ring-gray-600 focus:border-gray-600" type="password" name="password_confirmation" required autocomplete="new-password" />
          <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
          <a href="{{ route('login') }}" class="text-sm text-gray-600 hover:underline">
            {{ __('Already registered?') }}
          </a>

          <x-primary-button class="ml-3 px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2">
            {{ __('Register') }}
          </x-primary-button>
        </div>
      </form>
    </x-guest-layout>
  </div>
</body>
</html>
