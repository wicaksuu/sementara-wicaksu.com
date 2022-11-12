<?php

namespace App\Http\Livewire\Store;

use App\Models\BotLog as ModelsBotLog;
use App\Models\ItemkuOrders;
use Livewire\Component;
use App\Models\Store;

class BotLog extends Component
{
    public $itemkuOrder;

    public function mount($id)
    {
        $itemkuOrder = ItemkuOrders::findOrFail($id);
        $this->itemkuOrder = $itemkuOrder;
    }


    public function render()
    {
        return view('livewire.store.bot-log');
    }
}
