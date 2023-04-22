<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use Queenshera\AdminPanel\Helpers\AppHelper;

class UserController extends Controller
{
    /**
     * @param Request $request
     * @return array
     */
    public function signin(Request $request)
    {
        if (Auth::attempt(['email' => request('email'), 'password' => request('password')])) {
            $user = Auth::user();
            $success['response'] = 'success';
            $success['message'] = 'Login successfull';
            $user['token'] = $user->createToken($user->id)->plainTextToken;
            $success['data'] = $user;
            return $success;
        }
        $error['response'] = 'error';
        $error['message'] = 'Invalid details';
        return $error;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function signup(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user) {
            $error['response'] = 'error';
            $error['message'] = 'User already exists';
            return $error;
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'mobile' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            $error['response'] = 'error';
            $error['message'] = $validator->errors()->first();
            return $error;
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['mobile'] = $request->mobile;
        $data['password'] = Hash::make($request->password);

        $user = User::create($data);

        $user['token'] = $user->createToken($user->id)->plainTextToken;

        $success['response'] = 'success';
        $success['message'] = 'Registration successful';
        $success['data'] = $user;
        return $success;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function googleLogin(Request $request)
    {
        $helper = new AppHelper();
        $user = User::where('email', $request->email)->first();

        if ($user) {
            User::where('id', $user->id)->update(['googleId' => $request->googleId]);
            $user['token'] = $user->createToken($user->id)->plainTextToken;

            $success['response'] = 'success';
            $success['message'] = 'Login successfull';
            $success['data'] = $user;
            return $success;
        } else {
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['googleId'] = $request->googleId;
            $data['password'] = Hash::make($helper->randomid(10, true));

            $user = User::create($data);

            $user['token'] = $user->createToken($user->id)->plainTextToken;

            $success['response'] = 'success';
            $success['message'] = 'Registration successful';
            $success['data'] = $user;
            return $success;
        }
    }

    /**
     * @param Request $request
     * @return array
     */
    public function forgotPass(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            $error['response'] = 'error';
            $error['message'] = 'User does not exists';
            return $error;
        }

        $response = Password::sendResetLink($request->all());

        if ($response == Password::RESET_LINK_SENT) {
            $success['response'] = 'success';
            $success['message'] = 'Password reset email sent successfully';
            return $success;
        }
        $error['response'] = 'error';
        $error['message'] = 'Failed to send password reset email';
        return $error;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function fcmUpdate(Request $request)
    {
        User::where('id', auth()->user()->id)->update(['fcmToken' => $request->fcmToken]);

        $success['response'] = 'success';
        $success['message'] = 'Token updated';

        return $success;
    }
}
