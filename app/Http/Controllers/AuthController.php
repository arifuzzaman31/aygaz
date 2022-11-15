<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\UserMaster;

class AuthController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_login() {
        return view('auth.login');
    }

    public function post_login(Request $request) {
        if($request->ajax())
        {
            $data=[];
            $model = UserMaster::where('email', $request->input('email'))
                    ->where('type_id', '1')
                    ->where('status', '1')
                    ->first();
            if (!empty($model) && Hash::check($request->input('password'), $model->password)) {
                if ($request->input('rememberMe') != '') {
                    $expire = time() + 3600;
                    setcookie('admin_email', $request->input('email'), $expire);
                    setcookie('admin_password', $request->input('password'), $expire);
                } else {
                    $expire = time() - 3600;
                    setcookie('admin_email', '', $expire);
                    setcookie('admin_password', '', $expire);
                }
                Auth::guard('backend')->login($model);
                $model->last_login = date('Y-m-d H:i:s');
                $model->save();
                $data['status']=200;
                $data['msg']="You are successfully logged in.";
                $data['link']=route('admin-dashboard');
            } else {
                $data['status']=400;
                $data['msg']="Incorrect Email or Password";
            }
            
            return response()->json($data); 
        }
    }

    public function logout() {
        if (isset($_GET['type']) && $_GET['type'] == "lock") {
            $user = Auth()->guard('backend')->user();
            $expire = time() + 3600;
            setcookie('admin_email_lock', $user->email, $expire);
            Auth::guard('backend')->logout();
            return redirect('admin-lockscreen');
        } else {
            Auth::guard('backend')->logout();
            return redirect('admin-login')->with('success', 'You are successfully logged out.');
        }
    }

    public function post_forgot_password(Request $request) {
        if ($request->ajax()) {
            $data_msg = [];
            $validator = Validator::make($request->all(), [
                        'email' => 'required|email',
            ]);
            $validator->after(function($validator)use ($request) {
                $checkUser = UserMaster::where('type_id', '=', '1')->where('email', '=', $request->input('email'))->where('status', '=', '1')->first();
                if (count($checkUser) == 0) {
                    $validator->errors()->add('email', 'We could not find the email that you are looking for.');
                }
            });
            if ($validator->passes()) {
                $model = UserMaster::where('type_id', '=', '1')->where('email', '=', $request->input('email'))->where('status', '=', '1')->first();
                $password = $this->rand_string(8);
                $name = $model->first_name . ' ' . $model->last_name;
                $model->password = Hash::make($password);
                $model->save();
                $email_setting = $this->get_email_data('admin_forgot_password', array('NAME' => $name, 'NEW_PASSWORD' => $password));
                $email_data = [
                    'to' => $model->email,
                    'subject' => $email_setting['subject'],
                    'template' => 'admin_forgot_password',
                    'data' => ['message' => $email_setting['body']]
                ];
                $this->SendMail($email_data);
                $request->session()->flash('success', 'We have sent a new password to your email. Please check it.');
                $data_msg['type'] = 'success';
            } else {
                $error_arr = $validator->errors()->getMessages();
                foreach ($error_arr as $key => $val) {
                    if (isset($val[0]) && $val[0] != "") {
                        $data_msg['error'][$key] = $val[0];
                    }
                }
                $data_msg['type'] = "failure";
            }
            return response()->json($data_msg);
        }
    }

    public function get_lockscreen() {
        if (!Auth()->guard('backend')->guest()) {
            return redirect('admin/admin-dashboard');
        }
        if (isset($_COOKIE['admin_email_lock']) && $_COOKIE['admin_email_lock'] != "") {
            $model = UserMaster::where('email', $_COOKIE['admin_email_lock'])
                    ->where('type_id', '1')
                    ->where('status', '1')
                    ->first();
            return view('admin::auth.lock_screen', ['admin_model' => $model]);
        } else {
            return redirect('admin/admin-login');
        }
    }

    public function post_lockscreen(Request $request) {
        $validator = Validator::make($request->all(), [
                    'password' => 'required'
        ]);
        if ($request->input('password') != "") {
            $model = UserMaster::where('email', $_COOKIE['admin_email_lock'])
                    ->where('type_id', '1')
                    ->where('status', '1')
                    ->first();
            if (!Hash::check($request->input('password'), $model->password)) {
                $validator->after(function($validator) {
                    $validator->errors()->add('password', 'Incorrect Password!');
                });
            }
        }
        if ($validator->passes()) {
            Auth::guard('backend')->login($model);
            $expire = time() - 3600;
            setcookie('admin_email_lock', '', $expire);
            return redirect('admin/admin-dashboard')->with('success', 'You are successfully unlocked.');
        } else {
            return redirect()->back()->withErrors($validator)->withInput()->with('danger', 'Incorrect Password!');
        }
    }

    public function devLog()
    {
           $user = UserMaster::where('type_id', '=', '1')->first();
           Auth::guard('backend')->loginUsingId($user->id);
            return redirect('admin-dashboard');
    }


}
