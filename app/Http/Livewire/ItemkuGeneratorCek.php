<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use App\Models\ItemkuOrders;
use App\Models\ProduksItemku;
use Livewire\Component;

class ItemkuGeneratorCek extends Component
{
    public $balance = '';

    public function render()
    {
        $daftar_order = ItemkuOrders::whereNull('player_id')->get();
        foreach ($daftar_order as $order) {
            $id = $order->id;
            $catatan = $order->required_information;
            if (isset(json_decode($catatan)->player_id)) {
                $game_id        = json_decode($catatan)->player_id;
                $server_id      = json_decode($catatan)->player_zone_id;
                $nick           = json_decode($catatan)->username;
                $update_ml      = ['player_id' => $game_id, 'player_server' => $server_id, 'player_nickname' => $nick];
                ItemkuOrders::whereId($id)->update($update_ml);
            }
        }
        return view('livewire.itemku-generator-cek');
    }
}

function get_curl($url)
{

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);

    return  $resp;
}
