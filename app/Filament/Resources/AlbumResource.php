<?php

namespace App\Filament\Resources;

use App\Exports\ActivityExport;
use App\Exports\AlbumExport;
use App\Filament\Components\FileUpload;
use App\Filament\Components\TextInput;
use App\Filament\Components\TinyEditor;
use App\Filament\Resources\AlbumResource\Pages;
use App\Filament\Resources\AlbumResource\RelationManagers;
use App\Helpers\Utilities;
use App\Models\Album;
use App\Models\Language;
use App\Models\News\News;
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
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class AlbumResource extends Resource
{
    protected static ?string $model = Album\Album::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = 1;

    public static function getNavigationLabel(): string
    {
        return __("Albums");
    }

    public static function getModelLabel(): string
    {
        return __("Album");
    }

    public static function getPluralLabel(): ?string
    {
        return __("Albums");
    }

    public static function getPluralModelLabel(): string
    {
        return __("Albums");
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
                    Forms\Components\Grid::make()->schema([
                        Forms\Components\Section::make()->schema([
                            TranslatableTabs::make()
                                ->localeTabSchema(fn (TranslatableTab $tab) => [
                                    FileUpload::make('image_id')
                                        ->label(__("Image"))
                                        ->multiple(false)
                                        ->required(),

                                    TextInput::make($tab->makeName('title'))
                                        ->label(__("Title"))
                                        ->required()
                                        ->maxLength(255)
                                ])->columnSpanFull(),
                        ]),
                        Forms\Components\Section::make()->heading(__("Images"))->schema([
                            Forms\Components\Repeater::make('images')
                                ->relationship()
                                ->label('')
                                ->defaultItems(0)
                                ->itemLabel(__("Image"))
                                ->schema(function(){
                                    $tabs = [];
                                    foreach(config('app.locales') as $locale => $language){
                                        $tabs[] = Forms\Components\Tabs\Tab::make($language)
                                            ->schema([
                                                FileUpload::make("image_id")
                                                    ->label(__("Image"))
                                                    ->multiple(false)
                                                    ->required(),
                                                TextInput::make("{$locale}.caption")
                                                    ->label(__("Caption"))
                                                    ->maxLength(255)
                                            ]);
                                    }
                                    return [Forms\Components\Tabs::make()->tabs($tabs)];
                                })
                        ])->visible(function(Forms\Get $get){
                            return $get('data.type', true) == self::$model::PHOTOS_ALBUM;
                        })
                    ])->columnSpan(2),

                    Forms\Components\Grid::make(1)->schema([
                        Forms\Components\Section::make()->schema(
                            array_merge(
                                Filament::auth()->user()->can('change_author_album') ? [
                                    Select::make('author.name')
                                        ->label(__("Author"))
                                        ->relationship('author', 'name')
                                        ->default(Filament::auth()->user()->id)
                                        ->required()
                                        ->native(false)
                                ] : [] , [
                                Select::make('type')
                                    ->label(__("Type"))
                                    ->options(self::$model::getTypes())
                                    ->live()
                                    ->native(false)
                                    ->default(self::$model::PHOTOS_ALBUM),

                                TranslatableTabs::make()
                                    ->localeTabSchema(fn (TranslatableTab $tab) => [
                                        TextInput::make($tab->makeName('video_url'))
                                            ->label(__("Video Url"))
                                            ->required()
                                            ->maxLength(255)
                                    ])
                                    ->visible(function (Forms\Get $get){
                                        return $get('data.type', true) == self::$model::VIDEOS_ALBUM;
                                    }),

                                Forms\Components\DatePicker::make('published_at')
                                    ->label(__("Published At"))
                                    ->default(Carbon::today())
                                    ->native(false),

                                Select::make('status')
                                    ->label(__("Status"))
                                    ->options(Album\Album::getStatuses())
                                    ->native(false)
                                    ->default(1),

                                Select::make('weight')
                                    ->default(self::$model::count())
                                    ->label(__("Weight"))
                                    ->options(range(0, self::$model::count()))
                                    ->native(false)
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
                Tables\Columns\TextColumn::make('type')
                    ->toggleable()
                    ->label(__("Type"))
                    ->badge(),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->label(__("Status"))
                    ->badge()
                    ->color(function (Album\Album $record){
                        return $record->status == Utilities::PUBLISHED ? "success" : "danger";
                    })
                    ->formatStateUsing(function(Album\Album $record){
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
                Tables\Filters\SelectFilter::make('type')
                    ->label(__("Type"))
                    ->searchable()
                    ->options(Album\Album::getTypes())
                    ->native(false),
                Tables\Filters\SelectFilter::make('status')
                    ->label(__("Status"))
                    ->options(Album\Album::getStatuses())
                    ->searchable()
                    ->native(false)
            ])
            ->poll("30s")
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make('Export')->label(__('Export'))->exports([
                        AlbumExport::make()->fromModel()
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
            'index' => Pages\ListAlbums::route('/'),
            'create' => Pages\CreateAlbum::route('/create'),
            'edit' => Pages\EditAlbum::route('/{record}/edit'),
        ];
    }
}
