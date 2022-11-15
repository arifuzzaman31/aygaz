<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use DataTables;
use Carbon\Carbon;
use App\Models\Email;

class EmailController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function get_email() {
        $data = [];
        return view('admin_email.admin_email_index', $data);
    }
    
    public function email_list(Request $request)
    {
        $email_list = Email::select('id','about','subject','body','variable','updated_at');
         
        return Datatables::of($email_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('about', function ($model) {
                return $model->about;
            })
            ->editColumn('body', function ($model) {
                return $model->body;
            })
            ->editColumn('variable', function ($model) {
                return $model->variable;
            })
            ->editColumn('subject', function ($model) {
                return $model->subject;
            })
            ->editColumn('updated_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->updated_at));
            })
            ->addColumn('action', function ($model) {
                return $model->id;
            })
            ->make(true);
    }

    public function get_update_email($id) {
       // return $id;
        $data = [];
        $data['model'] = Email::where('id',$id)->get();

        return view('admin_email.update', $data);
    }

    public function post_update_email(Request $request, $id) {

        
            $data = [];
            $model = Email::findOrFail($id);

//            return dd($id);

            $validator = Validator::make($request->all(), [
                        'about' => 'required|max:255',
                        'subject' => 'required|max:255',
                        'body' => 'required',
                        
            ]);
            if ($validator->passes()) {
                $model->about = $request->input('about');
                $model->subject = $request->input('subject');
                $model->body = $request->input('body');
                 
                $model->updated_at = Carbon::now();
                $model->save();
            }

            $data['status']=200;
            $data['msg']="Content updated successfully.";
            return response()->json($data); 
       
    }


    public function index() {
        $data = [];
        $data['about'] = $about = isset($_GET['about']) ? $_GET['about'] : "";
        $data['subject'] = $subject = isset($_GET['subject']) ? $_GET['subject'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = Email::where('about', 'like', '%' . $about . '%');
        if ($about != "") {
            $query->where('about', 'like', '%' . $about . '%');
        }
        if ($subject != "") {
            $query->where('subject', 'like', '%' . $subject . '%');
        }
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('admin::email.index', $data);
    }

    public function view($id) {
        $data = [];
        $data['model'] = Email::findOrFail($id);
        return view('admin::email.view', $data);
    }

    public function get_update($id) {
        $data = [];
        $data['model'] = Email::findOrFail($id);
        return view('admin::email.update', $data);
    }

    public function post_update(Request $request, $id) {

       
        $data = [];
        $model = Email::findOrFail($id);
        $validator = Validator::make($request->all(), [
                    'about' => 'required|max:255',
                    'subject' => 'required|max:255',
                    'body' => 'required',
        ]);
        if ($validator->passes()) {
            $model->about = $request->input('about');
            $model->subject = $request->input('subject');
            $model->body = $request->input('body');
            $model->updated_at = date('Y-m-d H:i:s');
            $model->save();
            $request->session()->flash('success', 'Content updated successfully.');
        }
        return redirect()->route('admin-updateemail', ['id' => $id])->withErrors($validator)->withInput();
    }

}
