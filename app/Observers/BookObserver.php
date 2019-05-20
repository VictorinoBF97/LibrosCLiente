<?php

namespace App\Observers;

use App\Book;

use App\Mail\BookCreated;
use Illuminate\Support\Facades\Mail;

class BookObserver
{
    /**
     * Handle the book "created" event.
     *
     * @param  \App\Book  $book
     * @return void
     */
    public function created(Book $book)
    {
        Mail::to($book->user->email)->send(
            new BookCreated($book)
        );
    }
}
