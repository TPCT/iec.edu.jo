<?php

namespace App\Filament\Pages;

use App\Exports\SiteSettingsExport;
use App\Filament\Components\FileUpload;
use App\Filament\Components\TextInput;
use App\Helpers\SettingsExport;
use FilamentTiptapEditor\TiptapEditor;
use App\Settings\Site;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;
use Faker\Provider\Text;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\SettingsPage;
use Filament\Resources\Concerns\Translatable;
use Illuminate\Contracts\Support\Htmlable;
use Maatwebsite\Excel\Excel;
use pxlrbt\FilamentExcel\Actions\Pages\ExportAction;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ManageSiteSettings extends SettingsPage
{
    use HasPageShield;
    protected static ?string $navigationGroup = "Site Settings";

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static string $settings = Site::class;

    public function getTitle(): string|Htmlable
    {
        return __("Site Settings");
    }

    public static function getNavigationLabel(): string
    {
        return __("Site Settings");
    }

    public function getHeaderActions(): array
    {
        return [
            Action::make('Export')
                ->label(__("Export"))
                ->action(function(){
                    return \Maatwebsite\Excel\Facades\Excel::download(new SiteSettingsExport, 'site-settings.xlsx');
                })

        ];
    }

    public function form(Form $form): Form
    {
        $tabs = [];
        foreach (config('app.locales') as $locale => $language){
            $tabs[] = Forms\Components\Tabs\Tab::make($language)->schema([
                Forms\Components\Grid::make()
                    ->columns(3)
                    ->schema([
                        FileUpload::make("fav_icon")
                            ->multiple(false)
                            ->label(__("Fav Icon")),
                        FileUpload::make("logo.{$locale}")
                            ->multiple(false)
                            ->label(__("Logo")),
                    ]),
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        FileUpload::make("footer_logo")
                            ->listDisplay()
                            ->columns(3)
                            ->size('sm')
                            ->constrained()
                            ->multiple()
                            ->label(__("Footer Logos")),
                    ]),
                Forms\Components\Grid::make()
                    ->columns(1)
                    ->schema([
                        \App\Filament\Components\TiptapEditor::make("footer_description.{$locale}")
                            ->maxLength(255)
                            ->label(__("Footer Description")),
                        TextInput::make("email")
                            ->label(__("Email"))
                            ->email(),
                        TextInput::make("phone")
                            ->label(__("Phone")),
                        TextInput::make("fax")
                            ->label(__("fax")),
                        TextInput::make("p_o_box.{$locale}")
                            ->label(__("PO Box"))
                    ])
            ]);
        }
        return $form
            ->schema([
                Forms\Components\Grid::make(2)->schema([
                    Forms\Components\Grid::make(1)
                        ->schema([
                            Forms\Components\Tabs::make()
                                ->tabs($tabs)
                                ->columnSpan(1),
                            Forms\Components\Section::make()
                                ->schema([
                                    FileUpload::make('bar_code_image')
                                        ->label(__("QR Code Image"))
                                        ->multiple(false),
                                    TextInput::make('facebook_link')
                                        ->label(__("Facebook")),
                                    TextInput::make('instagram_link')
                                        ->label(__("Instagram")),
                                    TextInput::make('twitter_link')
                                        ->label(__("Twitter")),
                                    TextInput::make('youtube_link')
                                        ->label(__("Youtube")),
                                    TextInput::make('linkedin_link')
                                        ->label(__("Linkedin")),
                                    TextInput::make("app_store_link")
                                        ->label(__("App Store")),
                                    TextInput::make("play_store_link")
                                        ->label(__("Play Store"))
                                ])
                                ->columnSpan(1)
                                ->columns(1),
                        ])
                        ->columnSpan(1),
                    Forms\Components\Grid::make(1)
                        ->schema([
                            Forms\Components\Section::make()
                                ->schema([
                                    TextInput::make('captcha_site_key')
                                        ->label(__("Captcha Site Key")),
                                    TextInput::make('captcha_secret_key')
                                        ->label(__("Captcha Secret Key")),
                                    Forms\Components\Checkbox::make('enable_captcha')
                                        ->label(__("Enable Captcha"))
                                ]),
                            Forms\Components\Section::make()
                                ->schema([
                                    TextInput::make('google_analytics_code')
                                        ->label(__("Google Analystic Key")),
                    
                                ]),
                            Forms\Components\Section::make()
                                ->schema([
                                    TextInput::make("default_page_size")
                                        ->integer()
                                        ->minValue(1),
                                    TextInput::make("news_page_size")
                                        ->integer()
                                        ->minValue(1),
                                    TextInput::make('photos_gallery_page_size')
                                        ->integer()
                                        ->minValue(1),
                                    TextInput::make('videos_gallery_page_size')
                                        ->integer()
                                        ->minValue(1),
                                    TextInput::make('search_page_size')
                                        ->integer()
                                        ->minValue(1),
                                ]),

                            Forms\Components\Section::make()
                                ->schema([
                                    TextInput::make('contact_us_mailing_list')
                                        ->label(__("Contact Us Mailing List"))
                                        ->helperText(__("Separate Using ,")),
                                    TextInput::make('summer_camp_mailing_list')
                                        ->label(__("Summer Camp Mailing List"))
                                        ->helperText(__("Separate Using ,"))
                                ]),

                            Forms\Components\Section::make()
                                ->schema([
                                    TextInput::make('virtual_tour_iframe')
                                        ->label(__("Virtual Tour Iframe"))
                                ])
                        ])
                        ->columnSpan(1)
                ])
            ]);
    }
}
