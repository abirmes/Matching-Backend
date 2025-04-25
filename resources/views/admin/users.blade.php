@extends('./admin/layout')
@section('users')

<div class="bg-gray-100 p-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center">
            <h2 class="text-lg font-medium text-gray-900">Users Table</h2>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">date_naissance</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Address</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Merite</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{$user->firstname}} {{$user->lastname}} 
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$user->email}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$user->date_naissance}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$user->adresse->country}}, {{$user->adresse->city}}, {{$user->adresse->boulevard}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                {{$user->role->name}}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $user->status === 'active' ? 'bg-green-100 text-green-800' : 
                                   ($user->status === 'inactive' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                {{$user->status}}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$user->merite}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button
                                type="button"
                                class="text-purple-600 hover:text-purple-900 role-btn"
                                data-id="{{ $user->id }}"
                                data-role="{{ $user->role }}">
                                Role
                            </button>
                            <button
                                type="button"
                                class="ml-3 text-yellow-600 hover:text-yellow-900 status-btn"
                                data-id="{{ $user->id }}"
                                data-status="{{ $user->status }}">
                                Status
                            </button>
                            <button
                                type="button"
                                class="ml-3 text-green-600 hover:text-green-900 merite-btn"
                                data-id="{{ $user->id }}"
                                data-merite="{{ $user->merite }}">
                                Merite
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Role Modal -->
<div id="roleModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Change User Role
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('users.role.update') }}" method="POST" id="roleForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="role_user_id" name="id">
                                
                                <div class="mb-4">
                                    <label for="update_role" class="block text-sm font-medium text-gray-700">Role</label>
                                    <select name="role" id="update_role" class="mt-1 focus:ring-purple-500 focus:border-purple-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <option value="utilisateur">User</option>
                                        <option value="admin">Admin</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="roleForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-purple-500 text-base font-medium text-white hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update Role
                </button>
                <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Status Modal -->
<div id="statusModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Change User Status
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('users.status.update') }}" method="POST" id="statusForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="status_user_id" name="id">
                                
                                <div class="mb-4">
                                    <label for="update_status" class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" id="update_status" class="mt-1 focus:ring-yellow-500 focus:border-yellow-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                        <option value="banned">Banned</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="statusForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-yellow-500 text-base font-medium text-white hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update Status
                </button>
                <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Merite Modal -->
<div id="meriteModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Update Merite
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('users.merite.update') }}" method="POST" id="meriteForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="merite_user_id" name="id">
                                
                                <div class="mb-4">
                                    <label for="update_merite" class="block text-sm font-medium text-gray-700">Merite</label>
                                    <input type="number" name="merite" id="update_merite" min="0" class="mt-1 focus:ring-green-500 focus:border-green-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="meriteForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Update Merite
                </button>
                <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Open role modal and populate form
        const roleButtons = document.querySelectorAll('.role-btn');
        roleButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const role = this.getAttribute('data-role');
                
                // Populate form fields
                document.getElementById('role_user_id').value = id;
                document.getElementById('update_role').value = role;
                
                // Show modal
                document.getElementById('roleModal').classList.remove('hidden');
            });
        });

        // Open status modal and populate form
        const statusButtons = document.querySelectorAll('.status-btn');
        statusButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const status = this.getAttribute('data-status');
                
                // Populate form fields
                document.getElementById('status_user_id').value = id;
                document.getElementById('update_status').value = status;
                
                // Show modal
                document.getElementById('statusModal').classList.remove('hidden');
            });
        });

        // Open merite modal and populate form
        const meriteButtons = document.querySelectorAll('.merite-btn');
        meriteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const merite = this.getAttribute('data-merite');
                
                // Populate form fields
                document.getElementById('merite_user_id').value = id;
                document.getElementById('update_merite').value = merite;
                
                // Show modal
                document.getElementById('meriteModal').classList.remove('hidden');
            });
        });

        // Close modals
        const closeButtons = document.querySelectorAll('.closeModal');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('roleModal').classList.add('hidden');
                document.getElementById('statusModal').classList.add('hidden');
                document.getElementById('meriteModal').classList.add('hidden');
            });
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                document.getElementById('roleModal').classList.add('hidden');
                document.getElementById('statusModal').classList.add('hidden');
                document.getElementById('meriteModal').classList.add('hidden');
            }
        });
    });
</script>

@endsection