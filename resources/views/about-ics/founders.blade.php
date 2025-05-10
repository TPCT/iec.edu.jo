@extends('layouts.main')

@section('title', __('site.Founders'))
@section('id', 'Founders')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/Founders.css')}}"/>
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
    <section class="Founders-section">
        <div class="container">
            @foreach($team_members ?? [] as $team_member)
                <div class="Founders-card">
                    <h4>{{$team_member->title}}</h4>
                </div>
            @endforeach
        </div>
    </section>
    <section class="container">
        <div class=" last-yellow-box">
            <div>
                <h4 class="text-white">@lang('site.Founders Bottom Section Title')</h4>
                <p class="text-white">
                    @lang('site.Founders Bottom Section Brief')
                </p>
            </div>
            <a href="{{route('about-ics.board-of-directors')}}" class="secondary-btn">
                <span> @lang('site.Board of Directors') </span>
                <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </section>
@endsection
