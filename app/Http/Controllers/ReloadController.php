<?php

namespace App\Http\Controllers;

use App\Models\BotLog;
use App\Models\Store;
use Illuminate\Http\Request;

class ReloadController extends Controller
{
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
            $respons   =  indonesia($headers, $base_url, $metod, $post);
            BotLog::findOrFail($id)->update(["response" => $respons]);
        }
        return;
    }
}

function indonesia($headers, $base_url, $metod, $post)
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
