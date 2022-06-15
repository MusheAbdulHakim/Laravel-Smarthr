<?php

namespace App\Http\Controllers\Admin;

use App\Models\Goal;
use App\Models\GoalType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GoalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = "Goals";
        $goals = Goal::get();
        $goal_types = GoalType::get();
        return view('backend.goal-tracking',compact(
            'title','goals','goal_types'
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
            'goal_type' => 'required',
            'subject' => 'required',
            'target' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'nullable|max:255',
            'status' => 'nullable'
        ]);
        Goal::create([
            'goal_type_id' => $request->goal_type,
            'subject' => $request->subject,
            'target' => $request->target,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return back()->with('success',"Goal Tracking has been added");
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
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'goal_type' => 'required',
            'subject' => 'required',
            'target' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'description' => 'nullable|max:255',
            'status' => 'nullable'
        ]);
        $goal = Goal::findOrFail($request->id);
        $goal->update([
            'goal_type_id' => $request->goal_type,
            'subject' => $request->subject,
            'target' => $request->target,
            'progress' => $request->progress,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'description' => $request->description,
            'status' => $request->status
        ]);
        return back()->with('success',"Goal Tracking has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $goal = Goal::findOrFail($request->id);
        $goal->delete();
        return back()->with('success',"Goal has been deleted!!!");
    }
}
