<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ItemkuLoginCek extends Component
{
    public $balance = '';

    public function render()
    {
        $cookie  =  Auth::user()->cookie;
        $url = "https://tokoku.itemku.com:81/shop/balance";
        $headers = array(
            "Host: tokoku.itemku.com:81",
            "Cookie: $cookie",
            "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.5304.63 Safari/537.36",
            "Content-Type: application/json",
        );

        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($resp, true);
        if (isset($resp['data']['balance'])) {
            $this->balance = $resp['data']['balance'];
        } else {
            $this->balance = 'Mohon Login Ulang';
        }
        return view('livewire.itemku-login-cek');
    }
}
