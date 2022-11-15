<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use DB;
use File;
use DataTables;;
use Validator;
use App\Models\Category;
use App\Models\CategoryTranslate;

class CategoryController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['category_list'] = Category::where('status', '<>', '3')->get();
        $data['languages'] = DB::table('multilinguals')->where('status','1')->get();
        return view('category.index', $data);
    }

    public function category_list()
    {
        $category_list = CategoryTranslate::where('status', '<>', '3')->where('language_code','en');
//        dd($category_list);
        return Datatables::of($category_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('image', function ($model) {
                $image= Category::find($model->category_id);
                return $image->image;
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->editColumn('status', function ($model) {
                return ($model->status=="1")?"Active":"Inactive";
            })
            ->addColumn('action', function ($model) {
                return $model->category_id;
            })
            ->make(true);
    }

    public function post_category(Request $request)
    {
        if($request->ajax())
        {
            $data=[];
            $rule = [];
            $message = [];
            $lang = DB::table('multilinguals')->where('status','1')->get();
            $rule["image"]='required|mimes:png,jpg,jpeg';
            foreach($lang as $l){
                $rule[$l->lang_code] = 'required';
                $message[$l->lang_code.'.required'] = "Category Name is required";
            }
            $request->validate($rule,$message);
            $input = $request->input();
            $input['parent_id']="0";
            $destinationPath = 'public/uploads\admin\category_image';
            if($request->hasFile('image')) {
                $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
                $file = $request->file('image');
                $file->move(public_path('uploads/admin/category_image/'), $img_name);
                $input['image']=$img_name;
            }else{
                $input['image']="";
            }
            $input['status']=$request->input('category_status');
            $input['created_at']=date("Y-m-d h:i:s");
            $obj=Category::create($input);
            foreach($lang as $l){
                $translate = new CategoryTranslate();
                $translate->status = $request->input('category_status');
                $translate->name = $request->input($l->lang_code);
                $translate->language_code = $l->lang_code;
                $translate->category_id = $obj->id;
                $translate->save();
            }
            $data['status']=200;
            $data['msg']="Category added successfully.";
            return response()->json($data); 
        }
    }

    public function edit($id)
    {
        $data=[];
        $data['c_id'] = $id;
        $data['languages'] = CategoryTranslate::select('categories.image','categories_translation.category_id','categories_translation.status','categories_translation.name','multilinguals.lang','multilinguals.lang_code')
        ->join('multilinguals','categories_translation.language_code','multilinguals.lang_code')
        ->join('categories','categories_translation.category_id','categories.id')
        ->where('category_id',$id)->where('categories_translation.status','<>','3')->get();
        return view('category.update', $data);
    }

    public function post_update(Request $request)
    {
        $data=[];
        $c_id = $request->input("c_id");
        $lang = CategoryTranslate::where('category_id',$c_id)->get();
        foreach($lang as $l){
            $rules[$l->language_code] = 'required';
            $message[$l->language_code.'.required'] = "Category Name is required";
        }
        $request->validate($rules,$message);
        foreach($lang as $l){
            CategoryTranslate::find($l->id)->update([
                'status'=>$request->input('category_status'),
                'name'=>$request->input($l->language_code),
                'updated_at'=>Carbon::now()
            ]);
        }
        $model = Category::findOrFail($c_id);
        if($request->hasFile('image')) {
            if (file_exists(public_path('uploads/admin/category_image/' . $model->image))) {
                File::delete(public_path('uploads/admin/category_image/' .$model->image));
            }
            $img_name = $this->rand_string(12) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('uploads/admin/category_image/'), $img_name);
            $model->image=$img_name;
        }
        $model->status=$request->input('category_status');
        $model->save();
        $data['status']=200;
        $data['msg']="Category updated successfully.";
        return response()->json($data); 
    }
    
    public function delete(Request $request) {
        if($request->ajax())
        {
            $data=[];
            if(!empty($request->input("category")))
            {
                $id=$request->input("category");
                $model = Category::findOrFail($id);
                if (!empty($model) && $model->status != '3') {
                    $model->status = '3';
                    $model->save();
                    CategoryTranslate::where('category_id',$id)->update([
                        'status'=>'3',
                        'updated_at'=>Carbon::now()
                    ]);
                    $data['status']=200;
                } else {
                    $data['status']=400;
                    $data['msg']="Oops. Something went wrong.";
                }
            }else{
                $ids=$request->input("categories");
                $categories= explode(",",$ids);
//                dd($categories);
                foreach($categories as $id)
                {
                    if($id!="0")
                    {
                        $model = Category::findOrFail($id);
                        $model->status = '3';
                        $model->save();
                        CategoryTranslate::where('category_id',$id)->update([
                            'status'=>'3',
                            'updated_at'=>Carbon::now()
                        ]);
                    }
                }
                $data['status']=200;
            }
            return response()->json($data); 
        }
    }

}
