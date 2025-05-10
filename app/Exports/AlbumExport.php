<?php

namespace App\Exports;

use App\Helpers\BaseExport;

class AlbumExport extends BaseExport
{
    protected array $exclude = [
        'weight', 'slug', 'status', 'promote',
        'image', 'inner_image', 'id', 'features',
        'link', 'buttons', 'bullets', 'form_type',
        'validations', 'category', 'url', 'promote_to_homepage',
        'prefix', 'header_image', 'view', 'direct_access'
    ];
}
