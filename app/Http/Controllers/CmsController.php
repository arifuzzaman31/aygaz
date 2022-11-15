<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use DataTables;
use Carbon\Carbon;
use App\Models\Cms;
use App\Models\CmsTranslate;
use App\Models\CmsTranslateMulti;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;

class CmsController extends AdminController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];
        return view('cms.index', $data);
    }

    public function cms_list(Request $request)
    {
        $cms_list = CmsTranslate::where('language_code', 'en');
        //        dd($category_list);
        return Datatables::of($cms_list)
            ->addIndexColumn()
            ->editColumn('page_name', function ($model) {
                return $model->page_name;
            })
            ->editColumn('content_name', function ($model) {
                return $model->content_name;
            })
            ->editColumn('type', function ($model) {
                if ($model->type == '2') {
                    return 'Image';
                } elseif ($model->type == '3') {
                    return 'Video';
                } else {
                    return 'Text';
                }
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                return $model->cms_id;
            })
            ->make(true);
    }

    public function view($id)
    {
        $data = [];
        $data['model'] = Cms::findOrFail($id);
        return view('admin::cms.view', $data);
    }

    public function get_update($id)
    {
        $data = [];
        $data['model'] = CmsTranslate::select('cms_translation.*', 'multilinguals.lang', 'multilinguals.lang_code')
            ->join('multilinguals', 'cms_translation.language_code', 'multilinguals.lang_code')
            ->where('cms_id', $id)->get();
        return view('cms.update', $data);
    }

    public function post_update(Request $request, $id)
    {
        $data = [];
        $model = CmsTranslate::where('cms_id', $id)->get();
        $rule = [];
        $message = [];
        $rule["page_name"] = 'required';
        $rule["content_name"] = 'required';
        if ($model[0]->type == '2') {
            $rule["content_body"] = 'mimes:png,jpg,jpeg,gif,svg|max:15360';
        } else if ($model[0]->type == '3') {
            $rule["content_body"] = 'mimetypes:video/mp4|max:15360';
        } else {
            foreach ($model as $l) {
                $rule[$l->language_code] = 'required';
                $message[$l->language_code . '.required'] = "Content body is required";
            }
        }
        $request->validate($rule, $message);
        if ($model[0]->type == '2') {
            if ($request->file('content_body')) {
                $img_name = $this->rand_string(20) . '.' . $request->file('content_body')->getClientOriginalExtension();
                $file = $request->file('content_body');
                $file->move(public_path('uploads/frontend/cms/pictures/original/'), $img_name);
                // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
                $model[0]->content_body = $img_name;
            }
        } else if ($model[0]->type == '3') {
            if ($request->file('content_body')) {
                $vdo_name = $this->rand_string(20) . '.' . $request->file('content_body')->getClientOriginalExtension();
                $file = $request->file('content_body');
                $file->move(public_path('uploads/frontend/cms/videos/'), $vdo_name);
                $model[0]->content_body = $vdo_name;
            }
        } else {
            $model[0]->content_body = $request->input('content_body');
        }
        foreach ($model as $l) {
            if ($model[0]->type == '2') {
                CmsTranslate::find($l->id)->update([
                    'page_name' => $request->input('page_name'),
                    'content_name' => $request->input('content_name'),
                    'content_body' => $model[0]->content_body,
                    'updated_at' => Carbon::now()
                ]);
            } else {
                CmsTranslate::find($l->id)->update([
                    'page_name' => $request->input('page_name'),
                    'content_name' => $request->input('content_name'),
                    'content_body' => $request->input($l->language_code),
                    'updated_at' => Carbon::now()
                ]);
            }
        }
        $data['status'] = 200;
        $data['msg'] = "Content updated successfully.";
        return response()->json($data);
    }


    public function index_multi()
    {
        $data = [];
        $data['cms'] = DB::table('cms_translation_multi')->where('parent_id', null)->get();
        return view('cmsMulti.index', $data);
    }

    public function index_multi_view($id)
    {
        $data = [];
        $data['id'] = $id;
        $data['cms'] = DB::table('cms_translation_multi')->where('language_code', 'en')->where('parent_id', $id)->where('status', '<>', '3')->get();
        return view('cmsMulti.view', $data);
    }

    public function cms_edit($id)
    {
        $data = [];
        $data['id'] = $id;
        $data['cms'] = DB::table('cms_translation_multi')->where('status', '<>', '3')->where('cms_id', $id)->get();
        return view('cmsMulti.update', $data);
    }

    public function cmsMulti_create($id)
    {
        $data = [];
        $data['id'] = $id;
        $data['cms'] = DB::table('cms_translation_multi')->where('id', $id)->first();
        $data['lang'] = DB::table('multilinguals')->where('status', '<>', '3')->get();
        return view('cmsMulti.create', $data);
    }



    public function post_updateMulti1(Request $request, $id)
    {
        $data = [];
        $model = DB::table('cms_translation_multi')->where('cms_id', $request->c_id)->get();
        $rule = [];
        $message = [];
        $rule["page_name"] = 'required';
        $rule["title"] = 'required';
        $rule["image"] = 'mimes:png,jpg,jpeg,gif|max:15360';

        if ($request->file('image')) {
            $img_name = $this->rand_string(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('uploads/frontend/cms/pictures/original/'), $img_name);
            // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
            // $imageName = $img_name;
            // echo $img_name;
        } else {
            $img_name = $model[0]->image;
        }

        // $model[0]->content_body = $request->input('content_body');

        foreach ($model as $l) {
            $cnsml = CmsTranslateMulti::where('id', $l->id)->update([
                // 'page_name' => $request->input('page_name'),
                'title' => $request->input($l->language_code . 'title'),
                'description' => $request->input($l->language_code),
                'link' => $request->input('link'),
                'image' => $img_name,
                'bg_color' => $request->bg_color,
                // 'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        return redirect(Route('admin-editcmsMulti', $request->c_id));
        // $data['status'] = 200;
        // $data['msg'] = "Content updated successfully.";
        // return response()->json($data);
    }

    public function createpdateMulti1(Request $request, $id)
    {
        $data = [];
        $model = DB::table('cms_translation_multi')->where('id', $id)->first();
        $lang = DB::table('multilinguals')->where('status', '<>', '3')->get();

        $rule = [];
        $message = [];
        $rule["page_name"] = 'required';
        $rule["title"] = 'required';
        $rule["image"] = 'mimes:png,jpg,jpeg,gif|max:15360';

        if ($request->file('image')) {
            $img_name = $this->rand_string(20) . '.' . $request->file('image')->getClientOriginalExtension();
            $file = $request->file('image');
            $file->move(public_path('uploads/frontend/cms/pictures/original/'), $img_name);
            // Image::make(public_path('uploads/frontend/cms/pictures/original/') . $img_name)->resize(1220, 500)->save(public_path('uploads/frontend/cms/pictures/preview/') . $img_name);
            // $imageName = $img_name;
            // echo $img_name;
        } else {
            $img_name = null;
        }

        // $model[0]->content_body = $request->input('content_body');
        $unique_id = floor(time() - 999999);

        foreach ($lang as $l) {
            // $cnsml = CmsTranslateMulti::where('id', $l->id)->create([
            $db = DB::table('cms_translation_multi')->insert([
                'parent_id' => $id,
                'language_code' => $l->lang_code,
                'cms_id' => $unique_id,
                'page_slug' => $model->page_slug,
                'page_name' => $request->input('page_name'),
                'link' => $request->input('link'),
                'title' => $request->input($l->lang_code . 'title'),
                'description' => $request->input($l->lang_code),
                'image' => $img_name,
                'bg_color' => $request->bg_color,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        // return $db;
        return redirect(Route('admin-viewcmsMulti', $id));
        // $data['status'] = 200;
        // $data['msg'] = "Content updated successfully.";
        // return response()->json($data);
    }



    // ---------API-------API-------API------//////////////// ---- ____  API API API _______ --------- ///////////////////////==========

    public function cms(Request $request)
    {
        if($request->language_code){
            $lan = $request->language_code;
        }else{
            $lan = 'en';
        }
        if ($request->page_slug) {
            $cms_list = CmsTranslate::where('language_code', $lan)->where('page_slug', $request->page_slug)->get();
            return response()->json(['result' => 'success', 'data' => $cms_list], 200);
        } else {
            return response()->json(['result' => 'error', 'data' => 'slug name required'], 400);
        }
    }

    public function cmsMulti(Request $request)
    {
        if($request->language_code){
            $lan = $request->language_code;
        }else{
            $lan = 'en';
        }
        if ($request->slug) {
            $cms = CmsTranslateMulti::where('slug', $request->slug)->first();
            $cms_list = CmsTranslateMulti::where('language_code', $lan)->where('parent_id', $cms->id)->get();
            return response()->json(['result' => 'success', 'data' => $cms_list], 200);
        } else {
            return response()->json(['result' => 'error', 'data' => 'slug name required'], 400);
        }
    }
    public function deleteMulti(Request $request)
    {
        if ($request->id) {
            $cms = CmsTranslateMulti::where('id', $request->id)->delete();
            // $cms_list = CmsTranslateMulti::where('language_code', 'en')->where('parent_id', $cms->id)->get();
            return response()->json(['result' => 'success', 'data' => 'Delete Successfully' . $cms], 200);
        } else {
            return response()->json(['result' => 'error', 'data' => 'Id required'], 400);
        }
    }

    public function createMultiCMS(Request $request)
    {
        $db = DB::table('cms_translation_multi')->insert([
            'slug' => $request->slug,
            'page_slug' => $request->page_slug,
            'page_name' => $request->page_name,
            'title' => $request->title,
            'status' => $request->status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        return response()->json(['result' => 'success', 'data' => 'Created Successfully' . $db], 200);
    }
}
