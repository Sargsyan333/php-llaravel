<?php

namespace App\Http\Controllers\WEB;

use App\Delivery;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeliveryWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deliveries = Delivery::latest()->get();

        return view('admin.delivery.index',compact('deliveries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dates = explode(',',$request->get('delivery_date'));
        $properDates = [];
        $counter = 0;

        foreach ($dates as $date) {
            $dateToString = strtotime($date);
            $dateToTimestamp = Carbon::createFromTimestamp($dateToString)->toDateTimeString();

            $properDates[$counter]['delivery_date'] = $dateToTimestamp;
            $properDates[$counter]['created_at'] = Carbon::now();
            $properDates[$counter]['updated_at'] = Carbon::now();
            $counter++;
        }

        Delivery::insert($properDates);

        return redirect('/administration/deliveries');
    }

    /**
     * Display the specified resource.
     *
     * @param Delivery $delivery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Delivery $delivery)
    {
        return view('admin.delivery.show',compact('delivery'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Delivery $delivery
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Delivery $delivery)
    {
        return view('admin.delivery.update',compact('delivery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Delivery $delivery
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Delivery $delivery)
    {
        $data = $request->all();
        $dateToString = strtotime($request->get('delivery_date'));
        $dateToTimestamp = Carbon::createFromTimestamp($dateToString)->toDateTimeString();

        $data['delivery_date'] = $dateToTimestamp;
        $delivery->update($data);

        return redirect("administration/deliveries");
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
