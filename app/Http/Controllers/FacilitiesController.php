<?php

namespace App\Http\Controllers;

use App\Models\Dropdown\Dropdown;
use App\Models\Facility\Facility;
use Illuminate\Http\Request;

class FacilitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('student-life-facilities-brief-section')
            ->first()
            ?->blocks()->first();
        $facilities = Facility::active()->get();
        return $this->view('facilities.index', compact('facilities', 'top_section'));
    }


    public function show($locale, Facility $facility)
    {
        $related_facilities = Facility::active()
            ->limit(8)
            ->where('id', '!=' , $facility->id)
            ->get();
        return $this->view('facilities.show', compact('facility', 'related_facilities'));
    }
}
