<?php

namespace App\Http\Livewire\Produk;

use App\Models\VariansItemku;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\BooleanColumn;

class VarianTable extends LivewireDatatable
{
    public function builder()
    {
        return VariansItemku::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

            Column::name('varian_name')
                ->searchable(),

            Column::name('varian_nominal_value')
                ->searchable(),

            BooleanColumn::name('varian_is_active')

        ];
    }
}
