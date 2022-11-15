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
use App\Models\Testimonial;
use App\Models\MultiLingul;


class TestimonialController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
         $data = [];
         $data['languages']= MultiLingul::where('status', '1')->get();
         return view('testimonial.index', $data);
     }
     
    public function testimonial_list()
    {
        $testimonial_list = Testimonial::where("status","<>","3");
        return Datatables::of($testimonial_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('image', function ($model) {
                return $model->image;
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
            ->make(true);
    }
    
    public function post_testimonial(Request $request)
    {
        $rule = [];
        $message = [];
        $rule["name"]='required';
        $rule["location"]='required';
        $rule["image"]='required|mimes:png,jpg,jpeg';
        $rule["rating"]='required';
        $rule["description"]='required';
        $request->validate($rule,$message);
        $input=$request->input();
        if($request->hasFile('image')) {
            $image=$request->file('image');
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/admin/testimonial/original/'); //public path folder dir
            $path = public_path('uploads/admin/testimonial/');
            Image::make($image->getRealPath())->resize(317, 300)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            $input['image'] = $name;
        }
        $input['status']="1";
        $input['created_at']=date("Y-m-d h:i:s");
        Testimonial::create($input);
        $data['status']=200;
        $data['msg']="Testimonial added successfully.";
        return response()->json($data);
    }

    public function edit_testimonial($id)
    {
        $data=[];
        // $data['languages']= MultiLingul::where('status', '1')->get();
        $data['testimonial'] = Testimonial::find($id);
        return view('testimonial.update', $data);
    }

    public function edit_post_testimonial(Request $request)
    {
        $data = [];
        $rule = [];
        $message = [];
        $rule["name"]='required';
        $rule["location"]='required';
        // $rule["image"]='required|mimes:png,jpg,jpeg';
        $rule["rating"]='required';
        $rule["description"]='required';
        $request->validate($rule,$message);
        $id=$request->b_id;
        $model = Testimonial::findOrFail($id);
        
        $model->name = $request->name;
        $model->location = $request->location;
        $model->rating = $request->rating;
        $model->description = $request->description;
        if($request->hasFile('image')) {
            $image=$request->file('image');
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/admin/testimonial/original/'); //public path folder dir
            $path = public_path('uploads/admin/testimonial/');
            Image::make($image->getRealPath())->resize(317, 300)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            $model->image = $name;
        }
        $model->save();
        $data['status']=200;
        $data['msg']="Testimonial updated successfully.";
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
                $model = Testimonial::findOrFail($id);
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
                        $model = Testimonial::findOrFail($id);
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
