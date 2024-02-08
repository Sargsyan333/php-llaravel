<?php

namespace App\Http\Controllers;

use App\Economic;
use App\Http\Controllers\Economics\EconomicConnect;
use App\Http\Controllers\Pakkelabels\Pakkelabels;
use App\Http\Controllers\WEB\OrderWebController;
use App\Order;
use App\Product;
use Illuminate\Http\Request;
use Mockery\Exception;

class OrderController extends Controller
{
    private $economicClient;
    private $pakkelabelsClient;
    protected $orderEconomic;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->economicClient = new EconomicConnect();

        $api_user = env('PAKKELABELS_API_USER');
        $api_key = env('PAKKELABELS_API_KEY');

        $this->pakkelabelsClient = new Pakkelabels($api_user, $api_key);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $orders = Order::with('products','user','delivery')->get();

        return response()->json([ 'data' => $orders ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        request()->validate([
            'product' => 'required',
            'delivery_id' => 'required',
            'address' =>'required',
            'email' => 'required',
            'mobile' => 'required',
            'package_delivery_information' => 'required',
            'name' => 'required',
            'zipcode' => 'required',
            'city' => 'required',
        ]);

        $data = request()->all();

        $user = auth()->user();

        $productSettings = [
            'name' => $data['name'],
            'delivery_id' => (int) $data['delivery_id'],
            'address' => $data['address'],
            'email' => $data['email'],
            'mobile' => $data['mobile'],
            'package_delivery_information' => $data['package_delivery_information'],
            'package_delivery_date' => '',
            'package_comment' => '',
            'layout' => 19,
            'paymentTerms' => 4,
            'currency' => 'DKK',
        ];

        $order = $user->orders()->create($productSettings);
        $attachData = array();

        foreach ($data['product'] as $product) {
            $iProduct = Product::find($product['id']);
            $productId = (int) $iProduct['id'];
            $itemCount = (int) $product['count'];
            $attachData[$productId] = ['price' => $iProduct['price'], 'amount' => $itemCount];
        }

        $order->products()->attach(
            $attachData
        );

//        return response()->json([ 'dataPakk' =>
//            $dataPakk = $this->addToEconomic($productSettings,$order,$data)->updateOrderAfterEconomic($order)->addToPakkelabels($order,$data)
//        ]);

        $dataPakk = $this->addToEconomic($productSettings,$order,$data)
            ->updateOrderAfterEconomic($order)
            ->addToPakkelabels($order,$data);

        return response()->json([ 'dataPakk' => $dataPakk , 'order' => $order ]);
    }

    /**
     * @param $productSettings
     * @param $order
     * @param $dataPhar
     * @return $this
     */
    public function addToEconomic($productSettings,$order,$dataPhar)
    {
        $auth = auth()->user();

        $config = [
            "layout" => $productSettings['layout'],
            "package_delivery_information" => $productSettings['package_delivery_information'],
            "payment" => $productSettings['paymentTerms'],
            'delivery_id' => (int) $productSettings['delivery_id'],
            'address' => $productSettings['address'],
            "customer" => $auth->customer_number,
            "currency" => $productSettings['currency'],
            "recipient_name" => $auth->name,
            "recipient_address" => $auth->address,
        ];

        $data = str_replace("\n","", Order::orderSettings($config,$this->economicClient,$order,$dataPhar));

        $dataArray = json_decode($data,true);

//        return $dataArray;

        $this->orderEconomic = Order::createEconomicOrders($dataArray,$this->economicClient)['result'];

        return $this;
    }

    /**
     * @param $order
     * @return $this
     */
    public function updateOrderAfterEconomic($order)
    {
        $order->update([
            "economics_id" => $this->orderEconomic['orderNumber'],
            "currency" => $this->orderEconomic['currency'],
            "paymentTerms" => $this->orderEconomic['paymentTerms']['paymentTermsNumber'],
            "layout" => $this->orderEconomic['layout']['layoutNumber'],
        ]);

        return $this;
    }

    public function addToPakkelabels($order,$data)
    {
        $dataPakk = \App\Pakkelabels::createPakkelabelsOrder($this->pakkelabelsClient,$order,$data);

        if(isset($dataPakk['output'])) {
            $order->update([
                "shipmondo_id" => $dataPakk['output']['id'],
            ]);
        }

        return $dataPakk;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function findOrder()
    {
        request()->validate([
            'name' => 'required',
        ]);

        $order = Order::where('name', '=', request()->get('name'))
                        ->with('user','delivery')
                        ->firstOrFail();

        return response()->json([ 'data' => $order ]);

    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function findOrderEconomic()
    {
        request()->validate([
            'order' => 'required',
        ]);

        $order = Order::findOrderByNumber(request()->get('order'),$this->economicClient)['result'];

        return response()->json([ 'data' => $order ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUserOrders()
    {
        $orders =  auth()->user()->orders->load('user','delivery','products');

        return response()->json(['data' => $orders]);
    }

    public function getAuthenticatedUserOrder(Order $order)
    {
        $data = ($order->user->id == auth()->id())
            ? $order->load('user','delivery','products')
            : [];

        return response()->json(['data' => $data]);
    }
}
