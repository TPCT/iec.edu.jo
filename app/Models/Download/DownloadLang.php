<?php

namespace App\Models\Download;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Download\DownloadLang
 *
 * @property int $id
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property int $link
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang whereLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DownloadLang whereTitle($value)
 * @mixin \Eloquent
 */
class DownloadLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "downloads_lang";
    public $timestamps = false;
    protected $guarded = ['id'];
}
