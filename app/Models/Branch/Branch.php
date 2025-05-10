<?php

namespace App\Models\Branch;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasStatus;
use App\Helpers\WeightedModel;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Branch\Branch
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
 * @property-read \App\Models\Branch\BranchLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Branch\BranchLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|Branch active()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|Branch query()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch translated()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch translations()
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Branch withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class Branch extends WeightedModel implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, Translatable, HasAuthor, HasStatus, Auditable, \App\Helpers\HasTranslations, HasWeight;

    public $translationModel = BranchLang::class;

    public array $upload_attributes = [
        'link'
    ];

    protected $guarded = [
        'id', 'created_at', 'updated_at'
    ];

    public array $translatedAttributes = [
        'title', 'location'
    ];

}
