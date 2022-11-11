<?php

namespace App\Http\Livewire\Produk;

use App\Models\BotLogic;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;

class BotLogicTable extends LivewireDatatable
{
    public $varian;
    protected $listeners = ['refreshLogic' => 'updatingPerPage'];

    public function builder()
    {
        return BotLogic::query()
            ->join('store_varians', 'bot_logics.store_varian_id', '=', 'store_varians.id')
            ->join('stores', 'store_varians.store_id', '=', 'stores.id')
            ->where('varian_id', $this->varian->varian_id);
    }

    public function columns()
    {
        return [
            Column::name('id')
                ->unsortable()
                ->searchable(),
            Column::name('stores.store_name')
                ->unsortable()
                ->searchable(),
            Column::name('store_varians.varian_name')
                ->unsortable()
                ->searchable(),
            Column::name('store_varians.price')
                ->unsortable()
                ->searchable(),

            Column::callback(['id', 'store_varians.varian_name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name,]);
            })->unsortable()
                ->label('Action')
        ];
    }
}
