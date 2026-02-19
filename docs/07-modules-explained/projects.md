# Project Module

The Project module is the operational core for service-based organizations.

## Overview

It handles the execution of work, from project initiation to task management and team collaboration. It includes a Kanban-style task board.

## Key Features

*   **Project Management**: Track project details, deadlines, and budgets.
*   **Task Boards**: Kanban board (To Do, In Progress, Done) for tasks.
*   **Team Management**: Assign employees and leaders to projects.
*   **Tasks**: Granular work items with deadlines and priority.
*   **Sub-tasks and Comments**: Detailed task tracking.

## Models & Database

| Model | Table | Description |
| :--- | :--- | :--- |
| `Project` | `projects` | Main project entity. |
| `ProjectTeam` | `project_teams` | Pivot: Project <-> User. |
| `ProjectLead` | `project_leads` | Pivot: Project <-> User (Leader). |
| `Task` | `tasks` | Unit of work. |
| `SubTask` | `sub_tasks` | Smaller units under a task. |
| `TaskBoard` | `task_boards` | Kanban columns. |
| `TaskComment` | `task_comments` | Collaboration on tasks. |

## Workflow

1.  **Create Project**: Manager creates a new project (e.g., "Website Redesign").
2.  **Assign Team**: Manager adds developers and designers to the project.
3.  **Create Tasks**: Tasks are added to the "To Do" column.
4.  **Work Execution**: Employees drag tasks to "In Progress", add comments.
5.  **Completion**: Tasks moved to "Done".

## Routes

Prefix: `/` (Root level in web.php, internally grouped)

| Method | URI | Controller |
| :--- | :--- | :--- |
| GET | `/projects` | `ProjectController@index` |
| GET | `/project-taskboard/{id}` | `ProjectTaskBoardController@board` |
| POST | `/project-tasks` | `ProjectTaskBoardController@store` |
| POST | `/taskboard/update-task` | `ProjectTaskBoardController@draggable` (AJAX) |
