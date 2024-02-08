<?php

namespace App\Http\Controllers;

use App\Economic;
use App\Http\Controllers\Economics\EconomicConnect;
use App\Order;

class EconomicController
{
    private $economicClient;

    public function __construct()
    {
        $this->economicClient = new EconomicConnect();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->economicClient->getAll();

        return view('economic.index',compact('result'));
    }

    /**
     * @param $a
     * @param $b
     * @return int|\lt
     */
    public function sortByProductNo($a, $b)
    {
        return strcmp($a->product_id, $b->product_id);
    }

    public function createEconomic(Order $order)
    {

        $result = $this->economicClient->createInvoice($order);
        dd($result);
    }

    public function getAllCustomers()
    {
        $result = $this->economicClient->getAllCustomers();
        dd($result);
    }

    public function getCustomer($customerNumber)
    {
        $result = $this->economicClient->getCustomer($customerNumber);

        return $result;
    }

    public function createCustomer($obj)
    {
        $result = $this->economicClient->createCustomer($obj);

        return response()->json(['data' => $result]);
    }

    public function deleteCustomer($customerNumber)
    {
        $result = $this->economicClient->deleteCustomer($customerNumber);

        return $result;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function storeInvoice()
    {
        request()->validate([
            "layout" => 'required',
            "payment" => 'required',
            "customer" =>  'required',
            "currency" => 'required',
            "product" => 'required',
        ]);

        $config = [
            "layout" => (int)request('layout'),
            "payment" => (int)request('payment'),
            "customer" =>  (int)request('customer'),
            "currency" => request('currency'),
            "recipient_name" => auth()->user()->name,
            "recipient_address" => auth()->user()->address,
            "product" => (int)request('product'),
        ];

        $data = str_replace("\n","", Economic::invoiceSettings($config,$this->economicClient));

        $dataArray = json_decode($data,true);
        $invoice = $this->economicClient->createInvoiceCurl($dataArray);

        return response()->json(['data' => $invoice]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInvoices()
    {
        $invoices = Economic::invoiceList($this->economicClient)['result']['collection'];

        return response()->json(['data' => $invoices]);
    }
}