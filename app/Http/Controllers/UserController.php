<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPassword;
use App\Http\Requests\UserAuthentication;
use App\Product;
use App\User;
use App\UserVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Exceptions\JWTException;


class UserController extends ApiController
{
    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['error' => 'invalid_credentials'], 400);
            }

            list('user' => $user,'products' => $products,'deliveries' => $deliveries) = Product::getRequiredItems();

        } catch (JWTException $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
        }

        return response()->json(compact('token','user','products','deliveries'));
    }

    /**
     * @param UserAuthentication $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function registerApi(UserAuthentication $request)
    {
        $user = User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'password' => bcrypt($request->get('password')),
        ]);

        $token = JWTAuth::fromUser($user);

        list('user' => $user, 'products' => $products, 'deliveries' => $deliveries) = Product::getRequiredItems();

        return response()->json(compact('user','token','products','deliveries'),201);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAuthenticatedUser()
    {
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
        } catch (\Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (\Tymon\JWTAuth\Exceptions\JWTException $e) {
            return response()->json(['token_absent'], $e->getStatusCode());
        }

        return response()->json(compact('user'));
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function logoutApi()
    {
        try {
            JWTAuth::invalidate();
        } catch (\Exception $e) {
            return response()->json(['token_expired'], $e->getStatusCode());
        }

        return response()->json([
            'status' => 200,
            'statusMessage' => 'success',
            'message' => 'User Logged Out',
        ], 200);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email'
        ]);

        $user = User::where('email',$request->get('email'))->first();

        $verification_code = Str::random(40);

        UserVerification::create([
            'user_id' => $user->id,
            'token' => $verification_code
        ]);

        $subject = "Please verify your email address.";
        $email = $user->email;
        $name = $user->name;

        Mail::send('email.verify', ['name' => $user->name, 'verification_code' => $verification_code],
            function($mail) use ($email, $name, $subject){
                $mail->from(getenv('FROM_EMAIL_ADDRESS'), "From Skee");
                $mail->to($email, $name);
                $mail->subject($subject);
            });

        return response()->json([
            'success'=> true,
            'message'=> 'Please check your email address!'
        ]);
    }

    /**
     * @param $verification_code
     * @return \Illuminate\Http\JsonResponse
     */
    public function verifyUser($verification_code)
    {
        $check = UserVerification::where('token',$verification_code)->with('user')->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }

            $user->update(['is_verified' => 1]);

            return response()->json([
                'success'=> true,
                'data' => $check,
                'message'=> 'You have successfully verified your email address.'
            ]);
        }

        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function passwordRecover(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users,email',
            'verify_token' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $check = UserVerification::where('token',$request->get('verify_token'))->with('user')->first();
        $user = User::where('email',$request->get('email'))->first();

        if($check->user->email == $user->email) {
            $user->update([
                'password' => bcrypt($request->get('password'))
            ]);

            $check->delete();

            return response()->json([
                'success' => true,
                'data'=> $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(ResetPassword $request)
    {
        $user = Auth::user();

        if ($request->get('new_password') == $request->get('new_password_confirmation') && Hash::check($request->get('old_password'), $user->password)) {
            $user->update([
                'password' => bcrypt($request->get('new_password'))
            ]);

            return response()->json([
                'success' => true,
                'data' => $user
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials!'
        ], 400);
    }
}
