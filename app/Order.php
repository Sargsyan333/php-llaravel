<?php

namespace App;

use App\Http\Controllers\Economics\EconomicConnect;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * @package App
 * @property User $user
 */
class Order extends Model
{
    protected $guarded = [''];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('price','amount');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function delivery()
    {
        return $this->belongsTo(Delivery::class);
    }

    /**
     * @param $element
     * @param $n
     * @return array
     */
    public function createTheSameElementNTimes($element,$n)
    {
        $elements = [];
        for ($i = 0; $i < $n; $i++) {
            $elements[] = $element;
        }

        return $elements;
    }

    public static function orderSettings($data,EconomicConnect $economicClient,$attachOrder,$dataPhar)
    {
        $paymentConfig = $economicClient->getPaymentTermsById($data["payment"])['result'];

        $delivery = Delivery::find($data['delivery_id']);

        $deliveryDate = date('Y-m-d', strtotime($delivery->delivery_date));

//        return '{
//            "date": "2018-03-01",
//            "currency": "DKK",
//            "paymentTerms": {
//                "paymentTermsNumber": '.(int)$paymentConfig['paymentTermsNumber'].',
//                "daysOfCredit": '.$paymentConfig['daysOfCredit'].',
//                "name": "'.$paymentConfig['name'].'",
//                "paymentTermsType": "'.$paymentConfig['paymentTermsType'].'",
//                "self": "https://restapi.e-conomic.com/payment-terms/'.(int)$paymentConfig['paymentTermsNumber'].'"
//            },
//            "customer": {
//                "customerNumber": 30
//            },
//            "recipient": {
//                "name": "Toj & Co Grossisten",
//                "address": "Vejlevej 21",
//                "zip": "7000",
//                "city": "Fredericia",
//                "vatZone": {
//                    "name": "Domestic",
//                    "vatZoneNumber": 1,
//                    "enabledForCustomer": true,
//                    "enabledForSupplier": true
//                }
//            },
//            "layout": {
//                "layoutNumber": 19
//            },
//            "lines": [
//                {
//                    "unit": {
//                        "unitNumber": 2,
//                        "name": "Tim"
//                    },
//                    "product": {
//                        "productNumber": "150150"
//                    },
//                    "quantity": 1.00,
//                    "unitNetPrice": 10.00,
//                    "discountPercentage": 0.00,
//                    "unitCostPrice": 46.93,
//                    "totalNetAmount": 10.00,
//                    "marginInBaseCurrency": -46.93,
//                    "marginPercentage": 0.0
//                }
//            ]
//        }';

        //$product = $economicClient->getProduct($data["product"])['result'];

        $productsStr = '';
        $counter = 1;
        foreach ($attachOrder->products as $key => $product) {

            $totalNetAmount =  round((int)$product['pivot']['amount']* (int)$product['pivot']["price"], 2);
            $productsStr .= '{
                    "lineNumber": '.$counter.',
                    "sortKey": 1,
                    "unit": {
                        "unitNumber": 1,
                        "name": "Stk."
                    },
                    "description": "'.$product['name'].'",
                    "product": {
                        "productNumber":  "'.$product['skeeis_item_number'].'",
                        "self": "https://restapi.e-conomic.com/products/'.$product['skeeis_item_number'].'"
                    },
                    "quantity": '.$product['pivot']["amount"].',
                    "unitNetPrice": '.$product['pivot']["price"].',
                    "discountPercentage": 0.00,                  
                    "totalNetAmount": '.$product['pivot']['amount']*$product['pivot']["price"].'
                },';

            $counter++;
        }

        $productsStr = rtrim($productsStr, ',');

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
                "name": "'. $dataPhar["name"].'",
                "address": "'.$dataPhar["address"].'",
                "zip": "'.(int)$dataPhar["zipcode"].'",
                "city": "'.$dataPhar["city"].'",
                "vatZone": {
                    "name": "Domestic",
                    "vatZoneNumber": 1,
                    "enabledForCustomer": true,
                    "enabledForSupplier": true
                }
            },
            "notes": {
                "heading": "'.$data["package_delivery_information"].'"
            },
            "delivery": {
                "address": "'.$data["address"].'",
                "zip": "'.(int)$dataPhar["zipcode"].'",
                "city": "'.$dataPhar["city"].'",
                "country": "Denmark",
                "deliveryDate": "'.$deliveryDate.'"
            },
            "layout": {
                "layoutNumber": '.(int)$data["layout"].'
            },
            "lines": [
                '.$productsStr.'
            ]
        }';

    }

    public static function createEconomicOrders($data,EconomicConnect $economicClient)
    {
        return $economicClient->createEconomicOrders($data);
    }

    public static function findOrderByNumber($orderNumber,EconomicConnect $economicClient)
    {
        return $economicClient->getEconomicOrder($orderNumber);
    }

    public static function getLastMonthOrders($start,$end)
    {
        return Order::whereBetween(
            'created_at',[$start,$end]
        )->with('user')->get();
    }

    public static function updateOrder($order,$data)
    {
        return $order->update($data);
    }
}
