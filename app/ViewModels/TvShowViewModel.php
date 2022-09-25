<?php

namespace App\ViewModels;

use Carbon\Carbon;
use Spatie\ViewModels\ViewModel;

class TvShowViewModel extends ViewModel
{
    public $tvshow;
    public function __construct($tvshow)
    {
        //
        $this->tvshow = $tvshow;
    }
    public function tvshow(){
        return collect($this->tvshow)->merge([
            'poster_path'=>$this->tvshow['poster_path']
                ? 'https://image.tmdb.org/t/p/w500/'.$this->tvshow['poster_path']
                : 'https://via.placeholder.com/500x600',
            'vote_average'=>$this->tvshow['vote_average'] * 10 .'%',
            'first_air_date'=>Carbon::parse($this->tvshow['first_air_date'])->format('M d,Y'),
            'last_air_date'=>Carbon::parse($this->tvshow['last_air_date'])->format('M d,Y'),
            'seasons'=>collect($this->tvshow['seasons'])->map(function ($season){
               return collect($season)->merge([
                   'air_date'=>Carbon::parse($season['air_date'])->format('M d,Y'),
                   'air_date_year'=> Carbon::parse($season['air_date'])->format('Y'),
                   'poster_path'=>$season['poster_path']
                       ? 'https://image.tmdb.org/t/p/w185/'.$season['poster_path']
                       : 'https://via.placeholder.com/185x230',
//                       : 'https://ui-avatars.com/api/size=185&name='.$season['name'],
               ]);
            }),

            'genres'=>collect($this->tvshow['genres'])->pluck('name')->flatten()->implode(', '),
            'crew'=>collect($this->tvshow['credits']['crew'])->take(2),
            'cast'=>collect($this->tvshow['credits']['cast'])->take(10)->map(function ($cast){
                return collect($cast)->merge([
                    'profile_path'=>$cast['profile_path']
                        ? 'https://image.tmdb.org/t/p/w235_and_h235_face'.$cast['profile_path']
                        : 'https://ui-avatars.com/api/size=235&name='.$cast['name'],
                ]);
            }),
            'images'=>collect($this->tvshow['images']['backdrops'])->take(12),
        ]);
//->only([
//            'poster_path', 'id', 'original_name','name', 'overview', 'first_air_date', 'last_air_date', 'vote_average', 'vote_count', 'genres',
//            'credits', 'videos', 'images', 'crew', 'cast','created_by','seasons','number_of_seasons','number_of_episodes','status','original_language'
//        ])
    }
}
