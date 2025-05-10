<?php

namespace App\Models\Facility;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Facility\FacilityImage
 *
 * @property-read \App\Models\Facility\Facility|null $facility
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FacilityImage query()
 * @mixin \Eloquent
 */
class FacilityImage extends Model
{
    use HasFactory;

    public function facility(){
        return $this->BelongsTo(Facility::class, 'parent_id', 'id');
    }
}
