<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

class CreateInvoiceSettings extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('invoice.logo', '');
        $this->migrator->add('invoice.prefix', 'INV-');
    }
}
