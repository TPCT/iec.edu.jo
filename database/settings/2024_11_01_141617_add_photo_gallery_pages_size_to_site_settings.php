<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('site.photos_gallery_page_size', 5);
        $this->migrator->add('site.videos_gallery_page_size', 5);
    }
};
