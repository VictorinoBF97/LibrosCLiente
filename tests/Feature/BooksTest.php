<?php

namespace Tests\Feature;

use App\Book;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class BooksTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function check_if_book_list_loads()
    {
        $response = $this->get('/books');
        
        $response->assertSeeText('More Info');
    }

    /** @test */
    public function check_if_book_details_page_loads()
    {
        // Crear un libro
        $book = Book::inRandomOrder()->first();

        // Compruebo la URL de ese libro
        $this->get('/books/'. $book->slug)
            ->assertSee($book->title)
            ->assertSee( $book->publisher->name ) // Publisher
            ->assertSee( $book->authors->pluck('name')->implode(', ') )
            ->assertSee($book->description);
    }

    /** @test */
    public function check_if_a_guest_user_creates_a_book()
    {
        $this->get('/books/create')
            ->assertRedirect('/login');
    }

    /** @test */
    public function check_if_a_user_can_load_create_book_form()
    {
        $this->actingAs( factory('App\User')->create() );

        $this->get('/books/create')
            ->assertOk()
            ->assertSee('Add New Book');
    }

    /** @test */
    public function a_user_creates_a_book()
    {
        $this->actingAs( factory('App\User')->create() );
        $book = factory('App\Book')->create();

        $this->post('/books', $book->toArray() );

        $this->assertDatabaseHas('books', [
            'title'         => $book->title,
            'slug'          => $book->slug,
            'description'   => $book->description
        ]);
    }
}