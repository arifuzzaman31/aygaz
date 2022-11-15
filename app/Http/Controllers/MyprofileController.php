<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use App\Models\UserMaster;

class MyprofileController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_myprofile() {
        $data['active_tab'] = (isset($_GET['tab']) && $_GET['tab'] != "") ? $_GET['tab'] : 'tab_1';
        $model = new UserMaster;
        $admin_user = Auth()->guard('backend')->user();
        $data['model'] = $admin_user;
        return view('myprofile.index', $data);
    }

    public function post_myprofile(Request $request) {
        $data = [];
        $admin_user = Auth()->guard('backend')->user();
        if (isset($_POST['tab']) && $_POST['tab'] == 'tab_1') {
            $data['tab'] = 'tab_1';
            $admin_user->first_name = $request->input('fname');
            $admin_user->last_name = $request->input('lname');
            $admin_user->updated_at = date('Y-m-d H:i:s');
            if ($request->file('avatar')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('avatar')->getClientOriginalExtension();
                $file = $request->file('avatar');
                $file->move(public_path('uploads/admin/profile_picture/original/'), $img_name);
                Image::make(public_path('uploads/admin/profile_picture/original/') . $img_name)->resize(500, 500)->save(public_path('uploads/admin/profile_picture/preview/') . $img_name);
                Image::make(public_path('uploads/admin/profile_picture/original/') . $img_name)->resize(200, 200)->save(public_path('uploads/admin/profile_picture/thumb/') . $img_name);
                $admin_user->profile_picture = $img_name;
            }
            $admin_user->save();
            $data['status']=200;
            $data['msg']="Profile updated successfully.";
        }
        if (isset($_POST['tab']) && $_POST['tab'] == 'tab_2') {
            $data['tab'] = 'tab_2';
            if (Hash::check($request->input('currentpassword'), $admin_user->password) != 1){
                $data['status']=400;
                $data['msg']="Current password is incorrect.";
            } else {
                $admin_user->password = Hash::make($request->input('newpassword'));
                $admin_user->updated_at = date('Y-m-d H:i:s');
                $admin_user->save();
                $data['status']=200;
                $data['msg']="Password changed successfully.";
            }
        }
        return response()->json($data);
    }
    
    public function post_change_email(Request $request)
    {
        if($request->ajax())
        {
            $data=[];
            $other_user = UserMaster::where('email', $request->input('emailaddress'))->where('status', '<>', '3')->where('id', '<>', Auth()->guard('backend')->user()->id)->first();
            if (!empty($other_user)) {
                $data['status']=400;
                $data['msg']="Email id already in use.";
            }else{
                $admin_user = Auth()->guard('backend')->user();
                if (Hash::check($request->input('confirmemailpassword'), $admin_user->password) != 1){
                    $data['status']=400;
                    $data['msg']="Incorrect Password";
                } else {
                    $admin_user->email = $request->input('emailaddress');
                    $admin_user->save();
                    $data['status']=200;
                    $data['msg']="Email chnage successfully";
                    $data['email']=$request->input('emailaddress');
                }
            }
            return response()->json($data);
        }
    }

}
