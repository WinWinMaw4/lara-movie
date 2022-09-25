<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class SeeAllViewModel extends ViewModel
{
    public $genres;
    public $section;
    public $seeAllMovies;

    public function __construct($seeAllMovies, $genres,$section)
    {
        //
        $this->genres = $genres;
        $this->section = $section;
        $this->seeAllMovies = $seeAllMovies;
    }
    public function seeAllMovies(){
        return $this->formatMovies($this->seeAllMovies);
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
                'poster_path'=>$movie['poster_path']
                    ? 'https://image.tmdb.org/t/p/w500/'.$movie['poster_path']
                    : 'https://via.placeholder.com/500x600',
                'vote_average'=>$movie['vote_average'] * 10 .'%',
                'release_date'=>Carbon::parse($movie['release_date'])->format('M d,Y'),
                'genres'=>$genresFormatted,
            ])->only([
                'poster_path', 'id', 'original_title', 'title', 'overview', 'release_date', 'vote_average', 'vote_count', 'genres','popularity'
            ]);


        });
    }


}
