<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general_salary.enable_da_hra', false);
        $this->migrator->add('general_salary.da_percent', 0);
        $this->migrator->add('general_salary.hra_percent', 0);

        $this->migrator->add('general_salary.enable_provident_fund', false);
        $this->migrator->add('general_salary.emp_pf_percentage', 0);
        $this->migrator->add('general_salary.company_pf_percentage', 0);
        
        $this->migrator->add('general_salary.enable_esi_fund', false);
        $this->migrator->add('general_salary.emp_esi_percentage', 0);
        $this->migrator->add('general_salary.company_esi_percentage', 0);

    }
};
