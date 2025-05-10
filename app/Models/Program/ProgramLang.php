<?php

namespace App\Models\Program;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Program\ProgramLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property string $description
 * @property string|null $inner_description
 * @property string|null $downloads_section_description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereDownloadsSectionDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereInnerDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramLang whereTitle($value)
 * @mixin \Eloquent
 */
class ProgramLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "programs_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}
