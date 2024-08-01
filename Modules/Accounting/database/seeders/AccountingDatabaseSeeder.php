<?php

namespace Modules\Accounting\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class AccountingDatabaseSeeder extends Seeder
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
            'BudgetCategory' => [
                'view-budgetCategories','create-budgetCategory','edit-budgetCategory','delete-budgetCategory',
            ],
            'BudgetExpenses' => [
                'view-budgetExpenses','create-budgetExpense','edit-budgetExpense','delete-budgetExpense',
            ],
            'BudgetRevenue' => [
                'view-budgetRevenues','create-budgetRevenue','edit-budgetRevenue','delete-budgetRevenue',
            ],
            'Budget' => [
                'view-budgets','create-budget','edit-budget','delete-budget',
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
