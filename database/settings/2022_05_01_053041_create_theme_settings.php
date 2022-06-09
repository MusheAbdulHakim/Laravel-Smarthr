<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateThemeSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('theme.site_name',config('app.name'));
        $this->migrator->add('theme.logo','');
        $this->migrator->add('theme.favicon','');
        $this->migrator->add('theme.currency_symbol','$');
        $this->migrator->add('theme.currency_code','USD');
    }
}
