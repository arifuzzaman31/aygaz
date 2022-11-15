<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Intervention\Image\ImageManagerStatic as Image;
// ************ Requests ************
use App\Http\Requests\ContactusRequest;
use App\Http\Requests\RequrirementFileRequest;
use App\Http\Requests\RequrirementStoreRequest;
use App\Http\Requests\HirefixerRequest;
use Carbon\Carbon;

use App\Models\CategoryTranslate;
use App\Models\Category;
use App\Models\RequestFile;
use App\Models\Requrirement;
use App\Models\Hirefixer;
use App\Models\Blog;
use App\Models\ContactUs;
use App\Models\Settings;
use App\Models\CmsTranslate;
use App\Models\FaqTranslate;
use App\Models\Testimonial;

class ApiController extends Controller
{
    //
    
    public function get_category(Request $request)
    {
        $data=[];
        $lang=$request->input('lang');
        $limit=$request->input("limit");
        $url=DEFAULT_Path."/category_image/";
        $query=CategoryTranslate::select("categories_translation.*",DB::raw("CONCAT('".$url."', categories.image) as image"))
            ->join('categories','categories_translation.category_id','categories.id')->where('categories_translation.status', '1')->where('categories_translation.language_code',$lang);
        if(isset($limit))
        {
            $categories=$query->limit($limit)->get();
        }else{
            $categories=$query->get();
        }
                
        if(count($categories) >0)
        {
            $data['status']=200;
            $data['msg']="Category fatch.";
            $data['data']=$categories;
        }else{
            $data['status']=400;
            $data['msg']="No category found.";
            $data['data']=[];
        }
        return response()->json($data);
    }
    
    public function requrirement(RequrirementStoreRequest $request) {
       // return dd($request->input());
        $data=[];
        $input=$request->input();
        $categorie= $request->input('category');
        $input['status']="1";
        $cate=CategoryTranslate::find($categorie)->get_category($categorie,"en");
        $array=array(
            "NAME"=>$request->name,
            "EMAIL"=>$request->email,
            "PHONE"=>$request->phone,
            "DESCRIPTION"=>$request->description,
            "ADDRESS"=>$request->address,
            "ZIPCODE"=>$request->zipcode,
            "CATEGORY"=>$cate
        );
        $email_setting = $this->get_email_data('requriment_request_form', $array);

           $email_data = [           
               'to' => $request->email,
               'subject' => $email_setting['subject'],
               'template' => 'signup',
               'data' => ['message' => $email_setting['body']]
           ];
          // $mail=$this->SendMail($email_data);
           //trigger exception in a "try" block
            try {
                if($request->hasFile("file"))
                {
                    $this->SendAttachMail($email_data,$request);
                }else{
                    $this->SendMail($email_data);
                }
              $model = Requrirement::create($input);
                $data['status']=200;
                $data['msg']="Your request successfully send.";
            }

            //catch exception
            catch(Exception $e) {
                $data['status']=400;
                $data['msg']=$e->getMessage();
            }
        if($request->hasFile("file"))
        {
            $this->save_requrirement_images($request, $model->id,"1");
        }
        return response()->json($data);
    }
    
    private function save_requrirement_images($arr, $request_id,$type) {
        //        if (!empty($arr->file('file')) && !empty($request_id)) {
            $images = $arr->file('file');
            foreach ($images AS $i => $image) {
                $input = [];
                $input['request_id'] = $request_id;
                $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
                $destinationPath = public_path('uploads/admin/request_image/original/'); //public path folder dir
            //                $path = public_path('uploads/admin/request_image/');
            //                Image::make($image->getRealPath())->resize(300, 200)->save($path . 'preview/' . $name);
            //                Image::make($image->getRealPath())->resize(100, 100)->save($path . 'thumb/' . $name);
                $image->move($destinationPath, $name);
                $input['file_name'] = $name;
                $input['request_type'] = $type;
                $input['status'] = '1';
                $input['file_type'] = "1";
                $input['is_default'] = '0';
                $checkImageName = RequestFile::where(['request_id' => $request_id, 'file_name' => $image])->first();
                if (!empty($checkImageName)) {
                    $checkImageName->update($input);
                } else {
                    RequestFile::create($input);
                }
            }
        //        }
    }


    
    public function upload_photos(RequrirementFileRequest $request) {
        $file = $request->file('file');
        $mime = $file->getMimeType();
        $split_mime = explode('/', $mime);
        $split_mime[0] = $split_mime[0] ?? '';
        if ($split_mime[0] == 'video') {
            $data_msg['file_type'] = 2;
        } else {
            $data_msg['file_type'] = 1;
        }
        $data_msg['file_name'] = $this->imageUpload($request, 'file');
        $data_msg['modelName'] = 'AllImages';
        $data_msg['status'] = 200;

        return response()->json($data_msg);
    }
    
    function imageUpload(Request $request, $fname) {
        if ($request->hasFile($fname)) {  //check the file present or not
            $image = $request->file($fname); //get the file
            $name = $this->rand_string(50) . time() . '.' . $image->getClientOriginalExtension(); //get the  file extention
            $destinationPath = public_path('uploads/admin/request_image/'); //public path folder dir
            $image->move($destinationPath, $name);
            return $name;
        }
    }
    
    public function get_private_tender(Request $request)
    {
        $requests= Hirefixer::select("*",DB::raw('DATE_FORMAT(created_at, "%b %d,%Y") as post_date'),DB::raw('DATE_FORMAT(deadline, "%b %d,%Y") as deadline_date'))->where("status","2")->orWhere("status","4")->get();
        if(count($requests) >0)
        {
            $data['status']=200;
            $data['msg']="tenders fatch.";
            $data['data']=$requests;
        }else{
            $data['status']=400;
            $data['msg']="No tenders found.";
            $data['data']=[];
        }
        return response()->json($data);
    }
    
    public function get_private_tenders_details($id)
    {
        $data=[];
        $url=$url=DEFAULT_Path."/request_image/original/";
        $requests= Hirefixer::with(array('files'=>function($query) use ($url){
    $query->select('*',DB::raw("CONCAT('".$url."',file_name) as image"));
}))->select("*",DB::raw('DATE_FORMAT(created_at, "%b %d,%Y") as post_date'),DB::raw('DATE_FORMAT(deadline, "%b %d,%Y") as deadline_date'))->where("id",$id)->where("status","2")->first();
        if(!empty($requests) >0)
        {
            $data['status']=200;
            $data['msg']="tenders fatch.";
            $data['data']=$requests;
        }else{
            $data['status']=400;
            $data['msg']="No tenders found.";
            $data['data']=[];
        }
        return response()->json($data);
    }
    
    public function post_hire_fixer(HirefixerRequest $request)
    {
        $data=[];
        $input=$request->input();
        $input['status']="1";
        $array=array(
            "NAME"=>$request->name,
            "EMAIL"=>$request->email,
            "PHONE"=>$request->phone,
            "TITLE"=>$request->title,
            "DEADLINE"=>$request->deadline,
            "BUDGET"=>$request->budget,
            "CURRENCY"=>$request->currency,
            "DESCRIPTION"=>$request->description,
            "ADDRESS"=>$request->address,
            "ZIPCODE"=>$request->zipcode,
        );
        $email_setting = $this->get_email_data('hire_fixer_request_form', $array);

           $email_data = [           
               'to' => $request->email,
               'subject' => $email_setting['subject'],
               'template' => 'signup',
               'data' => ['message' => $email_setting['body']]
           ];
          ///$mail=$this->SendMail($email_data);
           //trigger exception in a "try" block
            try {
                if($request->hasFile("file"))
                {
                    $this->SendAttachMail($email_data,$request);
                }else{
                    $this->SendMail($email_data);
                }
              $model = Hirefixer::create($input);
                $data['status']=200;
                $data['msg'] = 'Your request successfully send.';
            }

            //catch exception
            catch(Exception $e) {
                $data['status']=400;
                $data['msg']=$e->getMessage();
            }
        if($request->hasFile("file"))
        {
            $this->save_requrirement_images($request, $model->id,"2");
        }
        
        return response()->json($data);
    }

    public function get_faqs(Request $request)
    {
        $lang=$request->input("lang");
        $query= FaqTranslate::select('*')->where("language_code",$lang)->where("status","1");
        $faqs=$query->get();
        if(count($faqs) >0)
        {
            $data['status']=200;
            $data['msg']="FAQ fatch.";
            $data['data']=$faqs;
        }else{
            $data['status']=400;
            $data['msg']="No faq found.";
            $data['data']=[];
        }
        return response()->json($data);
    }
    
    public function get_blogs(Request $request)
    {
        $lang=$request->input("lang");
        $limit=$request->input("limit");
        $url=DEFAULT_Path."/blog/preview/";
        $query=Blog::select('*',DB::raw('DATE_FORMAT(created_at, "%b %d,%Y") as blog_date'),DB::raw("CONCAT('".$url."',image) as blog_image"))->where("lang_code",$lang)->where("status","1");
        if(isset($limit))
        {
            $blogs=$query->paginate($limit);
        }else{
            $blogs=$query->get();
        }
        if(count($blogs) >0)
        {
            $data['status']=200;
            $data['msg']="Blog fatch.";
            $data['data']=$blogs;
        }else{
            $data['status']=400;
            $data['msg']="No blog found.";
            $data['data']=[];
        }
        return response()->json($data);
    }
    
    public function get_blogs_details(Request $request,$id)
    {
        $data=[];
        $url=$url=DEFAULT_Path."/blog/original/";
        $requests= Blog::select("*",DB::raw('DATE_FORMAT(created_at, "%b %d,%Y") as blog_date'),DB::raw("CONCAT('".$url."',image) as blog_image"))->where("id",$id)->first();
        $recents= Blog::select("*",DB::raw('DATE_FORMAT(created_at, "%b %d,%Y") as blog_date'))->orderBy('created_at', 'desc')->where("status","1")->limit(7)->get();
        if(!empty($requests) >0)
        {
            $data['status']=200;
            $data['msg']="blog fatch.";
            $data['data']=$requests;
        }else{
            $data['status']=400;
            $data['msg']="No blog found.";
            $data['data']=[];
        }
        $data['recents']=$recents;
        return response()->json($data);
    }
    
    public function post_proposal(ContactusRequest $request)
    {
        $data = [];
			
        $admin_email = Settings::where('slug', '=', 'contact_email')->first();

                    $contact = new ContactUs;
         //        $contact->department = $request->input('department');
                    $contact->name = $request->input('name');
                    $contact->email = $request->input('email');
                    $contact->company_name = $request->input('company_name');
                    $contact->phone_no = $request->input('phone');
         //        $contact->website = $request->input('website');
         //        $contact->describes = $request->input('description');
                     $contact->subject = $request->input('subject');
                    $contact->message = $request->input('description');
                    $contact->created_at = Carbon::now()->toDateTimeString();
                    $contact->save();

                    if (isset($contact->id)) {
            $email_setting = $this->get_email_data('contact_us', array('ADMIN' => "Admin", 'NAME' => $contact->name, 'EMAIL' => $contact->email, 'PHONE' => ($contact->phone_no != "") ? $contact->phone_no : 'Not Provided', 'MESSAGE' => $contact->message));
            $email_data = [
                'to' => $admin_email->value,
                'subject' => $contact->subject,
                'template' => 'contact_us',
                'data' => ['message' => $email_setting['body']]
            ];
 
            $this->SendMail($email_data);

            $data['status'] = 200;
            $data['msg'] = 'Thank you for contacting us. We will Contact you soon.';
        } else {
            $data['msg'] = 'Sorry! some problem is there. Please try again';
            $data['status'] = 422;
        }			

        return response()->json($data);
    }
    
    public function get_static_content(Request $request)
    {
        $data=[];
        $lang=$request->input('lang');
        $slug=$request->input('slug');
        $item= CmsTranslate::where('language_code',$lang)->where("slug",$slug)->first();
        $data['data']=$item;
        return response()->json($data);
    }
    public function get_cms_content(Request $request)
    {
        $data=[];
        $lang=$request->input('lang');
        $slug=$request->input('slug');
        $items= CmsTranslate::where('language_code',$lang)->where("page_slug",$slug)->get();
        $array=[];
        $url=FRONTEND_DEFAULT_Path."/cms/pictures/original/";
        foreach($items as $key=>$item)
        {
            if($item->type=="2")
            {
                $item->image=$url.$item->content_body;
            }
            $array[]=$item;
        }
        $data['data']=$array;
        return response()->json($data);
    }

    public function get_reviews(Request $request)
    {
        $data=[];
        $url=DEFAULT_Path."/testimonial/original/";
        $testimonials=Testimonial::select('*',DB::raw("CONCAT('".$url."',image) as testimonial_image"))->where("status",'1')->inRandomOrder()->limit(4)->get();
        $count_testimonials=Testimonial::where("status",'1')->count();
        $avg_testimonials=Testimonial::where("status",'1')->avg('rating');
        
        $array=[];
        foreach($testimonials as $key=>$testimonial)
        {
            $array[]=$testimonial;
        }
        if(count($testimonials) >0)
        {
            $data['status']=200;
            $data['msg']="Testimonial fatch.";
            $data['data']=$array;
            $data['count_testimonials']=$count_testimonials;
            $data['avg_testimonials']=$avg_testimonials;
            // $data['url']=$url;
        }else{
            $data['status']=400;
            $data['msg']="No Testimonial found.";
            $data['data']=[];
            $data['count_testimonials']=$count_testimonials;
            $data['avg_testimonials']=$avg_testimonials;
        }
        return response()->json($data);
    }
}
