<?php

namespace Modules\Project\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Modules\Project\Models\Project;
use Modules\Project\Models\Task;

class ProjectApiController extends Controller
{
    public function index(): JsonResponse
    {
        $projects = Project::with(['client', 'leader', 'team.user', 'lead.user'])->get();

        return response()->json([
            'data' => $projects->map(fn ($p) => [
                'id' => $p->id,
                'name' => $p->name,
                'short_desc' => $p->short_desc,
                'startDate' => $p->startDate,
                'endDate' => $p->endDate,
                'rate' => $p->rate,
                'rateType' => $p->rateType,
                'priority' => $p->priority,
                'status' => $p->status,
                'client' => $p->client ? ['id' => $p->client->id, 'name' => $p->client->name] : null,
                'leader' => $p->leader ? ['id' => $p->leader->id, 'name' => $p->leader->name] : null,
            ]),
        ]);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'nullable|exists:users,id',
            'short_desc' => 'nullable|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after:startDate',
            'rate' => 'nullable|numeric',
            'rateType' => 'nullable|in:hourly,fixed',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'leader_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $validated['created_by'] = $request->user()->id;

        $project = Project::create($validated);

        return response()->json(['data' => $project], 201);
    }

    public function show(int $id): JsonResponse
    {
        $project = Project::with(['client', 'leader', 'team.user', 'lead.user', 'tasks', 'taskBoard'])->findOrFail($id);

        return response()->json(['data' => $project]);
    }

    public function update(Request $request, int $id): JsonResponse
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'client_id' => 'nullable|exists:users,id',
            'short_desc' => 'nullable|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date|after:startDate',
            'rate' => 'nullable|numeric',
            'rateType' => 'nullable|in:hourly,fixed',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'status' => 'nullable|in:pending,in_progress,completed,cancelled',
            'leader_id' => 'nullable|exists:users,id',
            'description' => 'nullable|string',
        ]);

        $project->update($validated);

        return response()->json(['data' => $project]);
    }

    public function destroy(int $id): JsonResponse
    {
        $project = Project::findOrFail($id);
        $project->delete();

        return response()->json(null, 204);
    }

    public function tasks(int $projectId): JsonResponse
    {
        $project = Project::findOrFail($projectId);
        $tasks = $project->tasks()->with(['taskBoard', 'createdBy'])->get();

        return response()->json(['data' => $tasks]);
    }

    public function storeTask(Request $request, int $projectId): JsonResponse
    {
        $project = Project::findOrFail($projectId);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'project_task_board_id' => 'nullable|exists:project_task_boards,id',
            'priority' => 'nullable|in:low,medium,high,urgent',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $validated['project_id'] = $project->id;
        $validated['created_by'] = $request->user()->id;

        $task = Task::create($validated);

        return response()->json(['data' => $task], 201);
    }
}
