@extends('layouts.main')

@section('title', $page->title)
@section('id', 'ChairmanLetter')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/ChairmanLetter.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image title="{{$page->title}}"></x-layout.header-image>
    <section class="container main-topic mt-5 pt-3">
        {!! $page->content !!}
    </section>
@endsection
