<?php

namespace App\Http\Livewire\Produk;

use App\Models\ProduksItemku;
use App\Models\VariansItemku;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class VarianTable extends LivewireDatatable
{
    public function builder()
    {
        return VariansItemku::query()
            ->join('produks_itemkus', 'varians_itemkus.game_id', '=', 'produks_itemkus.game_id')
            ->orderBy('produks_itemkus.game_name', 'DESC');
    }

    public function columns()
    {
        $game_name = array();
        $games = ProduksItemku::all();
        foreach ($games as $game) {
            $game_name[] = $game->game_name;
        }
        return [
            NumberColumn::name('id')
                ->unsortable()
                ->label('ID'),

            Column::name('produks_itemkus.game_name')
                ->searchable()
                ->unsortable()
                ->filterable($game_name),

            Column::name('varian_id')
                ->unsortable()
                ->searchable(),

            Column::name('varian_name')
                ->unsortable()
                ->searchable(),

            Column::name('varian_nominal_value')
                ->unsortable()
                ->searchable(),


            Column::name('price')
                ->unsortable()
                ->editable()
                ->searchable(),

            BooleanColumn::name('varian_is_active')
                ->excludeFromExport()
                ->unsortable(),

            Column::callback(['id', 'varian_name'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name, 'action' => 'addbot-admin']);
            })->unsortable()
                ->excludeFromExport()
                ->label('Action')

        ];
    }
}
