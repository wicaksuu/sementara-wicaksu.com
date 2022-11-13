<?php

namespace App\Http\Livewire\Produk;

use App\Models\ItemkuOrders;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use App\Models\ProduksItemku;


class ItemkuOrdersDoneTable extends LivewireDatatable
{

    protected $listeners = ['refreshdone' => 'updatingPerPage'];
    public function builder()
    {
        if (Auth::user()->role == 'admin') {
            return ItemkuOrders::query()
                // ->where('user_id', Auth::user()->id)
                ->whereNotNull('modal');
            // ->join('users', 'itemku_orders.user_id', '=', 'users.id');
        } elseif ((Auth::user()->role == 'wickasu')) {
            return ItemkuOrders::query()
                ->join('users', 'itemku_orders.user_id', '=', 'users.id');
        }
    }

    public function columns()
    {
        $game_name = array();
        $games = ProduksItemku::all();
        foreach ($games as $game) {
            $game_name[] = $game->game_name;
        }
        return [

            Column::callback(['id', 'order_number'], function ($id, $name) {
                return view('table-actions', ['id' => $id, 'name' => $name, 'action' => 'bot-log-admin', 'not_dell' => true]);
            })->unsortable()
                ->excludeFromExport()
                ->label('Log'),

            // Column::name('users.name')
            //     ->unsortable(),

            Column::name('game_name')
                ->unsortable()
                ->filterable($game_name)
                ->searchable(),

            Column::name('status')
                ->unsortable()
                ->searchable(),

            Column::name('order_number')
                ->unsortable()
                ->searchable(),

            Column::name('product_name')
                ->unsortable()
                ->searchable(),
            Column::name('player_id')
                ->unsortable()
                ->searchable(),

            Column::name('player_server')
                ->unsortable()
                ->searchable(),

            Column::name('player_nickname')
                ->unsortable()
                ->searchable(),

            Column::name('buyer_name')
                ->unsortable(),

            Column::name('quantity')
                ->unsortable()
                ->label('Qty'),

            Column::name('profit')
                ->unsortable()
                ->label('profit'),

            Column::name('required_information')
                ->unsortable()
                ->label('Catatan')
                ->searchable(),

            DateColumn::name('created_at')->filterable(),
            DateColumn::name('updated_at')->filterable(),


        ];
    }
}
