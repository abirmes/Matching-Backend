<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Join Activity - Matching</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .bg-pattern {
      background-color: #f5f7fc;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.07'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #ec4899;
      box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
    }

    .dual-gradient {
      background: linear-gradient(135deg, #3b82f6 0%, #ec4899 100%);
    }
    
    /* Dropdown Styles */
    .dropdown {
      position: relative;
      display: inline-block;
    }
    
    .dropdown-content {
      visibility: hidden;
      opacity: 0;
      position: absolute;
      right: 0;
      min-width: 300px;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
      transform: translateY(10px);
      transition: all 0.2s ease-in-out;
      z-index: 20;
    }
    
    .dropdown:hover .dropdown-content {
      visibility: visible;
      opacity: 1;
      transform: translateY(0);
    }
    
    .activity-card:hover {
      background-color: rgba(59, 130, 246, 0.05);
    }
    
    .badge {
      position: absolute;
      top: -2px;
      right: -6px;
      padding: 2px 5px;
      border-radius: 50%;
      background: linear-gradient(135deg, #3b82f6, #ec4899);
      color: white;
      font-size: 10px;
      font-weight: bold;
      min-width: 18px;
      height: 18px;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    /* Animation for notifications */
    @keyframes pulse {
      0% { box-shadow: 0 0 0 0 rgba(236, 72, 153, 0.5); }
      70% { box-shadow: 0 0 0 6px rgba(236, 72, 153, 0); }
      100% { box-shadow: 0 0 0 0 rgba(236, 72, 153, 0); }
    }
    
    .animate-pulse {
      animation: pulse 2s infinite;
    }
    
    /* Scrollbar styling for dropdown */
    .scrollbar::-webkit-scrollbar {
      width: 6px;
    }
    
    .scrollbar::-webkit-scrollbar-track {
      background: #f1f5f9;
      border-radius: 8px;
    }
    
    .scrollbar::-webkit-scrollbar-thumb {
      background: #cbd5e1;
      border-radius: 8px;
    }
    
    .scrollbar::-webkit-scrollbar-thumb:hover {
      background: #94a3b8;
    }
  </style>
</head>

<body class="bg-pattern min-h-screen">
  <!-- Enhanced Header with My Activities Dropdown -->
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
          <a href="/home" class="text-gray-700 hover:text-blue-600 px-1">Home</a>
          <a href="/activities" class="text-gray-700 hover:text-blue-600 px-1">Activities</a>
          <a href="/activityCreate" class="text-gray-700 hover:text-blue-600 px-1">Create</a>
          
          <!-- My Activities Dropdown -->
          @auth
          <div class="dropdown">
            <button class="text-gray-700 hover:text-blue-600 px-1 flex items-center relative">
              My Activities
              <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
              <span class="badge animate-pulse">3</span>
            </button>
            <div class="dropdown-content bg-white rounded-lg overflow-hidden border border-gray-100">
              <div class="p-3 bg-gradient-to-r from-blue-50 to-pink-50 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Your Activities</h3>
                <p class="text-xs text-gray-500">Activities you've joined recently</p>
              </div>
              
              <div class="max-h-60 overflow-y-auto scrollbar">
                <!-- Activity 1 -->
                <a href="/activity/123" class="activity-card block p-3 border-b border-gray-100 hover:bg-blue-50 transition-colors">
                  <div class="flex items-start">
                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-blue-100 mr-3 flex-shrink-0">
                      <img src="/api/placeholder/100/100" alt="Basketball Game" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-grow">
                      <h4 class="font-medium text-gray-800 text-sm">Basketball Tournament</h4>
                      <div class="flex items-center text-xs text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Today, 6:00 PM
                      </div>
                      <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs font-medium">Upcoming</span>
                      </div>
                    </div>
                  </div>
                </a>
                
                <!-- Activity 2 -->
                <a href="/activity/124" class="activity-card block p-3 border-b border-gray-100 hover:bg-blue-50 transition-colors">
                  <div class="flex items-start">
                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-blue-100 mr-3 flex-shrink-0">
                      <img src="/api/placeholder/100/100" alt="Yoga Class" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-grow">
                      <h4 class="font-medium text-gray-800 text-sm">Morning Yoga Class</h4>
                      <div class="flex items-center text-xs text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Tomorrow, 8:00 AM
                      </div>
                      <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs font-medium">Upcoming</span>
                      </div>
                    </div>
                  </div>
                </a>
                
                <!-- Activity 3 -->
                <a href="/activity/125" class="activity-card block p-3 border-b border-gray-100 hover:bg-blue-50 transition-colors">
                  <div class="flex items-start">
                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-blue-100 mr-3 flex-shrink-0">
                      <img src="/api/placeholder/100/100" alt="Running Club" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-grow">
                      <h4 class="font-medium text-gray-800 text-sm">Weekend Running Club</h4>
                      <div class="flex items-center text-xs text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Saturday, 9:30 AM
                      </div>
                      <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-yellow-100 text-yellow-800 rounded text-xs font-medium">Almost Full</span>
                      </div>
                    </div>
                  </div>
                </a>
                
                <!-- Past Activity -->
                <a href="/activity/126" class="activity-card block p-3 border-b border-gray-100 hover:bg-blue-50 transition-colors">
                  <div class="flex items-start">
                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-gray-100 mr-3 flex-shrink-0">
                      <img src="/api/placeholder/100/100" alt="Tennis Match" class="h-full w-full object-cover opacity-70">
                    </div>
                    <div class="flex-grow">
                      <h4 class="font-medium text-gray-600 text-sm">Tennis Tournament</h4>
                      <div class="flex items-center text-xs text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Last Monday
                      </div>
                      <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-gray-100 text-gray-600 rounded text-xs font-medium">Completed</span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
              
              <div class="p-3 bg-gradient-to-r from-blue-50 to-pink-50 border-t border-gray-100 flex justify-between items-center">
                <a href="/my-activities" class="text-sm font-medium text-blue-600 hover:text-blue-800">View All Activities</a>
                <span class="text-xs text-gray-500">4 Total</span>
              </div>
            </div>
          </div>
          @endauth
        </div>
        
        @guest
        <div class="flex space-x-3">
          <a href="/register" class="text-pink-600 hover:text-pink-700 font-medium">Register</a>
          <a href="/login" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-1.5 rounded-full text-sm shadow-md">Sign In</a>
        </div>
        @else
        <div class="flex items-center space-x-3">
          <!-- Mobile My Activities Icon -->
          <div class="md:hidden dropdown">
            <button class="text-gray-700 hover:text-blue-600 relative p-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
              </svg>
              <span class="badge animate-pulse">3</span>
            </button>
            <!-- Same dropdown content as desktop -->
            <div class="dropdown-content bg-white rounded-lg overflow-hidden border border-gray-100">
              <div class="p-3 bg-gradient-to-r from-blue-50 to-pink-50 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Your Activities</h3>
                <p class="text-xs text-gray-500">Activities you've joined recently</p>
              </div>
              
              <div class="max-h-60 overflow-y-auto scrollbar">
                <!-- Activity 1 -->
                <a href="/activity/123" class="activity-card block p-3 border-b border-gray-100 hover:bg-blue-50 transition-colors">
                  <div class="flex items-start">
                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-blue-100 mr-3 flex-shrink-0">
                      <img src="/api/placeholder/100/100" alt="Basketball Game" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-grow">
                      <h4 class="font-medium text-gray-800 text-sm">Basketball Tournament</h4>
                      <div class="flex items-center text-xs text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Today, 6:00 PM
                      </div>
                      <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs font-medium">Upcoming</span>
                      </div>
                    </div>
                  </div>
                </a>
                
                <!-- Activity 2 -->
                <a href="/activity/124" class="activity-card block p-3 border-b border-gray-100 hover:bg-blue-50 transition-colors">
                  <div class="flex items-start">
                    <div class="h-12 w-12 rounded-lg overflow-hidden bg-blue-100 mr-3 flex-shrink-0">
                      <img src="/api/placeholder/100/100" alt="Yoga Class" class="h-full w-full object-cover">
                    </div>
                    <div class="flex-grow">
                      <h4 class="font-medium text-gray-800 text-sm">Morning Yoga Class</h4>
                      <div class="flex items-center text-xs text-gray-500 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Tomorrow, 8:00 AM
                      </div>
                      <div class="mt-1">
                        <span class="inline-block px-2 py-0.5 bg-green-100 text-green-800 rounded text-xs font-medium">Upcoming</span>
                      </div>
                    </div>
                  </div>
                </a>
                
                <!-- Only show 2 items on mobile for brevity -->
              </div>
              
              <div class="p-3 bg-gradient-to-r from-blue-50 to-pink-50 border-t border-gray-100 flex justify-between items-center">
                <a href="/my-activities" class="text-sm font-medium text-blue-600 hover:text-blue-800">View All Activities</a>
                <span class="text-xs text-gray-500">4 Total</span>
              </div>
            </div>
          </div>
          
          <a href="/logout" class="text-pink-600 hover:text-pink-700 font-medium">Logout</a>
        </div>
        @endguest
      </nav>
    </div>
  </header>

  <!-- Rest of your page content would go here -->
  <div class="dual-gradient text-white py-5">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-2xl font-bold">Join Activity</h1>
    </div>
  </div>
  
  <!-- Sample main content to show how it integrates -->
  <main class="container mx-auto px-4 py-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-lg text-center">
      <h2 class="text-xl font-bold mb-4">Header with Activities Dropdown Example</h2>
      <p class="text-gray-600">Hover over "My Activities" in the header to see your joined activities.</p>
      <p class="text-gray-600 mt-2">This beautiful dropdown keeps the same design language as your original page.</p>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white py-4">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-2 md:mb-0">
          <div class="text-lg font-bold">
            Matching<span class="text-pink-400">.</span>
          </div>
          <p class="text-blue-200 text-xs">Find and join activities near you</p>
        </div>
        <div class="flex space-x-6 text-sm">
          <div>
            <a href="/" class="text-blue-200 hover:text-white">Home</a> · 
            <a href="/activities" class="text-blue-200 hover:text-white">Activities</a> · 
            <a href="/activityCreate" class="text-blue-200 hover:text-white">Create</a>
          </div>
        </div>
      </div>
      <div class="mt-3 pt-2 border-t border-blue-800 text-center text-blue-300 text-xs">
        <p>&copy; {{ date('Y') }} Matching. All rights reserved.</p>
      </div>
    </div>
  </footer>
</body>
</html>