<?php

namespace App\Http\Controllers;

use App\Contact;
use App\Features;
use App\FrontUser;
use App\Packages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function packages()
    {
        $packages = Packages::all();
        return view('packages', compact('packages'));
    }

    public function features($id)
    {
        $getFeaturesData = Features::where('package_id', $id)->get()->toArray();
        return view('features', compact('getFeaturesData'));
    }

    public function store_features(Request $request)
    {
        $data           = $request->all();
        $removeFirstAll = Features::where('package_id', $data['package_id'])->delete();
        foreach ($data['feature'] as $key => $value) {
            $status        = isset($data['status'][$key]) ? 1 : 0;
            $storeFeatures = Features::insert([
                'title'      => $value,
                'status'     => $status,
                'package_id' => $data['package_id'],
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s"),
            ]);
        }
        return redirect()->back()->with('success', 'Features Store Successfully.');
    }

    public function candidates()
    {
        return view('candidates');
    }

    public function get_candidates(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list        = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'contact_number',
            4 => 'gender',
            5 => 'age',
            6 => 'area',
            7 => 'role',
            8 => 'status',
            9 => 'id',
        ];

        $totalDataRecord = FrontUser::where('role', '!=', 'family')->count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = FrontUser::where('role', '!=', 'family')->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = FrontUser::where('role', '!=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->orWhere('surname', 'LIKE', "%{$search_text}%")
                ->orWhere('id_number', 'LIKE', "%{$search_text}%")
                ->orWhere('contact_number', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
            $totalFilteredRecord = FrontUser::where('role', '!=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = [];
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                if ($post_val->status == 0) {
                    $status = '<input type="checkbox" class="statusChanged" name="status" value="' . $post_val->id . '" data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                } else {
                    $status = '<input type="checkbox" class="statusChanged" name="status" value="' . $post_val->id . '" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">';
                }

                $postnestedData['DT_RowId']       = $post_val->id;
                $postnestedData['id']             = $key + 1;
                $postnestedData['name']           = $post_val->name;
                $postnestedData['email']          = $post_val->email;
                $postnestedData['contact_number'] = $post_val->contact_number;
                $postnestedData['gender']         = $post_val->gender;
                $postnestedData['age']            = $post_val->age;
                $postnestedData['area']           = $post_val->area;
                $postnestedData['role']           = $post_val->role;
                $postnestedData['status']         = $status;
                $url                              = url('admin/view_candidates/' . $post_val->id);
                $postnestedData['options']        = "<a href='" . $url . "' title='View' class='btn btn-info btn-sm'><i class='fas fa-eye'></i></a> <a title='Delete' href='javascript:void(0)' class='btn btn-danger btn-sm' onClick='removeCandidates(" . $post_val->id . ")'><i class='fas fa-trash'></i></a>";
                $data_val[]                       = $postnestedData;

            }
        }
        $draw_val      = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val,
        ];

        echo json_encode($get_json_data);
    }

    public function destroyCandidates(Request $request)
    {
        $post = FrontUser::where('id', $request->id)->first();
        $post->delete();
    }

    public function statusCandidates(Request $request)
    {
        $updateRequest = $request->all();
        $data          = [
            'status' => $updateRequest['status'],
        ];
        FrontUser::where('id', $updateRequest['id'])->update($data);
    }

    public function families()
    {
        return view('families');
    }

    public function get_families(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list        = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'contact_number',
            4 => 'gender',
            5 => 'age',
            6 => 'area',
            7 => 'id',
        ];

        $totalDataRecord = FrontUser::where('role', '=', 'family')->count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = FrontUser::where('role', '=', 'family')->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = FrontUser::where('role', '=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->orWhere('surname', 'LIKE', "%{$search_text}%")
                ->orWhere('id_number', 'LIKE', "%{$search_text}%")
                ->orWhere('contact_number', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
            $totalFilteredRecord = FrontUser::where('role', '=', 'family')->orWhere('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = [];
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['DT_RowId']       = $post_val->id;
                $postnestedData['id']             = $key + 1;
                $postnestedData['name']           = $post_val->name;
                $postnestedData['email']          = $post_val->email;
                $postnestedData['contact_number'] = $post_val->contact_number;
                $postnestedData['gender']         = $post_val->gender;
                $postnestedData['age']            = $post_val->age;
                $postnestedData['area']           = $post_val->area;
                $url                              = url('admin/view_families/' . $post_val->id);
                $postnestedData['options']        = "<a href='" . $url . "' title='View' class='btn btn-info btn-sm'><i class='fas fa-eye'></i></a> <a title='Delete' href='javascript:void(0)' class='btn btn-danger btn-sm' onClick='removeFamilies(" . $post_val->id . ")'><i class='fas fa-trash'></i></a>";
                $data_val[]                       = $postnestedData;

            }
        }
        $draw_val      = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val,
        ];

        echo json_encode($get_json_data);
    }

    public function destroyFamilies(Request $request)
    {
        $post = FrontUser::where('id', $request->id)->first();
        $post->delete();
    }

    public function contact()
    {
        return view('contact');
    }

    public function get_contact(Request $request)
    {
        $totalFilteredRecord = $totalDataRecord = $draw_val = "";
        $columns_list        = [
            0 => 'id',
            1 => 'name',
            2 => 'email',
            3 => 'number',
            4 => 'message',
            5 => 'id',
        ];

        $totalDataRecord = Contact::count();

        $totalFilteredRecord = $totalDataRecord;

        $limit_val = $request->input('length');
        $start_val = $request->input('start');
        $order_val = $columns_list[$request->input('order.0.column')];
        $dir_val   = $request->input('order.0.dir');

        if (empty($request->input('search.value'))) {
            $post_data = Contact::offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
        } else {
            $search_text = $request->input('search.value');

            $post_data = Contact::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->orWhere('number', 'LIKE', "%{$search_text}%")
                ->orWhere('email', 'LIKE', "%{$search_text}%")
                ->orWhere('message', 'LIKE', "%{$search_text}%")
                ->offset($start_val)
                ->limit($limit_val)
                ->orderBy($order_val, $dir_val)
                ->get();
            $totalFilteredRecord = Contact::where('id', 'LIKE', "%{$search_text}%")
                ->orWhere('name', 'LIKE', "%{$search_text}%")
                ->count();
        }

        $data_val = [];
        if (!empty($post_data)) {
            foreach ($post_data as $key => $post_val) {
                $postnestedData['DT_RowId'] = $post_val->id;
                $postnestedData['id']       = $key + 1;
                $postnestedData['name']     = $post_val->name;
                $postnestedData['email']    = $post_val->email;
                $postnestedData['number']   = $post_val->number;
                $postnestedData['message']  = $post_val->message;
                $postnestedData['options']  = "<a title='Delete' href='javascript:void(0)' class='btn btn-danger btn-sm' onClick='removeContact(" . $post_val->id . ")'><i class='fas fa-trash'></i></a>";
                $data_val[]                 = $postnestedData;

            }
        }
        $draw_val      = $request->input('draw');
        $get_json_data = [
            "draw"            => intval($draw_val),
            "recordsTotal"    => intval($totalDataRecord),
            "recordsFiltered" => intval($totalFilteredRecord),
            "data"            => $data_val,
        ];

        echo json_encode($get_json_data);
    }

    public function destroyContact(Request $request)
    {
        $post = Contact::where('id', $request->id)->first();
        $post->delete();
    }

    public function change_password()
    {
        return view('changepassword');
    }

    public function update_password(Request $request)
    {
        if ($request->password != '') {
            User::whereId(auth()->user()->id)->update([
                'password' => Hash::make($request->password),
            ]);
            return back()->with('success', 'Password Update Successfully');
        } else {
            return back()->with('errorM', 'Please enter your new password');
        }
    }

}
