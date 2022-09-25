<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class ActorViewModel extends ViewModel
{
    public $actor;
    public $social;
    public $credits;

    public function __construct($actor,$social,$credits)
    {
        //
        $this->actor = $actor;
        $this->social = $social;
        $this->credits = $credits;
    }
    public function actor(){
        return collect($this->actor)->merge([
            'profile_path'=>$this->actor['profile_path']
            ?'https://image.tmdb.org/t/p/w500'.$this->actor['profile_path']
            :'https://via.placeholder.com/300x450?text='.$this->actor['name'],
            'birthday'=>Carbon::parse($this->actor['birthday'])->format('M d,Y'),
            'age'=>Carbon::parse($this->actor['birthday'])->age,
        ]);
    }

    public function social(){
        return collect($this->social)->merge([
//            'homepage'=>$this->social['home_page'] ? $this->social['home_page'] : null,
            'facebook'=>$this->social['facebook_id'] ? 'https://facebook.com/'.$this->social['facebook_id'] : null,
            'instagram'=>$this->social['instagram_id'] ? 'https://instagram.com/'.$this->social['instagram_id'] : null,
            'twitter'=>$this->social['twitter_id'] ? 'https://twitter.com/'.$this->social['twitter_id'] : null,

        ]);
    }
    public function knownForMovies(){
        $castMovies = collect($this->credits)->get('cast');
        return collect($castMovies)->sortByDesc('popularity')->map(function ($movie){

                if(isset($movie['title'])){
                    $title = $movie['title'];
                }elseif(isset($movie['name'])){
                    $title = $movie['name'];
                }else{
                    $title = 'Untitled';
                }
                return collect($movie)->merge([
                    'poster_path'=>$movie['poster_path']
                        ?'https://image.tmdb.org/t/p/w185/'.$movie['poster_path']
                        :'https://via.placeholder.com/185x278?text='.$title,
                    'title'=>$title,
                    'linkToPage'=> $movie['media_type'] === 'movie' ? route('movie.show',$movie['id']) : route('tv.show',$movie['id']),
                ])->only([
                    'poster_path','id','title','media_type','linkToPage'
                ]);
            });
    }

    public function credits(){
        $castMovies = collect($this->credits)->get('cast');
        return collect($castMovies)->map(function ($movie){
                if(isset($movie['release_date'])){
                    $releaseDate =  $movie['release_date'];
                }elseif (isset($movie['first_air_date'])){
                    $releaseDate =  $movie['first_air_date'];
                }else{
                    $releaseDate = '';
                }

            if(isset($movie['title'])){
                $title =  $movie['title'];
            }elseif (isset($movie['name'])){
                $title =  $movie['name'];
            }else{
                $title = 'Untitled';
            }



            return collect($movie)->merge([
                    'release_date'=>$releaseDate,
                    'release_year'=>isset($releaseDate) ? Carbon::parse($releaseDate)->format('Y') : 'Future',
                    'title'=>$title,
                    'characters'=>$movie['character'] ? $movie['character'] : '',
                    'linkToPage'=> $movie['media_type'] === 'movie' ? route('movie.show',$movie['id']) : route('tv.show',$movie['id']),

                ]);
            })->sortByDesc('release_date');
    }
}
