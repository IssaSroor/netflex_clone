<!-- movie/details.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-4xl font-bold text-gray-900 mb-6">{{ $movieDetails['Title'] }}</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Movie Poster -->
        <div class="flex justify-center">
            <img src="{{ $movieDetails['Poster'] }}" alt="{{ $movieDetails['Title'] }}" class="rounded-lg shadow-lg max-w-full h-auto">
        </div>
        
        <!-- Movie Details -->
        <div class="flex flex-col justify-between space-y-4">
            <div>
                <p class="text-xl text-gray-700"><strong>Genre:</strong> {{ $movieDetails['Genre'] }}</p>
                <p class="text-xl text-gray-700"><strong>Actors:</strong> {{ $movieDetails['Actors'] }}</p>
                <p class="text-xl text-gray-700"><strong>Director:</strong> {{ $movieDetails['Director'] }}</p>
                <p class="text-xl text-gray-700"><strong>Released:</strong> {{ $movieDetails['Released'] }}</p>
            </div>
            
            <div>
                <h2 class="text-2xl font-semibold text-gray-800">Description:</h2>
                <p class="text-lg text-gray-600">{{ $movieDetails['Plot'] }}</p>
            </div>
            
            <div class="mt-4">
                <h2 class="text-2xl font-semibold text-gray-800">Trailer:</h2>
                <div class="flex justify-center mt-2">
                    <!-- You can replace this with actual video embedding if available -->
                    <iframe class="rounded-lg shadow-lg" width="560" height="315" src="https://www.youtube.com/embed/{{ $movieDetails['imdbID'] }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>

    <!-- Back to Watchlist Button -->
    <div class="mt-8">
        <a href="{{ route('watchlist.index') }}" class="text-white bg-blue-600 hover:bg-blue-700 py-2 px-4 rounded-lg transition duration-200">
            &larr; Back to Watchlist
        </a>
    </div>
</div>
@endsection
