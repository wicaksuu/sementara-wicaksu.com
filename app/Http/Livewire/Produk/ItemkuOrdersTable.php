<?php

namespace App\Http\Livewire\Produk;

use App\Models\ItemkuOrders;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;

class ItemkuOrdersTable extends LivewireDatatable
{

    protected $listeners = ['refresh' => 'updatingPerPage'];
    public function builder()
    {

        if (Auth::user()->role == 'admin') {
            return ItemkuOrders::query()
                ->orderBy('id', 'DESC')
                ->where('user_id', Auth::user()->id)
                ->where('modal', null)
                ->join('users', 'itemku_orders.user_id', '=', 'users.id');
        } elseif ((Auth::user()->role == 'wicaksu')) {
            return ItemkuOrders::query()
                ->orderBy('id', 'DESC')
                ->join('users', 'itemku_orders.user_id', '=', 'users.id');
        }
    }

    public function columns()
    {
        return [

            Column::name('id')
                ->unsortable()
                ->searchable(),

            Column::name('game_name')
                ->unsortable()
                ->searchable(),

            Column::name('users.name')
                ->unsortable(),

            // Column::name('modal')
            //     ->unsortable()
            //     ->editable(),

            Column::name('product_name')
                ->unsortable()
                ->searchable(),

            Column::name('player_id')
                ->unsortable()
                ->searchable()
                ->editable(),

            Column::name('player_server')
                ->unsortable()
                ->searchable()
                ->editable(),


            Column::name('player_nickname')
                ->unsortable()
                ->searchable(),



            Column::name('required_information')
                ->unsortable()
                ->label('Catatan')
                ->searchable(),

            Column::name('order_number')
                ->unsortable()
                ->searchable(),

            Column::name('buyer_name')
                ->unsortable(),

            Column::name('quantity')
                ->unsortable()
                ->label('Qty'),

            Column::name('seller_income')
                ->unsortable()
                ->label('Bruto'),



        ];
    }
}
