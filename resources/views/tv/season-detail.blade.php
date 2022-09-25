@extends('layouts.master')
@section('title') movie app @endsection
@section('content')
    <div class="tv-show container">
        <div class="row my-3">
            <div class="col-12">
                    <a href="{{route('season.index',$seasonEp['show_id'])}}" class="text-decoration-none text-white-50">
                        <i class="bi bi-arrow-left"></i>
                        Back To Session Lists
                    </a>
            </div>
        </div>
        {{--        seasons--}}
        <div class="row my-3 mb-5">
            <div class="col-3 col-lg-2 col-xl-1">
                <img src="{{$seasonEp['poster_path']}}" alt="" class="" style="width: 100%;height: 100%;object-fit: cover">
            </div>
            <div class="col-8 col-lg-10 col-xl-11">
                <h3 class="my-3 text-uppercase">
                    {{$seasonEp['tvshow_name']}}
                    ({{$seasonEp['air_year']}})
                </h3>
                <h5>{{$seasonEp['name']}}</h5>
                <span class="fs-6 d-block text-white-50">Total Episode : {{count($seasonEp['episodes'])}} </span>
                <span class="fs-6 d-block text-white-50">Air Date : {{$seasonEp['air_date']}}</span>

            </div>
        </div>

        <div class="row gy-3">
            @foreach($seasonEp['episodes'] as $episode)
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card  bg-dark shadow">
                        <div class="row g-0">
                            <div class="col-4 col-md-3 col-lg-2">
                                <div class="w-100 overflow-hidden" style="max-height: 150px;">
                                    <img src="{{$episode['still_path']}}" alt="" class="rounded-start" style="object-fit: cover;object-position: center;">
                                </div>
                            </div>
                            <div class="col-8 col-md-9 col-lg-10 px-2 py-1">
                                <div class="d-flex justify-content-between ">
                                           <span class="fs-5">
                                               Episode : {{$episode['episode_number']}} -
                                               <span class="fs-6 fw-light text-white-50">
                                                   {{ ($episode['runtime'] >= 60) ?  intdiv($episode['runtime'], 60).'h'. ($episode['runtime'] % 60). 'm' : ($episode['runtime'] % 60). 'min'}}
                                               </span>
                                           </span>
                                    <span class="text-white-50">{{$episode['air_date']}}</span>
                                </div>
{{--                                <div>{{$seasonEp['tvshow_name']}}</div>--}}
                                <div class="fs-6 text-white-50 fw-light p-2 my-2">{{$episode['overview']}}</div>
                            </div>
                            {{--                                            <div class="col-10">--}}
                            {{--                                                <div class="card-body h-100 position-relative ">--}}
                            {{--                                                    <h4 class="text-secondary mb-0"><a href="{{url('/tv/'.$tvshow['id'].'/season/'.$seasons['season_number'])}}" class="text-decoration-none" >{{$seasons['name']}}</a></h4>--}}
                            {{--                                                    <span class="fs-6 fw-light">{{$seasons['air_date_year']}}</span> |--}}
                            {{--                                                    <span class="fs-6 fw-light">{{$seasons['episode_count']}} Episode</span>--}}
                            {{--                                                    <div class="py-3 position-absolute bottom-0"> {{$seasons['name']}} of Scoop premiered on {{$seasons['air_date']}}</div>--}}
                            {{--                                                </div>--}}
                            {{--                                            </div>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


            <div class="col-12 py-5">
                <span class="text-white fs-5 text-decoration-none">End of Episode</span>
            </div>
    </div>
    @endsection
