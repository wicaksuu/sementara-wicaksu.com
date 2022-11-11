<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Store Bot') }}

    </h2>
</x-slot>
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ __(' Store') }}
                    <x-jet-success-button wire:click="create" class="px-2">
                        Add Store
                    </x-jet-success-button>
                </h2>
                <x-jet-dialog-modal wire:model="isModalOpen" class="flex items-center">
                    <x-slot name="title">
                        {{ __('Add Store') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="mt-2">
                            <x-jet-label for="store_name" value="{{ __('Store Name') }}" />
                            <x-jet-input id="store_name" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="store_name" autofocus x-ref="store_name"
                                autocomplete="one-time-store_name" />
                            <x-jet-input-error for="store_name" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-jet-label for="store_url" value="{{ __('Store URL') }}" />
                            <x-jet-input id="store_url" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="store_url" autofocus x-ref="store_url" autocomplete="one-time-store_url" />
                            <x-jet-input-error for="store_url" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="store_metod" value="{{ __('Store Metod') }}" />
                            <x-jet-input id="store_metod" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="store_metod" autofocus x-ref="store_metod"
                                autocomplete="one-time-store_metod" />
                            <x-jet-input-error for="store_metod" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="store_data" value="{{ __('Store Data') }}" />
                            <textarea wire:model="store_data" id="store_data" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Data ..."></textarea>
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="store_username" value="{{ __('Store User Name') }}" />
                            <x-jet-input id="store_username" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="store_username" autofocus x-ref="store_username"
                                autocomplete="one-time-store_username" />
                            <x-jet-input-error for="store_username" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="store_password" value="{{ __('Store Password') }}" />
                            <x-jet-input id="store_password" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="store_password" autofocus x-ref="store_password"
                                autocomplete="one-time-store_password" />
                            <x-jet-input-error for="store_password" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="store_header" value="{{ __('Header') }}" />
                            <textarea wire:model="store_header" id="store_header" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Header ..."></textarea>
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="store_auth" value="{{ __('Store Auth (cookie)') }}" />
                            <textarea wire:model="store_auth" id="store_auth" rows="4"
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Cookie ..."></textarea>
                        </div>
                    </x-slot>

                    <x-slot name="footer">
                        <x-jet-danger-button wire:click="closeModalPopover" wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-jet-danger-button>

                        <x-jet-success-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
                            {{ __('Save') }}
                        </x-jet-success-button>
                    </x-slot>
                </x-jet-dialog-modal>


                <livewire:produk.bot-store-table hideable="select" exportable>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    setInterval(()=>Livewire.emit('refreshStore'), 1000);
</script>



@endpush