<?php

namespace App\Http\Controllers\WEB;

use App\Http\Controllers\Economics\EconomicConnect;
use App\Http\Requests\CreateOrEditUser;
use App\Http\Requests\UserAuthentication;
use App\Http\Resources\User as UserResource;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserWebController extends Controller
{
    private $economicClient;

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
        $users = User::where('is_admin',0)->latest()->get();

        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addToEconomic = $request->exists("create_economic");

        $rules = [
            'email' => 'required|unique:users,email',
            'password' => 'required',
            'name' => 'required'
        ];

        $validator = \Validator::make([
            'email' => $request->email,
            'password' => $request->password,
            'name' => $request->name
        ], $rules);

        $userData = $request->all();

        if ($validator->fails()) return redirect()->back()->withErrors(['Please try again!']);

        $userData['password'] = bcrypt($request->get('password'));

        if($addToEconomic) unset($request['create_economic']);

        $user = User::create(
            $userData
        );

        if($addToEconomic) $this->addToEconomic($user);

        return redirect('/administration/users');
    }

    /**
     * Display the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(User $user)
    {
        return view('admin.user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(User $user)
    {
        return view('admin.user.update',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request,User $user)
    {
        $data = $request->all();

        if (isset($data['email']) && $data['email']) {

            if($user->email !== $data['email']){
                $rules = array('email' => 'unique:users,email');

                $validator = \Validator::make([ 'email' => $data['email']], $rules);

                if ($validator->fails()) return redirect()->back()->withErrors(['That email address is already registered.']);
            }
        }

        if (isset($data['password']) && $data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect("/administration/users");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }

    public function addToEconomic(User $user)
    {
        if(!$user->customer_number){
            $obj = [
                "currency" => "DKK",
                "customerGroup" => [
                    "customerGroupNumber" => 1,
                    "self" => "https://restapi.e-conomic.com/customer-groups/1"
                ],
                "name" => $user->name,
                "email" => $user->email,
                "paymentTerms" => [
                    "paymentTermsNumber" => 2,
                    "self" => "https://restapi.e-conomic.com/payment-terms/2"
                ],
                "vatZone" => [
                    "vatZoneNumber" => 1,
                    "self" => "https://restapi.e-conomic.com/vat-zones/1"
                ]
            ];

            $response = $this->economicClient->createCustomer($obj);

            $user->update([
                "customer_number" => $response['result']['customerNumber']
            ]);
        }

        return redirect('administration/users');
    }

    public function importEconomic()
    {
        return redirect('administration/economics/customers');
    }

    public function deleteEconomic(User $user)
    {
        $customerNumber = $user->customer_number;
        $this->economicClient->deleteCustomer($customerNumber);
        $user->update(["customer_number" => null]);

        return redirect('administration/users');
    }
}
