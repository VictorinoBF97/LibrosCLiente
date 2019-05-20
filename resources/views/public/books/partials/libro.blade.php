    <h2>{{ $book->title }}</h2>
    <h4>{{ str_plural("Author", $book->authors->count())}}: {{ $book->authors->pluck('name')->implode(', ') }}</h4>
    <p>{{ $book->description }}</p>

    @include('public.books.partials.buttons')
