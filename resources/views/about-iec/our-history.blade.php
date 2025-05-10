@extends('layouts.main')

@section('title', __('site.Our History'))
@section('id', 'History')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/History.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    <section>
        <div class="container main-topic mt-5">
            {!! $top_section->description !!}
        </div>
    </section>
    @if ($slider)
        <section class="history-sliders-section">
            <div class="position-relative history-slider-wrapper">
                <div class="container history-slider">
                    @foreach ($slider->slides as $slide)
                        <div class="history-slide">
                            <picture>
                                <x-curator-glider
                                        :media="$slide->image_id"
                                        format="webp"
                                        quality="5"
                                        :force="true"
                                />
                            </picture>
                            <div class="history-slide-content">
                                <h2>{{$slide->title}}</h2>
                                {!! $slide->description !!}
                            </div>
                        </div>
                    @endforeach
                </div>
                @if ($slider->slides->count() > 1)
                    <div class="history-slider-arrows container">
                        @if (app()->getLocale() == "ar")
                            <span>
                              <svg class="history-next slick-arrow" width="17" height="13" viewBox="0 0 17 13"
                                   xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                />
                            </svg>
                        </span>
                            <span>
                              <svg class="history-prev slick-arrow" width="17" height="13" viewBox="0 0 17 13"
                                   xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                />
                              </svg>
                        </span>
                        @else
                            <span>
                              <svg class="history-prev slick-arrow" width="17" height="13" viewBox="0 0 17 13"
                                   xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                />
                              </svg>
                        </span>
                            <span>
                              <svg class="history-next slick-arrow" width="17" height="13" viewBox="0 0 17 13"
                                   xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z"
                                />
                            </svg>
                        </span>
                        @endif
                    </div>
                @endif
            </div>
            <div class="position-relative container timline-slider-wrapper">
                <div class="history-timline-subslider">
                    @foreach ($slider->slides as $slide)
                        <div class="history-timline-slide">
                            <div class="timeline-dot">
                                <div class="timeline-inner-dot"></div>
                            </div>
                            <h3>{{$slide->title}}@if (app()->getLocale() == "en")
                                    's
                                @endif </h3>
                        </div>
                    @endforeach
                </div>
                <div class="geyHistory-line"></div>
            </div>
        </section>
    @endif

    <x-layout.related-sections></x-layout.related-sections>
@endsection

@push('script')
    <script>
        $(".history-slider").slick({
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 1,
            slidesToScroll: 1,
            rtl: {{$rtl}},
            prevArrow: $(".history-prev"),
            nextArrow: $(".history-next"),
            asNavFor: ".history-timline-subslider",
        });
        $(".history-timline-subslider").slick({
            focusOnSelect: true,
            dots: false,
            infinite: true,
            speed: 300,
            slidesToShow: 5,
            rtl: {{$rtl}},
            slidesToScroll: 1,
            asNavFor: ".history-slider",
            arrows: false,
            responsive: [
                {
                    breakpoint: 991.88888,
                    settings: {
                        // vertical: true,
                        // verticalSwiping: true,
                        slidesToShow: 3,
                        slidesToScroll: 1,
                        arrow: true,
                    },
                },
            ],
        });

        $(document).ready(function () {
            function adjustTimelineMargin() {
                // Get the width of the history slide container
                var historyImgWidth = $(".history-slide img").outerWidth();

                // Get the number of timeline items
                var timelineItems = $(".history-timline-slide").outerWidth();

                // Calculate the margin for centering the timeline based on the slide width
                var marginInlineStart = historyImgWidth / 2 - timelineItems / 2; // Adjust 15 for your gap between items

                // Apply the calculated margin to the timeline subslider
                $(".history-timline-subslider").css(
                    "margin-inline-start",
                    marginInlineStart
                );
            }

            // Initial call to adjust the margin
            adjustTimelineMargin();

            // Adjust margin on window resize
            $(window).resize(function () {
                adjustTimelineMargin();
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            function cloneSlides(sliderSelector, slideSelector) {
                const slider = document.querySelector(sliderSelector);
                const slides = slider.querySelectorAll(slideSelector);
                const slideCount = slides.length;

                if (slideCount < 6) {
                    const clonesNeeded = 6 - slideCount;
                    for (let i = 0; i < clonesNeeded; i++) {
                        const clone = slides[i % slideCount].cloneNode(true);
                        slider.appendChild(clone);
                    }
                }
            }

            cloneSlides('.history-slider', '.history-slide');
            cloneSlides('.history-timline-subslider', '.history-timline-slide');

            // Reinitialize the slick slider after cloning
            $('.history-slider').slick('refresh');
            $('.history-timline-subslider').slick('refresh');
        });
    </script>
@endpush
