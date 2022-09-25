<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SeasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($tvid)
    {
        $tvshow = Http::get('https://api.themoviedb.org/3/tv/'.$tvid.'?api_key=81db1dc62395c3245a614c4ac5e8284e&append_to_response=credits,videos,images')->json();
        $tvshow = collect($tvshow)->merge([
            'first_air_date'=>Carbon::parse($tvshow['first_air_date'])->format('M d,Y'),
//
            'first_air_year'=> Carbon::parse($tvshow['first_air_date'])->format('Y'),
            'poster_path'=>$tvshow['poster_path']
                ? 'https://image.tmdb.org/t/p/w185/'.$tvshow['poster_path']
                : 'https://via.placeholder.com/185x230',
            'seasons'=>collect($tvshow['seasons'])->map(function ($season){
                return collect($season)->merge([
                    'poster_path'=>$season['poster_path']
                        ? 'https://image.tmdb.org/t/p/w185/'.$season['poster_path']
                        : 'https://via.placeholder.com/185x230',
                    'air_date'=> Carbon::parse($season['air_date'])->format('M d,Y')
                ]);

            })

        ]);

        return view('tv.season',[
            'tvshow'=>$tvshow,
        ]);
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
    public function show($tvid,$season_number)
    {
        $tvshow = Http::get('https://api.themoviedb.org/3/tv/'.$tvid.'?api_key=81db1dc62395c3245a614c4ac5e8284e&append_to_response=credits,videos,images')->json();
        $seasonEp = Http::get('https://api.themoviedb.org/3/tv/'.$tvid.'/season/'.$season_number.'?api_key=81db1dc62395c3245a614c4ac5e8284e')->json();
        $seasonEp = collect($seasonEp)->merge([
            'tvshow_name'=> $tvshow['name'],
            'show_id'=> $tvshow['id'],
            'air_date'=>Carbon::parse($seasonEp['air_date'])->format('M d,Y'),

            'air_year'=> Carbon::parse($seasonEp['air_date'])->format('Y'),
            'poster_path'=>$seasonEp['poster_path']
                ? 'https://image.tmdb.org/t/p/w185/'.$seasonEp['poster_path']
                : 'https://via.placeholder.com/185',
            'episodes'=>collect($seasonEp['episodes'])->map(function ($episode){
                return collect($episode)->merge([
                    'still_path'=>$episode['still_path']
                        ? 'https://image.tmdb.org/t/p/w300/'.$episode['still_path']
                        : 'https://via.placeholder.com/185',
                    'air_date'=>Carbon::parse($episode['air_date'])->format('M d,Y'),

                ]);

            })

        ]);
        return view('tv.season-detail',[
            'seasonEp'=>$seasonEp,
        ]);
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
