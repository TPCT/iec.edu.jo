@extends('layouts.main')

@section('title', __('site.Photo Gallery'))
@section('id', 'PhotoGallery')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/PhotoGallery.css')}}"/>
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
                <div class="photoGallery-card">
                    <picture>
                        @php
                            $album_images = [];
                            $album_images_captions = [];
                            foreach ($album->images as $image){
                                if ( $album_image = \Awcodes\Curator\Models\Media::find($image->image_id) ){
                                    $album_images[] = $album_image->url;
                                    $album_images_captions[] = $image->caption ?? "";
                                }
                            }
                            $album_images = json_encode($album_images);
                            $album_images_captions = json_encode($album_images_captions);
                        @endphp
                        <x-curator-glider
                                :media="$album->image_id"
                                format="webp"
                                quality="5"
                                :force="true"
                                alt="{{$album->title}}"
                                data-caption="{{$album_images_captions}}"
                                data-album="{{$album_images}}"
                                class="gallery-img"
                        />
                    </picture>
                    <div class="photoGallery-card-content">
                        <h4>{!! $album->title !!}</h4>
                        <a onclick="openPopup(0)" class="main-btn">
                            @lang('site.View album')
                            <svg width="17" height="13" viewBox="0 0 17 13" xmlns="http://www.w3.org/2000/svg">
                                <path
                                        d="M1.33917e-06 6.50077C1.31764e-06 6.25456 0.107461 6.01844 0.298738 5.84434C0.490016 5.67024 0.749444 5.57243 1.01995 5.57243L13.5144 5.57243L9.13537 1.58753C8.94376 1.41313 8.83611 1.17659 8.83611 0.929952C8.83611 0.683314 8.94376 0.446777 9.13537 0.272377C9.32698 0.0979774 9.58686 -3.05597e-07 9.85783 -3.29286e-07C10.1288 -3.52976e-07 10.3887 0.0979773 10.5803 0.272377L16.7 5.84242C16.7951 5.92867 16.8705 6.03115 16.922 6.14399C16.9735 6.25684 17 6.37782 17 6.5C17 6.62218 16.9735 6.74316 16.922 6.85601C16.8705 6.96885 16.7951 7.07133 16.7 7.15758L10.5803 12.7276C10.4854 12.814 10.3728 12.8825 10.2488 12.9292C10.1249 12.9759 9.99201 13 9.85783 13C9.72366 13 9.5908 12.9759 9.46684 12.9292C9.34288 12.8825 9.23024 12.814 9.13537 12.7276C9.04049 12.6413 8.96523 12.5388 8.91389 12.4259C8.86254 12.3131 8.83611 12.1922 8.83611 12.07C8.83611 11.9479 8.86254 11.827 8.91389 11.7142C8.96523 11.6013 9.04049 11.4988 9.13537 11.4125L13.5144 7.42911L1.01995 7.42912C0.749444 7.42912 0.490016 7.33131 0.298738 7.15721C0.107461 6.98311 1.36069e-06 6.74699 1.33917e-06 6.50077Z" />
                            </svg>
                        </a>
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
            <picture>
                <img id="popup-img" src="{{asset('/Assets/Image/Media Center/Rectangle 47.png')}}" />
            </picture>
            <div class="image-content">
                <p id="caption"></p>
            </div>
        </div>

            <div class="popup-footer popup-controls container">
                <a class="prev" onclick="changeSlide(-1)">
                    <picture>
                        <img src="{{asset('/Assets/Icons/General/prev.svg')}}" alt="" srcset="" />
                    </picture>
                </a>
                <a class="next" onclick="changeSlide(1)">
                    <picture>
                        <img src="{{asset('/Assets/Icons/General/prev.svg')}}" alt="" srcset="" />
                    </picture>
                </a>
            </div>

    </div>
@endsection


@push('script')
    <script>
        let currentSlideIndex = 0;
        let images = document.querySelectorAll(".gallery-img");

        // Open the popup and show the current image
        function openPopup(index) {
            currentSlideIndex = 0; // Start from the first image in the album
            const image = images[index];
            currentAlbum = JSON.parse(image.getAttribute("data-album")); // Get the album images
            currentCaptions = JSON.parse(image.getAttribute("data-caption")); // Split captions into an array
            updatePopupContent();
            document.getElementById("popup-modal").style.display = "block";
            document.querySelector('html').style.overflow = "hidden"
        }

        // Close the popup
        function closePopup() {
            document.querySelector('html').style.overflow = "hidden"
            document.getElementById("popup-modal").style.display = "none";
            document.querySelector('html').style.removeProperty('overflow');
        }

        // Change the slide (next/prev)
        function changeSlide(direction) {
            currentSlideIndex += direction;

            if (currentSlideIndex < 0) {
                currentSlideIndex = currentAlbum.length - 1; // Wrap to last image
            } else if (currentSlideIndex >= currentAlbum.length) {
                currentSlideIndex = 0; // Wrap to first image
            }

            updatePopupContent();
        }

        // Update the popup content (image, caption, and info)
        function updatePopupContent() {
            const modalImg = document.getElementById("popup-img");
            const captionText = document.getElementById("caption");

            // Update image and caption
            modalImg.src = currentAlbum[currentSlideIndex]; // Set image
            captionText.innerHTML = currentCaptions[currentSlideIndex].trim(); // Set corresponding caption
        }

        // Initial setup to hide the popup on load
        window.onload = function () {
            document.getElementById("popup-modal").style.display = "none";
        };
    </script>
@endpush