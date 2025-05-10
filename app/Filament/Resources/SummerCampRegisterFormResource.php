<?php

namespace App\Filament\Resources;

use App\Filament\Components\TextInput;
use App\Filament\Resources\ContactUsResource\Pages\ListContactUs;
use App\Filament\Resources\SummerCampRegisterFormResource\Pages;
use App\Filament\Resources\SummerCampRegisterFormResource\RelationManagers;
use App\Helpers\BaseExport;
use App\Models\Dropdown\Dropdown;
use App\Models\SummerCamp\SummerCamp;
use App\Models\SummerCamp\SummerCampRegisterForm;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class SummerCampRegisterFormResource extends Resource
{
    protected static ?string $model = SummerCampRegisterForm::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    public static function getNavigationLabel(): string
    {
        return __("Summer Camp Registration Forms");
    }

    public static function getModelLabel(): string
    {
        return __("Summer Camp Registration Form");
    }

    public static function getPluralLabel(): ?string
    {
        return __("Summer Camp Registration Forms");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Summer Camp Registration Forms");
    }

    public static function getNavigationGroup(): ?string
    {
        return __("Forms");
    }

    public static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function (){
                return self::$model::orderBy('created_at', 'desc');
            })
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->label(__("Name")),
                Tables\Columns\TextColumn::make("phone")
                    ->label(__("Phone"))
                    ->toggleable(),
                Tables\Columns\TextColumn::make("age_id")
                    ->label(__("Age"))
                    ->formatStateUsing(function ($record){
                        return Dropdown::find($record->age_id)->title;
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make("gender_id")
                    ->label(__("Age"))
                    ->formatStateUsing(function ($record){
                        return Dropdown::find($record->gender_id)->title;
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make("summer_camp_id")
                    ->label(__("Summer Camp"))
                    ->formatStateUsing(function ($record){
                        return SummerCamp::find($record->summer_camp_id)?->title ?? "----";
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make("email")
                    ->toggleable()
                    ->label(__("Email")),
                Tables\Columns\TextColumn::make("created_at")
                    ->label(__("Created At"))
                    ->toggleable()
                    ->since()
            ])
            ->filters([
                Tables\Filters\Filter::make('name')
                    ->form([
                        TextInput::make('name')
                            ->label(__("Name")),
                        TextInput::make('email')
                            ->label(__("Email")),
                        TextInput::make('phone')
                            ->label(__("phone"))
                    ])
                    ->query(function (Builder $query, array $data){
                        $query->when(
                            $data['name'],
                            fn (Builder $builder, $name) => $query->where('name', 'like', '%' . $name . '%'));
                        $query->when(
                            $data['email'],
                            fn (Builder $builder, $email) => $query->where('email', 'like', '%' . $email . '%'));
                        $query->when(
                            $data['phone'],
                            fn (Builder $builder, $email) => $query->where('phone', 'like', '%' . $phone . '%'));
                    })
            ])
            ->actions([
                Tables\Actions\Action::make('Message')
                    ->label(__("Message"))
                    ->modalHeading(function($record){
                        return "{$record->name} " . __("Message");
                    })
                    ->modalContent(function ($record){
                        return view('filament.Contact Us.Message', ['record' => $record]);
                    })
                    ->modalSubmitAction(false)
                    ->modalCancelAction(false),
                Tables\Actions\DeleteAction::make()
            ])
            ->poll('30s')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make('Export')->label(__('Export'))->exports([
                        BaseExport::make()->fromModel()
                    ]),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }


    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSummerCampRegisterForms::route('/'),
        ];
    }

    public static function canCreate(): bool
    {
        return False;
    }

    public static function canEdit(Model $record): bool
    {
        return False;
    }
}
