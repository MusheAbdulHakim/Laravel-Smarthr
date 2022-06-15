<?php

namespace App\Http\Controllers\Admin;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *@param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $title = "contacts";
        $contacts =Contact::get();
        if($request->ajax()){
            $contacts =Contact::get();
            return DataTables::of($contacts)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                        $openDiv = '<div class="dropdown dropdown-action">
                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="material-icons">more_vert</i></a>
                        <div class="dropdown-menu dropdown-menu-right">';
                        $closeDiv = '</div></div>';
                        $editbtn = '<a data-id="'.$row->id.'" data-name="'.$row->name.'" data-phone="'.$row->number.'" data-status="'.$row->status.'" data-email="'.$row->email.'" class="dropdown-item editbtn" href="javascript:void(0);" data-toggle="modal"><i class="fa fa-pencil m-r-5"></i> Edit</a>';
                        $deletebtn= '<a data-id="'.$row->id.'" class="dropdown-item deletebtn" href="javascript:void(0);" data-toggle="modal"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                        return $openDiv.' '.$editbtn.''.$deletebtn.''.$closeDiv;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('backend.contacts',compact('title','contacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:200',
            'email'=>'nullable|email',
            'number'=>'required|max:20',
        ]);
        
        Contact::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'number'=>$request->number,
            'status'=>$request->status,
        ]);
        return back()->with('success',"Contact added successfully!!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
    public function update(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|max:200',
            'email'=>'nullable|email',
            'number'=>'required|max:20',
        ]);
        $contact = Contact::findOrFail($request->id);
        $contact->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'number'=>$request->number,
            'status'=>$request->status,
        ]);
        return back()->with('success',"Contact updated successfully!!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $contact = Contact::find($request->id);
        $contact->delete();
        return back()->with('success',"Contact has been deleted successfully!!");
    }
}
