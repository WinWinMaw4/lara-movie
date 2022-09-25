<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title',config('app.name', 'Laravel'))</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css" integrity="sha512-wR4oNhLBHf7smjy0K4oqzdWumd+r5/+6QO/vDda76MW5iug4PT7v86FoEkySIJft3XA0Ae6axhIvHrqwm793Nw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css" integrity="sha512-6lLUdeQ5uheMFbWm3CP271l14RsX1xtx+J5x2yeIDkkiBpeVTNhTqijME7GgRKKi6hCqovwCoBTlRBEC20M8Mg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
{{--    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>--}}

    @yield('style')

    @livewireStyles
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
{{--    <script  src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>--}}

</head>
<body>
    <nav class="d-flex align-items-center py-1 py-md-2 ps-2 pe-0 pe-md-0 px-lg-5 shadow-lg" >
       <div class="d-flex align-items-center ">
           <a href="{{route('movie.index')}}" class="text-decoration-none fs-3 fw-bold">
               <i class="bi bi-film"></i> <span class="d-none d-lg-inline-flex">MovieApp</span>
           </a>
           <ul class="list-group list-group-horizontal list-unstyled px-5 d-none d-lg-inline-flex">
               <a href="{{route('movie.index')}}" class="text-decoration-none text-light {{request()->routeIs('movie.index') ? 'active':''}}"><li class="mx-3">Movie</li></a>
               <a href="{{route('tv.index')}}" class="text-decoration-none text-light "><li class="mx-3">TV Shows</li></a>
               <a href="{{route('actor.index')}}" class="text-decoration-none text-light"><li class="mx-3">Actors</li></a>
           </ul>
       </div>
        <div class="mx-auto mx-lg-0 ms-lg-auto w-25 search-div ">
            <livewire:search-dropdown></livewire:search-dropdown>
        </div>
        <div class="d-inline-flex d-lg-none p-2 ">
            <i class="bi bi-list fs-1"></i>

        </div>
{{--        <a href="#" class="" >--}}
{{--            <img src="" alt="" class="profile img-fluid rounded-circle bg-light border border-2 border-primary" style="width: 60px;height: 60px;"  alt="img">--}}
{{--        </a>--}}
    </nav>

    @yield('content')


{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js" integrity="sha512-XtmMtDEcNz2j7ekrtHvOVR4iwwaD6o/FUJe6+Zq+HgcCsk3kj4uSQQR8weQ2QVj1o0Pk6PwYLohm206ZzNfubg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

    @stack('scripts')

    @livewireScripts
</body>
</html>
