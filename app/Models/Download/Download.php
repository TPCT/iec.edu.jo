<?php

namespace App\Models\Download;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasStatus;
use App\Helpers\WeightedModel;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Download\Download
 *
 * @property int $id
 * @property int $user_id
 * @property int $weight
 * @property int $status
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read \App\Models\Download\DownloadLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Download\DownloadLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Download active()
 * @method static \Illuminate\Database\Eloquent\Builder|Download listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Download newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Download newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Download notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Download orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Download orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Download orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Download query()
 * @method static \Illuminate\Database\Eloquent\Builder|Download translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Download translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Download translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Download withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Download extends WeightedModel implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, Translatable, HasAuthor, HasStatus, Auditable, \App\Helpers\HasTranslations, HasWeight;

    public $translationModel = DownloadLang::class;

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public array $upload_attributes = [
        'link'
    ];

    public array $translatedAttributes = [
        'title', 'link'
    ];

}
