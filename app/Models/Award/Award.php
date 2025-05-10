<?php

namespace App\Models\Award;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasSearch;
use App\Helpers\HasStatus;
use App\Helpers\WeightedModel;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Award\Award
 *
 * @property int $id
 * @property int $user_id
 * @property int $weight
 * @property int $image_id
 * @property int $status
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Award\AwardLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Award\AwardLang|null $translation
 * @method static \Illuminate\Database\Eloquent\Builder|Award active()
 * @method static \Illuminate\Database\Eloquent\Builder|Award listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Award newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Award newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Award notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Award orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Award orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Award orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Award query()
 * @method static \Illuminate\Database\Eloquent\Builder|Award translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Award translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Award translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Award withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Award extends WeightedModel implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, Translatable, HasAuthor, HasStatus, Auditable, \App\Helpers\HasTranslations, HasWeight, HasSearch;

    public $translationModel = AwardLang::class;

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public array $translatedAttributes = [
        'title', 'description'
    ];

}