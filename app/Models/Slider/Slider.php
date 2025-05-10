<?php

namespace App\Models\Slider;

use App\Helpers\HasAuthor;
use App\Helpers\HasSlug;
use App\Helpers\HasStatus;
use App\Helpers\HasUploads;
use App\Filament\Helpers\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\Slider\Slider
 *
 * @property int $id
 * @property int $user_id
 * @property string $category
 * @property string $slug
 * @property int $status
 * @property string $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Slider\SliderSlide> $slides
 * @property-read int|null $slides_count
 * @property-read \App\Models\Slider\SliderLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Slider\SliderLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Slider active()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Slider query()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCategory($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Slider withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */

class Slider extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, HasAuthor, Auditable, HasStatus, Translatable, \App\Helpers\HasTranslations, HasSlug;

    public const HOMEPAGE_HERO_SLIDER = "Homepage Hero Slider";
    public const HOMEPAGE_HISTORY_SLIDER = "Homepage History Slider";
    public const HOMEPAGE_TESTIMONIALS_SLIDER = "Homepage Testimonials Slider";
    public const OUR_HISTORY_ICS = "Our History ICS Slider";
    public const OUR_HISTORY = "Our History Slider";
    public const TESTIMONIALS_SLIDER = "Testimonials Slider";
    public const SUMMER_CAMP_VIDEOS_SLIDER = "Summer Camp Videos Slider";

    public $translationModel = SliderLang::class;

    public static function getCategories(){
        return [
            self::HOMEPAGE_HERO_SLIDER => __(self::HOMEPAGE_HERO_SLIDER),
            self::HOMEPAGE_HISTORY_SLIDER => __(self::HOMEPAGE_HISTORY_SLIDER),
            self::HOMEPAGE_TESTIMONIALS_SLIDER => __(self::HOMEPAGE_TESTIMONIALS_SLIDER),
            self::OUR_HISTORY_ICS => __(self::OUR_HISTORY_ICS),
            self::OUR_HISTORY => __(self::OUR_HISTORY),
            self::TESTIMONIALS_SLIDER => __(self::TESTIMONIALS_SLIDER),
            self::SUMMER_CAMP_VIDEOS_SLIDER => __(self::SUMMER_CAMP_VIDEOS_SLIDER)
        ];
    }

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public array $translatedAttributes = [
        'title', 'description'
    ];

    public function slides(){
        return $this->hasMany(SliderSlide::class);
    }
}
