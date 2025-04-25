@extends('./admin/layout')
@section('adresses')

<div class="bg-gray-100 p-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center">
            <h2 class="text-lg font-medium text-gray-900">adresses Table</h2>
            <div class="flex items-center space-x-3">
                <div class="relative">
                    <input type="text" placeholder="Search..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-600">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                </div>
                <button id="openCreateModal" class="inline-flex items-center px-4 py-2 bg-pink-500 text-white text-sm font-medium rounded-md shadow hover:bg-pink-600">
                    <svg class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                    </svg>
                    Add New
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Country</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">City</th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Boulevard</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($adresses as $adresse)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$adresse->country}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$adresse->city}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$adresse->boulevard}}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button
                                type="button"
                                class="text-blue-600 hover:text-blue-900 edit-btn"
                                data-id="{{ $adresse->id }}"
                                data-country="{{ $adresse->country }}"
                                data-city="{{ $adresse->city }}"
                                data-boulevard="{{ $adresse->boulevard }}">
                                Edit
                            </button>
                            <form action="{{ route('adresses.delete', ['id' => $adresse->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ml-4 text-pink-500 hover:text-pink-700" onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Modal -->
<div id="createModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Create New Category
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('adresses.store') }}" method="POST" id="createForm">
                                @csrf
                                <div class="mb-4">
                                    <label for="country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <input type="text" name="country" id="country" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div class="mb-4">
                                    <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" name="city" id="city" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div class="mb-4">
                                    <label for="boulevard" class="block text-sm font-medium text-gray-700">Boulevard</label>
                                    <input type="text" name="boulevard" id="boulevard" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" form="createForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pink-500 text-base font-medium text-white hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Create
                </button>
                <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                    Cancel
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Update Modal -->
<div id="updateModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Update Category
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('adresses.update', ['id' => $adresse->id]) }}" method="POST" id="updateForm">
                                @csrf
                                @method('PUT') <!-- Ensure it's a PUT request to update -->
                                <input type="hidden" id="edit_id" name="id" value="{{ $adresse->id }}"> <!-- Set the category ID -->

                                <div class="mb-4">
                                    <label for="edit_country" class="block text-sm font-medium text-gray-700">country</label>
                                    <input type="text" name="country" id="edit_country" value="{{ $adresse->country }}" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="mb-4">
                                    <label for="edit_city" class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" name="city" id="edit_city" value="{{ $adresse->city }}" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div class="mb-4">
                                    <label for="edit_boulevard" class="block text-sm font-medium text-gray-700">Boulevard</label>
                                    <input type="text" name="boulevard" id="edit_boulevard" value="{{ $adresse->boulevard }}" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pink-500 text-base font-medium text-white hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Update
                                    </button>
                                    <button type="button" class="closeModal mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                        Cancel
                                    </button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Modal functionality
    document.addEventListener('DOMContentLoaded', function() {
        // Open create modal
        document.getElementById('openCreateModal').addEventListener('click', function() {
            document.getElementById('createModal').classList.remove('hidden');
        });

        // Open update modal and populate form
        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const country = this.getAttribute('data-country');
                const city = this.getAttribute('data-city');
                const boulevard = this.getAttribute('data-boulevard');


                // Populate form fields
                document.getElementById('edit_id').value = id;
                document.getElementById('edit_country').value = country;
                document.getElementById('edit_city').value = city;
                document.getElementById('edit_boulevard').value = boulevard;

                // Show modal
                document.getElementById('updateModal').classList.remove('hidden');
            });
        });

        // Close modals
        const closeButtons = document.querySelectorAll('.closeModal');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('createModal').classList.add('hidden');
                document.getElementById('updateModal').classList.add('hidden');
            });
        });

        // Close modals when clicking outside
        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                document.getElementById('createModal').classList.add('hidden');
                document.getElementById('updateModal').classList.add('hidden');
            }
        });
    });
</script>

@endsection