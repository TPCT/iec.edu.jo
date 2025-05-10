<?php

namespace App\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\ContactUs;
use App\Models\Dropdown\Dropdown;
use App\Models\Slider\Slider;
use App\Models\SummerCamp\SummerCamp;
use App\Models\SummerCamp\SummerCampRegisterForm;
use App\Settings\Site;
use Illuminate\Http\Request;

class SummerCampController extends Controller
{
    public function index(){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('student-life-summer-camp-top-section')
            ->first()
            ?->blocks()->first();
        $summer_camps = SummerCamp::active()
            ->limit(4)
            ->get();
        $testimonials_slider = Slider::active()->whereCategory(Slider::TESTIMONIALS_SLIDER)->first();
        $summer_camp_slider = Slider::active()->whereCategory(Slider::SUMMER_CAMP_VIDEOS_SLIDER)->first();
        return $this->view('summer-camp.index', compact('top_section', 'summer_camps', 'testimonials_slider', 'summer_camp_slider'));
    }

    public function register(Request $request, $locale, ?SummerCamp $summer_camp = null){
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('student-life-summer-camp-register-form-brief-section')
            ->first()
            ?->blocks()->first();

        $genders = Dropdown::active()->whereCategory(Dropdown::SUMMER_CAMP_CHILD_GENDER)->get();
        $ages = Dropdown::active()->whereCategory(Dropdown::SUMMER_CAMP_CHILD_AGE)->get();
        $branches = Branch::active()->get();

        if ($request->method() == "POST") {
            $data = $request->validate([
                'name' => 'required|regex:/^[^0-9]*$/i',
                'phone' => 'required|regex:/^[0-9+]+$/i',
                'email' => 'required|email',
                'message' => 'required',
                'age_id' => 'required|exists:dropdowns,id',
                'gender_id' => 'required|exists:dropdowns,id',
                'g-recaptcha-response' => app(Site::class)->enable_captcha ? 'required|captcha' : 'nullable'
            ]);
            unset($data['g-recaptcha-response'], $data['area_of_interest']);

            if ($summer_camp)
                $data['summer_camp_id'] = $summer_camp->id;

            $model = SummerCampRegisterForm::create($data);
            $model->save();

            if ($summer_camp)
                return redirect()->route('summer-camp.camp.register', ['summer_camp' => $summer_camp])->with('success', __("site.Application Has Been Submitted Successfully"));

            return redirect()->route('summer-camp.register')->with('success', __("site.Application Has Been Submitted Successfully"));
        }

        return $this->view('summer-camp.register', compact('top_section', 'genders', 'ages', 'branches'));
    }

    public function show($locale, SummerCamp $summer_camp){
        $summer_camps = SummerCamp::active()
            ->limit(3)
            ->where('id', '!=' , $summer_camp->id)
            ->get();
        return $this->view('summer-camp.show', compact('summer_camp', 'summer_camps'));
    }
}
