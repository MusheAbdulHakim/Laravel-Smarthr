<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('company.name', '');
        $this->migrator->add('company.contact_person', '');
        $this->migrator->add('company.address', '');
        $this->migrator->add('company.country', '');
        $this->migrator->add('company.city', '');
        $this->migrator->add('company.province', '');
        $this->migrator->add('company.postal_code', '');
        $this->migrator->add('company.email', '');
        $this->migrator->add('company.phone', '');
        $this->migrator->add('company.mobile', '');
        $this->migrator->add('company.fax', '');
        $this->migrator->add('company.website_url', '');
    }
};
