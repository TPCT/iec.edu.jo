<?php

namespace App\Http\Controllers;

use App\Models\Activity\Activity;
use App\Models\Dropdown\Dropdown;
use Illuminate\Http\Request;

class ExtraCurricularActivitiesController extends Controller
{
    public function index(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('student-life-extra-curricular-activities-brief-section')
            ->first()
            ?->blocks()->first();
        $activities = Activity::active()->get();
        return $this->view('extra-curricular-activities.index', compact('top_section', 'activities'));
    }

    public function show($locale, Activity $extra_curricular_activity){
        return $this->view('extra-curricular-activities.show', compact('extra_curricular_activity'));
    }
}
