<?php

namespace App\Filament\Resources\SummerCampResource\Pages;

use App\Filament\Resources\SummerCampResource;
use CactusGalaxy\FilamentAstrotomic\Resources\Pages\Record\EditTranslatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSummerCamp extends EditRecord
{
    use EditTranslatable;

    protected static string $resource = SummerCampResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
