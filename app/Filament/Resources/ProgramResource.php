<?php

namespace App\Filament\Resources;

use App\Exports\ActivityExport;
use App\Exports\ProgramExport;
use App\Filament\Components\FileUpload;
use App\Filament\Components\TextInput;
use App\Filament\Components\TiptapEditor;
use App\Filament\Resources\ProgramResource\Pages;
use App\Filament\Resources\ProgramResource\RelationManagers;
use App\Helpers\Utilities;
use App\Models\Language;
use App\Models\Program;
use CactusGalaxy\FilamentAstrotomic\Forms\Components\TranslatableTabs;
use CactusGalaxy\FilamentAstrotomic\TranslatableTab;
use Carbon\Carbon;
use Filament\Facades\Filament;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class ProgramResource extends Resource
{
    protected static ?string $model = Program\Program::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __("Programs");
    }

    public static function getModelLabel(): string
    {
        return __("Program");
    }

    public static function getPluralLabel(): ?string
    {
        return __("Programs");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Programs");
    }

    public static function getNavigationGroup(): ?string
    {
        return __("Education");
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
                    Forms\Components\Grid::make()->schema([
                        TranslatableTabs::make()
                            ->localeTabSchema(fn (TranslatableTab $tab) =>[
                                FileUpload::make('image_id')
                                    ->label(__("Image"))
                                    ->multiple(false)
                                    ->required(),

                                TextInput::make($tab->makeName('title'))
                                    ->label(__("Title"))
                                    ->maxLength(255)
                                    ->multiLingual()
                                    ->unique(ignoreRecord: true)
                                    ->required(),

                                TiptapEditor::make($tab->makeName('inner_description'))
                                    ->required()
                                    ->label(__("Inner page description")),

                                TiptapEditor::make($tab->makeName('description'))
                                    ->required()
                                    ->label(__("Description"))
                            ])->columnSpanFull(),

                        Forms\Components\Section::make()->schema([
                            Forms\Components\Repeater::make('features')
                                ->label(__("Features"))
                                ->relationship()
                                ->defaultItems(0)
                                ->schema(function (){
                                    $tabs = [];
                                    foreach(config('app.locales') as $locale => $language){
                                        $tabs[] = Forms\Components\Tabs\Tab::make($language)
                                            ->schema([
                                                TextInput::make("{$locale}.title")
                                                    ->label(__("Title"))
                                                    ->required()
                                                    ->maxLength(255),

                                                \App\Filament\Components\TinyEditor::make("{$locale}.content")
                                                    ->label(__("Content"))
                                                    ->showMenuBar()
                                                    ->toolbarSticky(true),
                                            ]);
                                    }
                                    return [Forms\Components\Tabs::make()->tabs($tabs)];
                                })

                        ])->columnSpanFull(),

                        Forms\Components\Section::make()->heading(__('Documents'))->schema([
                            (function(){
                                $tabs = [];
                                foreach (Language::all() as $language){
                                    $tabs[] = Forms\Components\Tabs\Tab::make($language->language)
                                        ->schema([
                                            \App\Filament\Components\TiptapEditor::make("{$language->locale}.downloads_section_description")
                                                ->maxLength(255)
                                                ->label(__("Downloads Section Description"))
                                        ]);
                                }
                                return Forms\Components\Tabs::make()->tabs($tabs);
                            })(),

                            Forms\Components\Repeater::make('documents')
                                ->relationship()
                                ->label('')
                                ->defaultItems(0)
                                ->itemLabel(__("Document"))
                                ->schema(function (){
                                    $tabs = [];
                                    foreach(config('app.locales') as $locale => $language){
                                        $tabs[] = Forms\Components\Tabs\Tab::make($language)
                                            ->schema([
                                                FileUpload::make("{$locale}.image_id")
                                                    ->label(__("Document"))
                                                    ->multiple(false)
                                                    ->required(),
                                                TextInput::make("{$locale}.title")
                                                    ->label(__("Title"))
                                                    ->maxLength(255)
                                            ]);
                                    }
                                    return [Forms\Components\Tabs::make()->tabs($tabs)];
                                })


                        ])->columnSpanFull(),
                    ])->columnSpan(2),

                    Forms\Components\Grid::make(1)->schema([
                        Forms\Components\Section::make()->schema(
                            array_merge(
                                Filament::auth()->user()->can('change_author_program') ? [
                                    Forms\Components\Select::make('author.name')
                                        ->label(__("Author"))
                                        ->relationship('author', 'name')
                                        ->default(Filament::auth()->user()->id)
                                        ->required()
                                        ->native(false)
                                ] : [] , [

                                Forms\Components\Checkbox::make('promote_to_homepage')
                                    ->label(__('Promote to homepage')),

                                TextInput::make('slug')
                                    ->label(__("Slug"))
                                    ->unique(ignoreRecord: true)
                                    ->disabledOn('edit')
                                    ->helperText(__("Will Be Auto Generated From Title"))
                                    ->markAsRequired('true'),

                                Forms\Components\DatePicker::make('published_at')
                                    ->label(__("Published At"))
                                    ->default(Carbon::today())
                                    ->native(false)
                                    ->required(),
                                Forms\Components\Select::make('status')
                                    ->label(__("Status"))
                                    ->options(Program\Program::getStatuses())
                                    ->native(false)
                                    ->default(1)
                            ])
                        )
                    ])->columnSpan(1),
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
                Tables\Columns\ImageColumn::make('image_id')
                    ->label("Image")
                    ->toggleable()
                    ->getStateUsing(function ($record){
                        if ($record->image) {
                            return asset($record->image->url);
                        }
                        return asset('/storage/' . "panel-assets/no-image.png") ;
                    })
                    ->default(asset('/storage/panel-assets/no-image.png'))
                    ->circular(),
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
                    ->color(function (Program\Program $record){
                        return $record->status == Utilities::PUBLISHED ? "success" : "danger";
                    })
                    ->formatStateUsing(function(Program\Program $record){
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
                Tables\Filters\SelectFilter::make('author')
                    ->label(__("Author"))
                    ->searchable()
                    ->relationship('author', 'name')
                    ->native(false),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__("Status"))
                    ->options(Program\Program::getStatuses())
                    ->searchable()
                    ->native(false)
            ])
            ->poll("30s")
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make('Export')->label(__('Export'))->exports([
                        ProgramExport::make()->fromModel()
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
            'index' => Pages\ListPrograms::route('/'),
            'create' => Pages\CreateProgram::route('/create'),
            'edit' => Pages\EditProgram::route('/{record}/edit'),
        ];
    }
}
