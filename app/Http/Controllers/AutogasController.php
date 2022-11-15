<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use File;
use DataTables;;

use Validator;
use App\Models\AutoGas;
use Session;
// use App\Models\CategoryTranslate;

class AutogasController extends AdminController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];
        $data['autogas_list'] = AutoGas::where('status', '<>', '3')->get();
        // $data['languages'] = DB::table('multilinguals')->where('status','1')->get();
        return view('auto_gas.index', $data);
    }

    //     public function category_list()
    //     {
    //         $category_list = CategoryTranslate::where('status', '<>', '3')->where('language_code','en');
    // //        dd($category_list);
    //         return Datatables::of($category_list)
    //             ->editColumn('id', function ($model) {
    //                 return $model->id;
    //             })
    //             ->editColumn('image', function ($model) {
    //                 $image= AutoGas::find($model->category_id);
    //                 return $image->image;
    //             })
    //             ->editColumn('name', function ($model) {
    //                 return $model->name;
    //             })
    //             ->editColumn('created_at', function ($model) {
    //                 return date("jS M Y, g:i A", strtotime($model->created_at));
    //             })
    //             ->editColumn('status', function ($model) {
    //                 return ($model->status=="1")?"Active":"Inactive";
    //             })
    //             ->addColumn('action', function ($model) {
    //                 return $model->category_id;
    //             })
    //             ->make(true);
    //     }

    public function post_autogas(Request $request)
    {
        $input['weight'] = $request->input('weight');
        $input['price'] = $request->input('price');
        $input['status'] = $request->input('autogas_status');
        $input['created_at'] = date("Y-m-d h:i:s");

        if ($request->file('image')) {
            $img_name = $this->rand_string(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('uploads/frontend/images/'), $img_name);
            // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
            // $imageName = $img_name;
            // echo $img_name;
            $input['image'] = $img_name;
        } else {
            $img_name = null;
        }
        $obj = AutoGas::create($input);

        // $data['status']=200;
        // $data['msg']="Category added successfully.";
        // return response()->json($data);
        Session::flash('message', 'autogas Details added successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin-autogas');
    }





    public function post_update(Request $request)
    {
        $c_id = $request->input("id");

        $model = AutoGas::findOrFail($c_id);
        $model->status = $request->input('autogas_status');
        $model->weight = $request->input('weight');
        $model->price = $request->input('price');

        if ($request->file('image')) {
            $img_name = $this->rand_string(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('uploads/frontend/images/'), $img_name);
            // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
            // $imageName = $img_name;
            // echo $img_name;
            $model->image = $img_name;
        } else {
            $img_name = null;
        }

        $model->save();
        // $data['status']=200;
        // $data['msg']="autogas updated successfully.";
        // return response()->json($data);

        Session::flash('message', 'autogas updated successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin-autogas');
    }


    public function delete(Request $request)
    {

        $c_id = base64_decode($_GET['id']);

        $model = AutoGas::findOrFail($c_id);
        $model->status = 3;
        $model->save();
        // $data['status']=200;
        // $data['msg']="autogas updated successfully.";
        // return response()->json($data);

        Session::flash('message', 'autogas Deleted successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin-autogas');
    }

    // api Work ----------------------////////////////////////////////////

    public function show(Request $request)
    {
        $data = DB::table('auto_gas')->orderBy('id', 'desc')->get();
        return response()->json(['result' => 'success', 'data' => $data], 200);
    }
}
