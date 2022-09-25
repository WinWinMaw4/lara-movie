<div class="col overflow-hidden" >
    <a href="{{route('movie.show',str()->slug($movie['id']))}}" class="text-decoration-none">
        <div class="card nowPlaying-card w-100 bg-transparent position-relative overflow-hidden border-0">
            <div class="card-img w-100" style="max-height: 342px">
                <img src="{{$movie['poster_path']}}" alt="" class="w-100 h-100" style="object-fit: cover">
            </div>
            <div class="card-body position-relative p-0 p-md-2 p-lg-3 ">
                <div class="card-text pb-2">
                    <span class="fs-5 text-truncate d-block movie-title">{{$movie['title']}}</span>

                    <span class="fs-6 text-white d-none  d-md-flex align-items-center justify-content-start ">
                        <span class="progress position-relative d-flex me-2" style="width: 8px;height: 30px;background-color: #6b7280">
                            <div class="value position-absolute bottom-0 w-100 " style="background-image: linear-gradient(to top,yellow {{$movie['vote_average']}},transparent 0%);height: 100%"></div>
                        </span>
                        <span class="text-white-50 me-2">{{$movie['vote_average']}} | {{$movie['release_date']}}</span>
                    </span>

                    <span class="fs-6 text-white-50 d-none d-md-block my-1">
{{--                    @foreach($movie['genre_ids'] as $genre){{$genres->get($genre)}}@if(!$loop->last), @endif@endforeach--}}

                        {{$movie['genres']}}
                    </span>

                </div>
            </div>
        </div>
    </a>
</div>
