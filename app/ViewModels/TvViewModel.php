<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvViewModel extends ViewModel
{
    public $popularTvShow;
    public $airingToday;
    public $topRateTvShow;
    public $genres;

    public function __construct($popularTvShow,$airingToday,$topRateTvShow,$genres)
    {
        //
        $this->popularTvShow = $popularTvShow;
        $this->airingToday = $airingToday;
        $this->topRateTvShow = $topRateTvShow;
        $this->genres = $genres;
    }


    public function popularTvShow(){
        return $this->formatTV($this->popularTvShow);
    }
    public function airingToday(){
        return $this->formatTV($this->airingToday);
    }

    public function topRateTvShow(){
        return $this->formatTV($this->topRateTvShow);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }
//
//
    private function formatTV($tv){
        return collect($tv)->map(function ($tvshow){

            if(isset($tvshow['genre_ids'])){
                $genresFormatted = collect($tvshow['genre_ids'])->mapWithKeys(function ($value){
                    return [$value=>$this->genres()->get($value)];
                })->implode(', ');

            }


            return collect($tvshow)->merge([
                'poster_path'=>$tvshow['poster_path'] ? 'https://image.tmdb.org/t/p/w500/'.$tvshow['poster_path'] : 'https://via.placeholder.com/500x600',
                'vote_average'=>$tvshow['vote_average'] * 10 .'%',
                'first_air_date'=>Carbon::parse($tvshow['first_air_date'])->format('M d,Y'),
                'genres'=>$genresFormatted,
            ])->only([
                'poster_path','genre_ids', 'id', 'original_name', 'name', 'overview', 'first_air_date', 'vote_average', 'vote_count', 'genres'
            ]);
        });
    }

}
