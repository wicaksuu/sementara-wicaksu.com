<?php

namespace App\Http\Controllers;

use App\Models\BotLogic;
use App\Models\ItemkuOrders;
use App\Models\Store;
use App\Models\StoreVarian;
use Illuminate\Http\Request;

class ApiOrderController extends Controller
{
    public function getorder(Request $request)
    {
        $request = $request->all();

        if (!isset($request['key'])) {

            return response()->json([
                'status' => false,
                'message' => 'key is mising',
            ]);
        }

        if ($request['key'] == md5('Wickasu03061997')) {
            $data = ItemkuOrders::whereNull('modal')
                ->whereNotNull('player_id')
                ->get();

            $save = array();
            foreach ($data as $item) {
                $logic_bot = BotLogic::where('varian_id', $item->product_id)->get();
                if (count($logic_bot) != 0) {
                    $bot = array();
                    $modal = 0;
                    foreach ($logic_bot as $raw) {
                        for ($i = 0; $i < $item->quantity; $i++) {
                            $store_varian = StoreVarian::where('id', $raw->store_varian_id)->first();
                            if ($store_varian != '') {
                                if ($store_varian->discount != '') {
                                    $dc = floor($store_varian->discount * $store_varian->price / 100);
                                } else {
                                    $dc = '';
                                }
                                $store        = Store::where('id', $store_varian->store_id)->first();
                                $modal       = $modal + $store_varian->price;
                                $bot[] = [
                                    'id' => $store_varian->id,
                                    'store_id' => $store_varian->store_id,
                                    'varian_name' => $store_varian->varian_name,
                                    'base_varian_id' => $store_varian->base_varian_id,
                                    'price' => $store_varian->price,
                                    'varian_id' => $raw->varian_id,
                                    'game_id' => $raw->game_id,
                                    'store_name' => $store->store_name,
                                    'store_url' => $store->store_url,
                                    'store_metod' => $store->store_metod,
                                    'store_header' => $store->store_header,
                                    'store_data' => str_replace('$discount',$dc,str_replace('$server_id', $item->player_server, str_replace('$player_id', $item->player_id, str_replace('$product_id', $store_varian->base_varian_id, str_replace('$price', $store_varian->price, $store->store_data))))),
                                    'store_auth' => $store->store_auth,
                                    'store_username' => $store->store_username,
                                    'store_password' => $store->store_password,
                                ];
                            }
                        }
                    }
                    $income = $item->seller_income - $modal;
                    $save[] = [
                        'id' => $item->id,
                        "order" => $item,
                        'bot_logic' => $bot,
                        'income' => $income
                    ];
                    ItemkuOrders::find($item->id)->update(['modal' => $modal, 'profit' => $income]);
                }
            }
            return response()->json([
                'status' => true,
                'data' => $save,
                'total' => count($save)
            ]);
        }
    }
}
