<?php

namespace App\Filament\Resources\SummerCampResource\Pages;

use App\Filament\Resources\SummerCampResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\CreateTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSummerCamp extends CreateRecord
{
    use CreateTranslatable;

    protected static string $resource = SummerCampResource::class;
}
