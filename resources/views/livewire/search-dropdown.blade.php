<div class="position-relative" x-data="{isOpen:true}" @click.away="isOpen = false">
       <div class="position-relative">
           <input type="text"
                  wire:model.debounce.500ms="search"
                  @focus = "isOpen = true"
                  @keydown="isOpen = true"
                  @keydown.escape.window = "isOpen = false"
                  @keydown.shift.tab = "isOpen = false"

                  placeholder="search"
                  class="form-control search-input border-0 text-light w-100"
                  style="background-color: rgba(255,255,255,0.07)">
           <div wire:loading class="position-absolute" style="bottom: 25%;right:3%;">
               <span  class="spinner-border spinner-border-sm text-white-50 " ></span>
           </div>
           <i wire:loading.remove class="bi bi-search text-white-50 position-absolute" style="bottom: 25%;right:3%;"></i>

       </div>
        @if(strlen($search >= 2))
            <div
                class="position-absolute mt-2 w-100"
                x-show.transition.opacity="isOpen"

                style="z-index: 100;" >
            @if(count($searchResults) > 0)

                <div class="list-group" style="background-color: #313438">
                    @foreach($searchResults as $result)
                        @if($result['media_type'] == 'movie')
                            <a
                                href="{{route('movie.show',$result['id'])}}"
                                @if($loop->last) @keydown.tab = "isOpen = false" @endif
                                class="list-group-item list-group-item-action bg-transparent text-light ps-1 d-flex align-items-start"
                                style="background-color: #313438" aria-current="true"
                            >
                                @if($result['poster_path'])
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$result['poster_path']}}" alt="poster" width="40" height="auto" style="object-fit: contain">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" width="40" height="auto" style="object-fit: contain">
                                @endif
                                <span class="fs-6 ms-2">{{$result['title']}}</span>
                                <span class="text-white-50 "> - Movie</span>
                            </a>
                        @elseif($result['media_type'] == 'tv')
                            <a
                                href="{{route('tv.show',$result['id'])}}"
                                @if($loop->last) @keydown.tab = "isOpen = false" @endif
                                class="list-group-item list-group-item-action bg-transparent text-light ps-1 d-flex align-items-start"
                                style="background-color: #313438" aria-current="true"
                            >
                                @if($result['poster_path'])
                                    <img src="{{'https://image.tmdb.org/t/p/w500/'.$result['poster_path']}}" alt="poster" width="40" height="auto" style="object-fit: contain">
                                @else
                                    <img src="https://via.placeholder.com/50x75" alt="poster" width="40" height="auto" style="object-fit: contain">
                                @endif
                                <span class="fs-6 ms-2">{{$result['name']}}</span>
                                <span class="text-white-50"> - TV Show</span>
                            </a>
                        @endif
                    @endforeach
                </div>
            @else
                <div class="list-group" style="background-color: #313438">
                    <span  class="list-group-item list-group-item-action bg-transparent text-light ps-1 d-flex align-items-start" style="background-color: #313438" aria-current="true">
                        <span class="fs-6 ms-2 fw-light">No Result for "<span class="fw-bold">{{$search}}</span>"</span>
                    </span>
                </div>
            @endif
        </div>
        @endif
</div>
