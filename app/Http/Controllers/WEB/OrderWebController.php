<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Economics\EconomicConnect;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderWebController extends Controller
{
    private $economicClient;
    private $economicData;

    public function __construct()
    {
        $this->economicClient = new EconomicConnect();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('products','user','delivery')->latest()->get();

        return view('admin.order.index',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * @param Order $order
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Order $order)
    {
        return view('admin.order.show',compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * @param Order $order
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->products()->detach();

        $order->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Order deleted successfully'
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function economicOrders()
    {
        $orders = $this->economicClient->getEconomicOrders()['result']['collection'];

        return view('admin.order.economic-index',compact('orders'));
    }

    public function createEconomicOrderPage()
    {
        $layouts = $this->economicClient->getEconomicLayouts()['result']['collection'];
        $payments = $this->economicClient->getPaymentTerms()['result']['collection'];
        $customers = $this->economicClient->getAllCustomers()['result']['collection'];

        return view('admin.order.economic-create',compact('layouts','payments','customers'));
    }

    public function createEconomicOrder()
    {
        return $this->orderData()->createEconomicOrderCall()->backToPage();
    }

    public function orderData()
    {
        $data = request()->all();
        $paymentConfig = $this->economicClient->getPaymentTermsById($data["payment"])['result'];

        $this->economicData = [
            "date" => date("Y-m-d"),
            "currency" => $data["currency"],

            "customer" => [
                "customerNumber" => (int)$data["customer"]
            ],
            "layout" => [
                "layoutNumber" => (int)$data["layout"]
            ],
            "paymentTerms" => [
                "paymentTermsNumber" => (int)$paymentConfig['paymentTermsNumber'],
                "daysOfCredit" => $paymentConfig['daysOfCredit'],
                "name" => $paymentConfig['name'],
                "paymentTermsType" => $paymentConfig['paymentTermsType']
            ],
            "recipient" => [
                "name" => $data["recipient_name"],
                "address" => $data["recipient_address"],
                "vatZone" => [
                    "name" =>  "Domestic",
                    "vatZoneNumber" => 1,
                    "enabledForCustomer" => true,
                    "enabledForSupplier" => true,
                ]
            ],
            "delivery" => [
                "address" => "Hovedvejen 1",
                "zip" => "2300"
            ]
        ];

        return $this;
    }

    public function createEconomicOrderCall()
    {
        $this->economicClient->createEconomicOrders($this->economicData);

        return $this;
    }

    public function backToPage()
    {
        return redirect('/administration/orders/economic/orders');
    }

    public function getOrder($orderNumber)
    {
        $order = $this->economicClient->getEconomicOrder($orderNumber)['result'];

        return view('admin.order.economic-show',compact('order'));
    }
}
