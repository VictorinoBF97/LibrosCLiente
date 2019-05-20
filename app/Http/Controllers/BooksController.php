<?php

namespace App\Http\Controllers;

use App\Book;
use App\Publisher;
use App\Author;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\BookRequest;
use App\Notifications\BookCreated;

class BooksController extends Controller
{
    public function __construct()
    {
        /*$this->middleware('auth', [
            'only' => ['create' , 'store', 'edit', 'update', 'destroy']
        ]);
        $this->middleware('can:touch,book',[
            'only' => ['edit','update','destroy']
        ]);*/
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with(['user','authors','publisher'])
                    ->latest()
                    ->paginate(10);

        // $condition = true;

        // if($condition){
        //     $books = $books->load(['user','authors','publisher'])
        //                 ->latest()->paginate(10);
        // }

        return view('public.books.index')->withBooks($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers = Publisher::all();
        $authors = Author::all();

        return view('public.books.create', [
            'publishers' => $publishers,
            'authors'    => $authors
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
        $cover = $request->file('cover');

        //dd($cover);

        $book = Book::create([
            'user_id' => $request->user()->id,
            'publisher_id' => request('publisher'),
            'title' => request('title'),
            'slug' => str_slug(request('title'), "-"),
            'description' => request('description'),
            'cover' => ($cover?$cover->store('covers','public'):null),
        ]);

        $book->authors()->sync( request('author') );

        $user = User::find(1);
        $user->notify(new BookCreated($book));

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $book = Book::with('authors')->where('slug', $slug)->firstOrFail();

        return view('public.books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $publishers = Publisher::all();
        $authors = Author::all();

        return view('public.books.edit', [
            'book' => $book,
            'authors' => $authors,
            'publishers' => $publishers,
            
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(BookRequest $request, Book $book)
    {
        $cover = $request->file('cover');

        // En caso de tener ya uno, eliminamos la portada anterior
        if( $cover && $book->cover  ){
            Storage::disk('public')->delete($book->cover);
        }

        $book->update([
            'title' => request('title'),
            'publisher_id' => request('publisher'),
            'slug' => str_slug(request('title'), "-"),
            'description' => request('description'),
            'cover' => ($cover?$cover->store('covers','public'):$book->cover),
        ]);

        $book->authors()->sync( request('author') );

        return redirect('/books/'.$book->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        if( $book->cover ){
            Storage::disk('public')->delete($book->cover);
        }

        $book->authors()->detach();
        $book->delete();

        return redirect('/books')
            ->with('message', "The book '{$book->title}' has been deleted.");
    }

    public function crearLibroAjax(BookRequest $request)
    {   
        sleep(5);

        $cover = $request->file('cover');

        //dd($cover);

        $book = Book::create([
            'user_id' => $request->user()->id,
            'publisher_id' => request('publisher'),
            'title' => request('title'),
            'slug' => str_slug(request('title'), "-"),
            'description' => request('description'),
            'cover' => ($cover?$cover->store('covers','public'):null),
        ]);

        $book->authors()->sync( request('author') );

        $user = User::find(1);
        $user->notify(new BookCreated($book));
        return "EL LIBRO SE HA CREADO CORRECTAMENTE";
    }

    public function editarLibroAjax(BookRequest $request,$idBook){
        sleep(3);

        $book = Book::where('id', $idBook)->firstOrFail();
        $cover = $request->file('cover');

        // En caso de tener ya uno, eliminamos la portada anterior
        if( $cover && $book->cover  ){
            Storage::disk('public')->delete($book->cover);
        }

        $book->update([
            'title' => request('title'),
            'publisher_id' => request('publisher'),
            'slug' => str_slug(request('title'), "-"),
            'description' => request('description'),
            'cover' => ($cover?$cover->store('covers','public'):$book->cover),
        ]);
        
        $book->authors()->sync( request('author') );

        
        return "EL LIBRO SE HA EDITADO CORRECTAMENTE";
    }

    public function eliminarLibroAjax($idBook){
        sleep(3);
        
        $book = Book::where('id', $idBook)->firstOrFail(); 

        if( $book->cover ){
            Storage::disk('public')->delete($book->cover);
        }

        $book->authors()->detach();
        $book->delete();


        return "El libro '{$book->title}' ha sido borrado";
      
    }

    public function mostrarLibroAjax($idBook){

        sleep (3);

        $book = Book::where('id', $idBook)->firstOrFail(); 

        return view('public.books.partials.showData', ['book' => $book]);
    }

    public function buscarAjax(Request $request)
    {
        sleep(3);

        $books = request ('title');

        return view ('public.books.partials.buscarAjaxIndex', ['books' => $boooks]);
    }
}
