<?php

namespace App\Filament\Resources\SummerCampRegisterFormResource\Pages;

use App\Filament\Resources\SummerCampRegisterFormResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSummerCampRegisterForms extends ListRecords
{
    protected static string $resource = SummerCampRegisterFormResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
