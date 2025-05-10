<?php

namespace App\Exports;

use App\Helpers\BaseExport;

class AwardExport extends BaseExport
{
    protected array $exclude = [
        'weight', 'slug', 'status', 'promote', 'image', 'image_id', 'id', 'features', 'link', 'buttons', 'bullets'
    ];
}
