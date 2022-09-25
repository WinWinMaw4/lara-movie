<?php

namespace App\Http\Controllers;

use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class testController extends Controller
{
    public function index(){
        $popularTvShow= Http::get('https://api.themoviedb.org/3/tv/popular?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $airingToday = Http::get('https://api.themoviedb.org/3/tv/airing_today?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $topRateTvShow = Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['genres'];
//        $genres = collect($genresArray)->mapWithKeys(function ($genre){
//            return [$genre['id']=>$genre['name']];
//        });

        $viewModel = new TvViewModel(
            $popularTvShow,$airingToday,$topRateTvShow,$genres
        );
        return view('tv.index',$viewModel);


//        return view('tv.index',[
//            'popularTvShow'=> $popularTvShow,
//           'airingToday'=>$airingToday,
//            'topRateTvShow'=>$topRateTvShow,
//            'genres'=>$genres
//
//        ]);
    }

    public function show($id){
        $tvshow = Http::get('https://api.themoviedb.org/3/tv/'.$id.'?api_key=81db1dc62395c3245a614c4ac5e8284e&append_to_response=credits,videos,images')->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show',$viewModel);
    }
}
