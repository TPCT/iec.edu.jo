@extends('layouts.main')

@section('title', __('site.Our History ICS'))
@section('id', 'HistoryICS')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/HistoryICS.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    <section>
        <div class="container main-topic mt-5">
            {!! $top_section->description !!}
        </div>
    </section>

    @if ($slider)
        <div class="our-ics-history my-5 py-5">
            <div class="container">
                <div class="main-head">
                    <h2>{{$slider->title}}</h2>
                    {!! $slider->description !!}
                </div>
                <div class="all-history">
                    <div class="history-container-images">
                        @foreach($slider->slides as $slide)
                            <div class="history-image @if($loop->index == 0) active @endif">
                                <div class="history-date">
                                    <h2>{{$slide->title}}</h2>
                                </div>
                                <div class="history-pic">
                                    <picture>
                                        <x-curator-glider
                                            :media="$slide->image_id"
                                            class="mw-100 w-100"
                                            format="webp"
                                            quality="5"
                                            :force="true"
                                        />
                                    </picture>
                                    {!! $slide->description !!}
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('script')
    <script>
      const historyImage = document.querySelectorAll(".history-image");

      historyImage.forEach((image) => {
        image.addEventListener("click", () => {
          historyImage.forEach((img) => img.classList.remove("active"));

          image.classList.add("active");
        });
      });
    </script>
@endpush
