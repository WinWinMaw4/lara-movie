@extends('layouts.master')
@section('title'){{$section}}- movie app  @endsection
@section('style')
    <style>



    </style>
@endsection
@section('content')
    <div class="container">

        {{--now playing--}}
        <section class="seeAll">
            <div class="seeAll-row row row-cols-2 row-cols-sm-2 row-cols-md-5 row-cols-lg-6 row-cols-xl-6 gx-2 gy-4 py-5">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h3 class="text-primary py-2 text-uppercase">{{$section}}</h3>
                </div>
                @foreach($seeAllTv as $tv)
                    <x-tv-card :tv="$tv" :genres="$genres" ></x-tv-card>
                @endforeach
            </div>

            @if(!empty($seeAllTv))
                <div class="page-load-status d-flex justify-content-center align-items-center mb-5">
                    {{--                <div class="infinite-scroll-request spinner-grow spinner-grow-sm text-white-50" role="status">--}}
                    {{--                    <span class="visually-hidden">Loading...</span>--}}
                    {{--                </div>--}}
                    <img class="infinite-scroll-request" src="{{asset('loading.svg')}}" alt="">
                    <p class="infinite-scroll-last">End of content</p>
                    <p class="infinite-scroll-error">No more pages to load</p>
                </div>
            @endif
        </section>

    </div>

@stop

@push('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        console.log('/tv/{{$section}}/all/page/@{{#}}')
        {{--pathSection = {!! json_encode($section,JSON_HEX_TAG) !!};--}}
        {{--console.log(pathSection);--}}
        let elem = document.querySelector('.seeAll-row');
        let infScroll = new InfiniteScroll( elem, {
            // options
            path: '/tv/{{$section}}/all/page/@{{#}}',
            append: '.col',
            status: '.page-load-status',
            // history: false,

        });

    </script>
@endpush
