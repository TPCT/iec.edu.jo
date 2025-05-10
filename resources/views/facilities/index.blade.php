@extends('layouts.main')

@section('title', __('site.Facilities'))
@section('id', 'Facilities')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/Facilities.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    <section>
        <div class="container main-topic">
            <h4>
                {!!\App\Helpers\Utilities::trimParagraph($top_section->description)!!}
            </h4>
        </div>
    </section>

    <section class="facilities-section mt-5">
        <div class="container">
            <div class="row">
                @foreach($facilities as $facility)
                    <div class="col-md-6 col-lg-3 mb-5">
                        <div
                                class="box-facilities d-flex align-itmes-center flex-column gap-2 h-100"
                        >
                            <picture>
                                <x-curator-glider
                                    :force="true"
                                    :media="$facility->image_id"
                                    quality="5"
                                    format="webp"
                                    class="mw-100 w-100"
                                />
                            </picture>
                            <div
                                    class="info-box-facilities d-flex flex-column align-items-center justify-content-between gap-2"
                            >
                                <h4>{{$facility->title}}</h4>
                                <a href="{{route('facilities.show', ['facility' => $facility])}}" class="main-btn d-flex align-items-center gap-2">
                                    @lang('site.Discover More')
                                    <i class="fa-solid fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
