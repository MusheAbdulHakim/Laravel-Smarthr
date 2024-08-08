<?php

namespace Modules\Whiteboard\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class WhiteboardDatabaseSeeder extends Seeder
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
            'TlDraw' => [
                'view-tldraw',
            ],
            'ExcaliDraw' => [
                'view-excalidraw',
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
    }
}
