@extends('layouts.app')

@section('title', 'About IBDB')

@section('content')
<h1>{{ $user->name }}'s Book List</h1>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>

    @forelse($books as $book)
    <div class="card mb-2">
        <div class="card-header">
            {{ $book->title }}
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $book->user->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">{{ $book->author}}</h6>
            <p class="card-text">{{ str_limit($book->description, 300) }}</p>


            @auth
            <a href="/books/{{ $book->id }}/edit" class="btn btn-warning btn-sm mr-2 float-right">Edit</a>
            <form action="/books/{{ $book->id }}" method="post" class="mr-2 float-right">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger btn-sm">Delete Book</button>
            </form>
            @endauth
            <a href="/books/{{ $book->slug }}" class="btn btn-primary btn-sm mr-2 float-right">More Info</a>
      </div>
    </div>
    @empty
      <p>No hay libros</p>
    @endforelse

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
@endsection
@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
@endpush
