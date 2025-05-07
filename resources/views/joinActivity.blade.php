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
  </style>
</head>

<body class="bg-pattern min-h-screen">
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

  <div class="dual-gradient text-white py-5">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-2xl font-bold">Join Activity</h1>
    </div>
  </div>

  <main class="container mx-auto px-4 py-6 mb-8">
    <div class="flex flex-col md:flex-row gap-6 max-w-6xl mx-auto">
      <div class="w-full md:w-2/5">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden sticky top-20">
          <div class="relative">
            <img src="{{ $activity->image }}" alt="{{ $activity->name }}" class="w-full h-40 object-cover">
            <div class="absolute top-0 right-0 bg-blue-800 text-white px-3 py-1 m-3 rounded-full text-xs font-medium shadow-md">
              {{ $activity->categorie->name }}
            </div>
          </div>
          <div class="p-4">
            <h3 class="text-lg font-bold text-gray-800 mb-2">
              {{ $activity->name }}
            </h3>
            
            <div class="space-y-2">
              <div class="text-gray-600 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                {{ $activity->centre->adresse->country }}, {{ $activity->centre->adresse->city }}
              </div>
              <div class="text-gray-600 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ date('D, M j, g:i A', strtotime($activity->date_debut)) }}
              </div>
              <div class="text-gray-600 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                {{ $activity->participants }} / {{ $activity->max_participants }} participants
              </div>
              <div class="text-gray-600 text-sm flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                {{ $activity->type->name }}
              </div>
            </div>

            <div class="mt-3 w-full bg-gray-200 rounded-full h-2.5">
              <div class="h-2.5 rounded-full {{ $activity->participants >= $activity->max_participants ? 'bg-pink-500' : 'bg-pink-600' }}"
                style="width: {{ ($activity->participants / $activity->max_participants) * 100 }}%">
              </div>
            </div>
            <p class="mt-1 text-sm text-gray-500">{{ $activity->max_participants - $activity->participants }} spots remaining</p>
            
            <div class="mt-4">
              <a href="/activities" class="text-blue-600 hover:text-blue-800 text-sm font-medium inline-flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Activities
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="w-full md:w-3/5">
        <div class="bg-white rounded-xl shadow-lg p-5">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Complete Your Registration</h2>
          
          @if(session('error'))
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 mb-4 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
          </div>
          @endif

          <form id="joinActivityForm" method="POST" action="/activity/join/{{ $activity->id }}">
            @csrf
            <div class="space-y-4">
              <div>
                <label for="team" class="block text-sm font-medium text-gray-700 mb-1">Select Team</label>
                <select id="team" name="team" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none @error('team') border-red-500 @enderror">
                  <option value="" disabled selected>Choose a team</option>
                  <option value="individual">Individual Participant</option>
                </select>
                @error('team')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              
              <div>
                <label for="participant_id" class="block text-sm font-medium text-gray-700 mb-1">Participant ID</label>
                <select id="participant_id" name="participant_id" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none @error('participant_id') border-red-500 @enderror">
                  <option value="" disabled selected>Select your ID number</option>
                  @for ($i = 1; $i <= $activity->max_participants; $i++)
                  <option value="{{ $i }}">{{ $i }}</option>
                  @endfor
                </select>
                @error('participant_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>

              <div class="pt-2">
                <p class="text-xs text-gray-500 mb-3">
                  By joining this activity, you agree to participate according to the activity guidelines. You can cancel your participation up to 24 hours before the activity starts.
                </p>
                <button type="submit"
                  class="w-full py-2.5 bg-gradient-to-r from-blue-600 to-pink-600 hover:from-blue-700 hover:to-pink-700 text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
                  Confirm & Join Activity
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

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

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const joinForm = document.getElementById('joinActivityForm');
      
      joinForm.addEventListener('submit', function(e) {
        const team = document.getElementById('team').value;
        const role = document.getElementById('role').value;
        const participantId = document.getElementById('participant_id').value;
        
        if (!team || !role || !participantId) {
          e.preventDefault();
          alert('Please fill in all required fields');
        }
      });
    });
  </script>
</body>
</html>