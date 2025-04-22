<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Registration Form</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }
    
    .fade-in {
      animation: fadeIn 0.5s ease-in;
    }
    .transition-all {
      transition: all 0.3s ease;
    }
    :focus {
      outline: 2px solid #1e40af;
      outline-offset: 2px;
    }
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
    
    .compact-form .mt-1 {
      margin-top: 0.25rem;
    }
    
    .compact-form .space-y-6 {
      margin-top: 1rem;
      margin-bottom: 1rem;
    }
    
    .compact-form label {
      margin-bottom: 0;
    }
    
    .compact-form input {
      padding-top: 0.375rem;
      padding-bottom: 0.375rem;
    }
  </style>
</head>
<body>
  <div class="min-h-screen bg-gradient-to-br from-pink-50 to-blue-50 flex items-center justify-center py-4 px-4 sm:px-6 lg:px-8">
    <div class="fixed top-0 w-full bg-white shadow-md py-2 z-10">
      <div class="container mx-auto px-4">
        <nav class="flex items-center justify-between">
          <div class="text-xl font-bold text-blue-800">
            Matching<span class="text-pink-500">.</span>
          </div>
          <div class="hidden md:flex space-x-5">
            <a href="/" class="text-blue-900 font-medium border-b-2 border-blue-800 px-1">Home</a>
            <a href="/activities" class="text-gray-700 hover:text-blue-800 hover:border-b-2 hover:border-blue-800 px-1 transition-all">Activities</a>
            <a href="/create" class="text-gray-700 hover:text-blue-800 hover:border-b-2 hover:border-blue-800 px-1 transition-all">Create</a>
          </div>
          <div class="flex space-x-3">
            <a href="/register" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-1 rounded-full text-sm shadow-md">
              Register
            </a>
            <a href="/login" class="text-blue-800 hover:text-blue-900 font-medium">
              Sign In
            </a>
          </div>
        </nav>
      </div>
    </div>

    <div class="max-w-md w-full bg-white rounded-xl shadow-xl overflow-hidden mt-12 mb-4">
      <div class="bg-gradient-to-r from-pink-600 to-pink-500 py-3">
        <div class="text-center">
          <h2 class="text-2xl font-bold text-white">Create an Account</h2>
          <p class="text-pink-100 text-sm">Join our community today</p>
        </div>
      </div>

      <div class="py-4 px-6 space-y-2 compact-form">
        <form method="POST" action="{{ route('register') }}" class="space-y-3">
          @csrf
          <div>
            <label for="name" class="block text-xs font-medium text-gray-700">Full Name</label>
            <div class="mt-1">
              <input 
                id="name" 
                name="name" 
                type="text" 
                required 
                class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                placeholder="John Doe"
                value="{{ old('name') }}"
              />
              @error('name')
                <p class="text-xs text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="email" class="block text-xs font-medium text-gray-700">Email</label>
            <div class="mt-1">
              <input 
                id="email" 
                name="email" 
                type="email" 
                required 
                class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                placeholder="your@email.com"
                value="{{ old('email') }}"
              />
              @error('email')
                <p class="text-xs text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="date_of_birth" class="block text-xs font-medium text-gray-700">Date of Birth</label>
            <div class="mt-1">
              <input 
                id="date_of_birth" 
                name="date_naissance" 
                type="date" 
                required 
                class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                value="{{ old('date_of_birth') }}"
              />
              @error('date_of_birth')
                <p class="text-xs text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="boulevard" class="block text-xs font-medium text-gray-700">Boulevard/Street</label>
            <div class="mt-1">
              <input 
                id="boulevard" 
                name="boulevard" 
                type="text" 
                required 
                class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                placeholder="123 Main St"
                value="{{ old('boulevard') }}"
              />
              @error('boulevard')
                <p class="text-xs text-red-600">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="grid grid-cols-2 gap-2">
            <div>
              <label for="city" class="block text-xs font-medium text-gray-700">City</label>
              <div class="mt-1">
                <input 
                  id="city" 
                  name="city" 
                  type="text" 
                  required 
                  class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                  placeholder="New York"
                  value="{{ old('city') }}"
                />
                @error('city')
                  <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div>
              <label for="country" class="block text-xs font-medium text-gray-700">Country</label>
              <div class="mt-1">
                <select 
                  id="country" 
                  name="country" 
                  required 
                  class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                >
                  <option value="">Select</option>
                  <option value="US">United States</option>
                  <option value="CA">Canada</option>
                  <option value="UK">United Kingdom</option>
                  <option value="AU">Australia</option>
                  <option value="FR">France</option>
                  <option value="DE">Germany</option>
                </select>
                @error('country')
                  <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
              </div>
            </div>
          </div>


          <div class="grid grid-cols-2 gap-2">
            <div>
              <label for="password" class="block text-xs font-medium text-gray-700">Password</label>
              <div class="mt-1">
                <input 
                  id="password" 
                  name="password" 
                  type="password" 
                  required 
                  class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                  placeholder="••••••••"
                />
                @error('password')
                  <p class="text-xs text-red-600">{{ $message }}</p>
                @enderror
              </div>
            </div>
            <div>
              <label for="password-confirmation" class="block text-xs font-medium text-gray-700">Confirm Password</label>
              <div class="mt-1">
                <input 
                  id="password-confirmation" 
                  name="password_confirmation" 
                  type="password" 
                  required 
                  class="appearance-none block w-full px-3 py-1.5 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-pink-500 focus:border-pink-500 text-sm"
                  placeholder="••••••••"
                />
              </div>
            </div>
          </div>
          <p class="text-xs text-gray-500 mt-1">Password must be at least 8 characters long</p>

          <div class="mt-4">
            <button 
              type="submit" 
              class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-pink-500 hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500"
            >
              Create Account
            </button>
          </div>
        </form>

        <div class="mt-3 text-center">
          <p class="text-xs text-gray-600">
            Already have an account?
            <a href="/login" class="font-medium text-pink-500 hover:text-pink-600">
              Sign in
            </a>
          </p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>