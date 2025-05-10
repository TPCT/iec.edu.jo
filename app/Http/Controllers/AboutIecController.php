<?php

namespace App\Http\Controllers;

use App\Models\Album\Album;
use App\Models\Award\Award;
use App\Models\Download\Download;
use App\Models\Dropdown\Dropdown;
use App\Models\Faq\Faq;
use App\Models\Slider\Slider;
use App\Models\TeamMember\TeamMember;
use App\Settings\Site;
use Illuminate\Http\Request;

class AboutIecController extends Controller
{
    public function downloads(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-iec-downloads-brief-section')
            ->first()
            ?->blocks()->first();

        $downloads = Download::active()->get();
        return $this->view('about-iec.downloads', compact('top_section', 'downloads'));
    }

    public function awards_and_accreditations(){
        $awards = Award::active()->get();
        return $this->view('about-iec.awards-and-accreditations', compact('awards'));
    }

    public function our_history(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-iec-history-brief-section')
            ->first()
            ?->blocks()->first();

        $slider = Slider::whereSlug('our-history')->first();
        return $this->view('about-iec.our-history', compact('slider', 'top_section'));
    }


    public function faqs(){
        $years = Faq::active()->orderBy('year', 'desc')->pluck('year')->unique()->all();
        $faqs = Faq::active()->when(request('filter_by_year'), function ($query, $year) {
            return $query->where('year', $year);
        })->get();
        return $this->view('about-iec.faqs', compact('faqs', 'years'));
    }

    public function photo_gallery(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-iec-photo-gallery-brief-section')
            ->first()
            ?->blocks()->first();
        $albums = Album::active()->where('type', Album::PHOTOS_ALBUM)->paginate(app(Site::class)->photos_gallery_page_size);
        return $this->view('about-iec.photo-gallery', compact('albums', 'top_section'));
    }

    public function video_gallery(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-iec-video-gallery-brief-section')
            ->first()
            ?->blocks()->first();
        $albums = Album::active()->where('type', Album::VIDEOS_ALBUM)->paginate(app(Site::class)->photos_gallery_page_size);
        return $this->view('about-iec.video-gallery', compact('albums', 'top_section'));
    }

}
