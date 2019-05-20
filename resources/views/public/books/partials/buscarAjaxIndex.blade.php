@forelse($books as $book)
<div data-eliminar="{{ $book->id }}" class="card-deck">
    <div class="card">
        <div class="card-header">
            <h3>{{ $book->title }}</h3>
        </div>
        <div class="card-body">
            <h4>{{ $book->author }}</h4>
            <h4>{{ $book->publisher}}</h4>
            <p>{{ $book->description }}</p>
            @include('public.books.partials.buttons')
            <button id="show" data-accion='show' data-book="{{ $book->id }}" class="btn btn-primary btn-sm mr-2 float-right">More Info</button>
        </div>
    </div>
</div>

@empty

<p>No se han encontrado libros con ese nombre</p>

@endforelse
@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
@endpush