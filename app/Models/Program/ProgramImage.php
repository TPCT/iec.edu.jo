<?php

namespace App\Models\Program;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasTimestamps;
use Awcodes\Curator\Models\Media;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Program\ProgramImage
 *
 * @property int $id
 * @property int $user_id
 * @property int $program_id
 * @property int $weight
 * @property int $status
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property-read \App\Models\User $author
 * @property-read Media|null $image
 * @property-read \App\Models\Program\Program $program
 * @property-read \App\Models\Program\ProgramImageLang|null $translation
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Program\ProgramImageLang> $translations
 * @property-read int|null $translations_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage listsTranslations(string $translationField)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage notTranslatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage orWhereTranslation(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage orWhereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage orderByTranslation(string $translationField, string $sortMethod = 'asc')
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage translated()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage translatedIn(?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage translations()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereProgramId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereTranslation(string $translationField, $value, ?string $locale = null, string $method = 'whereHas', string $operator = '=')
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereTranslationLike(string $translationField, $value, ?string $locale = null)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage whereWeight($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImage withTranslation(?string $locale = null)
 * @mixin \Eloquent
 */
class ProgramImage extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, \OwenIt\Auditing\Auditable, HasTimestamps, Translatable, HasWeight;

    protected $table = "programs_images";

    public $translationModel = ProgramImageLang::class;


    protected $guarded = ['id', 'created_at', 'updated_at'];


    public array $translatedAttributes = [
        'title', 'image_id'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public function program(){
        return $this->belongsTo(Program::class);
    }
}