@extends('layouts.main')

@section('title', __('site.Extra Curricular Activities'))
@section('id', 'ExtraCurricularActivities')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/ExtraCurricularActivities.css')}}"/>
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

    <section class="curricular-activities-section mt-5">
        <div class="container">
            <div class="row">
                @foreach($activities as $activity)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <a
                                href="{{route('extra-curricular-activities.show', ['extra_curricular_activity' => $activity])}}"
                                class="info-curricular-activities w-100 h-100 d-flex align-items-center gap-2"
                        >
                            <picture>
                                <x-curator-glider
                                        :force="true"
                                        :media="$activity->image_id"
                                        quality="5"
                                        format="webp"
                                />
                            </picture>
                            <h4>{{$activity->title}}</h4>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
