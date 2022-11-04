<?php

namespace App\Http\Livewire\Produk;

use App\Models\ProduksItemku;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class GameTable extends LivewireDatatable
{
    public function builder()
    {
        return ProduksItemku::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

            Column::name('game_name')
                ->searchable(),

            Column::name('game_slug')
                ->searchable(),
            BooleanColumn::name('game_is_active')


        ];
    }
}
