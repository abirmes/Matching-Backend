<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Activity - Matching</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .bg-pattern {
      background-color: #f5f7fc;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%233b82f6' fill-opacity='0.07'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    }

    .form-container {
      max-width: 700px;
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
  <!-- Header -->
  <header class="bg-white shadow-md py-3 sticky top-0 z-10">
    <div class="container mx-auto px-4">
      <nav class="flex items-center justify-between">
        <div class="text-xl font-bold text-blue-800">
          Matching<span class="text-pink-500">.</span>
        </div>
        <div class="hidden md:flex space-x-5">
          @if ( Auth::check() && Auth::user()->role->name === "admin")
          <a href="/activities" class="text-gray-700 hover:text-blue-600 px-1">Dashboard</a>
          @endif
          <a href="/" class="text-gray-700 hover:text-blue-600 px-1">Home</a>
          <a href="/activities" class="text-gray-700 hover:text-blue-600 px-1">Activities</a>
          <a href="/create" class="text-blue-600 font-medium border-b-2 border-blue-500 px-1">Create</a>
        </div>
        @if ( !Auth::check() )
        <div class="flex space-x-3">
          <a href="/register" class="text-blue-600 hover:text-blue-700 font-medium">Register</a>
          <a href="/login" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-1.5 rounded-full text-sm shadow-md">Sign In</a>
        </div>
        @else
        <div class="flex space-x-3">
          <a href="/logout" class="text-blue-600 hover:text-blue-700 font-medium">Logout</a>
        </div>
        @endif
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <div class="dual-gradient text-white py-6 mb-6">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-xl md:text-2xl font-bold mb-2">Create a New Activity</h1>
      <p class="text-blue-100 max-w-2xl mx-auto text-sm">Share your passion with others and find people who enjoy the same activities</p>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-4 mb-12">
    <div class="form-container mx-auto bg-white rounded-xl shadow-lg p-5 md:p-6">
      @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 mb-4 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('success') }}</span>
      </div>
      @endif

      <form id="activityForm" method="POST" action="{{ route('activities.store') }}">
        @csrf
        <div class="space-y-4">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Activity Name</label>
            <input id="name" name="name" type="text" placeholder="Enter activity name" value="{{ old('name') }}" required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror">
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
          </div>

          <!-- Date Range -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1">Start Date & Time</label>
              <input id="start_date" name="date_debut" type="datetime-local" value="{{ old('start_date') }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('start_date') border-red-500 @enderror">
              @error('start_date')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1">End Date & Time</label>
              <input id="end_date" name="date_fin" type="datetime-local" value="{{ old('end_date') }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('end_date') border-red-500 @enderror">
              @error('end_date')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Participants -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="min_participants" class="block text-sm font-medium text-gray-700 mb-1">Minimum Participants</label>
              <input id="min_participants" name="min_participants" type="number" min="1" value="{{ old('min_participants', 2) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('min_participants') border-red-500 @enderror">
              @error('min_participants')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-1">Maximum Participants</label>
              <input id="max_participants" name="max_participants" type="number" min="1" value="{{ old('max_participants', 10) }}" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('max_participants') border-red-500 @enderror">
              @error('max_participants')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Type and Category -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="type_id" class="block text-sm font-medium text-gray-700 mb-1">Activity Type</label>
              <select id="type_id" name="type_id" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('type_id') border-red-500 @enderror">
                <option value="" disabled {{ old('type_id') ? '' : 'selected' }}>Select type</option>
                @foreach($data['types'] as $type)
                <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
              </select>
              @error('type_id')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
            <div>
              <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
              <select id="category_id" name="categorie_id" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('category_id') border-red-500 @enderror">
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select category</option>
                @foreach($data['categories'] as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
              </select>
              @error('category_id')
              <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <!-- Address/Location Section -->
          <div class="border-t border-gray-200 pt-4 mt-2">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Activity Location</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <select id="country" name="country" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('country') border-red-500 @enderror">
                  <option value="" disabled {{ old('country') ? '' : 'selected' }}>Select country</option>
                  @foreach($data['countries'] as $code => $name)
                  <option value="{{ $name }}" {{ old('country') == $code ? 'selected' : '' }}>{{ $name }}</option>
                  @endforeach
                </select>
                @error('country')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
              <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                <select id="city" name="city" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('city') border-red-500 @enderror">
                  <option value="" disabled {{ old('city') ? '' : 'selected' }}>Select city</option>
                  @foreach($data['cities'] as $code => $name)
                  <option value="{{ $name }}" {{ old('city') == $code ? 'selected' : '' }}>{{ $name }}</option>
                  @endforeach
                </select>
                @error('city')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="grid grid-cols-1 gap-4 mb-4">
              <div>
                <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                <select id="street" name="boulevard" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('street') border-red-500 @enderror">
                  <option value="" disabled {{ old('street') ? '' : 'selected' }}>Select boulevard address</option>
                  @foreach($data['boulevards'] as $code => $name)
                  <option value="{{ $name }}" {{ old('street') == $code ? 'selected' : '' }}>{{ $name }}</option>
                  @endforeach
                </select>
                @error('street')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="grid grid-cols-1 mb-2">
              <div>
                <label for="center_id" class="block text-sm font-medium text-gray-700 mb-1">Center Name</label>
                <select id="center_id" name="centre_id" required
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('center_id') border-red-500 @enderror">
                  <option value="" disabled {{ old('center_id') ? '' : 'selected' }}>Select center</option>
                  @foreach($data['centers'] as $center)
                  <option value="{{ $center->id }}" {{ old('center_id') == $center->id ? 'selected' : '' }}>{{ $center->name }}</option>
                  @endforeach
                </select>
                @error('center_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
              </div>
            </div>

            <div class="text-right">
              <button type="button" id="createCenterBtn"
                class="inline-flex items-center px-4 py-1.5 text-sm font-medium text-blue-600 bg-blue-50 border border-blue-200 rounded-md hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Couldn't find the center you're looking for? Create one
              </button>
            </div>
          </div>

          <!-- Image URL -->
          <div class="border-t border-gray-200 pt-4">
            <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Activity Image URL</label>
            <div class="flex space-x-2">
              <input id="image_url" name="image" type="url" value="{{ old('image_url') }}" placeholder="Enter image URL (e.g. https://example.com/image.jpg)"
                class="flex-grow px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('image_url') border-red-500 @enderror">
              <button type="button" id="previewImageBtn"
                class="px-3 py-2 bg-blue-500 hover:bg-blue-600 text-white rounded-md font-medium flex-shrink-0">
                Preview
              </button>
            </div>
            @error('image_url')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
            <div id="imagePreview" class="mt-3 hidden">
              <img id="preview" class="h-24 object-cover rounded-md" alt="Preview">
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4">
            <button type="submit"
              class="w-full py-2.5 bg-gradient-to-r from-blue-500 to-pink-500 hover:from-blue-600 hover:to-pink-600 text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
              Create Activity
            </button>
          </div>
        </div>
      </form>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-blue-900 text-white py-6">
    <div class="container mx-auto px-4">
      <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="mb-4 md:mb-0">
          <div class="text-xl font-bold">
            Matching<span class="text-pink-400">.</span>
          </div>
          <p class="text-blue-200 mt-1 text-sm">Find and join activities near you</p>
        </div>
        <div class="grid grid-cols-2 gap-6 text-center md:text-left">
          <div>
            <h3 class="text-base font-semibold mb-2">Quick Links</h3>
            <ul class="space-y-1 text-sm">
              <li><a href="/" class="text-blue-200 hover:text-white">Home</a></li>
              <li><a href="/activities" class="text-blue-200 hover:text-white">Activities</a></li>
              <li><a href="/create" class="text-blue-200 hover:text-white">Create Activity</a></li>
            </ul>
          </div>
          <div>
            <h3 class="text-base font-semibold mb-2">Contact</h3>
            <p class="text-blue-200 text-sm">support@matching.com</p>
            <p class="text-blue-200 text-sm">+1 (555) 123-4567</p>
          </div>
        </div>
      </div>
      <div class="mt-6 pt-4 border-t border-blue-800 text-center text-blue-300 text-xs">
        <p>&copy; <span id="currentYear"></span> Matching. All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- Create Center Modal (hidden by default) -->
  <div id="createCenterModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg p-6 w-full max-w-md mx-4">
      <div class="flex justify-between items-center mb-4">
        <h3 class="text-lg font-medium text-gray-900">Create New Center</h3>
        <button id="closeModalBtn" class="text-gray-400 hover:text-gray-500">
          <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
      <form id="createCenterForm" method="POST" action="{{ route('centers.store') }}">
        @csrf
        <div class="space-y-4">
          <div>
            <label for="centerName" class="block text-sm font-medium text-gray-700 mb-1">Center Name</label>
            <input id="centerName" name="name" type="text" placeholder="Enter center name" required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div>
            <label for="centerAddress" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
            <input id="centerAddress" name="boulevard" type="text" placeholder="Enter street address" required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
          </div>
          <div class="grid grid-cols-2 gap-4">
            <div>
              <label for="centerCity" class="block text-sm font-medium text-gray-700 mb-1">City</label>
              <input id="centerCity" name="city" type="text" placeholder="Enter city" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
            <div>
              <label for="centerCountry" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
              <input id="centerCountry" name="country" type="text" placeholder="Enter country" required
                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>
          </div>
          <div>
            <label for="centerSpecialty" class="block text-sm font-medium text-gray-700 mb-1">Speciality</label>
            <select id="centerSpecialty" name="specialite" required
              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
              <option value="" disabled selected>Select speciality</option>
              @foreach($data['categories'] as $key => $speciality)
              <option value="{{ $key }}">{{ $speciality }}</option>
              @endforeach
            </select>
          </div>
          <div class="pt-2">
            <button type="submit"
              class="w-full py-2 bg-gradient-to-r from-blue-500 to-pink-500 hover:from-blue-600 hover:to-pink-600 text-white rounded-md font-medium">
              Create Center
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script>
    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();

    // Handle image preview
    document.getElementById('previewImageBtn').addEventListener('click', function() {
      const imageUrl = document.getElementById('image_url').value;
      if (imageUrl) {
        document.getElementById('preview').src = imageUrl;
        document.getElementById('imagePreview').classList.remove('hidden');
      } else {
        alert('Please enter an image URL first');
      }
    });

    // Show create center modal
    document.getElementById('createCenterBtn').addEventListener('click', function() {
      document.getElementById('createCenterModal').classList.remove('hidden');
    });

    // Close create center modal
    document.getElementById('closeModalBtn').addEventListener('click', function() {
      document.getElementById('createCenterModal').classList.add('hidden');
    });

    

      

      
           

    // Close modal when clicking outside
    window.addEventListener('click', function(event) {
      const modal = document.getElementById('createCenterModal');
      if (event.target === modal) {
        modal.classList.add('hidden');
      }
    });
  </script>
</body>

</html>