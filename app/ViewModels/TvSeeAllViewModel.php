<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvSeeAllViewModel extends ViewModel
{
    public $seeAllTv;
    public $genres;
    public $section;

    public function __construct($seeAllTv,$genres,$section)
    {
        //
        $this->seeAllTv = $seeAllTv;
        $this->genres = $genres;
        $this->section = $section;
    }

    public function seeAllTv(){
        return $this->formatTv($this->seeAllTv);
    }
    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatTv($tv){
        return collect($tv)->map(function ($tvShow){

            $genresFormatted = collect($tvShow['genre_ids'])->mapWithKeys(function ($value){
                return [$value=>$this->genres()->get($value)];
            })->implode(', ');

            return collect($tvShow)->merge([
                'poster_path'=>'https://image.tmdb.org/t/p/w300/'.$tvShow['poster_path'],
                'vote_average'=>$tvShow['vote_average'] * 10 .'%',
                'first_air_date'=>Carbon::parse($tvShow['first_air_date'])->format('M d,Y'),
                'genres'=>$genresFormatted,
            ])->only([
                'poster_path', 'id', 'original_name', 'name', 'overview', 'first_air_date', 'vote_average', 'vote_count', 'genres','popularity'
            ]);


        });
    }
}
