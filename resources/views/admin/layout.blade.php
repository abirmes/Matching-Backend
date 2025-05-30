<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Matching - Dashboard</title>
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
                    <a href="activities" class="text-gray-700 hover:text-pink-500 hover:border-b-2 hover:border-pink-500 px-1 transition-all">Activities</a>
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
        <sidebar class="hidden md:flex md:flex-shrink-0">
            <div class="flex flex-col w-64 bg-blue-900 text-white">
                
                <div class="p-4 border-b border-blue-800">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 h-10 w-10 bg-blue-800 rounded-full flex items-center justify-center">
                            <svg class="h-6 w-6 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm font-medium">{{Auth::user()->firstname}} {{Auth::user()->lastname}} </p>
                            <p class="text-xs text-blue-300">Admin</p>
                        </div>
                    </div>
                </div>

                <div class="flex-1 px-2 py-4 space-y-1">
                    <a href="/dashboard" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->is('dashboard') ? 'bg-pink-600 text-white' : 'text-blue-100 hover:bg-pink-600 hover:text-white' }} transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Dashboard
                    </a>

                    <a href="/dashboard/users" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->is('dashboard/users') ? 'bg-pink-600 text-white' : 'text-blue-100 hover:bg-pink-600 hover:text-white' }} transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Users
                    </a>
                    <a href="/dashboard/centres" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->is('dashboard/centres') ? 'bg-pink-600 text-white' : 'text-blue-100 hover:bg-pink-600 hover:text-white' }} transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        Centres
                    </a>
                    <a href="/dashboard/adresses" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->is('dashboard/adresses') ? 'bg-pink-600 text-white' : 'text-blue-100 hover:bg-pink-600 hover:text-white' }} transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Adresses
                    </a>

                    <a href="/dashboard/types" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->is('dashboard/types') ? 'bg-pink-600 text-white' : 'text-blue-100 hover:bg-pink-600 hover:text-white' }} transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                        </svg>
                        Types
                    </a>


                    <a href="/dashboard/categories" class="flex items-center px-4 py-2 text-sm font-medium rounded-md {{ request()->is('dashboard/categories') ? 'bg-pink-600 text-white' : 'text-blue-100 hover:bg-pink-600 hover:text-white' }} transition-all">
                        <svg class="mr-3 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                        Categories
                    </a>

                </div>
            </div>
        </sidebar>

        <div class="flex flex-col w-0 flex-1 overflow-hidden">
            <main class="flex-1 relative overflow-y-auto focus:outline-none">
                <div class="py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
                    </div>

                    <div class="max-w-7xl mx-auto px-4 sm:px-6 md:px-8">
                        
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
                        @yield('categories')
                        @yield('types')
                        @yield('dashboard')
                        @yield('centres')
                        @yield('users')
                        @yield('adresses')
                    </div>
                </div>
            </main>
        </div>
    </div>
</body>

</html>