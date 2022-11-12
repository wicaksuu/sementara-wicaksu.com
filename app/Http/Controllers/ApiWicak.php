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
    public function update(Request $request)
    {
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
