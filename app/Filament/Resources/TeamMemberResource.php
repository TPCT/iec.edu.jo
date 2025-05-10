<?php

namespace App\Filament\Resources;

use App\Exports\AwardExport;
use App\Exports\TeamMemberExport;
use App\Filament\Components\FileUpload;
use App\Filament\Components\TextInput;
use App\Filament\Components\TiptapEditor;
use App\Filament\Resources\TeamMemberResource\Pages;
use App\Filament\Resources\TeamMemberResource\RelationManagers;
use App\Helpers\Utilities;
use App\Models\Download\Download;
use App\Models\Dropdown\Dropdown;
use App\Models\TeamMember;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class TeamMemberResource extends Resource
{
    protected static ?string $model = TeamMember\TeamMember::class;

    protected static ?string $navigationIcon = 'bi-person-fill';

    public static function getNavigationLabel(): string
    {
        return __("Team Members");
    }

    public static function getModelLabel(): string
    {
        return __("Team Member");
    }

    public static function getPluralLabel(): ?string
    {
        return __("Team Members");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Team Members");
    }

    public static function getNavigationGroup(): ?string
    {
        return __("About IEC");
    }

    public static function getNavigationBadge(): ?string
    {
        return self::$model::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Grid::make(3)->schema([
                    TranslatableTabs::make()
                        ->localeTabSchema(fn (TranslatableTab $tab) => [
                            FileUpload::make('image_id')
                                ->label(__('Image'))
                                ->multiple(false)
                                ->required(function(Forms\Get $get){
                                    return $get('data.dropdown_id') == Dropdown::whereSlug('board-director')->first()->id;
                                })
                                ->visible(function (Forms\Get $get){
                                    return $get('data.dropdown_id', true) == Dropdown::whereSlug('board-director')->first()->id;
                                }),

                            TextInput::make($tab->makeName('title'))
                                ->label(__("Title"))
                                ->maxLength(255)
                                ->multiLingual()
                                ->required(),

                            TiptapEditor::make($tab->makeName('description'))
                                ->label(__('Description'))
                                ->maxlength(255)
                                ->required(function(Forms\Get $get){
                                    return $get('data.dropdown_id') == Dropdown::whereSlug('board-director')->first()->id;
                                })
                                ->visible(function (Forms\Get $get){
                                    return $get('data.dropdown_id', true) == Dropdown::whereSlug('board-director')->first()->id;
                                })

                        ])->columnSpan(2),
                    Forms\Components\Section::make()->schema(
                        array_merge(
                            Filament::auth()->user()->can('change_author_team-member') ? [
                                Select::make('author.name')
                                    ->label(__("Author"))
                                    ->relationship('author', 'name')
                                    ->default(Filament::auth()->user()->id)
                                    ->required()
                                    ->native(false)
                            ] : [] , [

                            Select::make('dropdown_id')
                                ->label(__("Category"))
                                ->required()
                                ->native(false)
                                ->searchable()
                                ->preload()
                                ->default(null)
                                ->live()
                                ->options(self::$model::getCategoryList()),

                            Select::make('weight')
                                ->default(self::$model::count())
                                ->label(__("Weight"))
                                ->options(range(0, self::$model::count()))
                                ->native(false),

                            Forms\Components\DatePicker::make('published_at')
                                ->label(__("Published At"))
                                ->default(Carbon::today())
                                ->native(false)
                                ->required(),

                            Select::make('status')
                                ->label(__("Status"))
                                ->options(Download::getStatuses())
                                ->native(false)
                                ->default(1)
                        ])
                    )->columnSpan(1)

                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(function(){
                return self::$model::orderBy('published_at', 'desc');
            })
            ->columns([
                Tables\Columns\TextColumn::make('translation.title')
                    ->toggleable()
                    ->searchable(query: function ($query, $search){
                        return $query->whereTranslationLike('title', '%'.$search.'%');
                    })
                    ->label(__("Title")),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->label(__("Status"))
                    ->badge()
                    ->color(function (TeamMember\TeamMember $record){
                        return $record->status == Utilities::PUBLISHED ? "success" : "danger";
                    })
                    ->formatStateUsing(function(TeamMember\TeamMember $record){
                        return $record->status == Utilities::PUBLISHED ? __("Published") : __("Pending");
                    }),
                Tables\Columns\TextColumn::make('published_at')
                    ->toggleable()
                    ->label(__("Publish Time"))
                    ->date(),
                Tables\Columns\TextColumn::make('author.name')
                    ->toggleable()
                    ->label(__("Author"))
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label(__("Status"))
                    ->options(TeamMember\TeamMember::getStatuses())
                    ->searchable()
                    ->native(false)
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
            ])
            ->poll('30s')
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make('Export')->label(__('Export'))->exports([
                        TeamMemberExport::make()->fromModel()
                    ]),
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
            'index' => Pages\ListTeamMembers::route('/'),
            'create' => Pages\CreateTeamMember::route('/create'),
            'edit' => Pages\EditTeamMember::route('/{record}/edit'),
        ];
    }
}
