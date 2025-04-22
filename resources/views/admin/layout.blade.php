<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matching - Dashboard</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
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

<body class="bg-pattern">

    <header class="bg-white shadow-md py-3 sticky top-0 z-10">
        <div class="container mx-auto px-4">
            <nav class="flex items-center justify-between">
                <div class="text-xl font-bold text-blue-800">
                    Matching<span class="text-pink-500">.</span>
                </div>
                <div class="hidden md:flex space-x-5">
                    @if ( Auth::check() && Auth::user()->role->name === "admin")
                    <a href="/dashboard" class="text-blue-900 font-medium border-b-2 border-pink-500 px-1">Dashboard</a>
                    @endif
                    <a href="/" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Home</a>
                    <a href="#" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Activities</a>
                    <a href="/activityCreate" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Create</a>
                </div>
                @if ( !Auth::user() )
                <div class="flex space-x-3">
                    <a href="/register" class="text-pink-600 hover:text-pink-700 font-medium">Register</a>
                    <a href="/login" class="bg-pink-600 hover:bg-pink-700 text-white px-4 py-1.5 rounded-full text-sm shadow-md">Sign In</a>
                </div>
                @elseif ( Auth::user() )
                <div class="flex space-x-3">
                    <a href="/logout" class="text-pink-600 hover:text-pink-700 font-medium">Logout</a>
                </div>
                @endif

            </nav>
        </div>
    </header>
    <div class="min-h-screen flex">
        <!-- Sidebar (desktop) -->
        <sidebar class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-900 text-white">
                <!-- Logo -->
                <div class="h-16 flex items-center px-6 border-b border-blue-800">
                    <div class="text-xl font-bold">
                        Matching<span class="text-pink-500">.</span>
                    </div>
                </div>

                <!-- User profile -->
                <div class="p-4 border-b border-blue-800">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-blue-800 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{Auth::user()->name}}</p>
                            <p class="text-xs text-blue-300">Admin</p>
                        </div>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex-1 px-2 py-4 space-y-1">
                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md bg-pink-600 text-white">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-100 hover:bg-pink-600 hover:text-white transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>

                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-100 hover:bg-pink-600 hover:text-white transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Activities
                    </a>

                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-100 hover:bg-pink-600 hover:text-white transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Calendar
                    </a>

                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-100 hover:bg-pink-600 hover:text-white transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Messages
                    </a>

                    <a href="#" class="flex items-center px-4 py-2 text-sm font-medium rounded-md text-blue-100 hover:bg-pink-600 hover:text-white transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Settings
                    </a>
                </div>

                
            </div>
        </sidebar>



        <div class="flex flex-col w-0 flex-1 overflow-hidden">


            <!-- Main content area -->
            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                    </div>

                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <!-- Stats cards -->
                        <div class="mt-6 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-4">
                            <!-- Card 1 -->
                            <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all transform hover:-translate-y-1 duration-300">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-blue-900 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Total Users</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">1,234</div>
                                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Increased by</span>
                                                        12%
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 2 -->
                            <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all transform hover:-translate-y-1 duration-300">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-pink-600 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Total Activities</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">567</div>
                                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Increased by</span>
                                                        8%
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 3 -->
                            <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all transform hover:-translate-y-1 duration-300">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-blue-900 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">New Messages</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">42</div>
                                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-red-600">
                                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M14.707 10.293a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 111.414-1.414L9 12.586V5a1 1 0 012 0v7.586l2.293-2.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Decreased by</span>
                                                        3%
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card 4 -->
                            <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all transform hover:-translate-y-1 duration-300">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-pink-600 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </div>
                                        <div class="ml-5 w-0 flex-1">
                                            <dl>
                                                <dt class="text-sm font-medium text-gray-500 truncate">Revenue</dt>
                                                <dd class="flex items-baseline">
                                                    <div class="text-2xl font-semibold text-gray-900">$24,352</div>
                                                    <div class="ml-2 flex items-baseline text-sm font-semibold text-green-600">
                                                        <svg class="self-center flex-shrink-0 h-5 w-5 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                                        </svg>
                                                        <span class="sr-only">Increased by</span>
                                                        15%
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @yield('categories')
                        @yield('types')
                        @yield('dashboard')
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script>
        // Mobile sidebar toggle
        function toggleMobileSidebar() {
            const mobileSidebar = document.getElementById('mobileSidebar');
            mobileSidebar.style.display = mobileSidebar.style.display === 'none' ? 'block' : 'none';
        }

        // Profile dropdown toggle
        const profileButton = document.getElementById('profileButton');
        const profileDropdown = document.getElementById('profileDropdown');

        profileButton.addEventListener('click', function() {
            profileDropdown.style.display = profileDropdown.style.display === 'none' ? 'block' : 'none';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(event) {
            if (!profileButton.contains(event.target) && !profileDropdown.contains(event.target)) {
                profileDropdown.style.display = 'none';
            }
        });
    </script>
</body>

</html>