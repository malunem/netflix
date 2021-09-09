<div class="row p-5 recommendations-content d-none">
    <div class="col-12 col-md-6 d-flex justify-content-center align-item-center">
        <span class="recommendations-index">{{$index}}</span>
        <img src="{{$img_path}}" alt="copertina film">
    </div>
    <div class="col-12 col-md-6">
        <h1>{{$movie_title}}</h1>
        <p class="movie-description">{{$movie_description}}</p>
        <p><strong>Genres: </strong>{{$movie_genres}}</p>
        <p><strong>Tags: </strong>{{$movie_tags}}</p>
        <p><strong>Cast: </strong>{{$movie_cast}}</p>
        <p><strong>Year: </strong>{{$movie_year}}</p>
    </div>
</div>