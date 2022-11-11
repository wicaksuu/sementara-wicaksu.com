<?php

namespace App\Http\Livewire\Store;

use App\Models\StoreVarian;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;

class VarianStoreTable extends LivewireDatatable
{
    public $store;
    public $segment;


    protected $listeners = ['refreshStoreVarian' => 'updatingPerPage'];

    public function builder()
    {
        return StoreVarian::query()
            ->where('store_id', $this->store->id)
            ->join('stores', 'store_varians.store_id', '=', 'stores.id');
    }

    public function columns()
    {
        //
        return [
            Column::name('id')
                ->unsortable()
                ->searchable(),

            Column::name('stores.store_name')
                ->searchable(),

            Column::name('varian_name')
                ->editable()
                ->searchable(),

            Column::name('base_varian_id')
                ->editable()
                ->searchable(),
            Column::name('price')
                ->editable()
                ->searchable(),

            Column::callback(['id', 'varian_name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name,]);
            })->unsortable()
                ->label('Action')
        ];
    }
}
