<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Pakkelabels extends Model
{
    /**
     * @param Http\Controllers\Pakkelabels\Pakkelabels $client
     * @param array $config
     * @return array|bool|mixed|string
     */
    public static function createPakkelabelsOrder(\App\Http\Controllers\Pakkelabels\Pakkelabels $client,$order,$dataPharmacy)
    {
        $data = str_replace("\n","", self::pakkelabelsSettings($order,$dataPharmacy));
        $dataArray = json_decode($data,true);

//        return $dataArray;

        return $client->create_shipment($dataArray);
    }

    public static function pakkelabelsSettings($order,$dataPharmacy)
    {

        $skee_numbers = "";

        $total_weight = $order->products->sum(function ($product) use (&$skee_numbers){
            $skee_numbers .= $product->skeeis_item_number. ',' ;
            return (int)$product->pivot->amount * (int)$product->weight;
        });

        $skee_numbers = Str::limit($skee_numbers, 25, '...');

        /**
         * Sales Order
         */
//        return '{
//                  "order_id": "'.$data['order_id'].'",
//                  "ordered_at": "2018-10-17T15:25:44.557+02:00",
//                  "source_name": "Testcompany ApS",
//                  "order_note": "Note",
//                  "archived": false,
//                  "shipment_template_id": "154078",
//                  "ship_to": {
//                    "name": "Lene Hansen",
//                    "attention": null,
//                    "address1": "Skibhusvej 52",
//                    "address2": null,
//                    "zipcode": "5000",
//                    "city": "Odense C",
//                    "country_code": "DK",
//                    "email": "lene@email.dk",
//                    "mobile": "12345678",
//                    "telephone": "12345678",
//                    "instruction": null
//                  },
//                  "bill_to": {
//                    "name": "Min Virksomhed ApS",
//                    "attention": "Lene Hansen",
//                    "address1": "Strandvejen 6",
//                    "address2": null,
//                    "zipcode": "5240",
//                    "city": "Odense NØ",
//                    "country_code": "DK",
//                    "email": "info@minvirksomhed.dk",
//                    "mobile": "70400407",
//                    "telephone": "70400407"
//                  },
//                  "payment_details": {
//                    "amount_excluding_vat": "1600.0",
//                    "amount_including_vat": "2000.0",
//                    "authorized_amount": "2000.0",
//                    "currency_code": "DKK",
//                    "vat_amount": "400.0",
//                    "vat_percent": "0.25",
//                    "payment_method": "quickpay",
//                    "transaction_id": "123456789",
//                    "payment_gateway_id": "4012"
//                  },
//                  "service_point": {
//                    "id": "95558",
//                    "name": "Påskeløkkens Købmand",
//                    "address1": "Paaskeløkkevej 11",
//                    "address2": null,
//                    "zipcode": "5000",
//                    "city": "Odense C",
//                    "country_code": "DK"
//                  },
//                  "order_lines": [
//                    {
//                      "line_type": "item",
//                      "item_name": "T-Shirt",
//                      "item_sku": "TS001-WH",
//                      "item_variant_code": "White",
//                      "quantity": "2.0",
//                      "unit_price_excluding_vat": "800.0",
//                      "discount_amount_excluding_vat": "0.0",
//                      "vat_percent": "0.25",
//                      "currency_code": "DKK"
//                    }
//                  ]
//                }';

        /**
         * Shipment
         */

        /*return '{
          "test_mode": true,
          "own_agreement": false,
          "label_format": null,
          "product_code": "PDK_DPDC",
          "service_codes": "EMAIL_NT,SMS_NT",
          "automatic_select_service_point": true,
          "sender": {
            "name" => "'.config('services.pakkelabels.name').'",
            "attention" => "'.config('services.pakkelabels.attention').'",
            "address1" => "'.config('services.pakkelabels.address1').'",
            "address2" => "'.config('services.pakkelabels.address2').'",
            "zipcode" => "'.config('services.pakkelabels.zipcode').'",
            "city" => "'.config('services.pakkelabels.city').'",
            "country_code" => "'.config('services.pakkelabels.country_code').'",
            "email" => "'.config('services.pakkelabels.email').'",
            "mobile" => "'.config('services.pakkelabels.mobile').'",
            "telephone" => "'.config('services.pakkelabels.telephone').'",
          },
          "receiver": {
            "name": "'.$order->user->name.'",
            "attention": null,
            "address1": "'.$order->user->address.'",
            "address2": null,
            "zipcode": "'.$order->user->zip.'",
            "city": ""'.$order->user->city.'",
            "country_code": "DK",
            "email": "'.$order->user->email.'",
            "mobile": "'.$order->user->tel.'",
            "telephone": "'.$order->user->tel.'",
            "instruction": null
          },
          "parcels": [
            {
              "weight": 1000
            }
          ],
          "print": false,
          "print_at": {
            "host_name": "WAREHOUSE-PC",
            "printer_name": "Zebra Zdesigner GK420D",
            "label_format": "zpl"
          },
          "replace_http_status_code": false,
          "reference": "Order '.$order->user->tel.'"
        }';
        */

//          return '{
//          "own_agreement": false,
//          "label_format": null,
//          "product_code": "GLSDK_HD",
//          "service_codes": "EMAIL_NT,SMS_NT",
//          "sender": {
//            "name": "Skee Ismejeri ApS",
//            "attention": null,
//            "address1": "Langebjergvej 101",
//            "address2": null,
//            "zipcode": "4370",
//            "city": "Store Merløse",
//            "country_code": "DK",
//            "email": "skeeis@skeeis.dk",
//            "mobile": "57600528",
//            "telephone": "57600528"
//          },
//          "receiver": {
//            "name": "'.$order->user->name.'",
//            "attention": null,
//            "address1": "'.$order->user->address.'",
//            "address2": null,
//            "zipcode": "'.$order->user->zip.'",
//            "city": "'.$order->user->city.'",
//            "country_code": "DK",
//            "email": "'.$order->user->email.'",
//            "mobile": "'.$order->user->tel.'",
//            "telephone": "'.$order->user->tel.'",
//            "instruction": null
//          },
//          "parcels": [
//            {
//              "weight":  "'.$total_weight.'"
//            }
//          ],
//          "print": false,
//          "replace_http_status_code": false,
//          "reference": "'.$skee_numbers. "(order: ". $order->id. ")" .'"
//        }';

        return '{
          "own_agreement": false,
          "label_format": null,
          "product_code": "GLSDK_HD",
          "service_codes": "EMAIL_NT,SMS_NT,FLEX",
          "sender": {
            "name": "Skee Ismejeri ApS",
            "attention": null,
            "address1": "Langebjergvej 101",
            "address2": null,
            "zipcode": "4370",
            "city": "Store Merløse",
            "country_code": "DK",
            "email": "skeeis@skeeis.dk",
            "mobile": "57600528",
            "telephone": "57600528"
          },
          "receiver": {
            "name": "'.$dataPharmacy['name'].'",
            "attention": null,
            "address1": "'.$dataPharmacy['address'].'",
            "address2": null,
            "zipcode": "'.(int)$dataPharmacy['zipcode'].'",
            "city": "'.$dataPharmacy['city'].'",
            "country_code": "DK",
            "email": "'.$dataPharmacy['email'].'",
            "mobile": "'.$dataPharmacy['mobile'].'",
            "telephone": "'.$dataPharmacy['mobile'].'",
            "instruction": "'.$dataPharmacy['package_delivery_information'].'"
          },
          "parcels": [
            {
              "weight": '.$total_weight.'
            }
          ],
          "print": false,
          "replace_http_status_code": false,
          "reference": "'.$skee_numbers. "(". $order->id. ")" .'"
        }';

    }
}
