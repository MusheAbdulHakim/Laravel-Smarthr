<?php

namespace App\Http\Controllers\Backend;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "contacts";
        $contacts =Contact::get();
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
