<?php

namespace Modules\Sales\Database\Seeders;

use Modules\Sales\Models\Tax;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class SalesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tax::insert([
            [
                'name' => 'VAT',
                'percentage' => 14,
                'active' => true
            ],
            [
                'name' => 'GST',
                'percentage' => 30,
                'active' => true
            ],
        ]);
        Model::unguard();
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        $permissionsArray = [];
        $module_permissions = [
            'Estimate' => [
                'view-estimates','create-estimate','edit-estimate','show-estimate','delete-estimate',
            ],
            'Invoice' => [
                'view-invoices','create-invoice','edit-invoice','show-invoice','delete-invoice',
            ],
            'Expense' => [
                'view-expenses','create-expense','edit-expense','delete-expense',
            ],
            'Tax' => [
                'view-taxs','create-tax','edit-tax','delete-tax',
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
    }
}
