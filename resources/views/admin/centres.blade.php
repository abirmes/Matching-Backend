@extends('./admin/layout')
@section('centres')

<div class="bg-gray-100 p-6">
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <div class="p-4 border-b border-gray-200 flex flex-col sm:flex-row justify-between items-center">
            <h2 class="text-lg font-medium text-gray-900">Centres Table</h2>
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
                <button id="changeView"  onclick="changeView()" class="inline-flex items-center px-4 py-2 bg-grey-500 text-white text-sm font-medium rounded-md  hover:bg-pink-800">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="#333" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="4" cy="4" r="2" />
                        <circle cx="12" cy="4" r="2" />
                        <circle cx="20" cy="4" r="2" />
                        <circle cx="4" cy="12" r="2" />
                        <circle cx="12" cy="12" r="2" />
                        <circle cx="20" cy="12" r="2" />
                        <circle cx="4" cy="20" r="2" />
                        <circle cx="12" cy="20" r="2" />
                        <circle cx="20" cy="20" r="2" />
                    </svg>

                </button>
            </div>
        </div>
        <div id="gonnaBeHiddenButton1" style="display: none;">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Speciality</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Etat</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Adresse</th>
                            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($centres as $centre)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$centre->name}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$centre->speciality}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$centre->etat}}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{$centre->adresse->country}} ,{{$centre->adresse->city}},{{$centre->adresse->boulevard}} </td>


                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <button
                                    type="button"
                                    class="text-blue-600 hover:text-blue-900 edit-btn"
                                    data-id="{{ $centre->id }}"
                                    data-name="{{ $centre->name }}"
                                    data-speciality="{{ $centre->speciality }}"
                                    data-etat="{{ $centre->etat }}"
                                    data-image="{{ $centre->image }}">

                                    Edit
                                </button>
                                <button
                                    type="button"
                                    class="ml-3 text-green-600 hover:text-green-900 edit-address-btn"
                                    data-id="{{ $centre->id }}"
                                    data-country="{{ $centre->adresse->country }}"
                                    data-city="{{ $centre->adresse->city }}"
                                    data-boulevard="{{ $centre->adresse->boulevard }}">
                                    Address
                                </button>
                                <form action="{{ route('centres.delete', ['id' => $centre->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-4 text-pink-500 hover:text-pink-700" onclick="return confirm('Are you sure you want to delete this center?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div id="gonnaBeHiddenButton2" style="display: block;">
            <div class="container mx-auto px-4 py-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($centres as $centre)
                    <div class="bg-white shadow rounded-lg overflow-hidden flex flex-col h-full transition-transform duration-300 hover:shadow-lg hover:scale-102">
                        <img src="{{ $centre->image ?? '/api/placeholder/400/200' }}" alt="{{ $centre->name ?? 'Center Image' }}" class="w-full h-48 object-cover">

                        <div class="p-4 flex-grow">
                            <div class="flex justify-between items-center mb-3">
                                <h3 class="text-lg font-medium text-gray-900">{{ $centre->name }}</h3>
                                <span class="px-2 py-1 text-xs font-medium rounded-full {{ $centre->etat == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $centre->etat }}
                                </span>
                            </div>

                            <div class="mb-3 text-sm text-gray-600">
                                <span class="font-medium">Speciality:</span> {{ $centre->speciality }}
                            </div>

                            <div class="mb-4 pb-3 border-b border-gray-200">
                                <div class="text-sm text-gray-600">
                                    <div class="mb-1"><span class="font-medium">Country:</span> {{ $centre->adresse->country }}</div>
                                    <div class="mb-1"><span class="font-medium">City:</span> {{ $centre->adresse->city }}</div>
                                    <div><span class="font-medium">Boulevard:</span> {{ $centre->adresse->boulevard }}</div>
                                </div>
                            </div>

                            <div class="flex justify-between text-sm font-medium">
                                <button
                                    type="button"
                                    class="text-blue-600 hover:text-blue-900 edit-btn"
                                    data-id="{{ $centre->id }}"
                                    data-name="{{ $centre->name }}"
                                    data-speciality="{{ $centre->speciality }}"
                                    data-image="{{ $centre->image }}"

                                    data-etat="{{ $centre->etat }}">
                                    Edit
                                </button>
                                <button
                                    type="button"
                                    class="ml-3 text-green-600 hover:text-green-900 edit-address-btn"
                                    data-id="{{ $centre->id }}"
                                    data-country="{{ $centre->adresse->country }}"
                                    data-city="{{ $centre->adresse->city }}"
                                    data-boulevard="{{ $centre->adresse->boulevard }}">
                                    Address
                                </button>
                                <form action="{{ route('centres.delete', ['id' => $centre->id]) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ml-4 text-pink-500 hover:text-pink-700" onclick="return confirm('Are you sure you want to delete this center?')">Delete</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<div id="createModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Create New Center
                        </h3>
                        <div class="mt-4">
                            <form action="{{ route('centres.store') }}" method="POST" id="createForm">
                                @csrf
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="name" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div>
                                    <label for="speciality" class="block text-sm font-medium text-gray-700 mb-1">Speciality</label>
                                    <select name="speciality" id="speciality"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="" disabled selected>Select a speciality</option>
                                        @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->value }}">{{ ucfirst($speciality->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-4">
                                    <label for="etat" class="block text-sm font-medium text-gray-700">Etat</label>
                                    <textarea name="etat" id="etat" rows="3" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="image" class="block text-sm font-medium text-gray-700">image</label>
                                    <input type="text" name="image" id="image" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
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
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" form="createForm" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-pink-500 text-base font-medium text-white hover:bg-pink-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Create
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

<div id="updateModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Update Centre
                        </h3>
                        <div class="mt-4">
                            <form id="updateForm" method="post" action="{{ route('centres.update', ['id' => $centre->id]) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="edit_id" name="id">

                                <div class="mb-4">
                                    <label for="edit_name" class="block text-sm font-medium text-gray-700">Name</label>
                                    <input type="text" name="name" id="edit_name" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div>
                                    <label for="speciality" class="block text-sm font-medium text-gray-700 mb-1">Speciality</label>
                                    <select name="speciality" id="edit_speciality" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        <option value="" disabled selected>Select a speciality</option>
                                        @foreach($specialities as $speciality)
                                        <option value="{{ $speciality->value }}">{{ ucfirst($speciality->name) }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-4">
                                    <label for="edit_etat" class="block text-sm font-medium text-gray-700">Etat</label>
                                    <textarea name="etat" id="edit_etat" rows="3" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
                                </div>
                                <div class="mb-4">
                                    <label for="edit_image" class="block text-sm font-medium text-gray-700">image</label>
                                    <textarea name="image" id="edit_image" rows="3" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>
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

<div id="addressModal" class="fixed inset-0 z-50 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                            Update Address
                        </h3>
                        <div class="mt-4">
                            <form id="addressForm" method="post" action="{{ route('centres.adresses.update', ['id' => $centre->id]) }}">
                                @csrf
                                @method('PUT')
                                <input type="hidden" id="address_centre_id" name="id">

                                <div class="mb-4">
                                    <label for="edit_country" class="block text-sm font-medium text-gray-700">Country</label>
                                    <input type="text" name="country" id="edit_country" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="mb-4">
                                    <label for="edit_city" class="block text-sm font-medium text-gray-700">City</label>
                                    <input type="text" name="city" id="edit_city" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>

                                <div class="mb-4">
                                    <label for="edit_boulevard" class="block text-sm font-medium text-gray-700">Boulevard</label>
                                    <input type="text" name="boulevard" id="edit_boulevard" class="mt-1 focus:ring-pink-500 focus:border-pink-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                </div>
                                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                    <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-500 text-base font-medium text-white hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                        Update Address
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
    
    function changeView() {
            if(document.getElementById('gonnaBeHiddenButton1').style.display === 'none'){
                document.getElementById('gonnaBeHiddenButton2').style.display = 'none'
                document.getElementById('gonnaBeHiddenButton1').style.display = 'block'
            }
            else{
                document.getElementById('gonnaBeHiddenButton1').style.display = 'none'
                document.getElementById('gonnaBeHiddenButton2').style.display = 'block'
            }
        };
    document.addEventListener('DOMContentLoaded', function() {
        
        document.getElementById('openCreateModal').addEventListener('click', function() {
            document.getElementById('createModal').classList.remove('hidden');
        });
        

        const editButtons = document.querySelectorAll('.edit-btn');
        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const speciality = this.getAttribute('data-speciality');
                const etat = this.getAttribute('data-etat');
                const image = this.getAttribute('data-image')

                document.getElementById('edit_id').value = id;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_speciality').value = speciality;
                document.getElementById('edit_etat').value = etat;
                document.getElementById('edit_image').value = image;


                document.getElementById('updateModal').classList.remove('hidden');
            });
        });

        const editAddressButtons = document.querySelectorAll('.edit-address-btn');
        editAddressButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const country = this.getAttribute('data-country');
                const city = this.getAttribute('data-city');
                const boulevard = this.getAttribute('data-boulevard');

                document.getElementById('address_centre_id').value = id;
                document.getElementById('edit_country').value = country;
                document.getElementById('edit_city').value = city;
                document.getElementById('edit_boulevard').value = boulevard;

                document.getElementById('addressModal').classList.remove('hidden');
            });
        });

        const closeButtons = document.querySelectorAll('.closeModal');
        closeButtons.forEach(button => {
            button.addEventListener('click', function() {
                document.getElementById('createModal').classList.add('hidden');
                document.getElementById('updateModal').classList.add('hidden');
                document.getElementById('addressModal').classList.add('hidden');
            });
        });

        window.addEventListener('click', function(event) {
            if (event.target.classList.contains('fixed') && event.target.classList.contains('inset-0')) {
                document.getElementById('createModal').classList.add('hidden');
                document.getElementById('updateModal').classList.add('hidden');
                document.getElementById('addressModal').classList.add('hidden');
            }
        });
    });
</script>

@endsection