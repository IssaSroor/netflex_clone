@extends('layouts.app')

@section('content')
<div class="container-fluid px-5 py-4" style="background-color: #141414;">
    <h1 class="text-center text-white mb-5">Browse Movies</h1>
    <div class="movie-grid">
        @forelse($movies as $movie)

        {{-- @dd($movies) --}}
            <div class="movie-card">
                <img src="{{ $movie['Poster'] }}" alt="{{ $movie['Title'] }}" class="movie-poster">
                <div class="movie-info">
                    <h5 class="movie-title">{{ $movie['Title'] }}</h5>
                    <p class="movie-year">Released: {{ $movie['Year'] }}</p>
                    <a href="{{ route('watchlist.details', $movie['imdbID']) }}" class="text-blue-500">View Details</a>
                    <form action="{{ route('watchlist.remove', $movie['imdbID']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">Remove from Watchlist</button>
                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-white">your watchlist is empty</p>
        @endforelse
    </div>
</div>

<style>
    /* Container and Background */
    .container {
        width: 100%;
        height: 100%;
        min-height: 100vh;
        padding: 2rem;
        background-color: #141414;
    }

    /* Grid Layout */
    .movie-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    /* Movie Card */
    .movie-card {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
        background-color: #222;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .movie-card:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
    }

    /* Poster */
    .movie-poster {
        width: 100%;
        height: 300px;
        object-fit: cover;
        border-bottom: 2px solid #e50914;
    }

    /* Movie Info */
    .movie-info {
        padding: 1rem;
        text-align: center;
    }

    .movie-title {
        font-size: 1.2rem;
        color: #fff;
        margin: 0.5rem 0;
        font-weight: bold;
    }

    .movie-year {
        font-size: 0.9rem;
        color: #bbb;
        margin-bottom: 1rem;
    }

    /* Button */
    .btn-watch {
        display: inline-block;
        padding: 0.5rem 1rem;
        background-color: #e50914;
        color: #fff;
        border-radius: 5px;
        text-transform: uppercase;
        font-size: 0.9rem;
        font-weight: bold;
        transition: background-color 0.3s;
        text-decoration: none;
        margin-bottom: 10px;
    }

    .btn-watch:hover {
        background-color: #b00610;
    }
</style>
@endsection
