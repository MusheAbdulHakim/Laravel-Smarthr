<?php

namespace Modules\Project\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class ProjectDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissionsArray = [];
        $module_permissions = [
            'Projects' => [
                'view-projects','create-project','edit-project','show-project','delete-project',
            ],
            'Project Task' => [
                'view-tasks','create-task','edit-task', 'show-task','delete-task',
            ],
            'Taskboard' => [
                'view-taskboards','create-taskboard','edit-taskboard','show-taskboard','delete-taskboard',
            ],
        ];
        foreach ($module_permissions as $module => $permissions) {
            foreach ($permissions as $permission) {
                $permissionsArray[] = [
                    "name" => $permission,
                    "module" => $module,
                    "guard_name" => "web"
                ];
            }
        }
        Permission::insert($permissionsArray);
        Model::unguard(false);
        $this->call([
            TaskBoardSeeder::class,
        ]);
    }
}
