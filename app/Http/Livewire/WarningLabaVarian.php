<?php

namespace App\Http\Livewire;

use App\Models\BotLogic;
use App\Models\StoreVarian;
use Livewire\Component;

class WarningLabaVarian extends Component
{
    public $laba_rugi, $modal, $harga_jual;
    public $varian;

    public function render()
    {
        $modals = 0;
        $harga_asli = $this->varian->price;
        $harga_jual = $this->varian->price * 0.95;
        $logic = BotLogic::where('varian_id', $this->varian->varian_id)
            ->get();
        foreach ($logic as $value) {
            $modal = StoreVarian::where('id', $value->store_varian_id)->first();

            if ($modal != '') {
                $modals = $modals + $modal->price;
            }
        }
        $laba_rugi = $harga_jual - $modals;

        $this->harga_jual = '<div class="flex sm:inline-flex justify-center items-center px-5 py-2 leading-4 font-medium text-white bg-indigo-500 font-semibold text-center">Harga Jual ' . rupiah($harga_asli) . '/' . rupiah($harga_jual) . '</div>';

        $this->modal      = '<div class="flex sm:inline-flex justify-center items-center px-5 py-2 leading-4 font-medium text-white bg-indigo-500 font-semibold text-center">Modal : ' . rupiah($modals) . '</div>';

        if ($laba_rugi > 0) {
            $this->laba_rugi  = '<div class="flex sm:inline-flex justify-center items-center px-5 py-2 leading-4 font-medium text-white bg-indigo-500 font-semibold text-center">Laba : ' . rupiah($laba_rugi) . '</div>';
        } else {
            $this->laba_rugi  = '<div class="flex sm:inline-flex justify-center items-center px-5 py-2 leading-4 font-medium text-white bg-red-500 font-semibold text-center">Rugi : ' . rupiah($laba_rugi) . '</div>';
        }


        return view('livewire.warning-laba-varian');
    }
}
