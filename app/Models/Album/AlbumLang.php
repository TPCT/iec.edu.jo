<?php

namespace App\Models\Album;

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
 * @property string|null $video_url
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlbumLang whereVideoUrl($value)
 * @mixin \Eloquent
 */
class AlbumLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "albums_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}
