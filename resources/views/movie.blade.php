<x-html-layout>
    <x-slot name="page_title">
        {{$movie->title ?? 'Netflix'}}
    </x-slot>

    <x-slot name="page_content">

    <!-- Header movie -->
    <x-header-movie>
		<x-slot name="movie_title">
			{{$movie->title ?? ''}}
		</x-slot>

		<x-slot name="movie_description">
			{{$movie->overview ?? ''}}
		</x-slot>

        <x-slot name="movie_image">
            <img src="{{$backdrop_path}}" alt="" class="img-fluid">
        </x-slot>

		<x-slot name="movie_genres">
			@foreach ($movie->getGenres as $i=>$genre)
				@if ($i == 0)
					<a href="#">{{$genre->genre}}</a>
				@elseif ($i > 2)
					@break
				@else
					- <a href="#">{{$genre->genre}}</a>
				@endif
			@endforeach
		</x-slot>

		<x-slot name="movie_tags">
			@foreach ($movie->getKeywords as $i=>$keyword)
				@if ($i == 0)
					<a href="#">{{$keyword->keyword}}</a>
				@elseif ($i > 2)
					@break
				@else
					- <a href="#">{{$keyword->keyword}}</a>
				@endif
			@endforeach
		</x-slot>

		{{-- <x-slot name="movie_cast">
			actor, actress
		</x-slot> --}}

		<x-slot name="movie_year">
			{{$movie->release_date}}
		</x-slot>
	</x-header-movie>

    <!-- Recommendations -->
    <div class="container p-5 recommendations">
        <div class="row">
            <div class="col-12">
                <h2 class="you-d-like">Other users also liked...</h2>
            </div>
        </div>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>
        
        <!-- Movie recommended -->  
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <!-- Movie recommended -->
        <x-movie-recommended>
            <x-slot name="index">
                1.
            </x-slot>

            <x-slot name="img_path">
                http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
            </x-slot>

            <x-slot name="movie_title">
                Movie title
            </x-slot>

            <x-slot name="movie_description">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas aperiam, consectetur laborum autem deserunt, minima dolores est repellat magnam laudantium amet, nam fugit eius odit rerum corrupti id officia facilis.
            </x-slot>

            <x-slot name="movie_genres">
                genre, genre
            </x-slot>
    
            <x-slot name="movie_tags">
                tag, tag
            </x-slot>
    
            <x-slot name="movie_cast">
                actor, actress
            </x-slot>
    
            <x-slot name="movie_year">
                2019
            </x-slot>
    
            <x-slot name="headermovie_calltoaction">
                <a href="/movie"><button type="button" class="btn">Info e consigli</button></a>
            </x-slot>
        </x-movie-recommended>

        <a href="#" class="text-center" id="loadMore">Load more</a>
    </div>
</x-slot>
</x-html-layout>