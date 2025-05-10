<?php

namespace App\Http\Controllers;

use App\Models\Album\Album;
use App\Models\Award\Award;
use App\Models\Download\Download;
use App\Models\Dropdown\Dropdown;
use App\Models\Faq\Faq;
use App\Models\Slider\Slider;
use App\Settings\Site;

class AboutIcsController extends Controller
{
    public function board_of_directors(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-ics-board-of-directors-brief-section')
            ->first()
            ?->blocks()->first();
        $team_members = Dropdown::active()->whereCategory(Dropdown::TEAM_MEMBER_CATEGORY)
            ->whereSlug('board-director')
            ->first()
            ?->team_members()->get();
        return $this->view('about-ics.board-of-directors', compact('team_members', 'top_section'));
    }

    public function founders(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-ics-founders-brief-section')
            ->first()
            ?->blocks()->first();
        $team_members = Dropdown::active()->whereCategory(Dropdown::TEAM_MEMBER_CATEGORY)
            ->whereSlug('founder')
            ->first()
            ?->team_members()->get();
        return $this->view('about-ics.founders', compact('team_members', 'top_section'));
    }

    public function our_history(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-ics-history-brief-section')
            ->first()
            ?->blocks()->first();
        $slider = Slider::whereSlug('our-ics-history')->first();
        return $this->view('about-ics.our-ics-history', compact('slider', 'top_section'));
    }

    public function mission_and_vision(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('about-ics-mission-vision-brief-section')
            ->first()
            ?->blocks()->first();

        $our_mission_and_vision_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('our-mission-vision-section')
            ->first()
            ?->blocks()->first();

        return $this->view('about-ics.our-mission-vision', compact('top_section', 'our_mission_and_vision_section'));
    }
}
