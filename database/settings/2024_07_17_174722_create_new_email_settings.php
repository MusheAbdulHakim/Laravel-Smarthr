<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('email.mailer', 'smtp');
        $this->migrator->add('email.from_address','example@smarthr.com');
        $this->migrator->add('email.from_name','Super Admin');
        $this->migrator->add('email.host','localhost');
        $this->migrator->add('email.port','1025');
        $this->migrator->add('email.enc', '');
        $this->migrator->add('email.domain', '');
        $this->migrator->add('email.user', '');
        $this->migrator->add('email.password', '');
    }
};
