<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Charts;
// use DB;
use Illuminate\Support\Facades\DB;
use App\Models\UserMaster;
use App\Models\Hirefixer;
use App\Models\Requrirement;
use App\Models\AssignServiceProvider;


class DashboardController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index() {
        $data = [];
        $data['request_forwarded']=AssignServiceProvider::where('status','1')->groupBy("request_id")->get();
        $data['private_tenders_solved']=Hirefixer::where('status','4')->get();
        $data['outstanding_private_tenders']=Hirefixer::where('status','2')->get();
        $data['private_tenders_solved_amount']=Hirefixer::select(DB::raw('SUM(budget) AS budget'))->where('status','4')->first();
        $data['outstanding_private_tenders_amount']=Hirefixer::select(DB::raw('SUM(budget) AS budget'))->where('status','2')->first();
        $data['recent_request']= Requrirement::select("requrirements.*","categories_translation.name as cname")
                ->leftjoin("categories_translation",DB::raw("FIND_IN_SET(categories_translation.category_id,requrirements.category)"),">",DB::raw("'0'"))
                ->where('categories_translation.language_code',"en")->where('requrirements.status','1')->orderBy("requrirements.created_at",'desc')->limit(10)->get();
        $data['recent_tenders']= Hirefixer::where('status','1')->orderBy("deadline",'desc')->limit(10)->get();
//        print_r($data['outstanding_private_tenders_amount']->budget);exit;

        $data['Totalorders'] = DB::table('cylinder_orders')->count();
        $data['TotalCylinders'] = DB::table('gas_cylinder')->where('status', '1')->count();
        return view('dashboard.index', $data);
    }

    public function requested_forworded_chart(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $year = !empty($request->input('year')) ? $request->input('year') : date('Y');
            $month = $request->has('month') ? $request->input('month') : '';
            $registeredId = $request->input('element');
            $data_set1 = [];
            $label = [];

            if (!empty($month)) {
                $start_date = "01-" . $month . "-" . $year;
                $start_time = strtotime($start_date);
                $end_time = strtotime("+1 month", $start_time);
                $s = $start_time;
                for ($i = $start_time; $i < $end_time; $i += 86400) {
                    $start_date = date('Y-m-d', $s);
                    $label[] = $start_date;
                    $data_set1[] = AssignServiceProvider::where('status', '1')->whereDate('created_at', $start_date)->count('id');
                    $s += 86400;
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $month = date('m', strtotime(date("d-" . $i . "-" . $year)));
                    $details_year = date('Y', strtotime(date("d-" . $i . "-" . $year)));
                    $label[] = date('F,Y', strtotime(date("d-" . $i . "-" . $year)));
                    $hasUser = AssignServiceProvider::where('status', '1')->whereMonth('created_at', '=', $month)->whereYear('created_at', $details_year)->count('id');
                    if (!empty($hasUser)) {
                        $data_set1[] = $hasUser;
                    } else {
                        $data_set1[] = 0;
                    }
                }
            }
            $heading = 'Request forwarded';
//            print_r($data_set1);
//            print_r($label);
//            print_r($heading);
            $data['content'] = view('dashboard._chart', ['data_set1' => $data_set1, 'label' => $label, 'heading' => $heading, 'id' => $registeredId, 'for' => 1])->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

    public function tender_posted_chart(Request $request)
    {
        if ($request->ajax()) {
            $data = [];
            $year = !empty($request->input('year')) ? $request->input('year') : date('Y');
            $month = $request->has('month') ? $request->input('month') : '';
            $registeredId = $request->input('element');
            $data_set1 = [];
            $label = [];

            if (!empty($month)) {
                $start_date = "01-" . $month . "-" . $year;
                $start_time = strtotime($start_date);
                $end_time = strtotime("+1 month", $start_time);
                $s = $start_time;
                for ($i = $start_time; $i < $end_time; $i += 86400) {
                    $start_date = date('Y-m-d', $s);
                    $label[] = $start_date;
                    $data_set1[] = Hirefixer::whereDate('created_at', $start_date)->count('id');
                    $s += 86400;
                }
            } else {
                for ($i = 1; $i <= 12; $i++) {
                    $month = date('m', strtotime(date("d-" . $i . "-" . $year)));
                    $details_year = date('Y', strtotime(date("d-" . $i . "-" . $year)));
                    $label[] = date('F,Y', strtotime(date("d-" . $i . "-" . $year)));
                    $hasUser = Hirefixer::whereMonth('created_at', '=', $month)->whereYear('created_at', $details_year)->count('id');
                    if (!empty($hasUser)) {
                        $data_set1[] = $hasUser;
                    } else {
                        $data_set1[] = 0;
                    }
                }
            }
            $heading = 'Tender Posted';
//            print_r($data_set1);
//            print_r($label);
//            print_r($heading);
            $data['content'] = view('dashboard._chart', ['data_set1' => $data_set1, 'label' => $label, 'heading' => $heading, 'id' => $registeredId, 'for' => 2])->render();
            $data['status'] = 200;
            return response()->json($data);
        }
    }

    public function dashboard_request(Request $request)
    {
        if($request->ajax())
        {
            $type=$request->input('type');
            $datepicker=$request->input('datepicker');

            $request= AssignServiceProvider::select('*')->join("user_master","user_master.id","assign_service_provider.service_provider_id");
            if(!empty($type))
            {
                $request->where("user_master.type",$type);
            }
            if(!empty($datepicker))
            {
                $dates= explode("-", $datepicker);
                $request->whereBetween('assign_service_provider.created_at', [date("Y-m-d", strtotime($dates[0])), date("Y-m-d", strtotime($dates[1]))]);
            }
            $item=$request->where('assign_service_provider.status','1')->groupBy("assign_service_provider.request_id")->get();
            $data['total']=count($item);
            return response()->json($data);
        }
    }

}
