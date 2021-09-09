<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    //One to many relation
    public function getLanguage(){
        $this->belongsTo(Language::class);
    }

    public function getVote(){
        $this->belongsTo(Vote::class);
    }

    public function getImages(){
        $this->belongsTo(Image::class);
    }
}
