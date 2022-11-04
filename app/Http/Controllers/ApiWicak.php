<?php

namespace App\Http\Controllers;

use App\Models\ProduksItemku;
use App\Models\VariansItemku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Artisan;

class ApiWicak extends Controller
{
    //
    function addProducts(Request $request)
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
    function addvarians(Request $request)
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
