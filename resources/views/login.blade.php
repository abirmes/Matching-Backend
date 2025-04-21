<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    /* Animations */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }
    
    /* Transitions */
    .transition-all {
      transition: all 0.3s ease;
    }
    
    /* Improve focus styles for accessibility */
    :focus {
      outline: 2px solid #1e40af;
      outline-offset: 2px;
    }
    
    /* Custom scrollbar */
    ::-webkit-scrollbar {
      width: 8px;
    }
    
    ::-webkit-scrollbar-track {
      background: #f1f5f9;
    }
    
    ::-webkit-scrollbar-thumb {
      background: #94a3b8;
      border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
      background: #64748b;
    }
  </style>
</head>
<body>
  <div class="min-h-screen bg-gradient-to-br from-pink-50 to-blue-50 flex items-center justify-center py-4 px-4 sm:px-6 lg:px-8">
    <!-- Header with Logo -->
    <div class="fixed top-0 w-full bg-white shadow-md py-2 z-10">
      <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between">
          <div class="text-xl font-bold text-blue-800">
            Matching<span class="text-pink-500">.</span>
          </div>
          <div class="hidden md:flex space-x-5">
            <a href="/" class="text-gray-700 hover:text-blue-800 hover:border-b-2 hover:border-blue-800 px-1 transition-all">Home</a>
            <a href="/activities" class="text-gray-700 hover:text-blue-800 hover:border-b-2 hover:border-blue-800 px-1 transition-all">Activities</a>
            <a href="/create" class="text-gray-700 hover:text-blue-800 hover:border-b-2 hover:border-blue-800 px-1 transition-all">Create</a>
          </div>
          <div class="flex space-x-3">
            <a href="/register" class="text-blue-800 hover:text-blue-900 font-medium">
              Register
            </a>
            <a href="/login" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-1 rounded-full text-sm shadow-md">
              Sign In
            </a>
          </div>
        </nav>
      </div>
    </div>

    <div class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden mt-12 mb-4">
      <div class="bg-gradient-to-r from-pink-600 to-pink-500 py-4">
        <div class="text-center">
          <h2 class="text-2xl font-bold text-white">Sign In</h2>
          <p class="text-pink-100 text-sm">Access your account</p>
        </div>
      </div>

      <div class="py-8 px-6 space-y-4">
        <form method="POST" action="/login" class="space-y-6">
          @csrf
          <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <div class="mt-1">
              <input 
                id="email" 
                name="email" 
                type="email" 
                required 
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                placeholder="your@email.com"
                value="{{ old('email') }}"
              />
              @error('email')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Password -->
          <div>
            <div class="flex justify-between">
              <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
              <a href="/forgot-password" class="text-xs text-pink-600 hover:text-pink-500">
                Forgot password?
              </a>
            </div>
            <div class="mt-1">
              <input 
                id="password" 
                name="password" 
                type="password" 
                required 
                class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                placeholder="••••••••"
              />
              @error('password')
                <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Remember me -->
          <div class="flex items-center">
            <input 
              id="remember_me" 
              name="remember_me" 
              type="checkbox" 
              class="h-4 w-4 text-pink-600 focus:ring-pink-500 border-gray-300 rounded"
            />
            <label for="remember_me" class="ml-2 block text-sm text-gray-700">
              Remember me
            </label>
          </div>

          <!-- Submit button -->
          <div>
            <button 
              type="submit" 
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
            >
              Sign In
            </button>
          </div>
        </form>

        <div class="mt-4 text-center">
          <p class="text-sm text-gray-600">
            Don't have an account?
            <a href="/register" class="font-medium text-pink-600 hover:text-pink-500">
              Create one now
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>