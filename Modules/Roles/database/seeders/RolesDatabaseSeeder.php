<?php

namespace Modules\Roles\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Permission;

class RolesDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Model::unguard(true);
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissionsArray = [];
        $my_permissions = [
            'backups' => [
                'view-backups','create-backup','download-backup','delete-backup',
            ],
            'users' => [
                'view-users','create-user','edit-user','show-Userprofile','delete-user',
            ],
            'roles' => [
                'view-roles','create-role','edit-role','delete-role',
            ],
            'permissions' => [
                'view-permissions','create-permission','edit-permission','delete-permission',
            ],
            'settings' => ['view-settings'],
            'impersonate'=> ['impersonate-users', 'impersonate-clients', 'impersonate-employees'],
            'logs' => ['view-logs'],
            'calendar' => ['view-calendar'],
            'clients' => [
                'view-clients','create-client','edit-client','show-Clientprofile','delete-client'
            ],
            'employees' => [
                'view-employees','create-employee','edit-employee','show-Employeeprofile','delete-employee'
            ],
            'Attendances' => [
                'view-attendances','create-attendance','edit-attendance','show-attendance','delete-attendance'
            ],
            'Tickets' => [
                'view-tickets','create-ticket','edit-ticket','show-ticket','delete-ticket'
            ],
            'Payroll' => [
                'view-payrolls','create-payroll','edit-payroll','show-payroll','delete-payroll'
            ],
            'Payslip' => [
                'view-payslips','create-payslip','edit-payslip','show-payslip','delete-payslip'
            ],
            'PayrollAllowances' => [
                'view-PayrollAllowances','create-PayrollAllowance','edit-PayrollAllowance','delete-PayrollAllowance'
            ],
            'PayrollDeductions' => [
                'view-PayrollDeductions','create-PayrollDeduction','edit-PayrollDeduction','delete-PayrollDeduction'
            ],
            'assets' => [
                'view-assets','create-asset','edit-asset','show-asset','delete-asset'
            ],
            'departments' => ['view-departments','create-department','edit-department','delete-department'],
            'designations' => ['view-designations','create-designation','edit-designation','delete-designation'],
            'holidays' => ['view-holidays','create-holiday','edit-holiday','delete-holiday'],
        ];

        $guard = 'web';

        foreach ($my_permissions as $module => $permissions) {
            foreach ($permissions as $permission) {
                $permissionsArray[] = [
                    "name" => $permission,
                    "module" => $module,
                    "guard_name" => $guard
                ];
            }
        }

        Permission::insert($permissionsArray);
        Role::insert([
            [
                'name' => 'Super Admin',
                'guard_name' => $guard
            ],
            [
                'name' => 'Employee',
                'guard_name' => $guard
            ],
            [
                'name' => 'Client',
                'guard_name' => $guard
            ],
            [
                'name' => 'Manager',
                'guard_name' => $guard
            ],
            [
                'name' => 'Accountant',
                'guard_name' => $guard
            ],
            [
                'name' => 'HR',
                'guard_name' => $guard
            ]
        ]);
        $super_admin = Role::where('name','Super Admin')->first();
        $super_admin->givePermissionTo(Permission::all());
        $user = User::find(1);
        $user->assignRole('Super Admin');
        Model::unguard(false);

    }
}
