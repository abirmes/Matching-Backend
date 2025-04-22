<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Create Activity - Matching</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
  <style>
    .bg-pattern {
      background-color: #fcf5f8;
      background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ec4899' fill-opacity='0.07'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E");
    }
    
    .form-container {
      max-width: 700px;
    }
    
    input:focus, select:focus, textarea:focus {
      border-color: #ec4899;
      box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.2);
    }
  </style>
</head>
<body class="bg-pattern min-h-screen">
  <!-- Header -->
  <header class="bg-white shadow-md py-2 sticky top-0 z-10">
    <div class="container mx-auto px-4">
      <nav class="flex items-center justify-between">
        <div class="text-xl font-bold text-blue-800">
          Matching<span class="text-pink-500">.</span>
        </div>
        <div class="hidden md:flex space-x-5">
          <a href="/" class="text-gray-700 hover:text-pink-500 px-1">Home</a>
          <a href="/activities" class="text-gray-700 hover:text-pink-500 px-1">Activities</a>
          <a href="/create" class="text-pink-600 font-medium border-b-2 border-pink-500 px-1">Create</a>
        </div>
        <div class="flex space-x-3">
          <a href="/register" class="text-pink-600 hover:text-pink-700 font-medium">Register</a>
          <a href="/login" class="bg-pink-500 hover:bg-pink-600 text-white px-4 py-1 rounded-full text-sm shadow-md">Sign In</a>
        </div>
      </nav>
    </div>
  </header>

  <!-- Hero Section -->
  <div class="bg-gradient-to-r from-blue-800 to-pink-600 text-white py-6 mb-6">
    <div class="container mx-auto px-4 text-center">
      <h1 class="text-xl md:text-2xl font-bold mb-2">Create a New Activity</h1>
      <p class="text-blue-100 max-w-2xl mx-auto text-sm">Share your passion with others and find people who enjoy the same activities</p>
    </div>
  </div>

  <!-- Main Content -->
  <main class="container mx-auto px-4 py-4 mb-12">
    <div class="form-container mx-auto bg-white rounded-xl shadow-lg p-5 md:p-6">
      <form id="activityForm">
        <div class="space-y-4">
          <!-- Name -->
          <div>
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Activity Name</label>
            <input id="name" type="text" placeholder="Enter activity name" required 
                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
          </div>

          <!-- Date Range -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="date-debut" class="block text-sm font-medium text-gray-700 mb-1">Start Date & Time</label>
              <input id="date-debut" type="datetime-local" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <div>
              <label for="date-fin" class="block text-sm font-medium text-gray-700 mb-1">End Date & Time</label>
              <input id="date-fin" type="datetime-local" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
          </div>

          <!-- Participants -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="min-participants" class="block text-sm font-medium text-gray-700 mb-1">Minimum Participants</label>
              <input id="min-participants" type="number" min="1" value="2" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <div>
              <label for="max-participants" class="block text-sm font-medium text-gray-700 mb-1">Maximum Participants</label>
              <input id="max-participants" type="number" min="1" value="10" required 
                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
          </div>

          <!-- Type and Category -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="type_id" class="block text-sm font-medium text-gray-700 mb-1">Activity Type</label>
              <select id="type_id" required 
                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                <option value="" disabled selected>Select type</option>
                <option value="1">Individual</option>
                <option value="2">Group</option>
                <option value="3">Team</option>
                <option value="4">Workshop</option>
                <option value="5">Course</option>
                <option value="6">Event</option>
              </select>
            </div>
            <div>
              <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Category</label>
              <select id="category" required 
                     class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
                <option value="" disabled selected>Select category</option>
                <option value="1">Sports</option>
                <option value="2">Music</option>
                <option value="3">Arts</option>
                <option value="4">Technology</option>
                <option value="5">Drawing</option>
                <option value="6">Social</option>
                <option value="7">Education</option>
                <option value="8">Cooking</option>
              </select>
            </div>
          </div>

          <!-- Address/Location Section -->
          <div class="border-t border-gray-200 pt-4 mt-2">
            <h2 class="text-lg font-medium text-gray-800 mb-3">Activity Location</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
              <div>
                <label for="center" class="block text-sm font-medium text-gray-700 mb-1">Center Name</label>
                <input id="center" type="text" placeholder="Activity center name" 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
              </div>
              <div>
                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">City</label>
                <input id="city" type="text" placeholder="City" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
              </div>
            </div>
            
            <div class="grid grid-cols-1 gap-4 mb-4">
              <div>
                <label for="street" class="block text-sm font-medium text-gray-700 mb-1">Street Address</label>
                <input id="street" type="text" placeholder="Street address" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
              </div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label for="postal_code" class="block text-sm font-medium text-gray-700 mb-1">Postal Code</label>
                <input id="postal_code" type="text" placeholder="Postal code" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
              </div>
              <div>
                <label for="country" class="block text-sm font-medium text-gray-700 mb-1">Country</label>
                <input id="country" type="text" placeholder="Country" required 
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-pink-500">
              </div>
            </div>
          </div>

          <!-- Image Upload -->
          <div class="border-t border-gray-200 pt-4">
            <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Activity Image</label>
            <label class="flex flex-col items-center justify-center w-full h-28 border-2 border-pink-200 border-dashed rounded-lg cursor-pointer bg-gray-50 hover:bg-pink-50">
              <div class="flex flex-col items-center justify-center pt-4 pb-4">
                <svg class="w-8 h-8 text-pink-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                <p class="text-sm text-gray-500">
                  <span class="font-semibold text-pink-500">Upload an image</span>
                </p>
                <p class="text-xs text-gray-500">PNG, JPG or WEBP (MAX. 2MB)</p>
              </div>
              <input id="image" type="file" class="hidden" accept="image/*">
            </label>
            <div id="imagePreview" class="mt-3 hidden">
              <img id="preview" class="h-24 object-cover rounded-md" alt="Preview">
            </div>
          </div>

          <!-- Submit Button -->
          <div class="pt-4">
            <button type="submit" 
                   class="w-full py-2.5 bg-pink-500 hover:bg-pink-600 text-white rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
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

  <script>
    // Set current year in footer
    document.getElementById('currentYear').textContent = new Date().getFullYear();
    
    // Handle image preview
    document.getElementById('image').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('preview').src = e.target.result;
          document.getElementById('imagePreview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }
    });
    
    // Form submission
    document.getElementById('activityForm').addEventListener('submit', function(event) {
      event.preventDefault();
      
      // Create form data object
      const formData = {
        name: document.getElementById('name').value,
        'date-debut': document.getElementById('date-debut').value,
        'date-fin': document.getElementById('date-fin').value,
        'min-participants': document.getElementById('min-participants').value,
        'max-participants': document.getElementById('max-participants').value,
        type_id: document.getElementById('type_id').value,
        category: document.getElementById('category').value,
        
        // Address fields
        center: document.getElementById('center').value,
        street: document.getElementById('street').value,
        city: document.getElementById('city').value,
        postal_code: document.getElementById('postal_code').value,
        country: document.getElementById('country').value,
        
        // Image
        image: document.getElementById('image').files[0] ? document.getElementById('image').files[0].name : null
      };
      
      // Log form data (in a real app, you would send this to a server)
      console.log('Form submitted:', formData);
      
      // Show success message
      alert('Activity created successfully!');
      
      // Optional: reset form
      // this.reset();
      // document.getElementById('imagePreview').classList.add('hidden');
    });
  </script>
</body>
</html>