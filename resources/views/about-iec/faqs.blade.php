@extends('layouts.main')

@section('title', __('site.Faqs'))
@section('id', 'FAQs')

@push('style')
    <link rel="stylesheet" href="{{asset('/css/faqs.css')}}"/>
@endpush

@section('content')
    <x-layout.header-image></x-layout.header-image>
    @if(count($years) > 1)
        <section>
            <div class="container main-topic">
                <form action="" id="filter-form">
                    <label for="">@lang('site.Filter by years')</label>
                    <select name="filter_by_year" id="filter-by-year">
                        <option value="">@lang('site.Filter By Year')</option>
                        @foreach($years as $year)
                            <option value="{{$year}}">{{$year}}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </section>
    @endif
    <section class="faqs-section" id="content-section">
        <div
                class="container accordion accordion-flush custom-accordion"
                id="faqsFlushExample"
        >
            <div class="Faqs-acc-splited-div">
                @foreach($faqs as $faq)
                    @continue($loop->index % 2)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-{{$loop->index}}"
                                    aria-expanded="false"
                                    aria-controls="flush-{{$loop->index}}"
                            >
                                {{$faq->title}}
                                <span class="accordion-btn"></span>
                            </button>
                        </h2>
                        <div
                                id="flush-{{$loop->index}}"
                                class="accordion-collapse collapse"
                                aria-labelledby="flush-{{$loop->index}}"
                                data-bs-parent="#faqsFlushExample"
                        >
                            <div class="accordion-body">
                               {!! $faq->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="Faqs-acc-splited-div">
                @foreach($faqs as $faq)
                    @continue($loop->index % 2 == 0)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button
                                    class="accordion-button collapsed"
                                    type="button"
                                    data-bs-toggle="collapse"
                                    data-bs-target="#flush-{{$loop->index}}"
                                    aria-expanded="false"
                                    aria-controls="flush-{{$loop->index}}"
                            >
                                {{$faq->title}}
                                <span class="accordion-btn"></span>
                            </button>
                        </h2>
                        <div
                                id="flush-{{$loop->index}}"
                                class="accordion-collapse collapse"
                                aria-labelledby="flush-{{$loop->index}}"
                                data-bs-parent="#faqsFlushExample"
                        >
                            <div class="accordion-body">
                                {!! $faq->description !!}
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@push('script')
    <script>
        $("#filter-by-year").on('change', function(){
            $("#content-section").load("{{route('about-iec.faqs')}}" + "?filter_by_year=" + $(this).val() + " #content-section")
        })
    </script>
@endpush