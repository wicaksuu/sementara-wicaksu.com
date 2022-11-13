<?php

namespace App\Http\Controllers;

use App\Models\ProduksItemku;
use App\Models\Store;
use App\Models\VariansItemku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;
use App\Models\BotLog;

class ApiWicak extends Controller
{
    //
    public function bp(Request $request)
    {
        $request = $request->all();
        if ($request['key'] == md5('Wickasu03061997')) {
            $token    = login_bpApi($request['username'], $request['password']);
            $respons  = bp_prosesApi($request['store_url'], str_replace(' ', '', $request['store_data']), $token['token'], $token['uniq']);
            return $respons;
        }
    }
    public function update(Request $request)
    {
        $request = $request->all();
        if ($request['key'] == md5('Wickasu03061997')) {
            foreach ($request['data'] as $val) {
                BotLog::create($val);
            }
            return response()->json([
                'status' => true,
                'data' => '',
            ]);
        }
    }
    public function ApiWicak(Request $request)
    {
        $request = $request->all();

        if (!isset($request['key'])) {

            return response()->json([
                'status' => false,
                'message' => 'key is mising',
            ]);
        }

        if ($request['key'] == md5('Wickasu03061997')) {
            if ($request['store_id']) {
                $auth = Store::findOrFail($request['store_id']);
                return response()->json([
                    'status' => false,
                    'data' => $auth,
                ]);
            }
        }
    }
    public function getcookie(Request $request)
    {
        $request = $request->all();

        if (!isset($request['key'])) {

            return response()->json([
                'status' => false,
                'message' => 'key is mising',
            ]);
        }

        if ($request['key'] == md5('Wickasu03061997')) {
            if ($request['store_id']) {
                $auth = Store::findOrFail($request['store_id']);
                return response()->json([
                    'status' => false,
                    'data' => $auth,
                ]);
            }
        }
    }
    public function reset(Request $request)
    {
        $request = $request->all();

        if (!isset($request['key'])) {

            return response()->json([
                'status' => false,
                'message' => 'key is mising',
            ]);
        }

        if ($request['key'] == md5('Wickasu03061997')) {
            try {
                $produk_destroy = ProduksItemku::get();
                $varian_destroy = VariansItemku::get();
                foreach ($produk_destroy as $produks) {
                    ProduksItemku::where('id', $produks->id)->delete();
                }
                foreach ($varian_destroy as $varians) {
                    VariansItemku::where('id', $varians->id)->delete();
                }
                return response()->json([
                    'status' => true,
                    'message' => 'success',
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ]);
            }
        }
    }
    public function addProducts(Request $request)
    {
        $request = $request->all();

        if (!isset($request['key'])) {

            return response()->json([
                'status' => false,
                'message' => 'key is mising',
            ]);
        }

        if ($request['key'] == md5('Wickasu03061997')) {
            try {
                ProduksItemku::create($request);
                return response()->json([
                    'status' => true,
                    'message' => 'success',
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'key is false',
            ]);
        }
    }
    public function addvarians(Request $request)
    {
        $request = $request->all();

        if (!isset($request['key'])) {

            return response()->json([
                'status' => false,
                'message' => 'key is mising',
            ]);
        }

        if ($request['key'] == md5('Wickasu03061997')) {
            try {
                VariansItemku::create($request);
                return response()->json([
                    'status' => true,
                    'message' => 'success',
                ]);
            } catch (\Throwable $th) {
                return response()->json([
                    'status' => false,
                    'message' => $th->getMessage(),
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'key is false',
            ]);
        }
    }
}

// bp

function curlApi($url,  $cookie, $headers = '', $data = '', $redirect = false)
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
function get_string_betweenApi($string, $start, $end)
{
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}
function login_bpApi($user_name, $password)
{
    $uniq     = bin2hex(random_bytes(20));
    $token    = curlApi('https://bpgamestore.com/login', '../cookie/' . $uniq . '.txt', ['Host: bpgamestore.com']);
    $token    = get_string_betweenApi($token, '<input type="hidden" name="_token" value="', '">');
    $data     = "_token=$token&username=" . $user_name . "&password=" . $password;
    $resp     = curlApi('https://bpgamestore.com/login', '../cookie/' . $uniq . '.txt', ['Host: bpgamestore.com'], $data);
    $resp     = curlApi('https://bpgamestore.com/member', '../cookie/' . $uniq . '.txt', ['Host: bpgamestore.com']);
    $token    = get_string_betweenApi($resp, '<meta name="csrf-token" content="', '">');
    return ['token' => $token, 'uniq' => $uniq];
}

function bp_prosesApi($url, $post, $token, $uniq)
{
    $headers = array(
        "X-Csrf-Token: $token",
        "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.5304.107 Safari/537.36",
        "Accept: application/json, text/javascript, */*; q=0.01",
        "Origin: https://bpgamestore.com",
    );
    $resp = curlApi($url, '../cookie/' . $uniq . '.txt', $headers, $post);
    if (file_exists('../cookie/' . $uniq . '.txt')) {
        unlink('../cookie/' . $uniq . '.txt');
    }
    return $resp;
}
