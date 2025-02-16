<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{--<div class="flex justify-end mb-4">
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-reader')">
                    <i class="fa-solid fa-plus"></i>
                </x-primary-button>
            </div>--}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("Coming soon...") }}
                </div>
            </div>
            @foreach ($transactions as $transaction)
            <div class="border border-gray-200 rounded mb-4">
                <div class="bg-gray-100 px-4 py-2 flex justify-between items-center cursor-pointer" data-transaction-id="{{ $transaction->id }}">
                    <div class="font-bold">Transaction #{{ $transaction->id }}
                        <span class="bg-blue-200 text-blue-800 px-2 py-1 rounded ml-2">{{ $transaction->reader->name }}</span>
                    </div>
                    <div>
                        <span class="bg-gray-200 text-gray-800 px-2 py-1 rounded mr-2">{{ $transaction->borrow_date }}</span>
                        <span class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">Lines: {{ $transaction->number_of_transaction_lines }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="icon-{{ $transaction->id }}">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>

                    </div>
                </div>
                <div class="px-4 py-2 hidden" data-transaction-id="{{ $transaction->id }}">
                    <div class="overflow-x-auto">
                        @foreach ($transaction->transactionLines as $line)
                        <li class="mb-2"> <span class="font-bold">Line ID:</span> {{ $line->id }}<br>
                            <span class="font-bold">Book:</span> {{ $line->book->name ?? 'N/A' }}<br>
                        </li>
                        @endforeach
                    </div>
                    {{-- }}
                    <div class="mt-4 flex justify-end">
                        <a href="{{ route('transactions.edit', $transaction) }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mr-2">Edit</a>
                        <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </div>--}}
                </div>
            </div>
            @endforeach
            <script>
                const panels = document.querySelectorAll('.border');

                panels.forEach(panel => {
                    const heading = panel.querySelector('.bg-gray-100');
                    const body = panel.querySelector('.px-4.py-2.hidden');
                    const icon = panel.querySelector(`#icon-${panel.dataset.transactionId}`);

                    heading.addEventListener('click', () => {
                        body.classList.toggle('hidden');
                        if (icon.innerHTML.includes("M19 9l-7 7-7-7")) {
                            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />`;
                        } else {
                            icon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />`;
                        }

                    });
                });
            </script>

            {{--@foreach ($readers as $index=>$reader)
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
            </x-modal>--}}
        </div>
    </div>
</x-app-layout>