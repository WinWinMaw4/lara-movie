<?php

namespace App\ViewModels;


use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies,$nowPlayingMovies,$genres;
    public $topRateMovies;

    public function __construct($popularMovies, $nowPlayingMovies, $genres,$topRateMovies)
    {
        $this->popularMovies = $popularMovies;
        $this->genres = $genres;
        $this->nowPlayingMovies = $nowPlayingMovies;
        $this->topRateMovies = $topRateMovies;
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);

    }
    public function nowPlayingMovies(){
       return $this->formatMovies($this->nowPlayingMovies);
    }
    public function topRateMovies(){
        return $this->formatMovies($this->topRateMovies);

    }
    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }


    private function formatMovies($movies){
            return collect($movies)->map(function ($movie){

                $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value){
                    return [$value=>$this->genres()->get($value)];
                })->implode(', ');

            return collect($movie)->merge([
                'poster_path'=>'https://image.tmdb.org/t/p/w500/'.$movie['poster_path'],
                'vote_average'=>$movie['vote_average'] * 10 .'%',
                'release_date'=>Carbon::parse($movie['release_date'])->format('M d,Y'),
                'genres'=>$genresFormatted,
            ])->only([
                'poster_path', 'id', 'original_title', 'title', 'overview', 'release_date', 'vote_average', 'vote_count', 'genres'
            ]);
        });
    }
}
