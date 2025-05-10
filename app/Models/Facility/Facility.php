<?php

namespace App\Models\Facility;

use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasSlug;
use App\Helpers\HasStatus;
use App\Helpers\HasTimestamps;
use App\Helpers\WeightedModel;
use App\Filament\Helpers\Translatable;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * App\Models\News\News
 *
 * @property int $id
 * @property string|null $header_image
 * @property string|null $header_title
 * @property string|null $header_description
 * @property int $user_id
 * @property string $slug
 * @property string $published_at
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $weight
 * @property int $promote_to_homepage
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read \Awcodes\Curator\Models\Media|null $image
 * @property-read \Awcodes\Curator\Models\Media|null $media
 * @property-read \App\Models\Seo\Seo $seo
 * @property-read \App\Models\News\FacilityLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\News\FacilityLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection<int, Media> $images
 * @property-read int|null $images_count
 * @method static \Illuminate\Database\Eloquent\Builder|Facility active()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Facility query()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility wherePromoteToHomepage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Facility withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Facility extends WeightedModel implements \OwenIt\Auditing\Contracts\Auditable, Searchable
{
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, HasStatus, \OwenIt\Auditing\Auditable, \App\Helpers\HasSeo, HasSlug, HasTimestamps, HasSearch, Translatable;

    public $translationModel = FacilityLang::class;


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public array $translatedAttributes = [
        'title', 'description', 'content', 'image_id'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('facilities.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function images(){
        return $this->belongsToMany(Media::class, 'facilities_images', 'parent_id', 'image_id');
    }

}
