<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Log') }}
    </h2>
    <livewire:itemku-get-order />
    <livewire:itemku-generator-cek />
</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="py-5 px-5">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-5">
                    {{ __('Log') }}
                </h2>
                @livewire('store.global-bot-log-table',['exportable'=>true])
            </div>
        </div>
    </div>
</div>
@push('scripts')
<script>
    setInterval(()=>Livewire.emit('refreshLogGlobal'), 1000);
</script>
@endpush