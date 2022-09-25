<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
</head>
<body>
<nav class="d-flex align-items-center py-2 px-5 shadow-lg" >
    <div class="d-flex align-items-center ">
        <a href="#" class="text-decoration-none fs-3">
            <i class="bi bi-tv">🎬</i>
            MovieApp
        </a>
        <ul class="list-group list-group-horizontal list-unstyled px-5">
            <a href="#" class="text-decoration-none text-light"><li class="mx-3">Movie</li></a>
            <a href="#" class="text-decoration-none text-light"><li class="mx-3">TV Shows</li></a>
            <a href="#" class="text-decoration-none text-light"><li class="mx-3">Actors</li></a>
        </ul>
    </div>
    <form action="" class="mx-auto w-50">
        <input type="text" placeholder="search" class="form-control bg-transparent text-light w-100">
    </form>
    <a href="#" class="" >
        <img src="" alt="" class="profile img-fluid rounded-circle bg-light border border-2 border-primary" style="width: 60px;height: 60px;"  alt="img">
    </a>
</nav>
{{--popular Movie--}}
<div class="container">
    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-2 py-5">
        <div class="col-12 col-lg-12">
            <h4 class="text-primary py-2">Popular Movies</h4>
        </div>
        <div class="col" style="height:400px;">
            <div class="card w-100 h-100">
                <div class="card-img">
                    <img src="" alt="">
                </div>
                <div class="card-body">
                    <div class="card-text">

                    </div>
                </div>
            </div>
        </div>
        <div class="col" style="height:400px;">
            <div class="card w-100 h-100">
                <div class="card-img">
                    <img src="" alt="">
                </div>
                <div class="card-body">
                    <div class="card-text">

                    </div>
                </div>
            </div>
        </div>
        <div class="col" style="height:400px;">
            <div class="card w-100 h-100">
                <div class="card-img">
                    <img src="" alt="">
                </div>
                <div class="card-body">
                    <div class="card-text">

                    </div>
                </div>
            </div>
        </div>
        <div class="col" style="height:400px;">
            <div class="card w-100 h-100">
                <div class="card-img">
                    <img src="" alt="">
                </div>
                <div class="card-body">
                    <div class="card-text">

                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
</body>
</html>
