<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Add Bot Logic') }}
    </h2>
    <livewire:itemku-get-order />
    <livewire:itemku-generator-cek />
</x-slot>
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ __(' Produk') }} {{ $game->game_name }} / {{ $varian->varian_name }}
                    <x-jet-success-button wire:click="create" class="px-2">
                        Add Logic
                    </x-jet-success-button>

                    <x-jet-dialog-modal wire:model="isModalOpen" class="flex items-center">
                        <x-slot name="title">
                            {{ __('Add Logic') }}
                        </x-slot>

                        <x-slot name="content">
                            <div class="mt-2">
                                <x-jet-label for="store_varian_id" value="{{ __('Store Name') }}" />
                                <select id="store_varian_id" class="block mt-1 w-full" name="store_varian_id"
                                    wire:model="store_varian_id" autofocus x-ref="store_varian_id"
                                    autocomplete="one-time-store_varian_id">
                                    <option>Pilih Varian</option>
                                    @foreach ($store as $stores)
                                    <option value="{{ $stores->id }}">{{ $stores->varian_name }}</option>
                                    @endforeach
                                </select>
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

                </h2>

                @livewire('warning-laba-varian',['varian'=>$varian])

                @livewire('produk.bot-logic-table',['exportable'=>true,'varian'=>$varian])
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    setInterval(()=>Livewire.emit('refreshLogic'), 1000);
</script>
@endpush