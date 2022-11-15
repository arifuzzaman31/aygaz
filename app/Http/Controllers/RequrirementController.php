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
use DB;
use File;
use App\Models\UserMaster;
use App\Models\CategoryTranslate;
use App\Models\Requrirement;
use App\Models\RequestFile;
use App\Models\AssignServiceProvider;


class RequrirementController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
         $data = [];
         $data['categories']= CategoryTranslate::where('status', '1')->where('language_code','en')->get();
         return view('requrirement.index', $data);
     }
     
    public function requrirement_list()
    {
        $requrirement_list = Requrirement::select("requrirements.*",DB::raw("GROUP_CONCAT(categories_translation.name) as cname"))
            ->leftjoin("categories_translation",DB::raw("FIND_IN_SET(categories_translation.category_id,requrirements.category)"),">",DB::raw("'0'"))
                ->where("requrirements.status","<>","3")->where('categories_translation.language_code',"en")->groupBy("requrirements.id");
        return Datatables::of($requrirement_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('category', function ($model) {
                return $model->cname;
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('phone', function ($model) {
                return $model->phone;
            })
             ->editColumn('address', function ($model) {
                 return $model->address;
             })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('status', function ($model) {
                $check= AssignServiceProvider::where("request_id",$model->id)->where("status","1")->count();
                return ($model->status=="1")?(($check > 2)?"<span style='color:green'>Active</span>":"Active"):(($model->status=="2")?"Publish":"Inactive");
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
    
//     public function post_add(Request $request)
//     {
//         $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->first();
//         if (!empty($other_user)) {
//             $data['status']=400;
//             $data['msg']="Email id already in use.";
//         }else{
//             $customerIP = request()->ip();
//             $password = $this->rand_string(8);


//             $input = new UserMaster;
//             $input->type_id = 2;
//             $input->type = $request->type;
//             $input->name = $request->name;
//             $input->password = Hash::make($password);
//             $input->phone = $request->phone;
//             $input->email = $request->email;
//             $input->location = $request->location;
//             $input->category = $request->category;
//             $input->ip_address = $customerIP;
//             $input->status = "1";
//             $input->created_by =  $admin_id = Auth::guard('backend')->user()->id;
//             $email_setting = $this->get_email_data('user_registration_by_admin', array('NAME' => $request->name, 'EMAIL' => $request->email,'PASSWORD' => $password));

//            $email_data = [           
//                'to' => $request->email,
//                'subject' => $email_setting['subject'],
//                'template' => 'signup',
//                'data' => ['message' => $email_setting['body']]
//            ];
// //           $mail=$this->SendMail($email_data);
//            //trigger exception in a "try" block
//             try {
//               $this->SendMail($email_data);
//               $input->save();
//                 $data['status']=200;
//                 $data['msg']="Service provider add successfully.";
//             }

//             //catch exception
//             catch(Exception $e) {
//                 $data['status']=400;
//                 $data['msg']=$e->getMessage();
//             }
            
//         }
//         return response()->json($data);
//     }

    public function edit($id)
    {
        $data=[];
        $data['model'] = $model = Requrirement::findOrFail($id);
        $data['RequestFile'] = RequestFile::where('request_id', $id)->where('status','1')->get();
        
        return view('requrirement.update', $data);
    }

    public function view($id)
    {
        $data=[];
        $data['model'] = $model = Requrirement::findOrFail($id);
        $data['service_provider'] = AssignServiceProvider::where('request_id',$id)->where('status','1')->get()->pluck('service_provider_id')->toArray();
        
        $idsArr = explode(',',$model->category);
        $data['users'] = UserMaster::where('status','1')->whereIn('category',$idsArr)->where("type_id","2")->get();
        
        return view('requrirement.asign_user', $data);
    }

    public function post_assign(Request $request) {
        $data = [];
        $bid=$request->bid;
        $requrirement = Requrirement::findOrFail($bid);
        $send_service_provider_ids=count($request->input('service_provider_id'));
        if($send_service_provider_ids>3)
        {
            $data['status'] = 400;
            $data['msg'] = 'You can select only 3 service provider'; 
            return response()->json($data);
        }else{
            $model= AssignServiceProvider::where('request_id',$bid)->where('status', '1')->get();
            if(count($model) > 0)
            {
                foreach ($model as $m) {
                    $m->status="3";
                    $m->update();
                }
                for($i=0;$i<$send_service_provider_ids;$i++)
                {
                    $privous=AssignServiceProvider::where('request_id',$bid)->where('service_provider_id',$request->input('service_provider_id')[$i])->first();
                    if(!empty($privous))
                    {
                        $privous->status="1";
                        $privous->save();
                    }else{
                        $input = $request->input();
                        $input['request_id']=$bid;
                        $input['service_provider_id']=$request->input('service_provider_id')[$i];
                        $input['created_at']=date("Y-m-d h:i:s");
                        $input['status']='1';
                        AssignServiceProvider::create($input);
                        $users = UserMaster::where('id',$request->input('service_provider_id')[$i])->where('status','1')->first();
                        if(!empty($users))
                        {
                            $array=array(
                                "NAME"=>$users->name,
                                "EMAIL"=>$requrirement->email,
                                "PHONE"=>$requrirement->phone,
                                "TITLE"=>$requrirement->title,
                                "DEADLINE"=>$requrirement->deadline,
                                "BUDGET"=>$requrirement->budget,
                                "DESCRIPTION"=>$requrirement->description,
                                "ADDRESS"=>$requrirement->address,
                                "ZIPCODE"=>$requrirement->zipcode,
                                // "CATEGORY"=>implode(",", $cate)
                            );
                            $email_setting = $this->get_email_data('assign_requriment_request_form', $array);

                               $email_data = [           
                                   'to' => $users->email,
                                   'subject' => $email_setting['subject'],
                                   'template' => 'signup',
                                   'data' => ['message' => $email_setting['body']]
                               ];
                    //           $mail=$this->SendMail($email_data);
                               //trigger exception in a "try" block
                                try {
                                  $this->SendMail($email_data);

                                    $data['status']=200;
                                    $data['msg']="Service provider assign successfully.";
                                }

                                //catch exception
                                catch(Exception $e) {
                                    $data['status']=400;
                                    $data['msg']=$e->getMessage();
                                }

                        }
                    }
                }
                $data['status'] = 200;
                $data['msg'] = 'Service provider assign successfully.';
                return response()->json($data);
            }else{
                for($i=0;$i<$send_service_provider_ids;$i++)
                {
                    $input = $request->input();
                    $input['request_id']=$bid;
                    $input['service_provider_id']=$request->input('service_provider_id')[$i];
                    $input['created_at']=date("Y-m-d h:i:s");
                    $input['status']='1';
                    AssignServiceProvider::create($input);
                    $users = UserMaster::where('id',$request->input('service_provider_id')[$i])->where('status','1')->first();
                    if(!empty($users))
                    {
                        $array=array(
                            "NAME"=>$users->name,
                            "EMAIL"=>$requrirement->email,
                            "PHONE"=>$requrirement->phone,
                            "TITLE"=>$requrirement->title,
                            "DEADLINE"=>$requrirement->deadline,
                            "BUDGET"=>$requrirement->budget,
                            "DESCRIPTION"=>$requrirement->description,
                            "ADDRESS"=>$requrirement->address,
                            "ZIPCODE"=>$requrirement->zipcode,
                            // "CATEGORY"=>implode(",", $cate)
                        );
                        $email_setting = $this->get_email_data('assign_requriment_request_form', $array);

                           $email_data = [           
                               'to' => $users->email,
                               'subject' => $email_setting['subject'],
                               'template' => 'signup',
                               'data' => ['message' => $email_setting['body']]
                           ];
                //           $mail=$this->SendMail($email_data);
                           //trigger exception in a "try" block
                            try {
                              $this->SendMail($email_data);

                                $data['status']=200;
                                $data['msg']="Service provider assign successfully.";
                            }

                            //catch exception
                            catch(Exception $e) {
                                $data['status']=400;
                                $data['msg']=$e->getMessage();
                            }

                    }
                }
                $data['status'] = 200;
                $data['msg'] = 'Service provider assign successfully.';
                return response()->json($data);
            }
        }
        
  
    }

//     public function post_update(Request $request)
//     {
//         $data = [];
//         $id=$request->s_id;
//         $model = UserMaster::findOrFail($request->s_id);
//         $other_user = UserMaster::where('email', $request->input('email'))->where('status', '<>', '3')->where('id','<>',$id)->first();
//         if (!empty($other_user)) {
//             $data['status']=400;
//             $data['msg']="Email id already in use.";
//         }else{
//             $model->type = $request->type;
//             $model->name = $request->name;
//             $model->phone = $request->phone;
//             $model->email = $request->email;
//             $model->location = $request->location;
//             $model->category = $request->category;
//             $model->save();
//             $data['status']=200;
//             $data['msg']="Service provider updated successfully.";
//         }
//         return response()->json($data);
        
//     }

//     function imageUpload(Request $request, $fname,$model) {
//         if ($request->hasFile($fname)) {  //check the file present or not
//             if (file_exists(public_path('storage/uploads/frontend/profile_picture/original/' . $model->profile_picture))) {
//                 File::delete(public_path('storage/uploads/frontend/profile_picture/original/' .$model->profile_picture));
//                 File::delete(public_path('storage/uploads/frontend/profile_picture/preview/' . $model->profile_picture));
//                 File::delete(public_path('storage/uploads/frontend/profile_picture/thumb/' . $model->profile_picture));
//             }
//             $image = $request->file($fname); //get the file
//             $name = $this->rand_string(15) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
//             $destinationPath = public_path('storage/uploads/frontend/profile_picture/original/'); //public path folder dir
//             $path = public_path('storage/uploads/frontend/profile_picture/');
//             Image::make($image->getRealPath())->resize(300, 200)->save($path . 'preview/' . $name);
//             Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
//             $image->move($destinationPath, $name);
//             return $name;
//         }
//     }

//     function fileUpload(Request $request, $fname) {
//         if ($request->hasFile($fname)) {  //check the file present or not
//             $file = $request->file($fname); //get the file
//             $name = $this->rand_string(15) . time() . '.' . $file->getClientOriginalExtension(); //get the  file extention
//             $destinationPath = public_path('uploads/frontend/resume/'); //public path folder dir
//             $file->move($destinationPath, $name);
//             return $name;
//         }
//     }


    

    public function post_update(Request $request)
    {
        $data = [];
        $bid=$request->bid;
        $model = Requrirement::findOrFail($bid);
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:250',
            'description' => 'required',
            'deadline' => 'required',
            'budget' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'name' => 'required',
            'address' => 'required',
            'zipcode' => 'required',
            'status' => 'required',
        ]);
        $validator->after(function($validator)use ($request) {
            if (!isset($request->AllImages['image'])) {
                $validator->errors()->add('AllImages', 'The images field is required.');
            }
        });
        if ($validator->passes()) {
            $input = $request->input();
            $input['updated_at']=date("Y-m-d h:i:s");
            $model->update($input);
            
            if (isset($input['AllImages']['image']) && $input['AllImages']['image'] !== NULL && !empty($bid)) {
                $images = $input['AllImages'];
                $checkExistimage = RequestFile::where('request_id', $model->id)->where('status', '1')->get();
                if (sizeof($checkExistimage) > 0) {
                    foreach ($checkExistimage as $image) {
                        $image->update(['status' => '3']);
                    }
                }
                foreach ($images['image'] AS $i => $image) {
                   $input = [];
                    $input['request_id'] = $model->id;
                    $input['file_name'] = $image;
                    $input['status'] = '1';
                    $checkImageName = RequestFile::where(['request_id' => $model->id, 'file_name' => $image])->first();
                    if (!empty($checkImageName)) {
                        $checkImageName->update($input);
                    } else {
                        RequestFile::create($input);
                    }

                }
            }

            $data['status'] = 200;
            $data['msg'] = 'Requrirement update successfully.';
            return response()->json($data);
        }else{
//            print_r($validator->error());exit;
            return response()->json(['error' => $validator->errors()], 422);
        }
    }


    public function delete(Request $request) {
        if($request->ajax())
        {
            $data=[];
            if(!empty($request->input("user")))
            {
                $id=$request->input("user");
                $model = Requrirement::findOrFail($id);
                if (!empty($model) && $model->status != '3') {
                    $model->status = '3';
                    $checkExistimage = RequestFile::where('request_id', $model->id)->where('status', '1')->get();
                    if (sizeof($checkExistimage) > 0) {
                        foreach ($checkExistimage as $image) {
                            $image->status="3";
                            $image->update();
                        }
                    }
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
                        $model = Requrirement::findOrFail($id);
                        $model->status = '3';
                        $model->save();
                    }
                }
                $data['status']=200;
            }
            return response()->json($data); 
        }
    }

// 

    public function showimages(Request $request) {
        if ($request->ajax()) {
        $data_msg = [];
        $images = [];
        $bid = $request->input('bid');
        $productImages = RequestFile::where('request_id', $bid)->where("request_type","1")->where('status', '1')->get();
        //print_r($productImages);exit;
        if (sizeof($productImages) > 0) {
        foreach ($productImages as $key => $image) {
        $images[$key]['name'] = $image->file_name;
        $targetFile = public_path('uploads/admin/request_image/original/' . $image->file_name);
        $images[$key]['size'] = filesize($targetFile);
        //$images[$key]['size'] = filesize($targetFile);
        }
        $data_msg['res'] = 1;
        $data_msg['images'] = $images;
        }
        return response()->json($data_msg);
        }
    }

    public function upload_request_photo(Request $request)
    {
           if ($request->ajax()) {
           $file = $request->file('file');
           $mime = $file->getMimeType();
           $data_msg['file_name'] = $this->imageUpload2($request, 'file');
           $data_msg['modelName'] = 'AllImages';
           $status = 200;

           return response()->json($data_msg, $status);
        }
    
    }

    function imageUpload2(Request $request, $fname) {
        if ($request->hasFile($fname)) { //check the file present or not
        $image = $request->file($fname); //get the file
        $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the file extention
        $destinationPath = public_path('uploads/admin/request_image/original/'); //public path folder dir
        $path = public_path('uploads/admin/request_image/');
        Image::make($image->getRealPath())->resize(300, 200)->save($path . 'preview/' . $name);
        Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
        $image->move($destinationPath, $name);
        return $name;
        }
    }

    public function remove_request_photo(Request $request)
    {
        if ($request->ajax()) {
        $data_msg = [];
        $file_name = $request->input('file_name');
        if (!empty($file_name)) {
        $path1 = public_path('uploads/admin/request_image/original/' . $file_name);
        $path2 = public_path('uploads/admin/request_image/preview/' . $file_name);
        $path3 = public_path('uploads/admin/request_image/thumb/' . $file_name);
        if (file_exists($path1)) {
        unlink($path1);
        unlink($path2);
        unlink($path3);
        $data_msg['status']="success";
        }   
       }
      return response()->json($data_msg);
      }  
    }

 }
