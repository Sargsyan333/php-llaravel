<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Pakkelabels\Pakkelabels;
use Arr;


class PakkelabelsController extends Controller
{
    private $client;

    public function __construct()
    {
        $api_user = env('PAKKELABELS_API_USER');
        $api_key = env('PAKKELABELS_API_KEY');

        $this->client = new Pakkelabels($api_user, $api_key);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
         $products = $this->client->products([]);

         return response()->json(['data' => $products]);
    }

    public function getOrders()
    {
        $orders = $this->client->sales_orders([]);

        return response()->json([ "data" => $orders ]);
    }

    /**
     * Create Order
     */
    public function createOrder()
    {
        $config = request()->all();
        $data = str_replace("\n","", \App\Pakkelabels::pakkelabelsSettings($config));
        $dataArray = json_decode($data,true);
        $orders = $this->client->sales_orders_post($dataArray);

        return response()->json([ "data" => $orders ]);
    }

    public function salesOrders()
    {
        $salesOrders = $this->client->sales_orders([]);

        return response()->json([ 'data' => $salesOrders ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function shipmentTemplates()
    {
        $shipment_templates = $this->client->shipment_templates([]);

        return response()->json(['data' => $shipment_templates]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function shipments()
    {
        $shipments = $this->client->shipments([]);

        return response()->json(['data' => $shipments]);
    }


    public function shipmentsCreate()
    {
        $dataRequest = request()->all();

        $data = $this->shipmentDataCombine($dataRequest);

//        return response()->json(['data' => $data]);



//        $testData = '{
//          "test_mode": true,
//          "own_agreement": false,
//          "label_format": null,
//          "product_code": "PDK_DPDC",
//          "service_codes": "EMAIL_NT,SMS_NT",
//          "automatic_select_service_point": true,
//          "sender": {
//            "name": "Min Virksomhed ApS",
//            "attention": "Lene Hansen",
//            "address1": "Strandvejen 6",
//            "address2": null,
//            "zipcode": "5240",
//            "city": "Odense NØ",
//            "country_code": "DK",
//            "email": "info@minvirksomhed.dk",
//            "mobile": "70400407",
//            "telephone": "70400407"
//          },
//          "receiver": {
//            "name": "Lene Hansen",
//            "attention": null,
//            "address1": "Skibhusvej 52",
//            "address2": null,
//            "zipcode": "5000",
//            "city": "Odense C",
//            "country_code": "DK",
//            "email": "lene@email.dk",
//            "mobile": "12345678",
//            "telephone": "12345678",
//            "instruction": null
//          },
//          "parcels": [
//            {
//              "weight": 1000
//            }
//          ],
//          "print": false,
//          "print_at": {
//            "host_name": "WAREHOUSE-PC",
//            "printer_name": "Zebra Zdesigner GK420D",
//            "label_format": "zpl"
//          },
//          "replace_http_status_code": false,
//          "reference": "Order 10001"
//        }';


        $shipments = $this->client->create_shipment($data);

        return response()->json(['data' => $shipments]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function shipment($id)
    {
        $shipment = $this->client->shipment($id,[]);

        return response()->json(['data' => $shipment]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function shipmentLabels($id)
    {
        $shipmentLabels = $this->client->shipment_labels($id,[]);

        return response()->json(['data' => $shipmentLabels]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function proformaInvoices($id)
    {
        $shipmentInvoices = $this->client->shipment_proforma_invoices($id,[]);

        return response()->json(['data' => $shipmentInvoices]);
    }

    /**
     * @param $request
     * @return array
     */
    public function shipmentDataCombine($request)
    {
        return Arr::collapse([
                $this->shipmentCredentials($request),
                $this->senderCredentials(),
                $this->receiverCredentials($request['order_id']),
                $this->otherCredentials($request)
            ]);
    }

    /**
     * @return array
     */
    public function senderCredentials()
    {
         return [
             "sender" => [
                "name" => config('services.pakkelabels.name'),
                "attention" => config('services.pakkelabels.attention'),
                "address1" => config('services.pakkelabels.address1'),
                "address2" => config('services.pakkelabels.address2'),
                "zipcode" => config('services.pakkelabels.zipcode'),
                "city" => config('services.pakkelabels.city'),
                "country_code" => config('services.pakkelabels.country_code'),
                "email" => config('services.pakkelabels.email'),
                "mobile" => config('services.pakkelabels.mobile'),
                "telephone" => config('services.pakkelabels.telephone'),
             ]
         ];
    }

    /**
     * @param $orderId
     * @return array
     */
    public function receiverCredentials($orderId)
    {
//        $order = Order::find($orderId);

        return [
            "receiver" => [
                "name" => 'Lene Hansen',//$order->user->name,
                "attention" => null,
                "address1" => 'Skibhusvej 52',//$order->address,
                "address2" => null,
                "zipcode" => "5000",
                "city" =>  "Odense C",
                "country_code" => 'DK',
                "email" => 'lene@email.dk',//$order->email,
                "mobile" => "12345678",// $order->mobile,
                "telephone" => "12345678", //$order->mobile,
                "instruction" => null
            ]
        ];
    }

    /**
     * @param $request
     * @return array
     */
    public function shipmentCredentials($request)
    {
        return [
            "test_mode" => true,
            "own_agreement" => ($request['own_agreement']) ?? false,
            "label_format" => ($request['label_format']) ?? null,
            "product_code" => ($request['product_code']) ?? "PDK_DPDC",
            "service_codes" => ($request['service_codes']) ?? "EMAIL_NT,SMS_NT",
            "automatic_select_service_point" => ($request['automatic_select_service_point']) ?? true,
        ];
    }

    public function otherCredentials($request)
    {
        return [
            "parcels" => [
                [
                    "weight" => 1000
                ]
            ],
            "print" => ($request['automatic_select_service_point']) ?? false,
            "print_at" => [
                "host_name" => "WAREHOUSE-PC",
                "printer_name" => "Zebra Zdesigner GK420D",
                "label_format" => "zpl",
            ],
            "replace_http_status_code" => false,
            "reference" => "Order ".$request['order_id']
        ];
    }
}
