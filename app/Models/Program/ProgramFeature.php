<?php

namespace App\Models\Program;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasSlug;
use App\Helpers\HasStatus;
use App\Helpers\HasTimestamps;
use App\Helpers\WeightedModel;
use App\Models\Activity\ActivityLang;
use App\Models\Block\Block;
use App\Models\Block\BlockFeature;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

/**
 * App\Models\Program\ProgramFeature
 *
 * @property int $id
 * @property int $program_id
 * @property int $user_id
 * @property int $order
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read \Illuminate\Database\Eloquent\Collection<int, ProgramFeature> $children
 * @property-read int|null $children_count
 * @property-read \Awcodes\Curator\Models\Media|null $image
 * @property-read \Awcodes\Curator\Models\Media|null $media
 * @property-read \App\Models\Program\Program $program
 * @property-read \App\Models\Seo\Seo $seo
 * @property-read \App\Models\Program\ProgramFeatureLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Program\ProgramFeatureLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature translated()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature translations()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereOrder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeature withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class ProgramFeature extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, \OwenIt\Auditing\Auditable, \App\Helpers\HasSeo, HasTimestamps, HasSearch, Translatable;

    protected $table = "programs_features";

    public $translationModel = ProgramFeatureLang::class;


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public array $translatedAttributes = [
        'title', 'content',
    ];

    public array $upload_attributes = [
        'image_id'
    ];


    public function program(){
        return $this->belongsTo(Program::class);
    }

    public function children(){
        return $this->hasMany(ProgramFeature::class, 'parent_id', 'id')
            ->whereNotNull('parent_id')
            ->with('children');
    }
}