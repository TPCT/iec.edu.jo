<?php

namespace App\Models\Slider;

use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * App\Models\Slider\SliderSlide
 *
 * @property int $id
 * @property int $user_id
 * @property int $slider_id
 * @property int|null $image_id
 * @property string|null $link
 * @property int $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $mobile_image_id
 * @property-read \App\Models\User $author
 * @property-read \Awcodes\Curator\Models\Media|null $image
 * @property-read \App\Models\User $user
 * @property int $parent_id
 * @property string $language
 * @property string $title
 * @property string $description
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \OwenIt\Auditing\Models\Audit> $audits
 * @property-read int|null $audits_count
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang query()
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang whereLanguage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|SliderSlideLang whereTitle($value)
 * @mixin \Eloquent
 */
class SliderSlideLang extends Model implements Auditable
{
    use HasFactory, \OwenIt\Auditing\Auditable;

    protected $table = "slider_slides_lang";
    public $timestamps = false;
    protected $guarded = [
        'id'
    ];
}
