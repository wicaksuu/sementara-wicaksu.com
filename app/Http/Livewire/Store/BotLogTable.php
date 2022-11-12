<?php

namespace App\Http\Livewire\Store;

use App\Models\BotLog;
use App\Models\Store;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;

class BotLogTable extends LivewireDatatable
{
    public $itemkuOrder;
    protected $listeners = ['refreshLogId' => 'updatingPerPage'];

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
            ->join('itemku_orders', 'bot_logs.order_id', '=', 'itemku_orders.id')
            ->where('bot_logs.order_id', $this->itemkuOrder->id);
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
