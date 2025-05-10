<?php

namespace App\Filament\Resources\SummerCampResource\Pages;

use App\Filament\Resources\SummerCampResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\ListTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSummerCamps extends ListRecords
{
    use ListTranslatable;

    protected static string $resource = SummerCampResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
