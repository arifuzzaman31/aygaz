<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use DataTables;
use Validator;
use File;
use App\Models\UserMaster;
use App\Models\Country;
use App\Models\Language;
use App\Models\Skill;
use App\Models\Category;
use App\Models\CategoryTranslate;
use App\Models\UserCategory;
use App\Models\UserSkill;
use App\Models\PaymentDetail;
use App\Models\UserFollower;


class ServiceProviderController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
         $data = [];
         $data['categories']= CategoryTranslate::where('status', '1')->where('language_code','en')->get();
         return view('service_provider.index', $data);
     }
     
    public function user_list(Request $request)
    {
        $search=$request->input('search');
        $items = UserMaster::select("user_master.*","categories_translation.name as c_name")
                ->join("categories_translation","user_master.category","categories_translation.category_id")->where('categories_translation.language_code',"en")->where('type_id','2');
        if(!empty($search['value']))
        {
            if($search['value']=="Open" || $search['value']=="Assign")
            {
                $user_list=$items->where('user_master.request_status', $search['value'])->where('user_master.status','<>', '3');
            }else{
                $user_list=$items->where('user_master.status','<>', '3');
            }
        }else{
            $user_list=$items->where('user_master.status','<>', '3');
        }
        return Datatables::of($user_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('type', function ($model) {
                return $model->type;
            })
             ->editColumn('category', function ($model) {
                 return $model->c_name;
             })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('status', function ($model) {
                return ($model->status=="1")?"Active":"Inactive";
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                return $model->id;
            })
            ->rawColumns(['status', 'action'])
            ->make(true);
    }
    
    public function post_add(Request $request)
    {
        $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->first();
        if (!empty($other_user)) {
            $data['status']=400;
            $data['msg']="Email id already in use.";
        }else{
            $customerIP = request()->ip();
            $password = $this->rand_string(8);


            $input = new UserMaster;
            $input->type_id = 2;
            $input->type = $request->type;
            $input->name = $request->name;
            $input->password = Hash::make($password);
            $input->phone = $request->phone;
            $input->email = $request->email;
            $input->location = $request->location;
            $input->category = $request->category;
            $input->ip_address = $customerIP;
            $input->status = "1";
            $input->created_by =  $admin_id = Auth::guard('backend')->user()->id;
            $email_setting = $this->get_email_data('user_registration_by_admin', array('NAME' => $request->name, 'EMAIL' => $request->email,'PASSWORD' => $password));

           $email_data = [           
               'to' => $request->email,
               'subject' => $email_setting['subject'],
               'template' => 'signup',
               'data' => ['message' => $email_setting['body']]
           ];
//           $mail=$this->SendMail($email_data);
           //trigger exception in a "try" block
            try {
              $this->SendMail($email_data);
              $input->save();
                $data['status']=200;
                $data['msg']="Service provider add successfully.";
            }

            //catch exception
            catch(Exception $e) {
                $data['status']=400;
                $data['msg']=$e->getMessage();
            }
            
        }
        return response()->json($data);
    }

    public function edit($id)
    {
        $data=[];
        $data['model'] = $model = UserMaster::findOrFail($id);
        $data['categories'] = CategoryTranslate::where('status', '1')->where('language_code','en')->get();
        
        return view('service_provider.update', $data);
    }

    public function post_update(Request $request)
    {
        $data = [];
        $id=$request->s_id;
        $model = UserMaster::findOrFail($request->s_id);
        $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->where('id','<>',$id)->first();
        if (!empty($other_user)) {
            $data['status']=400;
            $data['msg']="Email id already in use.";
        }else{
            $model->type = $request->type;
            $model->name = $request->name;
            $model->phone = $request->phone;
            $model->email = $request->email;
            $model->location = $request->location;
            $model->category = $request->category;
            $model->status = $request->status;
            $model->save();
            $data['status']=200;
            $data['msg']="Service provider updated successfully.";
        }
        return response()->json($data);
        
    }

    function imageUpload(Request $request, $fname,$model) {
        if ($request->hasFile($fname)) {  //check the file present or not
            if (file_exists(public_path('storage/uploads/frontend/profile_picture/original/' . $model->profile_picture))) {
                File::delete(public_path('storage/uploads/frontend/profile_picture/original/' .$model->profile_picture));
                File::delete(public_path('storage/uploads/frontend/profile_picture/preview/' . $model->profile_picture));
                File::delete(public_path('storage/uploads/frontend/profile_picture/thumb/' . $model->profile_picture));
            }
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('storage/uploads/frontend/profile_picture/original/'); //public path folder dir
            $path = public_path('storage/uploads/frontend/profile_picture/');
            Image::make($image->getRealPath())->resize(300, 200)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            return $name;
        }
    }

    function fileUpload(Request $request, $fname) {
        if ($request->hasFile($fname)) {  //check the file present or not
            $file = $request->file($fname); //get the file
            $name = $this->rand_string(15) . time() . '.' . $file->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/frontend/resume/'); //public path folder dir
            $file->move($destinationPath, $name);
            return $name;
        }
    }

    public function delete(Request $request) {
        if($request->ajax())
        {
            $data=[];
            if(!empty($request->input("user")))
            {
                $id=$request->input("user");
                $model = UserMaster::findOrFail($id);
                if (!empty($model) && $model->status != '3') {
                    $model->status = '3';
                    $model->save();
                    $data['status']=200;
                } else {
                    $data['status']=400;
                    $data['msg']="Oops. Something went wrong.";
                }
            }else{
                $ids=$request->input("users");
                $users= explode(",",$ids);
//                dd($categories);
                foreach($users as $id)
                {
                    if($id!="0")
                    {
                        $model = UserMaster::findOrFail($id);
                        $model->status = '3';
                        $model->save();
                    }
                }
                $data['status']=200;
            }
            return response()->json($data); 
        }
    }

 }
