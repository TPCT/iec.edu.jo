<?php

namespace App\Http\Controllers;

use App\Models\Dropdown\Dropdown;
use App\Models\News\News;
use App\Settings\Site;
use Carbon\Carbon;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years = News::active()->orderBy('published_at', 'desc')->get()->each(function ($data){
            $data->year = Carbon::parse($data->published_at)->format('Y');
            return $data;
        })->pluck('year')->unique()->toArray();

        $news = News::active()
            ->when(request('filter_by_year', $years ? max($years) : null), function ($query, $year) {
                return $query->whereYear('published_at', $year);
            })
            ->paginate(app(Site::class)->news_page_size)
            ->withQueryString();
        return $this->view('news.index', compact('news', 'years'));
    }

    /**
     * Display the specified resource.
     */
    public function show($locale, News $latest_news)
    {
        $recent_news = News::active()
            ->limit(8)
            ->where('id', '!=' , $latest_news->id)
            ->get();

        return $this->view('news.show', compact('latest_news', 'recent_news'));
    }
}
