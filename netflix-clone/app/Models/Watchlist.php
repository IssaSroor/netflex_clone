<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Watchlist extends Model
{
    use HasFactory;

    protected $table = 'watchlists';

    protected $fillable = ['user_id', 'movie_id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

   
}
