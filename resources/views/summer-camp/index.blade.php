@extends('layouts.main')

@section('title', __('site.Summer Camp'))
@section('id', 'SummerCamp')

@push('style')
    <style>
        #summer-camp-top-section-video{
            background-image: url("{{\Awcodes\Curator\Models\Media::find($top_section->image_id)?->url}}") !important;
        }
    </style>
    <link rel="stylesheet" href="{{asset('/css/SummerCamp.css')}}"/>
@endpush

@section('content')
    @php
        $html = "<a href='" . route('summer-camp.register') . "' class='secondary-btn'>" . __("site.Register Now") . "<i class='fa-solid fa-arrow-right'></i></a>"
    @endphp
    <x-layout.header-image :html="$html"></x-layout.header-image>
    <section>
        <div class="container main-topic">
            <h3>{{$top_section->title}}</h3>
        </div>

        <section class="summer-camp-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 mb-5">
                        <div class="summer-camp-content">
                            {!! $top_section->content !!}
                        </div>
                    </div>

                    @if ($video_id = $top_section->youtube_video_id)
                        <div class="col-lg-6">
                            <div class="summer-camp-video d-flex justify-content-center">
                                <lite-youtube
                                        videoid="{{$video_id}}"
                                        id="summer-camp-top-section-video"
                                        params="controls=1&enablejsapi=1"
                                ></lite-youtube>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </section>
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

    @if ($testimonials_slider)
        <section class="slider-with-progress-bar-section">
            <div class="container">
                <div class="slider-with-progress-bar--title">
                    <h2>{{$testimonials_slider->title}}</h2>
                </div>
                <div class="slider-with-progress-bar-main-slider">
                    @foreach($testimonials_slider->slides as $slide)
                        <div class="slider-with-progress-bar--single-slide">
                            <div class="box-people d-flex justify-content-center gap-4">
                                <picture>
                                    <x-curator-glider
                                            :media="$slide->image_id"
                                            format="webp"
                                            :force="true"
                                            :quality="5"
                                    />
                                </picture>
                                <div class="box-people-content">
                                    <h4>{{$slide->title}}</h4>
                                    <p>{{$slide->second_title}}</p>
                                    <svg width="44" height="33" viewBox="0 0 44 33" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                                d="M3.95506 30.3309C1.48315 27.6618 0 24.75 0 19.8971C0 11.4044 6.17978 3.88235 14.8315 0L17.0562 3.15441C8.89888 7.52206 7.16854 13.1029 6.67416 16.7426C7.91011 16.0147 9.64045 15.7721 11.3708 16.0147C15.8202 16.5 19.2809 19.8971 19.2809 24.5074C19.2809 26.6912 18.2921 28.875 16.809 30.5735C15.0787 32.2721 13.1011 33 10.6292 33C7.91011 33 5.4382 31.7868 3.95506 30.3309ZM28.6742 30.3309C26.2022 27.6618 24.7191 24.75 24.7191 19.8971C24.7191 11.4044 30.8989 3.88235 39.5506 0L41.7753 3.15441C33.618 7.52206 31.8876 13.1029 31.3933 16.7426C32.6292 16.0147 34.3596 15.7721 36.0899 16.0147C40.5393 16.5 44 19.8971 44 24.5074C44 26.6912 43.0112 28.875 41.5281 30.5735C40.0449 32.2721 37.8202 33 35.3483 33C32.6292 33 30.1573 31.7868 28.6742 30.3309Z"
                                                fill="#DC9937" fill-opacity="0.3" />
                                    </svg>
                                    {!! $slide->description !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="slider-with-progress-bar--controllers">
                    <div class="slider-with-progress-bar--controllers-arrow">
                    <span class="slider-with-progress-bar--controllers-arrow-prev">
                      <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                fill="#fff" />
                      </svg>
                    </span>
                                <span class="slider-with-progress-bar--controllers-arrow-next">
                      <svg width="17" height="13" viewBox="0 0 17 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                                d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                fill="#fff" />
                      </svg>
                    </span>
                    </div>
                    <div class="slider-with-progress-bar--progress">
                        <span class="" id="slider-progress" data-progress="0%"></span>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @if ($summer_camp_slider)
        <div class="join-camp">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-lg-3">
                        <div class="why-join-summer-camp d-flex flex-column align-items-center justify-content-between">
                            <h2>{{$summer_camp_slider->title}}</h2>
                            <div class="text-white">
                                {!! $summer_camp_slider->description !!}
                            </div>
                            <picture>
                                <img src="{{asset('/Assets/Image/Summer Camp/Mask-group.png')}}" alt="" class="mw-100 w-100" />
                            </picture>
                        </div>
                        <a href="{{route('summer-camp.register')}}" class="main-btn">
                            @lang('site.Register Now')
                            <i class="fa-solid fa-arrow-right"></i>
                        </a>
                    </div>
                    <div class="col-md-6 col-lg-9">
                        <div class="slider-with-progress-bar-section">
                            <div class="slider-with-progress-bar-main-slider-our">
                                @foreach($summer_camp_slider->slides as $slide)
                                    <div class="slider-with-progress-bar--single-slide">
                                        <div class="videop-join-camp">
                                            <lite-youtube
                                                    videoid="{{$slide->video_id}}"
                                                    style="background-image: url('{{\Awcodes\Curator\Models\Media::find($slide->image_id)?->url ?? ""}}') !important;"
                                                    params="controls=1&enablejsapi=1"
                                            >
                                            </lite-youtube>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div class="slider-with-progress-bar--controllers">
                                <div class="slider-with-progress-bar--controllers-arrow">
                                      <span class="slider-with-progress-bar--controllers-arrow-prev-our">
                                        <i class="fa-solid fa-arrow-right"></i>
                                      </span>
                                                        <span class="slider-with-progress-bar--controllers-arrow-next-our">
                                        <i class="fa-solid fa-arrow-right"></i>
                                      </span>
                                </div>
                                <div class="slider-with-progress-bar--progress">
                                    <span id="slider-progress-our" data-progress="0%"></span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
        $(document).ready(function () {
            const $slider = $(".slider-with-progress-bar-main-slider");
            let $progress = $("#slider-progress");

            // Initialize the slick slider
            $slider.slick({
                rtl: {{$rtl}},
                dots: false,
                infinite: false,
                slidesToShow: 3,
                slidesToScroll: 3,
                nextArrow: $(".slider-with-progress-bar--controllers-arrow-next"),
                prevArrow: $(".slider-with-progress-bar--controllers-arrow-prev"),
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            dots: false,
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },

                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });

            let totalSlides = $slider.slick("getSlick").slideCount;

            // Function to calculate total groups based on current slidesToShow
            function calculateTotalGroups() {
                const slidesToShow = $slider.slick("slickGetOption", "slidesToShow");
                return Math.ceil(totalSlides / slidesToShow);
            }

            // Function to update progress bar
            function updateProgress(currentSlide, nextSlide) {
                const slidesToShow = $slider.slick("slickGetOption", "slidesToShow");
                const slidesToScroll = $slider.slick(
                    "slickGetOption",
                    "slidesToScroll"
                );

                const totalGroups = calculateTotalGroups(); // Groups of slides to scroll through
                const currentGroup = Math.ceil(
                    (nextSlide + slidesToScroll) / slidesToShow
                );

                const completedPercentage = (currentGroup / totalGroups) * 100;
                $progress.css("width", completedPercentage + "%");
                $progress.attr("data-progress", Math.round(completedPercentage) + "%"); // For text display
            }

            // Initial progress bar state
            updateProgress(0, 0);

            // Smooth transition during slide (beforeChange)
            $slider.on(
                "beforeChange",
                function (event, slick, currentSlide, nextSlide) {
                    updateProgress(currentSlide, nextSlide);
                }
            );

            // Update progress after slide changes (afterChange)
            $slider.on("afterChange", function (event, slick, currentSlide) {
                updateProgress(currentSlide, currentSlide);
            });

            // Handle window resize to recalculate progress if layout changes
            $(window).on("resize", function () {
                totalSlides = $slider.slick("getSlick").slideCount; // Recalculate total slides
                updateProgress(
                    $slider.slick("slickCurrentSlide"),
                    $slider.slick("slickCurrentSlide")
                ); // Update progress with current slide
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            const $slider = $(".slider-with-progress-bar-main-slider-our");
            let $progress = $("#slider-progress-our");

            // Initialize the slick slider
            $slider.slick({
                rtl: {{$rtl}},
                dots: false,
                infinite: false,
                slidesToShow: 2,
                slidesToScroll: 1,
                nextArrow: $(".slider-with-progress-bar--controllers-arrow-next-our"),
                prevArrow: $(".slider-with-progress-bar--controllers-arrow-prev-our"),
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                            dots: false,
                        },
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1,
                        },
                    },
                ],
            });

            let totalSlides = $slider.slick("getSlick").slideCount;

            // Function to calculate total groups based on current slidesToShow
            function calculateTotalGroups() {
                const slidesToShow = $slider.slick("slickGetOption", "slidesToShow");
                return Math.ceil(totalSlides / slidesToShow);
            }

            // Function to update progress bar
            function updateProgress(currentSlide, nextSlide) {
                const slidesToShow = $slider.slick("slickGetOption", "slidesToShow");
                const slidesToScroll = $slider.slick("slickGetOption", "slidesToScroll");

                const totalGroups = calculateTotalGroups(); // Groups of slides to scroll through
                const currentGroup = Math.ceil((nextSlide + slidesToScroll) / slidesToShow);

                const completedPercentage = (currentGroup / totalGroups) * 100;
                $progress.css("width", completedPercentage + "%");
                $progress.attr("data-progress", Math.round(completedPercentage) + "%"); // For text display
            }

            // Pause all videos function
            async function pauseAllVideos() {
                const players = $("lite-youtube"); // Select all lite-youtube elements
                for (let i = 0; i < players.length; i++) {
                    const player = players[i];
                    const ytPlayer = await player.getYTPlayer();
                    ytPlayer.pauseVideo(); // Pause each video
                }
            }

            // Initial progress bar state
            updateProgress(0, 0);

            // Smooth transition during slide (beforeChange)
            $slider.on("beforeChange", async function (event, slick, currentSlide, nextSlide) {
                await pauseAllVideos(); // Pause all videos before changing slides
                updateProgress(currentSlide, nextSlide); // Update progress
            });

            // Update progress after slide changes (afterChange)
            $slider.on("afterChange", function (event, slick, currentSlide) {
                updateProgress(currentSlide, currentSlide);
            });

            // Handle window resize to recalculate progress if layout changes
            $(window).on("resize", async function () {
                totalSlides = $slider.slick("getSlick").slideCount; // Recalculate total slides
                updateProgress(
                    $slider.slick("slickCurrentSlide"),
                    $slider.slick("slickCurrentSlide")
                ); // Update progress with current slide
            });

        });
    </script>
@endpush