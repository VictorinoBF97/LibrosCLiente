<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class, 2)->create();
        factory(App\Publisher::class, 5)->create();
        $books = factory(App\Book::class, 20)->create();
        $authors = factory(App\Author::class, 5)->create();

        // foreach($books as $book){
        //     $book->authors()->attach(
        //         $authors->random(random_int(1,3))
        //     );
        // }

        $books->each(function(App\Book $book) use ($authors){
            $book->authors()->attach(
                $authors->random(random_int(1,3))
            );
        });
    }
}
