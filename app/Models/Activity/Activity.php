<?php

namespace App\Models\Activity;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasSlug;
use App\Helpers\HasStatus;
use App\Helpers\HasTimestamps;
use App\Helpers\WeightedModel;
use App\Models\Facility\FacilityLang;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * App\Models\Activity\Activity
 *
 * @property int $id
 * @property int $user_id
 * @property int $weight
 * @property int $image_id
 * @property string $slug
 * @property int $status
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read Media|null $image
 * @property-read Media|null $media
 * @property-read \App\Models\Seo\Seo $seo
 * @property-read \App\Models\Activity\ActivityLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Activity\ActivityLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Activity active()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Activity query()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Activity withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Activity extends WeightedModel implements \OwenIt\Auditing\Contracts\Auditable, Searchable
{
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, HasStatus, \OwenIt\Auditing\Auditable, \App\Helpers\HasSeo, HasSlug, HasTimestamps, HasSearch, Translatable;

    public $translationModel = ActivityLang::class;


    protected $guarded = ['id', 'created_at', 'updated_at'];

    public array $translatedAttributes = [
        'title', 'description', 'content'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('activities.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }
}