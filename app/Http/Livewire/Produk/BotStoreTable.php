<?php

namespace App\Http\Livewire\Produk;

use App\Models\Store;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;

class BotStoreTable extends LivewireDatatable
{

    protected $listeners = ['refreshStore' => 'updatingPerPage'];
    public function builder()
    {
        return Store::query();
    }

    public function columns()
    {

        return [
            Column::name('id')
                ->unsortable()
                ->searchable(),
            Column::callback(['id', 'store_name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name, 'action' => 'addstore-varian-admin']);
            })->unsortable()
                ->label('Action'),
            Column::name('store_name')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_url')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_metod')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_data')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_username')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_password')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_header')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('store_auth')
                ->unsortable()
                ->editable()
                ->searchable(),
        ];
    }
}
