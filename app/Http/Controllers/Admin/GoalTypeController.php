<?php

namespace App\Http\Controllers\Admin;

use App\Models\GoalType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoalTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "goal Type";
        $goal_types = GoalType::get();
        return view('backend.goal-type',compact(
            'title','goal_types',
        ));
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
            'type' => 'required|max:100',
            'description' => 'nullable|max:255'
        ]);
        GoalType::create([
            'type' => $request->type,
            'description' => $request->description,
        ]);
        return back()->with('success',"Goal type has been added");
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'type' => 'required|max:100',
            'description' => 'nullable|max:255'
        ]);
        $goal_type = GoalType::findOrFail($request->id);
        $goal_type->update([
            'type' => $request->type,
            'description' => $request->description,
        ]);
        return back()->with('success',"Goal type has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $goal_type = GoalType::findOrFail($request->id);
        $goal_type->delete();
        return back()->with('success',"Goal Type has been deleted");
    }
}
