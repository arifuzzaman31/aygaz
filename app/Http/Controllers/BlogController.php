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
use App\Models\Blog;
use App\Models\MultiLingul;


class BlogController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
         $data = [];
         $data['languages']= MultiLingul::where('status', '1')->get();
         return view('blog.index', $data);
     }
     
    public function blog_list()
    {
        $blog_list = Blog::where("status","<>","3");
        return Datatables::of($blog_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('title', function ($model) {
                return $model->title;
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
    
    public function post_blog(Request $request)
    {
        $rule = [];
        $message = [];
        $rule["image"]='required|mimes:png,jpg,jpeg';
        $rule["description"]='required';
        $request->validate($rule,$message);
        $input=$request->input();
        if($request->hasFile('image')) {
            $image=$request->file('image');
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/admin/blog/original/'); //public path folder dir
            $path = public_path('uploads/admin/blog/');
            Image::make($image->getRealPath())->resize(317, 300)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            $input['image'] = $name;
        }
        $input['status']="1";
        $input['created_at']=date("Y-m-d h:i:s");
        Blog::create($input);
        $data['status']=200;
        $data['msg']="Blog added successfully.";
        return response()->json($data);
    }

    public function edit_blog($id)
    {
        $data=[];
        $data['languages']= MultiLingul::where('status', '1')->get();
        $data['blog'] = Blog::find($id);
        return view('blog.update', $data);
    }

    public function edit_post_blog(Request $request)
    {
        $data = [];
        $rule = [];
        $message = [];
        $rule["image"]='mimes:png,jpg,jpeg';
        $rule["description"]='required';
        $rule["title"]='required';
        $rule["lang_code"]='required';
        $request->validate($rule,$message);
        $id=$request->b_id;
        $model = Blog::findOrFail($id);
        
        $model->title = $request->title;
        $model->lang_code = $request->lang_code;
        $model->description = $request->description;
        if($request->hasFile('image')) {
            $image=$request->file('image');
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/admin/blog/original/'); //public path folder dir
            $path = public_path('uploads/admin/blog/');
            Image::make($image->getRealPath())->resize(317, 300)->save($path . 'preview/' . $name);
            Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
            $image->move($destinationPath, $name);
            $model->image = $name;
        }
        $model->save();
        $data['status']=200;
        $data['msg']="Blog updated successfully.";
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
                $model = Blog::findOrFail($id);
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
                        $model = Blog::findOrFail($id);
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
