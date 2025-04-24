<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $activity->name }} - Matching</title>
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
                        @if ( Auth::check() && Auth::user()->role->name === "admin")
                        <a href="/dashboard" class="text-gray-700 hover:text-blue-600 px-1">Dashboard</a>
                        @endif
                        <a href="/home" class="text-blue-900 font-medium border-b-2 border-pink-500 px-1">Home</a>
                        <a href="#" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Activities</a>
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

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-5">
            <!-- Back Button -->
            <nav aria-label="Breadcrumb" class="mb-4">
                <a href="{{ route('activities.index') }}" class="inline-flex items-center text-pink-600 hover:text-pink-700 transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to activities
                </a>
            </nav>

            <!-- Activity Details Card -->
            <article class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 fade-in">
                <!-- Activity Image -->
                <figure class="relative">
                    <img src="{{ $activity->image }}" alt="Activity image {{ $activity->name }}" class="w-full h-48 md:h-64 object-cover">
                    <div class="absolute top-0 right-0 bg-blue-800 text-white px-3 py-1 m-3 rounded-full text-sm font-medium shadow-md">
                        {{ $activity->categorie->name }}
                    </div>
                    @if($activity->participants >= $activity->max_participants)
                    <div class="absolute top-0 left-0 bg-pink-500 text-white px-3 py-1 m-3 rounded-full text-sm font-medium shadow-md">
                        Full
                    </div>
                    @endif
                </figure>

                <!-- Activity Info -->
                <div class="p-4 md:p-6">
                    <div class="md:flex md:justify-between md:items-start">
                        <div class="md:w-2/3">
                            <header>
                                <h1 class="text-xl md:text-2xl font-bold text-gray-800 mb-2">
                                    {{ $activity->name }}
                                </h1>
                                <div class="flex flex-wrap items-center text-gray-600 text-sm mb-3">
                                    <div class="flex items-center mr-4 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $activity->centre->adresse->country }}, {{ $activity->centre->adresse->city }}, {{ $activity->centre->adresse->boulevard }}

                                    </div>
                                    <div class="flex items-center mr-4 mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Start: {{ date('D, d M Y', strtotime($activity->date_debut)) }}
                                    </div>
                                    <div class="flex items-center mb-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ date('H:i', strtotime($activity->date_debut)) }}
                                    </div>
                                </div>
                            </header>

                            <div class="text-gray-600 text-sm mb-4">
                                <p>{{ $activity->categorie->name }}</p>
                                
                                <div class="mt-3 grid grid-cols-2 gap-2">
                                    <div>
                                        <span class="font-medium">End:</span> {{ date('D, d M Y at H:i', strtotime($activity->date_fin)) }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Type:</span> {{ $activity->type->name }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Center:</span> {{ $activity->centre->name }}
                                    </div>
                                    <div>
                                        <span class="font-medium">Min. participants:</span> {{ $activity->min_participants }}
                                    </div>
                                </div>
                            </div>

                            
                        </div>

                        <!-- Action Card -->
                        <aside class="md:w-1/3 md:ml-4 bg-gray-50 rounded-lg p-3 shadow-sm mt-3 md:mt-0">
                            <div class="mb-3">
                                <h3 class="text-base font-semibold text-gray-800 mb-2">Participants</h3>
                                <div class="flex items-center justify-between mb-1">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                        </svg>
                                        <span class="text-gray-700 text-sm">
                                            {{ $activity->participants }} / {{ $activity->max_participants }} spots taken
                                        </span>
                                    </div>
                                    <span class="{{ $activity->participants >= $activity->max_participants ? 'bg-pink-100 text-pink-800' : 'bg-green-100 text-green-800' }} text-xs px-2 py-0.5 rounded-full">
                                        {{ $activity->participants >= $activity->max_participants ? 'Full' : 'Open' }}
                                    </span>
                                </div>

                                <!-- Progress bar for participants -->
                                <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                                    <div class="{{ $activity->participants >= $activity->max_participants ? 'bg-pink-500' : 'bg-pink-600' }} h-2 rounded-full" style="width: {{ ($activity->participants / $activity->max_participants) * 100 }}%"></div>
                                </div>

                                <!-- Participant Avatars -->
                                <div class="flex -space-x-2 overflow-hidden mb-2">
                                    @for($i = 0; $i < min(5, $activity->participants); $i++)
                                    <img class="inline-block h-7 w-7 rounded-full ring-2 ring-white" src="https://randomuser.me/api/portraits/men/{{ $i + 10 }}.jpg" alt="Participant">
                                    @endfor
                                    @if($activity->participants > 5)
                                    <div class="flex items-center justify-center h-7 w-7 rounded-full bg-gray-200 ring-2 ring-white text-xs text-gray-500">
                                        +{{ $activity->participants - 5 }}
                                    </div>
                                    @endif
                                </div>
                                
                                <!-- Minimum participants info -->
                                <div class="text-xs text-gray-600 mb-3">
                                    <span class="font-medium">Required minimum:</span> {{ $activity->min_participants }} participants
                                    @if($activity->participants < $activity->min_participants)
                                    <span class="text-orange-500 font-medium"> ({{ $activity->min_participants - $activity->participants }} more needed)</span>
                                    @else
                                    <span class="text-green-500 font-medium"> (minimum reached)</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <form action="/activity/join/{{ $activity->id }}" method="get">
                                @csrf
                                <button type="submit" class="w-full py-2 rounded-lg text-sm font-medium mb-2 transition-all {{ $activity->participants >= $activity->max_participants ? 'bg-gray-200 text-gray-500 cursor-not-allowed' : 'bg-pink-600 hover:bg-pink-700 text-white shadow-md hover:shadow-lg' }}" {{ $activity->participants >= $activity->max_participants ? 'disabled' : '' }}>
                                    {{ $activity->participants >= $activity->max_participants ? 'Activity is full' : 'Join activity' }}
                                </button>
                            </form>

                            <div class="grid grid-cols-2 gap-2">
                                <button class="py-2 border border-pink-600 text-pink-600 hover:bg-pink-50 rounded-lg text-sm font-medium transition-all" onclick="shareActivity()">
                                    <div class="flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                        </svg>
                                        Share
                                    </div>
                                </button>

                                <form action="/" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full py-2 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-lg text-sm font-medium transition-all">
                                        <div class="flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                            Save
                                        </div>
                                    </button>
                                </form>
                            </div>
                        </aside>
                    </div>

                    <!-- Host Information and Location in a grid -->
                    <div class="grid md:grid-cols-2 gap-4 border-t border-gray-200 pt-4 mt-4">
                     

                        <!-- Location Map -->
                        <section>
                            <h3 class="text-base font-semibold text-gray-800 mb-3">Location</h3>
                            <figure class="bg-gray-100 rounded-lg h-40 mb-2 flex items-center justify-center" id="map">
                                <!-- Placeholder for map -->
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-gray-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    <p class="text-gray-500 text-xs">Map of {{ $activity->centre->name }}</p>
                                </div>
                            </figure>
                            <address class="text-gray-600 text-xs not-italic">
                            <span class="font-medium">Address:</span>   {{ $activity->centre->adresse->country }}, {{ $activity->centre->adresse->city }}, {{ $activity->centre->adresse->boulevard }}

                            </address>
                        </section>
                    </div>
                </div>
            </article>
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
                                <li><a href="/" class="text-blue-200 hover:text-pink-200 transition-colors">Home</a></li>
                                <li><a href="{{ route('activities.index') }}" class="text-blue-200 hover:text-pink-200 transition-colors">Activities</a></li>
                                <li><a href="{{ route('activities.create') }}" class="text-blue-200 hover:text-pink-200 transition-colors">Create an activity</a></li>
                            </ul>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Contact</h3>
                            <address class="text-blue-200 not-italic">
                                <p>support@matching.com</p>
                                <p>+33 (0)1 23 45 67 89</p>
                                <div class="flex space-x-3 mt-4 justify-center md:justify-start">
                                    <a href="#" class="text-blue-200 hover:text-pink-200" aria-label="Facebook">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-blue-200 hover:text-pink-200" aria-label="Twitter">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                        </svg>
                                    </a>
                                    <a href="#" class="text-blue-200 hover:text-pink-200" aria-label="Instagram">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                            <path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z" clip-rule="evenodd"></path>
                                        </svg>
                                    </a>
                                </div>
                            </address>
                        </div>
                    </div>
                </div>
                <div class="mt-8 pt-6 border-t border-blue-800 text-center text-blue-300 text-sm">
                    <p>
                        &copy; {{ date('Y') }} Matching. All rights reserved.
                    </p>
                </div>
            </div>
        </footer>
    </div>

    <script>
        function shareActivity() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $activity->name }}',
                    text: 'Check out this activity on Matching!',
                    url: window.location.href,
                })
                .catch(console.error);
            } else {
                alert('Sharing is not available on your browser. You can copy the URL manually.');
            }
        }
    </script>
</body>

</html>