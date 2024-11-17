<?php
// app/Http/Controllers/WatchlistController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Watchlist;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class WatchlistController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login')->with('error', 'You must log in to view your watchlist.');
        }

        // Fetch the user's watchlist
        $watchlistItems = Watchlist::where('user_id', $user->id)->pluck('movie_id');

        // Fetch movie details for each movie ID from the API
        $movies = [];
        foreach ($watchlistItems as $movieId) {
$response = Http::withoutVerifying()->get('https://www.omdbapi.com/?i='.$movieId.'&apikey=887cd9a2');
            if ($response->successful()) {
                $movies[] = $response->json();
            }
        }

        return view('watchlist', ['movies' => $movies]);
    }
    public function add(Request $request)
    {
        $request->validate([
            'movie_id' => 'required|string',
        ]);

        $user = Auth::user();

        // Ensure the user is logged in
        if (!$user) {
            return redirect()->route('login')->with('error', 'You must log in to add to your watchlist.');
        }

        // Check if the movie is already in the watchlist
        $exists = Watchlist::where('user_id', $user->id)
            ->where('movie_id', $request->movie_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'This movie is already in your watchlist.');
        }

        // Add movie to the watchlist
        Watchlist::create([
            'user_id' => $user->id,
            'movie_id' => $request->movie_id,
        ]);

        return redirect()->back()->with('success', 'Movie added to your watchlist!');
    }
    public function remove($movie_id)
    {
        // Find the watchlist entry by the current user's ID and the movie ID
        $watchlist = Watchlist::where('user_id', Auth::id())
                              ->where('movie_id', $movie_id)
                              ->first();

        // Check if the movie is in the watchlist and delete it
        if ($watchlist) {
            $watchlist->delete();
        }

        // Redirect back with a success message
        return redirect()->route('watchlist.index')->with('success', 'Movie removed from your watchlist.');
    }
    public function show($movie_id)
    {
        // Your OMDB API key
        $apiKey = '887cd9a2'; // Your OMDB API key
    $url = "https://www.omdbapi.com/?i=$movie_id&apikey=$apiKey";

    // Fetch data from OMDB API without verifying the SSL certificate
    $response = Http::withOptions([
        'verify' => false, // Disable SSL certificate verification
    ])->get($url);

    if ($response->successful()) {
        $movieDetails = $response->json();
        return view('details', compact('movieDetails'));
    } else {
        return redirect()->route('watchlist')->with('error', 'Unable to fetch movie details.');
    }
    }
}
