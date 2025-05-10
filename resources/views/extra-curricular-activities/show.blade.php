@extends('layouts.main')

@section('title', $extra_curricular_activity->title)
@section('id', 'AdmissionPolicy')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/AdmissionPolicy.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image :description="$extra_curricular_activity->description" title="{{$extra_curricular_activity->title}}" :image="$extra_curricular_activity->image"></x-layout.header-image>
    <div class="container mt-5">
        {!! $extra_curricular_activity->content !!}
    </div>
@endsection
