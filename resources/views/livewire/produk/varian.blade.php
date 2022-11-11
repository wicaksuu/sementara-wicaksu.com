<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Produk') }}
    </h2>
</x-slot>
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ __('Daftar Varian') }}
                </h2>
                <livewire:produk.varian-table hideable="select" exportable>
            </div>
        </div>
    </div>
</div>
<div class="py-5">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ __('Daftar Produk') }}
                </h2>
                <livewire:produk.game-table hideable="select" exportable>
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    // setInterval(()=>Livewire.emit('refresh'), 1000);
    // setInterval(()=>Livewire.emit('refreshdone'), 1000);
</script>
@endpush