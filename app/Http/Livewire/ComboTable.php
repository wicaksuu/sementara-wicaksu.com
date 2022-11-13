<?php

namespace App\Http\Livewire;

use App\Models\BotLogic;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use App\Models\ProduksItemku;
use App\Models\VariansItemku;

class ComboTable extends LivewireDatatable
{
    protected $listeners = ['refreshcombo' => 'updatingPerPage'];
    public function builder()
    {
        return BotLogic::query()
            ->join('store_varians', 'bot_logics.store_varian_id', '=', 'store_varians.id')
            ->join('stores', 'store_varians.store_id', '=', 'stores.id')
            ->join('varians_itemkus', 'bot_logics.varian_id', '=', 'varians_itemkus.varian_id')
            ->join('produks_itemkus', 'bot_logics.game_id', '=', 'produks_itemkus.game_id');
    }

    public function columns()
    {
        $game_name   = array();
        $varian_name = array();
        $games   = ProduksItemku::all();
        $varians = VariansItemku::orderBy('varian_name', 'ASC')->get();
        foreach ($games as $game) {
            $game_name[] = $game->game_name;
        }
        foreach ($varians as $varian) {
            $varian_name[] = $varian->varian_name;
        }

        return [
            Column::name('id')
                ->unsortable()
                ->searchable(),

            Column::name('produks_itemkus.game_name')
                ->unsortable()
                ->filterable($game_name)
                ->searchable(),

            Column::name('varians_itemkus.varian_name')
                ->unsortable()
                ->filterable($varian_name)
                ->searchable(),

            Column::name('store_varians.varian_name')
                ->unsortable()
                ->searchable(),

            Column::name('stores.store_name')
                ->unsortable()
                ->searchable(),

            DateColumn::name('created_at')->filterable(),

        ];
    }
}
