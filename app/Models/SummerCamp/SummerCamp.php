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
use App\Models\News\NewsLang;
use Awcodes\Curator\Models\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class SummerCamp extends WeightedModel implements \OwenIt\Auditing\Contracts\Auditable, Searchable
{
    use HasFactory, \App\Helpers\HasTranslations, HasMedia, HasAuthor, HasStatus, \OwenIt\Auditing\Auditable, \App\Helpers\HasSeo, HasSlug, HasTimestamps, HasSearch, Translatable;

    protected $table = 'summer_camps';

    public $translationModel = SummerCampLang::class;

    protected $guarded = ['id', 'created_at', 'updated_at'];


    public array $translatedAttributes = [
        'title', 'description', 'content'
    ];

    public array $upload_attributes = [
        'image_id'
    ];

    public function getSearchResult(): SearchResult
    {
        $url = route('summer-camp.show', $this->slug);

        return new \Spatie\Searchable\SearchResult(
            $this,
            $this->title,
            $url
        );
    }

    public function images(){
        return $this->belongsToMany(Media::class, 'summer_camp_images', 'parent_id', 'image_id');
    }


}