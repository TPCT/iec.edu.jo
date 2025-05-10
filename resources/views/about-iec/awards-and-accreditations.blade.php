@extends('layouts.main')

@section('title', __('site.Awards'))
@section('id', 'Awards')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/Awards.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    <section class="awards-section">
        <div class="container">
            @foreach($awards ?? [] as $award)
                <div class="awards-card">
                    <picture>
                        <x-curator-glider
                            :media="$award->image_id"
                            format="webp"
                            :force="true"
                            quality="5"
                        />
                    </picture>
                    <div>
                        <h4>{{$award->title}}</h4>
                        {!! $award->description !!}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <x-layout.related-sections></x-layout.related-sections>
@endsection
