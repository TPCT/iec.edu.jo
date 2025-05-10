@extends('layouts.main')

@section('title', $page->title)
@section('id', 'AdmissionPolicy')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/ChairmanLetter.css')}}"/>
    <link rel="stylesheet" href="{{asset('/css/AdmissionPolicy.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image title="{{$page->title}}"></x-layout.header-image>
    <section class="container main-topic mt-5 pt-3">
        {!! $page->content !!}
    </section>
@endsection
