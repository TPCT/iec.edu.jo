@extends('layouts.main')

@section('title', __('site.Video Gallery'))
@section('id', 'VideoGallery')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/VideoGallery.css')}}"/>

@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    <section>
            <section>
        <div class="container main-topic">
            <h4>
                {!!\App\Helpers\Utilities::trimParagraph($top_section->description)!!}
            </h4>
        </div>
    </section>
    </section>
    <section class="PhotoGallery-section">
        <div class="container">
            @foreach($albums as $album)
                <div class="video-card">
                    <picture>
                        <x-curator-glider
                                :media="$album->image_id"
                                format="webp"
                                quality="5"
                                :force="true"
                                alt="{{$album->title}}"
                        />
                    </picture>
                    <div class="Video-card-content">
                        <h4>{{$album->title}}</h4>
                        <picture class="play-video-icon" onclick="openPopup(this)" data-info="{{$album->publishedAt()}}"
                                 data-video="{{$album->video_url}}">
                            <img src="{{asset('/Assets/Icons/General/Vector.svg')}}" alt="" />
                        </picture>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    {{$albums->links()}}

    <div id="popup-modal" class="popup" style="display: none">
        <div class="pop-up-header container">
            <span class="close" onclick="closePopup()">
              <picture><img src="{{asset('/Assets/Icons/General/close.svg')}}" alt="" srcset="" /></picture>
            </span>
        </div>

        <div class="img-container container overflow-auto d-flex flex-column">
            <div class="popup-content" id="popup-img"></div>
        </div>
    </div>
@endsection


@push('script')
    <script>
        let currentSlideIndex = 0;
        // Select only the video thumbnail images (those with a data-video attribute)
        let items = document.querySelectorAll(
            ".gallery-two-container picture img[data-video]"
        );

        // Open the popup and show the clicked image/video
        function openPopup(img) {
            var modal = document.getElementById("popup-modal");
            var modalImg = document.getElementById("popup-img");
            var captionText = document.getElementById("caption");
            // var infoText = document.getElementById("info-text"); // Reference to the info text element

            // Set the current slide index based on the clicked item
            currentSlideIndex = Array.from(items).indexOf(img);

            // Clear existing content
            modalImg.innerHTML = "";

            var videoUrl = img.getAttribute("data-video");

            if (videoUrl) {
                // Show YouTube iframe if there's a video URL
                modalImg.innerHTML =
                    '<iframe width="100%" height="100%" src="' +
                    videoUrl +
                    '" frameborder="0" allowfullscreen></iframe>';
            } else {
                // Otherwise, display the image
                modalImg.innerHTML =
                    '<img src="' +
                    img.src +
                    '" alt="' +
                    img.alt +
                    '" style="max-width: 100%; max-height: 80%;">';
            }

            // Display the modal
            modal.style.display = "block";
            // captionText.innerHTML = picture.alt;

            // Update the info text
            // infoText.innerHTML = img.getAttribute("data-info"); // Get info text from data-info attribute

            // Prevent body scrolling
            document.querySelector('html').style.overflow = "hidden";
        }

        // Close the popup
        function closePopup() {
            var modal = document.getElementById("popup-modal");
            modal.style.display = "none";

            // Clear content (iframe or image) when closing
            var modalImg = document.getElementById("popup-img");
            modalImg.innerHTML = ""; // Clear content

            // Allow scrolling again
            document.querySelector('html').style.removeProperty('overflow');
        }

        // Change to the next or previous slide
        function changeSlide(direction) {
            currentSlideIndex += direction;

            // Wrap around when navigating beyond the first or last item
            if (currentSlideIndex < 0) {
                currentSlideIndex = items.length - 1; // Go to the last image/video
            } else if (currentSlideIndex >= items.length) {
                currentSlideIndex = 0; // Go to the first image/video
            }

            // Update the popup with the new image or video
            var newItem = items[currentSlideIndex];
            var modalImg = document.getElementById("popup-img");
            var captionText = document.getElementById("caption");
            var infoText = document.getElementById("info-text");

            // Clear existing content
            modalImg.innerHTML = "";

            var videoUrl = newItem.getAttribute("data-video");

            if (videoUrl) {
                // If it's a video, show the iframe
                modalImg.innerHTML =
                    '<iframe width="100%" height="100%" src="' +
                    videoUrl +
                    '" frameborder="0" allowfullscreen></iframe>';
            } else {
                // Otherwise, show the image
                modalImg.innerHTML =
                    '<img src="' +
                    newItem.src +
                    '" alt="' +
                    newItem.alt +
                    '" style="max-width: 100%; max-height: 80%;">';
            }

            // Update caption and info text
            captionText.innerHTML = newItem.alt;
            infoText.innerHTML = newItem.getAttribute("data-info");
        }
    </script>
@endpush