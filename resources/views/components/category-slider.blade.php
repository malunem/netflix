<div class="container-fluid p-5">
    <div class="row">
        <div class="col-12">
            <h2>{{$category_title}}</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="movie-slider">
                {{$category_items}}
                {{-- <x-category-item>
                    <x-slot name="img_path">
                        http://image.tmdb.org/t/p/w200/nLvUdqgPgm3F85NMCii9gVFUcet.jpg
                    </x-slot>
                </x-category-item>
                <div>
                    <a href="/movie">
                        <img data-lazy="{{$img_path}}" alt="copertina film">
                    </a>
                </div> --}}
            </div>
        </div>
    </div>
</div>