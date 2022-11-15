<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\NewsBlog;
use Carbon\Carbon;

class NewsController extends Controller
{
    public function index()
    {
        $data = [];
        $data['blog'] = DB::table('blogs')->where('lang_code', 'en')->get();
        // $data['languages'] = DB::table('multilinguals')->where('status', '1')->get();
        return view('newsBlog.view', $data);
    }

    public function edit($id)
    {
        $data = [];
        $data['id'] = $id;
        $data['blog'] = DB::table('blogs')->where('parent_id', $id)->get();
        $data['category'] = DB::table('categories_translation')
            ->where(
                'language_code',
                'en'
            )->where('status', '1')->get();
        // $data['languages'] = DB::table('multilinguals')->where('status', '1')->get();
        return view('newsBlog.update', $data);
    }

    public function blog_create()
    {
        $data = [];
        $data['lang'] = DB::table('multilinguals')->where('status', '1')->get();
        $data['cat'] = DB::table('categories_translation')
            ->where(
                'language_code',
                'en'
            )->where('status', '1')->get();
        return view('newsBlog.create', $data);
    }





    public function create_blog(Request $request)
    {
        $data = [];
        $lang = DB::table('multilinguals')->where('status', '<>', '3')->get();

        $rule = [];
        $message = [];
        $rule["title"] = 'required';
        // $rule["image"] = 'mimes:png,jpg,jpeg,gif|max:15360';

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
            $db = DB::table('blogs')->insert([
                'parent_id' => $unique_id,
                'category_id' => $request->category_id,
                'lang_code' => $l->lang_code,
                'title' => $request->input($l->lang_code . 'title'),
                'description' => $request->input($l->lang_code),
                'image' => $img_name,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
        // return $db;
        return redirect(Route('admin-news'));
        // $data['status'] = 200;
        // $data['msg'] = "Content updated successfully.";
        // return response()->json($data);
    }



    public function post_updateBlog(Request $request)
    {
        $data = [];
        $model = DB::table('blogs')->where('parent_id', $request->parent_id)->get();
        $rule = [];
        $message = [];
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
            $cnsml = NewsBlog::where('id', $l->id)->update([
                'title' => $request->input($l->lang_code . 'title'),
                'category_id' => $request->category_id,
                'description' => $request->input($l->lang_code),
                'image' => $img_name,
                'updated_at' => Carbon::now()
            ]);
        }
        return redirect(Route('admin-editnews', $request->parent_id));
    }







    // Apis Start /////////////..............................................

    public function ShowBlogs(Request $request)
    {
        if($request->language_code){
            $lan = $request->language_code;
        }else{
            $lan = 'en';
        }

        $data = DB::table('blogs')->where('blogs.lang_code', $lan)
            ->join('categories_translation as cat', 'cat.id', '=', 'blogs.category_id')
            ->select('blogs.*', 'cat.name as category_name')
            ->orderBy('blogs.id', 'desc')
            ->get();
        // $data['languages'] = DB::table('multilinguals')->where('status', '1')->get();

        return response()->json(['result' => 'success', 'data' => $data], 200);
    }
    public function latestBlog(Request $request)
    {
        if($request->language_code){
            $lan = $request->language_code;
        }else{
            $lan = 'en';
        }
        $data = DB::table('blogs')->where('blogs.lang_code', $lan)
            ->join('categories_translation as cat', 'cat.id', '=', 'blogs.category_id')
            ->select('blogs.*', 'cat.name as category_name')
            ->orderBy('blogs.id', 'desc')->limit(4)->get();
        // $data['languages'] = DB::table('multilinguals')->where('status', '1')->get();

        return response()->json(['result' => 'success', 'data' => $data], 200);
    }


    public function ShowBlogsbyCategory(Request $request)
    {
        if($request->language_code){
            $lan = $request->language_code;
        }else{
            $lan = 'en';
        }
        $data = DB::table('blogs')->where('blogs.lang_code', $lan)->where('blogs.category_id', $request->category_id)
            ->join('categories_translation as cat', 'cat.id', '=', 'blogs.category_id')
            ->select('blogs.*', 'cat.name as category_name')
            ->orderBy('blogs.id', 'desc')->get();
        return response()->json(['result' => 'success', 'data' => $data], 200);
    }

    public function ShowBlog_single(Request $request)
    {
        $data = DB::table('blogs')->where('blogs.id', $request->blog_id)
            ->join('categories_translation as cat', 'cat.id', '=', 'blogs.category_id')
            ->select('blogs.*', 'cat.name as category_name')
            ->first();
        // $data['languages'] = DB::table('multilinguals')->where('status', '1')->get();

        return response()->json(['result' => 'success', 'data' => $data], 200);
    }


    public function ShowCategories(Request $request)
    {
        if($request->language_code){
            $lan = $request->language_code;
        }else{
            $lan = 'en';
        }
        $data = DB::table('categories_translation')->where('language_code', $lan)->get();
        return response()->json(['result' => 'success', 'data' => $data], 200);
    }
}
