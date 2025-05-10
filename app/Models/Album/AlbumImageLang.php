<?php

namespace App\Models\Album;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable;

/**
 * App\Models\Album\AlbumImageLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $caption
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang whereCaption($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumImageLang whereParentId($value)
 * @mixin \Eloquent
 */
class AlbumImageLang extends Model implements \OwenIt\Auditing\Contracts\Auditable
{
    use Auditable, HasFactory;

    protected $table = "albums_images_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}