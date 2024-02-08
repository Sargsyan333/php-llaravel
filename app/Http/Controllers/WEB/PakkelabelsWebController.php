<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Pakkelabels\Pakkelabels;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PakkelabelsWebController extends Controller
{
    private $client;

    public function __construct()
    {
        $api_user = env('PAKKELABELS_API_USER');
        $api_key = env('PAKKELABELS_API_KEY');

        $this->client = new Pakkelabels($api_user, $api_key);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $ordersTrue = Order::whereNotNull('shipmondo_id')
            ->select('*', \DB::raw('count(*) as total'))
            ->groupBy('delivery_id')->get();

        $ordersFalse = Order::whereNull('shipmondo_id')
            ->select('*', \DB::raw('count(*) as total'))
            ->groupBy('delivery_id')->get();

        return view('pakkelabels.create',compact('ordersTrue','ordersFalse'));
    }

    /**
     *
     */
    public function create()
    {
        $ordersQuery = Order::whereNotNull('shipmondo_id');

        $orders = $ordersQuery->get();

        $ordersGrouped = $ordersQuery->select('*', \DB::raw('count(*) as total'))
                                        ->groupBy('delivery_id')->get();

       /**
        * Send to "pakkelabels"
        */

       dump($orders);
       dd($ordersGrouped);
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shipmentDetails($id)
    {
        $shipment = $this->client->shipment($id,[]);

        return view('pakkelabels.show',compact('shipment'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function shipmentsList()
    {
        $shipments = $this->client->shipments([])['output'];

        return view('pakkelabels.shipments',compact('shipments'));
    }

    public function salesOrders()
    {
        $salesOrders = $this->client->sales_orders([]);

        return view('pakkelabels.sales-orders',compact('salesOrders'));
    }
}
