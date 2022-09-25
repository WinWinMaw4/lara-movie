<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;
    public function __construct($movie)
    {
        //
        $this->movie = $movie;
    }

    public function movie(){
        return collect($this->movie)->merge([
            'poster_path'=>$this->movie['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->movie['poster_path']
                : 'https://via.placeholder.com/500x600',
            'vote_average'=>$this->movie['vote_average'] * 10 .'%',
            'release_date'=>Carbon::parse($this->movie['release_date'])->format('M d,Y'),
            'genres'=>collect($this->movie['genres'])->pluck('name')->flatten()->implode(', '),
            'crew'=>collect($this->movie['credits']['crew'])->take(2),
            'cast'=>collect($this->movie['credits']['cast']),
            'images'=>collect($this->movie['images']['backdrops'])->take(12),
        ])->only([
            'poster_path', 'id', 'original_title', 'title', 'overview', 'release_date', 'vote_average', 'vote_count', 'genres',
            'credits', 'videos', 'images', 'crew', 'cast'
        ]);
    }
}
