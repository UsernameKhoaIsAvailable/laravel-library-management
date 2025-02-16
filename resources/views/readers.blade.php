<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Readers') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-4">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-reader')">
                    <i class="fa-solid fa-plus"></i>
                </x-primary-button>
            </div>

            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Gender</th>
                        <th class="border border-gray-300 px-4 py-2">Date of birth</th>
                        <th class="border border-gray-300 px-4 py-2">Id number</th>
                        <th class="border border-gray-300 px-4 py-2">Address</th>
                        <th class="border border-gray-300 px-4 py-2">Number of book borrowed</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($readers as $index=>$reader)
                    <tr class="text-center">
                        <td class="border border-gray-300 px-4 py-2">{{ $reader->name }}</td>
                        <td class="border border-gray-300 px-4 py-2">
                            @if ($reader->gender == true)
                            Male
                            @else
                            Female
                            @endif
                        </td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reader->dob->format('Y-m-d') }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reader->id_number }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reader->address ?? '-' }}</td>
                        <td class="border border-gray-300 px-4 py-2">{{ $reader->number_of_books_borrowed }}</td>
                        <td class="border border-gray-300 py-2 flex space-x-2 justify-center">
                            <div class="px-1">
                                <x-secondary-button x-data="" x-on:click.prevent="$dispatch('open-modal', '{{'reader'.(string)$index}}')">
                                    <i class="fa-solid fa-pen"></i>
                                </x-secondary-button>
                            </div>

                            <form action="{{ route('readers.destroy', $reader) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <x-danger-button>
                                    <i class="fa-regular fa-trash-can"></i>
                                </x-danger-button>
                            </form>
                        </td>
                    </tr>
                    @endforeach

                    @if ($readers->isEmpty())
                    <tr>
                        <td colspan="7" class="border border-gray-300 px-4 py-2 text-center">No readers found.</td>
                    </tr>
                    @endif
                </tbody>
            </table>

            @foreach ($readers as $index=>$reader)
            <x-modal name="{{'reader'.(string)$index}}">
                <form method="post" action="{{ route('readers.update', $reader)}}" class="p-6">
                    @csrf
                    @method('PUT')
                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Update reader') }}
                    </h2>

                    <div class="mt-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $reader->name)" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="gender" :value="__('Gender')" /> 
                        <div class="mt-2"> 
                            <div class="flex items-center">
                                <input id="male" name="gender" type="radio" value="1" {{ $reader->gender == 1 ? 'checked' : '' }} required
                                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="male" class="ml-3 block text-sm font-medium text-gray-700">
                                    Male
                                </label>
                            </div>
                            <div class="flex items-center mt-2"> 
                                <input id="female" name="gender" type="radio" value="0" {{ $reader->gender == 0 ? 'checked' : '' }} required
                                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="female" class="ml-3 block text-sm font-medium text-gray-700">
                                    Female
                                </label>
                            </div>
                            @error('gender')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="dob" :value="__('Date of Birth')" />
                        <x-text-input id="dob" name="dob" type="date" 
                            class="mt-1 block w-full"
                            value="{{ old('dob', $reader->dob->format('Y-m-d')) }}"
                            required />
                        @error('dob')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mt-6">
                        <x-input-label for="id_number" :value="__('Id number')" />
                        <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" :value="old('id_number', $reader->id_number)" required autofocus autocomplete="id_number" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $reader->address)" required autofocus autocomplete="address" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Update') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
            @endforeach

            <x-modal name="add-reader">
                <form method="post" action="{{ route('readers.store')}}" class="p-6">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add new reader') }}
                    </h2>

                    <div class="mt-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus autocomplete="name" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="gender" :value="__('Gender')" /> 
                        <div class="mt-2"> 
                            <div class="flex items-center">
                                <input id="male" name="gender" type="radio" value="1" required
                                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="male" class="ml-3 block text-sm font-medium text-gray-700">
                                    Male
                                </label>
                            </div>
                            <div class="flex items-center mt-2"> 
                                <input id="female" name="gender" type="radio" value="0" required
                                    class="focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300">
                                <label for="female" class="ml-3 block text-sm font-medium text-gray-700">
                                    Female
                                </label>
                            </div>
                            @error('gender')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="dob" :value="__('Date of Birth')" />
                        <x-text-input id="dob" name="dob" type="date" 
                            class="mt-1 block w-full"
                            required />
                        @error('dob')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="mt-6">
                        <x-input-label for="id_number" :value="__('Id number')" />
                        <x-text-input id="id_number" name="id_number" type="text" class="mt-1 block w-full" required autofocus autocomplete="id_number" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="address" :value="__('Address')" />
                        <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" required autofocus autocomplete="address" />
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Cancel') }}
                        </x-secondary-button>

                        <x-primary-button class="ms-3">
                            {{ __('Add') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        </div>
    </div>
</x-app-layout>