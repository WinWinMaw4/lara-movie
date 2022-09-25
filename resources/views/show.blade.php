@extends('layouts.master')
@section('title') movie app @endsection
@section('content')
    <div class="movie-show container">
{{--        movie detail--}}
        <div class="row my-3 ">
            <div class="col-12 col-md-4 col-lg-4 d-flex align-items-start justify-content-center">
               <div class="w-100 rounded overflow-hidden movie-show-img-div">
                   <img src="{{$movie['poster_path']}}" alt="" class="" style="width: 100%;height: 100%;object-fit: cover">
               </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="ps-0 ps-md-3 ps-lg-5 text-center text-md-start">
                    <h2 class="my-2 my-md-2">{{$movie['original_title']}}</h2>
                    <div class="text-white-50 mb-1 mb-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                        <span class="d-flex align-items-center justify-content-start">
                             <span class="progress position-relative d-flex me-2 border" style="width: 8px;height: 30px;background-color: #6b7280">
                                <div class="value position-absolute bottom-0 w-100 " style="background-image: linear-gradient(to top,yellow {{$movie['vote_average']}},transparent 0%);height: 100%"></div>
                            </span>
                            {{$movie['vote_average']}}
                        </span>
                        <span class="text-black-50 mx-2">|</span>
                        <span>{{$movie['release_date']}}</span>
                        <span class="text-black-50 mx-2 d-none d-md-flex">|</span>
                        <span class="d-none d-md-flex">
{{--                            @foreach($movie['genres'] as $genre)--}}
{{--                                {{$genre['name']}}@if(!$loop->last), @endif--}}
{{--                            @endforeach--}}
                            {{$movie['genres']}}
                        </span>
                    </div>
                    <span class="text-white-50 d-block d-md-none mb-3">
                        {{$movie['genres']}}
                    </span>
                    <p class="mb-3 mb-md-5">
                        {{$movie['overview']}}
                    </p>

                    <div class="mb-3 mb-md-5">
                        <h5 class="mt-5 my-md-3">Feature Crew</h5>
                        <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start mb-5">
                            @foreach($movie['crew'] as $crew)
                                <span class="mx-3 mx-md-0 me-md-5">
                                    {{$crew['name']}}<br>
                                    <span class="text-white-50 fw-light">{{$crew['job']}}</span>
                                </span>
                            @endforeach
                        </div>

                        @if(count($movie['videos']['results']) > 0)
                            <div class="mb-5">
{{--                                href="https://youtube.com/watch?v={{$movie['videos']['results'][0]['key']}}"--}}
                                <button  class="btn btn-primary btn-lg fw-bold" data-bs-toggle="modal" data-bs-target="#playTrailer">
                                    <i class="bi bi-play-circle"></i>
                                     Play Trailer️
                                </button>
                            </div>
                        @endif
                    </div>

                </div>

            </div>
        </div>
            <hr class="my-1 my-md-5 text-white-50">
{{--        movie cast--}}
        <div class="row my-3">
            <div class="col-12">
                <h3 class="my-3 text-uppercase">Cast</h3>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row row-cols-3 row-cols-md-4 row-cols-lg-5 g-1 g-sm-2 g-lg-2 g-xl-3 flex-nowrap overflow-auto">
                    @foreach($movie['cast'] as $cast)
                        <div class="col mb-3">
                            <div>
                                <a class="w-100">
{{--                                    'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']--}}
                                    @isset($cast['profile_path'])
                                        <a href="{{route('actor.show',$cast['id'])}}" class="text-decoration-none">
                                            <img src="{{"https://image.tmdb.org/t/p/w300/".$cast['profile_path']}}" alt="" class="img-fluid">
                                        </a>
                                    @else
                                        <img src="{{'https://ui-avatars.com/api/?size=300&name='.$cast['name']}}" alt="" class="img-fluid">
                                    @endisset
                                </a>
                                <div>
                                    <a href="{{route('actor.show',$cast['id'])}}" class="d-flex flex-column  text-white text-decoration-none ">
                                        <span class="fs-5 cast-name">{{$cast['name']}}</span>
                                        <span class="fs-6 cast-character">{{$cast['character']}}</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="my-1 my-md-5 text-white-50">
{{--        images--}}
        <div class="row my-3">
            <div class="col-12">
                <h3 class="my-3 text-uppercase">Images</h3>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row row-cols-3 row-cols-md-3 row-cols-lg-4 g-1 g-md-3">
                    @foreach($movie['images'] as $image)
                        <div class="col">
                            <div class="w-100">
                                <a href="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" class="venobox" data-title="{{$movie['title']}}" data-maxwidth="800px" data-gall="imgGall{{$movie['id']}}">
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>




{{--    --}}
    <!-- Modal -->
    @if(count($movie['videos']['results']) > 0)

    <div class="modal fade " id="playTrailer" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-dark">
                <div class="modal-body">
                    <button type="button" class="btn-close d-flex ms-auto mb-2" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1)">
                    </button>
                    <div class="ratio ratio-16x9">
{{--                        {{$movie['videos']['results'][0]['key']}}--}}
                        <iframe src="https://youtube.com/embed/{{$movie['videos']['results'][0]['key']}}" title="YouTube video" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
@endsection
@push('scripts')

    <script>


    </script>
@endpush
