<?php

namespace App\Http\Livewire;

use App\Models\ItemkuOrders;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class ItemkuGetOrder extends Component
{
    public $order = 0;
    public $income = 0;


    public function render()
    {
        $orders = ItemkuOrders::where('user_id', Auth::user()->id)->whereNotNull('modal')->where('profit', null)->get();

        foreach ($orders as $value) {
            $modals = $value->modal * $value->quantity;
            $profit =  $value->seller_income - $modals;
            ItemkuOrders::whereId($value->id)->update(['profit' => $profit]);
        }
        $cookie  =  Auth::user()->cookie;
        if ($cookie != '') {
            $headers = array(
                "Host: tokoku.itemku.com:81",
                "Cookie: $cookie",
                "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/107.0.5304.63 Safari/537.36",
                "Content-Type: application/json",
            );
            $resp = get_order($headers);
            $resp = json_decode($resp, true);
            if (isset($resp['data']['total_item'])) {
                foreach ($resp['data']['data'] as $item) {
                    $cek = ItemkuOrders::where('transaction_id', $item['transaction_id'])->first();
                    if ($cek == '') {
                        $delivery = delivery_order($headers, $item['id']);
                        $item['user_id']  = Auth::user()->id;
                        $item['order_id'] = $item['id'];
                        $item['resp_delivery'] = $delivery;
                        ItemkuOrders::create($item);
                        $name = Auth::user()->name;
                        $message = "[Orderan Baru]\n\nNama Admin : $name\nOrder Number :" . $item['order_number'] . "\nGame : " . $item['game_name'] . "\nVarian : " . $item['product_name'] . "\nCatatan : " . $item['required_information'] . "\nQty: " . $item['quantity'] . "\nIncome: " . rupiah($item['seller_income']) . "\n\n--wicaksu--";
                        telegram($message);
                    }
                }
                $this->order = "Total Order Pending : " . $resp['data']['total_item'];
            } else {
                $this->order = 'Mohon Login Ulang';
            }
        } else {
            $this->order = 'Mohon Login Ulang';
        }
        return view('livewire.itemku-get-order');
    }
}

function rupiah($angka)
{

    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}

function get_order($headers)
{
    $url = "https://stunting.madiunkab.go.id/indonesia";
    $data = json_encode([
        "key" => 'Jack03061997',
        'headers' => $headers,
        'metod' => 'get',
        'post' => '',
        'url' => 'https://tokoku.itemku.com:81/order-history?status=2&page=1&sort=latest&include_order_seller=1&include_order_info=1&search_type=order_number',
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

function delivery_order($headers, $order_id)
{

    $url = "https://stunting.madiunkab.go.id/indonesia";
    $data = json_encode([
        "key" => 'Jack03061997',
        'headers' => $headers,
        'metod' => 'post',
        'post' => '{"order_id":"' . $order_id . '"}',
        'url' => 'https://tokoku.itemku.com:81/order-history/deliver',
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
    return $resp;
}

function telegram($message)
{
    $TOKEN = "1240654937:AAHuoyXeFjhqddS3Ie1OwhanLzzHDulhdEY";
    $apiURL = "https://api.telegram.org/bot$TOKEN";
    $url = "$apiURL/sendmessage?chat_id=-753121471&text=" . urlencode($message);
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $resp = curl_exec($curl);
    curl_close($curl);
}
