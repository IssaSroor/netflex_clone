<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = ['title', 'release_year', 'poster', 'imdb_id']; // Add more fields as needed

   
}
