<?php

namespace Modules\Project\Http\Controllers;

use App\Models\User;
use App\Enums\UserType;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Project\Models\Project;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Modules\Project\Models\TaskBoard;
use Modules\Project\Models\ProjectTaskBoard;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pageTitle = __('Projects');
        $projects = Project::get();
        return view('project::index',compact(
            'pageTitle','projects'
        ));
    }

    /**
     * Display a listing of the resource.
     */
    public function list()
    {
        $pageTitle = __('Project List');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clients = User::where('is_active', true)->where('type', UserType::CLIENT)->get();
        $employees = User::where('is_active', true)->where('type', UserType::EMPLOYEE)->get();
        return view('project::create',compact(
            'clients','employees'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'leader' => 'required',
            'projectFiles' => 'nullable',
            'rate' => 'required|numeric',
            'rateType' => 'required',
            'priority' => 'required',
            'startDate' => 'required|date|before:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
            'short_desc' => 'required|max:255|string',
        ]);
        $project = Project::create([
            'name' => $request->name,
            'client_id' => $request->client,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'rate' => $request->rate,
            'rateType' => $request->rateType,
            'priority' => $request->priority,
            'leader_id' => $request->leader,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ]);
        $projectFiles = $request->projectFiles ?? [];
        if(!empty($projectFiles) && count($projectFiles) > 0){
            foreach($projectFiles as $file){
                $project->addMedia($file)->toMediaCollection('project-files');
            }
        }
        // Add Project Team 
        $projectTeam = $request->team ?? [];
        if(!empty($projectTeam) && count($projectTeam) > 0){
            foreach($projectTeam as $member){
                $project->team()->create([
                    'user_id' => $member
                ]);
            }
        }
        // Project task Board
        $defaultBoards = TaskBoard::get()->map(function(TaskBoard $board) use($project){
            return [
                'project_id' => $project->id,
                'name' => $board->name,
                'color' => $board->color,
                'priority' => $board->priority,
                'created_by' => $board->created_by
            ];
        });
        if(!empty($defaultBoards) && $defaultBoards->count() > 0){
            ProjectTaskBoard::insert($defaultBoards->all());
        }
        $notification = notify(__("Project has been added"));
        return back()->with($notification);
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        try {
            $pageTitle = __("Project Details");
            $project = Project::findOrFail(Crypt::decrypt($id));
            $projectFiles = $project->getMedia('project-files');
            return view('project::show',compact(
                'project','pageTitle','projectFiles'
            ));
        }catch(\Exception $e){
            // $notification = notify($e->getMessage(),'error');
            $notification = notify("Something went wrong. Project can't be viewd");
            return back()->with($notification);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $clients = User::where('is_active', true)->where('type', UserType::CLIENT)->get();
        $employees = User::where('is_active', true)->where('type', UserType::EMPLOYEE)->get();
        return view('project::edit',compact(
            'project','clients','employees'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'leader' => 'required',
            'projectFiles' => 'nullable',
            'rate' => 'required|numeric',
            'rateType' => 'required',
            'priority' => 'required',
            'startDate' => 'required|date|before:endDate',
            'endDate' => 'required|date|after_or_equal:startDate',
            'short_desc' => 'required|max:255|string',
        ]);
        $project->update([
            'name' => $request->name,
            'client_id' => $request->client,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
            'rate' => $request->rate,
            'rateType' => $request->rateType,
            'priority' => $request->priority,
            'leader_id' => $request->leader,
            'short_desc' => $request->short_desc,
            'description' => $request->description,
            'created_by' => auth()->user()->id
        ]);
        $projectFiles = $request->projectFiles ?? [];
        if(!empty($projectFiles) && $request->hasFile('projectFiles') && count($projectFiles) > 0){
            foreach($projectFiles as $file){
                $project->addMedia($file)->toMediaCollection('project-files');
            }
        }
        // Add Project Team 
        $projectTeam = $request->team ?? [];
        if(!empty($projectTeam) && count($projectTeam) > 0){
            foreach($projectTeam as $member){
                $project->team()->update([
                    'user_id' => $member
                ]);
            }
        }
        $notification = notify(__("Project has been updated"));
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        $notification = notify(__("Project has been deleted"));
        return back()->with($notification);
    }

    public function destroyProjectFile(Media $file){
        $file->delete();
        $notification = notify(__('Project file has been deleted'));
        return back()->with($notification);
    }
}
