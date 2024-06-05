<p align="center"><img src="https://user-images.githubusercontent.com/63505124/136289801-1d609d46-2986-4908-9476-bb29e0f0aab1.png" width="600"></p>

## Introduction

I started working at this project in my free time during a three months full-stack web development coding bootcamp, because I wanted to challenge myself on a complex back-end project with a real-world and large dataset. Since I’m fascinated by recommender systems (and A.I. in general), I chose to simulate their behaviour with the tools I have “here and now”: PHP and relational databases.

NB: In the future I’m willing to build a real recommender system with appropriate technologies like python and machine learning, but for the sake of practice I had to start somewhere.

Fun fact: this is the second time I try to implement this idea. The first one was for the Computer Organization and Design exam, for which I had to deliver an individual project using only logic gates in Logisim (that project got me a 30+/30 grade).

## Overview

The projects consists in a website similar to Netflix, with a homepage, a movie page and movies recommendations (both collaborative and content-based). All 45k movies available are real and they belong to this Kaggle dataset, which includes movie titles, descriptions, release dates, posters, backdrops, genres, languages, tags, production companies, production countries, user ratings, credits (cast and crew) and more.

The homepage shows a header movie and some information about it. The header movie isn’t hardcoded, but rather it’s chosen at every page-load by a random function, then it changes every time the page is reloaded.
Similarly, the 20 categories available are random ordered and in every category carousel there are 10 random selected movies (belonging to the specific category).
<i>Yep, I quite like random functions :-)</i>

![Netflix homepage](https://user-images.githubusercontent.com/63505124/136290134-2abcbdad-5fd3-4cad-ba7d-716bd85ae1c9.png)

Clicking a movie opens a page with movie details and two movie recommendation sections: “similar movies” and “other users also liked”. Every section contains the top 10 recommendations and has a “load more” button that shows 2 more movies at a time.

The “similar movies” are the output of the content-based recommender function, that combines a few queries and calculations to find what movies have more common features with the one selected by the user (genres, original language, keywords, production companies, production countries).

On the other side, “other users also liked” movies are the output of the collaborative recommender function, that first finds users who really liked the selected movie (those who rated it 5/5) and then calculates the 10 movies most well rated by them on average. 

![Netflix movie page](https://user-images.githubusercontent.com/63505124/136290222-4087f1a1-8649-42d6-871a-3713b7303e08.png)



<i>\[ [FULL ARTICLE AVAILABLE ON MEDIUM](https://medium.com/@malunem/how-i-built-a-movie-recommender-from-scratch-in-laravel-after-a-3-months-coding-bootcamp-d0db9de657ca) \]</i>
