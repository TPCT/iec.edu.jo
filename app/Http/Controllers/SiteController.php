<?php

namespace App\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\ContactUs;
use App\Models\Dropdown\Dropdown;
use App\Models\News\News;
use App\Models\Page\Page;
use App\Models\Program\Program;
use App\Models\Slider\Slider;
use App\Settings\Site;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Request $request){
        $pop_up = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('homepage-popup')
            ->first()
            ?->blocks()->first();
        $hero_slider = Slider::active()->whereCategory(Slider::HOMEPAGE_HERO_SLIDER)->first();
        $history_slider = Slider::active()->whereCategory(Slider::HOMEPAGE_HISTORY_SLIDER)->first();
        $iec_in_numbers = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('iec-in-numbers')
            ->first()
            ?->blocks()
            ->first();
        $floating_cards = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('homepage-floating-cards')
            ->first()
            ?->blocks()
            ->where('promote_to_homepage', 1)
            ->limit(4)
            ->get();
        $promoted_programs = Program::active()->wherePromoteToHomepage(true)->get();
        $latest_news = News::active()->orderBy('published_at', 'desc')->limit(8)->get();
        $virtual_tour = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('homepage-virtual-tour-section')
            ->first()
            ?->blocks()
            ->first();
        $testimonials_slider = Slider::active()->whereCategory(Slider::HOMEPAGE_TESTIMONIALS_SLIDER)->first();
        $connects = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('more-about-iec-section')
            ->first()
            ?->blocks()
            ->wherePromoteToHomepage(true)
            ->limit(3)
            ->get();
        return $this->view('site.homepage', compact(
            'pop_up', 'hero_slider', 'history_slider',
            'iec_in_numbers', 'floating_cards', 'promoted_programs',
            'latest_news', 'virtual_tour', 'testimonials_slider',
            'connects'
        ));
    }

    public function filter(){
        $keyword = \request('search', '');
        $model = \request('model', '');
        $page = \request('page', 1);

        $models = [
            'Activity',
            'Award',
            'Facility',
            'Program',
            'SummerCamp',
            'News',
            'Page'
        ];

        $search_results = [];

        if ($model)
            $models = [$model];

        foreach ($models as $model_name){
            $model_class = "App\\Models\\{$model_name}\\{$model_name}";
            $search_results[$model_name] = $model_class::results($model_name);
            if (!count($search_results[$model_name]))
                unset($search_results[$model_name]);
        }

        return $this->view('site.filter', compact('search_results', 'keyword', 'page'));
    }


    public function contactUs(Request $request){
        $dropdowns = Dropdown::active()->whereCategory(Dropdown::CONTACT_US_CATEGORY)->get();
        $top_section = Dropdown::active()
            ->whereCategory(Dropdown::BLOCK_CATEGORY)
            ->whereSlug('contact-us-brief-section')
            ->first()
            ?->blocks()->first();
        $branches = Branch::active()->get();
        if ($request->method() == "POST") {
            $data = $request->validate([
                'name' => 'required|regex:/^[^0-9]*$/i',
                'phone' => 'required|regex:/^[0-9+]+$/i',
                'email' => 'required|email',
                'message' => 'required',
                'area_of_interest' => 'required|exists:dropdowns,id',
                'g-recaptcha-response' => app(Site::class)->enable_captcha ? 'required|captcha' : 'nullable'
            ]);

            $data['dropdown_id'] = $data['area_of_interest'];
            unset($data['g-recaptcha-response'], $data['area_of_interest']);
            $model = ContactUs::create($data);
            $model->save();
            return redirect()->route('site.contact-us')->with('success', __("site.Application Has Been Submitted Successfully"));
        }
        return $this->view('site.contact-us', compact('dropdowns', 'top_section', 'branches'));
    }

    public function show()
    {
        $segments = \request()->segments();
        $prefix = implode(
            '/',
            array_slice($segments, \request()->route()->hasParameter('section') ? 2 : 1, -1)
        );

        $prefix = $prefix ?: null;
        $slug = last($segments);

        if (in_array($slug, ['about-iec', 'admission', 'student-life', 'educational-programs', 'about-ics'])){
            return redirect(route('site.index')."#".$slug);
        }


        $page = Page::active()
            ->directAccess()
            ->whereSlug($slug)
            ->wherePrefix($prefix)
            ->whereDoesntHave('sections')
            ->first();

        if (!$page){
            $prefix = implode('/', array_slice($segments, 2, -1));
            $prefix = $prefix ?: null;

            $page = Page::active()
                        ->directAccess()
                        ->whereSlug($slug)
                        ->wherePrefix($prefix)
                        ->first();
        }

        if (!$page)
            return (new SectionController())->index(app()->getLocale(), \request()->segment(2));

        $view = strtolower(explode(' ', $page->view)[0]);
        return $this->view('Pages.' . $view, compact('page'));
    }
}
