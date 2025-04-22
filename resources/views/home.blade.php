<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matching - Find Activities</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        /* Custom background pattern */
        .bg-pattern {
            background-color: #f0f4f8;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232b4f81' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
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
            outline: 2px solid #db2777;
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
            background: #db2777;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-pattern">
        <!-- Header -->
        <header class="bg-white shadow-md py-3 sticky top-0 z-10">
            <div class="container mx-auto px-4">
                <nav class="flex items-center justify-between">
                    <div class="text-xl font-bold text-blue-800">
                        Matching<span class="text-pink-500">.</span>
                    </div>
                    <div class="hidden md:flex space-x-5">
                        <a href="#" class="text-blue-900 font-medium border-b-2 border-pink-500 px-1">Home</a>
                        <a href="#" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Activities</a>
                        <a href="#" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Create</a>
                    </div>
                    @if ( !Auth::user()->name )
                    <div class="flex space-x-3">
                        <a href="/register" class="text-pink-600 hover:text-pink-700 font-medium">Register</a>
                        <a href="/login" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-1.5 rounded-full text-sm shadow-md">Sign In</a>
                    </div>
                    @elseif ( Auth::user()->name )
                    <div class="flex space-x-3">
                        <a href="/logout" class="text-pink-600 hover:text-pink-700 font-medium">Logout</a>
                    </div>
                    @endif
                    
                </nav>
            </div>
        </header>

        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-900 to-pink-600 text-white py-10 mb-8">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-2xl md:text-3xl font-bold mb-3">Find Your Perfect Activity Match </h1>
                <p class="text-blue-100 max-w-2xl mx-auto mb-6">
                    Discover exciting activities in your area and connect with people who share your interests
                </p>
                <form action="#" method="GET" class="max-w-2xl mx-auto">
                    <div class="bg-white rounded-full shadow-lg p-1.5 flex flex-col sm:flex-row">
                        <input name="query" type="text" placeholder="Search activities or locations..." class="flex-grow px-4 py-2 rounded-full focus:outline-none text-gray-800 w-full sm:w-auto">
                        <button type="submit" class="bg-pink-600 hover:bg-pink-700 text-white px-6 py-2 rounded-full text-sm font-medium mt-2 sm:mt-0 shadow-md transition-all">
                            Search
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-6">
            <!-- Categories -->
            <div class="mb-8 flex flex-wrap gap-2 justify-center">
                <button data-category="all" class="category-btn px-4 py-2 rounded-full text-sm font-medium transition-all shadow-sm bg-pink-600 text-white">
                    All
                </button>
                @foreach(['sports', 'music', 'arts', 'technology', 'drawing'] as $category)
                <button data-category="{{ $category }}" class="category-btn px-4 py-2 rounded-full text-sm font-medium transition-all shadow-sm bg-white text-blue-800 hover:bg-pink-50">
                    {{ ucfirst($category) }}
                </button>
                @endforeach
            </div>

            <!-- Activity Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6" id="activities-container">
                @php
                $activities = [
                [
                'id' => 1,
                'name' => 'Beach Volleyball Tournament',
                'place' => 'Sunset Beach Park',
                'participants' => 12,
                'max_participants' => 16,
                'category' => 'sports',
                'date' => '2025-04-20 14:00:00',
                'image' => 'https://images.unsplash.com/photo-1612872087720-bb876e2e67d1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'
                ],
                [
                'id' => 2,
                'name' => 'Painting Workshop',
                'place' => 'Creative Arts Center',
                'participants' => 8,
                'max_participants' => 12,
                'category' => 'arts',
                'date' => '2025-04-18 10:00:00',
                'image' => 'https://images.unsplash.com/photo-1460661419201-fd4cecdf8a8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'
                ],
                [
                'id' => 3,
                'name' => 'Guitar Jam Session',
                'place' => 'Music Studio',
                'participants' => 5,
                'max_participants' => 10,
                'category' => 'music',
                'date' => '2025-04-22 08:00:00',
                'image' => 'https://images.unsplash.com/photo-1511379938547-c1f69419868d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'
                ],
                [
                'id' => 4,
                'name' => 'Coding Bootcamp',
                'place' => 'Tech Hub',
                'participants' => 7,
                'max_participants' => 15,
                'category' => 'technology',
                'date' => '2025-04-19 18:30:00',
                'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'
                ],
                [
                'id' => 5,
                'name' => 'Portrait Drawing Class',
                'place' => 'Art Studio',
                'participants' => 15,
                'max_participants' => 15,
                'category' => 'drawing',
                'date' => '2025-04-21 07:00:00',
                'image' => 'https://images.unsplash.com/photo-1513364776144-60967b0f800f?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'
                ],
                [
                'id' => 6,
                'name' => 'Jazz Concert',
                'place' => 'Downtown Music Hall',
                'participants' => 10,
                'max_participants' => 16,
                'category' => 'music',
                'date' => '2025-04-17 19:00:00',
                'image' => 'https://images.unsplash.com/photo-1514320291840-2e0a9bf2a9ae?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=60'
                ]
                ];
                @endphp

                @foreach($activities as $activity)
                <div data-category="{{ $activity['category'] }}" class="activity-card bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all transform hover:-translate-y-1 duration-300">
                    <div class="relative">
                        <img src="{{ $activity['image'] }}" alt="{{ $activity['name'] }}" class="w-full h-48 object-cover">
                        <div class="absolute top-0 right-0 bg-blue-800 text-white px-3 py-1 m-3 rounded-full text-xs font-medium shadow-md">
                            {{ ucfirst($activity['category']) }}
                        </div>
                        @if($activity['participants'] >= $activity['max_participants'])
                        <div class="absolute top-0 left-0 bg-pink-500 text-white px-3 py-1 m-3 rounded-full text-xs font-medium shadow-md">
                            Full
                        </div>
                        @endif
                    </div>
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-gray-800 mb-2">
                            {{ $activity['name'] }}
                        </h3>
                        <div class="mt-3 text-gray-600 text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $activity['place'] }}
                        </div>
                        <div class="mt-3 text-gray-600 text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                            {{ $activity['participants'] }} / {{ $activity['max_participants'] }} participants
                        </div>
                        <div class="mt-3 text-gray-600 text-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ date('D, M j, g:i A', strtotime($activity['date'])) }}
                        </div>

                        <!-- Progress bar for participants -->
                        <div class="mt-4 w-full bg-gray-200 rounded-full h-2.5">
                            <div class="h-2.5 rounded-full {{ $activity['participants'] >= $activity['max_participants'] ? 'bg-pink-500' : 'bg-pink-600' }}"
                                style="width: {{ ($activity['participants'] / $activity['max_participants']) * 100 }}%">
                            </div>
                        </div>

                        <div class="mt-5">
                            <form action="#" method="POST">
                                @csrf
                                <button type="submit"
                                    class="w-full py-2 rounded-lg text-sm font-medium transition-all {{ $activity['participants'] >= $activity['max_participants'] ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-pink-600 hover:bg-pink-700 text-white shadow-md hover:shadow-lg' }}"
                                    {{ $activity['participants'] >= $activity['max_participants'] ? 'disabled' : '' }}>
                                    {{ $activity['participants'] >= $activity['max_participants'] ? 'Full' : 'Join Now' }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Empty State (Hidden by default) -->
            <div id="empty-state" class="hidden col-span-3 text-center py-12 bg-white rounded-xl shadow-lg my-8">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <h3 class="mt-6 text-xl font-bold text-gray-900">No activities found</h3>
                <p class="mt-2 text-gray-500 max-w-md mx-auto">
                    We couldn't find any activities matching your search criteria.
                </p>
                <button id="view-all-btn" class="mt-6 px-6 py-2 inline-block bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md">
                    View All Activities
                </button>
            </div>

            <!-- Create Activity CTA -->
            <div class="my-12 bg-gradient-to-r from-blue-900 to-pink-600 rounded-xl shadow-lg overflow-hidden">
                <div class="md:flex items-center">
                    <div class="p-8 md:w-2/3">
                        <h3 class="text-2xl font-bold text-white mb-3">Can't find what you're looking for?</h3>
                        <p class="text-blue-100 mb-6">
                            Create your own activity and invite others to join! It only takes a minute to get started.
                        </p>
                        <a href="/activityCreate" class="inline-block bg-white text-pink-600 hover:bg-blue-50 px-6 py-2.5 rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
                            Create New Activity
                        </a>
                    </div>
                    <div class="hidden md:block md:w-1/3 p-8">
                        <img src="https://via.placeholder.com/400x300?text=Create+Activity" alt="Create activity" class="rounded-lg shadow-lg">
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-blue-900 text-white py-10">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="mb-6 md:mb-0">
                        <div class="text-2xl font-bold">
                            Matching<span class="text-pink-400">.</span>
                        </div>
                        <p class="text-blue-200 mt-2">Find and join activities near you</p>
                    </div>
                    <div class="grid grid-cols-2 gap-8 text-center md:text-left">
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Quick Links</h3>
                            <ul class="space-y-2">
                                <li><a href="#" class="text-blue-200 hover:text-pink-200 transition-colors">Home</a></li>
                                <li><a href="#" class="text-blue-200 hover:text-pink-200 transition-colors">Activities</a></li>
                                <li><a href="#" class="text-blue-200 hover:text-pink-200 transition-colors">Create Activity</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Contact</h3>
                            <p class="text-blue-200">support@matching.com</p>
                            <p class="text-blue-200">+1 (555) 123-4567</p>
                            <div class="flex space-x-3 mt-4 justify-center md:justify-start">
                                <a href="#" class="text-blue-200 hover:text-pink-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-blue-200 hover:text-pink-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                    </svg>
                                </a>
                                <a href="#" class="text-blue-200 hover:text-pink-200">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-blue-800 text-center text-blue-300 text-sm">
                    <p>&copy; {{ date('Y') }} Matching. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Category filtering
            const categoryButtons = document.querySelectorAll('.category-btn');
            const activityCards = document.querySelectorAll('.activity-card');
            const emptyState = document.getElementById('empty-state');
            const activitiesContainer = document.getElementById('activities-container');
            const viewAllBtn = document.getElementById('view-all-btn');

            // Function to filter activities
            function filterActivities(category) {
                let visibleCount = 0;

                activityCards.forEach(card => {
                    const cardCategory = card.getAttribute('data-category');

                    if (category === 'all' || cardCategory === category) {
                        card.classList.remove('hidden');
                        visibleCount++;
                    } else {
                        card.classList.add('hidden');
                    }
                });

                // Show empty state if no activities match the filter
                if (visibleCount === 0) {
                    emptyState.classList.remove('hidden');
                    activitiesContainer.classList.add('hidden');
                } else {
                    emptyState.classList.add('hidden');
                    activitiesContainer.classList.remove('hidden');
                }

                // Update active button styles
                categoryButtons.forEach(btn => {
                    if (btn.getAttribute('data-category') === category) {
                        btn.classList.remove('bg-white', 'text-blue-800');
                        btn.classList.add('bg-pink-600', 'text-white');
                    } else {
                        btn.classList.remove('bg-pink-600', 'text-white');
                        btn.classList.add('bg-white', 'text-blue-800');
                    }
                });
            }

            // Add click event to category buttons
            categoryButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const category = this.getAttribute('data-category');
                    filterActivities(category);
                });
            });

            // View All button in empty state
            viewAllBtn.addEventListener('click', function() {
                filterActivities('all');
            });

            // Join button functionality
            const joinButtons = document.querySelectorAll('button[type="submit"]');
            joinButtons.forEach(button => {
                if (!button.disabled) {
                    button.addEventListener('click', function(e) {
                        e.preventDefault();
                        alert('You have joined this activity!');
                    });
                }
            });
        });
    </script>
</body>

</html>