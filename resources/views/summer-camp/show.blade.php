@extends('layouts.main')

@section('title', $summer_camp->title)
@section('id', 'SummerCampInner')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/SummerCampInner.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image title="{!! $summer_camp->title!!}" description="{!! $summer_camp->description !!}" :image="$summer_camp->image"></x-layout.header-image>
    <section>
        <div class="container main-topic">
            <div
                    class="date-summer-inner d-flex align-items-center gap-2 mt-5 mb-3"
            >
                <picture>
                    <img
                            src="{{asset('/Assets/Icons/General/CalendarBlank.svg')}}"
                            alt=""
                            class="mw-100 w-100"
                    />
                </picture>
                <h4 class="m-0">{{$summer_camp->formatDate('start_date', 'd M')}} @lang('site.to') {{$summer_camp->formatDate('end_date', 'd M, Y')}}</h4>
            </div>
        </div>
    </section>

    <section class="summer-camp-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="summer-camp-content">
                        {!! $summer_camp->content !!}
                        <div
                                class="buttons d-flex justify-content-between align-items-center mt-5 position-relative"
                        >
                            <a href="{{route('summer-camp.camp.register', ['summer_camp' => $summer_camp])}}" class="main-btn">
                                @lang('site.Register')
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                            <x-layout.share></x-layout.share>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="facilities-inner-slider">
                        <div class="single-item">
                            @foreach($summer_camp->images as $image)
                                <div>
                                    <picture>
                                        <x-curator-glider
                                                :media="$image->id"
                                                format="webp"
                                                :force="true"
                                                :quality="5"
                                        />
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if($summer_camps->count())
        <section class="lastestNews-section my-5 py-5">
            <div class="container">
                <h2>@lang('site.Other Programs')</h2>
            </div>
            <div class="container">
                @foreach($summer_camps as $summer_camp)
                    <div class="latestNews-card">
                        <picture>
                            <x-curator-glider
                                    :media="$summer_camp->image_id"
                                    format="webp"
                                    :force="true"
                                    :quality="5"
                            />
                        </picture>
                        <span>{{$summer_camp->formatDate('start_date', 'd M')}} @lang('site.to') {{$summer_camp->formatDate('end_date', 'd M, Y')}}</span>
                        <div class="latestNews-card-content">
                            <div>
                                <h4>{{$summer_camp->title}}</h4>
                                {!! $summer_camp->description !!}
                            </div>
                            <a href="{{route('summer-camp.show', ['summer_camp' => $summer_camp])}}" class="main-btn">
                                @lang('site.Discover More')
                                <i class="fa-solid fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif
@endsection

@push('script')
    <script>
        $(".single-item").slick({
            rtl: {{$rtl}},
            dots: true,
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    </script>
@endpush

