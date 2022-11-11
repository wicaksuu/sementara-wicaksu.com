<?php

namespace App\Http\Livewire\Produk;

use App\Models\BotLogic;
use App\Models\ProduksItemku;
use App\Models\Store;
use App\Models\StoreVarian;
use App\Models\VariansItemku;
use Illuminate\Http\Request;
use Livewire\Component;

class Addbot extends Component
{
    public $data, $game;
    public $store_varian_id;
    public $isModalOpen = 0;


    public function mount($id)
    {
        $varian = VariansItemku::findOrFail($id);
        $game   = ProduksItemku::where('game_id', $varian->game_id)->first();
        $store  = StoreVarian::get();
        $this->varian = $varian;
        $this->game = $game;
        $this->store = $store;
    }


    public function create()
    {
        $this->resetCreateForm();
        $this->openModalPopover();
    }
    public function openModalPopover()
    {
        $this->isModalOpen = true;
    }
    public function closeModalPopover()
    {
        $this->isModalOpen = false;
    }
    private function resetCreateForm()
    {
        $this->store_varian_id = '';
    }

    public function store()
    {

        $this->validate([
            'store_varian_id' => 'required',
        ]);
        try {
            BotLogic::create([
                'varian_id' => $this->varian->varian_id,
                'game_id' => $this->game->game_id,
                'store_varian_id' => intval($this->store_varian_id),
            ]);
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'success',
                'message' => $this->varian->varian_name . ' successfully saved',
            ]);
        } catch (\Throwable $th) {
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'danger',
                'message' => $th->getMessage(),
            ]);
        }

        $this->closeModalPopover();
    }



    public function render()
    {
        return view('livewire.produk.addbot');
    }
}
