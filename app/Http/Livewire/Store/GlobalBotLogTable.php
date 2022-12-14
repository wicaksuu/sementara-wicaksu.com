<?php

namespace App\Http\Livewire\Store;

use App\Models\BotLog;
use App\Models\Store;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class GlobalBotLogTable extends LivewireDatatable
{
    protected $listeners = ['refreshLogGlobal' => 'updatingPerPage'];

    public function reload($id)
    {
        $bot_log = BotLog::findOrFail($id);
        $store   = Store::findOrFail($bot_log->store_id);

        // itemku proses
        if ($store->store_auth != '') {
            $headers   = explode('~', $store->store_header);
            $headers[] = "Cookie: " . $store->store_auth;
            $base_url  = $store->store_url;
            $metod     = $store->store_metod;
            $post      = $bot_log->store_data;
            $respons   =  indonesiaGlobal($headers, $base_url, $metod, $post);
            BotLog::findOrFail($id)->update(["response" => $respons]);
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'success',
                'message' => $respons,
            ]);
        } elseif ($store->store_username != '') {
            $token    = login_bpGlobal($store->store_username, $store->store_password);
            $respons  = bp_prosesGlobal($store->store_url, str_replace(' ', '', $bot_log->store_data), $token['token'], $token['uniq']);
            BotLog::findOrFail($id)->update(["response" => $respons]);
            $this->dispatchBrowserEvent('banner-message', [
                'style' => 'success',
                'message' => $respons,
            ]);
        }
    }

    public function builder()
    {
        return BotLog::query()
            ->join('stores', 'bot_logs.store_id', '=', 'stores.id')
            ->join('store_varians', 'bot_logs.store_varian_id', '=', 'store_varians.id')
            ->join('itemku_orders', 'bot_logs.order_id', '=', 'itemku_orders.id');
    }

    public function columns()
    {
        return [
            Column::name('id')
                ->unsortable()
                ->searchable(),

            Column::callback(['id',], function ($id,) {
                return view('table-reload', ['id' => $id, 'name' => 'Reload', 'action' => 'reload-admin', 'not_dell' => true]);
            })->unsortable()
                ->excludeFromExport()
                ->label('reload'),

            Column::name('response')
                ->unsortable()
                ->searchable(),
            Column::name('store_data')
                ->unsortable()
                ->editable()
                ->searchable(),
            Column::name('itemku_orders.product_name')
                ->unsortable()
                ->searchable(),
            Column::name('itemku_orders.required_information')
                ->unsortable()
                ->searchable(),
            Column::name('itemku_orders.order_number')
                ->unsortable()
                ->searchable(),
            Column::name('store_varians.varian_name')
                ->unsortable()
                ->searchable(),
            Column::name('store_varians.base_varian_id')
                ->unsortable()
                ->searchable(),
            Column::name('store_varians.price')
                ->unsortable()
                ->searchable(),
            Column::name('stores.store_name')
                ->unsortable()
                ->searchable(),
            Column::name('stores.store_url')
                ->unsortable()
                ->searchable(),

            DateColumn::name('created_at')->filterable(),
            DateColumn::name('updated_at')->filterable(),
        ];
    }
}

function indonesiaGlobal($headers, $base_url, $metod, $post)
{
    $url = "https://stunting.madiunkab.go.id/indonesia";
    $data = json_encode([
        "key" => 'Jack03061997',
        'headers' => $headers,
        'metod' => $metod,
        'post' => $post,
        'url' => $base_url,
    ]);

    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);

    return  $resp;
}

// bp

function curlGlobal($url,  $cookie, $headers = '', $data = '', $redirect = false)
{
    $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/105.0.5195.102 Safari/537.36";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
    curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    if ($data != '') {
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    }
    if ($redirect == true) {
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    }
    curl_setopt($curl, CURLOPT_ENCODING, '');
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 0);
    curl_setopt($curl, CURLOPT_TIMEOUT, 60);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $resp = curl_exec($curl);
    curl_close($curl);
    return $resp;
}
function get_string_betweenGlobal($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function login_bpGlobal($user_name, $password)
{
    $uniq     = bin2hex(random_bytes(20));
    $token    = curlGlobal('https://bpgamestore.com/login', '../cookie/' . $uniq . '.txt', ['Host: bpgamestore.com']);
    $token    = get_string_betweenGlobal($token, '<input type="hidden" name="_token" value="', '">');
    $data     = "_token=$token&username=" . $user_name . "&password=" . $password;
    $resp     = curlGlobal('https://bpgamestore.com/login', '../cookie/' . $uniq . '.txt', ['Host: bpgamestore.com'], $data);
    $resp     = curlGlobal('https://bpgamestore.com/member', '../cookie/' . $uniq . '.txt', ['Host: bpgamestore.com']);
    $token    = get_string_betweenGlobal($resp, '<meta name="csrf-token" content="', '">');
    return ['token' => $token, 'uniq' => $uniq];
}

function bp_prosesGlobal($url, $post, $token, $uniq)
{
    $headers = array(
        "X-Csrf-Token: $token",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.5304.107 Safari/537.36",
        "Accept: application/json, text/javascript, */*; q=0.01",
        "Origin: https://bpgamestore.com",
    );
    $resp = curlGlobal($url, '../cookie/' . $uniq . '.txt', $headers, $post);
    if (file_exists('../cookie/' . $uniq . '.txt')) {
        unlink('../cookie/' . $uniq . '.txt');
    }
    return $resp;
}
