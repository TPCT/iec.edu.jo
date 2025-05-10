<?php

namespace App\Models\Album;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasSlug;
use App\Helpers\HasStatus;
use App\Helpers\HasTimestamps;
use App\Helpers\WeightedModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Searchable\SearchResult;

/**
 * App\Models\Album\Album
 *
 * @property int $id
 * @property int $user_id
 * @property int $image_id
 * @property string $type
 * @property int $weight
 * @property int $status
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read \Awcodes\Curator\Models\Media|null $image
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Album\AlbumImage> $images
 * @property-read int|null $images_count
 * @property-read \Awcodes\Curator\Models\Media|null $media
 * @property-read \App\Models\Seo\Seo $seo
 * @property-read \App\Models\Album\AlbumLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Album\AlbumLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Album active()
 * @method static \Illuminate\Database\Eloquent\Builder|Album listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Album newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Album notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Album orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Album orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Album orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Album query()
 * @method static \Illuminate\Database\Eloquent\Builder|Album translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Album translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Album translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Album withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Album extends WeightedModel implements Auditable
{
    const VIDEOS_ALBUM = "Videos Album";
    const PHOTOS_ALBUM = "Photos Album";

    public static function getTypes(){
        return [
            self::VIDEOS_ALBUM => __(self::VIDEOS_ALBUM),
            self::PHOTOS_ALBUM => __(self::PHOTOS_ALBUM),
        ];
    }
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, HasStatus, \OwenIt\Auditing\Auditable, \App\Helpers\HasSeo, HasTimestamps, Translatable;

    public $translationModel = AlbumLang::class;


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public array $translatedAttributes = [
        'title', 'video_url'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public function images(){
        return $this->hasMany(AlbumImage::class);
    }

}
