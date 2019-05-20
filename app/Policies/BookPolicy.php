<?php

namespace App\Policies;

use App\User;
use App\Book;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if( $user->id == 3 ) return true;
    }
    
    /**
     * Determine whether the user can update the book.
     *
     * @param  \App\User  $user
     * @param  \App\Book  $book
     * @return mixed
     */
    public function touch(User $user, Book $book)
    {
        return $book->user_id == $user->id || $user->id == 2;
    }
}
