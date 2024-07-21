<?php

namespace Modules\Project\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Project\Models\TaskBoard;
use Modules\Project\Models\ProjectTaskBoard;

class TaskBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $boards = TaskBoard::orderBy('priority','desc')->get();
        $pageTitle = __("Task Boards");
        return view('project::task-board.index',compact(
            'pageTitle','boards'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $project_id = $request->project_id;
        return view('project::task-board.create',compact(
            'project_id'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'nullable|string',
        ]);
        if(!empty($request->project_id)){
            ProjectTaskBoard::create([
                'project_id' => $request->project_id,
                'name' => $request->name,
                'color' => $request->color,
                'priority' => $request->priority,
                'created_by' => auth()->user()->id
            ]);
        }else{
            TaskBoard::create([
                'name' => $request->name,
                'color' => $request->color,
                'priority' => $request->priority,
                'created_by' => auth()->user()->id
            ]);
        }
        $notification = notify(__('Task board has been added'));
        return back()->with($notification);
    }

   
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        $project_id = $request->project_id;
        $taskBoard = TaskBoard::find($id);
        if(!empty($project_id)){
            $taskBoard = ProjectTaskBoard::find($id);
        }
        return view('project::task-board.edit',compact(
            'taskBoard'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'color' => 'required|string',
        ]);
        if(!empty($request->project_id)){
            ProjectTaskBoard::findOrFail($id)->update([
                'project_id' => $request->project_id,
                'name' => $request->name,
                'color' => $request->color,
                'priority' => $request->priority,
                'created_by' => auth()->user()->id
            ]);
        }else{
            TaskBoard::findOrFail($id)->update([
                'name' => $request->name,
                'color' => $request->color,
                'priority' => $request->priority,
            ]);
        }
        $notification  = notify(__("Taskboard has been updated"));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, $id)
    {
        if($request->project_id){
            ProjectTaskBoard::findOrFail($id)->delete();
        }else{
            TaskBoard::findOrFail($id)->delete();
        }
        $notification = notify(__("Taskboard has been deleted"));
        return back()->with($notification);
    }
}
