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

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home()
    {
        return view('home');
    }

    public function profile(Request $request)
    {
        return view('profile')->with('redirect',$request->redirect);
    }

    public function profileUpdate(Request $request)
    {
        $update['name'] = $request->name;
        $update['mobile'] = $request->mobile;

        if($request->password)
        {
            $validator = Validator::make($request->all(), [
                'password' => ['required', new OldPasswordNoMatch],
            ]);
            if ($validator->fails()) {
                return back()->withError($validator->errors()->first());
            }
            $update['password'] = Hash::make($request->password);
        }

        if($request->file('photo'))
        {
            $validator = Validator::make($request->all(), [
                'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            if($validator->fails())
            {
                return back()->withError($validator->errors()->first());
            }

            $file = $request->file('photo');
            $name = 'photo_'.date('ymdHis') . '.' . $file->getClientOriginalExtension();
            $storagepath = 'profile/' . $name;
            Storage::disk('s3')->put($storagepath, file_get_contents($file));
            $filepath = config('filesystems.disks.s3.url').$storagepath;
            $update['photo'] = $filepath;
        }
        User::where('id',auth()->user()->id)->update($update);
        if($request->redirect)
        {
            return Redirect::to($request->redirect);
        }
        return back()->withSuccess('Profile data updated successfully');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login')->withSuccess('Logged out successfully');
    }
}