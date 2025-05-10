<?php

namespace App\Models\SummerCamp;

use App\Filament\Helpers\Translatable;
use App\Helpers\HasAuthor;
use App\Helpers\HasMedia;
use App\Helpers\HasSearch;
use App\Helpers\HasSlug;
use App\Helpers\HasStatus;
use App\Helpers\HasTimestamps;
use App\Helpers\WeightedModel;
use App\Models\News\News;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class SummerCampImage extends Model
{
    protected $table = "summer_camp_images";
    use HasFactory;

    public function summer_camp(){
        return $this->BelongsTo(SummerCamp::class, 'parent_id', 'id');
    }
}
