@extends('layouts.master')
@section('title') {{$tvshow['name']}}-season - movie app @endsection
@section('content')
    <div class="season container">
        <div class="row my-3">
            <div class="col-12">
                <a href="{{route('tv.show',$tvshow['id'])}}" class="text-decoration-none text-white-50">
                    <i class="bi bi-arrow-left"></i>
                    Back To Main
                </a>
            </div>
        </div>
        <div class="row my-3 align-items-center">
            <div class="col-3 col-lg-2 col-xl-1">
                <img src="{{$tvshow['poster_path']}}" alt="" class="" style="width: 100%;height: 100%;object-fit: cover">
            </div>
            <div class="col-8 col-lg-10 col-xl-11">
                <h3 class="my-3 text-uppercase">
                    {{$tvshow['name']}}
                    ({{$tvshow['first_air_year']}})
                </h3>
{{--                <div class="fs-6 text-white-50 fw-light p-2 my-2">{{$tvshow['overview']}}</div>--}}


                {{--                <h5>{{$season['name']}}</h5>--}}
{{--                <span class="fs-6 d-block text-white-50">Total Episode : {{count($season['episodes'])}} </span>--}}
{{--                <span class="fs-6 d-block text-white-50">Air Date : {{$season['air_date']}}</span>--}}
            </div>
        </div>

        {{--        seasons lists--}}
        @foreach($tvshow['seasons'] as $season)
        <div class="row my-3">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card  bg-dark shadow">
                    <div class="row g-0">
                            <div class="col-1">
                                <img src="{{$season['poster_path']}}" alt="" class="rounded-start img-fluid">
                            </div>
                            <div class="col-10">
                                <div class="card-body h-100 position-relative ">
                                    <h4 class="text-secondary mb-0"><a href="{{url('/tv/'.$tvshow['id'].'/season/'.$season['season_number'])}}" class="text-decoration-none" >{{$season['name']}}</a></h4>
                                    <span class="fs-6 fw-light text-white-50">{{$season['air_date']}}</span> |
                                    <span class="fs-6 fw-light text-white-50">{{$season['episode_count']}} Episode</span>
                                    <div class="py-3 position-absolute bottom-0"> {{$season['overview']}}</div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
