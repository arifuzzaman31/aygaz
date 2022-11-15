<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cylinder;
use Illuminate\Support\Facades\DB;
use Validator;
use Session;

class OrdersController extends Controller
{


    // ============================================= Web Part ==============================================


    public function index()
    {
        $data = [];
        $data['orders'] = DB::table('cylinder_orders')
            ->join('gas_cylinder', 'cylinder_orders.cylinder_id', '=', 'gas_cylinder.id')
            ->select('cylinder_orders.*', 'gas_cylinder.weight', 'gas_cylinder.price')
            ->get();
        return view('orders.index', $data);
    }


    public function orders_status(Request $request)
    {

        $update = DB::table('cylinder_orders')->where('id', $request->id)->update([
            'status' => $request->status,
        ]);
        // return $request->id;
        Session::flash('message', 'Status Updated');
        Session::flash('alert-class', 'alert-success');
        return redirect(Route('admin-orders'));
    }


    // ==================================================== Api's Part ========================================
    public function cylinderList()
    {
        $data = [];
        $data = Cylinder::where('status', '<>', '3')->get();
        // return view('cylinder.index', $data);
        return response()->json(['result' => 'success', 'data' => $data], 200);
    }


    public function storeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'service_type' => 'required',
            'cylinder_id' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'thana' => 'required',
            'district' => 'required',
            'message' => 'nullable',
        ]);
        if ($validator->passes()) {
            $store = DB::table('cylinder_orders')->insert([
                'service_type' => $request->service_type,
                'cylinder_id' => $request->cylinder_id,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'thana' => $request->thana,
                'district' => $request->district,
                'message' => $request->message,
            ]);
            if ($store) {
                return response()->json(['result' => 'success', 'data' => 'Order Details Save Successfully'], 200);
            } else {
                return response()->json(['result' => 'error', 'data' => 'Please Try Again'], 400);
            }
        } else {
            return response()->json(['result' => 'errors', 'data' => $validator->errors()], 400);
        }
    }
}
