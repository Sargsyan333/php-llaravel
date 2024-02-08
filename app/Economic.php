<?php

namespace App;

use App\Http\Controllers\Economics\EconomicConnect;
use Illuminate\Database\Eloquent\Model;

class Economic extends Model
{
    public static function invoiceSettings($data,EconomicConnect $economicClient)
    {
        $paymentConfig = $economicClient->getPaymentTermsById($data["payment"])['result'];
        $product = $economicClient->getProduct($data["product"])['result'];

        return '{
            "date": "'.date("Y-m-d").'",
            "currency": "'.$data["currency"].'",
            "paymentTerms": {
                "paymentTermsNumber": '.(int)$paymentConfig['paymentTermsNumber'].',
                "daysOfCredit": '.$paymentConfig['daysOfCredit'].',
                "name": "'.$paymentConfig['name'].'",
                "paymentTermsType": "'.$paymentConfig['paymentTermsType'].'",
                "self": "https://restapi.e-conomic.com/payment-terms/'.(int)$paymentConfig['paymentTermsNumber'].'"
            },
            "customer": {
                "customerNumber": '.(int)$data["customer"].'
            },
            "recipient": {
                "name": "'. $data["recipient_name"].'",
                "address": "'.$data["recipient_address"].'",
                "zip": "7000",
                "city": "Fredericia",
                "vatZone": {
                    "name": "Domestic",
                    "vatZoneNumber": 1,
                    "enabledForCustomer": true,
                    "enabledForSupplier": true
                }
            },

            "layout": {
                "layoutNumber": '.(int)$data["layout"].'
            },
            "lines": [
                {
                    "lineNumber": 1,
                    "sortKey": 1,
                    "unit": {
                        "unitNumber": 1,
                        "name": "Stk."
                    },
                    "product": {
                        "productNumber": "'.$product["productNumber"].'"
                    },
                    "quantity": 1.00,
                    "unitNetPrice": 200.00,
                    "discountPercentage": 0.00,
                    "totalNetAmount": 200.00
                }
            ]
        }';
    }

    public static function invoiceList(EconomicConnect $economicClient)
    {
        return $economicClient->grtAllInvoice();
    }
}
