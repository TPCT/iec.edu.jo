<?php

namespace App\Models\Award;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasStatus;
use App\Helpers\WeightedModel;
use App\Models\Branch\BranchLang;
use Filament\Tables\Columns\Concerns\HasWeight;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Award\AwardLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AwardLang whereTitle($value)
 * @mixin \Eloquent
 */
class AwardLang extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "awards_lang";
    public $timestamps = false;
    protected $guarded = ['id'];
}