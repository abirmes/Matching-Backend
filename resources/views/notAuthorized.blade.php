<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Not Authorized - Matching</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-pattern {
            background-color: #f0f4f8;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232b4f81' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        :focus {
            outline: 2px solid #db2777;
            outline-offset: 2px;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-pattern flex flex-col">
    <header class="bg-white shadow-md py-3 sticky top-0 z-10">
    <div class="container mx-auto px-4">
      <nav class="flex items-center justify-between">
        <div class="text-xl font-bold text-blue-800">
          Matching<span class="text-pink-500">.</span>
        </div>
        <div class="hidden md:flex space-x-5">
          @if ( Auth::check() && Auth::user()->role->name === "admin")
          <a href="/dashboard" class="text-gray-700 hover:text-blue-600 px-1">Dashboard</a>
          @endif
          <a href="/" class="text-gray-700 hover:text-blue-600 px-1">Home</a>
          <a href="/activities" class="text-gray-700 hover:text-blue-600 px-1">Activities</a>
          <a href="/activityCreate" class="text-gray-700 hover:text-blue-600 px-1">Create</a>
        </div>
        @guest
        <div class="flex space-x-3">
          <a href="/register" class="text-pink-600 hover:text-pink-700 font-medium">Register</a>
          <a href="/login" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-1.5 rounded-full text-sm shadow-md">Sign In</a>
        </div>
        @else
        <div class="flex space-x-3">
          <a href="/logout" class="text-pink-600 hover:text-pink-700 font-medium">Logout</a>
        </div>
        @endguest
      </nav>
    </div>
  </header>

        <main class="flex-grow flex items-center justify-center">
            <div class="bg-white rounded-xl shadow-lg p-8 max-w-md mx-4 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-pink-100 mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m0 0v2m0-2h2m-2 0H9m3-4V9m0 0V7m0 2h2m-2 0H9" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5a2 2 0 00-2 2v6a2 2 0 002 2h14a2 2 0 002-2v-6a2 2 0 00-2-2z" />
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-800 mb-2">Not Authorized</h1>
                <p class="text-gray-600 mb-6">
                    You don't have permission to access this page. 
                </p>
                <div class="flex flex-col space-y-3 sm:flex-row sm:space-y-0 sm:space-x-3 justify-center">
                    
                    <a href="/" class="px-6 py-2.5 bg-pink-600 hover:bg-pink-700 text-white rounded-lg font-medium shadow-md transition-all">
                        Go Home
                    </a>
                </div>
            </div>
        </main>

        <footer class="bg-blue-900 text-white py-6 mt-auto">
            <div class="container mx-auto px-4 text-center">
                <div class="text-lg font-bold mb-2">
                    Matching<span class="text-pink-400">.</span>
                </div>
                <p class="text-blue-200 text-sm">&copy; 2025 Matching. All rights reserved.</p>
            </div>
        </footer>
    </div>
</body>

</html>