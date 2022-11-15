<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Validator;
use DataTables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Admin\Emails\ContactUsReply;
use App\Models\UserMaster;
use App\Models\ContactUs;

class ContactController extends AdminController
{

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $data = [];
        $data['name'] = $name = isset($_GET['name']) ? $_GET['name'] : "";
        $data['email'] = $email = isset($_GET['email']) ? $_GET['email'] : "";
        $data['phone'] = $phone = isset($_GET['phone']) ? $_GET['phone'] : "";
        $data['status'] = $status = isset($_GET['status']) ? $_GET['status'] : "";
        $data['search_filter'] = isset($_GET['search_filter']) ? $_GET['search_filter'] : "";
        $query = ContactUs::where('id', '<>', 0);
        if ($name != "") {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($email != "") {
            $query->where('email', 'like', '%' . $email . '%');
        }
        if ($phone != "") {
            $query->where('phone_no', 'like', $phone . '%');
        }
        if ($status != "") {
            $query->where('reply_status', '=', $status);
        }
        $query->orderBy('id', 'desc');
        $model = $query->paginate(10);
        $data['model'] = $model;
        return view('contact.index', $data);
    }

    public function contact_list(Request $request)
    {
        $search = $request->input('search');
        $items = ContactUs::select("*");
        if (!empty($search['value'])) {
            if ($search['value'] == "1") {
                $contact_list = $items->where('reply_status', $search['value'])->where('status', '<>', '3');
            } elseif ($search['value'] == 0) {
                $contact_list = $items->where('reply_status', 0)->where('status', '<>', '3');
            } else {
                $contact_list = $items->where('status', '<>', '3');
            }
        } else {
            $contact_list = $items->where('status', '<>', '3');
        }
        return Datatables::of($contact_list)
            ->editColumn('id', function ($model) {
                return $model->id;
            })
            ->editColumn('name', function ($model) {
                return $model->name;
            })
            ->editColumn('phone_no', function ($model) {
                return $model->phone_no;
            })
            ->editColumn('email', function ($model) {
                return $model->email;
            })
            ->editColumn('status', function ($model) {
                return ($model->reply_status == "1") ? "Replied" : "Not Replied";
            })
            ->editColumn('created_at', function ($model) {
                return date("jS M Y, g:i A", strtotime($model->created_at));
            })
            ->addColumn('action', function ($model) {
                return $model->id;
            })
            ->make(true);
    }

    public function view(Request $request, $id)
    {
        $data = [];
        $data['model'] = $model = ContactUs::findOrFail($id);
        if ($model) {
            return view('contact.view', $data);
        } else {
            $request->session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->route('admin-contact');
        }
    }

    public function get_update(Request $request, $id)
    {
        $data = [];
        $data['model'] = $model = ContactUs::findOrFail($id);
        if ($model) {
            return view('admin::contact.update', $data);
        } else {
            $request->session()->flash('danger', 'Oops! Something went wrong.');
            return redirect()->route('admin-contact');
        }
    }

    public function post_update(Request $request, $id)
    {
        $data = [];
        $model = ContactUs::findOrFail($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:250',
            'email' => 'required|email',
            'phone_no' => 'required'
        ]);
        if ($validator->passes()) {
            $input = $request->input();
            $input['updated_at'] = date("Y-m-d h:i:s");
            $model->update($input);
            $request->session()->flash('success', 'Contect updated successfully.');
            return redirect()->route('admin-contact')->withErrors($validator)->withInput();
        } else {
            return redirect()->route('admin-updatecontact', ['id' => $id])->withErrors($validator)->withInput();
        }
    }


    public function send_reply(Request $request)
    {
        $data = [];
        $model = ContactUs::findOrFail($request->id);
        $validator = Validator::make($request->all(), [
            'reply' => 'required',
        ]);
        if ($validator->passes()) {
            $email_setting = $this->get_email_data('admin_reply', array('NAME' => $model->name, 'MESSAGE' => $request->reply));
            $email_data = [
                'to' => $model->email,
                'subject' => $email_setting['subject'],
                'template' => 'contact_reply',
                'data' => ['message' => $email_setting['body']]
            ];
            $this->SendMail($email_data);

            $model->reply_message = $request->input('reply');
            $model->reply_status = '1';
            $model->save();
            // Mail::to($model->email)->send(new ContactUsReply($model));
            $data['status'] = 200;
            $data['msg'] = "Your message Mailed to the user Sucessfully";
        } else {
            $data['status'] = 400;
            $data['error'] = $validator->errors();
        }
        return response()->json($data);
        return redirect()->route('admin-viewcontact', ['id' => $model->id])->withErrors($validator)->withInput();
    }

    public function delete(Request $request)
    {
        $data = [];
        if (!empty($request->input("user"))) {
            $id = $request->input("user");
            $model = ContactUs::findOrFail($id);
            if (!empty($model) && $model->status != '3') {
                $model->status = '3';

                $model->save();
                $data['status'] = 200;
            } else {
                $data['status'] = 400;
                $data['msg'] = "Oops. Something went wrong.";
            }
        } else {
            $ids = $request->input("users");
            $users = explode(",", $ids);
            //                dd($categories);
            foreach ($users as $id) {
                if ($id != "0") {
                    $model = ContactUs::findOrFail($id);
                    $model->status = '3';
                    $model->save();
                }
            }
            $data['status'] = 200;
        }
        return response()->json($data);
    }


    public function CreateContactUs(Request $request)
    {
        $data = [];
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|max:250',
            'last_name' => 'required|max:250',
            'email' => 'required|email',
            'phone' => 'required',
            'subject' => 'nullable',
            'message' => 'required',
        ]);
        if ($validator->passes()) {
            $model = new ContactUs;
            // $model = $request->input();
            $model['first_name'] = $request->first_name;
            $model['last_name'] = $request->last_name;
            $model['name'] = $request->first_name . ' ' . $request->last_name;
            $model['email'] = $request->email;
            $model['phone_no'] = $request->phone;
            $model['subject'] = $request->subject;
            $model['message'] = $request->message;
            $model['created_at'] = date("Y-m-d h:i:s");
            $model['updated_at'] = date("Y-m-d h:i:s");
            $model->save();
            return response()->json(['result' => 'success', 'data' => 'Contact Us Details Save successfully'], 200);
        } else {
            return response()->json(['result' => 'error', 'data' => $validator->errors()], 400);
        }
    }
}
