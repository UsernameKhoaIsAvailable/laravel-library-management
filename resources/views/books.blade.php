<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Books') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <form class="flex px-1" action="{{ route('books.search') }}" method="get">
                    <x-text-input id="search" name="search" type="text" class="w-full" placeholder="Search..."
                        required />
                    <x-primary-button>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </x-primary-button>
                </form>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-book')">
                    <i class="fa-solid fa-plus"></i>
                </x-primary-button>
            </div>

            <table class="table-auto w-full border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 px-4 py-2">Name</th>
                        <th class="border border-gray-300 px-4 py-2">Category</th>
                        <th class="border border-gray-300 px-4 py-2">Author</th>
                        <th class="border border-gray-300 px-4 py-2">Language</th>
                        <th class="border border-gray-300 px-4 py-2">Quantity</th>
                        <th class="border border-gray-300 px-4 py-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $index => $book)
                        <tr class="text-center">
                            <td class="border border-gray-300 px-4 py-2">{{ $book->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $book->category }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $book->author }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $book->language }}</td>
                            <td class="border border-gray-300 px-4 py-2">
                                {{ $book->quantity ?? 'N/A' }}
                            </td>
                            <td class="border border-gray-300 py-2 flex space-x-2 justify-center">
                                <div class="px-1">
                                    <x-secondary-button x-data=""
                                        x-on:click.prevent="$dispatch('open-modal', '{{'book' . (string) $index}}')">
                                        <i class="fa-solid fa-pen"></i>
                                    </x-secondary-button>
                                </div>

                                <form action="{{ route('books.destroy', $book) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <x-danger-button>
                                        <i class="fa-regular fa-trash-can"></i>
                                    </x-danger-button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if ($books->isEmpty())
                        <tr>
                            <td colspan="6" class="border border-gray-300 px-4 py-2 text-center">No books found.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
            <div class="mt-4">
                {{ $books->links() }}
            </div>

            @foreach ($books as $index => $book)
                <x-modal name="{{'book' . (string) $index}}">
                    <form method="post" action="{{ route('books.update', $book)}}" class="p-6">
                        @csrf
                        @method('PUT')
                        <h2 class="text-lg font-medium text-gray-900">
                            {{ __('Update book') }}
                        </h2>

                        <div class="mt-6">
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $book->name)" required autofocus autocomplete="name" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="category" :value="__('Category')" />
                            <x-text-input id="category" name="category" type="text" class="mt-1 block w-full"
                                :value="old('category', $book->category)" required autofocus autocomplete="category" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="author" :value="__('Author')" />
                            <x-text-input id="author" name="author" type="text" class="mt-1 block w-full"
                                :value="old('author', $book->author)" required autofocus autocomplete="author" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="language" :value="__('Language')" />
                            <x-text-input id="language" name="language" type="text" class="mt-1 block w-full"
                                :value="old('language', $book->language)" required autofocus autocomplete="language" />
                        </div>

                        <div class="mt-6">
                            <x-input-label for="quantity" :value="__('Quantity')" />
                            <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full"
                                :value="old('quantity', $book->quantity)" required autofocus autocomplete="quantity" />
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

            <x-modal name="add-book">
                <form method="post" action="{{ route('books.store')}}" class="p-6">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add new book') }}
                    </h2>

                    <div class="mt-6">
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required autofocus
                            autocomplete="name" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="category" :value="__('Category')" />
                        <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" autofocus
                            autocomplete="category" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="author" :value="__('Author')" />
                        <x-text-input id="author" name="author" type="text" class="mt-1 block w-full" autofocus
                            autocomplete="author" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="language" :value="__('Language')" />
                        <x-text-input id="language" name="language" type="text" class="mt-1 block w-full" autofocus
                            autocomplete="language" />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="quantity" :value="__('Quantity')" />
                        <x-text-input id="quantity" name="quantity" type="text" class="mt-1 block w-full" required
                            autofocus autocomplete="quantity" />
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