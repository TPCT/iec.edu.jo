<?php

namespace App\Models\Activity;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Activity\ActivityLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property string $content
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @property string|null $description
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ActivityLang whereTitle($value)
 * @mixin \Eloquent
 */
class ActivityLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "activities_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}
