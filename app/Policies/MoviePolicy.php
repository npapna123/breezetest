<?php

namespace App\Policies;

use App\Models\Movie;
use App\Models\User;

class MoviePolicy
{
    /**
     * Create a new policy instance.
     */
    public function delete(?User $user, Movie $movie): bool
    {
        return $user?->id === $movie->user_id;
    }
}
