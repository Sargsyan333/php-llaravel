<?php

namespace App\Http\Controllers\WEB;

use App\Economic;
use App\Order;
use App\User;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Economics\EconomicConnect;
use Session;

class EconomicWebController extends Controller
{
    private $economicClient;
    private $customerResult;

    public function __construct()
    {
        $this->economicClient = new EconomicConnect();
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $result = $this->economicClient->getAllCustomers();

        foreach ($result['result']['collection'] as $key => $customer){
            $result['result']['collection'][$key]['customerExists'] = $this->checkIfCustomerAlreadyExists($customer['customerNumber']);
        }

        $customers = $result['result']['collection'];

        return view('admin.economic.index',compact('customers'));
    }

    /**
     * @param $customerNumber
     * @return \Illuminate\Http\RedirectResponse
     */
    public function import($customerNumber)
    {
        try {
            $this->getCustomerData($customerNumber)->createUserFromEconomic();
        } catch (\Exception $e) {
            return redirect()->back()->withErrors([$e->getMessage()]);

        }

        Session::flash('message', "Imported!");
        return redirect()->back();
    }

    public function getCustomerData($customerNumber)
    {
        $this->customerResult = $this->economicClient->getCustomer($customerNumber)['result'];

        return $this;
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function createUserFromEconomic()
    {
        $result = $this->customerResult;
        $defaultPassword = "Skee123!";

        $user = User::where('email', $result['email'])->first();

        if ( $user instanceof User ) {
            throw new \Exception('Email already exists.');
        }

        $data = [
            'name' => $result['name'],
            'email' => $result['email'],
            'customer_number' => $result['customerNumber'] ?? null,
            'tel' => $result['telephoneAndFaxNumber'] ?? null,
            'address' => $result['address'] ?? null,
            'zip' => $result['zip'] ?? null,
            'city' => $result['city'] ?? null,
            'password' => bcrypt($defaultPassword)
        ];

        return User::create($data);
    }

    /**
     * @param $customerNumber
     * @return bool
     */
    public function checkIfCustomerAlreadyExists($customerNumber)
    {
        $user = User::where('customer_number',$customerNumber)->first();

        if( $user ) return true;

        return false;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoiceList()
    {
        $result = $this->economicClient->grtAllInvoice()['result']['collection'];

        return view('admin.invoice.index',compact('result'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showInvoice($id)
    {
        $invoice = $this->economicClient->getInvoice($id)['result'];

        return view('admin.invoice.show',compact('invoice'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function invoiceCreate()
    {
        $customers = $this->economicClient->getAllCustomers()['result']['collection'];
        $products = $this->economicClient->getAllProducts()['result']['collection'];

        return view('admin.invoice.create',compact('customers','products'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function invoiceStore()
    {
        request()->validate([
            'customer' => 'required',
            'product' => 'required',
        ]);

        $user = auth()->user();

        $addToEconomic = true;
        if($addToEconomic) {
            $config = [
                "layout" => 19,
                "payment" => 1,
                "customer" =>  (int)request('customer'),
                "currency" => 'DKK',
                "recipient_name" => $user['name'],
                "recipient_address" => $user['address'],
                "product" => (int)request('product'),
            ];

            $dataArray = $this->invoiceConfigData($config);
            $this->economicClient->createInvoiceCurl($dataArray);
        }

        return redirect('administration/invoices');
    }

    /**
     * @param $config
     * @return mixed
     */
    public function invoiceConfigData($config)
    {
        $data = str_replace("\n","", Economic::invoiceSettings($config,$this->economicClient));
        return json_decode($data,true);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Exception
     */
    public function exportOrdersToInvoice()
    {
        $last_month_info = [];
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $last_month_info['start'] = $start->startOfMonth();
        $last_month_info['end'] = $end->endOfMonth();
        $last_month_info['month']['number'] = $start->format('m');
        $last_month_info['month']['name'] = $start->format('M');

        $orders = $this->getLastMonthOrders( $last_month_info['start'], $last_month_info['end'] );

        return view('economic.invoice',compact('last_month_info','orders'));
    }

    /**
     * @param $start
     * @param $end
     * @return mixed
     */
    public function getLastMonthOrders($start,$end)
    {
        return Order::getLastMonthOrders($start,$end);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function exportOrdersToInvoiceStore()
    {
        $last_month_info = array();
        $start = new Carbon('first day of last month');
        $end = new Carbon('last day of last month');

        $last_month_info['start'] = $start->startOfMonth();
        $last_month_info['end'] = $end->endOfMonth();

        $orders = $this->getLastMonthOrders( $start->startOfMonth(),  $end->endOfMonth() );

        $exportCount = 0;

        foreach ($orders as $order) {
            /**
             * currently, only first element:
             */
            $productsIds = $this->getOrderProductsIds($order)[0];

            if( $order->user->customer_number &&
                $order->layout &&
                $order->paymentTerms &&
                $order->currency &&
                !$order->economic_status
            ) {
                $config = [
                    "layout" => $order->layout,
                    "payment" => $order->paymentTerms,
                    "customer" =>  (int)$order->user->customer_number,
                    "currency" =>  $order->currency,
                    "recipient_name" => $order->user->customer_number,
                    "recipient_address" => $order->user->address,
                    "product" => (int)$productsIds,
                ];

                $dataArray = $this->invoiceConfigData($config);
                $this->economicClient->createInvoiceCurl($dataArray);
                $order->update([ 'economic_status' => 1]);
                $exportCount++;
            }
        }

        if($exportCount)
            $message = "Exported $exportCount orders!";
        else
            $message = "Nothing exported!";

        Session::flash('message', $message);

        return redirect()->back();
    }

    /**
     * @param $order
     * @return mixed
     */
    public function getOrderProductsIds($order)
    {
        return $order->products->map(function($item){
            return $item->id;
        });
    }

}
