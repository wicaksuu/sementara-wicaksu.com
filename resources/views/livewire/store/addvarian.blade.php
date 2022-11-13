<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add Varian Store') }}
    </h2>
    <livewire:itemku-get-order />
    <livewire:itemku-generator-cek />
</x-slot>
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ __(' Varian') }}
                    <x-jet-success-button wire:click="create" class="px-2">
                        Add Varian {{ $store->store_name }}
                    </x-jet-success-button>
                </h2>
                <x-jet-dialog-modal wire:model="isModalOpen" class="flex items-center">
                    <x-slot name="title">
                        {{ __('Add Store') }}
                    </x-slot>

                    <x-slot name="content">
                        <div class="mt-2">
                            <x-jet-label for="varian_name" value="{{ __('Varian Name') }}" />
                            <x-jet-input id="varian_name" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="varian_name" autofocus x-ref="varian_name"
                                autocomplete="one-time-varian_name" />
                            <x-jet-input-error for="varian_name" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="base_varian_id" value="{{ __('Base Varian Id') }}" />
                            <x-jet-input id="base_varian_id" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="base_varian_id" autofocus x-ref="base_varian_id"
                                autocomplete="one-time-base_varian_id" />
                            <x-jet-input-error for="base_varian_id" class="mt-2" />
                        </div>

                        <div class="mt-2">
                            <x-jet-label for="price" value="{{ __('Price') }}" />
                            <x-jet-input id="price" class="block mt-1 w-full" type="text" inputmode="number"
                                wire:model="price" autofocus x-ref="price" autocomplete="one-time-price" />
                            <x-jet-input-error for="price" class="mt-2" />
                        </div>
                        <div class="mt-2">
                            <x-jet-label for="discount" value="{{ __('Discount') }}" />
                            <x-jet-input id="discount" class="block mt-1 w-full" type="text" inputmode="text"
                                wire:model="discount" autofocus x-ref="discount" autocomplete="one-time-discount" />
                            <x-jet-input-error for="discount" class="mt-2" />
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

                @livewire('store.varian-store-table',['exportable'=>true,'store'=>$store])
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    setInterval(()=>Livewire.emit('refreshStoreVarian'), 2000);
</script>



@endpush