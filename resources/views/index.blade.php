@extends('layouts.master')
@section('title') movie app @endsection
@section('style')
    <style>
        .slick-prev, .slick-next {
            width: auto !important;
            height: 30px;
            /*background:#000;*/
            color: orange !important;
            padding: 5px;
            top: 5% !important;
        }
        .slick-prev:hover, .slick-next:hover {
            width:auto !important;
        }
        .slick-next{
            right:2% !important;
        }
        .slick-prev{
            left:90% !important;
        }



        /*.popular-overflow-overlay{*/
        /*    overflow: hidden !important;*/
        /*}*/
        /*.popular-overflow-overlay:hover{*/
        /*    overflow: overlay !important;*/
        /*}*/

    </style>
@endsection
@section('content')
    <div class="container">
{{--popular Movie--}}
{{--        row-cols-1 row-cols-md-3 row-cols-lg-5 g-2--}}
       <section class="popular-movie">
           <div class="row pt-5">
               <div class="d-flex justify-content-between align-items-center">
                   <span class="text-primary text-uppercase my-3 h4">Popular Movies</span>
                   <a href="{{route('movie.seeAll','popular movies','/all/',1)}}" class="text-decoration-none">See All</a>
               </div>

           </div>
           <div class="row pt-5  row-cols-1 popular-slide">
               @foreach($popularMovies as $movie)
                   <div class="col overflow-hidden" >
                       <a href="{{route('movie.show',$movie['id'])}}">
                           <div class="card popular-card w-100 bg-transparent position-relative" style="height: 350px">
                               <div class="card-img h-100 w-100 overflow-hidden">
                                   <img src="{{$movie['poster_path']}}" alt="" class="w-100 h-100" style="object-fit: cover">
                               </div>
                               <div class="card-body position-absolute">
                                   <div class="card-text">
                                       {{--                                <span class="fs-3 text-white fw-bold d-block">{{$movie['title']}}</span>--}}
                                       <span class="fs-6 text-light fw-bold bg-success rounded px-1">{{$movie['vote_average']}}</span>
                                       <span class="text-white-50 mx-1">|</span>
                                       <span class="fs-6 text-light fw-bold">{{$movie['release_date']}}</span>
                                   </div>
                               </div>
                           </div>
                       </a>
                   </div>

               @endforeach
           </div>
       </section>
{{--now playing--}}
        <section class="now-playing my-5">

            <div class="d-flex justify-content-between align-items-center">
                <span class="text-primary text-uppercase my-3 h4">Now Playing</span>
                <a href="{{route('movie.seeAll','now playing movies','/all/',1)}}" class="text-decoration-none">See All</a>
            </div>
            <div class="row row-cols-3 row-cols-sm-3 row-cols-md-4 row-cols-lg-4 row-cols-xl-6 gx-2 gy-4 flex-nowrap popular-overflow-overlay custom-scroll-bar" >
{{--                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
{{--                    <h3 class="text-primary py-2 text-uppercase">Now Playing Movies</h3>--}}
{{--                </div>--}}

                @foreach($nowPlayingMovies as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres"></x-movie-card>
                @endforeach
            </div>
        </section>

{{--top rate        --}}
        <section class="top-rate my-5">

            <div class="d-flex justify-content-between align-items-center">
                <span class="text-primary text-uppercase my-3 h4">top rate</span>
                <a href="{{route('movie.seeAll','top rate movies','/all/',1)}}" class="text-decoration-none">See All</a>
            </div>
            <div class="row row-cols-3 row-cols-sm-3 row-cols-md-4 row-cols-lg-4 row-cols-xl-6 gx-2 gy-4 flex-nowrap popular-overflow-overlay custom-scroll-bar" >
                {{--                <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">--}}
                {{--                    <h3 class="text-primary py-2 text-uppercase">Now Playing Movies</h3>--}}
                {{--                </div>--}}

                @foreach($topRateMovies as $movie)
                    <x-movie-card :movie="$movie" :genres="$genres"></x-movie-card>
                @endforeach
            </div>
        </section>


    </div>

@stop

@push('scripts')
    <script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script src="" ></script>


    <script type="text/javascript">
        $(document).ready(function(){
            $('.popular-slide').slick({
                infinite: false,
                dots:true,
                slidesToShow: 5,
                slidesToScroll: 2,
                autoplay: true,
                autoplaySpeed: 1000,

                responsive:[
                    {
                        breakpoint: 1600,
                        settings: {
                            slidesToShow: 5,
                            infinite: false
                        }

                    },
                    ,
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 4,
                            infinite: false
                        }

                    },
                    {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 3,
                        infinite: false
                    }

                    },
                    {
                        breakpoint: 800,
                        settings: {
                            slidesToShow: 3,
                            arrows:false,
                            dots: false,
                            infinite: false
                        }

                    },
                    {

                        breakpoint: 600,
                        settings: {
                            slidesToShow: 2,
                            arrows:false,
                            dots: false
                        }

                    },
                    {

                        breakpoint: 300,
                        // settings: "unslick" // destroys slick
                        settings: {
                            slidesToShow: 2,
                            arrows: false,
                            dots: false,
                        }

                    },

                ]
        });
        });
    </script>
@endpush
