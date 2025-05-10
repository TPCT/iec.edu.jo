<?php

namespace App\Models\Program;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Program\ProgramImageLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property int $image_id
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang whereImageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ProgramImageLang whereTitle($value)
 * @mixin \Eloquent
 */
class ProgramImageLang extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use Auditable, HasFactory;

    protected $table = "programs_images_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}