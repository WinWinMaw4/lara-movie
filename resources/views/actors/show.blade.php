@extends('layouts.master')
@section('title') movie app @endsection
@section('style')
    <style>

    </style>
@endsection
@section('content')
    <div class="movie-show container">
        {{--        actor detail--}}
        <div class="row my-2 my-lg-5 flex-md-column flex-lg-row">
            <div class="col-12 col-md-6 col-lg-3 mx-auto d-flex flex-column align-items-center justify-content-center align-items-lg-start justify-content-lg-start">
               <div class="py-2 py-md-3 py-lg-5 actor_detail_position_sticky">
                   <div class="w-100 rounded overflow-hidden movie-show-img-div  mx-auto">
                       <img src="{{$actor['profile_path']}}" alt="" class="" style="width: 100%;height: 100%;object-fit: cover">
                   </div>
                   <div class="social my-2 text-center text-lg-start">
{{--                      @if($social['homepage'])--}}
{{--                           <a href="{{$social['homepage']}}" class="text-white-50 text-decoration-none mx-1" title="website">--}}
{{--                               <i class="bi bi-link-45deg fs-4"></i>--}}
{{--                           </a>--}}
{{--                       @endif--}}
                       @if($social['facebook'])
                          <a href="{{$social['facebook']}}" target="_blank" class="text-white-50 text-decoration-none mx-1" title="facebook">
                              <i class="bi bi-facebook fs-4"></i>
                          </a>
                       @endif
                        @if($social['instagram'])
                           <a href="{{$social['instagram']}}" target="_blank" class="text-white-50 text-decoration-none mx-1" title="instagram">
                               <i class="bi bi-instagram fs-4"></i>
                           </a>
                      @endif
                        @if($social['twitter'])
                           <a href="{{$social['twitter']}}" target="_blank" class="text-white-50 text-decoration-none mx-1" title="telegram">
                               <i class="bi bi-telegram fs-4"></i>
                           </a>
                        @endif
                   </div>
               </div>
            </div>
            <div class="col-12 col-md-12 col-lg-9">
                <div class="ps-0 ps-lg-5 text-lg-start">
                    <h2 class="my-2 my-md-2 text-center text-lg-start">{{$actor['name']}}</h2>
                    <div class="text-white-50 mb-1 mb-md-5 d-flex align-items-center justify-content-center justify-content-lg-start">
                        <span class="text-center text-lg-start ">
                            🎂 {{$actor['birthday']}} ({{$actor['age']}} years old) in {{$actor['place_of_birth']}}
                        </span>
                    </div>
                    <p class="mb-3 mb-md-5 text-center text-lg-start " style="line-height: 1.5">
                        {{$actor['biography']}}
                    </p>
                    <div class="know-for-people mb-3">
                        <h5 class="mb-3">Known For </h5>
                        <div class="row row-cols-3 row-cols-md-4 row-cols-lg-5 g-1 flex-nowrap overflow-auto custom-scroll-bar">
                            @foreach($knownForMovies as $movie)
                            <div class="col mb-2 text-center">
                                <a href="{{$movie['linkToPage']}}">
                                    <img src="{{$movie['poster_path']}}" alt="" class="w-100" style="max-height: 271px;object-fit: cover">
                                </a>
                                <a href="{{route('movie.show',$movie['id'])}}" class="text-decoration-none">
                                     <span class="text-white-50 fs-6 fw-light px-1 text-truncate d-block">
                                    {{$movie['title']}}
                                </span>
                                </a>
                            </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="credits my-5">
                        <h4 class="mb-2">Credits</h4>

                        <ul class="list-group">
                            @foreach($credits as $credit)
                                <a href="{{$credit['linkToPage']}}" class="text-decoration-none">
                                    <li class="text-white-50 list-group-item border-0 bg-dark">{{$credit['release_year']}} &middot <b class="text-white">{{$credit['title']}}</b> as <i> {{$credit['character']}}</i>  </li>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>

            </div>
        </div>
        <hr class="fw-light text-black-50">

    </div>
@endsection
@push('scripts')

@endpush
