@extends('layouts.app')

@section('title', 'About IBDB')

@section('content')
<h1>Book List</h1>

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>

    @if(session('message'))
    <div class="alert alert-primary" role="alert">
            {{ session('message') }}
    </div>
    @endif

    <div class="form-row">
    <form id="searchForm">
        <div class="form-group">
            <label for="busqueda">Buscar por nombre</label>
            <input id="busqueda" class="form-control" name="busqueda" type="text">

            <label for="selectBusqueda">Filtro</label>
            <select id="selectBusqueda" class="form-control" name="selectBusqueda">
                <option value="#"></option>
                <option value="Auhtor">Autor</option>
                <option value="Publisher">Editorial</option>
            </select>
        </div>

        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkBox" id="checkBox1" value="option1">
            <label class="form-check-label" for="checkBox1">Accion</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="checkBox2" value="option2">
            <label class="form-check-label" for="checkBox2">Comedia</label>
        </div> 
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="checkbox" id="checkBox3" value="option3">
            <label class="form-check-label" for="checkBox3">Drama</label> 
        </div> 

        <button id="botonBuscar" class="btn btn-primary" type="submit">Buscando
            <span id="spinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
        </button>
    </form>
</div>

<div id="mostrarBusqueda">

</div>
    
    @forelse($books as $book)
    <div id="libro{{ $book->id }}" class="book-card card mb-2">
        <div class="card-header">
            {{ $book->title }}
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-2">
                    <img class="img-fluid" src="{{ $book->cover }}" alt="">
                </div>
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

    <div class="d-flex justify-content-center">
        {{ $books->links() }}
    </div>
        
    {{-- MODAL CONFIRMAR BORRAR --}}
    <div class="modal" data-accion="eliminar" id="modalEliminar" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Eliminar libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>¿Estás seguro que desea eliminar el libro?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">NO</button>
        <button type="button" id="confirmarEliminar" data-elemento-borrar="" class="btn btn-primary">SI</button>
      </div>
    </div>
  </div>
</div>

  {{-- MODAL MOSTRAR INFORMACIÓN --}}
  <div class="modal" id="modalShow" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Información del libro</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="info">
    
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>


@endsection
@push('scripts')
    <script src="{{ mix('/js/validaciones/validacionLibro.js') }}" defer></script>
@endpush