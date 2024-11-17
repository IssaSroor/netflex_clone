<?php
namespace App\Services;

use GuzzleHttp\Client;

class OMDBService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://www.omdbapi.com/',
        ]);
    }
    public function fetchMovieDetails($id)
{
    $response = $this->client->get('', [
        'query' => [
            'apikey' => env('OMDB_API_KEY'),
            'i' => $id, // Fetch details by movie ID
        ],
    ]);
    return json_decode($response->getBody(), true);
}
    public function fetchMovies($query)
    {
        $response = $this->client->get('', [
            'query' => [
                'apikey' => env('OMDB_API_KEY'),
                's' => $query,
            ],
        ]);
        return json_decode($response->getBody(), true);
    }
}
?>