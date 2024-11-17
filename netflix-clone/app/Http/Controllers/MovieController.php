<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\OMDBService;

class MovieController extends Controller
{
    protected $omdbService;

    public function __construct(OMDBService $omdbService)
    {
        $this->omdbService = $omdbService;
    }

  
    public function index()
    {
        // Fetch movies (example query: 'a' to get a list of movies)
        $movies = $this->omdbService->fetchMovies('man');

        // Pass movies to the view
        return view('home', ['movies' => $movies['Search'] ?? []]);
    }
}