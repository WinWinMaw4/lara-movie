@extends('layouts.master')
@section('title') movie app @endsection
@section('style')
    <style>



    </style>
@endsection
@section('content')
    <div class="container">

        {{--now playing--}}
        <section class="actors">
            <div class="actors-row row row-cols-2 row-cols-sm-2 row-cols-md-4 row-cols-lg-5 row-cols-xl-5 gx-2 gy-4 py-5">
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <h3 class="text-primary py-2 text-uppercase">Popular Actors</h3>
                </div>

                @foreach($popularActors as $popularActor)
                <div class="col actor">
                    <div class="card bg-dark mb-3">
                        <a href="{{route('actor.show',$popularActor['id'])}}">
                            <img src="{{$popularActor['profile_path']}}" alt="" class="card-img-top " style="aspect-ratio: auto;">
                        </a>
                        <div class="card-body p-0 px-2 py-1">
                            <div class="card-text">
                                <a href="{{route('actor.show',$popularActor['id'])}}" class="text-decoration-none text-white">
                                    <span class="fs-5 fw-bold d-block text-truncate">{{$popularActor['name']}}</span>
                                </a>
                                <span class="fs-6 d-block text-truncate" style="color:gray ">{{$popularActor['known_for']}}</span>
                            </div>
                        </div>

                    </div>
                </div>
                @endforeach

            </div>
{{--            <div class="row">--}}
{{--                <div class="col-12">--}}
{{--                    <div class="d-flex justify-content-between">--}}
{{--                        @if($previous)--}}
{{--                            <a href="/actor/page/{{$previous}}" class="text-decoration-none">Previous</a>--}}
{{--                        @else--}}
{{--                            <span class="disabled text-white-50" disabled>Previous</span>--}}
{{--                        @endif--}}
{{--                        @if($next)--}}
{{--                            <a href="/actor/page/{{$next}}" class="text-decoration-none">Next</a>--}}
{{--                        @else--}}
{{--                            <span class="disabled text-white-50" disabled>Next</span>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}

            <div class="page-load-status d-flex justify-content-center align-items-center mb-5">
{{--                <div class="infinite-scroll-request spinner-grow spinner-grow-sm text-white-50" role="status">--}}
{{--                    <span class="visually-hidden">Loading...</span>--}}
{{--                </div>--}}
                <img class="infinite-scroll-request" src="{{asset('loading.svg')}}" alt="">
                <p class="infinite-scroll-last">End of content</p>
                <p class="infinite-scroll-error">No more pages to load</p>
            </div>
        </section>

    </div>

@stop

@push('scripts')
    <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
    <script>
        let elem = document.querySelector('.actors-row');
        let infScroll = new InfiniteScroll( elem, {
            // options
            path: '/actor/page/@{{#}}',
            append: '.actor',
            status: '.page-load-status',
            // history: false,

        });

    </script>
@endpush
