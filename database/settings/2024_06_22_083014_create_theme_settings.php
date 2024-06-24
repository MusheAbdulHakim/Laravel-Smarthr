<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('theme.name', 'SmartHr');
        $this->migrator->add('theme.logo_light', '');
        $this->migrator->add('theme.logo_dark', '');
        $this->migrator->add('theme.favicon', '');
        $this->migrator->add('theme.theme', 'default');
        $this->migrator->add('theme.layout', 'vertical');
        $this->migrator->add('theme.color_scheme', 'default');
        $this->migrator->add('theme.layout_width', 'fluid');
        $this->migrator->add('theme.layout_position', 'fixed');
        $this->migrator->add('theme.topbar_color', 'default');
        $this->migrator->add('theme.sidebar_color', 'dark');
        $this->migrator->add('theme.sidebar_size', 'lg');
        $this->migrator->add('theme.sidebar_view', 'default');
        $this->migrator->add('theme.sidebar_img', 'none');
    }
};
