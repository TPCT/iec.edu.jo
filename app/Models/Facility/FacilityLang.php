<?php

namespace App\Models\Facility;

use App\Helpers\HasAuthor;
use App\Helpers\HasStatus;
use App\Helpers\WeightedModel;
use App\Models\Faq\Faq;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Translatable\HasTranslations;

/**
 * App\Models\News\NewsLang
 *
 * @property int $id
 * @property int|null $parent_id
 * @property string|null $language
 * @property string|null $description
 * @property string|null $title
 * @property string|null $content
 * @property int|null $image_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityLang whereTitle($value)
 * @mixin \Eloquent
 */
class FacilityLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "facilities_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}
