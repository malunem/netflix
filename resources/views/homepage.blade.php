<x-html-layout>
	<x-slot name="page_title">Netflix</x-slot>
	<x-slot name="page_content">
	
	<!-- Header movie component details-->
	<x-header-movie>
		<x-slot name="movie_title">
			{{$headerMovie->title}}
		</x-slot>

		<x-slot name="movie_description">
			{{$headerMovie->overview}}
		</x-slot>

		<x-slot name="movie_genres">
			@foreach ($headerMovie->getGenres as $i=>$genre)
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
			@foreach ($headerMovie->getKeywords as $i=>$keyword)
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
			{{$headerMovie->release_date}}
		</x-slot>

		<x-slot name="headermovie_calltoaction">
			<a href="/movie/{{$headerMovie->id}}"><button type="button" class="btn">More info</button></a>
		</x-slot>

		<x-slot name="movie_image">
			<img src="{{$full_path}}" alt="movie poster" class="img-fluid">
		</x-slot>
	</x-header-movie>

	<!-- Categories sliders -->
		<!-- Category (with lazy loading and anchor links) -->
		@foreach ($genres as $genre)
			<x-category-slider>
				<x-slot name="category_title">
					{{$genre->genre}}
				</x-slot>
				<x-slot name="category_items">
					@foreach ($genresRandomMovies[$genre->genre] as $movie)
						<div>
							<a href="/movie/{{$movie->id}}">
								<img data-lazy="{{"$base_path" . "$movie->poster_path"}}" alt="{{$movie->title}}" class="img-fluid p-2">
							</a>
						</div>
					@endforeach
					{{-- @foreach ($genre->getMovies()->inRandomOrder()->limit(3)->get() as $movie)
						<div>
							<a href="/movie">
								<img data-lazy="{{$movie->poster_path}}" alt="copertina film">
							</a>
						</div>
					@endforeach --}}
				</x-slot>
			</x-category-slider>
		@endforeach
		<!-- Category -->
	{{-- <div class="container-fluid p-5">
		<div class="row">
			<div class="col-12">
				<h2>Categoria</h2>
			</div>
		</div>
		<div class="row">
			CIAO
			<div class="col-12">
				<div class="movie-slider">
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
				</div>
			</div>
		</div>
	</div>
		<!-- Category -->
	<div class="container-fluid p-5">
		<div class="row">
			<div class="col-12">
				<h2>Categoria</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="movie-slider">
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
				</div>
			</div>
		</div>
	</div>
		<!-- Category -->
	<div class="container-fluid p-5">
		<div class="row">
			<div class="col-12">
				<h2>Categoria</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="movie-slider">
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
				</div>
			</div>
		</div>
	</div>
		<!-- Category -->
	<div class="container-fluid p-5">
		<div class="row">
			<div class="col-12">
				<h2>Categoria</h2>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="movie-slider">
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
					<div><img src="http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg" alt="copertina film"></div>
				</div>
			</div>
		</div>
	</div> --}}
</x-slot name="page_content">
</x-html-layout>