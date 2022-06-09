<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateCompanySettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.company_name','Test company');
        $this->migrator->add('general.contact_person','John Doe');
        $this->migrator->add('general.address','3864 Quiet Valley Lane, Sherman Oaks, CA, 91403');
        $this->migrator->add('general.country','Ghana');
        $this->migrator->add('general.city','Tamale');
        $this->migrator->add('general.province','California');
        $this->migrator->add('general.postal_code','0233');
        $this->migrator->add('general.email','testcompany@mail.com');
        $this->migrator->add('general.phone','233209229025');
        $this->migrator->add('general.mobile','233209229025');
        $this->migrator->add('general.fax','818-978-7102');
        $this->migrator->add('general.website_url','https://www.example.com');
    }
}
