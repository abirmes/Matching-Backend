<!-- Recent Activities Section -->
<div class="mt-8">
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-semibold text-gray-900">Recent Activities</h2>
        <a href="/activities" class="text-sm font-medium text-pink-600 hover:text-pink-800 transition-colors">
            View all
        </a>
    </div>

    <div class="bg-white shadow-lg rounded-xl overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Activity
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Location
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Date
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Participants
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($recentActivities as $activity)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-md object-cover" src="{{ $activity->image }}" alt="{{ $activity->name }}">
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $activity->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $activity->type->name }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                {{ $activity->categorie->name }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $activity->centre->adresse->city }}, {{ $activity->centre->adresse->country }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ date('d M Y', strtotime($activity->date_debut)) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            <div class="flex items-center">
                                <span class="mr-2">{{ $activity->participants }}/{{ $activity->max_participants }}</span>
                                <div class="w-16 bg-gray-200 rounded-full h-2">
                                    <div class="{{ $activity->participants >= $activity->max_participants ? 'bg-pink-500' : 'bg-green-500' }} h-2 rounded-full" style="width: {{ ($activity->participants / $activity->max_participants) * 100 }}%"></div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($activity->participants >= $activity->max_participants)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                                Full
                            </span>
                            @elseif($activity->participants < $activity->min_participants)
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                Needs more
                            </span>
                            @else
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Open
                            </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="/activity/{{ $activity->id }}" class="text-blue-600 hover:text-blue-900 mr-3">View</a>
                            <a href="/activity/edit/{{ $activity->id }}" class="text-pink-600 hover:text-pink-900">Edit</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Activity Stats Cards -->
<div class="mt-8 grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3">
    <!-- Popular Categories -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all">
        <div class="p-5">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Popular Categories</h3>
            <div class="space-y-3">
                @foreach($popularCategories as $category)
                <div class="flex items-center justify-between">
                    <span class="text-sm text-gray-600">{{ $category->name }}</span>
                    <span class="text-xs font-medium px-2 py-1 rounded-full bg-blue-100 text-blue-800">{{ $category->count }} activities</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Activity Growth -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all">
        <div class="p-5">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Activity Growth</h3>
            <div class="h-48 flex items-center justify-center">
                <!-- Placeholder for chart -->
                <div class="text-center text-gray-500">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-sm">Activity growth chart</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Upcoming Activities -->
    <div class="bg-white overflow-hidden shadow-lg rounded-xl hover:shadow-xl transition-all">
        <div class="p-5">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Upcoming Activities</h3>
            <div class="space-y-4">
                @for($i = 0; $i < 3; $i++)
                <div class="flex items-start">
                    <div class="flex-shrink-0">
                        <div class="inline-flex items-center justify-center h-8 w-8 rounded-full bg-pink-100 text-pink-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <div class="text-sm font-medium text-gray-900 truncate">{{ $upcomingActivities[$i]->name }}</div>
                        <div class="text-sm text-gray-500">{{ date('d M Y', strtotime($upcomingActivities[$i]->date_debut)) }}</div>
                        <div class="text-xs text-gray-400">{{ $upcomingActivities[$i]->participants }}/{{ $upcomingActivities[$i]->max_participants }} participants</div>
                    </div>
                </div>
                @endfor
            </div>
        </div>
    </div>
</div>

<!-- Setup PHP variables for controller -->
@php
// Define the necessary collections in your controller:
// $recentActivities = Activity::latest()->take(5)->get();
// $popularCategories = DB::table('categories')
//    ->join('activities', 'categories.id', '=', 'activities.categorie_id')
//    ->select('categories.name', DB::raw('count(*) as count'))
//    ->groupBy('categories.name')
//    ->orderBy('count', 'desc')
//    ->take(5)
//    ->get();
// $upcomingActivities = Activity::where('date_debut', '>', now())
//    ->orderBy('date_debut')
//    ->take(3)
//    ->get();
@endphp