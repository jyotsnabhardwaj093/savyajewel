<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\User; 
use App\Model\API\user_profiles;
use DB;
use Session;
use App\Http\Controllers\NotificationController;

class AppUserController extends Controller
{
    public function __construct()
    {
         $this->middleware('permission:App_User',['only' => ['create','store','index','show','edit','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data  = User::leftjoin('user_profiles','user_profiles.uid','users.id')
                       ->select('users.*','user_profiles.document_verified')
                       ->Orderby('users.id','DESC')
                       ->get();

        return view('appuser.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = DB::table('users')->where('id',$id)->first();
        $document = DB::table('user_profiles')->where('uid',$id)->first();
        
        return view('appuser.show',compact('data','document'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        User::where('id',$id)->update(['status'=>$request->status]);
        Session::flash('success','Status Change');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request,$id)
    {

        $check = DB::table('user_profiles')->where('uid',$id)->first();
        if ($check) {
            DB::table('user_profiles')->where('uid',$id)->update([
                'document_verified'     => $request->status,
                'gst_doc_status'        => $request->gst_doc_status,
                'gst_back_status'       => $request->gst_back_status,
                'aadhar_doc_status'     => $request->aadhar_doc_status,
                'aadhar_back_status'    => $request->aadhar_back_status,
                'visiting_doc_status'   => $request->visiting_doc_status,
                'visiting_back_status'       => $request->visiting_back_status,
                'pan_doc_status'       => $request->pan_doc_status,
            ]);
        }
        else{

            $insert = DB::table('user_profiles')->insert([
                'uid'                   => $id,
                'status'                => $request->status,
                'gst_doc_status'        => $request->gst_doc_status,
                'gst_back_status'       => $request->gst_back_status,
                'aadhar_doc_status'     => $request->aadhar_doc_status,
                'aadhar_back_status'    => $request->aadhar_back_status,
                'visiting_doc_status'   => $request->visiting_doc_status,
                'visiting_back_status'  => $request->visiting_back_status,
                'pan_doc_status'        => $request->pan_doc_status,
            ]);

        }                   

        $login_details = DB::table('login_details')->where('user_id',$id)
                                                   ->first();

        $call = new NotificationController;

        if ($request->status ==2) {
           $onesignal_content = DB::table('Admin_notification')->where('id',8)
                                                               ->first();
        }
        elseif($request->status){
            $onesignal_content = DB::table('Admin_notification')->where('id',9)
                                                                ->first();
        }
        else
        {
            $onesignal_content = DB::table('Admin_notification')->where('id',10)
                                                                ->first();
        }

        $data = array(
            'uid' => $id,
            'heading' => $request->content,
            'id'      => 8,
            'message' => '',
        );

        //$call->onesignal($data,8,$login_details->one_singnal);

        Session::flash('success','Document Status Change');
        return back();
    }
}
