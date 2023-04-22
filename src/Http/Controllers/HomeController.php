<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\OldPasswordNoMatch;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Queenshera\AdminPanel\Helpers\AppHelper;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function home()
    {
        return view('home');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function profile(Request $request)
    {
        return view('profile')->with('redirect', $request->redirect);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function profileUpdate(Request $request)
    {
        $update['name'] = $request->name;
        $update['mobile'] = $request->mobile;

        if ($request->password) {
            $validator = Validator::make($request->all(), [
                'password' => ['required', new OldPasswordNoMatch],
            ]);
            if ($validator->fails()) {
                return back()->withError($validator->errors()->first());
            }
            $update['password'] = Hash::make($request->password);
        }

        if ($request->file('photo')) {
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if ($validator->fails()) {
                return back()->withError($validator->errors()->first());
            }

            $file = $request->file('photo');
            $name = 'photo_' . date('ymdHis') . '.' . $file->getClientOriginalExtension();
            $storagepath = 'profile/' . $name;

            $helper = new AppHelper();
            if (config('filesystems.disks.s3.enabled')) {
                $update['photo'] = $helper->uploadFileToS3($file, $storagepath);
            } else {
                $update['photo'] = $helper->uploadFileToLocal($file, $storagepath);
            }
        }
        User::where('id', auth()->user()->id)->update($update);
        if ($request->redirect) {
            return Redirect::to($request->redirect);
        }
        return back()->withSuccess('Profile data updated successfully');
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->withSuccess('Logged out successfully');
    }
}
