<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    //One to many relation
    public function getLanguage(){
        return $this->belongsTo(Language::class);
    }

    public function getVote(){
        return $this->belongsTo(Vote::class);
    }

    public function getImages(){
        return $this->belongsTo(Image::class);
    }

    public function getRatings(){
        return $this->belongsToMany(Image::class);
    }

    public function getGenres(){
        return $this->belongsToMany(Genre::class);
    }

    public function getCompanies(){
        return $this->belongsToMany(Company::class);
    }

    public function getCountries(){
        return $this->belongsToMany(Country::class);
    }

    public function getKeywords(){
        return $this->belongsToMany(Keyword::class);
    }
}
