<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use Validator;
use DB;
use DataTables;
use Illuminate\Support\Facades\Auth;
use App\Models\Faq;
use App\Models\FaqTranslate;

class FaqController extends AdminController {

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(Request $request) {
        $data = [];
        $data['languages'] = DB::table('multilinguals')->where('status','1')->get();
        if($request->ajax())
        {
            $faq_list = FaqTranslate::where('status', '<>', '3')->where('language_code','en');
//        dd($category_list);
        return Datatables::of($faq_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('question', function ($model) {
                return $model->question;
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
        return view('faq.index', $data);
    }

    public function get_create() {
        $data = [];
        return view('admin::faq.create', $data);
    }

    public function post_create(Request $request) {
        $rule = [];
        $message = [];
        $lang = DB::table('multilinguals')->where('status','1')->get();
        foreach($lang as $l){
            $rule["question_".$l->lang_code] = 'required';
            $message["question_".$l->lang_code.'.required'] = "Question is required";
            $rule["answer_".$l->lang_code] = 'required';
            $message["answer_".$l->lang_code.'.required'] = "Answer is required";
        }
        $request->validate($rule,$message);
//        $validator = Validator::make($request->all(), [
//                    'question' => 'required',
//                    'answer' => 'required',
//        ]);
//        if ($validator->passes()) {
        $obj = new Faq();
        $obj->status = "1";
        $obj->save();
        foreach($lang as $l){
            $question="question_".$l->lang_code;
            $answer="answer_".$l->lang_code;
            $model = new FaqTranslate();
            $model->question = $request->input($question);
            $model->answer = $request->input($answer);
            $model->created_at = date('Y-m-d H:i:s');
            $model->language_code = $l->lang_code;
            $model->faq_id = $obj->id;
            $model->save();
        }
        $data['status']=200;
        $data['msg']="FAQ added successfully.";
        return response()->json($data); 
    }

    public function view(Request $request, $id) {
        $data = [];
        $data['model'] = $model = Faq::findOrFail($id);
        if (!empty($model) && $model->status != '3') {
            return view('admin::faq.view', $data);
        } else {
            $request->session()->flash('danger', 'Oops. Something went wrong.');
            return redirect()->route('admin-users');
        }
    }

    public function get_update(Request $request, $id) {
        $data = [];
        $data['c_id'] = $id;
        $data['languages'] = $model = FaqTranslate::select('faq_translation.faq_id','faq_translation.status','faq_translation.question','faq_translation.answer','multilinguals.lang','multilinguals.lang_code')
        ->join('multilinguals','faq_translation.language_code','multilinguals.lang_code')
        ->where('faq_id',$id)->where('faq_translation.status','<>','3')->get();
//        if (!empty($model) && $model->status != '3') {
            return view('faq.update', $data);
//        } else {
//            $request->session()->flash('danger', 'Oops. Something went wrong.');
//            return redirect()->route('admin-faqs');
//        }
    }

    public function post_update(Request $request) {
        $data = [];
        $rule = [];
        $message = [];
        $id = $request->input("c_id");
        $lang = FaqTranslate::where('faq_id',$id)->get();
        foreach($lang as $l){
            $rule["question_".$l->language_code] = 'required';
            $message["question_".$l->language_code.'.required'] = "Question is required";
            $rule["answer_".$l->language_code] = 'required';
            $message["answer_".$l->language_code.'.required'] = "Answer is required";
        }
        $request->validate($rule,$message);
        foreach($lang as $l){
            $question="question_".$l->language_code;
            $answer="answer_".$l->language_code;
            FaqTranslate::find($l->id)->update([
                'status'=>$request->status,
                'question' => $request->input($question),
                'answer' => $request->input($answer),
                'updated_at'=>Carbon::now(),
				'status'=>$request->input('faq_status')
            ]);
        }
        $data['status']=200;
        $data['msg']="Faq updated successfully.";
        return response()->json($data); 
    }

    public function delete(Request $request) {
        if($request->ajax())
        {
            $data=[];
            if(!empty($request->input("category")))
            {
                $id=$request->input("category");
                $model = Faq::findOrFail($id);
                if (!empty($model) && $model->status != '3') {
                    $model->status = '3';
                    $model->save();
                    FaqTranslate::where('faq_id',$id)->update([
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
                        $model = Faq::findOrFail($id);
                        $model->status = '3';
                        $model->save();
                        FaqTranslate::where('faq_id',$id)->update([
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
