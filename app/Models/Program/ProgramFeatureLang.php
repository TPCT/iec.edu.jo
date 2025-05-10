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
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Program\ProgramFeatureLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property string $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramFeatureLang whereTitle($value)
 * @mixin \Eloquent
 */
class ProgramFeatureLang extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use Auditable, HasFactory;

    protected $table = "programs_features_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}