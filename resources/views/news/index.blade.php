@extends('layouts.main')

@section('title', __('site.News'))
@section('id', 'News')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/LatestNews.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    @if ($years)
        <section>
            <div class="container main-topic">
                <form action="">
                    <label for="">@lang('site.Filter by years')</label>
                    <select name="filter_by_year" id="filter-by-year">
                        <option value="">@lang('site.Filter By Year')</option>
                        @foreach($years as $year)
                            <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </section>
    @endif

    <section class="lastestNews-section" id="content-section">
        <div class="container">
            @foreach($news as $news_piece)
                <div class="latestNews-card">
                    <picture>
                        <x-curator-glider
                            :force="true"
                            :media="$news_piece->image_id"
                            quality="5"
                            format="webp"
                        />
                    </picture>
                    <span>{{$news_piece->formatDate('published_at', 'd M Y')}}</span>
                    <div class="latestNews-card-content">
                        <div>
                            <h4>
                                {{$news_piece->title}}
                            </h4>
                            <p>
                               {!! $news_piece->description !!}
                            </p>
                        </div>
                        <a href="{{route('latest-news.show', ['latest_news' => $news_piece])}}" class="main-btn">
                            @lang('site.Read more')
                            <svg width="17" height="13" viewBox="0 0 17 13" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z" />
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        {{$news->links()}}
    </section>
@endsection

@push('script')
    <script>
        $("#filter-by-year").on('change', function(){
            $("#content-section").load("{{route('latest-news.index')}}" + "?filter_by_year=" + $(this).val() + " #content-section")
        })
    </script>
@endpush