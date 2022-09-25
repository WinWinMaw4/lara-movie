<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use App\ViewModels\SeeAllViewModel;
use Illuminate\Support\Facades\Http;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function fetch(){
        $response = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=81db1dc62395c3245a614c4ac5e8284e');
        $popularMovies = json_decode($response->body());
        dump($popularMovies);
//        foreach($popularMovies as $quiz){
//            $question = new PopularMovies();
//            $question->question = $quiz->question;
//            $question->answer_a = $quiz->answers->answer_a;
//            $question->answer_b = $quiz->answers->answer_b;
//            $question->answer_c = $quiz->answers->answer_c;
//            $question->answer_d = $quiz->answers->answer_d;
//            $question->save();
//        }
//        return "DONE";
    }
    public function seeAll($section,$page = 1){
//        return $section;
        abort_if($page > 500,204);
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['genres'];

        if($section == 'popular movies'){
            $seeAllMovies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=81db1dc62395c3245a614c4ac5e8284e&page='.$page)->json()['results'];
        }elseif ($section == 'now playing movies'){
            $seeAllMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key=81db1dc62395c3245a614c4ac5e8284e&page='.$page)->json()['results'];
        }elseif($section == 'top rate movies'){
            $seeAllMovies = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key=81db1dc62395c3245a614c4ac5e8284e&page='.$page)->json()['results'];
        }else{
            $seeAllMovies = null;
        }
        $viewModel = new SeeAllViewModel(
            $seeAllMovies,$genres,$section
        );
        return view('see-all',$viewModel);
    }
    public function index()
    {
        $popularMovies = Http::get('https://api.themoviedb.org/3/movie/popular?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $nowPlayingMovies = Http::get('https://api.themoviedb.org/3/movie/now_playing?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['genres'];
        $topRateMovies = Http::get('https://api.themoviedb.org/3/movie/top_rated?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];

//        $genres = collect($genreArray)->mapWithKeys(function ($genre){
//            return [$genre['id']=>$genre['name']];
//        });
//        return view('index',[
//            'popularMovies'=>$popularMovies,
//            'nowPlayingMovies' => $nowPlayingMovies,
//            'genres'=>$genres
//        ]);

        $viewModel = new MoviesViewModel(
           $popularMovies,$nowPlayingMovies,$genres,$topRateMovies
        );
        return view('index',$viewModel);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show($movie_id)
    {
        $movie = Http::get('https://api.themoviedb.org/3/movie/'.$movie_id.'?api_key=81db1dc62395c3245a614c4ac5e8284e&append_to_response=credits,videos,images')->json();

        $viewModel = new MovieViewModel($movie);

        return view('show',$viewModel);

//            return view('show',[
//                'movie'=>$movie,
//            ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        //
    }
}
