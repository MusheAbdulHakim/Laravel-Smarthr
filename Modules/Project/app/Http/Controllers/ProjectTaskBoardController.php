<?php

namespace Modules\Project\Http\Controllers;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Project\Models\Task;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Modules\Project\Models\TaskFollower;

class ProjectTaskBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function board(string $id)
    {
        $pageTitle = __('Taskboard');
        $project = Project::findOrFail(Crypt::decrypt($id));
        $taskBoards = $project->taskBoard()->orderBy('priority')->get();
        return view('project::tasks.index',compact(
            'project','pageTitle','taskBoards'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function index(string $id)
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, Project $project)
    {
        $project_id = $project->id;
        $board = $request->board;
        $employees = User::where('is_active', true)->where('type', UserType::EMPLOYEE)->get();
        return view('project::tasks.create',compact(
            'project_id','board','employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'startDate' => 'nullable|date|before_or_equal:endDate',
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'description' => 'required|max:255'
        ]);
        $task = Task::create([
            'project_id' => $request->project_id,
            'project_task_board_id' => $request->board,
            'name' => $request->name,
            'priority' => $request->priority,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ]);
        $team = $request->team;
        if(!empty($team) && count($team) > 0){
            foreach($team as $member){
                TaskFollower::create([
                    'task_id' => $task->id,
                    'user_id' => $member
                ]);
            }
        }
        $notification = notify(__("Task has been added"));
        return back()->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('project::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $employees = User::where('is_active', true)->where('type', UserType::EMPLOYEE)->get();

        return view('project::tasks.edit',compact(
            'task','employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'name' => 'required',
            'startDate' => 'nullable|date|before_or_equal:endDate',
            'endDate' => 'nullable|date|after_or_equal:startDate',
            'description' => 'required|max:255'
        ]);
        $task->update([
            'project_id' => $request->project_id,
            'project_task_board_id' => $request->board,
            'name' => $request->name,
            'priority' => $request->priority,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ]);
        $notification = notify(__("Task has been updated"));
        return back()->with($notification);
    }


    public function draggable(Request $request){
        if($request->ajax()){
            $task = Task::find($request->task);
            $task->update([
                'project_task_board_id' => $request->board ?? $task->project_task_board_id,
                'priority' => $request->priority ?? $task->priority,
            ]);
            return response()->json(['success' => true, 'task' => $task]);
        }
        return response()->json(['success' => false]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        $notification = notify(__("Project Task has been deleted"));
        return back()->with($notification);
    }
}
