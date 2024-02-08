<?php

namespace App\Http\Controllers;

use App\Delivery;
use App\Http\Requests\DeliveryRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::getDeliveries();

        return response()->json([ 'data' => $deliveries ]);
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
    public function store(DeliveryRequest $request)
    {
        $dateToString = strtotime($request->get('delivery_date'));
        $dateToTimestamp = Carbon::createFromTimestamp($dateToString)->toDateTimeString();

        $delivery = Delivery::create([
            'delivery_date' => $dateToTimestamp,
        ]);

        return response()->json(['data' => $delivery]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Delivery $delivery)
    {
        $data = $request->all();
        $delivery->update($data);

        return response()->json([ 'data' => $delivery ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Delivery $delivery
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Delivery deleted successfully'
        ]);
    }
}
