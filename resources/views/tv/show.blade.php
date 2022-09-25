@extends('layouts.master')
@section('title') movie app @endsection
@section('content')
    <div class="tv-show container">
        <div class="row my-3">
            <div class="col-12">
{{--                @php--}}
{{--                    $previous_url = url()->previous();--}}
{{--                    $current_url = \Illuminate\Support\Facades\Route::current()->getName();--}}
{{--                    $previous_route = app('router')->getRoutes($previous_url)->match(app('request')->create($previous_url))->getName();--}}
{{--                @endphp--}}
{{--                <a href="{{route('tv.index')}}"  class="text-decoration-none text-white-50">--}}
{{--                    <i class="bi bi-arrow-left"></i>to index--}}
{{--                    Back {!! URL::previous() !!} <br>{!! Route::current()->getName() !!} <br>--}}
{{--                    <br>--}}
{{--                    previous url => {{$previous_url}}--}}
{{--                    current url => {{$current_url}}--}}
{{--                </a>--}}


            </div>
        </div>
        {{--        tv detail--}}
        <div class="row my-3 ">
            <div class="col-12 col-md-4 col-lg-4 d-flex align-items-start justify-content-center">
                <div class="w-100 rounded overflow-hidden movie-show-img-div">
                    <img src="{{$tvshow['poster_path']}}" alt="" class="" style="width: 100%;height: 100%;object-fit: cover">
                </div>
            </div>
            <div class="col-12 col-md-8 col-lg-8">
                <div class="ps-0 ps-md-3 ps-lg-5 text-center text-md-start">
                    <h2 class="my-2 my-md-2">{{$tvshow['name']}} <span class="fs-6">Season {{$tvshow['number_of_seasons']}}</span></h2>
                    <div class="text-white-50 mb-1 mb-md-5 d-flex align-items-center justify-content-center justify-content-md-start">
                        <span class="d-flex align-items-center justify-content-start">
                             <span class="progress position-relative d-flex me-2 border" style="width: 8px;height: 30px;background-color: #6b7280">
                                <div class="value position-absolute bottom-0 w-100 " style="background-image: linear-gradient(to top,yellow {{$tvshow['vote_average']}},transparent 0%);height: 100%"></div>
                            </span>
                            {{$tvshow['vote_average']}}
                        </span>
                        <span class="text-black-50 mx-2">|</span>
                        <span>{{$tvshow['first_air_date']}}</span>
                        <span class="text-black-50 mx-2 d-none d-md-flex">|</span>
                        <span class="d-none d-md-flex">
{{--                            @foreach($tvshow['genres'] as $genre)--}}
{{--                                                            {{$genre['name']}}@if(!$loop->last), @endif--}}
{{--                                                        @endforeach--}}
                            {{$tvshow['genres']}}
                        </span>
                    </div>
                    <span class="text-white-50 d-block d-md-none mb-3">
                        {{$tvshow['genres']}}
                    </span>
                    <p class="mb-3 mb-md-5">
                        {{$tvshow['overview']}}
                    </p>
{{--play trailer--}}
                    <div class="mb-3 mb-md-5">
                       @if($tvshow['created_by'])
                            <h5 class="mt-5 my-md-3">Creator</h5>
                            <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start mb-5">
                                @foreach($tvshow['created_by'] as $crew)
                                    <span class="mx-3 mx-md-0 me-md-5">
                                    {{$crew['name']}}<br>
{{--                                    <span class="text-white-50 fw-light">{{$crew['job']}}</span>--}}
                                </span>
                                @endforeach
                            </div>
                        @endif
                       @if($tvshow['crew'])
                           <h5 class="mt-5 my-md-3">Feature Crew</h5>
                           <div class="d-flex flex-column flex-md-row align-items-center justify-content-center justify-content-md-start mb-5">
                               @foreach($tvshow['crew'] as $crew)
                                   <span class="mx-3 mx-md-0 me-md-5">
                                {{$crew['name']}}<br>
                                    <span class="text-white-50 fw-light">{{$crew['job']}}</span>
                            </span>
                               @endforeach
                           </div>
                       @endif

                        @if(count($tvshow['videos']['results']) > 0)
                            <div class="mb-5">
{{--                                                                href="https://youtube.com/watch?v={{$tvshow['videos']['results'][0]['key']}}"--}}
                                <button  class="btn btn-primary btn-lg fw-bold" data-bs-toggle="modal" data-bs-target="#playTrailerModal" id="playTrailerModalBtn">
                                    <i class="bi bi-play-circle"></i>
                                    Play Trailer️
                                </button>
                            </div>
                        @endif
                    </div>
{{--                    detail table--}}
                    <div class="mb-3 mb-md-5">
                        <table class="table table-dark table-sm table-hover">
{{--                            <thead>--}}
{{--                            <tr>--}}
{{--                                <th scope="col">Original Name</th>--}}
{{--                                <th scope="col">Status</th>--}}
{{--                                <th scope="col">Last</th>--}}
{{--                                <th scope="col">Handle</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
                            <tbody>
                            <tr>
                                <th scope="row">Original Name</th>
                                <td class="w-75">{{$tvshow['original_name']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">First/latest Date</th>
                                <td class="w-75">{{$tvshow['first_air_date']}} - {{$tvshow['last_air_date']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Total Episodes</th>

                                <td class="w-75">
                                    @foreach($tvshow['seasons'] as $seasons)
                                        @if($seasons['season_number'] == $tvshow['number_of_seasons'])
                                        {{$seasons['episode_count']}}
                                        @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">All Seasons Episodes</th>
                                <td class="w-75">{{$tvshow['number_of_episodes']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Seasons</th>
                                <td class="w-75">
                                    @foreach($tvshow['seasons'] as $seasons)
                                        <a href="{{url('/tv/'.$tvshow['id'].'/season/'.$seasons['season_number'])}}" class="text-decoration-none" >
                                            {{$seasons['name']}}
                                        </a>@if(!$loop->last), @endif
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Status</th>
                                <td>{{$tvshow['status']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Type</th>
                                <td>{{$tvshow['genres']}}</td>
                            </tr>
                            <tr>
                                <th scope="row">Original Language</th>
                                <td colspan="2">{{$tvshow['original_language']}}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>



                </div>

            </div>

        </div>
        <hr class="my-1 my-md-5 text-white-50">
{{--        seasons--}}
        <div class="row my-3">
            <div class="col-12">
                <h3 class="my-3 text-uppercase">Current Seasons</h3>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card  bg-dark shadow">
                    <div class="row g-0">
                        @isset($seasons['season_number'])
                            @if($seasons['season_number'] == $tvshow['number_of_seasons'])
                                <div class="col-1">
                                    <img src="{{$seasons['poster_path']}}" alt="" class="rounded-start img-fluid">
                                </div>
                                <div class="col-10">
                                    <div class="card-body h-100 position-relative ">
                                        {{--                                   <p>{{$tvshow['id']}} {{$seasons['season_number']}}</p>--}}
                                        <h4 class="text-secondary mb-0"><a href="{{url('/tv/'.$tvshow['id'].'/season/'.$seasons['season_number'])}}" class="text-decoration-none" >{{$seasons['name']}}</a></h4>
                                        <span class="fs-6 fw-light">{{$seasons['air_date_year']}}</span> |
                                        <span class="fs-6 fw-light">{{$seasons['episode_count']}} Episode</span>
                                        <div class="py-3 position-absolute bottom-0"> {{$seasons['name']}} of {{$tvshow['name']}} premiered on {{$seasons['air_date']}}</div>
                                    </div>
                                </div>
                            @endif
                        @endisset
                    </div>
                </div>
            </div>
            <div class="col-12">
                <a href="{{route('season.index',$tvshow['id'])}}" class="text-white fs-5 text-decoration-none">View All Seasons</a>
            </div>
        </div>
        <hr class="my-1 my-md-5 text-white-50">
{{-- movie cast--}}
        <div class="row my-3">
            <div class="col-12">
                <h3 class="my-3 text-uppercase">Cast</h3>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row row-cols-3 row-cols-md-4 flex-nowrap overflow-auto row-cols-lg-5 g-1 g-sm-2 g-lg-2 g-xl-3 custom-scroll-bar">
                    @forelse($tvshow['cast'] as $cast)
                        <div class="col">
                            <div class="mb-3">
                                <span class="w-100">
{{--                                 'https://image.tmdb.org/t/p/w300/'.$cast['profile_path']--}}
                                    <a href="{{route('actor.show',$cast['id'])}}" class="text-decoration-none">
                                        <img src="{{$cast['profile_path']}}" alt="" class="img-fluid">
                                    </a>
                                </span>
                                <div>
                                    <a href="{{route('actor.show',$cast['id'])}}" class="d-flex flex-column  text-white text-decoration-none ">
                                        <span class="fs-5 cast-name">{{$cast['name']}}</span>
                                        <span class="fs-6 cast-character">{{$cast['character']}}</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                        @empty
                            <div class="my-3 px-auto">
                                <h6 class="text-white-50">No Content</h6>
                            </div>

                    @endforelse
                </div>
            </div>
        </div>
{{--        movie images--}}
        <div class="my-1 my-md-5 text-white-50">
        {{--        images--}}
        <div class="row my-3">
            <div class="col-12">
                <h3 class="my-3 text-uppercase text-white">Images</h3>
            </div>
            <div class="col-12 col-md-12 col-lg-12">
                <div class="row row-cols-3 row-cols-md-3 row-cols-lg-4 g-1 g-md-3">
                    @forelse($tvshow['images'] as $image)
                        <div class="col">
                            <div class="w-100">
                                <a href="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" class="venobox" data-title="{{$tvshow['name']}}" data-maxwidth="800px" data-gall="imgGall{{$tvshow['id']}}">
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$image['file_path']}}" alt="" class="img-fluid">
                                </a>
                            </div>
                        </div>
                        @empty
                            <div class="my-3 px-auto">
                                <h6 class="text-white-50">No Content</h6>
                            </div>
                    @endforelse
                </div>
            </div>
        </div>

    </div>




    {{--    --}}
    <!-- Modal -->
    @if(count($tvshow['videos']['results']) > 0)

        <div class="modal fade " id="playTrailerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content bg-dark">
                    <div class="modal-body">
                        <button type="button" class="btn-close d-flex ms-auto mb-2" data-bs-dismiss="modal" aria-label="Close" style="filter: invert(1)">
                        </button>
                        <div class="ratio ratio-16x9">
{{--                                                    {{$tvshow['videos']['results'][0]['key']}}--}}
                            <iframe src="https://youtube.com/embed/{{$tvshow['videos']['results'][0]['key']}}" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@push('scripts')

    <script>
{{--      playtrailser video closed When modal box close --}}
        let btnClose = document.querySelector('.btn-close');
        let playTrailerModal = document.getElementById('playTrailerModal');

        btnClose.addEventListener('click',function (){
                let iframe = playTrailerModal.querySelector('iframe');
                let src = iframe.getAttribute('src');
                {{--let src = 'https://youtube.com/embed/{{$tvshow['videos']['results'][0]['key']}}';--}}
                iframe.setAttribute("src", src);
        });

    </script>
@endpush
