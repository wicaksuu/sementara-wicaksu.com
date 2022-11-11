<?php

namespace App\Http\Livewire\Produk;

use App\Models\Store as ModelsStore;
use Livewire\Component;

class Store extends Component
{
    public $store_name, $store_url, $store_username, $store_password, $store_header, $store_auth, $store_metod, $store_data;
    public $isModalOpen = 0;

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
        $this->store_name = '';
        $this->store_url = '';
        $this->store_username = '';
        $this->store_password = '';
        $this->store_header = '';
        $this->store_auth = '';
        $this->store_metod = '';
        $this->store_data = '';
    }

    public function store()
    {
        $this->validate([
            'store_name' => 'required',
            'store_url' => 'required',
        ]);
        try {
            ModelsStore::create([
                'store_name' => $this->store_name,
                'store_url' => $this->store_url,
                'store_username' => $this->store_username,
                'store_password' => $this->store_password,
                'store_header' =>  $this->store_header,
                'store_auth' =>  $this->store_auth,
                'store_metod' =>  $this->store_metod,
                'store_data' =>  $this->store_data,
            ]);
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'success',
                'message' => $this->store_name . ' successfully saved',
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
        return view('livewire.produk.store');
    }
}
