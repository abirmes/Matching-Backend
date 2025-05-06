<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matching - My Activities</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .bg-pattern {
            background-color: #f0f4f8;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%232b4f81' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }

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

        .transition-all {
            transition: all 0.3s ease;
        }

        :focus {
            outline: 2px solid #db2777;
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
            background: #db2777;
        }

        .tab-active {
            color: #1e3a8a;
            border-bottom: 2px solid #db2777;
            font-weight: 500;
        }

        .tab {
            transition: all 0.3s ease;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-pattern">
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
                        <a href="/" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Home</a>
                        <a href="/activities" class="text-blue-900 font-medium border-b-2 border-pink-500 px-1">Activities</a>
                        <a href="/activityCreate" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Create</a>
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

        <div class="bg-gradient-to-r from-blue-900 to-pink-600 text-white py-8">
            <div class="container mx-auto px-4">
                <h1 class="text-2xl md:text-3xl font-bold mb-2">My Activities</h1>
                <p class="text-blue-100">Manage all the activities you've joined</p>
            </div>
        </div>

        <main class="container mx-auto px-4 py-8">
            <!-- Tabs -->
            <div class="flex border-b border-gray-200 mb-6">
                <button id="upcoming-tab" class="tab tab-active px-4 py-2 mr-4">Upcoming</button>
                <button id="past-tab" class="tab text-gray-600 px-4 py-2 mr-4">Past</button>
            </div>

            <!-- Upcoming Activities Tab Content -->
            @if(session('success'))
            <div class="px-6 py-4 mb-4 text-green-800 bg-green-100 rounded-md">
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="px-6 py-4 mb-4 text-red-800 bg-red-100 rounded-md">
                {{ session('error') }}
            </div>
            @endif
            <div id="upcoming-content" class="fade-in">
                <div class="grid grid-cols-1 gap-6">
                    @foreach($userActivities as $activity)
                    @if(strtotime($activity->date_debut) > time())
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all">
                        <div class="md:flex">
                            <div class="md:w-1/4 relative">
                                <img src="{{ $activity->image }}" alt="{{ $activity->name }}" class="w-[300px] h-[200px] object-cover grayscale opacity-80">
                                <div class="absolute top-0 right-0 bg-blue-800 text-white px-3 py-1 m-3 rounded-full text-xs font-medium shadow-md">
                                    {{ $activity->categorie->name }}
                                </div>
                            </div>
                            <div class="p-6 md:w-3/4">
                                <div class="md:flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                                            {{ $activity->name }}
                                        </h3>
                                        <p class="text-gray-600 mb-4">{{ $activity->description }}</p>
                                    </div>
                                    <div class="mt-4 md:mt-0">
                                        <span class="inline-block bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Confirmed
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div class="text-gray-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $activity->centre->adresse->city }}, {{ $activity->centre->adresse->boulevard }}
                                    </div>
                                    <div class="text-gray-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $activity->participants }} / {{ $activity->max_participants }} participants
                                    </div>
                                    <div class="text-gray-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ date('D, M j, g:i A', strtotime($activity->date_debut)) }}
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3 mt-4">
                                    <a href="{{route('activities.show' , ['id' => $activity->id])}}" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-all">
                                        View Details
                                    </a>
                                    <form action="{{route('activities.delete' , ['id' => $activity->id])}}" method="post" onsubmit="return confirm('Are you sure you want to leave this activity?');">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 border border-pink-600 text-pink-600 hover:bg-pink-50 rounded-lg text-sm font-medium transition-all">
                                            Leave Activity
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @endforeach

                    @if(count(array_filter($userActivities, function($activity) { return strtotime($activity->date_debut) > time(); })) == 0)
                    <div class="text-center py-16 bg-white rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-pink-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <h3 class="mt-6 text-xl font-bold text-gray-900">You haven't joined any upcoming activities</h3>
                        <p class="mt-2 text-gray-500 max-w-md mx-auto">
                            Explore our activities page to find and join exciting activities near you!
                        </p>
                        <a href="/" class="mt-6 px-6 py-2 inline-block bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md">
                            Find Activities
                        </a>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Past Activities Tab Content -->
            <div id="past-content" class="fade-in hidden">
                <div class="grid grid-cols-1 gap-6">
                    @foreach($userActivities as $activity)
                    @if(strtotime($activity->date_debut) <= time())
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all">
                        <div class="md:flex">
                            <div class="md:w-1/4 relative">
                                <img src="{{ $activity->image }}" alt="{{ $activity->name }}" class="w-[300px] h-[200px] object-cover grayscale opacity-80">
                                <div class="absolute top-0 right-0 bg-gray-600 text-white px-3 py-1 m-3 rounded-full text-xs font-medium shadow-md">
                                    {{ $activity->categorie->name }}
                                </div>
                            </div>
                            <div class="p-6 md:w-3/4">
                                <div class="md:flex justify-between items-start">
                                    <div>
                                        <h3 class="text-xl font-bold text-gray-800 mb-2">
                                            {{ $activity->name }}
                                        </h3>
                                        <p class="text-gray-600 mb-4">{{ $activity->description }}</p>
                                    </div>
                                    <div class="mt-4 md:mt-0">
                                        <span class="inline-block bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-sm font-medium">
                                            Completed
                                        </span>
                                    </div>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                                    <div class="text-gray-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $activity->centre->adresse->city }}, {{ $activity->centre->adresse->boulevard }}
                                    </div>
                                    <div class="text-gray-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        {{ $activity->participants }} / {{ $activity->max_participants }} participants
                                    </div>
                                    <div class="text-gray-600 text-sm flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        {{ date('D, M j, g:i A', strtotime($activity->date_debut)) }}
                                    </div>
                                </div>

                                <div class="flex flex-wrap gap-3 mt-4">
                                    <a href="{{route('activities.show' , ['id' => $activity->id])}}" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded-lg text-sm font-medium transition-all">
                                        View Details
                                    </a>
                                    <form action="/activity/dismiss/{{ $activity->id }}" method="post" onsubmit="return confirm('Are you sure you want to dismiss this activity from your history?');">
                                        @csrf
                                        <button type="submit" class="px-4 py-2 border border-gray-600 text-gray-600 hover:bg-gray-50 rounded-lg text-sm font-medium transition-all">
                                            Dismiss
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
                @endif
                @endforeach

                @if(count(array_filter($userActivities, function($activity) { return strtotime($activity->date_debut) <= time(); }))==0)
                    <div class="text-center py-16 bg-white rounded-xl shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-6 text-xl font-bold text-gray-900">No past activities</h3>
                    <p class="mt-2 text-gray-500 max-w-md mx-auto">
                        You haven't participated in any activities yet. Join some activities to see them here later!
                    </p>
                    <a href="/home" class="mt-6 px-6 py-2 inline-block bg-pink-600 text-white rounded-lg hover:bg-pink-700 transition-all shadow-md">
                        Find Activities
                    </a>
            </div>
            @endif
    </div>
    </div>

    <div class="my-12 bg-gradient-to-r from-blue-900 to-pink-600 rounded-xl shadow-lg overflow-hidden">
        <div class="md:flex items-center">
            <div class="p-8 md:w-2/3">
                <h3 class="text-2xl font-bold text-white mb-3">Want to create your own activity?</h3>
                <p class="text-blue-100 mb-6">
                    Share your passion with others by creating a new activity. It's easy to set up and you'll meet people with similar interests!
                </p>
                <a href="/activityCreate" class="inline-block bg-white text-pink-600 hover:bg-blue-50 px-6 py-2.5 rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
                    Create New Activity
                </a>
            </div>

        </div>
    </div>
    </main>

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
                            <li><a href="/home" class="text-blue-200 hover:text-pink-200 transition-colors">Home</a></li>
                            <li><a href="/myactivities" class="text-blue-200 hover:text-pink-200 transition-colors">My Activities</a></li>
                            <li><a href="/activityCreate" class="text-blue-200 hover:text-pink-200 transition-colors">Create Activity</a></li>
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
            const upcomingTab = document.getElementById('upcoming-tab');
            const pastTab = document.getElementById('past-tab');
            const upcomingContent = document.getElementById('upcoming-content');
            const pastContent = document.getElementById('past-content');

            upcomingTab.addEventListener('click', function() {
                // Update tabs
                upcomingTab.classList.add('tab-active');
                upcomingTab.classList.remove('text-gray-600');
                pastTab.classList.remove('tab-active');
                pastTab.classList.add('text-gray-600');

                // Show/hide content
                upcomingContent.classList.remove('hidden');
                pastContent.classList.add('hidden');
            });

            pastTab.addEventListener('click', function() {
                // Update tabs
                pastTab.classList.add('tab-active');
                pastTab.classList.remove('text-gray-600');
                upcomingTab.classList.remove('tab-active');
                upcomingTab.classList.add('text-gray-600');

                // Show/hide content
                pastContent.classList.remove('hidden');
                upcomingContent.classList.add('hidden');
            });
        });
        
    </script>