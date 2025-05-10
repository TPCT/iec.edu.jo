@extends('layouts.main')

@section('title', $facility->title)
@section('id', 'FacilitiesInner')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/Facilities.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/FacilitiesInner.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image title="{!! $facility->title!!}" description="{!! $facility->description !!}" :image="$facility->image"></x-layout.header-image>
    <section class="facilities-inner-section mt-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-5">
                    <div class="facilities-inner-content">
                        {!! $facility->content !!}
                        <x-layout.share></x-layout.share>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="facilities-inner-slider">
                        <div class="single-item">
                            @foreach($facility->images as $image)
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

    <section class="slider-with-progress-bar-section">
        <div class="container">
            <div class="slider-with-progress-bar--title">
                <h2>@lang('site.Other Facilities')</h2>
            </div>
            <div class="slider-with-progress-bar-main-slider">
                @foreach($related_facilities as $facility)
                    <div class="slider-with-progress-bar--single-slide">
                        <div class="slider-with-progress-bar--single-slide-img">
                            <picture>
                                <x-curator-glider
                                        :media="$facility->image_id"
                                        format="webp"
                                        :force="true"
                                        :quality="5"
                                        class="mw-100 w-100"
                                />
                            </picture>
                        </div>
                        <div class="slider-with-progress-bar--single-slide-content">
                            <div class="slider-with-progress-bar--single-slide-title">
                                <h4>{{$facility->title}}</h4>
                            </div>
                            <div
                                    class="slider-with-progress-bar--single-slide-content-inner"
                            >
                                <a href="{{route('facilities.show', ['facility' => $facility] )}}" class="main-btn">
                                    <span> @lang('site.Discover More') </span>
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
            rtl: {{$rtl}},
            infinite: false,
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
                rtl: {{$rtl}},
                infinite: false,
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