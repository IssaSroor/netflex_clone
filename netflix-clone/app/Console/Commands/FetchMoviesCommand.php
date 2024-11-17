<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Movie;

class FetchMoviesCommand extends Command
{
    // Command name and description
    protected $signature = 'fetch:movies';
    protected $description = 'Fetch movies from the API and store them in the database';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Replace with your actual API URL and key
        $apiUrl = 'http://www.omdbapi.com/';
        $apiKey = env('OMDB_API_KEY');
        $query = 'man'; // Example query

        // Fetch data from the API
        $response = Http::get($apiUrl, [
            'apikey' => $apiKey,
            's' => $query,
        ]);

        if ($response->ok() && isset($response['Search'])) {
            foreach ($response['Search'] as $movieData) {
                // Check if the movie already exists
                $movie = Movie::updateOrCreate(
                    ['id' => $movieData['imdbID']], // Primary key
                    [
                        'title' => $movieData['Title'],
                        'release_year' => $movieData['Year'],
                        'poster' => $movieData['Poster'] != 'N/A' ? $movieData['Poster'] : null,
                    ]
                );

                $this->info("Stored/Updated: {$movie->title}");
            }
        } else {
            $this->error('Failed to fetch data from the API.');
        }
    }
}
