<?php

namespace App\Http\Livewire\Store;

use App\Models\Store;
use App\Models\StoreVarian;
use Livewire\Component;

class Addvarian extends Component
{
    public $varian_name, $base_varian_id, $price, $discount;
    public $isModalOpen = 0;
    public $store;

    public function mount($id)
    {
        $varian = Store::findOrFail($id);
        $this->store = $varian;
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
        $this->varian_name = '';
        $this->base_varian_id = '';
        $this->price = '';
        $this->discount = '';
    }

    public function store()
    {
        $this->validate([
            'varian_name' => 'required',
            'base_varian_id' => 'required',
            'price' => 'required',
            'discount' => 'required',
        ]);
        try {
            StoreVarian::create([
                'store_id' => $this->store->id,
                'varian_name' => $this->varian_name,
                'base_varian_id' => $this->base_varian_id,
                'price' => $this->price,
                'discount' => $this->discount,
            ]);
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'success',
                'message' => $this->varian_name . ' successfully saved',
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
        return view('livewire.store.addvarian');
    }
}
