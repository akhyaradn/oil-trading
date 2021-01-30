<?php
 
namespace App\Http\Controllers\CMS;
 
use Illuminate\Http\Request;
 
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Hash;
use Session;
use Log;

 
class LoginController extends Controller
{
    public function showFormLogin(Request $request)
    {
        if (Session::has('user')) {
            return redirect()->route('dashboardCMS');
        }
        return view('CMS.pages.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'username'                 => 'required|string',
            'password'              => 'required|string'
        ];
 
        $messages = [
            'username.required'        => "Username can't be empty",
            'password.required'     => "Password can't be empty",
        ];
 
        $validator = Validator::make($request->all(), $rules, $messages);
 
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }
 
        $data = [
            'username'     => $request->input('username'),
            'password'  => $request->input('password'),
        ];
 
        $check = User::where('username', $data['username'])
                    ->where('password', $data['password'])
                    ->first();

        if ($check) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            Session::put('user', 1);
            return redirect()->route('dashboardCMS');
        } else { // false
            //Login Fail
            return redirect()->route('login')->with(['failed' => "Username or password doesn't matched"]);
        }
    }
 
    public function logout(Request $request)
    {
        Session::forget('user');
        return redirect()->route('login');
    }

    public function formAdminSetting() {
        return view("CMS.pages.admin-setting");
    }

    public function adminSetting(Request $request) {
        $pass = User::where('id', 1)->first();

        if($pass->password != $request->password) {
            return redirect()->route("formAdminSetting")->with(['failed' => "Incorrect password!"]);
        }

        if($request->newpassword != $request->confirmpassword) {
            return redirect()->route("formAdminSetting")->with(['failed' => "New password doesn't matched!"]);
        }

        try {
            User::where('id', 1)
            ->update([
                'password' => $request->confirmpassword
            ]);

            return redirect()->route("formAdminSetting")->with(['success' => 'New password saved successfully!']);
        } catch(\Exception $e) {
            Log::error($e);
            return redirect()->route("formAdminSetting")->with(['failed' => 'New password failed to save!']);
        }
    }
}