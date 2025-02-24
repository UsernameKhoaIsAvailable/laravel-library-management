<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transactions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-between mb-4">
                <form class="flex px-1" action="" method="get">
                    <x-text-input id="search" name="search" type="text" class="w-full" placeholder="Coming soon..."
                        required disabled />
                    <x-primary-button disabled>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </x-primary-button>
                </form>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'add-transaction')">
                    <i class="fa-solid fa-plus"></i>
                </x-primary-button>
            </div>
            <div class="accordion accordion-shadow">
                @foreach ($transactions as $transaction)
                    <div class="accordion-item" id="{{ $transaction->id }}">
                        <button class="accordion-toggle flex items-center gap-x-4 text-start justify-between"
                            aria-controls="payment-nested-collapse" aria-expanded="false">
                            <div class="inline-flex gap-x-4 items-center">
                                <span
                                    class="icon-[tabler--chevron-right] accordion-item-active:rotate-90 size-5 shrink-0 transition-transform duration-300 rtl:rotate-180"></span>
                                <div class="font-bold">#{{ $transaction->id }}
                                    <span
                                        class="bg-blue-200 text-blue-800 px-2 py-1 rounded ml-2">{{ $transaction->reader == null ? 'N/A' : $transaction->reader->name }}</span>
                                </div>
                            </div>
                            <div>
                                <span
                                    class="bg-yellow-200 text-yellow-800 px-2 py-1 rounded">{{ $transaction->number_of_transaction_lines }}
                                    books</span>
                                <span
                                    class="bg-gray-200 text-gray-800 px-2 py-1 rounded">{{ $transaction->borrow_date->format('Y-m-d') }}</span>
                                @if ($transaction->is_completed == 1)
                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded mr-2">Completed</span>
                                @endif
                            </div>
                        </button>
                        <div id="{{ (string) $transaction->id . '-nested' }}"
                            class="accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                            aria-labelledby="payment-nested" role="region">
                            <div class="accordion accordion-shadow ps-6">
                                <form action="{{ route('transactions.updatee') }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    @foreach ($transaction->transactionLines as $line)
                                        <div class="accordion-item">
                                            <div class="accordion-toggle flex items-center text-start gap-x-4 justify-between">
                                                <div class="flex items-center gap-2">
                                                    <input type="checkbox" class="checkbox checkbox-primary" name="lines[]"
                                                        value="{{ $line->id }}" id="{{ 'box' . (string) $line->id }}" {{ $line->is_completed == 1 ? 'disabled' : '' }} />
                                                    <label for="{{ 'box' . (string) $line->id }}">
                                                        {{ $line->book == null ? 'N/A' : $line->book->name }}</label>
                                                </div>
                                                @if ($line->is_completed == 1)
                                                    <span class="bg-green-200 text-green-800 px-2 py-1 rounded mr-2">
                                                        Returned
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                    @if ($transaction->is_completed == 0)
                                        <div>
                                            <div class="accordion-toggle flex items-center gap-x-2 justify-end">
                                                <x-success-button class="mr-2">
                                                    <i class="fa-solid fa-check" style="color: #63E6BE;"></i>
                                                </x-success-button>
                                            </div>
                                        </div>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div>
                {{ $transactions->links() }}
            </div>
            @if ($transactions->isEmpty())
                <div>
                    <p class="text-center">No transaction found.</p>
                </div>
            @endif

            <x-modal name="add-transaction">
                <form method="post" action="{{ route('transactions.store')}}" class="p-6">
                    @csrf

                    <h2 class="text-lg font-medium text-gray-900">
                        {{ __('Add new transaction') }}
                    </h2>

                    <div class="mt-6">
                        <x-input-label for="reader" :value="__('Reader')" />
                        <select id="reader" name="reader_id" required data-select='{
      "placeholder": "Choose reader",
      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
      "toggleClasses": "advance-select-toggle",
      "hasSearch": true,
      "dropdownClasses": "advance-select-menu max-h-52 pt-0 vertical-scrollbar rounded-scrollbar",
      "dropdownVerticalFixedPlacement": "bottom",
      "dropdownScope": "outside",
      "optionClasses": "advance-select-option selected:active",
      "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] flex-shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
      "extraMarkup": "<span class=\"flex-shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
      }' class="hidden">
                            <option value="">Choose reader</option>
                            @foreach ($readers as $name => $id)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="books" :value="__('Books')" />
                        <select id="books" name="books[]" required multiple data-select='{
      "placeholder": "Choose books",
      "toggleTag": "<button type=\"button\" aria-expanded=\"false\"></button>",
      "toggleClasses": "advance-select-toggle",
      "hasSearch": true,
      "dropdownClasses": "advance-select-menu max-h-52 pt-0 vertical-scrollbar rounded-scrollbar",
      "dropdownVerticalFixedPlacement": "bottom",
      "dropdownScope": "outside",
      "optionClasses": "advance-select-option selected:active",
      "optionTemplate": "<div class=\"flex justify-between items-center w-full\"><span data-title></span><span class=\"icon-[tabler--check] flex-shrink-0 size-4 text-primary hidden selected:block \"></span></div>",
      "extraMarkup": "<span class=\"flex-shrink-0 size-4 text-base-content absolute top-1/2 end-3 -translate-y-1/2 \"></span>"
      }' class="hidden">
                            <option value="">Choose books</option>
                            @foreach ($books as $name => $id)
                                <option value="{{ $id }}">{{ $name }}</option>
                            @endforeach
                        </select>
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