<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateOrEditUser;
use App\Http\Resources\UserCollection;
use App\User;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;

class AdminController extends Controller
{
    /**
     * @return UserCollection
     */
    public function getUsersList()
    {
        $users = User::where('is_admin',0)->get();

        return new UserCollection($users);
    }

    /**
     * @param User $user
     * @return UserResource
     */
    public function getUser(User $user)
    {
        return new UserResource($user);
    }

    /**
     * @param CreateOrEditUser $request
     * @return UserResource
     */
    public function createUser(CreateOrEditUser $request)
    {
        $request->merge(['password' => bcrypt($request->password)]);
        $user = User::create($request->all());

        return new UserResource($user);
    }

    public function updateUser(Request $request,User $user)
    {
        $data = $request->all();
        $userPassword = $data['password'];

        if ( $userPassword ) {
            $data['password'] = bcrypt($userPassword);
        }

        $user->update($data);

        return new UserResource($user);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function deleteUser(User $user)
    {
        $user->delete();

        return response()->json([
            'status' => 200,
            'message' => 'User deleted successfully'
        ]);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsersOrdersWithProducts()
    {
        $users = User::where('is_admin',0)->with('orders','orders.products')->get();

        return response()->json([ 'data' => $users ]);
    }

    /**
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserOrdersWithProducts(User $user)
    {
        $user->load('orders.products');

        return response()->json([ 'data' => $user ]);
    }
}
