<?php

namespace App\Http\Controllers;

use App\ViewModels\MoviesViewModel;
use App\ViewModels\MovieViewModel;
use App\ViewModels\SeeAllViewModel;
use App\ViewModels\TvSeeAllViewModel;
use App\ViewModels\TvShowViewModel;
use App\ViewModels\TvViewModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public  function seeAll($section , $page=1){
        abort_if($page > 500,204);
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['genres'];

        if($section == 'popular tv'){
            $seeAllTv = Http::get('https://api.themoviedb.org/3/tv/popular?api_key=81db1dc62395c3245a614c4ac5e8284e&page='.$page)->json()['results'];
        }elseif ($section == 'airing today'){
            $seeAllTv = Http::get('https://api.themoviedb.org/3/tv/airing_today?api_key=81db1dc62395c3245a614c4ac5e8284e&page='.$page)->json()['results'];
        }elseif($section == 'top rate show'){
            $seeAllTv = Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key=81db1dc62395c3245a614c4ac5e8284e&page='.$page)->json()['results'];
        }else{
            $seeAllTv = null;
        }
        $viewModel = new TvSeeAllViewModel(
            $seeAllTv,$genres,$section
        );
        return view('tv.see-all',$viewModel);
    }
    public function index()
    {
        $popularTvShow = Http::get('https://api.themoviedb.org/3/tv/popular?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $airingToday = Http::get('https://api.themoviedb.org/3/tv/airing_today?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $topRateTvShow = Http::get('https://api.themoviedb.org/3/tv/top_rated?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['results'];
        $genres = Http::get('https://api.themoviedb.org/3/genre/movie/list?api_key=81db1dc62395c3245a614c4ac5e8284e')->json()['genres'];
//        $genres = collect($genresArray)->mapWithKeys(function ($genre){
//            return [$genre['id']=>$genre['name']];
//        });

        $viewModel = new TvViewModel(
            $popularTvShow, $airingToday, $topRateTvShow, $genres
        );
        return view('tv.index', $viewModel);


//        return view('tv.index',[
//            'popularTvShow'=> $popularTvShow,
//           'airingToday'=>$airingToday,
//            'topRateTvShow'=>$topRateTvShow,
//            'genres'=>$genres
//
//        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $tvshow = Http::get('https://api.themoviedb.org/3/tv/'.$id.'?api_key=81db1dc62395c3245a614c4ac5e8284e&append_to_response=credits,videos,images')->json();

        $viewModel = new TvShowViewModel($tvshow);

        return view('tv.show',$viewModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
