@extends('layouts.main')

@section('title', __('site.Mission And Vision'))
@section('id', 'MissionVision')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/MissionVision.css')}}"/>
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
    <section class="mission-vision-section">
        <div class="container">
            @foreach($our_mission_and_vision_section->features as $feature)
                @break($loop->index >= 2)
                <div class="mission-vision-card">
                    <div class="mission-vision-card-heading">
                        <div class="orange-icon">
                            <picture>
                                <x-curator-glider
                                        :media="$feature->image_id"
                                        :force="true"
                                        :quality="5"
                                        format="webp"
                                />
                            </picture>
                        </div>
                        <h2>{{$feature->title}}</h2>
                    </div>
                    <div>
                        {!! $feature->description !!}
                    </div>
                </div>

            @endforeach
        </div>
    </section>

    <x-layout.related-sections></x-layout.related-sections>
@endsection
