@extends('layouts.main')

@section('title', $latest_news->title)
@section('id', 'LastestNewsInner')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/LatestNewsInner.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image title="{!! $latest_news->title!!}" description="{!! $latest_news->description !!}" :image="$latest_news->image"></x-layout.header-image>
    <section>
        <div class="container main-topic">
            <div class="orange-span">
                <svg
                        width="31"
                        height="31"
                        viewBox="0 0 31 31"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                            d="M25.1875 3.39062H22.7656V2.90625C22.7656 2.52086 22.6125 2.15125 22.34 1.87874C22.0675 1.60622 21.6979 1.45313 21.3125 1.45312C20.9271 1.45313 20.5575 1.60622 20.285 1.87874C20.0125 2.15125 19.8594 2.52086 19.8594 2.90625V3.39062H11.1406V2.90625C11.1406 2.52086 10.9875 2.15125 10.715 1.87874C10.4425 1.60622 10.0729 1.45313 9.6875 1.45312C9.30211 1.45313 8.9325 1.60622 8.65999 1.87874C8.38747 2.15125 8.23438 2.52086 8.23438 2.90625V3.39062H5.8125C5.17018 3.39062 4.55417 3.64579 4.09998 4.09998C3.64579 4.55417 3.39063 5.17018 3.39062 5.8125V25.1875C3.39063 25.8298 3.64579 26.4458 4.09998 26.9C4.55417 27.3542 5.17018 27.6094 5.8125 27.6094H25.1875C25.8298 27.6094 26.4458 27.3542 26.9 26.9C27.3542 26.4458 27.6094 25.8298 27.6094 25.1875V5.8125C27.6094 5.17018 27.3542 4.55417 26.9 4.09998C26.4458 3.64579 25.8298 3.39062 25.1875 3.39062ZM8.23438 6.29688C8.23438 6.68227 8.38747 7.05188 8.65999 7.32439C8.9325 7.5969 9.30211 7.75 9.6875 7.75C10.0729 7.75 10.4425 7.5969 10.715 7.32439C10.9875 7.05188 11.1406 6.68227 11.1406 6.29688H19.8594C19.8594 6.68227 20.0125 7.05188 20.285 7.32439C20.5575 7.5969 20.9271 7.75 21.3125 7.75C21.6979 7.75 22.0675 7.5969 22.34 7.32439C22.6125 7.05188 22.7656 6.68227 22.7656 6.29688H24.7031V9.20312H6.29688V6.29688H8.23438ZM6.29688 24.7031V12.1094H24.7031V24.7031H6.29688Z"
                            fill="#DC9937"
                    />
                </svg>
                <h4>{{$latest_news->formatDate('published_at', 'd M Y')}}</h4>
            </div>
            <h3>{{$latest_news->title}}</h3>
        </div>
    </section>
    <section class="LastestNewsInner-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="LastestNewsInner-content">
                        {!! $latest_news->content !!}
                        <x-layout.share></x-layout.share>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="LastestNewsInner-slider">
                        <div class="single-item">
                            @foreach($latest_news->images as $image)
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
    <!-- End Facilities Section -->
    <section class="slider-with-progress-bar-section">
        <div class="container">
            <div class="slider-with-progress-bar--title">
                <h2>@lang('site.Related News')</h2>
            </div>
            <div class="slider-with-progress-bar-main-slider">
                @foreach($recent_news as $recent_news_piece)
                    <div class="slider-with-progress-bar--single-slide">
                        <div class="slider-with-progress-bar--single-slide-img">
                            <picture>
                                <x-curator-glider
                                    :media="$recent_news_piece->image_id"
                                    format="webp"
                                    :force="true"
                                    :quality="5"
                                />
                            </picture>
                        </div>
                        <div class="slider-with-progress-bar--single-slide-content">
                            <div class="slider-with-progress-bar--single-slide-date">
                                <p>{{$recent_news_piece->formatDate('published_at', 'd M Y')}}</p>
                            </div>
                            <div class="slider-with-progress-bar--single-slide-title">
                                <h4>
                                    {{$recent_news_piece->title}}
                                </h4>
                            </div>
                            <div
                                    class="slider-with-progress-bar--single-slide-content-inner"
                            >
                                {!! $recent_news_piece->description !!}
                                <a href="{{route('latest-news.show', ['latest_news' => $recent_news_piece])}}" class="main-btn">
                                    <span> @lang('site.Read More') </span>
                                    <svg
                                            width="17"
                                            height="13"
                                            viewBox="0 0 17 13"
                                            fill="none"
                                            xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                                d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                                fill="#DC9937"
                                        />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="slider-with-progress-bar--controllers">
                <div class="slider-with-progress-bar--controllers-arrow">
              <span class="slider-with-progress-bar--controllers-arrow-prev">
                <svg
                        width="17"
                        height="13"
                        viewBox="0 0 17 13"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                          d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                          fill="#fff"
                  />
                </svg>
              </span>
                    <span class="slider-with-progress-bar--controllers-arrow-next">
                <svg
                        width="17"
                        height="13"
                        viewBox="0 0 17 13"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                          d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                          fill="#fff"
                  />
                </svg>
              </span>
                </div>
                <div class="slider-with-progress-bar--progress">
                    <span class="" id="slider-progress" data-progress="0%"></span>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('script')
    <script>
        $(".single-item").slick({
            dots: true,
            infinite: false,
            rtl: {{$rtl}},
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
        });
    </script>
    <script>
        $(document).ready(function () {
            const $slider = $(".slider-with-progress-bar-main-slider");
            let $progress = $("#slider-progress");

            // Initialize the slick slider
            $slider.slick({
                dots: false,
                infinite: false,
                rtl: {{$rtl}},
                slidesToShow: 4,
                slidesToScroll: 4,
                nextArrow: $(".slider-with-progress-bar--controllers-arrow-next"),
                prevArrow: $(".slider-with-progress-bar--controllers-arrow-prev"),
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 3,
                            dots: false,
                        },
                    },
                    {
                        breakpoint: 991,
                        settings: {
                            slidesToShow: 2,
                            slidesToScroll: 2,
                        },
                    },
                    {
                        breakpoint: 500,
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
@endpush







