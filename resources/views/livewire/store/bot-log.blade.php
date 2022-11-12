<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Log') }} {{ $itemkuOrder->order_number }}
    </h2>
    <livewire:itemku-get-order />
    <livewire:itemku-generator-cek />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ $itemkuOrder->game_name }} {{ $itemkuOrder->product_name }}
                </h2>
                @livewire('store.bot-log-table',['exportable'=>true,'itemkuOrder'=>$itemkuOrder])
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    setInterval(()=>Livewire.emit('refreshLogId'), 1000);
</script>
@endpush