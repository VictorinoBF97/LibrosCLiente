@forelse($books as $book)
    <div class="card mb-2">
        <div class="card-header">
            {{ $book->title }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col">
                    <h5 class="card-title">User: <a href="{{ route('userbooks.index', $book->user->slug) }}" title="{{ $book->user->name }}'s book list">{{ $book->user->name }}</a></h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ str_plural("Author", $book->authors->count())}}: {{ $book->authors->pluck('name')->implode(', ') }}</h6>
                    <h6 class="card-subtitle mb-2 text-muted">Publisher: {{ $book->publisher->name }}</h6>
                    <p class="card-text">{{ str_limit($book->description, 300) }}</p>

                    @include('public.books.partials.buttons')

                    <a href="/books/{{ $book->slug }}" data-accion='show' data-book="{{ $book->id }}" class="btn btn-primary btn-sm mr-2 float-right">More Info</a>
                </div>
            </div>
      </div>
    </div>
    @empty
      <p>No hay libros</p>
    @endforelse
