<div class="movie-card">
    <img src="{{ $movie['Poster'] }}" alt="{{ $movie['Title'] }}" class="movie-poster">
    <div class="movie-info">
        <h5 class="movie-title">{{ $movie['Title'] }}</h5>
        <p class="movie-year">Released: {{ $movie['Year'] }}</p>
        {{-- <form action="{{ route('watchlist.remove') }}" method="POST">
            @csrf
            @method('DELETE')
            <input type="hidden" name="movie_id" value="{{ $movie['imdbID'] }}">
            <button type="submit" class="btn btn-danger">Remove from Watchlist</button>
        </form> --}}
    </div>
</div>
