<?php

namespace App\Models\Album;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasTimestamps;
use App\Models\Album\Album;
use Awcodes\Curator\Models\Media;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Album\AlbumImage
 *
 * @property int $id
 * @property int $user_id
 * @property int $album_id
 * @property int $weight
 * @property int $image_id
 * @property int $status
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read Album $album
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read Media|null $image
 * @property-read \App\Models\Album\AlbumImageLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Album\AlbumImageLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage translated()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage translations()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereAlbumId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImage withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class AlbumImage extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, \OwenIt\Auditing\Auditable, HasTimestamps, Translatable, HasWeight;

    protected $table = "albums_images";

    public $translationModel = AlbumImageLang::class;


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public array $translatedAttributes = [
        'caption'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public function album(){
        return $this->belongsTo(Album::class);
    }
}