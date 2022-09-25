<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Http;
use Livewire\Component;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if(strlen($this->search) >= 1){
            $searchResults = Http::get('https://api.themoviedb.org/3/search/multi?api_key=81db1dc62395c3245a614c4ac5e8284e&query='.$this->search)
                ->json()['results'];
        }

        return view('livewire.search-dropdown',[
            'searchResults'=>collect($searchResults)->take(7),
        ]);
    }
}
