<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('localization.country', 'USA');
        $this->migrator->add('localization.date_format', 'D M Y');
        $this->migrator->add('localization.timezone', 'UTC');
        $this->migrator->add('localization.lang', 'en');
        $this->migrator->add('localization.currency_symbol', '$');
        $this->migrator->add('localization.currency_code', 'usd');
    }
};
