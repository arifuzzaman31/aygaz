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
use App\Models\Cylinder;
use Session;
// use App\Models\CategoryTranslate;

class CylinderController extends AdminController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];
        $data['cylinder_list'] = Cylinder::where('status', '<>', '3')->get();
        // $data['languages'] = DB::table('multilinguals')->where('status','1')->get();
        return view('cylinder.index', $data);
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
    //                 $image= Cylinder::find($model->category_id);
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

    public function post_cylinder(Request $request)
    {
        $input['weight'] = $request->input('weight');
        $input['price'] = $request->input('price');
        $input['status'] = $request->input('cylinder_status');
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
        $obj = Cylinder::create($input);

        // $data['status']=200;
        // $data['msg']="Category added successfully.";
        // return response()->json($data);
        Session::flash('message', 'Cylinder Details added successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin-cylinder');
    }





    public function post_update(Request $request)
    {
        $c_id = $request->input("id");

        $model = Cylinder::findOrFail($c_id);
        $model->status = $request->input('cylinder_status');
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
        // $data['msg']="Cylinder updated successfully.";
        // return response()->json($data);

        Session::flash('message', 'Cylinder updated successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin-cylinder');
    }


    public function delete(Request $request)
    {

        $c_id = base64_decode($_GET['id']);

        $model = Cylinder::findOrFail($c_id);
        $model->status = 3;
        $model->save();
        // $data['status']=200;
        // $data['msg']="Cylinder updated successfully.";
        // return response()->json($data);

        Session::flash('message', 'Cylinder Deleted successfully');
        Session::flash('alert-class', 'alert-success');
        return redirect('admin-cylinder');
    }


    // Api dealership_opportunity Create Api
    public function dealership_opportunity(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dealer_name' => 'required',
            'contact_person' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'thana' => 'required',
            'district' => 'required',
            'monthly_sales_volume' => 'required',
            'coverage' => 'required',
        ]);
        if ($validator->passes()) {
            $insert = DB::table('dealership_opportunity')->insert([
                'dealer_name' => $request->dealer_name,
                'contact_person' => $request->contact_person,
                'phone' => $request->phone,
                'address' => $request->address,
                'thana' => $request->thana,
                'district' => $request->district,
                'monthly_sales_volume' => $request->monthly_sales_volume,
                'coverage' => $request->coverage
            ]);
            return response()->json(['result' => 'Success', 'data' => 'Successfully Saved Details.'], 200);
        } else {
            return response()->json(['result' => 'errors', 'data' => $validator->errors()], 400);
        }
    }


    public function dealership_View(Request $request)
    {
        $data = DB::table('dealership_opportunity')->orderBy('id', 'desc')->get();
        return view('dealership.index', ['data' => $data]);
    }


    public function dealership_status(Request $request)
    {
        $data = DB::table('dealership_opportunity')->where('id', $request->id)->update([
            'status' => $request->status
        ]);
        Session::flash('message', 'Status Updated');
        Session::flash('alert-class', 'alert-success');
        return redirect(Route('admin-dealership_opportunity'));
    }
}
