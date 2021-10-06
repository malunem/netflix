{{-- <div class="row recommendations-content d-none align-items-md-stretch px-5"> --}}
    {{-- <div class="col-12 col-md-6 d-flex justify-content-center align-item-center">
        <span class="recommendations-index">{{$index}}</span>
        <img src="{{$img_path}}" alt="" class="mini-img" style="max-height: 300px">
    </div> --}}
    {{-- <div class="col-12"> 
        <h1>{{$movie_title}}</h1>
        <p class="movie-description">{{$movie_description}}</p>
        <p><strong>Genres: </strong>{{$movie_genres}}</p>
        <p><strong>Tags: </strong>{{$movie_tags}}</p>
        <p><strong>Cast: </strong>{{$movie_cast}}</p>
        <p><strong>Year: </strong>{{$movie_year}}</p>
    </div> --}}
        <div class="col-md-6">
          <div class="h-100 p-5 text-white bg-dark rounded-3">
            <h2 class="bg-dark">
                <span class="recommendations-index">{{$index}}</span>
                {{$movie_title}}
            </h2>
            <p class="bg-dark">{{$movie_description}}</p>
            <p><strong>Genres: </strong>{{$movie_genres}}</p>
            <p><strong>Tags: </strong>{{$movie_tags}}</p>
            {{-- <p><strong>Cast: </strong>{{$movie_cast}}</p> --}}
            <p><strong>Released: </strong>{{$movie_year}}</p>
            <a href="/movie/{{$movie_id}}">
                <button class="btn btn-outline-light" type="button">More info</button>
            </a>
          </div>
        </div>
{{-- </div> --}}